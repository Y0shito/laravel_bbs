@extends('layouts.template')

@section('title', "{$user->name}のフォロワー")
@section('content')
    @include('components.usernavbar', compact(['user','isMyPage']))
    @include('components.userslist',['user' => $user, 'which' => 'userFollowers'])
@endsection
