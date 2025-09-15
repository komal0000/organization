@extends('front.layout')
@section('meta')
    @includeIf('front.cache.home.meta')
@endsection
@section('content')
<div class="jumbotron modern">
    <div class="text-center">
        <h1>{{$newsSingle->title}}</h1>
        <p>{{noticeDate($newsSingle)}}</p>
        <div class="mt-3">
            <a href="{{route('home')}}">Home</a> /
            <a href="{{route('news')}}">News</a> /
            <a class="active">{{Str::limit($newsSingle->title, 30)}}</a>
        </div>
    </div>
</div>

<div class="modern-content-section">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="modern-card">
                    <div class="mb-4">
                        <img loading="lazy" class="w-100 rounded" src="{{vasset($newsSingle->file)}}" alt="{{$newsSingle->title}}">
                    </div>

                    <h2 class="modern-section-title">{{$newsSingle->title}}</h2>

                <div class="full">
                    <div class="modern-text-content">
                        {!! $newsSingle->desc !!}
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="modern-card">
                    <h5 class="card-title mb-4">Latest News</h5>

                    @foreach ($newsAll->take(6) as $news)
                        <a href="{{route('news.single',['slug'=>$news->s])}}" class="modern-news-item d-block mb-3 text-decoration-none">
                            <div class="fw-bold mb-1">{{$news->t}}</div>
                            <small class="modern-text-muted">{{$news->date}}</small>
                        </a>
                        @if (!$loop->last)
                            <hr class="my-3">
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
