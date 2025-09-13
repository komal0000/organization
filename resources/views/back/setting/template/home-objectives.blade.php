@if(isset($data['is_active']) && $data['is_active'])
<section class="home-block objectives-section py-5">
    <div class="container">
        @if(isset($data['section_title']) || isset($data['section_subtitle']))
        <div class="row">
            <div class="col-12 text-center mb-5">
                @if(isset($data['section_title']))
                <h2 class="section-title">{{ $data['section_title'] }}</h2>
                @endif
                @if(isset($data['section_subtitle']))
                <p class="section-subtitle">{{ $data['section_subtitle'] }}</p>
                @endif
            </div>
        </div>
        @endif

        @if(isset($data['objectives']) && count($data['objectives']) > 0)
        <div class="row">
            @foreach($data['objectives'] as $objective)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="objective-card h-100">
                    <div class="objective-icon">
                        <i class="{{ $objective['icon'] ?? 'fas fa-bullseye' }}"></i>
                    </div>
                    <div class="objective-content">
                        @if(isset($objective['title']))
                        <h4 class="objective-title">{{ $objective['title'] }}</h4>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</section>

<style>
.objectives-section {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
}

.objective-card {
    background: white;
    border-radius: 15px;
    padding: 2rem;
    text-align: center;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
    border: 1px solid rgba(7, 68, 99, 0.1);
}

.objective-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.15);
}

.objective-icon {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, var(--org-primary) 0%, var(--org-base) 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.5rem;
}

.objective-icon i {
    font-size: 2rem;
    color: white;
}

.objective-title {
    color: var(--org-primary);
    font-size: 1.5rem;
    font-weight: 600;
    margin-bottom: 0;
}

.section-title {
    color: var(--org-primary);
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 1rem;
}

.section-subtitle {
    color: #6c757d;
    font-size: 1.2rem;
    margin-bottom: 0;
}

@media (max-width: 768px) {
    .objective-card {
        padding: 1.5rem;
    }

    .section-title {
        font-size: 2rem;
    }

    .objective-title {
        font-size: 1.3rem;
    }
}
</style>
@endif
