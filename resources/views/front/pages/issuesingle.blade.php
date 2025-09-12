@extends('front.layout')
@section('meta')
    @includeIf('front.cache.home.meta')
@endsection
@section('content')
    <div class="jumbotron">
        <div class="text-center">
            <a href="{{ route('home') }}">Home </a> /
            <a href="{{ route('issues') }}">Issues </a>
            <br>
            <a class="active">
                {{$currentIssue->title}}
            </a>
        </div>
    </div>

    <div id="news-page-single" class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-8 mb-3">


                    <div class="title">
                        {{$currentIssue->title}}
                    </div>

                    <div class="full">
                        {!! $currentIssue->desc !!}
                    </div>
                </div>
                <div class="col-md-4">
                    @include('front.cache.page.issuesextra')
                </div>
            </div>
        </div>
    </div>


@endsection
@section('js')

@endsection
