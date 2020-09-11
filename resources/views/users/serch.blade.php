@extends('layouts.html_template')

@section('head')
    <title>{{ $keyword }}の検索結果</title>
@endsection

@section('content')

    @include('layouts.header_nav')

    <div class="container">
        <div class="card mt-2">
            <div class="card-body">
                <button onclick="history.back()" class="btn btn-outline-green float-right">戻る</button>
                <h2 class="card-title">{{ $keyword }}</h2>
                <small class="text-muted">{{ $users->count() }}件取得</small>
            </div>
        </div>
        <div class="tab-content" id="myTabContent">
            <div class="row">
                @foreach ($users as $user)
                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3">
                        @include('users.user_small_card')
                    </div>
                @endforeach
            </div>
        </div>
    </div>


@endsection
