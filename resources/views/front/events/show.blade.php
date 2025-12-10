@extends('front.layout')

@section('title', '- ' . $event->title)

@section('meta')
    <meta name="description" content="{{ $event->meta_description ?: Str::limit($event->short_description, 160) }}">
    <meta name="keywords" content="{{ $event->meta_keywords ?: 'event, ' . $event->title . ', organization events' }}">

    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="{{ $event->meta_title ?: $event->title }}">
    <meta property="og:description" content="{{ $event->meta_description ?: Str::limit($event->short_description, 160) }}">
    <meta property="og:image" content="{{ asset($event->image) ?: asset('front/images/default-event.jpg') }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="event">

    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $event->meta_title ?: $event->title }}">
    <meta name="twitter:description" content="{{ $event->meta_description ?: Str::limit($event->short_description, 160) }}">
    <meta name="twitter:image" content="{{ asset($event->image) ?: asset('front/images/default-event.jpg') }}">
@endsection

@section('css')
<style>
    .event-hero {
        position: relative;
        height: 60vh;
        min-height: 500px;
        overflow: hidden;
        display: flex;
        align-items: center;
        background: linear-gradient(135deg, #f4891f 0%, #faac19 100%);
    }

    .event-hero-bg {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }

    .event-hero-bg::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(244, 137, 31, 0.8) 0%, rgba(250, 172, 25, 0.8) 100%);
    }

    .event-hero .container {
        position: relative;
        z-index: 2;
        color: white;
    }

    .event-meta-badges {
        margin-bottom: 20px;
    }

    .event-badge {
        display: inline-block;
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 0.9rem;
        font-weight: 600;
        margin-right: 10px;
        margin-bottom: 10px;
    }

    .event-badge.featured {
        background: rgba(255, 193, 7, 0.9);
        color: #212529;
    }

    .event-badge.status {
        background: rgba(255, 255, 255, 0.2);
        color: white;
        border: 2px solid rgba(255, 255, 255, 0.3);
    }

    .event-hero h1 {
        font-size: 3rem;
        font-weight: 700;
        margin-bottom: 20px;
        line-height: 1.2;
        text-shadow: 0 2px 10px rgba(0,0,0,0.3);
    }

    .event-hero-meta {
        font-size: 1.2rem;
        margin-bottom: 25px;
        opacity: 0.95;
    }

    .event-hero-meta .meta-item {
        display: inline-block;
        margin-right: 30px;
        margin-bottom: 10px;
    }

    .event-hero-meta .meta-item i {
        margin-right: 8px;
        color: #faac19;
    }

    .breadcrumb-nav {
        margin-top: 30px;
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

    .event-content-section {
        padding: 80px 0;
        background: white;
    }

    .event-main-content {
        margin-bottom: 50px;
    }

    .event-description {
        font-size: 1.1rem;
        line-height: 1.8;
        color: #333;
    }

    .event-description h1,
    .event-description h2,
    .event-description h3,
    .event-description h4,
    .event-description h5,
    .event-description h6 {
        margin-top: 2rem;
        margin-bottom: 1rem;
        color: #333;
        font-weight: 700;
    }

    .event-description h1 { font-size: 2.5rem; }
    .event-description h2 { font-size: 2rem; }
    .event-description h3 { font-size: 1.5rem; }

    .event-description p {
        margin-bottom: 1.5rem;
    }

    .event-description ul,
    .event-description ol {
        margin-bottom: 1.5rem;
        padding-left: 2rem;
    }

    .event-description li {
        margin-bottom: 0.5rem;
    }

    .event-description blockquote {
        background: #f8f9fa;
        border-left: 4px solid #f4891f;
        padding: 20px;
        margin: 2rem 0;
        font-style: italic;
    }

    .event-info-sidebar {
        background: #f8f9fa;
        border-radius: 15px;
        padding: 30px;
        position: sticky;
        top: 100px;
    }

    .event-info-title {
        font-size: 1.3rem;
        font-weight: 700;
        color: #333;
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 2px solid #f4891f;
    }

    .event-info-item {
        display: flex;
        align-items: flex-start;
        margin-bottom: 20px;
        padding-bottom: 20px;
        border-bottom: 1px solid #e9ecef;
    }

    .event-info-item:last-child {
        border-bottom: none;
        margin-bottom: 0;
        padding-bottom: 0;
    }

    .event-info-icon {
        width: 40px;
        height: 40px;
        background: #f4891f;
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 15px;
        flex-shrink: 0;
    }

    .event-info-content h6 {
        font-size: 0.9rem;
        font-weight: 600;
        color: #666;
        margin-bottom: 5px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .event-info-content p {
        font-size: 1rem;
        color: #333;
        margin: 0;
        font-weight: 500;
    }

    .countdown-timer {
        background: linear-gradient(135deg, #f4891f 0%, #faac19 100%);
        color: white;
        border-radius: 15px;
        padding: 25px;
        text-align: center;
        margin-bottom: 30px;
    }

    .countdown-timer h6 {
        font-size: 0.9rem;
        font-weight: 600;
        margin-bottom: 15px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .countdown-numbers {
        display: flex;
        justify-content: space-around;
        gap: 10px;
    }

    .countdown-item {
        text-align: center;
    }

    .countdown-item .number {
        font-size: 2rem;
        font-weight: 700;
        display: block;
        line-height: 1;
    }

    .countdown-item .label {
        font-size: 0.8rem;
        opacity: 0.9;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .share-section {
        background: #f8f9fa;
        border-radius: 15px;
        padding: 25px;
        margin-top: 30px;
    }

    .share-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: #333;
        margin-bottom: 20px;
    }

    .share-buttons {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .share-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 45px;
        height: 45px;
        border-radius: 50%;
        color: white;
        text-decoration: none;
        transition: all 0.3s ease;
        font-size: 1.2rem;
    }

    .share-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        color: white;
        text-decoration: none;
    }

    .share-btn.facebook { background: #3b5998; }
    .share-btn.twitter { background: #1da1f2; }
    .share-btn.linkedin { background: #0077b5; }
    .share-btn.whatsapp { background: #25d366; }
    .share-btn.email { background: #666; }

    .related-events {
        padding: 80px 0;
        background: #f8f9fa;
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
        max-width: 600px;
        margin: 0 auto;
    }

    .related-event-card {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        margin-bottom: 30px;
        height: 100%;
    }

    .related-event-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
    }

    .related-event-image {
        height: 200px;
        overflow: hidden;
        position: relative;
    }

    .related-event-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .related-event-card:hover .related-event-image img {
        transform: scale(1.05);
    }

    .related-event-date {
        position: absolute;
        top: 15px;
        left: 15px;
        background: rgba(244, 137, 31, 0.9);
        color: white;
        padding: 8px 12px;
        border-radius: 8px;
        font-size: 0.8rem;
        font-weight: 600;
    }

    .related-event-content {
        padding: 25px;
    }

    .related-event-content h5 {
        font-size: 1.2rem;
        font-weight: 600;
        color: #333;
        margin-bottom: 10px;
        line-height: 1.3;
    }

    .related-event-content h5 a {
        color: inherit;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .related-event-content h5 a:hover {
        color: #f4891f;
    }

    .related-event-meta {
        font-size: 0.9rem;
        color: #666;
        margin-bottom: 15px;
    }

    .related-event-meta i {
        color: #f4891f;
        margin-right: 5px;
        width: 15px;
    }

    .related-event-description {
        color: #666;
        line-height: 1.6;
        font-size: 0.95rem;
    }

    @media (max-width: 768px) {
        .event-hero {
            height: 50vh;
            min-height: 400px;
        }

        .event-hero h1 {
            font-size: 2rem;
        }

        .event-hero-meta {
            font-size: 1rem;
        }

        .event-hero-meta .meta-item {
            display: block;
            margin-right: 0;
            margin-bottom: 15px;
        }

        .event-content-section {
            padding: 50px 0;
        }

        .event-info-sidebar {
            position: static;
            margin-top: 40px;
        }

        .countdown-numbers {
            gap: 5px;
        }

        .countdown-item .number {
            font-size: 1.5rem;
        }

        .share-buttons {
            justify-content: center;
        }

        .related-events {
            padding: 50px 0;
        }
    }
</style>
@endsection

@section('content')
    <!-- Event Hero Section -->
    <section class="event-hero">
        @if($event->image)
            <div class="event-hero-bg" style="background-image: url('{{ asset($event->image) }}');"></div>
        @endif

        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="event-meta-badges">
                        @if($event->is_featured)
                            <span class="event-badge featured">
                                <i class="fas fa-star"></i> Featured Event
                            </span>
                        @endif
                        <span class="event-badge status">
                            {{ $event->status_text }}
                        </span>
                    </div>

                    <h1>{{ $event->title }}</h1>

                    <div class="event-hero-meta">
                        <div class="meta-item">
                            <i class="fas fa-calendar"></i>
                            {{ $event->formatted_date }}
                        </div>
                        <div class="meta-item">
                            <i class="fas fa-clock"></i>
                            {{ $event->formatted_time }}
                        </div>
                        <div class="meta-item">
                            <i class="fas fa-map-marker-alt"></i>
                            {{ $event->location }}
                        </div>
                    </div>

                    <p class="lead">{{ $event->short_description }}</p>

                    <div class="breadcrumb-nav">
                        <a href="{{ route('home') }}">Home</a> /
                        <a href="{{ route('events.index') }}">Events</a> /
                        <span class="active">{{ Str::limit($event->title, 30) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Event Content Section -->
    <section class="event-content-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="event-main-content">
                        <div class="event-description">
                            {!! $event->full_description !!}
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <!-- Event Information Sidebar -->
                    <div class="event-info-sidebar">
                        <h4 class="event-info-title">Event Details</h4>

                        <div class="event-info-item">
                            <div class="event-info-icon">
                                <i class="fas fa-calendar"></i>
                            </div>
                            <div class="event-info-content">
                                <h6>Date</h6>
                                <p>{{ $event->formatted_date }}</p>
                            </div>
                        </div>

                        <div class="event-info-item">
                            <div class="event-info-icon">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="event-info-content">
                                <h6>Time</h6>
                                <p>{{ $event->formatted_time }}</p>
                            </div>
                        </div>

                        <div class="event-info-item">
                            <div class="event-info-icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="event-info-content">
                                <h6>Location</h6>
                                <p>{{ $event->location }}</p>
                            </div>
                        </div>

                        @if($event->is_upcoming && !$event->is_today)
                            <!-- Countdown Timer -->
                            <div class="countdown-timer">
                                <h6>Event Starts In</h6>
                                <div class="countdown-numbers" id="countdown-timer"
                                     data-date="{{ $event->event_date->format('Y-m-d') }}"
                                     data-time="{{ $event->event_time->format('H:i:s') }}">
                                    <div class="countdown-item">
                                        <span class="number" id="days">--</span>
                                        <span class="label">Days</span>
                                    </div>
                                    <div class="countdown-item">
                                        <span class="number" id="hours">--</span>
                                        <span class="label">Hours</span>
                                    </div>
                                    <div class="countdown-item">
                                        <span class="number" id="minutes">--</span>
                                        <span class="label">Minutes</span>
                                    </div>
                                    <div class="countdown-item">
                                        <span class="number" id="seconds">--</span>
                                        <span class="label">Seconds</span>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Share Section -->
                    <div class="share-section">
                        <h5 class="share-title">Share This Event</h5>
                        <div class="share-buttons">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
                               target="_blank" class="share-btn facebook" title="Share on Facebook">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($event->title) }}"
                               target="_blank" class="share-btn twitter" title="Share on Twitter">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(url()->current()) }}"
                               target="_blank" class="share-btn linkedin" title="Share on LinkedIn">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a href="https://api.whatsapp.com/send?text={{ urlencode($event->title . ' - ' . url()->current()) }}"
                               target="_blank" class="share-btn whatsapp" title="Share on WhatsApp">
                                <i class="fab fa-whatsapp"></i>
                            </a>
                            <a href="mailto:?subject={{ urlencode($event->title) }}&body={{ urlencode('Check out this event: ' . url()->current()) }}"
                               class="share-btn email" title="Share via Email">
                                <i class="fas fa-envelope"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Events Section -->
    @if($relatedEvents->count() > 0)
        <section class="related-events">
            <div class="container">
                <div class="section-title">
                    <h2>Related Events</h2>
                    <p>You might also be interested in these upcoming events</p>
                </div>

                <div class="row">
                    @foreach($relatedEvents as $relatedEvent)
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="related-event-card">
                                <div class="related-event-image">
                                    @if($relatedEvent->image)
                                        <img src="{{ vasset($relatedEvent->image) }}" alt="{{ $relatedEvent->title }}">
                                    @else
                                        <img src="{{ asset('front/images/default-event.jpg') }}" alt="{{ $relatedEvent->title }}">
                                    @endif

                                    <div class="related-event-date">
                                        {{ $relatedEvent->event_date->format('M d') }}
                                    </div>
                                </div>

                                <div class="related-event-content">
                                    <h5><a href="{{ route('events.show', $relatedEvent->slug) }}">{{ $relatedEvent->title }}</a></h5>

                                    <div class="related-event-meta">
                                        <div><i class="fas fa-clock"></i> {{ $relatedEvent->formatted_time }}</div>
                                        <div><i class="fas fa-map-marker-alt"></i> {{ Str::limit($relatedEvent->location, 25) }}</div>
                                    </div>

                                    <div class="related-event-description">
                                        {{ Str::limit($relatedEvent->short_description, 100) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="text-center mt-4">
                    <a href="{{ route('events.index') }}" class="read-more-btn">
                        View All Events
                    </a>
                </div>
            </div>
        </section>
    @endif
@endsection

@section('js')
<script>
    $(document).ready(function() {
        // Countdown Timer
        const countdownElement = $('#countdown-timer');
        if (countdownElement.length > 0) {
            const eventDate = countdownElement.data('date');
            const eventTime = countdownElement.data('time');
            const eventDateTime = new Date(eventDate + 'T' + eventTime);

            function updateCountdown() {
                const now = new Date();
                const difference = eventDateTime - now;

                if (difference > 0) {
                    const days = Math.floor(difference / (1000 * 60 * 60 * 24));
                    const hours = Math.floor((difference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    const minutes = Math.floor((difference % (1000 * 60 * 60)) / (1000 * 60));
                    const seconds = Math.floor((difference % (1000 * 60)) / 1000);

                    $('#days').text(days.toString().padStart(2, '0'));
                    $('#hours').text(hours.toString().padStart(2, '0'));
                    $('#minutes').text(minutes.toString().padStart(2, '0'));
                    $('#seconds').text(seconds.toString().padStart(2, '0'));
                } else {
                    // Event has started or passed
                    countdownElement.html('<h6>Event Has Started!</h6>');
                }
            }

            // Update countdown immediately and then every second
            updateCountdown();
            setInterval(updateCountdown, 1000);
        }

        // Smooth scrolling for anchor links
        $('a[href^="#"]').on('click', function(event) {
            event.preventDefault();
            const target = $(this.getAttribute('href'));
            if (target.length) {
                $('html, body').animate({
                    scrollTop: target.offset().top - 100
                }, 800);
            }
        });

        // Add loading state to share buttons
        $('.share-btn').on('click', function() {
            const btn = $(this);
            btn.addClass('opacity-50');
            setTimeout(function() {
                btn.removeClass('opacity-50');
            }, 2000);
        });

        // Copy to clipboard functionality for share
        if (navigator.share) {
            // Add native share button for mobile devices
            const shareButtons = $('.share-buttons');
            shareButtons.append(`
                <a href="#" class="share-btn" id="native-share" style="background: #333;" title="Share">
                    <i class="fas fa-share-alt"></i>
                </a>
            `);

            $('#native-share').on('click', function(e) {
                e.preventDefault();
                navigator.share({
                    title: '{{ $event->title }}',
                    text: '{{ $event->short_description }}',
                    url: window.location.href
                });
            });
        }
    });
</script>
@endsection
