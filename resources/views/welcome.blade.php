<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
    <title>Laravel</title>
    <style>
        .mask {
            background-color: rgba(0, 0, 0, 0.3);
            z-index: 9999999;
        }
    </style>
</head>

<body class="antialiased">

    <div id="app">
        <example-component></example-component>
    </div>
    <script src="{{ mix('/js/app.js') }}"></script>
</body>

</html>