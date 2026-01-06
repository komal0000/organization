@extends('front.layout')
@section('meta')
    @includeIf('front.cache.home.meta')
@endsection
@section('content')
    <div class="jumbotron modern">
        <div class="text-center">
            <h1>{{ $member->name }}</h1>
            <p>{{ $member->desig }}</p>
            <div class="mt-3">
                <a href="{{ route('home') }}">Home</a> /
                <a href="{{ route('committees') }}">Committees</a> /
                <a
                    href="{{ route('committee.single', ['slug' => $committee->slug]) }}">{{ Str::limit($committee->title, 30) }}</a>
                /
                <a class="active">{{ Str::limit($member->name, 30) }}</a>
            </div>
        </div>
    </div>

    <div class="modern-content-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="modern-card text-center">
                        <div class="row">
                            <div class="col-md-12">
                                   @if ($member->image)
                                    <div class="mb-4">
                                        <img loading="lazy" src="{{ asset($member->image) }}" alt="{{ $member->name }}"
                                            class="img-fluid rounded-circle"
                                            style="width: 200px; height: 200px; object-fit: cover;">
                                    </div>
                                @else
                                    <div class="mb-4">
                                        <img loading="lazy"
                                            src="{{ asset('front/img/employee-faceless-man-avatar-headshot-vector-54411540-removebg-preview.png') }}"
                                            alt="{{ $member->name }} - Professional Avatar"
                                            class="img-fluid rounded-circle"
                                            style="width: 200px; height: 200px; object-fit: cover;">
                                    </div>
                                @endif

                                <h2 class="mb-2">{{ $member->name }}</h2>
                                <p class="modern-text-muted mb-4"><strong>{{ $member->desig }}</strong></p>
                            </div>
                            <div class="col-md-8">
                                @if ($member->address || $member->phone || $member->email)
                                    <div class="text-start mt-4">
                                        <h5 class="mb-3">Contact Information</h5>

                                        @if ($member->address)
                                            <div class="mb-3">
                                                <strong>Address:</strong>
                                                <p class="mb-0 modern-text-muted">{{ $member->address }}</p>
                                            </div>
                                        @endif

                                        @if ($member->phone)
                                            <div class="mb-3">
                                                <strong>Phone:</strong>
                                                <p class="mb-0 modern-text-muted">{{ $member->phone }}</p>
                                            </div>
                                        @endif

                                        @if ($member->email)
                                            <div class="mb-3">
                                                <strong>Email:</strong>
                                                <p class="mb-0 modern-text-muted">
                                                    <a href="mailto:{{ $member->email }}">{{ $member->email }}</a>
                                                </p>
                                            </div>
                                        @endif
                                    </div>
                                @endif

                            </div>
                            <div class="col-md-4">
                                @if ($member->linkedin || $member->facebook)
                                    <div class="mt-4">
                                        <h5 class="mb-3">Social Media</h5>
                                        <div class="d-flex justify-content-center gap-3">
                                            @if ($member->linkedin)
                                                <a href="{{ $member->linkedin }}" target="_blank" title="LinkedIn Profile">
                                                    <img src="https://cdn-icons-png.flaticon.com/512/174/174857.png"
                                                        alt="LinkedIn" style="width: 32px; height: 32px; object-fit: contain;">
                                                </a>
                                            @endif

                                            @if ($member->facebook)
                                                <a href="{{ $member->facebook }}" target="_blank" title="Facebook Profile">
                                                    <img src="https://cdn-icons-png.flaticon.com/512/124/124010.png"
                                                        alt="Facebook" style="width: 32px; height: 32px; object-fit: contain;">
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
