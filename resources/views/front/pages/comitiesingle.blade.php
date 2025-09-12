@extends('front.layout')
@section('meta')
    @includeIf('front.cache.home.meta')
@endsection
@section('content')
    <div class="jumbotron">
        <div class="text-center">
            <a href="{{ route('home') }}">Home </a> /
            <a href="{{ route('committees') }}">Committees </a> /
            <br>
            <a class="active">
                {{ $committee->title }}
            </a>
        </div>
    </div>

    <div id="comities-page">
        <div class="single-committee">
            <div class="container py-5">
                <div class="row">
                    @foreach ($members as $member)
                        <div class="col-md-4">
                            <div class="single-member">
                                <div class="image">
                                    <img  loading="lazy"  src="{{ asset($member->image) }}" alt="">
                                </div>
                                <div class="desc">
                                    <div class="name">
                                        {{ $member->name }}
                                    </div>

                                    <div class="desig">
                                        {{ $member->desig }}
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
@endsection
