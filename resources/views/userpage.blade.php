@extends('layouts.template')

@section('title', "{$user->name}のページ")
@section('content')
    <div class="text-gray-600 body-font">
        <div class="container mx-auto flex flex-wrap p-5 flex-col md:flex-row items-center">
            <a class="flex title-font font-medium items-center text-gray-900 mb-4 md:mb-0">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-linecap="round"
                    stroke-linejoin="round" stroke-width="2" class="w-10 h-10 text-white p-2 bg-indigo-500 rounded-full"
                    viewBox="0 0 24 24">
                    <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path>
                </svg>
                <span class="ml-3 text-xl">{{ $user->name }}</span>
            </a>
            <nav
                class="md:mr-auto md:ml-4 md:py-1 md:pl-4 md:border-l md:border-gray-400 flex flex-wrap items-center text-base justify-center">
                <a href="{{ route('userpage', ['id' => $user->id]) }}"
                    class="mr-1 text-white bg-gray-600 border-0 py-1 px-3 rounded">書いた記事</a>
                <a href="{{ route('userBookmarks', ['id' => $user->id]) }}"
                    class="mr-1 text-gray-900 hover:bg-gray-200 border-0 py-1 px-3 rounded">ブックマークした記事</a>
                <a href="{{ route('userFollowing', ['id' => $user->id]) }}"
                    class="mr-1 text-gray-900 hover:bg-gray-200 border-0 py-1 px-3 rounded">フォロー</a>
                <a class="mr-1 text-gray-900 hover:bg-gray-200 border-0 py-1 px-3 rounded">フォロワー</a>
                <a class="mr-1 text-gray-900 hover:bg-gray-200 border-0 py-1 px-3 rounded">設定</a>
            </nav>
            @if (Auth::check() and !($user->id === Auth::id()))
                <form method="POST">
                    @csrf
                    @if ($user->user_followers_count > 0)
                        <button name="following_id" formaction="{{ route('unfollow') }}"
                            class="py-1 px-2 bg-red-500 rounded text-white" value="{{ $user->id }}">フォローを外す</button>
                    @else
                        <button name="following_id" formaction="{{ route('follow') }}"
                            class="py-1 px-2 bg-blue-500 rounded text-white" value="{{ $user->id }}">フォロー</button>
                    @endif
                </form>
            @else
                <div>
                    <button class="cursor-not-allowed text-white bg-gray-400 rounded py-1 px-4" disabled>フォロー</button>
                </div>
            @endif
        </div>
    </div>

    <section class="text-gray-600 body-font overflow-hidden">
        <div class="container px-5 py-8 mx-auto">
            <div class="-my-8 divide-y-2 divide-gray-100">
                @foreach ($articles as $article)
                    <div class="py-8 flex flex-wrap md:flex-nowrap">
                        <div class="md:w-64 md:mb-0 mb-6 flex-shrink-0 flex flex-col">
                            <span class="font-semibold title-font text-gray-700 hover:underline">
                                <a
                                    href="{{ route('userpage', ['id' => $article->user->id]) }}">{{ $article->user->name }}</a>
                            </span>
                            <span class="mt-1 text-gray-400 inline-flex items-center leading-none text-sm pb-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                                </svg>{{ $article->category->category_name }}
                            </span>
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
                                    <a
                                        href="{{ route('articles', ['id' => $article->id]) }}">{{ $article->title }}</a>
                                </h2>
                                @if (Auth::check() and !($article->user_id === Auth::id()))
                                    <form method="POST">
                                        @csrf
                                        @if ($article->bookmark_count > 0)
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
        </div>
    </section>
@endsection
