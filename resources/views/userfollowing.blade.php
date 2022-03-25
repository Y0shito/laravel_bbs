@extends('layouts.template')

@section('title', "{$user->name}がフォローしているユーザー")
@section('content')
    @include('components.usernavbar', compact(['user', 'isMyPage']))
    @include('components.userslist', compact(['userlist']))
@endsection
