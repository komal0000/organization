<div class="accordion" id="accordion-faq">
    @foreach ($faqs as $key=>$faq)

    <div class="accordion-item">
        <h2 class="accordion-header" id="heading{{$key}}">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapse{{$key}}" aria-expanded="false" aria-controls="collapse{{$key}}">
                {{$faq->title}}
            </button>
        </h2>
        <div id="collapse{{$key}}" class="accordion-collapse collapse" aria-labelledby="heading{{$key}}"
            data-bs-parent="#accordion-faq">
            <div class="accordion-body">
               {!! $faq->short_desc !!}
            </div>
        </div>
    </div>
    @endforeach

</div>
