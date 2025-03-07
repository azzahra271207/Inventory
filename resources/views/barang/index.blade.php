<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Barang</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #fff8e1;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
        }
        .navbar {
            background-color: #ffe0b2;
            padding: 15px 0;
            display: flex;
            gap: 25px;
            justify-content: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            position: relative;
        }
        .navbar a {
            color: #5d4037;
            text-decoration: none;
            font-weight: bold;
            font-size: 16px;
            padding: 12px 20px;
            border-radius: 20px;
            transition: all 0.3s;
        }
        .navbar a:hover {
            background-color: #6d4c41;
            color: white;
        }
        .back-btn {
            position: absolute;
            left: 15px;
            bottom: -80px;
            background-color: #ffe0b2;
            color: white;
            padding: 6px 16px;
            border-radius: 8px;
            font-weight: bold;
            font-size: 14px;
        }
        .container {
            width: 80%;
            margin: 40px 0;
            flex: 1;
        }
        .btn {
            background-color: #6d4c41;
            color: white;
            padding: 8px 15px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            transition: all 0.3s;
        }
        .btn:hover {
            background-color: #5d4037;
        }
        .table-container {
            overflow-x: auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 15px;
            text-align: center;
            border: 1px solid #6d4c41;
        }
        th {
            background-color: #ffe0b2;
            color: #5d4037;
        }
        tr:hover {
            background-color: #ffccbc;
        }
        .footer {
            width: 100%;
            background-color: #ffe0b2;
            text-align: center;
            padding: 15px 0;
            font-weight: bold;
            color: #5d4037;
            margin-top: auto;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <a href="{{ route('barang.index') }}">📦 Barang</a>
        <a href="{{ route('siswa.index') }}">👨‍🎓 Siswa</a>
        <a href="{{ route('peminjaman.index') }}">📚 Peminjaman</a>
        <a href="{{ route('home') }}" class="back-btn">🏠 Kembali</a>
    </div>
    <div class="container">
        <h2 style="text-align: center; color: #6d4c41;">Data Barang</h2>
        @if(session('success'))
            <div style="background-color: #ffe0b2; color: #6d4c41; padding: 10px; border-radius: 8px; text-align: center; margin-bottom: 20px;">
                {{ session('success') }}
            </div>
        @elseif(session('error'))
            <div style="background-color: #FFCDD2; color: #C62828; padding: 10px; border-radius: 8px; text-align: center; margin-bottom: 20px;">
                {{ session('error') }}
            </div>
        @endif

        <div class="search-container" style="display: flex; justify-content: space-between; margin-bottom: 20px;">
            <a href="{{ route('barang.create') }}" class="btn">➕ Tambah Barang</a>
            <form action="{{ route('barang.index') }}" method="GET" style="display: flex; gap: 10px;">
                <input type="text" name="search" placeholder="Cari barang..." value="{{ request('search') }}" style="padding: 12px; border: 1px solid #6d4c41; border-radius: 8px; width: 250px; outline: none;">
                <button type="submit" class="btn">🔍 Cari</button>
                <a href="{{ route('barang.print', ['query' => request('search') ?? '']) }}" class="btn">🖨️ Print</a>
            </form>
        </div>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>Stok</th>
                        <th>Kondisi</th> <!-- Perbaiki penulisan 'kondisi' -->
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($barang as $item)
                        <tr>
                            <td>{{ $item->id_barang }}</td>
                            <td>{{ $item->nama_barang }}</td>
                            <td>{{ $item->kategori }}</td>
                            <td>{{ $item->stok }}</td>
                            <td>{{ $item->kondisi }}</td> <!-- Pastikan ini sesuai dengan nama kolom di database -->
                            <td>
                                <a href="{{ route('barang.edit', $item->id_barang) }}" class="btn">✏️ Edit</a>
                                <form action="{{ route('barang.destroy', $item->id_barang) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Yakin ingin menghapus?')" class="btn">🗑️ Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="footer">
        &copy; 2025 Sistem Inventory Perpustakaan  
    </div>
</body>
</html>