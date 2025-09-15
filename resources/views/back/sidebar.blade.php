<div class="admin-sidebar">
    <h5><i class="fas fa-shield-alt me-2"></i>Admin Panel</h5>

    <nav class="sidebar-nav">
        <div class="nav-item">
            <a class="nav-link" href="{{route('admin.notice.index',['type'=>1])}}">
                <i class="fas fa-bell me-2"></i>Notices
            </a>
        </div>
        <hr class="nav-divider">

        <div class="nav-item">
            <a class="nav-link" href="{{route('admin.notice.index',['type'=>2])}}">
                <i class="fas fa-newspaper me-2"></i>News
            </a>
        </div>
        <hr class="nav-divider">

        <div class="nav-item">
            <a class="nav-link" href="{{route('admin.notice.index',['type'=>4])}}">
                <i class="fas fa-users me-2"></i>Committees
            </a>
        </div>
        <hr class="nav-divider">

        <div class="nav-item">
            <a class="nav-link" href="{{route('admin.notice.index',['type'=>5])}}">
                <i class="fas fa-images me-2"></i>Galleries
            </a>
        </div>
        <hr class="nav-divider">

        <div class="nav-item">
            <a class="nav-link" href="{{route('admin.notice.index',['type'=>6])}}">
                <i class="fas fa-question-circle me-2"></i>FAQ
            </a>
        </div>
        <hr class="nav-divider">

        <div class="nav-item">
            <a class="nav-link" href="{{route('admin.notice.index',['type'=>7])}}">
                <i class="fas fa-exclamation-triangle me-2"></i>Issues
            </a>
        </div>
        <hr class="nav-divider">

        <div class="nav-item">
            <a class="nav-link" href="{{route('admin.notice.index',['type'=>8])}}">
                <i class="fas fa-info-circle me-2"></i>About Us
            </a>
        </div>
        <hr class="nav-divider">

        <div class="nav-item">
            <a class="nav-link" href="{{route('admin.slider.index')}}">
                <i class="fas fa-sliders-h me-2"></i>Sliders
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
            <a class="nav-link" href="{{route('admin.setting.general')}}">
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
            <a class="nav-link" href="{{route('admin.setting.homeFAQ')}}">
                <i class="fas fa-question-circle me-2"></i>Home FAQ Setting
            </a>
        </div>
        <hr class="nav-divider">

        <div class="nav-item">
            <a class="nav-link" href="{{route('admin.setting.home-objectives')}}">
                <i class="fas fa-bullseye me-2"></i>Home Objectives
            </a>
        </div>
        <hr class="nav-divider">

        <div class="nav-item">
            <a class="nav-link" href="{{route('admin.setting.home-vision-goals-mission')}}">
                <i class="fas fa-eye me-2"></i>Vision, Goals & Mission
            </a>
        </div>
        <hr class="nav-divider">

        <div class="nav-item">
            <a class="nav-link" href="{{route('admin.setting.home-statistics')}}">
                <i class="fas fa-chart-line me-2"></i>Home Statistics
            </a>
        </div>
        <hr class="nav-divider">

        <div class="nav-item">
            <a class="nav-link" href="{{route('admin.setting.donation')}}">
                <i class="fas fa-donate me-2"></i>Donation Setting
            </a>
        </div>
        <hr class="nav-divider">

        <div class="nav-item">
            <a class="nav-link" href="{{route('admin.setting.fb')}}">
                <i class="fab fa-facebook me-2"></i>FB Page Setting
            </a>
        </div>
        <hr class="nav-divider">

        <div class="nav-item">
            <a class="nav-link" href="{{route('admin.setting.meta')}}">
                <i class="fas fa-share-alt me-2"></i>Sharing Setting
            </a>
        </div>
        <hr class="nav-divider">

        <div class="nav-item">
            <a class="nav-link" href="{{route('admin.setting.contact')}}">
                <i class="fas fa-phone me-2"></i>Contact Setting
            </a>
        </div>
        <hr class="nav-divider">

        <div class="nav-item">
            <a class="nav-link" href="{{route('admin.footer-links.index')}}">
                <i class="fas fa-link me-2"></i>Footer Links
            </a>
        </div>
        <hr class="nav-divider">

        <div class="nav-item">
            @php
                $firstForm = App\Models\Form::first();
            @endphp
            @if($firstForm)
                <a class="nav-link" href="{{route('admin.admin_form_edit', $firstForm->id)}}">
                    <i class="fas fa-wpforms me-2"></i>Registration Form
                </a>
            @endif
        </div>
        <hr class="nav-divider">

        <!-- Membership Section -->
        <div class="nav-item mt-3">
            <div class="nav-link text-muted small">
                <i class="fas fa-users me-2"></i>MEMBERSHIP
            </div>
        </div>

        <div class="nav-item">
            <a class="nav-link" href="{{route('admin.membership-content.index')}}">
                <i class="fas fa-edit me-2"></i>Page Content
            </a>
        </div>
        <hr class="nav-divider">

        <div class="nav-item">
            <a class="nav-link" href="{{route('admin.membership-applications.index')}}">
                <i class="fas fa-user-check me-2"></i>Membership Applications
            </a>
        </div>
        <hr class="nav-divider">

        <div class="nav-item">
            <a class="nav-link" href="{{route('admin.registration-applications.index')}}">
                <i class="fas fa-file-alt me-2"></i>Registration Applications
            </a>
        </div>
    </nav>
</div>

