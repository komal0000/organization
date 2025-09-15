@extends('front.layout')
@section('meta')
    @includeIf('front.cache.home.meta')
@endsection
@section('content')
    <div class="jumbotron modern">
        <div class="text-center">
            <h1>Contact Us</h1>
            <p>Get in touch with us for any inquiries or questions</p>
        </div>
    </div>

    <div class="modern-content-section">
        <div class="container">
            @includeIf('front.cache.page.contact')
        </div>
    </div>
@endsection
