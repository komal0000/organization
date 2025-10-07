<div class="admin-sidebar">
    <h5><i class="fas fa-shield-alt me-2"></i>Admin Panel</h5>

    <nav class="sidebar-nav">
        <div class="nav-item">
            <a class="nav-link" href="{{ route('admin.notice.index', ['type' => 1]) }}">
                <i class="fas fa-bell me-2"></i>Notices
            </a>
        </div>
        <hr class="nav-divider">

        {{-- <div class="nav-item">
            <a class="nav-link" href="{{route('admin.notice.index',['type'=>2])}}">
                <i class="fas fa-newspaper me-2"></i>News
            </a>
        </div>
        <hr class="nav-divider"> --}}

        <div class="nav-item">
            <a class="nav-link" href="{{ route('admin.notice.index', ['type' => 4]) }}">
                <i class="fas fa-users me-2"></i>Committees
            </a>
        </div>
        <hr class="nav-divider">

        <div class="nav-item">
            <a class="nav-link" href="{{ route('admin.notice.index', ['type' => 5]) }}">
                <i class="fas fa-images me-2"></i>Galleries
            </a>
        </div>
        <hr class="nav-divider">

        <div class="nav-item">
            <a class="nav-link" href="{{ route('admin.notice.index', ['type' => 6]) }}">
                <i class="fas fa-question-circle me-2"></i>FAQ
            </a>
        </div>
        <hr class="nav-divider">

        {{-- <div class="nav-item">
            <a class="nav-link" href="{{route('admin.notice.index',['type'=>7])}}">
                <i class="fas fa-exclamation-triangle me-2"></i>Issues
            </a>
        </div>
        <hr class="nav-divider"> --}}

        <div class="nav-item">
            <a class="nav-link" href="{{ route('admin.notice.index', ['type' => 8]) }}">
                <i class="fas fa-info-circle me-2"></i>About Us
            </a>
        </div>
        <hr class="nav-divider">

        <div class="nav-item">
            <a class="nav-link" href="{{ route('admin.slider.index') }}">
                <i class="fas fa-sliders-h me-2"></i>Sliders
            </a>
        </div>
        <hr class="nav-divider">

        <div class="nav-item">
            <a class="nav-link" href="{{ route('admin.programs.index') }}">
                <i class="fas fa-clipboard-list me-2"></i>Programs
            </a>
        </div>
        <hr class="nav-divider">

        <div class="nav-item">
            <a class="nav-link" href="{{ route('admin.events.index') }}">
                <i class="fas fa-calendar-alt me-2"></i>Events
            </a>
        </div>
        <hr class="nav-divider">
        <!-- Content Management Section -->
        <div class="nav-item mt-3">
            <div class="nav-link text-muted small">
                <i class="fas fa-edit me-2"></i>CONTENT MANAGEMENT
            </div>
        </div>

        <div class="nav-item">
            <a class="nav-link" href="{{ route('admin.partners.index') }}">
                <i class="fas fa-handshake me-2"></i>Partners
            </a>
        </div>
        <hr class="nav-divider">

        <div class="nav-item">
            <a class="nav-link" href="{{ route('admin.reports.index') }}">
                <i class="fas fa-file-alt me-2"></i>Reports & Documents
            </a>
        </div>
        <hr class="nav-divider">

        <div class="nav-item">
            <a class="nav-link" href="{{ route('admin.footer-links.index') }}">
                <i class="fas fa-link me-2"></i>Footer Links
            </a>
        </div>
        <hr class="nav-divider">



        <!-- Settings Section -->
        <div class="nav-item mt-3">
            <div class="nav-link text-muted small">
                <i class="fas fa-cog me-2"></i>SETTINGS
            </div>
        </div>

        <div class="nav-item">
            <a class="nav-link" href="{{ route('admin.setting.general') }}">
                <i class="fas fa-cogs me-2"></i>General Setting
            </a>
        </div>
        <hr class="nav-divider">

        <!-- Home Settings Subsection -->
        <div class="nav-item mt-2">
            <div class="nav-link text-muted small">
                <i class="fas fa-home me-2"></i>HOME SETTINGS
            </div>
        </div>

        <div class="nav-item">
            <a class="nav-link" href="{{ route('admin.setting.homeFAQ') }}">
                <i class="fas fa-question-circle me-2"></i>Home FAQ Setting
            </a>
        </div>
        <hr class="nav-divider">

        <div class="nav-item">
            <a class="nav-link" href="{{ route('admin.setting.home-objectives') }}">
                <i class="fas fa-bullseye me-2"></i>Home Objectives
            </a>
        </div>
        <hr class="nav-divider">

        <div class="nav-item">
            <a class="nav-link" href="{{ route('admin.setting.home-vision-goals-mission') }}">
                <i class="fas fa-eye me-2"></i>Vision, Goals & Mission
            </a>
        </div>
        <hr class="nav-divider">

        <div class="nav-item">
            <a class="nav-link" href="{{ route('admin.setting.home-statistics') }}">
                <i class="fas fa-chart-line me-2"></i>Home Statistics
            </a>
        </div>
        <hr class="nav-divider">

        <div class="nav-item">
            <a class="nav-link" href="{{ route('admin.setting.donation') }}">
                <i class="fas fa-donate me-2"></i>Donation Setting
            </a>
        </div>
        <hr class="nav-divider">

        <div class="nav-item">
            <a class="nav-link" href="{{ route('admin.setting.fb') }}">
                <i class="fab fa-facebook me-2"></i>FB Page Setting
            </a>
        </div>
        <hr class="nav-divider">

        <div class="nav-item">
            <a class="nav-link" href="{{ route('admin.setting.meta') }}">
                <i class="fas fa-share-alt me-2"></i>Sharing Setting
            </a>
        </div>
        <hr class="nav-divider">

        <div class="nav-item">
            <a class="nav-link" href="{{ route('admin.setting.contact') }}">
                <i class="fas fa-phone me-2"></i>Contact Setting
            </a>
        </div>
        <hr class="nav-divider">

        <!-- Membership Section -->
        <div class="nav-item mt-3">
            <div class="nav-link text-muted small">
                <i class="fas fa-users me-2"></i>MEMBERSHIP
            </div>
        </div>

        <div class="nav-item">
            <a class="nav-link" href="{{ route('admin.membership-content.index') }}">
                <i class="fas fa-edit me-2"></i>Page Content
            </a>
        </div>
        <hr class="nav-divider">

        <div class="nav-item">
            <a class="nav-link" href="{{ route('admin.membership-applications.index') }}">
                <i class="fas fa-user-check me-2"></i>Membership Applications
            </a>
        </div>
        <hr class="nav-divider">


        <div class="nav-item mt-3">
            <div class="nav-link text-muted small">
                <i class="fas fa-users me-2"></i>CSIC
            </div>
        </div>
        <hr class="nav-divider">
        <div class="nav-item">
            @php
                $firstForm = App\Models\Form::first();
            @endphp
            @if ($firstForm)
                <a class="nav-link" href="{{ route('admin.admin_form_edit', $firstForm->id) }}">
                    <i class="fas fa-wpforms me-2"></i>Registration Form
                </a>
            @endif
        </div>
        <hr class="nav-divider">
        <div class="nav-item">
            <a class="nav-link" href="{{ route('admin.registration-applications.index') }}">
                <i class="fas fa-file-alt me-2"></i>Registration Applications
            </a>
        </div>
        <hr class="nav-divider">
        <div class="nav-item">
            <a class="nav-link" href="{{ route('admin.essential-files.index') }}">
                <i class="fas fa-file-download me-2"></i>Essential Files
            </a>
        </div>
    </nav>
</div>

<style>
    .admin-sidebar {
        background: #2c3e50;
        color: #ecf0f1;
        min-height: 100vh;
        padding: 20px 0;
        box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
    }

    .admin-sidebar h5 {
        color: #f39c12;
        font-weight: 700;
        text-align: center;
        margin-bottom: 30px;
        padding: 0 20px;
        border-bottom: 2px solid #34495e;
        padding-bottom: 15px;
    }

    .sidebar-nav {
        padding: 0 10px;
    }

    .nav-item {
        margin-bottom: 5px;
    }

    .nav-link {
        color: #bdc3c7 !important;
        text-decoration: none;
        padding: 12px 20px;
        border-radius: 8px;
        transition: all 0.3s ease;
        display: block;
        font-weight: 500;
        border-left: 3px solid transparent;
    }

    .nav-link:hover {
        background: #34495e;
        color: #f39c12 !important;
        transform: translateX(5px);
        border-left-color: #f39c12;
    }

    .nav-link.active {
        background: #f39c12;
        color: #2c3e50 !important;
        border-left-color: #e67e22;
    }

    .nav-link i {
        width: 20px;
        text-align: center;
        margin-right: 10px;
        font-size: 16px;
    }

    .nav-divider {
        border: none;
        height: 1px;
        background: linear-gradient(to right, transparent, #34495e, transparent);
        margin: 8px 20px;
    }

    .nav-link.text-muted {
        background: #34495e;
        color: #95a5a6 !important;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-size: 0.85rem;
        margin-top: 20px;
        margin-bottom: 10px;
        border-radius: 6px;
        cursor: default;
    }

    .nav-link.text-muted:hover {
        transform: none;
        border-left-color: transparent;
    }

    /* Section styling for better organization */
    .nav-section {
        margin-bottom: 25px;
    }

    .nav-section-header {
        background: #34495e;
        padding: 10px 20px;
        border-radius: 6px;
        margin-bottom: 10px;
        border-left: 3px solid #f39c12;
    }

    .nav-section-title {
        color: #f39c12;
        font-weight: 600;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .admin-sidebar {
            position: fixed;
            left: -280px;
            width: 280px;
            z-index: 9999;
            transition: left 0.3s ease;
        }

        .admin-sidebar.show {
            left: 0;
        }
    }

    /* Add hover effects for icons */
    .nav-link:hover i {
        transform: scale(1.1);
        transition: transform 0.2s ease;
    }

    /* Special styling for Events link */
    .nav-link[href*="events"] {
        position: relative;
    }

    .nav-link[href*="events"]:after {
        content: 'NEW';
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        background: #e74c3c;
        color: white;
        font-size: 0.7rem;
        padding: 2px 6px;
        border-radius: 10px;
        font-weight: 600;
    }
</style>
