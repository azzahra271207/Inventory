<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Print Data Peminjaman</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h2 {
            text-align: center;
            color: #6d4c41;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px; /* Menambahkan margin bawah untuk jarak dengan tombol */
        }
        th, td {
            padding: 8px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f4e1d2;
            color: #6d4c41;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1e0c6;
        }
        .back-button {
            background-color: #6d4c41;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            text-decoration: none;
            font-weight: bold;
            display: inline-block; /* Agar tombol tidak mengisi seluruh lebar */
            text-align: center;
        }
        .back-button:hover {
            background-color: #5d4037;
        }
        /* Menyembunyikan tombol Kembali pada saat mencetak */
        @media print {
            .back-button {
                display: none;
            }
        }
    </style>
</head>
<body>
    <h2>Data Peminjaman</h2>
    <table>
        <thead>
            <tr>
                <th>ID Peminjaman</th>
                <th>NISN</th>
                <th>Nama Siswa</th>
                <th>Nama Barang</th>
                <th>Jumlah Pinjam</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($peminjaman as $item)
                <tr>
                    <td>{{ $item->id_peminjaman }}</td>
                    <td>{{ $item->nisn }}</td>
                    <td>{{ $item->siswa->nama_siswa }}</td>
                    <td>{{ $item->barang->nama_barang }}</td>
                    <td>{{ $item->jumlah_pinjam }}</td>
                    <td>{{ $item->tanggal_pinjam }}</td>
                    <td>{{ $item->tanggal_kembali }}</td>
                    <td>{{ $item->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('peminjaman.index') }}" class="back-button">Kembali</a>
    <script>
        window.print();
    </script>
</body>
</html>