@extends('layouts.html_template')

@section('head')
    <title>{{ $user->name }}</title>
    <link rel="stylesheet" href="{{ asset('css/index.css ') }}">
@endsection

@section('content')

    @include('layouts.header_nav')

    <div class="container">
        @include('users.user_card')
    </div>

    <div class="container">
        @include('users.tabs',['clip'=>false,'like'=>true])
        <div class="tab-content">
            <div class="row">
                @foreach ($clips as $clip)
                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3">
                        @include('clips.clip')
                    </div>
                @endforeach
            </div>
        </div>
    </div>



@endsection
