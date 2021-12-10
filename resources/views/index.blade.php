@extends('layouts.template')

@section('title', 'BBS')

@section('content')
    <section class="text-gray-600 body-font overflow-hidden">
        <div class="container px-5 py-8 mx-auto">
            <div class="-my-8 divide-y-2 divide-gray-100">
                @foreach ($articles as $article)
                    <div class="py-8 flex flex-wrap md:flex-nowrap">
                        <div class="md:w-64 md:mb-0 mb-6 flex-shrink-0 flex flex-col">
                            <span
                                class="font-semibold title-font text-gray-700 hover:underline">{{ $article->user->name }}</span>
                            <span class="mt-1 text-gray-400 inline-flex items-center leading-none text-sm pb-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                                {{ $article->created_at->format('Y年m月d日') }}
                            </span>
                            @isset($article->updated_at)
                                <span class="text-gray-400 inline-flex items-center leading-none text-sm pb-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                    </svg>
                                    {{ $article->updated_at->format('Y年m月d日') }}
                                </span>
                            @endisset
                            <span class="text-gray-400 mr-3 inline-flex items-center leading-none text-sm pb-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>{{ $article->views }}
                            </span>
                            <span class="text-gray-400 inline-flex items-center leading-none text-sm pb-1">
                                <svg class="w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
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
            {{ $articles->links() }}
        </div>
    </section>
@endsection
