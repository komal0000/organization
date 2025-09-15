@extends('front.layout')
@section('meta')
    @includeIf('front.cache.home.meta')
@endsection
@section('content')
    <div class="jumbotron modern">
        <div class="text-center">
            <h1>Photo Gallery</h1>
            <p>Explore our collection of memorable moments and events</p>
            <div class="mt-3">
                <a href="{{ route('home') }}">Home</a> /
                <a class="active">Gallery</a>
            </div>
        </div>
    </div>

    <div class="modern-content-section">
        <div class="container">
            @includeIf('front.cache.page.galleries')
        </div>
    </div>
@endsection
