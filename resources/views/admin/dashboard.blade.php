<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    <!-- App favicon -->
    <link href="{{ asset('/') }}/assets/images/logo-bpsdm.png">

    <!-- App css -->

    <link href="{{ asset('/') }}/assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-style" />

    <!-- icons -->
    <link href="{{ asset('/') }}/assets/css/icons.min.css" rel="stylesheet" type="text/css" />

    <!-- Sweet Alert-->
    <link href="{{ asset('/') }}assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />

    <!-- Plugin css -->
    <link href="{{ asset('/') }}/assets/libs/fullcalendar/main.min.css" rel="stylesheet" type="text/css" />

    <!-- third party css -->
    <link href="{{ asset('/') }}assets/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css"
        rel="stylesheet" type="text/css" />
    <link href="{{ asset('/') }}assets/libs/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css"
        rel="stylesheet" type="text/css" />
    <link href="{{ asset('/') }}assets/libs/datatables.net-select-bs5/css//select.bootstrap5.min.css"
        rel="stylesheet" type="text/css" />
    <!-- third party css end -->

<body class="loading" data-layout-color="light" data-layout-mode="default" data-layout-size="fluid"
    data-topbar-color="dark" data-leftbar-position="fixed" data-leftbar-color="light" data-leftbar-size='default'
    data-sidebar-user='true'>


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
            <ul class="list-unstyled topnav-menu float-end mb-0 me-2">
                <li class="dropdown notification-list" style="margin-top: 15px;">
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#yearModal">
                        Buat Arsip Sekarang
                    </button>
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
                    <h4 class="page-title-main">Dashboard</h4>
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

                    {{-- <p class="text-muted left-user-info">BPSDM</p> --}}
                </div>

                <!--- Sidemenu -->
                @include('layouts.sidebar.sidebar')
                <!-- End Sidebar -->

                <div class="clearfix"></div>

            </div>
            <!-- Sidebar -left -->

        </div>
        <!-- Left Sidebar End -->
        <div class="content-page">
            <div class="content">
                <!-- Start Content-->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xl-3 col-md-6">
                            <div class="card">
                                <div class="card-body widget-user">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0 avatar-lg me-3">
                                            <i class="fe-check-circle " style="font-size: 5rem;"></i>
                                        </div>
                                        <div class="flex-grow-1 overflow-hidden">
                                            <h5 class="mt-0 mb-1">Booking Yang Sudah Dibayar</h5>
                                            <p class="ms-2 mt-1 fs-1 text-success">
                                                {{ $bookingsTrueCount }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div><!-- end col -->

                        <div class="col-xl-3 col-md-6">
                            <div class="card">
                                <div class="card-body widget-user">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0 avatar-lg me-3">
                                            <i class="fe-loader" style="font-size: 5rem;"></i>
                                        </div>
                                        <div class="flex-grow-1 overflow-hidden">
                                            <h5 class="mt-0 mb-1"> Booking Yang Belum Dibayar</h5>
                                            <p class="ms-2 mt-1 fs-1 text-danger">
                                                {{ $bookingsFalseCount }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div><!-- end col -->

                        <div class="col-xl-3 col-md-6">
                            <div class="card">
                                <div class="card-body widget-user">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0 avatar-lg me-3">
                                            <i class="fe-alert-circle" style="font-size: 5rem;"></i>
                                        </div>
                                        <div class="flex-grow-1 overflow-hidden">
                                            <h5 class="mt-0 mb-1">Permintaan Batal Pemesan</h5>
                                            <p class="ms-2 mt-1 fs-1 text-warning">
                                                {{ $bookingsCancel }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div><!-- end col -->

                        <div class="col-xl-3 col-md-6">
                            <div class="card">
                                <div class="card-body widget-user">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0 avatar-lg me-3">
                                            <i class="fe-user" style="font-size: 5rem;"></i>
                                        </div>
                                        <div class="flex-grow-1 overflow-hidden">
                                            <h5 class="mt-0 mb-1">Akun Yang Terdaftar</h5>
                                            <p class="ms-2 mt-1 fs-1 text-primary">
                                                {{ $totalUsers }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div><!-- end col -->

                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="col-md-11 col-xl-11 mx-auto" id='calendar'></div>
                        </div>
                    </div>
                    @yield('content')
                    <!-- Modal -->
                    <div class="modal fade" id="yearModal" tabindex="-1" aria-labelledby="yearModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="yearModalLabel">Pilih Tahun</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('admin.booking.export') }}" method="GET">
                                        <div class="form-group">
                                            <label for="year">Tahun</label>
                                            <select name="year" id="year" class="form-control">
                                                @for ($i = date('Y'); $i >= 2000; $i--)
                                                    <option value="{{ $i }}">{{ $i }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-success mt-3">Download Arsip</button>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Tutup</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- container -->
            </div> <!-- content -->

            <!-- Footer Start -->
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <script>
                                document.write(new Date().getFullYear())
                            </script> &copy; Adminto theme by <a href="">Coderthemes</a>
                        </div>
                        <div class="col-md-6">
                            <div class="text-md-end footer-links d-none d-sm-block">
                                <a href="javascript:void(0);">About Us</a>
                                <a href="javascript:void(0);">Help</a>
                                <a href="javascript:void(0);">Contact Us</a>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- end Footer -->

            <!-- Standard modal content -->
            <div id="standard-modal" class="modal fade" tabindex="-1" role="dialog"
                aria-labelledby="standard-modalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="standard-modalLabel">Detail Booking</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p><strong>Title:</strong> <span id="modalTitle"></span></p>
                            <p><strong>Mulai:</strong> <span id="modalStart"></span></p>
                            <p><strong>Berakhir:</strong> <span id="modalEnd"></span></p>
                            <p><strong>Keperluan:</strong> <span id="modalKeperluan"></span></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->


        </div>

    </div>
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

    <footer class="mt-4 text-center bg-light py-3">
        <div class="container">
            &copy; {{ date('Y') }} BPSDM Provinsi Kalimantan Barat. All rights reserved.
        </div>
    </footer>

    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>

    <script>
        function formatDate(date) {
            var d = new Date(date);
            var day = ('0' + d.getDate()).slice(-2);
            var month = ('0' + (d.getMonth() + 1)).slice(-2);
            var year = d.getFullYear();
            return `${day}-${month}-${year}`;
        }

        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                themeSystem: "bootstrap",
                bootstrapFontAwesome: !1,
                buttonText: {
                    today: "Today",
                    month: "Month",
                    prev: "Prev",
                    next: "Next",
                },
                headerToolbar: {
                    left: "prev,next today",
                    center: "title",
                    right: "",
                },
                initialView: 'dayGridMonth',
                events: @json($events),
                displayEventTime: false,
                selectable: true,
                editable: true, // Enable editing events
                eventClick: function(info) {
                    // Ambil data event
                    var eventObj = info.event;
                    // Format tanggal
                    var formattedStart = formatDate(eventObj.start);
                    var formattedEnd = formatDate(eventObj.end);

                    // Isi modal dengan data event
                    document.getElementById('modalTitle').textContent = eventObj.title;
                    document.getElementById('modalStart').textContent = formattedStart;
                    document.getElementById('modalEnd').textContent = formattedEnd;
                    document.getElementById('modalKeperluan').textContent = eventObj.extendedProps
                        .keperluan;

                    // Tampilkan modal
                    $('#standard-modal').modal('show');
                }
            });
            calendar.render();
        });
    </script>

    <!-- Optional JavaScript -->

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
</body>

</html>
