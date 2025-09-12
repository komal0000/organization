<div class="extra">
    @foreach ($issues as $issue)
    <a href="{{route('issue.single',['slug'=>$issue->slug])}}" class="extra-single">
        {{$issue->title}}
    </a>
    <hr class="m-0">
    @endforeach
</div>
