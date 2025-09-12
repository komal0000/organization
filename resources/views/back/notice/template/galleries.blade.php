<div class="galleries">
    <div class="container">
        <div class="row ">
            @foreach ($galleries as $gallery)

                <div class="col-md-3 col-6 p-1 p-md-2">
                    <a class="gallery-single" href="{{route('gallery.single',['slug'=>$gallery->slug])}}">
                        <div class="img">
                            <img  loading="lazy"  src="{{vasset($gallery->file)}}" alt="">
                        </div>
                        <div class="overlay">
                            {{$gallery->title}}
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>
