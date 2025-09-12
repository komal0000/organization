@extends('front.layout')
@section('meta')
    @includeIf('front.cache.home.meta')
@endsection
@section('content')
    <div class="jumbotron">
        <div >
            <a href="{{route('home')}}">Home </a> /
            <a class="active">
                News
            </a>
        </div>
    </div>
    <div class="py-5 container">
        <div class="row" id="news"></div>
        <div class=" mt-3 mt-md-5" id="newspagination"></div>
    </div>

@endsection
@section('js')
    @include('front.includes.page')
    <script>
        const template=`<div class="col-md-4 mb-3">
                            <a class="news-single" href="{{route('news.single',['slug'=>'xxx_slug'])}}">
                                <div class="img"><img  loading="lazy"  src="xxx_img" class=".lazy" ></div>
                                <div class="titleholder">
                                        <div class="date">xxx_date</div>
                                        <div class="newstitle">
                                            xxx_title
                                        </div>
                                </div>
                            </a>
                        </div>`;

        const render=(data)=>{
            let html= template.replace('xxx_slug',data.s).replace('xxx_img',data.f).replace('xxx_date',data.date).replace('xxx_title',data.t);
            return html;
        };
        const news={!! json_encode($news) !!};
        const selectedItems=(items)=>{
            $('#news').html(
                items.map(o=>render(o)).join('')
            );
        };
        var paginator;
        $(document).ready(function () {
            paginator=createPaginator(news,3,'newspagination',selectedItems);
            paginator.init();
            paginator.setPage(1);
        });


    </script>
@endsection
