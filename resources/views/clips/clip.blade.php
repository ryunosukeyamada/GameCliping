<!-- Card -->
<div class="card promoting-card mt-3 blue-grey lighten-5">

    <!-- ドロップダウンメニュー -->
    @if (Auth::id() === $clip->user_id)
        <div class="dropdown">
            <!--ドロップダウンBTN-->
            <a class="brown-text" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-chevron-circle-down ml-auto"></i><small>あなたの投稿です</small>
            </a>
            <!--メニュー-->
            <div class="dropdown-menu dropdown-primary">
                <!--編集 -->
                <a class="dropdown-item" href="{{ route('clips.edit', ['clip' => $clip]) }}">クリップ編集</a>

                <!--削除 モーダル使うからターゲットを分ける {$clip->id}-->
                <button class="dropdown-item text-danger" type="button" data-toggle="modal"
                    data-target="#modal-delete-{{ $clip->id }}">
                    <i class="fas fa-trash-alt mr-2"></i>削除
                </button>
            </div>
        </div>
    @endif

    <div class="card-body d-flex flex-row">
        <!-- ユーザーの画像 -->
        @if ($clip->user->profile_image === 'default.png')
            <a href=" {{ route('users.show', ['name' => $clip->user->name]) }}"><img
                    src="{{ asset('storage/profiles/default.png') }}" class="rounded-circle mr-3" height="50px"
                    width="50px" alt="avatar"></a>
        @else
            <a href=" {{ route('users.show', ['name' => $clip->user->name]) }}"><img
                    src="{{ asset('storage/profiles/' . $clip->user->profile_image) }}" class="rounded-circle mr-3"
                    height="50px" width="50px" alt="avatar"></a>
        @endif

        <div class="card-head">
            <!-- タイトル -->
            <a class="text-muted" href="{{ route('clips.show', ['clip' => $clip]) }}">
                <h2 class="h6 card-title font-weight-bold mb-2">{{ $clip->title }}</h2>
            </a>

            <!-- ユーザーネーム -->
            <a class="card-text " href="{{ route('users.show', ['name' => $clip->user->name]) }}">
                {{ $clip->user->name }}
            </a>

            <p class="mt-2">{ここにタグが入ります}</p>
        </div>
    </div>

    <!-- 動画を埋め込む -->
    <div class="view overlay">
        @if ($clip->video_html == '')
            <div class="text-center">
                <img class="notMovie" width="250px" src="{{ asset('img/notMovie.png') }}" alt="ごめんなさい">
                <p>動画を取得できませんでした</p>
            </div>
        @else
            {!! $clip->video_html !!}
        @endif
    </div>

    <div class="card-body">
        <div class="collapse-content">
            <small class="card-text">
                <i class="far fa-clock pr-2"></i>
                {{ $clip->created_at->format('m/d H:i') }}
            </small>

            <!-- いいねボタン -->   
            <div class="float-right">
                <clip-like
                :initial-is-liked-by="@json($clip->isLikedBy(Auth::user()))"
                :initial-count-likes="@json($clip->likes_count)"
                :login-check="@json(Auth::check())"
                url="{{ route('like', ['clip'=>$clip]) }}"
                >
                </clip-like>
            </div>
            <!-- いいねボタン -->   

        </div>
    </div>
</div>
<!-- Card -->

<!-- モーダル -->
<div class="modal fade" id="modal-delete-{{ $clip->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <br>
                <p class="h5 text-danger">{{ $clip->title }}を削除してもよろしいですか？</p>
            </div>
            <div class="modal-footer">
                <form method="POST" action="{{ route('clips.destroy', ['clip' => $clip]) }}">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-outline-danger"><i
                            class="fas fa-trash-alt mr-2"></i>削除</button>
                </form>
            </div>
        </div>
    </div>
</div>
