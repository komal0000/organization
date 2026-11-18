<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin="">
    <link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin="">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css"
        integrity="sha512-EZSUkJWTjzDlspOoPSpUFR0o0Xy7jdzW//6qhUkoZ9c4StFkVsp9fbbd0O06p9ELS3H486m4wmrCELjza4JEog=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}?v={{ filemtime(public_path('css/admin.css')) }}">

    @php
        // breadcrumb links become the tab title, e.g. "Committees / Board"
        $pageTitle = trim(preg_replace('/\s*\n\s*/', ' / ', trim(html_entity_decode(strip_tags($__env->yieldContent('head-title'))))));
    @endphp
    <title>{{ $pageTitle ?: 'Dashboard' }} · Admin · {{ config('app.name') }}</title>
</head>

<body>
    <div class="admin-container">
        <div class="row m-0 g-0">
            <div class="col-lg-2 col-md-3">
                @include('back.sidebar')
            </div>
            <div class="col-lg-10 col-md-9 admin-main">
                <div class="admin-header">
                    <div class="admin-breadcrumb">
                        <button class="btn btn-admin-outline admin-menu-toggle" type="button" aria-label="Open menu"
                            onclick="document.getElementById('adminSidebar').classList.toggle('show')">
                            <i class="fas fa-bars"></i>
                        </button>
                        <a href="{{ route('admin.index') }}">
                            <i class="fas fa-home me-1"></i>Dashboard
                        </a>
                        @yield('head-title')
                    </div>
                    <div class="admin-toolbar">
                        @yield('toolbar')
                    </div>
                    <div class="admin-account">
                        <div class="dropdown">
                            <button class="btn btn-admin-outline dropdown-toggle" type="button" id="adminDropdown" data-bs-toggle="dropdown" aria-label="Account menu">
                                <i class="fas fa-user"></i><span class="d-none d-sm-inline ms-1">Admin</span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('admin.setting.password') }}">
                                    <i class="fas fa-key me-2"></i>Change Password
                                </a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item text-danger" href="{{ route('logout') }}" onclick="return confirm('Do you want to logout?')">
                                    <i class="fas fa-sign-out-alt me-2"></i>Logout
                                </a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="admin-content">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"
        integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>


    <script>
        function showToastr() {
            @if (Session::has('message') || Session::has('error') || Session::has('info') || Session::has('warning'))
                toastr.options = {
                    "closeButton": true,
                    "progressBar": true
                }

                @if (Session::has('message'))
                    toastr.success("{{ session('message') }}");
                @endif

                @if (Session::has('error'))
                    toastr.error("{{ session('error') }}");
                @endif

                @if (Session::has('info'))
                    toastr.info("{{ session('info') }}");
                @endif

                @if (Session::has('warning'))
                    toastr.warning("{{ session('warning') }}");
                @endif
            @endif
        }

        $(document).ready(function() {
            $('.dropify').dropify();
            showToastr();
        });

        // phone menu: a tap outside the open sidebar closes it
        document.addEventListener('click', function(e) {
            const sidebar = document.getElementById('adminSidebar');
            if (sidebar.classList.contains('show') && !sidebar.contains(e.target) && !e.target.closest('.admin-menu-toggle')) {
                sidebar.classList.remove('show');
            }
        });

    </script>
    @yield('js')

</body>

</html>
