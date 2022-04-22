@extends('layouts.template')

@section('settings', "{$user->name}の設定")
@section('content')
    @include('components.usernavbar', compact(['user', 'isMyPage']))

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
    <div class="p-2 w-full flex align-center">
        <form method="POST" action="{{ route('userDelete') }}">
            @csrf
            <button
                class="mx-auto text-white bg-red-500 border-0 py-2 px-8 focus:outline-none hover:bg-red-600 rounded text-lg"
                value="{{ Auth::id() }}" name="id" onclick="userDelete(); return false;">退会</button>
        </form>
    </div>

    <script>
        'use strict';
        const userDelete = () => {
            if (window.confirm('本当に退会しますか？\r\n退会すると再びログイン出来なくなります。')) {
                document.userDelete.submit();
            } else {
                return false;
            }
        }
    </script>
@endsection
