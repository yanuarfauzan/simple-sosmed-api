<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Email Verifikasi</title>
</head>
<body>
    <strong>Klik link dibawah ini untuk verifikasi email</strong>
    <a href="{{url('/register'). '/'. $token_verify}}"><p>klik disini</p></a>
</body>
</html>