<div id="issues-page">
    <div class="container py-5">
        <div class="row">
            @foreach ($issues as $issue)
                <div class="col-md-6">
                    <div class="issue">
                        <div class="issue-title">{{$issue->title}}</div>
                        <div class="issue-desc">{{$issue->short_desc}}</div>
                        <div class="text-end">
                            <a href="{{route('issue.single',['slug'=>$issue->slug])}}" class="view-more">Read More</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
