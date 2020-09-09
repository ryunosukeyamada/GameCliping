@extends('layouts.html_template')

@section('head')
    <title>{{ $tag->hash_tag }}</title>
    <link rel="stylesheet" href="{{ asset('css/index.css ') }}">
@endsection

@section('content')
    @include('layouts.header_nav')

    <div class="container">
        <div class="card mt-2">
            <div class="card-body">
              <button onclick="history.back()" class="btn btn-outline-green float-right">戻る</button>
                <h2 class="card-title">{{ $tag->hash_tag }}</h2>
                <small class="text-muted">{{ $tag->clips->count() }}件取得</small>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            @foreach ($tag->clips as $clip)
                <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3">
                    @include('clips.clip')
                </div>
            @endforeach
        </div>
    </div>

@endsection
