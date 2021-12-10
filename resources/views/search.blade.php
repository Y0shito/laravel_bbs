@extends('layouts.template')

@section('title', '検索')

@section('content')
    <section class="text-gray-600 body-font">
        <div class="container px-5 py-8 mx-auto">
            <form method="GET" action="{{ route('search') }}" class="flex justify-center">
                <input type="text" name="search" placeholder="検索語句を入力" value="{{ isset($words) ? $words : '' }}"
                    class="w-2/4 mr-2 bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                <button
                    class="text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">
                    検索
                </button>
            </form>
            @isset($articles)
                <div class="flex justify-between border-b-2 my-8">
                    <h1 class="text-xl text-gray-600">「{{ $words }}」の検索結果</h1>
                </div>
                <div class="-my-8 divide-y-2 divide-gray-100">
                    @foreach ($articles as $article)
                        <div class="py-8 flex flex-wrap md:flex-nowrap">
                            <div class="md:w-64 md:mb-0 mb-6 flex-shrink-0 flex flex-col">
                                <span
                                    class="font-semibold title-font text-gray-700 hover:underline">{{ $article->user->name }}</span>
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
                            </div>
                            <div class="md:flex-grow">
                                <div class="flex justify-between">
                                    <h2 class="text-2xl font-medium text-gray-900 title-font mb-2 hover:underline">
                                        <a href="{{ route('articles', ['id' => $article->id]) }}">{{ $article->title }}</a>
                                    </h2>
                                    @if (Auth::check() and !($article->user_id === Auth::id()))
                                        <form method="POST">
                                            @csrf
                                            @if ($article->bookmark()->where('user_id', Auth::id())->exists())
                                                <button name="article_id" formaction="{{ route('bookmarkRemove') }}"
                                                    class="py-1 px-2 bg-blue-500 rounded text-white"
                                                    value="{{ $article->id }}">ブックマーク中</button>
                                            @else
                                                <button name="article_id" formaction="{{ route('bookmarkAdd') }}"
                                                    class="border-2 border-blue-500 text-blue-500 py-1 px-2 hover:bg-blue-500 rounded hover:text-white"
                                                    value="{{ $article->id }}">ブックマーク</button>
                                            @endif
                                        </form>
                                    @else
                                        <div>
                                            <button class="cursor-not-allowed text-white bg-gray-400 rounded py-1 px-4"
                                                disabled>ブックマーク</button>
                                        </div>
                                    @endif
                                </div>
                                <p class="leading-relaxed">{{ $article->body }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
                {{ $articles->appends(['search' => $words])->links() }}
            @endisset
            @empty($articles)
                <div class="text-center my-8">
                    <p class="text-gray-500 mb-8">検索は記事のタイトルから検索されます</p>
                    <p class="text-gray-500 mb-2">単語に空白を挟むと、最大5個まで複数の単語で検索出来ます</p>
                    <p class="text-gray-500 mb-8">例：「◯◯◯　✗✗✗」→　◯◯◯と✗✗✗を含む記事を検索</p>
                    <p class="text-gray-500 mb-2">また単語の頭にハイフン記号をつけると、その語句を含む記事を除外します</p>
                    <p class="text-gray-500">例：「◯◯◯　-✗✗✗」→　◯◯◯を含む記事の中から、✗✗✗を含む記事を除外して検索</p>
                </div>
            @endempty
        </div>
    </section>
@endsection
