<?php

namespace App\Http\Controllers;

use App\Models\Events;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DetailsController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'customer_name'  => 'required|string|max:100',
            'customer_email' => 'required|email|max:100',
            'items'          => 'required|array',
            'items.*'        => 'nullable|integer|min:0',
        ]);

        // Ambil item dengan jumlah lebih dari 0
        $items = collect($data['items'])
            ->filter(fn ($quantity) => (int) $quantity > 0)
            ->map(fn ($quantity) => (int) $quantity);

        // Pastikan minimal ada satu tiket dipilih
        if ($items->isEmpty()) {
            return back()
                ->withErrors([
                    'items' => 'Pilih minimal 1 tiket dengan jumlah lebih dari 0.',
                ])
                ->withInput();
        }

        // Ambil event berdasarkan ID
        $events = Events::whereIn('id', $items->keys())
            ->get()
            ->keyBy('id');

        $total = 0;
        $orderItems = [];

        foreach ($items as $eventId => $quantity) {
            $event = $events->get($eventId);

            if (! $event) {
                continue;
            }

            $subtotal = $event->ticket_price * $quantity;
            $total += $subtotal;

            $orderItems[] = [
                'events_id' => $event->id,
                'quantity'  => $quantity,
                'subtotal'  => $subtotal,
            ];
        }

        if (empty($orderItems)) {
            return back()
                ->withErrors([
                    'items' => 'Event yang dipilih tidak ditemukan.',
                ])
                ->withInput();
        }

        // Simpan pesanan dalam database
        DB::transaction(function () use ($data, $total, $orderItems) {
            $order = Order::create([
                'customer_name'  => $data['customer_name'],
                'customer_email' => $data['customer_email'],
                'status'         => 'pending',
                'total'          => $total,
            ]);

            foreach ($orderItems as $item) {
                $order->details()->create($item);
            }
        });

        return redirect()
            ->route('home')
            ->with('success', 'Pesanan berhasil dibuat!');
    }
}
