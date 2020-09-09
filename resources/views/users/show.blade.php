@extends('layouts.html_template')

@section('head')
    <title>{{ $user->name }}</title>
@endsection

@section('content')

    @include('layouts.header_nav')

    <div class="container">
      @include('users.user_card')
    </div>
  


@endsection
