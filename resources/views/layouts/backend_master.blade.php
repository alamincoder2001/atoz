<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="keywords" content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 5 admin, bootstrap 5, css3 dashboard, bootstrap 5 dashboard, Matrix lite admin bootstrap 5 dashboard, frontend, responsive bootstrap 5 admin template, Matrix admin lite design, Matrix admin lite dashboard bootstrap 5 dashboard template" />
    <meta name="description" content="Matrix Admin Lite Free Version is powerful and clean admin dashboard template, inpired from Bootstrap Framework" />
    <meta name="robots" content="noindex,nofollow" />
    <title>@yield('title')</title>
    <!-- Favicon icon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset($profile->navicon != null ? $profile->navicon : 'noImage.jpg')}}" />
    @include("layouts.backend.style")
</head>

<body>
    <main id="app">
        <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full" data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
            @include("layouts.backend.navbar")
            <!-- End Topbar header -->
            <!-- left sidebar -->
            @include("layouts.backend.sidebar")

            <!-- Page wrapper  -->
            <div class="page-wrapper">
                <div class="page-breadcrumb">
                    <div class="row">
                        <div class="col-12 d-flex no-block align-items-center">
                            <h4 class="page-title">@yield('breadcrumb_title')</h4>
                            <div class="ms-auto text-end">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                                        <li class="breadcrumb-item" aria-current="page">
                                            @yield('breadcrumb_item')
                                        </li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- breadcrumb end -->

                <div class="container-fluid">
                    <div class="row">
                        @yield("content")
                    </div>
                </div>
                <footer class="footer text-center">
                    Developed by
                    <a href="https://linktechbd.com/" target="_blank">Link-Up Technology Ltd.</a>
                </footer>
            </div>
        </div>
    </main>
    @include("layouts.backend.script")
    <script>
        function dateTime() {
            d = new Date().toDateString();
            time = new Date().toLocaleTimeString();
            document.getElementById("time").innerText = d + ', ' + time
            setTimeout(() => {
                dateTime()
            }, 1000)
        }
        dateTime()
    </script>
</body>

</html>