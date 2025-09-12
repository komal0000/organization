@extends('front.layout')
@section('meta')
    @includeIf('front.cache.home.meta')
@endsection
@section('content')
    <div class="jumbotron">
        <div class="text-center">
            <a href="{{route('home')}}">Home </a> /
            <a href="{{route('gallery')}}">Gallery </a> /
            <br>
            <a class="active">
                {{$gallery->title}}
            </a>
        </div>
    </div>

    <div class="py-5" id="gallery-single-page">
        <div class="container">
            <div class="row m-0">
                @foreach ($gallery->images as $image)
                    <div class="col-md-2 col-6 p-1">
                        <div class="image">
                            <img  loading="lazy"  src="{{vasset($image->thumb)}}" loading="lazy" alt="" href="{{vasset($image->file)}}" data-fancybox="gallery" data-caption="image">
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection
@section('js')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css" />
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>

<script>
    $(document).ready(function () {

    });
</script>
@endsection
