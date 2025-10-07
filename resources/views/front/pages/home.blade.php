@extends('front.layout')
@section('meta')
    @includeIf('front.cache.home.meta')
@endsection
@section('css')
    <style>
        .statistics-section {
            background: linear-gradient(135deg, var(--org-primary) 0%, var(--org-base) 100%);
            color: white;
            position: relative;
            overflow: hidden;
        }

        .statistics-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.1);
            z-index: 1;
        }

        .statistics-section .container {
            position: relative;
            z-index: 2;
        }

        .statistic-card {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            padding: 2rem 1.5rem;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .statistic-card:hover {
            transform: translateY(-10px);
            background: rgba(255, 255, 255, 0.15);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
        }

        .statistic-icon {
            width: 63px;
            height: 63px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
            transition: all 0.3s ease;
        }

        .statistic-card:hover .statistic-icon {
            background: rgba(255, 255, 255, 0.3);
            transform: scale(1.1);
        }

        .statistic-icon i {
            font-size: 2.5rem;
            color: white;
        }

        .statistic-content {
            text-align: center;
        }

        .statistic-number {
            font-size: 3rem;
            font-weight: 900;
            color: white;
            margin-bottom: 0;
            line-height: 1;
            display: inline-block;
        }

        .statistic-plus {
            font-size: 2.5rem;
            font-weight: 700;
            color: white;
            margin-left: 0.2rem;
            opacity: 0.8;
        }

        .statistic-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: white;
            margin-top: 0.8rem;
            margin-bottom: 0;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .stat-section-title {
            color: white;
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .stat-section-subtitle {
            color: white;
            font-size: 1.2rem;
            margin-bottom: 0;
            font-weight: 300;
        }

        @media (max-width: 768px) {
            .statistic-card {
                padding: 2rem 1.5rem;
                margin-bottom: 2rem;
            }

            .stat-section-title {
                font-size: 2.5rem;
            }

            .statistic-number {
                font-size: 3rem;
            }

            .statistic-plus {
                font-size: 2.5rem;
            }

            .statistic-icon {
                width: 80px;
                height: 80px;
            }

            .statistic-icon i {
                font-size: 2.5rem;
            }

            .statistic-title {
                font-size: 1.1rem;
            }
        }

        @media (max-width: 576px) {
            .statistic-number {
                font-size: 2.5rem;
            }

            .statistic-plus {
                font-size: 2rem;
            }
        }

        .partners-section {
            padding: 80px 0;
            background-color: #f8f9fa;
            position: relative;
        }

        .partners-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--org-primary, #2c3e50);
            margin-bottom: 1rem;
            letter-spacing: 2px;
        }

        .title-underline {
            width: 80px;
            height: 4px;
            background: linear-gradient(135deg, var(--org-primary, #2c3e50) 0%, var(--org-base, #27ae60) 100%);
            margin: 0 auto 3rem;
            border-radius: 2px;
        }

        .partner-item {
            background: white;
            border-radius: 15px;
            padding: 10px 5px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            height: 120px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .partner-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, var(--org-primary, #2c3e50) 0%, var(--org-base, #27ae60) 100%);
            opacity: 0;
            transition: all 0.3s ease;
            z-index: 1;
        }

        .partner-item:hover::before {
            left: 0;
            opacity: 0.05;
        }

        .partner-item:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        }

        .partner-link {
            display: block;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            position: relative;
            z-index: 2;
        }

        .partner-logo {
            max-width: 100%;
            max-height: 60px;
            width: auto;
            height: auto;
            object-fit: contain;
            transition: all 0.3s ease;
            filter: grayscale(100%) opacity(0.7);
        }

        .partner-item:hover .partner-logo {
            filter: grayscale(0%) opacity(1);
            transform: scale(1.05);
        }

        @media (max-width: 768px) {
            .partners-section {
                padding: 60px 0;
            }

            .partners-title {
                font-size: 2rem;
            }

            .partner-item {
                padding: 20px 15px;
                height: 100px;
            }

            .partner-logo {
                max-height: 50px;
            }
        }

        @media (max-width: 576px) {
            .partners-title {
                font-size: 1.8rem;
            }

            .partner-item {
                height: 80px;
                padding: 15px 10px;
            }

            .partner-logo {
                max-height: 40px;
            }
        }

        /* Donation Section Styling */
        #homedonate {
            padding: 80px 0;
            background: linear-gradient(135deg, var(--org-primary, #2c3e50) 0%, var(--org-base, #27ae60) 100%);
            position: relative;
            overflow: hidden;
        }

        #homedonate::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.1);
            z-index: 1;
        }

        #homedonate .container {
            position: relative;
            z-index: 2;
        }

        #homedonate .title {
            font-size: 2.8rem;
            font-weight: 700;
            color: white;
            margin-bottom: 1.5rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
            line-height: 1.2;
        }

        #homedonate .desc {
            font-size: 1.2rem;
            color: rgba(255, 255, 255, 0.95);
            line-height: 1.6;
            margin-bottom: 2rem;
            font-weight: 300;
        }

        .qr-holder {
            text-align: center;
            padding: 20px;
        }

        .qr-holder img {
            max-width: 200px;
            width: 100%;
            height: auto;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            background: white;
            padding: 15px;
            transition: all 0.3s ease;
        }

        .qr-holder img:hover {
            transform: scale(1.05);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.4);
        }

        #homedonate .extra {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            padding: 30px;
            color: white;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            transition: all 0.3s ease;
        }

        #homedonate .extra:hover {
            background: rgba(255, 255, 255, 0.15);
            transform: translateY(-5px);
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.2);
        }

        #homedonate .extra h3 {
            color: white;
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 1rem;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
        }

        #homedonate .extra p {
            color: rgba(255, 255, 255, 0.9);
            font-size: 1rem;
            line-height: 1.5;
            margin-bottom: 1rem;
        }

        #homedonate .extra ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        #homedonate .extra li {
          color: white;
            font-size: 0.95rem;
            line-height: 1.4;
            margin-bottom: 0.5rem;
            position: relative;
            padding-left: 20px;
        }

        #homedonate .extra li::before {
            content: '✓';
            position: absolute;
            left: 0;
            color: #27ae60;
            font-weight: bold;
            font-size: 1.1rem;
        }

        /* Add floating elements for visual appeal */
        #homedonate::after {
            content: '';
            position: absolute;
            top: -50px;
            right: -50px;
            width: 200px;
            height: 200px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.05);
            z-index: 1;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            #homedonate {
                padding: 60px 0;
            }

            #homedonate .title {
                font-size: 2.2rem;
                text-align: center;
            }

            #homedonate .desc {
                font-size: 1.1rem;
                text-align: center;
            }

            .qr-holder {
                margin: 30px 0;
            }

            .qr-holder img {
                max-width: 150px;
            }

            #homedonate .extra {
                margin-top: 20px;
                padding: 25px;
            }
        }

        @media (max-width: 576px) {
            #homedonate .title {
                font-size: 1.8rem;
            }

            #homedonate .desc {
                font-size: 1rem;
            }

            .qr-holder img {
                max-width: 120px;
            }

            #homedonate .extra {
                padding: 20px;
            }
        }
    </style>
@endsection
@section('content')
    @includeIf('front.cache.home.slider')
    @includeIf('front.cache.home.about')

    <div class="container mt-5">
        <div class="row mt-5">
            <div class="col-md-7">
                @includeIf('front.cache.home.notices')
            </div>
            <div class="col-md-5">
                @includeIf('front.cache.home.members')
            </div>
        </div>

    </div>
    @includeIf('front.cache.home.statistics')
    @includeIf('front.cache.home.vision-goals-mission')
    @includeIf('front.cache.home.objectives')
    {{-- @if (config('app.has_donation'))
        @php
            $donationSetting = getSetting('donation');
        @endphp
        @if (isset($donationSetting->title))
            <div id="homedonate">
                <div class="container">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="title">
                                {{ $donationSetting->title }}
                            </div>
                            <div class="desc">
                                {{ $donationSetting->about }}
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="qr-holder">
                                <img loading="lazy" src="{{ vasset($donationSetting->qr) }}" alt="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="extra">
                                {!! $donationSetting->extra !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endif --}}

    <div id="homegallery">
        <div class="gallery-top">
            <h4 class="title">
                Our photo gallery
            </h4>
        </div>
        @includeIf('front.cache.home.galleries')
    </div>

    @includeIf('front.cache.home.partners')

    <div id="homefaq">
        <div class="container">
            <div class="row">
                @includeIf('front.cache.homeFAQ')
                <div class="col-md-6">
                    @includeIf('front.cache.home.faq')

                </div>
                <div div class="d-block d-md-none text-center">
                    <a href="{{ route('faq') }}" class="more">
                        Get More Help
                    </a>
                </div>
            </div>
        </div>
    </div>

    @includeIf('front.cache.home.news')

@endsection
@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Count up animation
            const countElements = document.querySelectorAll('.statistic-number');

            const animateCount = (element) => {
                const target = parseInt(element.dataset.count);
                const duration = 2000; // 2 seconds
                const increment = target / (duration / 16); // 60fps
                let current = 0;

                const timer = setInterval(() => {
                    current += increment;
                    if (current >= target) {
                        element.textContent = target;
                        clearInterval(timer);
                    } else {
                        element.textContent = Math.floor(current);
                    }
                }, 16);
            };

            // Intersection Observer for scroll trigger
            const observer = new IntersectionObserver((entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        const numberElement = entry.target.querySelector('.statistic-number');
                        if (numberElement && !numberElement.classList.contains('animated')) {
                            numberElement.classList.add('animated');
                            animateCount(numberElement);
                        }
                    }
                });
            }, {
                threshold: 0.5
            });

            // Observe statistic cards
            document.querySelectorAll('.statistic-card').forEach((card) => {
                observer.observe(card);
            });
        });
    </script>
@endsection
