@extends('layouts.html_template')

@section('head')
    <title>クリップの詳細</title>
    <link rel="stylesheet" href="{{ asset('css/show.css') }}">
@endsection

@section('content')

    @include('layouts.header_nav')

    <div class="container">
        @include('clips.clip')
    </div>

@endsection
