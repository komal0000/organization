@extends('front.layout')
@section('meta')
    @includeIf('front.cache.home.meta')
@endsection
@section('content')
    <div class="jumbotron modern">
        <div class="text-center">
            <h1>Issues & Concerns</h1>
            <p>Important matters and initiatives we're addressing</p>
        </div>
    </div>

    <div class="modern-content-section">
        @includeIf('front.cache.page.issues')
    </div>
@endsection
@section('js')

@endsection
