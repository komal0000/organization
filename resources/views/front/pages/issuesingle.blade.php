@extends('front.layout')
@section('meta')
    @includeIf('front.cache.home.meta')
@endsection
@section('content')
    <div class="jumbotron modern">
        <div class="text-center">
            <h1>{{$currentIssue->title}}</h1>
            <p>Important matters and organizational concerns</p>
            <div class="mt-3">
                <a href="{{ route('home') }}">Home</a> /
                <a href="{{ route('issues') }}">Issues</a> /
                <a class="active">{{Str::limit($currentIssue->title, 30)}}</a>
            </div>
        </div>
    </div>

    <div class="modern-content-section">
        <div class="container">
            <div class="row">
                <div class="col-md-8 mb-4">
                    <div class="modern-card">
                        <h2 class="modern-section-title">{{$currentIssue->title}}</h2>
                        <div class="modern-text-content">
                            {!! $currentIssue->desc !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="modern-card">
                        @include('front.cache.page.issuesextra')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
