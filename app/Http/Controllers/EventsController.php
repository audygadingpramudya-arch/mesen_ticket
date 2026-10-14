<?php

namespace App\Http\Controllers;

use App\Models\Events;
use Illuminate\Http\Request;


class EventsController extends Controller
{
    public function index()
    {
        $events = Events::latest()->paginate(10);

        return view('events.index', compact('events'));
    }

    public function create()
    {
        return view('events.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'         => 'required|string|max:100',
            'category'      => 'required|string|max:100',
            'ticket_price'  => 'required|numeric|min:0',
            'description'   => 'nullable|string',
            'image'         => 'nullable|string|max:255',
        ]);

        Events::create($data);

        return redirect()
            ->route('events.index')
            ->with('success', 'Data berhasil ditambahkan.');
    }

    public function show(Events $event)
    {
        return view('events.show', compact('event'));
    }

    public function edit(Events $event)
    {
        return view('events.edit', compact('event'));
    }

    public function update(Request $request, Events $event)
    {
        $data = $request->validate([
            'title'         => 'required|string|max:100',
            'category'      => 'required|string|max:100',
            'ticket_price'  => 'required|numeric|min:0',
            'description'   => 'nullable|string',
            'image'         => 'nullable|string|max:255',
        ]);

        $event->update($data);

        return redirect()
            ->route('events.index')
            ->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy(Events $event)
    {
        $event->delete();

        return redirect()
            ->route('events.index')
            ->with('success', 'Data berhasil dihapus.');
    }
}
