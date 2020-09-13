@extends('layouts.html_template')

@section('head')
    <title>ログイン</title>
@endsection

@section('content')
    <div class="container" style="min-height: 600px">
        <h1 class="text-center mt-3">
            <a href="{{ route('top') }}"><img width="150px" src="{{ secure_asset('img/GameClipingLogo.png') }}" alt="logo"></a>
        </h1>

        <div class="card mt-5">

            <h5 class="card-header peach-gradient white-text text-center py-4">
                <strong>ログイン</strong>
            </h5>

            <!--Card content-->
            <div class="card-body px-lg-5">
                @include('layouts.error_list')

                <!-- Form -->
                <form method="POST" class="text-center" action="{{ route('login') }}">
                    @csrf

                    <!-- E-mai -->
                    <div class="md-form mt-3">
                        <input type="email" id="email" class="form-control" name="email" required
                            value="{{ old('email') }}">
                        <label for="email">メールアドレス</label>
                    </div>

                    <div class="md-form mt-5">
                        <label for="password">パスワード</label>
                        <input type="password" id="password" class="form-control" name="password" required>
                    </div>

                    {{-- <input type="hidden" name="remember" id="remember" value="on">
                    --}}

                    <!-- ログイン -->
                    <button class="mt-5 btn btn-outline-primary btn-rounded btn-block z-depth-0 my-4 waves-effect"
                        type="submit">ログイン</button>

                    <a href="{{ route('login.google') }}"
                        class="btn-sm deep-orange darken-3 btn-rounded text-white p-2">
                        <i class="fab fa-google mr-1"></i>Googleアカウントでログイン
                    </a>
                </form>
                <!-- Form -->
                <div class="mt-3">
                    <a class="mr-2" href="{{ route('register') }}">新規登録はこちら</a>
                    <a href="{{ route('guest') }}">ゲストログイン</a>
                </div>

            </div>

        </div>
    </div>
        @include('layouts.footer_nav')
@endsection