<div id="about-page" class="py-5">
    <div class="container">

        <div class="">

            @foreach ($abouts as $singleabout)
                <div class="single-about">

                    <div class="image">
                        <img  loading="lazy"  src="{{vasset($singleabout->file)}}" alt="">
                    </div>
                    <div class="text">
                        <div class="title">
                            {{$singleabout->title}}
                        </div>
                        <div class="desc">
                            {{$singleabout->short_desc}}
                        </div>
                        <div class="mt-3 text-center text-md-end">
                            <a href="{{route('about.single',['slug'=>$singleabout->slug])}}" class="detail">
                                View In Detail
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
