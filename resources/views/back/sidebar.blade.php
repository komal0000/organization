@php
    $firstForm = App\Models\Form::first();
    // notice pages are split by type (notice, news, about...); edit pages carry a bound Notice instead of a type
    $routeNotice = request()->route('notice');
    $noticeType = request()->route('type') ?? ($routeNotice instanceof App\Models\Notice ? $routeNotice->type : null);
    $on = fn($pattern, $type = null) => request()->routeIs($pattern) && ($type === null || $noticeType == $type);

    $groups = [
        'Website Content' => [
            ['Notices', 'fa-bell', route('admin.notice.index', ['type' => 1]), $on('admin.notice.*', 1)],
            ['News', 'fa-newspaper', route('admin.notice.index', ['type' => 2]), $on('admin.notice.*', 2)],
            ['About Us', 'fa-info-circle', route('admin.notice.index', ['type' => 8]), $on('admin.notice.*', 8)],
            ['Committees', 'fa-users', route('admin.notice.index', ['type' => 4]), $on('admin.notice.*', 4) || $on('admin.team.*')],
            ['Galleries', 'fa-images', route('admin.notice.index', ['type' => 5]), $on('admin.notice.*', 5) || $on('admin.gallery.*')],
            ['FAQ', 'fa-question-circle', route('admin.notice.index', ['type' => 6]), $on('admin.notice.*', 6)],
            ['Sliders', 'fa-sliders-h', route('admin.slider.index'), $on('admin.slider.*')],
            ['Partners', 'fa-handshake', route('admin.partners.index'), $on('admin.partners.*')],
            ['Reports & Documents', 'fa-file-alt', route('admin.reports.index'), $on('admin.reports.*')],
        ],
        'Programs & Events' => [
            ['Programs', 'fa-clipboard-list', route('admin.programs.index'), $on('admin.programs.*')],
            ['Events', 'fa-calendar-alt', route('admin.events.index'), $on('admin.events.*')],
        ],
        'Membership' => [
            ['Applications', 'fa-user-check', route('admin.membership-applications.index'), $on('admin.membership-applications.*')],
            ['Page Content', 'fa-edit', route('admin.membership-content.index'), $on('admin.membership-content.*')],
        ],
        'CSIC' => array_filter([
            ['Registration Applications', 'fa-file-signature', route('admin.registration-applications.index'), $on('admin.registration-applications.*')],
            $firstForm ? ['Registration Form', 'fa-list-check', route('admin.admin_form_edit', $firstForm->id), $on('admin.admin_form_*')] : null,
            ['Essential Files', 'fa-file-download', route('admin.essential-files.index'), $on('admin.essential-files.*')],
            ['Startup Database', 'fa-rocket', route('admin.startups.index'), $on('admin.startups.*')],
        ]),
        'Home Page' => [
            ['Statistics', 'fa-chart-line', route('admin.setting.home-statistics'), $on('admin.setting.home-statistics')],
            ['Objectives', 'fa-bullseye', route('admin.setting.home-objectives'), $on('admin.setting.home-objectives')],
            ['Vision, Goals & Mission', 'fa-eye', route('admin.setting.home-vision-goals-mission'), $on('admin.setting.home-vision-goals-mission')],
            ['Home FAQ', 'fa-question-circle', route('admin.setting.homeFAQ'), $on('admin.setting.homeFAQ')],
        ],
        'Settings' => [
            ['General', 'fa-cogs', route('admin.setting.general'), $on('admin.setting.general')],
            ['Contact', 'fa-phone', route('admin.setting.contact'), $on('admin.setting.contact')],
            ['Donation', 'fa-donate', route('admin.setting.donation'), $on('admin.setting.donation')],
            ['Facebook Page', 'fa-thumbs-up', route('admin.setting.fb'), $on('admin.setting.fb')],
            ['Sharing (Meta)', 'fa-share-alt', route('admin.setting.meta'), $on('admin.setting.meta')],
            ['Footer Links', 'fa-link', route('admin.footer-links.index'), $on('admin.footer-links.*')],
        ],
    ];
@endphp

<aside class="admin-sidebar" id="adminSidebar">
    <h5><i class="fas fa-shield-alt me-2"></i>Admin Panel</h5>

    <nav class="sidebar-nav">
        <a class="nav-link {{ $on('admin.index') ? 'active' : '' }}" href="{{ route('admin.index') }}">
            <i class="fas fa-tachometer-alt"></i>Dashboard
        </a>

        @foreach ($groups as $title => $links)
            @php
                $id = 'nav-' . Str::slug($title);
                $open = collect($links)->contains(fn($l) => $l[3]);
            @endphp
            <button class="nav-group-title {{ $open ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse"
                data-bs-target="#{{ $id }}" aria-expanded="{{ $open ? 'true' : 'false' }}" aria-controls="{{ $id }}">
                {{ $title }}<i class="fas fa-chevron-down"></i>
            </button>
            <div class="collapse {{ $open ? 'show' : '' }}" id="{{ $id }}">
                @foreach ($links as [$label, $icon, $url, $active])
                    <a class="nav-link {{ $active ? 'active' : '' }}" href="{{ $url }}" @if ($active) aria-current="page" @endif>
                        <i class="fas {{ $icon }}"></i>{{ $label }}
                    </a>
                @endforeach
            </div>
        @endforeach
    </nav>
</aside>
