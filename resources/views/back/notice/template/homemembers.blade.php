<div id="homemembers">
    <div class="row members">
        <div class="col-12 title">
            {{ $notice->title }}
        </div>
        @foreach ($teams as $team)
            <div class="col-6">
                <div class="member text-center">
                    <div class="member-image">
                        <img  loading="lazy"  src="{{vasset($team->image)}}"
                            alt="">
                    </div>
                    <div class="name">{{ $team->name }}</div>
                    <div class="desig">
                        {{$team->desig}} <br>
                        {{$notice->title}}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
