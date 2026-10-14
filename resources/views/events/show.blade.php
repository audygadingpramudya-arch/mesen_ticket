<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Event</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f5f5f5; margin: 0; padding: 24px; }
        .container { max-width: 800px; margin: 0 auto; background: white; padding: 24px; border-radius: 12px; }
        .card { display: grid; grid-template-columns: 220px 1fr; gap: 20px; }
        .image-box { width: 100%; height: 220px; object-fit: cover; border-radius: 12px; background: #ddd; }
        .meta { margin-top: 10px; }
        .btn { display: inline-block; padding: 10px 14px; border-radius: 8px; text-decoration: none; }
        .btn-primary { background: #2563eb; color: white; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Detail Event</h1>

        <div class="card">
            <div>
                @if ($event->image)
                    <img src="{{ $event->image }}" alt="{{ $event->title }}" class="image-box">
                @else
                    <div class="image-box"></div>
                @endif
            </div>
            <div>
                <h2>{{ $event->title }}</h2>
                <p class="meta"><strong>Kategori:</strong> {{ $event->category }}</p>
                <p class="meta"><strong>Harga Tiket:</strong> Rp {{ number_format($event->ticket_price, 0, ',', '.') }}</p>
                <p class="meta"><strong>Deskripsi:</strong> {{ $event->description }}</p>

                <a href="{{ route('events.index') }}" class="btn btn-primary">Kembali</a>
            </div>
        </div>
    </div>
</body>
</html>
