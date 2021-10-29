@extends('layouts.template')

@section('title', '記事')

@section('content')
    <section class="text-gray-600 body-font">
        <div class="container px-5 py-8 mx-auto">
            <div class="text-left mb-20">
                <h1
                    class="sm:text-3xl text-2xl font-medium text-left title-font text-gray-900 xl:w-2/4 lg:w-3/4 mx-auto mb-1 border-b-2">
                    {{ $article->title }}
                </h1>
                <div class="xl:w-2/4 lg:w-3/4 mx-auto mb-8">
                    <div class="flex justify-between">
                        <div>
                            <span
                                class="text-gray-400 mr-3 inline-flex items-center leading-none text-sm pb-1">{{ $article->user->name }}</span>
                        </div>
                        <div>
                            <span class="text-gray-400 mr-3 inline-flex items-center leading-none text-sm pb-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>{{ $article->views }}</span>
                            <span class="text-gray-400 mr-3 inline-flex items-center leading-none text-sm pb-1">
                                <svg class="w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                                </svg>{{ $article->bookmarks }}</span>
                            <span class="text-gray-400 mr-3 inline-flex items-center leading-none text-sm pb-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                                </svg>{{ $article->created_at->format('Y年m月d日') }}</span>
                            @if (isset($article->updated_at))
                                <span class="text-gray-400 mr-3 inline-flex items-center leading-none text-sm pb-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                    </svg>{{ $article->updated_at->format('Y年m月d日') }}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <p class="text-base leading-relaxed xl:w-2/4 lg:w-3/4 mx-auto">
                    {!! nl2br(e($article->body)) !!}
                </p>
            </div>
        </div>
    </section>
@endsection