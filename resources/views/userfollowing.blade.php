@extends('layouts.template')

@section('title', "{$user->name}がフォローしているユーザー")
@section('content')
    @include('components.usernavbar', compact(['user','isMyPage']))
    @include('components.userslist',['user' => $user, 'which' => 'userFollows'])
@endsection
