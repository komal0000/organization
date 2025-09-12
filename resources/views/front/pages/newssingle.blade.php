@extends('front.layout')
@section('meta')
    @includeIf('front.cache.home.meta')
@endsection
@section('content')
<div class="jumbotron">
    <div class="text-center">
        <a href="{{route('home')}}">Home </a> /
        <a href="{{route('news')}}">News </a>
        <br>
        <a class="active">
            {{$newsSingle->title}}
        </a>
    </div>
</div>
<div id="news-page-single" class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="image">
                    <img  loading="lazy"  class="w-100" src="{{vasset($newsSingle->file)}}" alt="">
                    <div class="date">
                        {{noticeDate($newsSingle)}}
                    </div>
                </div>

                <div class="title">
                    {{$newsSingle->title}}
                </div>

                <div class="full">
                    {!! $newsSingle->desc !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="extra">
                    <div class="extra-title">
                        Latest News
                    </div>
                    @foreach ($newsAll->take(6) as $news)
                    <a href="{{route('news.single',['slug'=>$news->s])}}" class="extra-single">
                        {{$news->t}}
                        <br>
                        <small>
                            {{$news->date}}
                        </small>
                    </a>
                    <hr class="m-0">

                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
