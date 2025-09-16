@extends('front.layout')
@section('meta')
    @includeIf('front.cache.home.meta')
@endsection
@section('content')
    <div class="jumbotron modern">
        <div class="text-center">
            <h1>CSIC Registration</h1>
            <p>Join the Catalyst Startup Idea Competition </p>
        </div>
    </div>

    <div class="modern-content-section">
        <div class="container">
            <div class="modern-card text-center">
                <h3>Ready to Join CSIC?</h3>
                <p class="modern-text-muted mb-4">Take Part In Our Annual Competition</p>
                <a href="{{ route('registration') }}" class="btn btn-modern-primary btn-lg">Register for CSIC</a>
            </div>
        </div>
    </div>
@endsection
