@extends('layouts.template')

@section('title', '記事編集')

@section('content')
    <form method="POST" action="{{ route('editPreview') }}">
        @csrf
        <section class="text-gray-600 body-font relative">
            <div class="container px-5 py-8 mx-auto">
                <div class="lg:w-1/2 md:w-2/3 mx-auto">
                    <div class="flex justify-between border-b-2 mb-4">
                        <h1 class="text-xl text-gray-600">記事編集</h1>
                        <span class="leading-7 text-sm text-gray-600">
                            元記事ID：{{ $errors->has('*') ? old('id') : $article->id }}
                        </span>
                    </div>
                    <div class="flex flex-wrap -m-2">
                        <div class="p-2 w-full">
                            <div class="relative">
                                <div class="flex justify-between">
                                    <label for="title" class="leading-7 text-sm text-gray-600">タイトル</label>
                                    @error('title')
                                        <span class="leading-7 text-sm text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>
                                <input type="text" name="title"
                                    value="{{ $errors->has('*') ? old('title') : $article->title }}"
                                    placeholder="5文字以上、30文字以下で入力してください"
                                    class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                            </div>
                        </div>
                        <div class="p-2 w-full">
                            <div class="relative">
                                <div class="flex justify-between">
                                    <label for="body" class="leading-7 text-sm text-gray-600">本文</label>
                                    @error('body')
                                        <span class="leading-7 text-sm text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>
                                <textarea name="body" placeholder="30文字以上、1000文字以下で入力してください"
                                    class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out">{{ $errors->has('*') ? old('body') : $article->body }}</textarea>
                            </div>
                        </div>
                        <input type="hidden" name="id" value="{{ $errors->has('*') ? old('id') : $article->id }}">
                        <div class="p-2 w-full flex align-center">
                            <button
                                class="mx-auto text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">プレビュー</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </form>
@endsection
