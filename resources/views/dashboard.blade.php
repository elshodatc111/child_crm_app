<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
    <h2>Xush kelibsiz, {{ Auth::user()->name }}</h2>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Chiqish (Logout)</button>
    </form>
</body>
</html>
