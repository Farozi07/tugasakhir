@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="panel-body">
                        <div class="clearfix">
                            <div class="float-start">
                                <h3>Adminto</h3>
                            </div>
                            <div class="float-end">
                                <h4>Invoice # <br>
                                    <strong>2016-04-23654789</strong>
                                </h4>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="float-start mt-3">
                                    <address>
                                        <strong>Twitter, Inc.</strong><br>
                                        795 Folsom Ave, Suite 600<br>
                                        San Francisco, CA 94107<br>
                                        <abbr title="Phone">P:</abbr> (123) 456-7890
                                    </address>
                                </div>
                                <div class="float-end mt-3">
                                    <p><strong>Order Date: </strong>
                                        {{ \Carbon\Carbon::parse($bookings->created_at)->format('F d, Y') }}</p>
                                    <p class="m-t-10"><strong>Order Status: </strong> <span
                                            class="label label-pink">{{ ucfirst($bookings->transaction->status) }}</span>
                                    </p>
                                    <p class="m-t-10"><strong>Order ID: </strong> #{{ $bookings->id }}</p>
                                </div>
                            </div><!-- end col -->
                        </div>
                        <!-- end row -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table mt-4">
                                        <thead>
                                            <tr>
                                                <th>Nama Aula</th>
                                                <th>Lama Peminjaman</th>
                                                <th>Start</th>
                                                <th>End</th>
                                                <th>Keperluan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{ $bookings->aula->nama }}</td>
                                                <td>{{ $days }} Hari</td>
                                                <td>{{ Carbon\Carbon::parse($bookings->start)->format('d/m/Y') }}</td>
                                                <td>{{ Carbon\Carbon::parse($bookings->end)->format('d/m/Y') }}</td>
                                                <td>{{ $bookings->keperluan }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6 col-6">
                                <div class="clearfix mt-4">
                                    <h5 class="small text-dark fw-normal">PAYMENT TERMS AND POLICIES</h5>

                                    <small>
                                        All accounts are to be paid within 7 days from receipt of
                                        invoice. To be paid by cheque or credit card or direct payment
                                        online. If account is not paid within 7 days the credits details
                                        supplied as confirmation of work undertaken will be charged the
                                        agreed quoted fee noted above.
                                    </small>
                                </div>
                            </div>
                            <div class="col-xl-3 col-6 offset-xl-3">
                                <p class="text-end"><b>Sub-total:</b> 2930.00</p>
                                {{-- <p class="text-end">Discout: 12.9%</p>
                                <p class="text-end">VAT: 12.9%</p> --}}
                                <hr>

                                <h3 class="text-end">Rp{{ number_format($bookings->transaction->price, 0, ',', '.') }}</h3>
                            </div>
                        </div>
                        <hr>
                        <div class="d-print-none">
                            <div class="float-end">
                                <a href="javascript:window.print()" class="btn btn-dark waves-effect waves-light"><i
                                        class="fa fa-print"></i></a>

                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
