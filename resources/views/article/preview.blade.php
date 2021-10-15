@extends('layouts.template')

@section('title', 'プレビュー')
@section('content')
    <section class="text-gray-600 body-font">
        <form method="POST">
            @csrf
            <div class="container px-5 py-24 mx-auto">
                <div class="text-center mb-20">
                    <h1 class="sm:text-3xl text-2xl font-medium text-center title-font text-gray-900 mb-4">
                        {{ session('title') }}
                    </h1>
                    <p class="text-base leading-relaxed xl:w-2/4 lg:w-3/4 mx-auto">
                        {{ session('body') }}
                    </p>
                </div>
                <button formaction="{{ route('completion') }}"
                    class="flex mx-auto mt-16 text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">公開する</button>
            </div>
        </form>
    </section>
@endsection
