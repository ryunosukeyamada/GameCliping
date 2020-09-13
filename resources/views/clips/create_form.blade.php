@extends('layouts.html_template')

@section('head')
    <title>クリップ投稿</title>
@endsection

@section('content')
    <div class="container"style="min-height: 600px">
        <h1 class="text-center mt-3">
            <a href="{{ route('clips.index') }}"><img width="150px" src="{{ secure_asset('img/GameClipingLogo.png') }}"
                    alt="logo"></a>
        </h1>

        <div class="card mt-5">

            <h5 class="card-header peach-gradient white-text text-center py-4">
                <strong>クリップ投稿</strong>
            </h5>

            <!--Card content-->
            <div class="card-body px-lg-5">
                @include('layouts.error_list')

                <!-- Form -->
                <form method="POST" class="text-center" action="{{ route('clips.store') }}">
                    @csrf

                    <!-- Title -->
                    <div class="md-form mt-3">
                        <input type="text" id="title" class="form-control" name="title" required value="{{ old('title') }}">
                        <label for="title">クリップタイトル</label>
                        <small style="color: rgba(128, 128, 128, 0.5)">MAX30</small>
                    </div>

                    <div class="form-group">
                        <clip-tags-input 
                        :initial-tags='[]'>

                        </clip-tags-input>
                    </div>

                    <div class="md-form mt-5">
                        <label for="video_id">Youtube VIDEO_ID (YoutubeURLでも可)</label>
                        <input type="text" id="video_id" class="form-control" name="video_id" required>
                        <small style="color: rgba(128, 128, 128, 0.5)">VIDEO_IDの場合(11桁)</small><br>
                        <small><a class="text-info" data-toggle="modal" data-target="#modalConfirmDelete">Youtube VIDEO_IDとは
                                <i class="fas fa-question-circle"></i></a>
                        </small>
                    </div>

                    <div></div>


                    {{-- 投稿 --}}
                    <button class="mt-5 btn btn-outline-primary btn-rounded btn-block z-depth-0 my-4 waves-effect"
                        type="submit">クリップ投稿</button>
                </form>
                <!-- Form -->

            </div>

        </div>
    </div>
    @include('layouts.footer_nav')



    {{-- モーダル --}}
    <div class="modal fade" id="modalConfirmDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-md modal-notify modal-info" role="document">
            <!--Content-->
            <div class="modal-content text-center">
                <!--Header-->
                <div class="modal-header d-flex justify-content-center">
                    <p class="heading">Youtube VIDEO_IDって何？</p>
                </div>

                <!--Body-->
                <div class="modal-body">

                    <i class="fas fa-question-circle fa-4x animated rotateIn"></i>

                    <p class="mt-3">Youtube VIDEO_IDとは、<br> あなたが共有したいYoutubeの動画URLの</p>
                    <p>V＝から始まる<span class="text-danger">11桁</span>の 大文字含む英数字 _ - のことです。</p>
                    <small>
                        （例）https://www.youtube.com/watch?v=<span class="text-danger">sfuYpadW_tM <i
                                class="fas fa-caret-left"></i></span>
                    </small><br>
                    <small>上の例では<span class="text-danger">赤文字</span>の箇所をコピーして貼り付ければOK</small><br>
                    <hr>
                    <small><span class="text-warning">(非推奨)</span>わからない場合はURLそのものをコピ-&ペーストでも可</small>

                </div>

                <!--Footer-->
                <div class="modal-footer flex-center">

                </div>
                <!--/.Content-->
            </div>
        </div>
    </div>
    @endsection
