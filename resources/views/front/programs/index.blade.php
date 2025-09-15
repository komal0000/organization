@extends('front.layout')

@section('head-title')
    <title>Our Programs | {{ config('app.name') }}</title>
@endsection

@section('meta')
    <meta name="description" content="Discover our comprehensive programs designed to foster entrepreneurship, innovation, and professional development.">
    <meta name="keywords" content="programs, entrepreneurship, innovation, professional development, business">
@endsection

@section('css')
<style>
    .programs-hero {
        background: linear-gradient(135deg, #f4891f 0%, #faac19 100%);
        color: white;
        padding: 80px 0;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .programs-hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background:
            radial-gradient(circle at 20% 80%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
            radial-gradient(circle at 80% 20%, rgba(255, 255, 255, 0.1) 0%, transparent 50%);
        pointer-events: none;
    }

    .programs-hero .container {
        position: relative;
        z-index: 2;
    }

    .programs-hero h1 {
        font-size: 3.5rem;
        font-weight: 700;
        margin-bottom: 20px;
        text-shadow: 0 2px 10px rgba(0,0,0,0.2);
    }

    .programs-hero p {
        font-size: 1.3rem;
        margin-bottom: 30px;
        opacity: 0.9;
    }

    .breadcrumb-nav {
        margin-top: 20px;
    }

    .breadcrumb-nav a {
        color: rgba(255, 255, 255, 0.8);
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .breadcrumb-nav a:hover {
        color: white;
    }

    .breadcrumb-nav .active {
        color: white;
        font-weight: 600;
    }

    .programs-section {
        padding: 80px 0;
        background-color: #f8f9fa;
    }

    .section-title {
        text-align: center;
        margin-bottom: 60px;
    }

    .section-title h2 {
        font-size: 2.5rem;
        font-weight: 700;
        color: #333;
        margin-bottom: 15px;
    }

    .section-title p {
        font-size: 1.1rem;
        color: #666;
        max-width: 600px;
        margin: 0 auto;
    }

    .program-card {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        margin-bottom: 30px;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .program-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }

    .program-image {
        height: 250px;
        overflow: hidden;
        position: relative;
    }

    .program-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .program-card:hover .program-image img {
        transform: scale(1.05);
    }

    .program-number {
        position: absolute;
        top: 20px;
        left: 20px;
        background: rgba(244, 137, 31, 0.9);
        color: white;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 1.2rem;
    }

    .program-content {
        padding: 30px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .program-title {
        font-size: 1.4rem;
        font-weight: 700;
        color: #333;
        margin-bottom: 15px;
        line-height: 1.3;
    }

    .program-description {
        color: #666;
        line-height: 1.6;
        margin-bottom: 25px;
        flex-grow: 1;
    }

    .program-link {
        color: #f4891f;
        text-decoration: none;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        transition: all 0.3s ease;
    }

    .program-link:hover {
        color: #faac19;
        transform: translateX(5px);
    }

    .program-link i {
        margin-left: 8px;
        transition: transform 0.3s ease;
    }

    .program-link:hover i {
        transform: translateX(3px);
    }

    .featured-programs {
        padding: 60px 0;
        background: white;
    }

    .featured-badge {
        position: absolute;
        top: 20px;
        right: 20px;
        background: #faac19;
        color: white;
        padding: 5px 15px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        text-transform: uppercase;
    }

    .pagination-wrapper {
        display: flex;
        justify-content: center;
        margin-top: 50px;
    }

    .filter-section {
        background: white;
        padding: 40px 0;
        border-bottom: 1px solid #eee;
    }

    .filter-options {
        display: flex;
        justify-content: center;
        gap: 20px;
        flex-wrap: wrap;
    }

    .filter-btn {
        padding: 10px 25px;
        background: transparent;
        border: 2px solid #f4891f;
        color: #f4891f;
        border-radius: 25px;
        text-decoration: none;
        transition: all 0.3s ease;
        font-weight: 600;
    }

    .filter-btn:hover,
    .filter-btn.active {
        background: #f4891f;
        color: white;
    }

    @media (max-width: 768px) {
        .programs-hero h1 {
            font-size: 2.5rem;
        }

        .programs-hero p {
            font-size: 1.1rem;
        }

        .section-title h2 {
            font-size: 2rem;
        }

        .program-content {
            padding: 20px;
        }

        .filter-options {
            gap: 10px;
        }

        .filter-btn {
            padding: 8px 20px;
            font-size: 0.9rem;
        }
    }
</style>
@endsection

@section('content')
    <!-- Hero Section -->
    <div class="programs-hero">
        <div class="container">
            <h1>Our Programs</h1>
            <p>Empowering entrepreneurs through innovative programs and initiatives</p>
            <div class="breadcrumb-nav">
                <a href="{{ route('home') }}">Home</a> /
                <span class="active">Programs</span>
            </div>
        </div>
    </div>

    <!-- Featured Programs Section -->
    @if($featuredPrograms->count() > 0)
    <div class="featured-programs">
        <div class="container">
            <div class="section-title">
                <h2>Featured Programs</h2>
                <p>Discover our most popular and impactful programs</p>
            </div>
            <div class="row">
                @foreach($featuredPrograms as $index => $program)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="program-card">
                            <div class="program-image">
                                @if($program->featured_image)
                                    <img src="{{ asset('storage/' . $program->featured_image) }}"
                                         alt="{{ $program->title }}" loading="lazy">
                                @else
                                    <div class="placeholder-image d-flex align-items-center justify-content-center"
                                         style="height: 250px; background: linear-gradient(135deg, #f4891f, #faac19);">
                                        <i class="fas fa-clipboard-list fa-3x text-white"></i>
                                    </div>
                                @endif
                                <div class="program-number">{{ sprintf('%02d', $index + 1) }}</div>
                                <div class="featured-badge">
                                    <i class="fas fa-star"></i> Featured
                                </div>
                            </div>
                            <div class="program-content">
                                <h3 class="program-title">{{ $program->title }}</h3>
                                <p class="program-description">{{ $program->short_description }}</p>
                                <a href="{{ route('programs.show', $program->slug) }}" class="program-link">
                                    Read More <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif

    <!-- All Programs Section -->
    <div class="programs-section">
        <div class="container">
            <div class="section-title">
                <h2>All Programs</h2>
                <p>Explore our comprehensive range of programs designed to support your journey</p>
            </div>

            @if($programs->count() > 0)
                <div class="row">
                    @foreach($programs as $index => $program)
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="program-card">
                                <div class="program-image">
                                    @if($program->featured_image)
                                        <img src="{{ asset('storage/' . $program->featured_image) }}"
                                             alt="{{ $program->title }}" loading="lazy">
                                    @else
                                        <div class="placeholder-image d-flex align-items-center justify-content-center"
                                             style="height: 250px; background: linear-gradient(135deg, #f4891f, #faac19);">
                                            <i class="fas fa-clipboard-list fa-3x text-white"></i>
                                        </div>
                                    @endif
                                    <div class="program-number">{{ sprintf('%02d', (($programs->currentPage() - 1) * $programs->perPage()) + $index + 1) }}</div>
                                    @if($program->is_featured)
                                        <div class="featured-badge">
                                            <i class="fas fa-star"></i> Featured
                                        </div>
                                    @endif
                                </div>
                                <div class="program-content">
                                    <h3 class="program-title">{{ $program->title }}</h3>
                                    <p class="program-description">{{ $program->short_description }}</p>
                                    <a href="{{ route('programs.show', $program->slug) }}" class="program-link">
                                        Read More <i class="fas fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                @if($programs->hasPages())
                    <div class="pagination-wrapper">
                        {{ $programs->links() }}
                    </div>
                @endif
            @else
                <div class="text-center py-5">
                    <i class="fas fa-clipboard-list fa-4x text-muted mb-4"></i>
                    <h3 class="text-muted">No Programs Available</h3>
                    <p class="text-muted">Check back soon for exciting new programs!</p>
                </div>
            @endif
        </div>
    </div>
@endsection
