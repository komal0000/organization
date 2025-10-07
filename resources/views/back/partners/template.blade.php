@if ($partners->count() > 0)
<div class="partners-section">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-4">
                <h3 class="partners-title">OUR PARTNERS</h3>
                <div class="title-underline"></div>
            </div>
        </div>
        <div class="row justify-content-center align-items-center">
            @foreach ($partners as $partner)
            <div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-4">
                <div class="partner-item">
                    @if($partner->link)
                        <a href="{{$partner->link}}" target="_blank" rel="noopener noreferrer" class="partner-link">
                            <img loading="lazy" src="{{asset($partner->image)}}" alt="{{$partner->name}}" class="partner-logo">
                        </a>
                    @else
                        <div class="partner-link">
                            <img loading="lazy" src="{{asset($partner->image)}}" alt="{{$partner->name}}" class="partner-logo">
                        </div>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif
