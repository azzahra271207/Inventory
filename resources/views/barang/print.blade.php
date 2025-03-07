<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Print Data Barang</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
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
    <h2>Detail Barang</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Nama Barang</th>
            <th>Kategori</th>
            <th>Stok</th>
            <th>Kondisi</th>
        </tr>
        @foreach ($barang as $item)
        <tr>
            <td>{{ $item->id_barang }}</td>
            <td>{{ $item->nama_barang }}</td>
            <td>{{ $item->kategori }}</td>
            <td>{{ $item->stok }}</td>
            <td>{{ $item->kondisi}}</td>
        </tr>
        @endforeach
    </table>
    <a href="{{ route('barang.index') }}" class="back-button">Kembali</a>
    <script>
        window.print();
    </script>
</body>
</html>