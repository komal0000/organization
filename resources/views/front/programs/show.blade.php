@extends('front.layout')

@section('head-title')
    <title>{{ $program->title }} | {{ config('app.name') }}</title>
@endsection

@section('meta')
    <meta name="description" content="{{ $program->meta_description ?: $program->short_description }}">
    <meta name="keywords" content="{{ $program->meta_keywords ?: 'program, entrepreneurship, development' }}">

    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="{{ $program->title }}">
    <meta property="og:description" content="{{ $program->short_description }}">
    @if($program->featured_image)
        <meta property="og:image" content="{{ asset($program->featured_image) }}">
    @endif
    <meta property="og:type" content="article">
    <meta property="og:url" content="{{ url()->current() }}">
@endsection

@section('css')
<style>
    .program-hero {
        background: linear-gradient(135deg, #f4891f 0%, #faac19 100%);
        color: white;
        padding: 60px 0;
        position: relative;
        overflow: hidden;
    }

    .program-hero::before {
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

    .program-hero .container {
        position: relative;
        z-index: 2;
    }

    .breadcrumb-nav {
        margin-bottom: 20px;
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

    .program-title {
        font-size: 3rem;
        font-weight: 700;
        margin-bottom: 20px;
        text-shadow: 0 2px 10px rgba(0,0,0,0.2);
    }

    .program-subtitle {
        font-size: 1.3rem;
        opacity: 0.9;
        line-height: 1.5;
    }

    .program-content {
        padding: 80px 0;
        background-color: #f8f9fa;
    }

    .content-section {
        background: white;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        margin-bottom: 30px;
    }

    .featured-image {
        width: 100%;
        height: 400px;
        object-fit: cover;
        display: block;
    }

    .content-body {
        padding: 40px;
    }

    .content-body h1,
    .content-body h2,
    .content-body h3,
    .content-body h4,
    .content-body h5,
    .content-body h6 {
        color: #333;
        margin-top: 30px;
        margin-bottom: 15px;
        font-weight: 600;
    }

    .content-body h2 {
        font-size: 1.8rem;
        color: #f4891f;
        border-bottom: 2px solid #f4891f;
        padding-bottom: 10px;
    }

    .content-body p {
        color: #666;
        line-height: 1.8;
        margin-bottom: 20px;
        font-size: 1.05rem;
    }

    .content-body ul,
    .content-body ol {
        color: #666;
        line-height: 1.8;
        margin-bottom: 20px;
        padding-left: 30px;
    }

    .content-body li {
        margin-bottom: 8px;
    }

    .content-body blockquote {
        background: #f8f9fa;
        border-left: 4px solid #f4891f;
        padding: 20px 30px;
        margin: 30px 0;
        font-style: italic;
        font-size: 1.1rem;
    }

    .program-sidebar {
        background: white;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        padding: 30px;
        margin-bottom: 30px;
        position: sticky;
        top: 20px;
    }

    .sidebar-title {
        font-size: 1.3rem;
        font-weight: 700;
        color: #333;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 2px solid #f4891f;
    }

    .program-info {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .program-info li {
        padding: 15px 0;
        border-bottom: 1px solid #eee;
        display: flex;
        align-items: center;
    }

    .program-info li:last-child {
        border-bottom: none;
    }

    .program-info .icon {
        width: 40px;
        height: 40px;
        background: linear-gradient(135deg, #f4891f, #faac19);
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 15px;
        flex-shrink: 0;
    }

    .program-info .info {
        flex-grow: 1;
    }

    .program-info .label {
        font-weight: 600;
        color: #333;
        display: block;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .program-info .value {
        color: #666;
        font-size: 1rem;
        margin-top: 2px;
    }

    .gallery-section {
        margin-top: 50px;
    }

    .gallery-title {
        font-size: 1.8rem;
        font-weight: 700;
        color: #333;
        margin-bottom: 30px;
        text-align: center;
    }

    .gallery-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-top: 30px;
    }

    .gallery-item {
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
        cursor: pointer;
    }

    .gallery-item:hover {
        transform: scale(1.02);
    }

    .gallery-item img {
        width: 100%;
        height: 200px;
        object-fit: cover;
        display: block;
    }

    .action-buttons {
        margin-top: 30px;
        text-align: center;
    }

    .btn-orange {
        background: linear-gradient(135deg, #f4891f, #faac19);
        color: white;
        border: none;
        padding: 15px 30px;
        border-radius: 25px;
        text-decoration: none;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        transition: all 0.3s ease;
        margin: 5px;
    }

    .btn-orange:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(244, 137, 31, 0.3);
        color: white;
    }

    .btn-orange i {
        margin-right: 8px;
    }

    .related-programs {
        padding: 80px 0;
        background: white;
    }

    .section-title {
        text-align: center;
        margin-bottom: 50px;
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
    }

    .related-card {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        margin-bottom: 30px;
        height: 100%;
    }

    .related-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
    }

    .related-image {
        height: 200px;
        overflow: hidden;
    }

    .related-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .related-card:hover .related-image img {
        transform: scale(1.05);
    }

    .related-content {
        padding: 20px;
    }

    .related-title {
        font-size: 1.2rem;
        font-weight: 600;
        color: #333;
        margin-bottom: 10px;
        line-height: 1.3;
    }

    .related-description {
        color: #666;
        font-size: 0.95rem;
        line-height: 1.5;
        margin-bottom: 15px;
    }

    .related-link {
        color: #f4891f;
        text-decoration: none;
        font-weight: 600;
        font-size: 0.9rem;
        transition: color 0.3s ease;
    }

    .related-link:hover {
        color: #faac19;
    }

    @media (max-width: 768px) {
        .program-title {
            font-size: 2rem;
        }

        .program-subtitle {
            font-size: 1.1rem;
        }

        .content-body {
            padding: 20px;
        }

        .program-sidebar {
            margin-top: 30px;
            position: static;
        }

        .gallery-grid {
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 15px;
        }

        .gallery-item img {
            height: 150px;
        }

        .section-title h2 {
            font-size: 2rem;
        }
    }

    /* Lightbox styles for gallery */
    .lightbox {
        display: none;
        position: fixed;
        z-index: 9999;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.9);
    }

    .lightbox-content {
        position: relative;
        margin: auto;
        padding: 20px;
        width: 90%;
        max-width: 800px;
        top: 50%;
        transform: translateY(-50%);
    }

    .lightbox img {
        width: 100%;
        height: auto;
        border-radius: 10px;
    }

    .lightbox-close {
        position: absolute;
        top: 10px;
        right: 25px;
        color: white;
        font-size: 35px;
        font-weight: bold;
        cursor: pointer;
        z-index: 10000;
    }

    .lightbox-close:hover {
        opacity: 0.7;
    }
</style>
@endsection

@section('content')
    <!-- Hero Section -->
    <div class="program-hero">
        <div class="container">
            <div class="breadcrumb-nav">
                <a href="{{ route('home') }}">Home</a> /
                <a href="{{ route('programs.index') }}">Programs</a> /
                <span class="active">{{ $program->title }}</span>
            </div>
            <h1 class="program-title">{{ $program->title }}</h1>
            @if($program->short_description)
                <p class="program-subtitle">{{ $program->short_description }}</p>
            @endif
        </div>
    </div>

    <!-- Main Content -->
    <div class="program-content">
        <div class="container">
            <div class="row">
                <!-- Main Content Column -->
                <div class="col-lg-8">
                    <div class="content-section">
                        @if($program->featured_image)
                            <img src="{{ asset('storage/' . $program->featured_image) }}"
                                 alt="{{ $program->title }}"
                                 class="featured-image">
                        @endif

                        <div class="content-body">
                            {!! $program->content !!}
                        </div>
                    </div>

                    <!-- Gallery Section -->
                    @if($program->gallery && count($program->gallery) > 0)
                        <div class="content-section">
                            <div class="content-body">
                                <h2 class="gallery-title">
                                    <i class="fas fa-images"></i> Program Gallery
                                </h2>
                                <div class="gallery-grid">
                                    @foreach($program->gallery as $image)
                                        <div class="gallery-item" onclick="openLightbox('{{ asset('storage/' . $image) }}')">
                                            <img src="{{ asset('storage/' . $image) }}"
                                                 alt="Gallery Image"
                                                 loading="lazy">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Sidebar Column -->
                <div class="col-lg-4">
                    <div class="program-sidebar">
                        <h3 class="sidebar-title">
                            <i class="fas fa-info-circle"></i> Program Information
                        </h3>
                        <ul class="program-info">
                            <li>
                                <div class="icon">
                                    <i class="fas fa-calendar"></i>
                                </div>
                                <div class="info">
                                    <span class="label">Published</span>
                                    <span class="value">{{ $program->created_at->format('M d, Y') }}</span>
                                </div>
                            </li>
                            <li>
                                <div class="icon">
                                    <i class="fas fa-edit"></i>
                                </div>
                                <div class="info">
                                    <span class="label">Last Updated</span>
                                    <span class="value">{{ $program->updated_at->format('M d, Y') }}</span>
                                </div>
                            </li>
                            <li>
                                <div class="icon">
                                    <i class="fas fa-tag"></i>
                                </div>
                                <div class="info">
                                    <span class="label">Status</span>
                                    <span class="value">
                                        @if($program->is_featured)
                                            <span class="badge" style="background: #faac19; color: white; padding: 2px 8px; border-radius: 12px; font-size: 0.75rem;">
                                                <i class="fas fa-star"></i> Featured
                                            </span>
                                        @else
                                            <span class="badge" style="background: #28a745; color: white; padding: 2px 8px; border-radius: 12px; font-size: 0.75rem;">
                                                Active
                                            </span>
                                        @endif
                                    </span>
                                </div>
                            </li>
                        </ul>

                        <div class="action-buttons">
                            <a href="{{ route('programs.index') }}" class="btn-orange">
                                <i class="fas fa-arrow-left"></i> Back to Programs
                            </a>
                            <a href="{{ route('contact') }}" class="btn-orange">
                                <i class="fas fa-envelope"></i> Contact Us
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Related Programs Section -->
    @if($relatedPrograms->count() > 0)
        <div class="related-programs">
            <div class="container">
                <div class="section-title">
                    <h2>Related Programs</h2>
                    <p>Discover other programs that might interest you</p>
                </div>

                <div class="row">
                    @foreach($relatedPrograms as $relatedProgram)
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="related-card">
                                <div class="related-image">
                                    @if($relatedProgram->featured_image)
                                        <img src="{{ asset('storage/' . $relatedProgram->featured_image) }}"
                                             alt="{{ $relatedProgram->title }}"
                                             loading="lazy">
                                    @else
                                        <div class="placeholder-image d-flex align-items-center justify-content-center"
                                             style="height: 200px; background: linear-gradient(135deg, #f4891f, #faac19);">
                                            <i class="fas fa-clipboard-list fa-2x text-white"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="related-content">
                                    <h4 class="related-title">{{ $relatedProgram->title }}</h4>
                                    <p class="related-description">{{ $relatedProgram->short_description }}</p>
                                    <a href="{{ route('programs.show', $relatedProgram->slug) }}" class="related-link">
                                        Learn More →
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    <!-- Lightbox for Gallery -->
    <div id="lightbox" class="lightbox" onclick="closeLightbox()">
        <span class="lightbox-close" onclick="closeLightbox()">&times;</span>
        <div class="lightbox-content">
            <img id="lightbox-img" src="" alt="Gallery Image">
        </div>
    </div>
@endsection

@section('js')
<script>
    function openLightbox(imageSrc) {
        document.getElementById('lightbox').style.display = 'block';
        document.getElementById('lightbox-img').src = imageSrc;
        document.body.style.overflow = 'hidden';
    }

    function closeLightbox() {
        document.getElementById('lightbox').style.display = 'none';
        document.body.style.overflow = 'auto';
    }

    // Close lightbox with Escape key
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeLightbox();
        }
    });

    // Prevent closing when clicking on the image
    document.getElementById('lightbox-img').addEventListener('click', function(event) {
        event.stopPropagation();
    });
</script>
@endsection
