@extends('front.layout')
@section('meta')
    @includeIf('front.cache.home.meta')
@endsection
@section('content')
    <div class="jumbotron">
        <div>
            <a href="{{route('home')}}">Home </a> /
            <a class="active">
                Gallery
            </a>
        </div>
    </div>
    <div class="py-5 container">
        @include('front.cache.page.galleries')
    </div>
@endsection
