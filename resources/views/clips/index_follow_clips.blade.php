@extends('layouts.html_template')

@section('head')
    <title>フォロー</title>
@endsection

@section('content')
    @include('layouts.header_nav')
    @include('clips.clip_count')
    @include('clips.tabs',['clip' =>false,'like' => false,'followClip'=>true,'myClip' =>false])
    <div class="container-fluid" style="min-height: 600px">
        <div class="row">
            @foreach ($clips as $clip)
                <div class="col-sm-12 col-md-6 col-lg-4 index">
                    @include('clips.clip')
                </div>
            @endforeach
        </div>
        @include('layouts.paginate')
    </div>
    @include('layouts.footer_nav')

@endsection