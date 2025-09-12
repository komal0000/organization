@extends('front.layout')
@section('meta')
    @includeIf('front.cache.home.meta')
@endsection
@section('content')
    <div class="jumbotron">
        <div class="text-center">
            <a href="{{ route('home') }}">Home </a> /
            <a class="active">
                Issues
            </a>
        </div>
    </div>

    @includeIf('front.cache.page.issues')

@endsection
@section('js')

@endsection
