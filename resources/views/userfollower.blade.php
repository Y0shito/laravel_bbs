@extends('layouts.template')

@section('title', "{$user->name}のフォロワー")
@section('content')
    @include('components.usernavbar', compact(['user','isMyPage']))

    <div class="text-gray-600 body-font">
        <div class="container px-5 py-8 mx-auto">
            @isset($user->userFollowers)
                <div class="flex flex-col">
                    <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="inline-block py-2 min-w-full sm:px-6 lg:px-8">
                            <div class="overflow-hidden shadow-md sm:rounded-lg">
                                <table class="min-w-full">
                                    <tbody>
                                        @foreach ($user->userFollowers as $follow)
                                            <tr
                                                class="border-b odd:bg-white even:bg-gray-50 odd:dark:bg-gray-800 even:dark:bg-gray-700 dark:border-gray-600">
                                                <td
                                                    class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                    <a
                                                        href="{{ route('userpage', ['id' => $follow->id]) }}">{{ $follow->name }}</a>
                                                </td>
                                                <td class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400">
                                                    {{ $follow->total_bookmarked }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @endisset
        </div>
    </div>
@endsection
