<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Denda</title>
    <style>
        /* Styling untuk keseluruhan halaman */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        h1 {
            text-align: center;
            margin-top: 20px;
            font-size: 24px;
        }

        .container {
            width: 80%;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        td {
            background-color: #fafafa;
        }

        /* Button Styling */
        .btn {
            display: inline-block;
            padding: 10px 15px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
            font-size: 16px;
        }

        .btn:hover {
            background-color: #45a049;
        }

        /* Print Styling */
        @media print {
            body {
                background-color: white;
            }

            .container {
                width: 100%;
                padding: 10px;
            }

            .btn {
                display: none;
            }

            h1 {
                font-size: 26px;
            }

            table th, table td {
                padding: 8px;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Detail Denda</h1>

        <table>
            <tr>
                <th>ID Denda</th>
                <td>{{ $denda->id_denda }}</td>
            </tr>
            <tr>
                <th>Peminjaman ID</th>
                <td>{{ $denda->id_peminjaman }}</td>
            </tr>
            <tr>
                <th>Jumlah Denda</th>
                <td>{{ $denda->jumlah_denda }}</td>
            </tr>
            <tr>
                <th>Status</th>
                <td>{{ $denda->status }}</td>
            </tr>
        </table>

        <a href="{{ route('denda.index') }}" class="btn">Back to Denda List</a>
    </div>

</body>
</html>
