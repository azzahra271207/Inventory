<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Denda</title>
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
            margin-bottom: 20px;
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
            display: inline-block;
            text-align: center;
        }
        .back-button:hover {
            background-color: #5d4037;
        }
        /* Hide the back button when printing */
        @media print {
            .back-button {
                display: none;
            }
        }
    </style>
</head>
<body>
    <h2>Daftar Denda</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>ID Peminjaman</th>
                <th>Nama Siswa</th>
                <th>Nama Buku</th>
                <th>Jumlah Denda</th>
                <th>Keterangan</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($denda as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->peminjaman->id_peminjaman }}</td>
                    <td>{{ $item->siswa->nama_siswa }}</td>
                    <td>{{ $item->barang->nama_barang }}</td>
                    <td>{{ number_format($item->jumlah_denda, 0, ',', '.') }}</td>
                    <td>{{ $item->keterangan }}</td>
                    <td>{{ $item->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('denda.index') }}" class="back-button">Kembali</a>
    <script>
        window.print();
    </script>
</body>
</html>
