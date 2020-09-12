@extends('layouts.html_template')

@section('head')
    <title>アカウント登録</title>
@endsection

@section('content')
    <div class="container">
        <h1 class="text-center mt-3">
            <a href="/"><img width="150px" src="{{ asset('img/GameClipingLogo.png') }}" alt="logo"></a>
        </h1>

        <div class="card mt-5">

            <h5 class="card-header peach-gradient white-text text-center py-4">
                <strong>アカウント登録</strong>
            </h5>

            <!--Card content-->
            <div class="card-body px-lg-5">
                @include('layouts.error_list')

                <!-- Form -->
                <form method="POST" class="text-center" action="{{ route('register') }}">
                    @csrf



                    <!-- ID -->
                    <div class="md-form mt-5">
                        <input type="text" id="name" class="form-control" name="name" required value="{{ old('name') }}">
                        <small class="deep-orange lighten-3">※英数字ハイフン、アンダースコア 3〜16文字（登録後の変更はできません。）</small>
                        <label for="name">ユーザー名</label>
                    </div>

                    <!-- E-mai -->
                    <div class="md-form">
                        <input type="email" id="email" class="form-control" name="email" required
                            value="{{ old('email') }}">
                        <label for="email">メールアドレス</label>
                    </div>

                    <div class="md-form mt-5">
                        <label for="password">パスワード</label>
                        <input type="password" id="password" class="form-control" name="password" required>
                        <small style="color: rgba(128, 128, 128, 0.577)">8文字以上 | 子文字、大文字、数字必須</small>
                    </div>
                    <div class="md-form">
                        <label for="password_confirmation">パスワード確認用</label>
                        <input type="password" id="password_confirmation" class="form-control" name="password_confirmation"
                            required>
                    </div>

                    <!-- 登録 -->
                    <button class="mt-5 btn btn-outline-primary btn-rounded btn-block z-depth-0 my-4 waves-effect"
                        type="submit">登録</button>
                    <a href="{{ route('login.google') }}" class="btn-sm deep-orange darken-3 btn-rounded text-white p-2">
                        <i class="fab fa-google mr-1"></i>Googleアカウントで登録
                    </a>
                </form>
                <!-- Form -->
                <div>
                    <a href="{{ route('login') }}">ログインはこちら</a>

                </div>

            </div>

        </div>
    </div>
        @include('layouts.footer_nav')
@endsection
