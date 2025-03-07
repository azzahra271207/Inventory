<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Denda</title>
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
            width: 40%;
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
            width: 80%;
        }
        input[type="text"], input[type="number"] {
            padding: 12px;
            border: 1px solid #6d4c41;
            border-radius: 8px;
            outline: none;
            font-size: 16px;
            width: 80%;
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
            width: 80%;
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container">
        <h2>Tambah Denda</h2>
        
        @if (session('success'))
            <div class="message">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('denda.store') }}" method="POST">
            @csrf
            
            <label for="id_peminjaman">ID Peminjaman:</label>
            <select name="id_peminjaman" id="id_peminjaman" required>
                <option value="">Pilih Peminjaman</option>
                @foreach ($peminjaman as $p)
                    <option value="{{ $p->id_peminjaman }}">{{ $p->id_peminjaman }}</option>
                @endforeach
            </select>
            
            <label for="id_barang">ID Barang:</label>
            <input type="text" name="id_barang" id="id_barang" readonly>
            
            <label for="nisn">NISN:</label>
            <input type="text" name="nisn" id="nisn" readonly>
            
            <label for="jumlah_denda">Jumlah Denda:</label>
            <input type="number" name="jumlah_denda" id="jumlah_denda" required>
            
            <label for="status">Status:</label>
            <select name="status" id="status" required>
                <option value="belum dibayar">Belum Dibayar</option>
                <option value="sudah dibayar">Sudah Dibayar</option>
            </select>
            
            <button type="submit">Simpan</button>
        </form>
        
        <a href="{{ route('denda.index') }}" class="back-link">&#8592; Kembali</a>
    </div>

    <script>
        $(document).ready(function() {
            $('#id_peminjaman').change(function() {
                var idPeminjaman = $(this).val();
                if (idPeminjaman) {
                    $.ajax({
                        url: '/denda/get-peminjaman-data/' + idPeminjaman,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('#id_barang').val(data.id_barang);
                            $('#nisn').val(data.nisn);
                            $('#jumlah_denda').val(data.jumlah_pinjam * 2000); // Misal denda 2000 per hari
                        }
                    });
                } else {
                    $('#id_barang').val('');
                    $('#nisn').val('');
                    $('#jumlah_denda').val('');
                }
            });
        });
    </script>
</body>
</html>