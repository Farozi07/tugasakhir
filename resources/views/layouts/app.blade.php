<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('/') }}assets/images/logo-bpsdm-sm.ico">

    <!-- App css -->

    <link href="{{ asset('/') }}/assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-style" />

    <!-- icons -->
    <link href="{{ asset('/') }}/assets/css/icons.min.css" rel="stylesheet" type="text/css" />

    <!-- Sweet Alert-->
    <link href="{{ asset('/') }}assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />

    <!-- Plugin css -->
    <link href="{{ asset('/') }}assets/libs/spectrum-colorpicker2/spectrum.min.css" rel="stylesheet" type="text/css">
    <link href="{{ asset('/') }}assets/libs/clockpicker/bootstrap-clockpicker.min.css" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('/') }}/assets/libs/fullcalendar/main.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/') }}assets/libs/flatpickr/flatpickr.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/') }}assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('/') }}assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('/') }}assets/libs/mohithg-switchery/switchery.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/') }}assets/libs/multiselect/css/multi-select.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/') }}assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/') }}assets/libs/selectize/css/selectize.bootstrap3.css" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('/') }}assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet"
        type="text/css" />

    <!-- third party css -->
    <link href="{{ asset('/') }}assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('/') }}assets/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css"
        rel="stylesheet" type="text/css" />
    <link href="{{ asset('/') }}assets/libs/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css"
        rel="stylesheet" type="text/css" />
    <link href="{{ asset('/') }}assets/libs/datatables.net-select-bs5/css//select.bootstrap5.min.css"
        rel="stylesheet" type="text/css" />
    <!-- third party css end -->

</head>

<!-- body start -->

<body class="loading" data-layout-color="light" data-layout-mode="default" data-layout-size="fluid"
    data-topbar-color="dark" data-leftbar-position="fixed" data-leftbar-color="light" data-leftbar-size='default'
    data-sidebar-user='true'>
    <!-- Begin page -->
    <div id="wrapper">

        <!-- Topbar Start -->
        <div class="navbar-custom">
            <ul class="list-unstyled topnav-menu float-end mb-0">
                <li class="dropdown notification-list" style="margin-top: 15px;">
                    <a href="{{ route('logout') }}" class="btn btn-danger"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        LOGOUT
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>

            <!-- LOGO -->
            <div class="logo-box">
                <a href="#" class="logo logo-light text-center">
                    <span class="logo-sm">
                        <img src="{{ asset('/') }}/assets/images/logo-bpsdm.png" alt="" height="30">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('/') }}/assets/images/logo-bpsdm.png" alt="" height="40">
                    </span>
                </a>
                <a href="index.html" class="logo logo-dark text-center">
                    <span class="logo-sm">
                        <img src="{{ asset('/') }}/assets/images/logo-bpsdm.png" alt="" height="30">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('/') }}/assets/images/logo-bpsdm.png" alt="" height="40">
                    </span>
                </a>
            </div>

            <ul class="list-unstyled topnav-menu topnav-menu-left mb-0">
                <li>
                    <button class="button-menu-mobile disable-btn waves-effect">
                        <i class="fe-menu"></i>
                    </button>
                </li>

                <li>
                    <h4 class="page-title-main">@yield('pagetitle')</h4>
                </li>

            </ul>

            <div class="clearfix"></div>

        </div>
        <!-- end Topbar -->

        <!-- ========== Left Sidebar Start ========== -->
        <div class="left-side-menu">

            <div class="h-100" data-simplebar>

                <!-- User box -->
                <div class="user-box text-center">

                    <img src="{{ asset('/') }}/assets/images/users/user-1.jpg" alt="user-img" title="Mat Helme"
                        class="rounded-circle img-thumbnail avatar-md">
                    <div class="dropdown">
                        <a href="#" class="user-name dropdown-toggle h5 mt-2 mb-1 d-block"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            @if (Auth::user()->role->name == 'admin')
                                {{ Auth::user()->role->display_name }}
                            @elseif(Auth::user()->role->name == 'employee')
                                {{ Auth::user()->employee->penanggung_jawab }}
                            @elseif (Auth::user()->role->name == 'guest')
                                {{ Auth::user()->role->display_name }}
                            @endif
                        </a>
                        <p class="text-muted left-user-info">
                            @if (Auth::user()->role->name == 'admin')
                                {{ Auth::user()->role->display_name }} BPSDM
                            @elseif(Auth::user()->role->name == 'employee')
                                {{ Auth::user()->employee->penanggung_jawab }}
                            @elseif (Auth::user()->role->name == 'guest')
                                {{ Auth::user()->name }}
                            @endif
                        </p>
                    </div>
                </div>

                <!--- Sidemenu -->
                @include('layouts.sidebar.sidebar')
                <!-- End Sidebar -->

                <div class="clearfix"></div>

            </div>
            <!-- Sidebar -left -->

        </div>
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="content-page">
            <div class="content">
                <!-- Start Content-->
                <div class="container-fluid">
                    @yield('content')
                </div> <!-- container -->
            </div> <!-- content -->
            <!-- Footer Start -->
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <script>
                                document.write(new Date().getFullYear())
                            </script> &copy; Badan Pengembangan Sumber Daya Manusia Provinsi
                            Kalimantan
                            Barat</a>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- end Footer -->
        </div>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->


    </div>
    <!-- END wrapper -->

    <!-- Right Sidebar -->
    <div class="right-bar">

        <div data-simplebar class="h-100">

            <div class="rightbar-title">
                <a href="javascript:void(0);" class="right-bar-toggle float-end">
                    <i class="mdi mdi-close"></i>
                </a>
                <h4 class="font-16 m-0 text-white">Theme Customizer</h4>
            </div>

            <!-- Tab panes -->
            <div class="tab-content pt-0">

                <div class="tab-pane active" id="settings-tab" role="tabpanel">

                    <div class="p-3">
                        <div class="alert alert-warning" role="alert">
                            <strong>Customize </strong> the overall color scheme, Layout, etc.
                        </div>

                        <h6 class="fw-medium font-14 mt-4 mb-2 pb-1">Color Scheme</h6>
                        <div class="form-check form-switch mb-1">
                            <input type="checkbox" class="form-check-input" name="layout-color" value="light"
                                id="light-mode-check" checked />
                            <label class="form-check-label" for="light-mode-check">Light Mode</label>
                        </div>

                        <div class="form-check form-switch mb-1">
                            <input type="checkbox" class="form-check-input" name="layout-color" value="dark"
                                id="dark-mode-check" />
                            <label class="form-check-label" for="dark-mode-check">Dark Mode</label>
                        </div>

                        <!-- Width -->
                        <h6 class="fw-medium font-14 mt-4 mb-2 pb-1">Width</h6>
                        <div class="form-check form-switch mb-1">
                            <input type="checkbox" class="form-check-input" name="layout-size" value="fluid"
                                id="fluid" checked />
                            <label class="form-check-label" for="fluid-check">Fluid</label>
                        </div>
                        <div class="form-check form-switch mb-1">
                            <input type="checkbox" class="form-check-input" name="layout-size" value="boxed"
                                id="boxed" />
                            <label class="form-check-label" for="boxed-check">Boxed</label>
                        </div>

                        <!-- Menu positions -->
                        <h6 class="fw-medium font-14 mt-4 mb-2 pb-1">Menus (Leftsidebar and Topbar) Positon</h6>

                        <div class="form-check form-switch mb-1">
                            <input type="checkbox" class="form-check-input" name="leftbar-position" value="fixed"
                                id="fixed-check" checked />
                            <label class="form-check-label" for="fixed-check">Fixed</label>
                        </div>

                        <div class="form-check form-switch mb-1">
                            <input type="checkbox" class="form-check-input" name="leftbar-position"
                                value="scrollable" id="scrollable-check" />
                            <label class="form-check-label" for="scrollable-check">Scrollable</label>
                        </div>

                        <!-- Left Sidebar-->
                        <h6 class="fw-medium font-14 mt-4 mb-2 pb-1">Left Sidebar Color</h6>

                        <div class="form-check form-switch mb-1">
                            <input type="checkbox" class="form-check-input" name="leftbar-color" value="light"
                                id="light" />
                            <label class="form-check-label" for="light-check">Light</label>
                        </div>

                        <div class="form-check form-switch mb-1">
                            <input type="checkbox" class="form-check-input" name="leftbar-color" value="dark"
                                id="dark" checked />
                            <label class="form-check-label" for="dark-check">Dark</label>
                        </div>

                        <div class="form-check form-switch mb-1">
                            <input type="checkbox" class="form-check-input" name="leftbar-color" value="brand"
                                id="brand" />
                            <label class="form-check-label" for="brand-check">Brand</label>
                        </div>

                        <div class="form-check form-switch mb-3">
                            <input type="checkbox" class="form-check-input" name="leftbar-color" value="gradient"
                                id="gradient" />
                            <label class="form-check-label" for="gradient-check">Gradient</label>
                        </div>

                        <!-- size -->
                        <h6 class="fw-medium font-14 mt-4 mb-2 pb-1">Left Sidebar Size</h6>

                        <div class="form-check form-switch mb-1">
                            <input type="checkbox" class="form-check-input" name="leftbar-size" value="default"
                                id="default-size-check" checked />
                            <label class="form-check-label" for="default-size-check">Default</label>
                        </div>

                        <div class="form-check form-switch mb-1">
                            <input type="checkbox" class="form-check-input" name="leftbar-size" value="condensed"
                                id="condensed-check" />
                            <label class="form-check-label" for="condensed-check">Condensed <small>(Extra Small
                                    size)</small></label>
                        </div>

                        <div class="form-check form-switch mb-1">
                            <input type="checkbox" class="form-check-input" name="leftbar-size" value="compact"
                                id="compact-check" />
                            <label class="form-check-label" for="compact-check">Compact <small>(Small
                                    size)</small></label>
                        </div>

                        <!-- User info -->
                        <h6 class="fw-medium font-14 mt-4 mb-2 pb-1">Sidebar User Info</h6>

                        <div class="form-check form-switch mb-1">
                            <input type="checkbox" class="form-check-input" name="sidebar-user" value="true"
                                id="sidebaruser-check" />
                            <label class="form-check-label" for="sidebaruser-check">Enable</label>
                        </div>


                        <!-- Topbar -->
                        <h6 class="fw-medium font-14 mt-4 mb-2 pb-1">Topbar</h6>

                        <div class="form-check form-switch mb-1">
                            <input type="checkbox" class="form-check-input" name="topbar-color" value="dark"
                                id="darktopbar-check" checked />
                            <label class="form-check-label" for="darktopbar-check">Dark</label>
                        </div>

                        <div class="form-check form-switch mb-1">
                            <input type="checkbox" class="form-check-input" name="topbar-color" value="light"
                                id="lighttopbar-check" />
                            <label class="form-check-label" for="lighttopbar-check">Light</label>
                        </div>

                        <div class="d-grid mt-4">
                            <button class="btn btn-primary" id="resetBtn">Reset to Default</button>
                            <a href="https://1.envato.market/admintoadmin" class="btn btn-danger mt-3"
                                target="_blank"><i class="mdi mdi-basket me-1"></i> Purchase Now</a>
                        </div>

                    </div>

                </div>
            </div>

        </div> <!-- end slimscroll-menu-->
    </div>
    <!-- /Right-bar -->

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <!-- Vendor -->
    <script src="{{ asset('/') }}/assets/libs/jquery/jquery.min.js"></script>
    <script src="{{ asset('/') }}/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('/') }}/assets/libs/simplebar/simplebar.min.js"></script>
    <script src="{{ asset('/') }}/assets/libs/node-waves/waves.min.js"></script>
    <script src="{{ asset('/') }}/assets/libs/waypoints/lib/jquery.waypoints.min.js"></script>
    <script src="{{ asset('/') }}/assets/libs/jquery.counterup/jquery.counterup.min.js"></script>
    <script src="{{ asset('/') }}/assets/libs/feather-icons/feather.min.js"></script>

    <!-- Sweet Alerts js -->
    <script src="{{ asset('/') }}assets/libs/sweetalert2/sweetalert2.all.min.js"></script>

    <!-- Sweet alert init js-->
    <script src="{{ asset('/') }}assets/js/pages/sweet-alerts.init.js"></script>

    <!-- plugin js -->
    <script src="{{ asset('/') }}/assets/libs/moment/min/moment.min.js"></script>
    <script src="{{ asset('/') }}/assets/libs/fullcalendar/main.min.js"></script>
    <script src="{{ asset('/') }}assets/libs/flatpickr/flatpickr.min.js"></script>
    <script src="{{ asset('/') }}assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <script src="{{ asset('/') }}assets/libs/spectrum-colorpicker2/spectrum.min.js"></script>
    <script src="{{ asset('/') }}assets/libs/clockpicker/bootstrap-clockpicker.min.js"></script>

    <script src="{{ asset('/') }}assets/libs/selectize/js/standalone/selectize.min.js"></script>
    <script src="{{ asset('/') }}assets/libs/mohithg-switchery/switchery.min.js"></script>
    <script src="{{ asset('/') }}assets/libs/multiselect/js/jquery.multi-select.js"></script>
    <script src="{{ asset('/') }}assets/libs/select2/js/select2.min.js"></script>
    <script src="{{ asset('/') }}assets/libs/jquery-mockjax/jquery.mockjax.min.js"></script>
    <script src="{{ asset('/') }}assets/libs/devbridge-autocomplete/jquery.autocomplete.min.js"></script>
    <script src="{{ asset('/') }}assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
    <script src="{{ asset('/') }}assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>

    <!-- Init js-->
    <script src="{{ asset('/') }}assets/js/pages/form-advanced.init.js"></script>

    <!-- Calendar init -->
    <script src="{{ asset('/') }}/assets/js/pages/calendar.init.js"></script>

    <!-- third party js -->
    <script src="{{ asset('/') }}assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('/') }}assets/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
    <script src="{{ asset('/') }}assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('/') }}assets/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js"></script>
    <script src="{{ asset('/') }}assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{ asset('/') }}assets/libs/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js"></script>
    <script src="{{ asset('/') }}assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="{{ asset('/') }}assets/libs/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="{{ asset('/') }}assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="{{ asset('/') }}assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="{{ asset('/') }}assets/libs/datatables.net-select/js/dataTables.select.min.js"></script>
    <script src="{{ asset('/') }}assets/libs/pdfmake/build/pdfmake.min.js"></script>
    <script src="{{ asset('/') }}assets/libs/pdfmake/build/vfs_fonts.js"></script>
    <!-- third party js ends -->

    <!-- Datatables init -->
    <script src="{{ asset('/') }}assets/js/pages/datatables.init.js"></script>

    <!-- Init js-->
    <script src="{{ asset('/') }}assets/js/pages/form-pickers.init.js"></script>

    <!-- App js -->
    <script src="{{ asset('/') }}/assets/js/app.min.js"></script>

    <script>
        @if (Session::has('success'))
            Swal.fire({
                title: "",
                text: '{{ Session::get('success') }}',
                icon: "success"
            });
        @elseif (Session::has('error'))
            Swal.fire({
                title: "",
                text: '{{ Session::get('error') }}',
                icon: "error"
            });
        @elseif (Session::has('info'))
            Swal.fire({
                title: "",
                text: '{{ Session::get('info') }}',
                icon: "info"
            });
        @endif
    </script>

    @yield('scripts')
</body>

</html>
