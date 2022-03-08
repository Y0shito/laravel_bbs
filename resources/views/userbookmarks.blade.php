@extends('layouts.template')

@section('title', "{$user->name}のブックマーク")
@section('content')
    @include('components.usernavbar', compact(['user','isMyPage']))

    <section class="text-gray-600 body-font overflow-hidden">
        <div class="container px-5 py-8 mx-auto">
            <div class="-my-8 divide-y-2 divide-gray-100">
                @foreach ($articles as $article)
                    @include('components.article', compact(['article']))
                @endforeach
            </div>
        </div>
    </section>
@endsection
