@extends('front.layout')
@section('meta')
    @includeIf('front.cache.home.meta')
@endsection
@section('css')
    <style>
        /* shared heading style for the impact and vision blocks, matches "Our photo gallery" */
        .home-heading {
            font-family: Nunito, sans-serif;
            font-weight: 900;
            font-size: clamp(1.9rem, 3.5vw, 2.5rem);
            line-height: 1.15;
            color: #283734;
            margin: 0;
        }

        /* Our Impact: soft site-yellow band, dark text, like the gallery band */
        .impact-section {
            background: #fff7e8;
            padding: clamp(3rem, 7vw, 4.5rem) 0;
        }

        .impact-lead {
            color: #6f7775;
            font-size: 1.1rem;
            margin: 0.75rem 0 0;
        }

        .impact-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 1.25rem;
        }

        .impact-item {
            background: #fff;
            border-radius: 12px;
            border-top: 3px solid var(--org-base);
            padding: 1.75rem 1rem;
            text-align: center;
        }

        .impact-icon {
            color: var(--org-base);
            font-size: 1.5rem;
            margin-bottom: 0.75rem;
        }

        .impact-number {
            font-family: Nunito, sans-serif;
            font-weight: 900;
            font-size: clamp(2.2rem, 4.5vw, 3rem);
            line-height: 1;
            color: var(--org-base);
            font-variant-numeric: tabular-nums;
        }

        .impact-label {
            color: #283734;
            font-weight: 600;
            margin: 0.6rem 0 0;
        }

        @media (max-width: 575.98px) {
            .impact-grid {
                grid-template-columns: 1fr 1fr;
                gap: 0.75rem;
            }

            .impact-item {
                padding: 1.25rem 0.5rem;
            }
        }

        /* Our Objectives: same band and cards as Our Impact */
        .objectives-section {
            background: #fff7e8;
            padding: clamp(3rem, 7vw, 4.5rem) 0;
        }

        .objective-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 1.25rem;
        }

        .objective-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            background: #fff;
            border-radius: 12px;
            border-top: 3px solid var(--org-base);
            padding: 1.25rem 1.25rem;
        }

        .objective-icon {
            flex-shrink: 0;
            width: 48px;
            height: 48px;
            border-radius: 10px;
            background: #fff7e8;
            color: var(--org-base);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
        }

        .objective-title {
            font-family: Nunito, sans-serif;
            font-weight: 800;
            font-size: 1.1rem;
            color: #283734;
            margin: 0;
        }

        /* Vision, Mission & Goals */
        .vmg-section {
            background: #fff;
            padding: clamp(3rem, 7vw, 5rem) 0;
        }

        .vmg-intro {
            position: sticky;
            top: 140px;
        }

        .vmg-lead {
            color: #6f7775;
            font-size: 1.1rem;
            margin: 1rem 0 0;
        }

        .vmg-row {
            display: grid;
            grid-template-columns: 3.5rem 1fr;
            gap: 1rem;
            padding: 1.75rem 0;
            border-top: 1px solid #eee9db;
        }

        .vmg-row:first-child {
            border-top: 0;
            padding-top: 0;
        }

        .vmg-num {
            font-family: Nunito, sans-serif;
            font-weight: 900;
            font-size: 1.1rem;
            color: var(--org-base);
            padding-top: 0.2rem;
        }

        .vmg-title {
            font-family: Nunito, sans-serif;
            font-weight: 800;
            font-size: 1.4rem;
            color: #283734;
            margin: 0 0 0.5rem;
        }

        .vmg-text {
            color: #5b6462;
            font-size: 1.05rem;
            line-height: 1.7;
            margin: 0;
            max-width: 40rem;
        }

        @media (max-width: 991.98px) {
            .vmg-intro {
                position: static;
            }
        }

        @media (max-width: 575.98px) {
            .vmg-row {
                grid-template-columns: 2.25rem 1fr;
                gap: 0.5rem;
            }
        }

        .partners-section {
            padding: 20px;
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
            // numbers are already printed in the HTML; this only animates them once they scroll into view
            if (!('IntersectionObserver' in window) || matchMedia('(prefers-reduced-motion: reduce)').matches) return;

            const animateCount = (el) => {
                const target = parseInt(el.dataset.count, 10) || 0;
                const start = performance.now();
                const step = (now) => {
                    const t = Math.min((now - start) / 1200, 1);
                    el.textContent = Math.round(target * (1 - Math.pow(1 - t, 3))).toLocaleString('en-US');
                    if (t < 1) requestAnimationFrame(step);
                };
                requestAnimationFrame(step);
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        observer.unobserve(entry.target);
                        animateCount(entry.target);
                    }
                });
            }, { threshold: 0.6 });

            document.querySelectorAll('.statistic-number').forEach((el) => observer.observe(el));
        });
    </script>
@endsection
