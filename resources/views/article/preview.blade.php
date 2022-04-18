@extends('layouts.template')

@section('title', 'プレビュー')
@section('content')
    <section class="text-gray-600 body-font">
        <form method="POST" onsubmit="send()">
            @csrf
            <div class="container px-5 py-24 mx-auto">
                <div class="text-left mb-20">
                    <h1 class="sm:text-3xl text-2xl font-medium text-center title-font text-gray-900 mx-auto mb-4">
                        {{ session('title') }}
                    </h1>
                    <p class="text-base leading-relaxed xl:w-2/4 lg:w-3/4 mx-auto">
                        {!! nl2br(e(session('body'))) !!}
                    </p>
                </div>
                <div class="flex justify-center">
                    {{ Form::select(
                        'category',
                        \App\Models\Category::select('id', 'category_name')->get()->pluck('category_name', 'id'),
                        null,
                    ) }}
                </div>
                <div class="p-2 w-full flex align-center">
                    <button formaction="{{ route('draft') }}"
                        class="mx-auto text-white bg-gray-500 border-0 py-2 px-8 focus:outline-none hover:bg-gray-600 rounded text-lg disabled:bg-gray-200 disabled:cursor-not-allowed">下書き保存</button>
                    <button formaction="{{ route('completion') }}"
                        class="mx-auto text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg disabled:bg-gray-200 disabled:cursor-not-allowed">公開する</button>
                </div>
            </div>
        </form>
        <script>
            'use strict';
            const send = () => {
                document.querySelectorAll('button').forEach(x => x.disabled = true);
                submitted = true;
            }
        </script>
    </section>
@endsection
