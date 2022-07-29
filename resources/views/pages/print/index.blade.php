<!--

=========================================================
* Volt Free - Bootstrap 5 Dashboard
=========================================================

* Product Page: https://themesberg.com/product/admin-dashboard/volt-bootstrap-5-dashboard
* Copyright 2021 Themesberg (https://www.themesberg.com)
* License (https://themesberg.com/licensing)

* Designed and coded by https://themesberg.com

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software. Please contact us to request a removal.

-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- Primary Meta Tags -->
    <title>Print Transaction | Smart Parking</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="title" content="Volt - Free Bootstrap 5 Dashboard">
    <meta name="author" content="Themesberg">
    <meta name="description"
        content="Volt Pro is a Premium Bootstrap 5 Admin Dashboard featuring over 800 components, 10+ plugins and 20 example pages using Vanilla JS.">
    <meta name="keywords"
        content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, themesberg, themesberg dashboard, themesberg admin dashboard" />
    <link rel="canonical" href="https://themesberg.com/product/admin-dashboard/volt-premium-bootstrap-5-dashboard">

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="120x120" href="{{asset('assets/img/favicon/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('assets/img/favicon/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/img/favicon/favicon-16x16.png')}}">
    <link rel="manifest" href="{{asset('assets/img/favicon/site.webmanifest')}}">
    <link rel="mask-icon" href="{{asset('assets/img/favicon/safari-pinned-tab.svg')}}" color="#ffffff">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
    <div class="row">
        <div class="col-12 col-lg-6">
            <div class="card border-0 shadow">
                <div class="card-header d-flex justify-content-between align-items-center">
                    Detail Transaksi
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <th>Check In</th>
                                <td>{{Carbon\Carbon::parse($parkingDetail->check_in)->format('d F Y H:i:s A')}}</td>
                            </tr>
                            <tr>
                                <th>Check Out</th>
                                <td>{{Carbon\Carbon::parse($parkingDetail->check_out)->format('d F Y H:i:s A')}}</td>
                            </tr>
                            <tr>
                                <th>Location</th>
                                <td>{{$parkingDetail->parking_detail->first()->parking_location->name}}</td>
                            </tr>
                            <tr>
                                <th>Type Vehicle</th>
                                <td>{{$parkingDetail->parking_detail->first()->vehicle->name}}</td>
                            </tr>
                            <tr>
                                <th>Cost</th>
                                <td>Rp. {{number_format($cost, 0, ",", ".")}}</td>
                            </tr>
                            <tr>
                                <th>Transaction Time</th>
                                <td>{{Carbon\Carbon::parse($transactionTime)->format('d F Y H:i:s A')}}</td>
                            </tr>
                            <tr>
                                <th>Transaction Status</th>
                                <td>{{$transactionStatus}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
