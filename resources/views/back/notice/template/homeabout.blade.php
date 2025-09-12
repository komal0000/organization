<div id="home-about">
    <div class="image">
        <img  loading="lazy"  src="{{vasset($about->file)}}" alt="" srcset="">
    </div>
    <div class="home-text">
        <div class="subtitle">
            About Us
        </div>
        <div class="title">
            {{$about->title}}
        </div>
        <div class="desc">
            {{$about->short_desc}}
        </div>
        <div>
            <a href="{{route('about')}}" class="more">
                View More
            </a>
        </div>
    </div>
</div>
