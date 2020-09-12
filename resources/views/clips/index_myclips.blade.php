@extends('layouts.html_template')

@section('head')
    <title>{{ $user->name }}の投稿 {{ $clips->count() }}件</title>
    <link rel="stylesheet" href="{{ asset('css/index.css ') }}">
@endsection

@section('content')
    @include('layouts.header_nav')
    @include('clips.tabs',['clip' =>false,'like' => false,'myClip' =>true])
    <div class="container-fluid" style="min-height: 600px">
        <div class="row">
            @foreach ($user->clips as $clip)
                <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3">
                    @include('clips.clip')
                </div>
            @endforeach
        </div>
        @include('layouts.paginate')
    </div>
    @include('layouts.footer_nav')

@endsection