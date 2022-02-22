@extends('layouts.template')

@section('settings', "{$user->name}の設定")
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
                    class="mr-1 text-gray-900 hover:bg-gray-200 border-0 py-1 px-3 rounded">書いた記事</a>
                <a href="{{ route('userBookmarks', ['id' => $user->id]) }}"
                    class="mr-1 text-gray-900 hover:bg-gray-200 border-0 py-1 px-3 rounded">ブックマークした記事</a>
                <a href="{{ route('userFollowing', ['id' => $user->id]) }}"
                    class="mr-1 text-gray-900 hover:bg-gray-200 border-0 py-1 px-3 rounded">フォロー</a>
                <a href="{{ route('userFollowers', ['id' => $user->id]) }}"
                    class="mr-1 text-gray-900 hover:bg-gray-200 border-0 py-1 px-3 rounded">フォロワー</a>
                @if ($isMyPage)
                    <a class="mr-1 text-white bg-gray-600 border-0 py-1 px-3 rounded">設定</a>
                @endif
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
    <form method="POST" action="{{ route('updateSettings', ['id' => $user->id]) }}">
        @csrf
        <section class="text-gray-600 body-font overflow-hidden">
            <div class="container px-5 py-8 mx-auto">
                <div class="lg:w-1/2 md:w-2/3 mx-auto">
                    <div class="flex flex-wrap -m-2">
                        <div class="p-2 w-full">
                            <div class="relative">
                                <div class="flex justify-between">
                                    <label for="introduction" class="leading-7 text-sm text-gray-600">自己紹介</label>
                                    @error('introduction')
                                        <span class="leading-7 text-sm text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>
                                <textarea name="introduction" placeholder="200文字以下で入力してください"
                                    class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out">{{ isset($user->introduction) ? $user->introduction : '' }}</textarea>
                            </div>
                        </div>
                        <div class="p-2 w-full">
                            <div class="relative">
                                <div class="flex justify-between">
                                    <label for="url" class="leading-7 text-sm text-gray-600">URL（自身のブログなど）</label>
                                    @error('url')
                                        <span class="leading-7 text-sm text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>
                                <input type="text" name="url" value="{{ isset($user->url) ? $user->url : '' }}"
                                    placeholder="例：https://exemple.com/"
                                    class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                            </div>
                        </div>
                        <div class="p-2 w-full flex align-center">
                            <button
                                class="mx-auto text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">確定</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </form>
@endsection
