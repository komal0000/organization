@extends('front.layout')
@section('meta')
    @includeIf('front.cache.home.meta')
@endsection
@section('content')
    <div class="jumbotron modern">
        <div class="text-center">
            <h1>About Us</h1>
            <p>Learn more about our organization, mission, and values</p>
            <div class="mt-3">
                <a href="{{ route('home') }}">Home</a> /
                <a class="active">About Us</a>
            </div>
        </div>
    </div>

    <div class="modern-content-section">
        <div class="container">
            @includeIf('front.cache.page.about')
        </div>
    </div>
@endsection
@section('js')

@endsection
