@extends('layouts.html_template')

@section('head')
    <title>{{ $user->name }}のフォロー</title>
@endsection

@section('content')

    @include('layouts.header_nav')

    <div class="container">
        @include('users.user_card')
    </div>

    <div class="container">
        @include('users.tabs',['clip'=>false,'like'=>false,'follows'=>true,'followers'=>false])
        <div class="tab-content">
            <div class="row">
                @foreach ($followUsers as $user)
                    <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                        @include('users.user_small_card')
                    </div>
                @endforeach
            </div>
        </div>
        <div class="mt-5 d-flex justify-content-center">
            {{ $followUsers->links('pagination.default') }}
        </div>
    </div>
@endsection
