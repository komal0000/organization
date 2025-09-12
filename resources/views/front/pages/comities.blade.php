@extends('front.layout')
@section('meta')
    @includeIf('front.cache.home.meta')
@endsection
@section('content')
    <div class="jumbotron">
        <div class="text-center">
            <a href="{{ route('home') }}">Home </a> /
            <a class="active">
                Committees
            </a>
        </div>
    </div>

    <div id="comities-page">
        @php
            $committee = $committees->where('is_main', 1)->first();

        @endphp
        @if ($committee)
            @php
                $members = getMember($committee->id);
            @endphp

            <div class="single-committee">
                <div class="container py-5">

                    <h4 class="title d-flex">
                        {{ $committee->title }}
                    </h4>
                    <div class="row">

                        @foreach ($members->take(6) as $member)
                            <div class="col-md-4">
                                <div class="single-member">
                                    <div class="image">
                                        <img  loading="lazy"  src="{{ asset($member->image) }}" alt="">
                                    </div>
                                    <div class="desc">
                                        <div class="name">
                                            {{ $member->name }}
                                        </div>

                                        <div class="desig">
                                            {{ $member->desig }}
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="text-center my-md-4 my-2 ">

                        <a class="detail" href="{{route('committee.single',['slug'=>$committee->slug])}}">View More</a>
                    </div>

                </div>
                <br>
                <br>
            </div>
        @endif



        <div class="others py-3 py-md-5">
            <div class="container">
                <div class="search">
                    <input type="search" placeholder="Search Comitties" id="search" oninput="search()" >
                </div>
                <div id="results" class="results row">

                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        const url="{{route('committee.single',['slug'=>'xxx_slug'])}}";
        const committees = {!! json_encode($committees) !!};
        function search(){
            const keywords=$('#search').val().trim().toLowerCase();
            const datas=committees.filter(o=>o.title.toLowerCase().includes(keywords));
            $('#results').html(
                datas.map(o=>`
                <div class="col-md-6">
                    <a class="result" href="${url.replace('xxx_slug',o.slug)}">
                        ${o.title}
                    </a>
                </div>`).join('')
            );
        }

        $(document).ready(function () {
            search();
        });
    </script>
@endsection
