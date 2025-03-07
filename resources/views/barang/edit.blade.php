<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Barang</title>
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
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 500px; /* Maksimal lebar untuk tampilan yang lebih baik */
            text-align: center;
        }
        h2 {
            color: #6d4c41;
            font-size: 28px;
            margin-bottom: 20px;
        }
        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
            align-items: center;
        }
        label {
            font-size: 16px;
            font-weight: bold;
            text-align: left;
            width: 100%; /* Menggunakan lebar penuh */
        }
        input[type="text"], input[type="number"], select {
            padding: 12px;
            border: 1px solid #6d4c41;
            border-radius: 8px;
            outline: none;
            font-size: 16px;
            width: 100%; /* Menggunakan lebar penuh */
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
            width: 100%; /* Menggunakan lebar penuh */
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
        <h2>Edit Barang</h2>
        
        @if (session('success'))
            <div class="message">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('barang.update', $barang->id_barang) }}" method="POST">
            @csrf
            @method('PUT')
            <label for="nama_barang">Nama Barang:</label>
            <input type="text" name="nama_barang" value="{{ $barang->nama_barang }}" required>

            <label for="kategori">Kategori:</label>
            <input type="text" name="kategori" value="{{ $barang->kategori }}" required>
            
            <label for="stok">Stok:</label>
            <input type="number" name="stok" value="{{ $barang->stok }}" required>
            
            <label for="kondisi">Kondisi:</label>
            <select name="kondisi" id="kondisi" required>
                <option value="cacat" {{ $barang->kondisi == 'cacat' ? 'selected' : '' }}>Cacat</option>
                <option value="tidak cacat" {{ $barang->kondisi == 'tidak cacat' ? 'selected' : '' }}>Tidak Cacat</option>
            </select>

            <button type="submit">Update</button>
        </form>
        
        <a href="{{ route('barang.index') }}" class="back-link">&#8592; Kembali</a>
    </div>
</body>
</html>