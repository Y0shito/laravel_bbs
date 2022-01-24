@extends('layouts.template')

@section('title', "{$user->name}がフォローしているユーザー")
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
                    class="mr-1 text-white bg-gray-600 border-0 py-1 px-3 rounded">フォロー</a>
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
        <div class="container px-5 py-8 mx-auto">
            @isset($user->userFollows)
                <table class="table-auto">
                    <tbody>
                        @foreach ($user->userFollows as $follow)
                            <tr>
                                <td class="border px-4 py-2">
                                    <a href="{{ route('userpage', ['id' => $follow->id]) }}">{{ $follow->name }}</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endisset
        </div>
    </div>
@endsection
