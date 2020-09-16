@extends('layouts.html_template')

@section('head')
    <title>クリップの詳細</title>
@endsection

@section('content')

    @include('layouts.header_nav')

    <div class="container show" style="min-height: 86vh">
        @include('clips.clip')
        <div class="card-body">
            <div class="card-title">
                <h1 class="h4">{{ $items['title'] }}</h1>
            </div>
            <br />
            <p class="float-right text-muted">{{ $items['viewCount'] }}回視聴</p>
            <div class="card-text">
                <p>{!! nl2br(($items['description'])) !!}</p>
            </div>
        </div>
    </div>
        @include('layouts.footer_nav')

@endsection
