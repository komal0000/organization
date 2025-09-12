<div id="homenotices">
    <div class="title">Recent Notices</div>
    <div class="notices mb-4">
        @foreach ($notices as $notice)

        <a class="single-notice" href="{{vasset($notice->file)}}" target="_blank" download="{{$notice->slug}}">
            <span class="date">
                {{noticeDate($notice)}}
            </span>
            <div class="notice-title">
                {{$notice->title}}
            </div>

        </a>
        @endforeach

    </div>
    <div class="text-center">
        <a href="/notices" class="viewmore">View More</a>
    </div>
</div>
