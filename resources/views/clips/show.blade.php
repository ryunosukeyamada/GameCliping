@extends('layouts.html_template')

@section('head')
    <title>クリップの詳細</title>
    <link rel="stylesheet" href="{{ asset('css/show.css') }}">
@endsection

@section('content')

    @include('layouts.header_nav')

    <div class="container" style="min-height: 600px">
        @include('clips.clip')
    </div>
        @include('layouts.footer_nav')

@endsection
