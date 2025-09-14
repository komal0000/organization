@if (isset($data['is_active']) && $data['is_active'])
    <section class="home-block statistics-section py-5">
        <div class="container">
            @if (isset($data['section_title']) || isset($data['section_subtitle']))
                <div class="row">
                    <div class="col-12 text-center mb-5">
                        @if (isset($data['section_title']))
                            <h2 class="stat-section-title">{{ $data['section_title'] }}</h2>
                        @endif
                        @if (isset($data['section_subtitle']))
                            <p class="stat-section-subtitle">{{ $data['section_subtitle'] }}</p>
                        @endif
                    </div>
                </div>
            @endif

            @if (isset($data['statistics']) && count($data['statistics']) > 0)
                <div class="row">
                    @foreach ($data['statistics'] as $statistic)
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="statistic-card text-center">
                                <div class="statistic-icon">
                                    <i class="{{ $statistic['icon'] ?? 'fas fa-chart-line' }}"></i>
                                </div>
                                <div class="statistic-content">
                                    <h3 class="statistic-number" data-count="{{ $statistic['value'] ?? 0 }}">0</h3>
                                    <span class="statistic-plus">+</span>
                                    <p class="statistic-title">{{ $statistic['title'] ?? 'Statistic' }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
@endif
