@extends('front.layout')
@section('meta')
    @includeIf('front.cache.home.meta')
@endsection
@section('content')
    <div class="jumbotron modern">
        <div class="text-center">
            <h1>{{ $committee->title }}</h1>
            <p>Meet the dedicated members of this committee</p>
            <div class="mt-3">
                <a href="{{ route('home') }}">Home</a> /
                <a href="{{ route('committees') }}">Committees</a> /
                <a class="active">{{ Str::limit($committee->title, 30) }}</a>
            </div>
        </div>
    </div>

    <div class="modern-content-section">
        <div class="container">
            <h2 class="modern-section-title">Committee Members</h2>

            <div class="row">
                @foreach ($members as $member)
                    <div class="col-md-4 mb-4">
                        <div class="modern-card text-center">
                            <div class="mb-3">
                                <img loading="lazy" src="{{ asset($member->image) }}"
                                     alt="{{ $member->name }}"
                                 class="img-fluid rounded-circle"
                                 style="width: 120px; height: 120px; object-fit: cover;">
                        </div>
                        <h5 class="card-title">{{ $member->name }}</h5>
                        <p class="modern-text-muted">{{ $member->desig }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
