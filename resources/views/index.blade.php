@extends('layouts.template')

@section('title', 'BBS')

@section('content')
    <section class="text-gray-600 body-font overflow-hidden">
        <div class="container px-5 py-8 mx-auto">
            <div class="flex justify-end mb-8">
                @sortablelink('views','閲覧数','', ['class' => 'text-gray-800 px-2'])
                @sortablelink('bookmarks','ブックマーク数','', ['class' => 'text-gray-800 px-2'])
                @sortablelink('created_at','作成日順','', ['class' => 'text-gray-800 px-2'])
            </div>
            <div class="-my-8 divide-y-2 divide-gray-100">
                @foreach ($articles as $article)
                    @include('components.article', compact(['article']))
                @endforeach
            </div>
            <div class="mt-8">
                {{ $articles->appends(request()->query())->links() }}
            </div>
        </div>
    </section>
@endsection
