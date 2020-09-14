@extends('layouts.html_template')

@section('head')
    <title>いいね順</title>
@endsection

@section('content')
    @include('layouts.header_nav')
    @include('clips.clip_count')
    @include('clips.tabs',['clip' =>false,'like' => true,'followClip'=>false,'myClip' =>false])
    <div class="container-fluid" style="min-height: 600px">
        <div class="row">
            @foreach ($clips as $clip)
                @if ($loop->first)
                    <div class="col-sm-12 no1">
                        @include('clips.clip')
                    </div>
                @else
                <div class="col-sm-12 col-md-6 index">
                    @include('clips.clip')
                </div>
                @endif
            @endforeach
        </div>
        @include('layouts.paginate')
    </div>
    @include('layouts.footer_nav')

@endsection
