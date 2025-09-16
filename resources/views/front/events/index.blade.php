@extends('front.layout')

@section('title', '- Upcoming Events')

@section('meta')
    <meta name="description" content="Stay updated with our upcoming events, workshops, seminars, and community gatherings designed to inspire and educate.">
    <meta name="keywords" content="events, upcoming events, workshops, seminars, community gatherings, organization events">
@endsection

@section('css')
<style>
    .events-hero {
        background: linear-gradient(135deg, #f4891f 0%, #faac19 100%);
        color: white;
        padding: 80px 0;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .events-hero::before {
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

    .events-hero .container {
        position: relative;
        z-index: 2;
    }

    .events-hero h1 {
        font-size: 3.5rem;
        font-weight: 700;
        margin-bottom: 20px;
        text-shadow: 0 2px 10px rgba(0,0,0,0.2);
    }

    .events-hero p {
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

    .events-section {
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

    .event-filters {
        margin-bottom: 50px;
        text-align: center;
    }

    .filter-btn {
        display: inline-block;
        padding: 12px 25px;
        margin: 5px;
        background: white;
        color: #666;
        text-decoration: none;
        border-radius: 25px;
        transition: all 0.3s ease;
        border: 2px solid #e9ecef;
        font-weight: 500;
    }

    .filter-btn:hover,
    .filter-btn.active {
        background: #f4891f;
        color: white;
        border-color: #f4891f;
        text-decoration: none;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(244, 137, 31, 0.3);
    }

    .search-box {
        max-width: 400px;
        margin: 0 auto 30px;
        position: relative;
    }

    .search-box input {
        width: 100%;
        padding: 15px 50px 15px 20px;
        border: 2px solid #e9ecef;
        border-radius: 25px;
        font-size: 1rem;
        transition: border-color 0.3s ease;
    }

    .search-box input:focus {
        outline: none;
        border-color: #f4891f;
        box-shadow: 0 0 0 3px rgba(244, 137, 31, 0.1);
    }

    .search-box button {
        position: absolute;
        right: 5px;
        top: 50%;
        transform: translateY(-50%);
        background: #f4891f;
        border: none;
        color: white;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        transition: background 0.3s ease;
    }

    .search-box button:hover {
        background: #e67e22;
    }

    .event-card {
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

    .event-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }

    .event-image {
        height: 250px;
        overflow: hidden;
        position: relative;
    }

    .event-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .event-card:hover .event-image img {
        transform: scale(1.05);
    }

    .event-date-badge {
        position: absolute;
        top: 20px;
        left: 20px;
        background: rgba(244, 137, 31, 0.95);
        color: white;
        padding: 10px 15px;
        border-radius: 10px;
        text-align: center;
        font-weight: 600;
        min-width: 80px;
        backdrop-filter: blur(10px);
    }

    .event-date-badge .day {
        font-size: 1.5rem;
        display: block;
        line-height: 1;
    }

    .event-date-badge .month {
        font-size: 0.9rem;
        opacity: 0.9;
    }

    .event-status {
        position: absolute;
        top: 20px;
        right: 20px;
        padding: 8px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        text-transform: uppercase;
    }

    .event-status.upcoming {
        background: rgba(40, 167, 69, 0.9);
        color: white;
    }

    .event-status.today {
        background: rgba(255, 193, 7, 0.9);
        color: #212529;
    }

    .event-status.past {
        background: rgba(108, 117, 125, 0.9);
        color: white;
    }

    .featured-badge {
        position: absolute;
        top: 20px;
        right: 90px;
        background: rgba(255, 193, 7, 0.95);
        color: #212529;
        padding: 8px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        backdrop-filter: blur(10px);
    }

    .event-content {
        padding: 30px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .event-content h3 {
        font-size: 1.5rem;
        font-weight: 700;
        color: #333;
        margin-bottom: 15px;
        line-height: 1.3;
    }

    .event-content h3 a {
        color: inherit;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .event-content h3 a:hover {
        color: #f4891f;
    }

    .event-meta {
        margin-bottom: 15px;
    }

    .event-meta-item {
        display: flex;
        align-items: center;
        margin-bottom: 8px;
        color: #666;
        font-size: 0.95rem;
    }

    .event-meta-item i {
        color: #f4891f;
        width: 20px;
        margin-right: 10px;
    }

    .event-description {
        color: #666;
        line-height: 1.6;
        margin-bottom: 20px;
        flex-grow: 1;
    }

    .event-footer {
        margin-top: auto;
        padding-top: 20px;
        border-top: 1px solid #e9ecef;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .read-more-btn {
        background: #f4891f;
        color: white;
        padding: 10px 25px;
        border-radius: 25px;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
    }

    .read-more-btn:hover {
        background: #e67e22;
        color: white;
        text-decoration: none;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(244, 137, 31, 0.3);
    }

    .no-events {
        text-align: center;
        padding: 80px 20px;
        color: #666;
    }

    .no-events i {
        font-size: 4rem;
        color: #ddd;
        margin-bottom: 20px;
    }

    .no-events h3 {
        font-size: 1.5rem;
        margin-bottom: 15px;
        color: #333;
    }

    .featured-events {
        background: white;
        padding: 60px 0;
        margin-bottom: 0;
    }

    .featured-events .section-title h2 {
        color: #f4891f;
    }

    @media (max-width: 768px) {
        .events-hero h1 {
            font-size: 2.5rem;
        }

        .events-hero p {
            font-size: 1.1rem;
        }

        .event-filters {
            margin-bottom: 30px;
        }

        .filter-btn {
            display: block;
            margin: 5px auto;
            max-width: 200px;
        }

        .event-content {
            padding: 20px;
        }

        .event-footer {
            flex-direction: column;
            gap: 15px;
            align-items: stretch;
        }

        .read-more-btn {
            text-align: center;
        }
    }
</style>
@endsection

@section('content')
    <!-- Hero Section -->
    <section class="events-hero">
        <div class="container">
            <h1>Upcoming Events</h1>
            <p>Stay connected with our latest events, workshops, and community gatherings</p>

            <div class="breadcrumb-nav">
                <a href="{{ route('home') }}">Home</a> /
                <span class="active">Events</span>
            </div>
        </div>
    </section>

    <!-- Featured Events Section -->
    @if($featuredEvents->count() > 0)
        <section class="featured-events">w
            <div class="container">
                <div class="section-title">
                    <h2>Featured Events</h2>
                    <p>Don't miss these specially highlighted events</p>
                </div>

                <div class="row">
                    @foreach($featuredEvents as $event)
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="event-card">
                                <div class="event-image">
                                    @if($event->image)
                                        <img src="{{ vasset($event->image) }}" alt="{{ $event->title }}">
                                    @else
                                        <img src="{{ asset('front/images/default-event.jpg') }}" alt="{{ $event->title }}">
                                    @endif

                                    <div class="event-date-badge">
                                        <span class="day">{{ $event->event_date->format('d') }}</span>
                                        <span class="month">{{ $event->event_date->format('M') }}</span>
                                    </div>

                                    <div class="featured-badge">
                                        <i class="fas fa-star"></i> Featured
                                    </div>

                                    <div class="event-status {{ $event->is_today ? 'today' : ($event->is_upcoming ? 'upcoming' : 'past') }}">
                                        {{ $event->status_text }}
                                    </div>
                                </div>

                                <div class="event-content">
                                    <h3><a href="{{ route('events.show', $event->slug) }}">{{ $event->title }}</a></h3>

                                    <div class="event-meta">
                                        <div class="event-meta-item">
                                            <i class="fas fa-calendar"></i>
                                            <span>{{ $event->formatted_date }}</span>
                                        </div>
                                        <div class="event-meta-item">
                                            <i class="fas fa-clock"></i>
                                            <span>{{ $event->formatted_time }}</span>
                                        </div>
                                        <div class="event-meta-item">
                                            <i class="fas fa-map-marker-alt"></i>
                                            <span>{{ $event->location }}</span>
                                        </div>
                                    </div>

                                    <div class="event-description">
                                        {{ Str::limit($event->short_description, 120) }}
                                    </div>

                                    <div class="event-footer">
                                        <a href="{{ route('events.show', $event->slug) }}" class="read-more-btn">
                                            Learn More
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- Main Events Section -->
    <section class="events-section">
        <div class="container">
            <div class="section-title">
                <h2>{{ $type === 'upcoming' ? 'Upcoming Events' : ($type === 'past' ? 'Past Events' : 'All Events') }}</h2>
            </div>

            <!-- Search and Filters -->
            <div class="event-filters">
                <form method="GET" action="{{ route('events.index') }}" class="search-box">
                    <input type="text"
                           name="search"
                           value="{{ request('search') }}"
                           placeholder="Search events..."
                           autocomplete="off">
                    <button type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                    @if(request('type'))
                        <input type="hidden" name="type" value="{{ request('type') }}">
                    @endif
                </form>

                <div>
                    <a href="{{ route('events.index') }}"
                       class="filter-btn {{ !request('type') ? 'active' : '' }}">
                        All Events
                    </a>
                    <a href="{{ route('events.index', ['type' => 'upcoming']) }}"
                       class="filter-btn {{ request('type') === 'upcoming' ? 'active' : '' }}">
                        Upcoming
                    </a>
                    <a href="{{ route('events.index', ['type' => 'past']) }}"
                       class="filter-btn {{ request('type') === 'past' ? 'active' : '' }}">
                        Past Events
                    </a>
                </div>
            </div>

            @if($events->count() > 0)
                <div class="row">
                    @foreach($events as $event)
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="event-card">
                                <div class="event-image">
                                    @if($event->image)
                                        <img src="{{ asset($event->image) }}" alt="{{ $event->title }}">
                                    @else
                                        <img src="{{ asset('front/images/default-event.jpg') }}" alt="{{ $event->title }}">
                                    @endif

                                    <div class="event-date-badge">
                                        <span class="day">{{ $event->event_date->format('d') }}</span>
                                        <span class="month">{{ $event->event_date->format('M') }}</span>
                                    </div>

                                    @if($event->is_featured)
                                        <div class="featured-badge">
                                            <i class="fas fa-star"></i> Featured
                                        </div>
                                    @endif

                                    <div class="event-status {{ $event->is_today ? 'today' : ($event->is_upcoming ? 'upcoming' : 'past') }}">
                                        {{ $event->status_text }}
                                    </div>
                                </div>

                                <div class="event-content">
                                    <h3><a href="{{ route('events.show', $event->slug) }}">{{ $event->title }}</a></h3>

                                    <div class="event-meta">
                                        <div class="event-meta-item">
                                            <i class="fas fa-calendar"></i>
                                            <span>{{ $event->formatted_date }}</span>
                                        </div>
                                        <div class="event-meta-item">
                                            <i class="fas fa-clock"></i>
                                            <span>{{ $event->formatted_time }}</span>
                                        </div>
                                        <div class="event-meta-item">
                                            <i class="fas fa-map-marker-alt"></i>
                                            <span>{{ $event->location }}</span>
                                        </div>
                                    </div>

                                    <div class="event-description">
                                        {{ Str::limit($event->short_description, 120) }}
                                    </div>

                                    <div class="event-footer">
                                        <a href="{{ route('events.show', $event->slug) }}" class="read-more-btn">
                                            Learn More
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                @if($events->hasPages())
                    <div class="d-flex justify-content-center mt-5">
                        {{ $events->appends(request()->query())->links() }}
                    </div>
                @endif
            @else
                <div class="no-events">
                    <i class="fas fa-calendar-times"></i>
                    <h3>No Events Found</h3>
                    <p>
                        @if(request('search'))
                            No events match your search criteria. Try adjusting your search terms.
                        @elseif($type === 'upcoming')
                            No upcoming events scheduled at the moment. Check back soon!
                        @elseif($type === 'past')
                            No past events to display.
                        @else
                            No events available at the moment.
                        @endif
                    </p>
                    @if(request('search') || request('type'))
                        <a href="{{ route('events.index') }}" class="read-more-btn">
                            View All Events
                        </a>
                    @endif
                </div>
            @endif
        </div>
    </section>
@endsection

@section('js')
<script>
    $(document).ready(function() {
        // Auto-submit search form after user stops typing
        let searchTimeout;
        $('input[name="search"]').on('keyup', function() {
            clearTimeout(searchTimeout);
            const form = $(this).closest('form');
            const query = $(this).val().trim();

            searchTimeout = setTimeout(function() {
                if (query.length >= 3 || query.length === 0) {
                    form.submit();
                }
            }, 500);
        });

        // Smooth scroll to events section when coming from internal links
        if (window.location.hash === '#events') {
            $('html, body').animate({
                scrollTop: $('.events-section').offset().top - 100
            }, 800);
        }

        // Add loading state to read more buttons
        $('.read-more-btn').on('click', function() {
            const btn = $(this);
            const originalText = btn.text();
            btn.html('<i class="fas fa-spinner fa-spin"></i> Loading...');

            // Reset after a delay if navigation doesn't occur
            setTimeout(function() {
                btn.text(originalText);
            }, 3000);
        });
    });
</script>
@endsection
