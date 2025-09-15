@extends('front.layout')
@section('meta')
    @includeIf('front.cache.home.meta')
@endsection
@section('content')
    <div class="jumbotron modern">
        <div class="text-center">
            <h1>Notices</h1>
            <p>Important announcements and notices from our organization</p>
        </div>
    </div>

    <div id="notice-page" class="modern-content-section">
        <div class="container">
            <div class="row">
                @foreach ($notices as $notice)
                    <div class="col-md-6 mb-4">
                        <div class="modern-card">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <small class="modern-text-muted">
                                    <i class="fas fa-calendar me-1"></i>
                                    {{ noticeDate($notice) }}
                                </small>
                                <span class="badge bg-primary">Notice</span>
                            </div>
                            <h5 class="card-title">{{ $notice->title }}</h5>
                            <div class="mt-3">
                                <a href="{{ vasset($notice->file) }}"
                                   class="btn-modern-primary"
                                   target="_blank"
                                   download="{{ $notice->title }}">
                                    <i class="fas fa-download me-2"></i>Download Notice
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
