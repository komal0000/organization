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
        <style>
            body{
                background-color: #fafafa;
            }
        </style>
    <title>{{ config('app.name') }} @yield('title')</title>
    <style>
        .dashboard-links a:not(:last-child)::after {
            content: "/";
            margin: 0 5px;
            /* Adjust the spacing as needed */
        }

        .dashboard-links a {
            color: rgb(81, 81, 81);
            text-decoration: none;
            font-weight: 600;
        }

        .dashboard-links a:hover {
            color: rgb(85, 85, 255);
        }

        .dropify-wrapper .dropify-message p {
            font-size: 1rem;
        }
        label{
            margin-bottom:10px;
            font-weight: 600;
        }
    </style>
</head>

<body>

    <div class="row m-0">
        <div class="col-md-2">
            @include('back.sidebar')
        </div>
        <div class="col-md-10 pt-3 ">
            <div class="d-flex shadow align-items-center py-3 px-2 justify-content-between">
                <div class="dashboard-links">
                    <a href="Dashboard">Dashboard</a>
                    @yield('head-title')
                </div>
                <div class="dashboard-buttons">
                    @yield('toolbar')
                </div>
            </div>
            @yield('content')
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

    </script>
    @yield('js')

</body>

</html>
