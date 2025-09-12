@extends('front.layout')
@section('meta')
    @includeIf('front.cache.home.meta')
@endsection
@section('content')
    <div class="jumbotron">
        <div >
            <a href="{{route('home')}}">Home </a> /
            <a class="active">
                Notices
            </a>
        </div>
    </div>
    <div id="notice-page" class="py-5 container">

        <div class=" mt-3 mt-md-5" id="newspagination">
            @foreach ($notices as $notice)
                <small>
                    {{noticeDate($notice)}}
                </small>
                <br>
                <a href="{{vasset($notice->file)}}" class="notice" target="_blank" download="{{$notice->title}}">{{$notice->title}}</a>
                <hr>
            @endforeach
        </div>
    </div>

@endsection
