<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Pemesanan Aula BPSDM Prov.Kalbar</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('/') }}assets/images/favicon.ico">

    <!-- App css -->

    <link href="{{ asset('/') }}assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-style" />
    <link href="{{ asset('/') }}assets/libs/fullcalendar/main.min.css" rel="stylesheet" type="text/css" />

    <!-- icons -->
    <link href="{{ asset('/') }}assets/css/icons.min.css" rel="stylesheet" type="text/css" />

</head>

<body class="loading" data-layout-mode="horizontal" data-layout-color="light" data-layout-size="fluid"
    data-topbar-color="light" data-leftbar-position="fixed">

    <!-- Begin page -->
    <div id="wrapper">
        <!-- Topbar Start -->
        <div class="navbar-custom">
            <div class="container-fluid">
                <!-- LOGO -->
                <div class="logo-box">
                    <a href="index.html" class="logo logo-light text-center">
                        <span class="logo-sm">
                            <img src="assets/images/logo-bpsdm.png" alt="" height="30">
                        </span>
                        <span class="logo-lg">
                            <img src="assets/images/logo-bpsdm.png" alt="" height="45">
                        </span>
                    </a>
                    <a href="index.html" class="logo logo-dark text-center">
                        <span class="logo-sm">
                            <img src="assets/images/logo-bpsdm.png" alt="" height="30">
                        </span>
                        <span class="logo-lg">
                            <img src="assets/images/logo-bpsdm.png" alt="" height="45">
                        </span>
                    </a>
                </div>

                <ul class="list-unstyled topnav-menu float-end mb-0">
                    <li class="d-none d-lg-block">
                        @guest
                            <a href="{{ route('login') }}" class="nav-link right-bar-toggle waves-effect waves-light">
                                <i class="btn btn-primary">LOGIN</i>
                            </a>
                        @endguest
                        @auth
                            <a href="{{ url('/home') }}" class="nav-link right-bar-toggle waves-effect waves-light">
                                <i class="btn btn-primary">LOGIN</i>
                            @endauth
                    </li>
                </ul>

                <ul class="list-unstyled topnav-menu topnav-menu-left mb-0">
                    <li>
                        <!-- Mobile menu toggle (Horizontal Layout)-->
                        <a class="navbar-toggle nav-link" data-bs-toggle="collapse"
                            data-bs-target="#topnav-menu-content">
                            <div class="lines">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </a>
                        <!-- End mobile menu toggle-->
                    </li>
                    <li class="ms-5 d-lg-none">
                        @guest
                            <a href="{{ route('login') }}" class="nav-link right-bar-toggle waves-effect waves-light">
                                <i class="btn btn-primary">LOGIN</i>
                            </a>
                        @endguest
                        @auth
                            <a href="{{ url('/home') }}" class="nav-link right-bar-toggle waves-effect waves-light">
                                <i class="btn btn-primary">LOGIN</i>
                            @endauth
                    </li>

                </ul>

                <div class="clearfix"></div>

            </div>

        </div>
        <!-- end Topbar -->

        <div class="topnav">
            <div class="container-fluid">
                <nav class="navbar navbar-light navbar-expand-lg topnav-menu">

                    <div class="collapse navbar-collapse" id="topnav-menu-content">
                        <ul class="navbar-nav">
                            <li class="nav-item dropdown">
                                <a class="nav-link arrow-none" href="/" id="topnav-dashboard" role="button"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="mdi mdi-view-dashboard me-1"></i> Dashboard
                                </a>

                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link arrow-none" href="{{ route('info') }}" id="topnav-components"
                                    role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="mdi mdi-lifebuoy me-1"></i> Informasi
                                </a>
                            </li>
                        </ul> <!-- end navbar-->
                    </div> <!-- end .collapsed-->
                </nav>
            </div> <!-- end container-fluid -->
        </div> <!-- end topnav-->

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="content-page">
            <div class="content">

                <!-- Start Content-->
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <h1 class="page-title">Title</h1>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->
                    <div class="row">
                        <h4>Hello</h4>
                    </div>
                    <!-- end row -->
                </div> <!-- container -->

            </div> <!-- content -->

            <!-- Footer Start -->
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <script>
                                document.write(new Date().getFullYear())
                            </script> &copy; Badan Pengembangan Sumber Daya Manusia Provinsi Kalimantan
                            Barat</a>
                        </div>
                        {{-- <div class="col-md-6">
                            <div class="text-md-end footer-links d-none d-sm-block">
                                <a href="javascript:void(0);">About Us</a>
                                <a href="javascript:void(0);">Help</a>
                                <a href="javascript:void(0);">Contact Us</a>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </footer>
            <!-- end Footer -->

            <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
        </div>


        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->


    </div>
    <!-- END wrapper -->

    <!-- Vendor -->
    <script src="{{ asset('/') }}assets/libs/jquery/jquery.min.js"></script>
    <script src="{{ asset('/') }}assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('/') }}assets/libs/simplebar/simplebar.min.js"></script>
    <script src="{{ asset('/') }}assets/libs/node-waves/waves.min.js"></script>
    <script src="{{ asset('/') }}assets/libs/waypoints/lib/jquery.waypoints.min.js"></script>
    <script src="{{ asset('/') }}assets/libs/jquery.counterup/jquery.counterup.min.js"></script>
    <script src="{{ asset('/') }}assets/libs/feather-icons/feather.min.js"></script>

    <!-- plugin js -->
    <script src="{{ asset('/') }}assets/libs/moment/min/moment.min.js"></script>
    <script src="{{ asset('/') }}assets/libs/fullcalendar/main.min.js"></script>

    <!-- Calendar init -->
    <script src="{{ asset('/') }}assets/js/pages/calendar.init.js"></script>

    <!-- knob plugin -->
    <script src="{{ asset('/') }}assets/libs/jquery-knob/jquery.knob.min.js"></script>

    <!--Morris Chart-->
    <script src="{{ asset('/') }}assets/libs/morris.js06/morris.min.js"></script>
    <script src="{{ asset('/') }}assets/libs/raphael/raphael.min.js"></script>

    <!-- Dashboar init js-->
    <script src="{{ asset('/') }}assets/js/pages/dashboard.init.js"></script>

    <!-- App js-->
    <script src="{{ asset('/') }}assets/js/app.min.js"></script>

</body>

</html>
