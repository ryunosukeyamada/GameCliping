<!-- ジャンボトロン -->
<div class="jumbotron text-center hoverable p-1 mt-5">

    <div class="row">

        <div class="col-md-4 offset-md-1 mx-3 my-3">

            <!-- ユーザートップ画像 -->
            <div class="text-center">
                <img src="{{ asset('storage/profiles/' . $user->profile_image) }}" class="rounded-circle" height="220px"
                    width="220px" alt="Userトップ画像">
            </div>
            @auth
                @if (Auth::user()->name === $user->name)
                    <a class="btn btn-outline-default btn-md" data-toggle="modal"
                        data-target="#modalLoginForm">TOP画像を変える</a>
                @endif
                @include('layouts.error_list')
            @endauth

        </div>

        <div class="col-md-7 text-md-left ml-3 mt-3">
            <p class="text-muted">作成日<small>{{ $user->created_at->format('Y/m/d') }}</small></p>
            <!-- ユーザーネーム -->
            <h4 class="h4 mb-4 green-text"><i class="mr-2 far fa-user-circle"></i>{{ $user->name }}</h4>

            <div class="card-body">
                <div class="card-text">
                    <p>どうもみなさんこんにちは</p>
                </div>
            </div>

            <!-- フォローコンポーネント -->
                @if (Auth::id() !== $user->id)
                    <div class="mb-5">
                        <follow
                        :initial-is-followd-by='@json($user->isFollowdBy(Auth::user()))'
                        :login-check='@json(Auth::check())'
                        url="{{ route('users.follow', ['name' => $user->name]) }}"
                        >
                    </follow>
                    </div>
                @endif

            <div class="card-body p-0 mt-3">
                <div class="card-text">
                    <a href="" class="text-muted mr-1">10 フォロー</a>
                    <a href="" class="text-muted ml-1">10 フォロワー</a>
                </div>
            </div>
        </div>


    </div>
</div>


{{-- モーダル --}}
<div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold text-muted">イメージアップロード</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body mx-3">
                {{-- フォーム --}}
                <form id="profile-image" method="POST" class="sm-form"
                    action="{{ route('users.edit', ['name' => $user->name]) }}" enctype="multipart/form-data">
                    @csrf
                    <input class="h6" type="file" name="profile_image">
                    <br><small class="text-danger">※jpg.png形式のみ</small>
                </form>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button form="profile-image" type="submit" class="btn btn-default">変更</button>

                {{-- フォーム --}}
            </div>
        </div>
    </div>
</div>
