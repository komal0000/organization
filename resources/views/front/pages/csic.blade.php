@extends('front.layout')
@section('meta')
    @includeIf('front.cache.home.meta')
@endsection
@section('content')
    <div class="jumbotron modern">
        <div class="text-center">
            <h1>CISC Registration</h1>
            <p>Join the Canadian Institute of Steel Construction</p>
        </div>
    </div>

    <div class="modern-content-section">
        <div class="container">
            <div class="modern-card text-center">
                <h3>Ready to Join CISC?</h3>
                <p class="modern-text-muted mb-4">Take the next step in your steel construction career</p>
                <a href="{{ route('registration') }}" class="btn btn-modern-primary btn-lg">Register for CISC</a>
            </div>
        </div>
    </div>
@endsection
