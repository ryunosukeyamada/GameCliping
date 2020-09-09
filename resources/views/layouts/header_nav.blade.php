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
                            onclick="location.href='{{ route('users.show', ['name' => Auth::user()->name])}}' ">
                            マイページ
                        </button>
                        {{-- ログアウトはPOSTでリクエスト --}}
                        <button class="dropdown-item" type="submit" form="logout-form">ログアウト
                            <i class="fas fa-sign-out-alt"></i>
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
<!--/.Navbar -->
