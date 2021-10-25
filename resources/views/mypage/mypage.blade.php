@extends('layouts.template')

@section('title', 'マイページ')
@section('content')
    <div class="text-gray-600 body-font">
        <div class="container mx-auto flex flex-wrap p-5 flex-col md:flex-row items-center">
            <a class="flex title-font font-medium items-center text-gray-900 mb-4 md:mb-0">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-linecap="round"
                    stroke-linejoin="round" stroke-width="2" class="w-10 h-10 text-white p-2 bg-indigo-500 rounded-full"
                    viewBox="0 0 24 24">
                    <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path>
                </svg>
                <span class="ml-3 text-xl">{{ Auth::user()->name }}</span>
            </a>
            <nav
                class="md:mr-auto md:ml-4 md:py-1 md:pl-4 md:border-l md:border-gray-400	flex flex-wrap items-center text-base justify-center">
                <a class="mr-5 text-white bg-gray-600 border-0 py-1 px-3 rounded">書いた記事</a>
                <a class="mr-5 hover:text-gray-900">ブックマークした記事</a>
                <a class="mr-5 hover:text-gray-900">フォロー</a>
                <a class="mr-5 hover:text-gray-900">フォロワー</a>
                <a class="mr-5 hover:text-gray-900">設定</a>
            </nav>
        </div>
    </div>

    <section class="text-gray-600 body-font overflow-hidden">
        <div class="container px-5 py-8 mx-auto">
            <div class="-my-8 divide-y-2 divide-gray-100">
                @foreach ($articles as $article)
                    <div class="py-8 flex flex-wrap md:flex-nowrap">
                        <div class="md:w-64 md:mb-0 mb-6 flex-shrink-0 flex flex-col">
                            <span class="font-semibold title-font text-gray-700"></span>
                            <span class="mt-1 text-gray-500 text-sm">{{ $article->created_at->format('Y年m月d日') }}</span>
                            <span
                                class="text-gray-400 mr-3 inline-flex items-center leading-none text-sm pr-3 py-1 border-gray-200">
                                <svg class="w-4 h-4 mr-1" stroke="currentColor" stroke-width="2" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>{{ $article->views }}
                            </span>
                            <span class="text-gray-400 inline-flex items-center leading-none text-sm">
                                <svg class="w-4 h-4 mr-1" stroke="currentColor" stroke-width="2" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                    <path
                                        d="M21 11.5a8.38 8.38 0 01-.9 3.8 8.5 8.5 0 01-7.6 4.7 8.38 8.38 0 01-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 01-.9-3.8 8.5 8.5 0 014.7-7.6 8.38 8.38 0 013.8-.9h.5a8.48 8.48 0 018 8v.5z">
                                    </path>
                                </svg>{{ $article->bookmarks }}
                            </span>
                            <form method="POST">
                                @csrf
                                @if ($article->public_status === \App\Enums\Publicstatus::OPEN)
                                    <button value="{{ $article->id }}" name="id"
                                        formaction="{{ route('articleClose') }}"
                                        class="text-white bg-gray-600 hover:bg-gray-400 border-0 px-3 py-1 mt-1 rounded">非公開にする</button>
                                @else
                                    <button value="{{ $article->id }}" name="id" formaction="{{ route('articleOpen') }}"
                                        class="text-white bg-green-400 hover:bg-green-200 border-0 px-3 py-1 mt-1 rounded">公開する</button>
                                @endif
                                <button value="{{ $article->id }}" name="id" formaction="{{ route('edit') }}"
                                    class="text-white bg-blue-500 hover:bg-blue-400 border-0 px-3 py-1 mt-1 rounded">編集</button>
                                <button value="{{ $article->id }}" name="id" formaction="{{ route('articleDelete') }}"
                                    class="text-white bg-red-600 hover:bg-red-400 border-0 px-3 py-1 mt-1 rounded">削除</button>
                            </form>
                        </div>
                        <div class="md:flex-grow">
                            <h2 class="text-2xl font-medium text-gray-900 title-font mb-2">{{ $article->title }}</h2>
                            <p class="leading-relaxed">{{ $article->body }}</p>
                            <a class="text-indigo-500 inline-flex items-center mt-4">記事を見る
                                <svg class="w-4 h-4 ml-2" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"
                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M5 12h14"></path>
                                    <path d="M12 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <a href="{{ route('edit') }}">edit</a>
    </section>
@endsection
