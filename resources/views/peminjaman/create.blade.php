<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Peminjaman</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #fff8e1;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .header {
            text-align: center;
            margin: 20px 0;
        }
        h2 {
            color: #6d4c41;
            font-size: 32px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .container {
            width: 60%;
            margin-top: 20px;
            background-color: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
        form {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        label {
            font-size: 16px;
            font-weight: bold;
            text-align: left;
            width: 100%;
        }
        input[type="text"], input[type="number"], input[type="date"], select {
            padding: 12px;
            border: 1px solid #6d4c41;
            border-radius: 8px;
            outline: none;
            font-size: 16px;
            width: 100%;
            background-color: #f9f5ec;
            box-shadow: inset 2px 2px 5px rgba(0, 0, 0, 0.1);
        }
        button {
            background-color: #6d4c41;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #5d4037;
        }
        .back-link {
            margin-top: 20px;
            text-decoration: none;
            color: #6d4c41;
            font-weight: bold;
        }
        .notification {
            color: red;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Tambah Peminjaman</h2>
    </div>

    @if (session('success'))
        <div style="color: green;">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="notification">
            {{ session('error') }}
        </div>
    @endif

    <div class="container">
        <form action="{{ route('peminjaman.store') }}" method="POST">
            @csrf
            <label for="id_barang">Barang:</label>
            <select name="id_barang" id="id_barang" required>
                @foreach ($barang as $item)
                    <option value="{{ $item->id_barang }}">{{ $item->id_barang }} - {{ $item->nama_barang }} (Stok: {{ $item->stok }})</option>
                @endforeach
            </select>

            <label for="nisn">Siswa:</label>
            <select name="nisn" id="nisn" required>
                @foreach ($siswa as $item)
                    <option value="{{ $item->nisn }}">{{ $item->nisn }} - "{{ $item->nama_siswa }}"</option>
                @endforeach
            </select>

            <label for="jumlah_pinjam">Jumlah Pinjam:</label>
            <input type="number" name="jumlah_pinjam" required min="1">

            <label for="tanggal_pinjam">Tanggal Pinjam:</label>
            <input type="date" name="tanggal_pinjam" required>

            <label for="tanggal_kembali">Tanggal Kembali:</label>
            <input type="date" name="tanggal_kembali" placeholder="Tanggal Kembali (optional)">

            <label for="status">Status:</label>
            <select name="status" id="status" required>
                <option value="dipinjam">Dipinjam</option>
                <option value="dikembalikan">Dikembalikan</option>
            </select>
            
            <button type="submit">Simpan</button>
        </form>
        <a href="{{ route('peminjaman.index') }}" class="back-link">Kembali</a>
    </div>
</body>
</html>