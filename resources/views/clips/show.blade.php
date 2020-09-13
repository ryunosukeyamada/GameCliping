@extends('layouts.html_template')

@section('head')
    <title>クリップの詳細</title>
@endsection

@section('content')

    @include('layouts.header_nav')

    <div class="container show" style="min-height: 600px">
        @include('clips.clip')
    </div>
        @include('layouts.footer_nav')

@endsection
