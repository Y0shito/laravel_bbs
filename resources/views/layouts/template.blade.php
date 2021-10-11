<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div class="text-center mt-10">
        <p class="text-xs">fontの大きさ</p>
        <p class="text-sm">fontの大きさ</p>
        <p class="text-base">fontの大きさ</p>
        <p class="text-lg">fontの大きさ</p>
        <p class="text-xl">fontの大きさ</p>
        <p class="text-2xl">fontの大きさ</p>
        <p class="text-3xl">fontの大きさ</p>
        <p class="text-4xl">fontの大きさ</p>
        <p class="text-5xl">fontの大きさ</p>
        <p class="text-6xl">fontの大きさ</p>
    </div>
</body>

</html>
