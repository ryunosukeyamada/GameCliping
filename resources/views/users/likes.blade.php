@extends('layouts.html_template')

@section('head')
    <title>{{ $user->name }}</title>
@endsection

@section('content')

    @include('layouts.header_nav')

    <div class="container">
        @include('users.user_card')
    </div>

    <div class="container" style="min-height: 600px">
        @include('users.tabs',['clip'=>false,'like'=>true,'follows'=>false,'followers'=>false])
        <div class="tab-content">
            <div class="row">
                @foreach ($clips as $clip)
                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 index">
                        @include('clips.clip')
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @include('layouts.paginate')
    @include('layouts.footer_nav')



@endsection
