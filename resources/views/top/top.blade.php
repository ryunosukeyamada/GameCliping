@extends('layouts.html_template')

@section('head')
    <title>GameClipingへようこそ</title>
    <link rel="stylesheet" href="{{ asset('css/top.css') }}">
@endsection

@section('content')
<div class="content">
  <div class="head">
    <div class="m-3">
       <a href="#"><img class="logo" src="{{ asset('img/GameClipingLogo.png') }}" alt="GameCliping_Logo"></a>
    </div>
    <button type="button" 
      class="btn btn-info peach-gradient btn-rounded mr-5 m-3" 
      onclick="location.href='{{ route('login') }}' ">ログイン
    </button>
  </div>

  <div class="body">
    <p>あなたのシーンを<br>共有しよう。
    </p>
    <div class="text-right">
      <a class="btn btn-outline-yellow accent-2 btn-rounded pl-5 pr-5" href="{{ route('clips.index') }}">
        <i class="fab fa-affiliatetheme"></i>
        他の人の投稿を見る
      </a>
      <a class="btn btn-outline-success btn-rounded pl-5 pr-5" href="{{ route('register') }}">
        アカウント登録
      </a>
    </div>
  </div>

</div>  
    
@endsection
