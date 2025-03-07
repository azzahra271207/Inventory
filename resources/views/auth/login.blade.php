<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #fff8e1;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            width: 100%;
            max-width: 400px;
            padding: 30px;
            background-color: #ffe0b2;
            border-radius: 12px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        h2 {
            color: #6d4c41;
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 15px;
        }
        .notification {
            background-color: #ffcc80;
            color: #6d4c41;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 15px;
            font-size: 14px;
        }
        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        input[type="email"], input[type="password"] {
            padding: 12px;
            border: 1px solid #6d4c41;
            border-radius: 8px;
            outline: none;
            font-size: 16px;
            width: calc(100% - 24px);
            margin: auto;
        }
        button {
            background-color: #6d4c41;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s;
            font-weight: bold;
            font-size: 16px;
        }
        button:hover {
            background-color: #5d4037;
        }
        p {
            margin-top: 15px;
            font-size: 14px;
        }
        a {
            color: #6d4c41;
            text-decoration: none;
            font-weight: bold;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        @if (session('success'))
            <div class="notification">{{ session('success') }}</div>
        @endif
        @if ($errors->any())
            <div class="notification" style="color: red;">{{ $errors->first() }}</div>
        @endif
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
        <p> Belum punya akun?  <a href="{{ route('register') }}">Register here</a></p>
    </div>
</body>
</html>