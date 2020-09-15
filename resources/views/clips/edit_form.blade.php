@extends('layouts.html_template')

@section('head')
    <title>クリップ投稿</title>
@endsection

@section('content')
    <div class="container" style="min-height: 86vh">
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
                <form method="POST" class="text-center" action="{{ route('clips.update', ['clip' => $clip]) }}">
                    @method('PUT')
                    @csrf

                    <!-- Title -->
                    <div class="md-form mt-3">
                        <input type="text" id="title" class="form-control" name="title" required value="{{ $clip->title }}">
                        <label for="title">クリップタイトル</label>
                        <small style="color: rgba(128, 128, 128, 0.5)">MAX25</small>
                    </div>

                    <div class="form-group">
                        <clip-tags-input
                        :initial-tags='@json($tagNames)'>

                        </clip-tags-input>
                    </div>

                    <div class="md-form mt-5">
                        <label for="video_id">Youtube VIDEO_ID <span class="text-danger">※動画を編集することはできません</span></label>
                        <input type="text" id="video_id" class="form-control" name="video_id" disabled
                            value="{{ $clip->video_id }}">
                    </div>

                    <div></div>


                    {{-- 投稿 --}}
                    <button class="mt-5 btn btn-outline-primary btn-rounded btn-block z-depth-0 my-4 waves-effect"
                        type="submit">編集上書き</button>
                </form>
                <!-- Form -->

            </div>

        </div>
    </div>
    @include('layouts.footer_nav')
@endsection
