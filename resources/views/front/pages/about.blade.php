@extends('front.layout')
@section('meta')
    @includeIf('front.cache.home.meta')
@endsection
@section('content')
    <div class="jumbotron">
        <div class="text-center">
            <a href="{{ route('home') }}">Home </a> /
            <a class="active">
                About Us
            </a>
        </div>
    </div>


    @include('front.cache.page.about')


@endsection
@section('js')

@endsection
