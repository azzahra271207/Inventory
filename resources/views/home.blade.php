<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
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

        .header {
            text-align: center;
            margin: 20px 0;
            width: 100%;
        }

        h2 {
            color: #6d4c41;
            font-size: 32px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .navbar {
            width: 100%;
            display: flex;
            justify-content: flex-end;
            padding: 10px 20px;
            background-color: #ffe0b2; /* Warna navbar */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .logout-btn {
            background-color: #6d4c41;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            text-decoration: none;
            margin-left: 20px;
        }

        .logout-btn:hover {
            background-color: #5d4037;
        }

        .container {
            width: 80%;
            max-width: 1200px;
            margin-top: 20px;
            padding: 20px;
            background-color: #ffe0b2; /* Warna container */
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            gap: 20px;
        }

        .card {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
            flex: 1 1 23%;
            box-sizing: border-box;
            transition: transform 0.3s;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            min-height: 250px;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card h3 {
            color: #6d4c41;
            margin-bottom: 10px;
        }

        .card p {
            margin-bottom: 20px;
        }

        .btn {
            background-color: #6d4c41;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            text-decoration: none;
            margin-top: auto;
            width: 100%;
            box-sizing: border-box;
        }

        .btn:hover {
            background-color: #5d4037;
        }

        .footer {
            background-color: #ffe0b2; /* Ubah warna footer agar sama dengan navbar */
            color: #6d4c41; /* Ubah warna teks footer */
            text-align: center;
            padding: 15px;
            width: 100%;
            margin-top: auto;
            position: relative;
            bottom: 0;
        }
    </style>
</head>
<body>
    <div class="navbar">
        @if (Auth::check())
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="logout-btn">Logout</button>
            </form>
        @endif
    </div>
    <div class="header">
        <h2>Home</h2>
        @if (Auth::check())
            <div class="welcome-message">
                Selamat datang, {{ Auth::user()->name }}!
            </div>
        @else
            <p>Anda belum login.</p>
        @endif
    </div>
    <div class="container">
        <div class="card">
            <h3>Barang</h3>
            <p>Kelola daftar barang yang tersedia di sistem Anda.</p>
            <a href="{{ route('barang.index') }}" class="btn">Akses Barang</a>
        </div>
        <div class="card">
            <h3>Siswa</h3>
            <p>Kelola data siswa yang tersedia disistem ini.</p>
            <a href="{{ route('siswa.index') }}" class="btn">Akses Siswa</a>
        </div>
        <div class="card">
            <h3>Peminjaman</h3>
            <p>Kelola proses peminjaman barang oleh siswa.</p>
            <a href="{{ route('peminjaman.index') }}" class="btn">Akses Peminjaman</a>
        </div>
    </div>
    <footer class="footer">
        &copy; 2025 Sistem Inventory Perpustakaan 
    </footer>
</body>
</html>