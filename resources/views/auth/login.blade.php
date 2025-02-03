<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f8ff;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-container {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px 30px;
            max-width: 400px;
            width: 100%;
        }

        .login-container h1 {
            text-align: center;
            color: #1e90ff;
            margin-bottom: 20px;
        }

        .login-container p {
            text-align: center;
            font-size: 14px;
        }

        .success-message {
            color: green;
        }

        .error-message {
            color: red;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        button {
            background-color: #1e90ff;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            width: 100%;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #1c86ee;
        }

        .footer {
            margin-top: 15px;
            text-align: center;
            font-size: 12px;
            color: #666;
        }

        .footer a {
            color: #1e90ff;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1>Login</h1>
        @if (session('message'))
            <p class="success-message">{{ session('message') }}</p>
        @endif
        @if ($errors->any())
            <p class="error-message">{{ $errors->first() }}</p>
        @endif
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <label for="user_nama">Nama Pengguna:</label>
            <input type="text" id="user_nama" name="user_nama" required>

            <label for="user_pass">Password:</label>
            <input type="password" id="user_pass" name="user_pass" required>

            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
