<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Denda</title>
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
            padding: 10px 16px;
            border-radius: 10px;
            text-decoration: none;
            font-weight: bold;
            font-size: 16px;
            transition: all 0.3s;
            display: inline-block;
            text-align: center;
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
        .search-container {
            display: flex;
            justify-content: flex-end;
            gap: 15px;
            margin-top: 20px;
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
        .btn-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
            width: 100%; /* Memastikan tombol berada dalam satu baris */
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
        <h2 style="text-align: center; color: #6d4c41;">Daftar Denda</h2>
        
        @if(session('success'))
            <div style="background-color: #ffe0b2; color: #6d4037; padding: 10px; border-radius: 8px; text-align: center; margin-bottom: 20px;">
                {{ session('success') }}
            </div>
        @elseif(session('error'))
            <div style="background-color: #FFCDD2; color: #C62828; padding: 10px; border-radius: 8px; text-align: center; margin-bottom: 20px;">
                {{ session('error') }}
            </div>
        @endif

        <div class="btn-container">
            <div class="search-container">
                <form action="{{ route('denda.index') }}" method="GET">
                    <input type="text" name="search" placeholder="Cari denda..." value="{{ request('search') }}">
                    <button type="submit" class="btn">🔍 Cari</button>
                </form>
                <a href="{{ route('denda.print', ['query' => request('search') ?? '']) }}" class="btn">🖨️ Print</a>
            </div>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID Peminjaman</th>
                        <th>Nama Siswa</th>
                        <th>Nama Buku</th>
                        <th>Jumlah Denda</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($denda as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->id_peminjaman }}</td>
                            <td>{{ $item->siswa->nisn ?? 'nan' }}</td>
                            <td>{{ $item->barang->nama_barang ?? 'nan'}}</td>
                            <td>{{ number_format($item->jumlah_denda, 0, ',', '.') }}</td>
                            <td>{{ $item->status }}</td>
                            <td style="display: flex; gap: 10px; justify-content: center;">
    <!-- Tombol Hapus -->
    <form action="{{ route('denda.destroy', $item->id_denda) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" onclick="return confirm('Yakin ingin menghapus?')" class="btn">🗑️ Hapus</button>
    </form>
    
    <!-- Tombol Bayar -->
    @if($item->status == 'belum dibayar')
        <a href="{{ route('denda.bayarDenda', $item->id_denda) }}" class="btn">Bayar</a>
    @endif
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