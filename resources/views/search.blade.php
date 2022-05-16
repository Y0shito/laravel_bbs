@extends('layouts.template')

@section('title', '検索')

@section('content')
    <section class="text-gray-600 body-font">
        <div class="container px-5 py-8 mx-auto">
            <form method="GET" action="{{ route('search') }}" class="flex justify-center">
                <input type="text" name="search" placeholder="検索語句を入力" value="{{ isset($words) ? $words : '' }}"
                    class="w-2/4 mr-2 bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                <div class="flex justify-center">
                    {{ Form::select(
                        'category',
                        \App\Models\Category::select('id', 'category_name')->get()->pluck('category_name', 'id')->prepend('選択してください', ''),
                        request()->category,
                    ) }}
                </div>
                <button
                    class="text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">
                    検索
                </button>
            </form>
            @isset($articles)
                <div class="flex justify-between border-b-2 my-8">
                    <h1 class="text-xl text-gray-600">「{{ $words }}」の検索結果</h1>
                    <div>
                        @sortablelink('views','閲覧数','', ['class' => 'text-gray-800 px-2'])
                        @sortablelink('bookmarks','ブックマーク数','', ['class' => 'text-gray-800 px-2'])
                        @sortablelink('created_at','作成日順','', ['class' => 'text-gray-800 px-2'])
                    </div>
                </div>
                <div class="-my-8 divide-y-2 divide-gray-100">
                    @foreach ($articles as $article)
                        @include('components.article', compact(['article']))
                    @endforeach
                </div>
                {{ $articles->appends(request()->query())->links() }}
            @endisset
            @empty($articles)
                <div class="text-center my-8">
                    <p class="text-gray-500 mb-8">検索は記事のタイトルから検索されます</p>
                    <p class="text-gray-500 mb-2">単語に空白を挟むと、最大5個まで複数の単語で検索出来ます</p>
                    <p class="text-gray-500 mb-8">例：「◯◯◯　✗✗✗」→　◯◯◯と✗✗✗を含む記事を検索</p>
                    <p class="text-gray-500 mb-2">また単語の頭にハイフン記号をつけると、その語句を含む記事を除外します</p>
                    <p class="text-gray-500">例：「◯◯◯　-✗✗✗」→　◯◯◯を含む記事の中から、✗✗✗を含む記事を除外して検索</p>
                </div>
            @endempty
        </div>
    </section>
@endsection
