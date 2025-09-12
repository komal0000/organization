<div id="homenews">
    <div class="container">
        <div class="title">News & articles</div>
        <div class="subtitle">latest news and articles</div>
        <div class="news">
            <div class="row">
                @foreach ($allnews as $news)
                <div class="col-md-4 mb-3">
                    <a class="news-single" href="{{route('news.single',['slug'=>$news->slug])}}">
                        <div class="img"><img  loading="lazy"  src="{{vasset($news->file)}}" alt=""></div>
                       <div class="titleholder">
                            <div class="date">{{noticeDate($news)}}</div>
                            <div class="newstitle">
                                {{$news->title}}
                            </div>
                       </div>
                    </a>
                </div>

                @endforeach
            </div>
        </div>
    </div>
</div>
