@if(isset($data['is_active']) && $data['is_active'])
<section class="home-block objectives-section">
    <div class="container">
        @if(!empty($data['section_title']) || !empty($data['section_subtitle']))
        <div class="text-center mb-4 mb-lg-5">
            @if(!empty($data['section_title']))
            <h2 class="home-heading">{{ $data['section_title'] }}</h2>
            @endif
            @if(!empty($data['section_subtitle']))
            <p class="impact-lead">{{ $data['section_subtitle'] }}</p>
            @endif
        </div>
        @endif

        @if(isset($data['objectives']) && count($data['objectives']) > 0)
        <div class="objective-grid">
            @foreach($data['objectives'] as $objective)
            <div class="objective-item">
                <span class="objective-icon"><i class="{{ $objective['icon'] ?? 'fas fa-bullseye' }}" aria-hidden="true"></i></span>
                @if(!empty($objective['title']))
                <h3 class="objective-title">{{ $objective['title'] }}</h3>
                @endif
            </div>
            @endforeach
        </div>
        @endif
    </div>
</section>
@endif
