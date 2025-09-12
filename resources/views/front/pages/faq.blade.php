@extends('front.layout')
@section('meta')
    @includeIf('front.cache.home.meta')
@endsection
@section('content')
    <div class="jumbotron">
        <div class="text-center">
            <a href="{{ route('home') }}">Home </a> /
            <a class="active">
                FAQ
            </a>
        </div>
    </div>

    <div class="py-5" id="faq-page">
        <div class="container">
            <div class="title">
                Do you need help?

            </div>
            <div class="subtitle">
                We answers to all your questions.
            </div>
            <div class="accordion mt-5"  id="accordion-faq">
                <div class="row">

                    @foreach ($faqs as $key=>$faq)
                        <div class="col-md-6">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading{{$key}}">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapse{{$key}}" aria-expanded="false" aria-controls="collapse{{$key}}">
                                        {{ $faq->title }}
                                    </button>
                                </h2>
                                <div id="collapse{{$key}}" class="accordion-collapse collapse" aria-labelledby="heading{{$key}}"
                                    data-bs-parent="#accordion-faq">
                                    <div class="accordion-body">
                                        {{ $faq->short_desc }}
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
