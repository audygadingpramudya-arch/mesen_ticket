<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Tiket</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f5f5f5; margin: 0; padding: 24px; }
        .container { max-width: 1100px; margin: 0 auto; }
        .topbar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        .btn { display: inline-block; padding: 10px 16px; border-radius: 8px; text-decoration: none; font-weight: bold; }
        .btn-primary { background: #2563eb; color: white; }
        .btn-secondary { background: #e5e7eb; color: #111827; }
        .btn-danger { background: #dc2626; color: white; }
        .alert { background: #dcfce7; color: #047857; padding: 12px 16px; border-radius: 8px; margin-bottom: 16px; }
        table { width: 100%; border-collapse: collapse; background: white; }
        th, td { border: 1px solid #e5e7eb; padding: 10px 12px; text-align: left; }
        th { background: #f3f4f6; }
        .actions { display: flex; gap: 8px; }
        .image-box { width: 80px; height: 60px; object-fit: cover; border-radius: 6px; background: #ddd; }
    </style>
</head>
<body>
    <div class="container">
        <div class="topbar">
            <h1>Daftar Konser</h1>
            <a href="{{ route('events.create') }}" class="btn btn-primary">+ Tambah Event</a>
        </div>

        @if (session('success'))
            <div class="alert">{{ session('success') }}</div>
        @endif

        <table>
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Harga Tiket</th>
                    <th>Deskripsi</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($events as $event)
                    <tr>
                        <td>{{ $event->title }}</td>
                        <td>{{ $event->category }}</td>
                        <td>Rp {{ number_format($event->ticket_price, 0, ',', '.') }}</td>
                        <td>{{ $event->description }}</td>
                        <td>
                            @if ($event->image)
                                <img src="{{ $event->image }}" alt="{{ $event->title }}" class="image-box">
                            @else
                                <span>Tidak ada</span>
                            @endif
                        </td>
                        <td>
                            <div class="actions">
                                <a href="{{ route('events.show', $event->id) }}" class="btn btn-secondary">Lihat</a>
                                <a href="{{ route('events.edit', $event->id) }}" class="btn btn-secondary">Edit</a>
                                <form action="{{ route('events.destroy', $event->id) }}" method="POST" onsubmit="return confirm('Yakin hapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">Belum ada data event.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div style="margin-top: 16px;">
            {{ $events->links() }}
        </div>
    </div>
</body>
</html>
