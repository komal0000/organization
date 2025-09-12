@extends('front.layout')
@section('meta')
    @includeIf('front.cache.home.meta')
@endsection
@section('content')
    <div class="jumbotron">
        <div class="text-center">
            <a href="{{ route('home') }}">Home </a> /
            <a href="{{route('about')}}">
                About Us
            </a>
            <div class="text-center">
                <a class="active">
                    {{$about->title}}
                </a>
            </div>
        </div>
    </div>

    <div id="aboutsingle-page" class="py-5">
        <div class="container">


            <div class="row mb-3">
                <div class="col-md-3">
                    <div class="image shadow">

                        <img  loading="lazy"  src="{{vasset($about->file)}}" class="w-100" alt="">

                    </div>
                </div>
                <div class="col-md-9 short_desc">
                    <h2>
                        {{$about->title}}
                    </h2>
                    <div class="desc">
                        {!! $about->desc !!}
                    </div>
                </div>
            </div>


        </div>
    </div>




@endsection
@section('js')

@endsection
