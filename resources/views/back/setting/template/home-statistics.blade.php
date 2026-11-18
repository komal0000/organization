@if (isset($data['is_active']) && $data['is_active'])
    <section class="home-block impact-section">
        <div class="container">
            @if (!empty($data['section_title']) || !empty($data['section_subtitle']))
                <div class="text-center mb-4 mb-lg-5">
                    @if (!empty($data['section_title']))
                        <h2 class="home-heading">{{ $data['section_title'] }}</h2>
                    @endif
                    @if (!empty($data['section_subtitle']))
                        <p class="impact-lead">{{ $data['section_subtitle'] }}</p>
                    @endif
                </div>
            @endif

            @if (isset($data['statistics']) && count($data['statistics']) > 0)
                <div class="impact-grid">
                    @foreach ($data['statistics'] as $statistic)
                        <div class="impact-item">
                            <i class="{{ $statistic['icon'] ?? 'fas fa-chart-line' }} impact-icon" aria-hidden="true"></i>
                            <div class="impact-number"><span class="statistic-number" data-count="{{ (int) ($statistic['value'] ?? 0) }}">{{ number_format((int) ($statistic['value'] ?? 0)) }}</span>+</div>
                            <p class="impact-label">{{ $statistic['title'] ?? 'Statistic' }}</p>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
@endif
