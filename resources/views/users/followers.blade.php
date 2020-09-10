@extends('layouts.html_template')

@section('head')
    <title>{{ $user->name }}のフォロワー</title>
@endsection

@section('content')

    @include('layouts.header_nav')

    <div class="container">
        @include('users.user_card')
    </div>

    <div class="container">
        @include('users.tabs',['clip'=>false,'like'=>false,'follows'=>false,'followers'=>true])
        <div class="tab-content">
            <div class="row">
                @foreach ($followerUsers as $user)
                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3">
                      @include('users.user_small_card')
                    </div>
                @endforeach
            </div>
        </div>
        <div class="mt-5 d-flex justify-content-center">
            {{ $followerUsers->links('pagination.default') }}
        </div>
    </div>
@endsection