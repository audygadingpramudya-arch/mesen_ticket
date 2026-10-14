<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Daftar Pesanan') }}
            </h2>
            <a href="{{ route('events.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                Kelola Event
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 bg-green-100 text-green-800 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

           
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Pemesan</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Detail</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($orders as $order)
                                <tr>
                                    <td class="px-4 py-3 text-sm text-gray-900">#{{ $order->id }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-900">{{ $order->customer_name }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-500">{{ $order->customer_email }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-500">
                                        @foreach ($order->details as $detail)
                                            <div>{{ $detail->event?->title ?? 'Event dihapus' }} x{{ $detail->quantity }}</div>
                                        @endforeach
                                    </td>
                                    <td class="px-4 py-3 text-sm text-gray-900">Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                                    <td class="px-4 py-3 text-sm">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                            @if ($order->status === 'confirmed') bg-green-100 text-green-800
                                            @elseif ($order->status === 'cancelled') bg-red-100 text-red-800
                                            @else bg-yellow-100 text-yellow-800 @endif">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        <form action="{{ route('orders.updateStatus', $order->id) }}" method="POST" class="flex items-center gap-2">
                                            @csrf
                                            @method('PATCH')
                                            <select name="status" class="rounded-md border-gray-300 text-sm">
                                                @foreach (['pending', 'confirmed', 'cancelled'] as $status)
                                                    <option value="{{ $status }}" {{ $order->status === $status ? 'selected' : '' }}>
                                                        {{ ucfirst($status) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <button type="submit" class="px-3 py-1 bg-blue-600 text-white rounded text-xs">Simpan</button>
                                        </form>

                                        <form action="{{ route('orders.destroy', $order->id) }}" method="POST" class="mt-2" onsubmit="return confirm('Hapus pesanan ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-3 py-1 bg-red-600 text-white rounded text-xs">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-4 py-6 text-center text-sm text-gray-500">Belum ada pesanan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-4">
                {{ $orders->links() }}
            </div>
        </div>
    </div>
</x-app-layout>