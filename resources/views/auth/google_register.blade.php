@extends('layouts.html_template')

@section('head')
    <title>Google登録</title>
@endsection

@section('content')
    <div class="container">
        <h1 class="text-center mt-3">
            <a href="/"><img width="150px" src="{{ secure_asset('img/GameClipingLogo.png') }}" alt="logo"></a>
        </h1>

        <div class="card mt-5">

            <h5 class="card-header peach-gradient white-text text-center py-4">
                <strong>Googleアカウント登録</strong>
            </h5>

            <!--Card content-->
            <div class="card-body px-lg-5">
                @include('layouts.error_list')

                <!-- Form -->
                <form method="POST" class="text-center" action="{{ route('register.google') }}">
                    @csrf

                    {{-- トークン送信 --}}
                    <input type="hidden" name="token" value="{{ $token }}">
                    <!-- ID -->
                    <div class="md-form mt-5">
                        <input type="text" id="name" class="form-control" name="name" required value="{{ old('name') }}">
                        <small class="deep-orange lighten-3">※英数字ハイフン、アンダースコア 3〜16文字（登録後の変更はできません。）</small>
                        <label for="name">ユーザー名</label>
                    </div>

                    <!-- E-mai -->
                    <div class="md-form">
                        <input type="email" id="email" class="form-control" name="email" required value="{{ $email }}"
                            disabled>
                        <small class="text-muted">Googleに登録されているメールアドレス(変更不可)</small>
                        <label for="email">メールアドレス</label>
                    </div>

                    <!-- 登録 -->
                    <button class="mt-5 btn btn-outline-primary btn-rounded btn-block z-depth-0 my-4 waves-effect"
                        type="submit">登録</button>
                </form>
            </div>

        </div>
    </div>
        @include('layouts.footer_nav')
@endsection
