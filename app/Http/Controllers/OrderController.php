<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('details.event')->latest()->paginate(10);

        $summary = [
            'total'     => Order::count(),
            'pending'   => Order::where('status', 'pending')->count(),
            'confirmed' => Order::where('status', 'confirmed')->count(),
            'cancelled' => Order::where('status', 'cancelled')->count(),
            'revenue'   => Order::where('status', 'confirmed')->sum('total'),
        ];

        return view('dashboard', compact('orders', 'summary'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $data = $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled',
        ]);

        $order->update($data);

        return redirect()
            ->route('dashboard')
            ->with('success', 'Status pesanan #'.$order->id.' berhasil diperbarui.');
    }

    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()
            ->route('dashboard')
            ->with('success', 'Pesanan berhasil dihapus.');
    }
}
