<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home Wallet</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }} ">
</head>
<body class="bg-gray-100">

        @include('layout.nav')

    <div class="container mx-auto">
        @yield('content')
    </div>
</body>
</html>
