@extends('front.layout')
@section('meta')
    @includeIf('front.cache.home.meta')
@endsection
@section('content')
    <div class="jumbotron modern">
        <div class="text-center">
            <h1>Our Committees</h1>
            <p>Meet the dedicated members who lead our organization forward</p>
            <div class="mt-3">
                <a href="{{ route('home') }}">Home</a> /
                <a class="active">Committees</a>
            </div>
        </div>
    </div>

    <div id="comities-page" class="modern-content-section">
        <div class="modern-content-section" style="padding: 0px;margin-top: 0px;">
            <div class="container">
                <div class="modern-card">
                    <div class="mb-4">
                        <input type="search" class="form-control form-control-lg" placeholder="Search Committees"
                            id="search" oninput="search()">
                    </div>

                    <div id="results" class="modern-grid modern-grid-2"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        const url = "{{ route('committee.single', ['slug' => 'xxx_slug']) }}";
        const committees = {!! json_encode($committees) !!};

        function search() {
            const keywords = $('#search').val().trim().toLowerCase();
            const datas = committees.filter(o => o.title.toLowerCase().includes(keywords));
            $('#results').html(
                datas.map(o => `
                    <div class="modern-card">
                        <h5 class="card-title">${o.title}</h5>
                        <p class="modern-text-muted">Committee details</p>
                        <a href="${url.replace('xxx_slug',o.slug)}" class="btn btn-modern-primary btn-sm">View Committee</a>
                    </div>
                `).join('')
            );
        }

        $(document).ready(function() {
            search();
        });
    </script>
@endsection
