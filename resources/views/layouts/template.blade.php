<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <header class="text-gray-600 body-font bg-white sticky top-0 shadow-md">
        <div class="container mx-auto flex flex-wrap px-5 py-2 flex-col md:flex-row items-center">
            <a href="{{ route('index') }}" class="flex title-font font-medium items-center text-gray-900 mb-4 md:mb-0">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-linecap="round"
                    stroke-linejoin="round" stroke-width="2" class="w-10 h-10 text-white p-2 bg-indigo-500 rounded-full"
                    viewBox="0 0 24 24">
                    <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path>
                </svg>
                <span class="ml-3 text-xl">BBS</span>
            </a>
            <nav class="md:ml-auto flex flex-wrap items-center text-base justify-center">
                <a href="{{ route('search') }}" class="mr-1 hover:bg-gray-200 border-0 py-1 px-3 rounded">検索</a>
                @auth
                    <a href="{{ route('twitter-logout') }}"
                        class="mr-1 hover:bg-gray-200 border-0 py-1 px-3 rounded">ログアウト</a>
                    <a href="{{ route('create') }}" class="mr-1 hover:bg-gray-200 border-0 py-1 px-3 rounded">記事作成</a>
                @endauth
            </nav>
            @guest
                <a href="{{ route('twitter-login') }}"
                    class="inline-flex items-center bg-blue-400 border-0 py-1 px-3 focus:outline-none hover:bg-blue-300 rounded text-white mt-4 md:mt-0">twitterログイン
                </a>
            @endguest
            @auth
                <a href="{{ route('userpage', ['id' => Auth::id()]) }}"
                    class="inline-flex items-center bg-indigo-500 border-0 py-1 px-3 focus:outline-none hover:bg-indigo-300 rounded text-white mt-4 md:mt-0">マイページ
                </a>
            @endauth
        </div>
    </header>

    @if (session()->has('class'))
        <div class="{{ session('class') }}">
            <p class="container mx-auto px-5 py-4">
                {{ session('message') }}
            </p>
        </div>
    @endif

    @yield('content')

    <footer class="text-gray-600 body-font">
        <div class="container px-5 py-8 mx-auto flex items-center sm:flex-row flex-col">
            <a href="{{ route('index') }}"
                class="flex title-font font-medium items-center md:justify-start justify-center text-gray-900">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-linecap="round"
                    stroke-linejoin="round" stroke-width="2" class="w-10 h-10 text-white p-2 bg-indigo-500 rounded-full"
                    viewBox="0 0 24 24">
                    <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path>
                </svg>
                <span class="ml-3 text-xl">BBS</span>
            </a>
            <p class="text-sm text-gray-500 sm:ml-4 sm:pl-4 sm:border-l-2 sm:border-gray-200 sm:py-2 sm:mt-0 mt-4">©
                2021 BBS
                <a href="https://twitter.com/Y0sh1tyan" class="text-gray-600 ml-1" rel="noopener noreferrer"
                    target="_blank">@4410</a>
            </p>
            <span class="inline-flex sm:ml-auto sm:mt-0 mt-4 justify-center sm:justify-start">
                <a class="ml-3 text-gray-500">
                    <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        class="w-5 h-5" viewBox="0 0 24 24">
                        <path
                            d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z">
                        </path>
                    </svg>
                </a>
            </span>
        </div>
    </footer>
</body>

</html>
