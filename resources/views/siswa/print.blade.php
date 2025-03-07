<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Data Siswa</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 20px;
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
            background-color: #ffe0b2;
            color: #5d4037;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
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
        }
        .back-button:hover {
            background-color: #5d4037;
        }
        @media print {
            .back-button {
                display: none; /* Menyembunyikan tombol saat print */
            }
        }
    </style>
</head>
<body>
    <h2>Data Siswa</h2>
    <table>
        <tr>
            <th>NISN</th>
            <th>Nama Siswa</th>
            <th>Kelas</th>
            <th>Jurusan</th>
        </tr>
        @foreach ($siswa as $item)
        <tr>
            <td>{{ $item->nisn }}</td>
            <td>{{ $item->nama_siswa }}</td>
            <td>{{ $item->kelas }}</td>
            <td>{{ $item->jurusan }}</td>
        </tr>
        @endforeach
    </table>
    <a href="{{ route('siswa.index', ['search' => $query ?? '']) }}" class="back-button">Kembali</a>
    <script>
        window.print();
    </script>
</body>
</html>