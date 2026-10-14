<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tambah Event</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f5f5f5; margin: 0; padding: 24px; }
        .container { max-width: 700px; margin: 0 auto; background: white; padding: 24px; border-radius: 12px; }
        h1 { margin-top: 0; }
        form { display: flex; flex-direction: column; gap: 16px; }
        label { font-weight: bold; display: block; margin-bottom: 8px; }
        input, select, textarea { width: 100%; padding: 10px 12px; border: 1px solid #d1d5db; border-radius: 8px; box-sizing: border-box; }
        textarea { min-height: 100px; }
        .actions { display: flex; gap: 10px; }
        .btn { display: inline-block; padding: 10px 14px; border: none; border-radius: 8px; text-decoration: none; cursor: pointer; }
        .btn-primary { background: #2563eb; color: white; }
        .btn-secondary { background: #e5e7eb; color: #111827; }
        .error { color: #dc2626; font-size: 13px; margin-top: 6px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Tambah Event</h1>

        <form action="{{ route('events.store') }}" method="POST">
            @csrf

            <div>
                <label for="title">Judul</label>
                <input id="title" type="text" name="title" value="{{ old('title') }}" required>
                @error('title') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div>
                <label for="ticket_price">Harga Tiket</label>
                <input id="ticket_price" type="number" name="ticket_price" value="{{ old('ticket_price') }}" min="0" required>
                @error('ticket_price') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div>
                <label for="category">Kategori</label>
                <select id="category" name="category" required>
                    <option value="">Pilih kategori</option>
                    <option value="musik" {{ old('category') == 'musik' ? 'selected' : '' }}>Musik</option>
                    <option value="festival" {{ old('category') == 'festival' ? 'selected' : '' }}>Festival</option>
                    <option value="seminar" {{ old('category') == 'seminar' ? 'selected' : '' }}>Seminar</option>
                </select>
                @error('category') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div>
                <label for="description">Deskripsi</label>
                <textarea id="description" name="description">{{ old('description') }}</textarea>
                @error('description') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div>
                <label for="image">URL Gambar</label>
                <input id="image" type="text" name="image" value="{{ old('image') }}" placeholder="https://...">
                @error('image') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div class="actions">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('events.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</body>
</html>
