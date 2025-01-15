<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>

<body>
    <h1>Register</h1>
    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li style="color:red;">{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    <form method="POST" action="/register">
        @csrf
        <label for="user_nama">Nama Pengguna:</label>
        <input type="text" id="user_nama" name="user_nama" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <label for="hak_akses">Hak Akses:</label>
        <select id="hak_akses" name="hak_akses" required>
            <option value="">Pilih Hak Akses</option>
            <option value="Su">Super User</option>
            <option value="admin">Admin</option>
            <option value="user">Operator</option>
        </select>
        <br>
        <button type="submit">Register</button>
    </form>
</body>

</html>
