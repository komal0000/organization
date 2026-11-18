@if(isset($data['is_active']) && $data['is_active'])
@php
    $vmgItems = [
        ['01', $data['vision_title'] ?? null, $data['vision_description'] ?? null],
        ['02', $data['mission_title'] ?? null, $data['mission_description'] ?? null],
        ['03', $data['goals_title'] ?? null, $data['goals_description'] ?? null],
    ];
@endphp
<section class="home-block vmg-section">
    <div class="container">
        <div class="row g-4 g-lg-5">
            <div class="col-lg-4">
                <div class="vmg-intro">
                    @if(!empty($data['section_title']))
                    <h2 class="home-heading">{{ $data['section_title'] }}</h2>
                    @endif
                    @if(!empty($data['section_subtitle']))
                    <p class="vmg-lead">{{ $data['section_subtitle'] }}</p>
                    @endif
                </div>
            </div>
            <div class="col-lg-8">
                @foreach($vmgItems as [$num, $title, $desc])
                    @if($title || $desc)
                    <div class="vmg-row">
                        <span class="vmg-num">{{ $num }}</span>
                        <div>
                            @if($title)
                            <h3 class="vmg-title">{{ $title }}</h3>
                            @endif
                            @if($desc)
                            <p class="vmg-text">{{ $desc }}</p>
                            @endif
                        </div>
                    </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</section>
@endif
