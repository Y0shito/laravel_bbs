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
                class="{{ \Route::is('userpage') ? 'text-white bg-gray-600' : 'text-gray-900 hover:bg-gray-200' }} border-0 py-1 px-3 rounded mr-1">
                書いた記事</a>
            <a href="{{ route('userBookmarks', ['id' => $user->id]) }}"
                class="{{ \Route::is('userBookmarks') ? 'text-white bg-gray-600' : 'text-gray-900 hover:bg-gray-200' }} border-0 py-1 px-3 rounded mr-1">ブックマークした記事</a>
            <a href="{{ route('userFollowing', ['id' => $user->id]) }}"
                class="{{ \Route::is('userFollowing') ? 'text-white bg-gray-600' : 'text-gray-900 hover:bg-gray-200' }} border-0 py-1 px-3 rounded mr-1">フォロー</a>
            <a href="{{ route('userFollowers', ['id' => $user->id]) }}"
                class="{{ \Route::is('userFollowers') ? 'text-white bg-gray-600' : 'text-gray-900 hover:bg-gray-200' }} border-0 py-1 px-3 rounded mr-1">フォロワー</a>
            @if ($isMyPage)
                <a href="{{ route('userSettings', ['id' => $user->id]) }}"
                    class="{{ \Route::is('userSettings') ? 'text-white bg-gray-600' : 'text-gray-900 hover:bg-gray-200' }} border-0 py-1 px-3 rounded mr-1">設定</a>
            @endif
        </nav>
        @if (!empty($user->url))
            <a href="{{ $user->url }}" class="mr-4 text-gray-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M12.586 4.586a2 2 0 112.828 2.828l-3 3a2 2 0 01-2.828 0 1 1 0 00-1.414 1.414 4 4 0 005.656 0l3-3a4 4 0 00-5.656-5.656l-1.5 1.5a1 1 0 101.414 1.414l1.5-1.5zm-5 5a2 2 0 012.828 0 1 1 0 101.414-1.414 4 4 0 00-5.656 0l-3 3a4 4 0 105.656 5.656l1.5-1.5a1 1 0 10-1.414-1.414l-1.5 1.5a2 2 0 11-2.828-2.828l3-3z"
                        clip-rule="evenodd" />
                </svg>
            </a>
        @endif
        <a href="https://twitter.com/intent/user?user_id={{ $user->twitter_id }}" class="mr-4 text-gray-500">
            <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                class="w-5 h-5" viewBox="0 0 24 24">
                <path
                    d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z">
                </path>
            </svg>
        </a>
        </span>
        @if (Auth::check() and !$isMyPage)
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
    @if (!empty($user->introduction))
        <div class="container mx-auto bg-gray-100 text-gray-700 p-4 rounded">
            <p>{{ $user->introduction }}</p>
        </div>
    @endif
</div>
