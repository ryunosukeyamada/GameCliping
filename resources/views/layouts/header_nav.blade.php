<nav class="mb-1 navbar navbar-expand navbar-dark peach-gradient">
    <a class="navbar-brand" href="{{ route('clips.index') }}"><img width="120px"
            src="{{ asset('img/GameClipingLogo.png') }}" alt="logo"></a>

    <div class="navbar-collapse">
        <ul class="navbar-nav ml-auto nav-flex-icons">

            @guest
                <li class="nav-item">
                    <a href="{{ route('register') }}" class="nav-link waves-effect waves-light">
                        アカウント登録
                        <i class="fas fa-sign-in-alt"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('login') }}" class="nav-link waves-effect waves-light">
                        ログイン
                        <i class="far fa-user-circle"></i>
                    </a>
                </li>
            @endguest

            <!-- Button trigger modal -->
            <li class="nav-item">
                <a class="nav-link" id="modalActivate" data-toggle="modal" data-target="#exampleModalPreview">
                    検索<i class="fas fa-search"></i>
                </a>
            </li>



            @auth
                <li class="nav-item">
                    <a href="{{ route('clips.create') }}" class="nav-link waves-effect waves-light">
                        クリップ投稿
                        <i class="far fa-file-video"></i>
                    </a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-333" data-toggle="dropdown">
                        <small class="brown-text">{{ Auth::user()->name }}</small><i class="fas fa-user"></i>
                    </a>
                    {{-- ドロップダウン --}}
                    <div class="dropdown-menu dropdown-menu-right dropdown-default"
                        aria-labelledby="navbarDropdownMenuLink-333">
                        <button class="dropdown-item"
                            onclick="location.href='{{ route('users.show', ['name' => Auth::user()->name]) }}' ">
                            マイページ
                        </button>
                        {{-- ログアウトはPOSTでリクエスト --}}
                        <button class="dropdown-item" type="submit" form="logout-form">
                            ログアウト<i class="fas fa-sign-out-alt"></i>
                        </button>
                    </div>
                </li>
            @endauth
        </ul>
    </div>
</nav>

{{-- ログアウトフォーム --}}
<form method="POST" action="{{ route('logout') }}" id="logout-form">
    @csrf
</form>

{{-- 検索用 --}}
<div class="modal fade top" id="exampleModalPreview" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalPreviewLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-frame modal-top" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalPreviewLabel">ユーザー検索</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                @include('layouts.error_list')
                <div class="md-form form-lg">
                    <form method="POST" action="{{ route('users.serch') }}">
                        @csrf
                        <input type="text" name="keyword" id="inputLGEx" class="form-control form-control-lg" value="{{ old('keyword') }}">
                        <label for="inputLGEx">User Name</label>
                        <button type="submit" class="btn btn-outline-success btn-block mt-5">検索</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- Modal -->
