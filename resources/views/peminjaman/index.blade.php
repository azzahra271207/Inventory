<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Peminjaman</title>
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
        .container {
            width: 80%;
            margin: 40px 0;
            flex: 1;
            position: relative;
        }
        .btn {
            background-color: #6d4c41;
            color: white;
            padding: 8px 12px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            transition: all 0.3s;
            display: inline-block;
            text-align: center;
            font-size: 14px;
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
        .back-btn {
            position: absolute;
            left: 15px;
            bottom: -80px;
            background-color: #ffe0b2;
            color: white;
            padding: 6px 16px;
            border-radius: 7px;
            font-weight: bold;
            font-size: 14px;
        }
        .back-btn:hover {
            background-color: #6d4c41;
            color: white;
        }
        .search-container {
            display: flex;
            justify-content: flex-start;
            gap: 15px;
            margin-top: 20px;
        }
        .btn {
            background-color: #6d4c41;
            color: white;
            padding: 10px 16px;
            border-radius: 10px;
            text-decoration: none;
            font-weight: bold;
            font-size: 16px;
            transition: all 0.3s;
            display: inline-block;
            text-align: center;
        }

        .btn:hover {
            background-color: #5d4037;
        }

        .btn-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
        }

        .search-container {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .search-container input {
            padding: 10px 16px;
            font-size: 14px;
            border: 1px solid #6d4c41;
            border-radius: 5px;
            width: 250px;
        }

        .search-container button {
            padding: 8px 12px;
            font-size: 14px;
        }

        /* Perlebar kolom Aksi */
        th:nth-child(11), td:nth-child(11) {
            width: 200px;
            text-align: center;
        }

        /* Menyesuaikan ukuran tombol Edit dan Hapus */
        .btn {
            padding: 8px 16px;
            font-size: 14px;
        }

        /* Hover untuk tombol Edit dan Hapus */
        .btn:hover {
            background-color: #5d4037;
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
        <h2 style="text-align: center; color: #6d4c41;">Daftar Peminjaman</h2>
        @if(session('success'))
            <div style="background-color: #ffe0b2; color: #6d4c41; padding: 10px; border-radius: 8px; text-align: center; margin-bottom: 20px;">
                {{ session('success') }}
            </div>
        @elseif(session('error'))
            <div style="background-color: #FFCDD2; color: #C62828; padding: 10px; border-radius: 8px; text-align: center; margin-bottom: 20px;">
                {{ session('error') }}
            </div>
        @endif
        <div class="btn-container">
            <a href="{{ route('peminjaman.create') }}" class="btn">➕ Tambah Peminjaman</a>
            <div class="search-container">
                <form action="{{ route('peminjaman.index') }}" method="GET">
                    <input type="text" name="search" placeholder="Cari peminjaman..." value="{{ request('search') }}">
                    <button type="submit" class="btn">🔍 Cari</button>
                </form>
                <a href="{{ route('peminjaman.print', ['query' => request('search') ?? '']) }}" class="btn">🖨️ Print</a>
            </div>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID Peminjaman</th>
                        <th>NISN</th>
                        <th>Nama Siswa</th>
                        <th>Nama Buku</th>
                        <th>Jumlah Pinjam</th>
                        <th>Tanggal Pinjam</th>
                        <th>Tanggal Kembali</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($peminjaman as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->id_peminjaman }}</td>
                            <td>{{ $item->siswa->nisn }}</td>
                            <td>{{ $item->siswa->nama_siswa }}</td>
                            <td>{{ $item->barang->nama_barang }}</td>
                            <td>{{ $item->jumlah_pinjam}}</td>
                            <td>{{ $item->tanggal_pinjam }}</td>
                            <td>{{ $item->tanggal_kembali }}</td>
                            <td>{{ $item->status }}</td>
                            <td>
    <div style="display: flex; gap: 10px; justify-content: center;">
        <a href="{{ route('peminjaman.edit', $item->id_peminjaman) }}" class="btn">✏️ Edit</a>
        <form action="{{ route('peminjaman.destroy', $item->id_peminjaman) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" onclick="return confirm('Yakin ingin menghapus?')" class="btn">🗑️ Hapus</button>
        </form>
    </div>
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
