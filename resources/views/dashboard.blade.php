<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #fff8e1;
            overflow: hidden;
            position: relative;
        }

        .background-frame {
            position: relative;
            width: 100%;
            height: 100%;
            padding-top: 56.2500%;
            overflow: hidden;
            box-shadow: 0 2px 8px 0 rgba(63, 69, 81, 0.16);
            margin-top: 1.6em;
            margin-bottom: 0.9em;
            border-radius: 8px;
        }

        .background-frame iframe {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            border: none;
            padding: 0;
            margin: 0;
        }

        .auth-buttons {
            position: absolute;
            top: 20px;
            right: 20px;
            display: flex;
            gap: 15px;
        }

        .auth-buttons a {
            text-decoration: none;
            background-color: #6d4c41;
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: bold;
            transition: all 0.3s;
        }

        .auth-buttons a:hover {
            background-color: #5d4037;
        }
    </style>
</head>
<body>

    <!-- Canva Design Embed -->
    <div class="background-frame">
        <iframe loading="lazy" 
                src="https://www.canva.com/design/DAGfLGdJOfQ/bi-8CCHdQf3Ybt9lIPVp_w/view?embed" 
                allowfullscreen="allowfullscreen" 
                allow="fullscreen">
        </iframe>
    </div>

    <!-- Login and Register buttons -->
    <div class="auth-buttons">
        <a href="{{ route('login') }}">Login</a>
        <a href="{{ route('register') }}">Register</a>
    </div>

</body>
</html>