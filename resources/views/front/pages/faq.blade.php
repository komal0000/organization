@extends('front.layout')
@section('meta')
    @includeIf('front.cache.home.meta')
@endsection
@section('content')
    <div class="jumbotron modern">
        <div class="text-center">
            <h1>Frequently Asked Questions</h1>
            <p>Find answers to commonly asked questions about our organization</p>
        </div>
    </div>

    <div class="modern-content-section" id="faq-page">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="modern-section-title">Do you need help?</h2>
                <p class="modern-text-muted">We have answers to all your questions.</p>
            </div>

            <div class="accordion mt-5" id="accordion-faq">
                <div class="row">
                    @foreach ($faqs as $key=>$faq)
                        <div class="col-md-6 mb-3">
                            <div class="modern-card">
                                <div class="accordion-item border-0">
                                    <h2 class="accordion-header" id="heading{{$key}}">
                                        <button class="accordion-button collapsed bg-transparent border-0 p-0 text-start"
                                                type="button" data-bs-toggle="collapse"
                                                data-bs-target="#collapse{{$key}}" aria-expanded="false"
                                                aria-controls="collapse{{$key}}">
                                            <strong>{{ $faq->title }}</strong>
                                        </button>
                                    </h2>
                                    <div id="collapse{{$key}}" class="accordion-collapse collapse"
                                         aria-labelledby="heading{{$key}}" data-bs-parent="#accordion-faq">
                                        <div class="accordion-body p-0 pt-3">
                                            <p class="modern-text-muted">{{ $faq->short_desc }}</p>
                                        </div>
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
