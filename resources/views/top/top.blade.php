@extends('layouts.html_template')

@section('head')
    <title>GameClipingへようこそ</title>
@endsection

@section('content')
<div class="content">
  <div class="head">
    <div class="m-3">
       <a href="#"><img class="logo" src="{{ secure_asset('img/GameClipingLogo.png') }}" alt="GameCliping_Logo"></a>
    </div>
    <button type="button" 
      class="btn btn-info peach-gradient btn-rounded mr-5 m-3" 
      onclick="location.href='{{ route('login') }}' ">ログイン
    </button>
  </div>

  <div class="body">
    <p>あなたの<br>お気に入りの動画を<br>共有しよう。</p>
    <small class="youtube float-left text-light">
      <span>※Youtube<i class="fab fa-youtube"></i></span>と連携します
    </small>
    <div class="text-right">
      <a class="btn btn-outline-yellow accent-2 pl-5 pr-5" href="{{ route('clips.index') }}">
        <i class="fab fa-affiliatetheme"></i>
        他の人の投稿を見る
      </a>
      <a class="btn btn-outline-success pl-5 pr-5" href="{{ route('register') }}">
        アカウント登録
      </a>
    </div>
  </div>
</div>  
<div class="footer">
  @include('layouts.footer_nav')
</div>
    
@endsection
