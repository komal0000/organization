@extends('front.layout')
@section('meta')
    @includeIf('front.cache.home.meta')
@endsection
@section('content')
    <div class="jumbotron modern">
        <div class="text-center">
            <h1>{{$about->title}}</h1>
            <p>Learn more about our organization</p>
            <div class="mt-3">
                <a href="{{ route('home') }}">Home</a> /
                <a href="{{route('about')}}">About Us</a> /
                <a class="active">{{Str::limit($about->title, 30)}}</a>
            </div>
        </div>
    </div>

    <div class="modern-content-section">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="modern-card text-center">
                        <img loading="lazy" src="{{vasset($about->file)}}" class="w-100 rounded" alt="{{$about->title}}">
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="modern-card">
                        <h2 class="modern-section-title">{{$about->title}}</h2>
                        <div class="modern-text-content">
                            {!! $about->desc !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
