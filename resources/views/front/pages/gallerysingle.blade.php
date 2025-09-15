@extends('front.layout')
@section('meta')
    @includeIf('front.cache.home.meta')
@endsection
@section('content')
    <div class="jumbotron modern">
        <div class="text-center">
            <h1>{{$gallery->title}}</h1>
            <p>Explore our photo gallery</p>
            <div class="mt-3">
                <a href="{{route('home')}}">Home</a> /
                <a href="{{route('gallery')}}">Gallery</a> /
                <a class="active">{{Str::limit($gallery->title, 30)}}</a>
            </div>
        </div>
    </div>

    <div class="modern-content-section">
        <div class="container">
            <div class="modern-grid modern-grid-6">
                @foreach ($gallery->images as $image)
                    <div class="modern-gallery-item">
                        <img loading="lazy"
                             src="{{vasset($image->thumb)}}"
                             alt="Gallery Image"
                             href="{{vasset($image->file)}}"
                             data-fancybox="gallery"
                             data-caption="{{$gallery->title}}"
                             class="w-100 rounded shadow-sm">
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
