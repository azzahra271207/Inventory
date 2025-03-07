<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Peminjaman</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #fff8e1;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        .container {
            background: white;
            padding: 40px 50px;
            border-radius: 15px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            width: 50%;
            text-align: center;
            max-height: 90vh; /* Set a max height for the container */
            overflow-y: auto; /* Enable vertical scrolling if content overflows */
        }
        h2 {
            color: #6d4c41;
            font-size: 28px;
            margin-bottom: 20px;
        }
        form {
            display: flex;
            flex-direction: column;
            gap: 25px;
            align-items: flex-start;
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
            transition: background-color 0.3s ease;
            font-size: 16px;
            width: 100%;
        }
        button:hover {
            background-color: #5d4037;
        }
        .back-link {
            display: block;
            margin-top: 20px;
            text-decoration: none;
            color: #6d4c41;
            font-weight: bold;
            font-size: 14px;
        }
        .message {
            color: green;
            margin-bottom: 15px;
            font-size: 14px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Edit Peminjaman</h2>
        
        @if (session('success'))
            <div class="message">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('peminjaman.update', $peminjaman->id_peminjaman) }}" method="POST">
            @csrf
            @method('PUT')
            <label for="id_barang">Barang:</label>
            <select name="id_barang" id="id_barang" required>
                @foreach ($barang as $item)
                    <option value="{{ $item->id_barang }}" {{ $item->id_barang == $peminjaman->id_barang ? 'selected' : '' }}>{{ $item->id_barang }} - {{ $item->nama_barang }}</option>
                @endforeach
            </select>
            
            <label for="nisn">Siswa:</label>
            <select name="nisn" id="nisn" required>
                @foreach ($siswa as $item)
                    <option value="{{ $item->nisn }}" {{ $item->nisn == $peminjaman->nisn ? 'selected' : '' }}>{{ $item->nisn }} - {{ $item->nama_siswa }}</option>
                @endforeach
            </select>
            
            <label for="jumlah_pinjam">Jumlah Pinjam:</label>
            <input type="number" name="jumlah_pinjam" value="{{ $peminjaman->jumlah_pinjam }}" required>
            
            <label for="tanggal_pinjam">Tanggal Pinjam:</label>
            <input type="date" name="tanggal_pinjam" value="{{ $peminjaman->tanggal_pinjam }}" required>
            
            <label for="tanggal_kembali">Tanggal Kembali:</label>
            <input type="date" name="tanggal_kembali" value="{{ $peminjaman->tanggal_kembali }}" required>

            <label for="status">Status:</label>
            <select name="status" id="status" required>
                <option value="Dipinjam" {{ $peminjaman->status == 'Dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                <option value="Dikembalikan" {{ $peminjaman->status == 'Dikembalikan' ? 'selected' : '' }}>Dikembalikan</option>
            </select>

            <button type="submit">Update</button>
        </form>
        
        <a href="{{ route(name: 'peminjaman.index') }}" class="back-link">&#8592; Kembali</a>
    </div>
</body>
</html>