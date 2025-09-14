@if(isset($data['is_active']) && $data['is_active'])
<section class="home-block vision-mission-goals-section py-5">
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

        <div class="row">
            <!-- Vision -->
            <div class="col-lg-4 col-md-12 mb-4">
                <div class="vmg-card vision-card h-100">
                    <div class="vmg-icon">
                        <i class="fas fa-eye"></i>
                    </div>
                    <div class="vmg-content">
                        @if(isset($data['vision_title']))
                        <h4 class="vmg-title">{{ $data['vision_title'] }}</h4>
                        @endif
                        @if(isset($data['vision_description']))
                        <p class="vmg-description">{{ $data['vision_description'] }}</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Mission -->
            <div class="col-lg-4 col-md-12 mb-4">
                <div class="vmg-card mission-card h-100">
                    <div class="vmg-icon">
                        <i class="fas fa-rocket"></i>
                    </div>
                    <div class="vmg-content">
                        @if(isset($data['mission_title']))
                        <h4 class="vmg-title">{{ $data['mission_title'] }}</h4>
                        @endif
                        @if(isset($data['mission_description']))
                        <p class="vmg-description">{{ $data['mission_description'] }}</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Goals -->
            <div class="col-lg-4 col-md-12 mb-4">
                <div class="vmg-card goals-card h-100">
                    <div class="vmg-icon">
                        <i class="fas fa-bullseye"></i>
                    </div>
                    <div class="vmg-content">
                        @if(isset($data['goals_title']))
                        <h4 class="vmg-title">{{ $data['goals_title'] }}</h4>
                        @endif
                        @if(isset($data['goals_description']))
                        <p class="vmg-description">{{ $data['goals_description'] }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.vision-mission-goals-section {
    background: linear-gradient(135deg, #fff 0%, #f8f9fa 100%);
}

.vmg-card {
    background: white;
    border-radius: 15px;
    padding: 2.5rem 2rem;
    text-align: center;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
    border: 1px solid rgba(7, 68, 99, 0.1);
    position: relative;
    overflow: hidden;
}

.vmg-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, var(--org-primary) 0%, var(--org-base) 100%);
}

.vmg-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 15px 40px rgba(0,0,0,0.15);
}

.vision-card::before {
    background: linear-gradient(90deg, #3498db 0%, #2980b9 100%);
}

.mission-card::before {
    background: linear-gradient(90deg, #27ae60 0%, #229954 100%);
}

.goals-card::before {
    background: linear-gradient(90deg, #f39c12 0%, #e67e22 100%);
}

.vmg-icon {
    width: 90px;
    height: 90px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 2rem;
    position: relative;
}

.vision-card .vmg-icon {
    background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
}

.mission-card .vmg-icon {
    background: linear-gradient(135deg, #27ae60 0%, #229954 100%);
}

.goals-card .vmg-icon {
    background: linear-gradient(135deg, #f39c12 0%, #e67e22 100%);
}

.vmg-icon i {
    font-size: 2.5rem;
    color: white;
}

.vmg-title {
    font-size: 1.8rem;
    font-weight: 700;
    margin-bottom: 1.5rem;
    color: var(--org-primary);
}

.vmg-description {
    color: #6c757d;
    line-height: 1.7;
    margin-bottom: 0;
    font-size: 1.1rem;
}

.section-title {
    color: var(--org-primary);
    font-size: 2.8rem;
    font-weight: 700;
    margin-bottom: 1rem;
}

.section-subtitle {
    color: #6c757d;
    font-size: 1.3rem;
    margin-bottom: 0;
    font-weight: 300;
}

@media (max-width: 768px) {
    .vmg-card {
        padding: 2rem 1.5rem;
        margin-bottom: 2rem;
    }

    .section-title {
        font-size: 2.2rem;
    }

    .vmg-title {
        font-size: 1.5rem;
    }

    .vmg-icon {
        width: 70px;
        height: 70px;
    }

    .vmg-icon i {
        font-size: 2rem;
    }
}
</style>
@endif
