@if ($sliders->count()>0)
    <div id="homecarousel" class="carousel slide" data-bs-ride="carousel" >
        <div class="carousel-inner">
            @foreach ($sliders as $key=>$slider)

                <div class="carousel-item {{$key==0?'active':''}}" data-bs-interval="10000">
                    <div class="slider-item">
                        <img src="{{vasset($slider->mobile_image)}}" class="d-block d-md-none" alt="">
                        <img src="{{vasset($slider->image)}}" class="d-md-block d-none" alt="">
                        <div class="slider-info">
                            <div class="title">{!!$slider->title!!}</div>
                            <div class="subtitle">{!!$slider->subtitle!!}</div>
                            @if ($slider->link!='')
                            <div class="btn-holder">
                                <a href="{{$slider->link}}" class="slider-button">Discover More</a>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
        @if ($sliders->count()>1)
            <button class="carousel-control-prev" type="button" data-bs-target="#homecarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#homecarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
            </button>

        @endif
    </div>
@endif
