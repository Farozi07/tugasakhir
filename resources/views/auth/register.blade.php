<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Register</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('/') }}assets/images/logo-bpsdm-sm.ico">

    <!-- App css -->

    <link href="{{ asset('/') }}assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-style" />

    <!-- icons -->
    <link href="{{ asset('/') }}assets/css/icons.min.css" rel="stylesheet" type="text/css" />

</head>

<body class="loading authentication-bg authentication-bg-pattern">

    <div class="account-pages mt-3 mb-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-8">
                    <div class="text-center mb-3">
                        <a href="/">
                            <img src="{{ asset('/') }}assets/images/logo-bpsdm.png" alt="" height="70"
                                class="mx-auto">
                        </a>
                    </div>
                    <div class="card">
                        <div class="card-body p-4">
                            <div class="text-center mb-4">
                                <h4 class="text-uppercase mt-0">Register</h4>
                            </div>
                            <form action="{{ route('register') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Nama Lengkap</label>
                                            <input class="form-control @error('name') is-invalid @enderror"
                                                type="text" id="name" placeholder="Masukkan Nama Lengkap"
                                                name="name" required>
                                            @error('name')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="emailaddress" class="form-label">Email</label>
                                            <input class="form-control @error('email') is-invalid @enderror"
                                                type="email" id="emailaddress" required placeholder="Masukkan Email"
                                                name="email">
                                            @error('email')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="password" class="form-label">Password</label>
                                            <input class="form-control" type="password" required
                                                autocomplete="new-password" id="password"
                                                placeholder="Masukkan Password" name="password">
                                            @error('password')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="ktp" class="form-label">No KTP</label>
                                            <input class="form-control @error('ktp') is-invalid @enderror"
                                                type="number" min="0" id="ktp" required
                                                placeholder="Masukkan Nomor KTP" name="no_ktp">
                                            @error('ktp')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="telp" class="form-label">Nomor Telepon</label>
                                            <input class="form-control @error('telp') is-invalid @enderror"
                                                type="number" min="0" required id="telp"
                                                placeholder="Masukan Nomor Telepon" name="telp">
                                            @error('telp')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="alamat" class="form-label">Alamat</label>
                                            <textarea name="alamat" id="alamat" cols="10" rows="5"
                                                class="form-control @error('alamat') is-invalid @enderror" placeholder="Masukkan Alamat"></textarea>
                                            @error('alamat')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 text-center d-grid">
                                    <button class="btn btn-primary" type="submit"> Sign Up </button>
                                </div>

                            </form>

                        </div> <!-- end card-body -->
                    </div>
                    <!-- end card -->
                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end page -->

    <!-- Vendor -->
    <script src="{{ asset('/') }}assets/libs/jquery/jquery.min.js"></script>
    <script src="{{ asset('/') }}assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('/') }}assets/libs/simplebar/simplebar.min.js"></script>
    <script src="{{ asset('/') }}assets/libs/node-waves/waves.min.js"></script>
    <script src="{{ asset('/') }}assets/libs/waypoints/lib/jquery.waypoints.min.js"></script>
    <script src="{{ asset('/') }}assets/libs/jquery.counterup/jquery.counterup.min.js"></script>
    <script src="{{ asset('/') }}assets/libs/feather-icons/feather.min.js"></script>

    <!-- App js -->
    <script src="{{ asset('/') }}assets/js/app.min.js"></script>

</body>

</html>
