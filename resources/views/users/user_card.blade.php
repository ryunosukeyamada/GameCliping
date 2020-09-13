<!-- ジャンボトロン -->
<div class="jumbotron text-center hoverable p-1 mt-5">

    <div class="row">

        <div class="col-md-4 offset-md-1 mx-3 my-3">

            <!-- ユーザートップ画像 -->
            <div class="text-center">
                <img src="{{ secure_asset('storage/profiles/' . $user->profile_image) }}" class="rounded-circle" height="220px"
                    width="220px" alt="Userトップ画像">
            </div>
            @auth
                @if (Auth::user()->name === $user->name)
                    <a class="btn btn-outline-default btn-md" data-toggle="modal"
                        data-target="#modalLoginForm">TOP画像を変える</a>
                @endif
            @endauth

        </div>

        <div class="col-md-7 text-md-left ml-3 mt-3">
            <p class="text-muted">作成日<small>{{ $user->created_at->format('Y/m/d') }}</small></p>
            <!-- ユーザーネーム -->
            <h4 class="h4 mb-4 green-text"><i class="mr-2 far fa-user-circle"></i>{{ $user->name }}</h4>
            <span class="text-muted">コメント</span>
            @auth
                @if (Auth::user()->name === $user->name)
                    <a data-toggle="modal" data-target="#modalContactForm"><small>編集</small>
                        <i class="fas fa-comment-medical green-text"></i>
                    </a>
                @endif
                @include('layouts.error_list')
            @endauth
            <div class="card-body">
                <div class="card-text">
                    <p>{!! nl2br(e($user->caption)) !!}</p>
                </div>
            </div>

            <!-- フォローコンポーネント -->
            @if (Auth::id() !== $user->id)
                <div class="mb-5">
                    <follow :initial-is-followd-by='@json($user->isFollowdBy(Auth::user()))'
                        :login-check='@json(Auth::check())' url="{{ route('users.follow', ['name' => $user->name]) }}">
                    </follow>
                </div>
            @endif

            <div class="card-body p-0 mt-3">
                <div class="card-text">
                    <a href="{{ route('users.follows', ['name' => $user->name]) }}" class="text-muted mr-1">
                        {{ $user->count_follows }} フォロー
                    </a>
                    <a href="{{ route('users.followers', ['name' => $user->name]) }}" class="text-muted ml-1">
                        {{ $user->count_followers }}
                        フォロワー</a>
                </div>
            </div>
        </div>


    </div>
</div>


{{-- TOP画像変更モーダル --}}
<div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold text-muted">プロフィール画像変更</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body mx-3">
                {{-- フォーム --}}
                <form id="profile-image" method="POST" class="sm-form"
                    action="{{ route('users.edit', ['name' => $user->name]) }}" enctype="multipart/form-data">
                    @csrf
                    {{-- 画像変更 --}}
                    <input class="h6" type="file" name="profile_image">
                    <br><small class="text-danger">※jpg.png形式のみ</small>
                </form>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button form="profile-image" type="submit" class="btn btn-default">変更</button>
            </div>
        </div>
    </div>
</div>

{{-- コメント変更モーダル --}}
<div class="modal fade" id="modalContactForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">コメント変更</h4>
            </div>
            <div class="modal-body mx-3">
                {{-- フォーム --}}
                <form action="{{ route('users.edit', ['name' => $user->name]) }}" method="POST" id="caption">
                    @csrf
                    @method('PUT')
                    <div class="md-form amber-textarea active-amber-textarea">
                        <i class="fas fa-pencil-alt prefix animated jackInTheBox"></i>
                        <textarea name="caption" id="form22" class="md-textarea form-control" rows="4">{{ $user->caption }}</textarea>
                        <label for="form22">コメント</label>
                        <small style="color: rgba(128, 128, 128, 0.5)">MAX100</small>
                    </div>
                </form>
            </div>

            <div class="modal-footer d-flex justify-content-center">
                <button type="submit" form="caption" class="btn btn-default">変更</button>
            </div>
        </div>
    </div>
</div>
