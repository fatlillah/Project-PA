@extends('layouts.apps')
@section('header-content')
<div class="header-left">
    <div class="dashboard_bar">
        Dashboard
    </div>
</div>
@endsection
@section('content')
<div class="row">
    <div class="col-xl-3 col-xxl-3 col-lg-3 col-sm-3">
        <div class="widget-stat card">
            <div class="card-body p-4">
                <div class="media ai-icon">
                    <span class="me-3 bgl-primary text-primary">
                        <!-- <i class="ti-user"></i> -->
                        <i id="icon-customers" class="fab fa-product-hunt" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
                            <circle cx="12" cy="7" r="4"></circle>
                        </i>
                    </span>
                    <div class="media-body">
                        <p class="mb-1">Total Stok Produk</p>
                        <h4 class="mb-0">{{ $products }} pcs</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-xxl-3 col-lg-3 col-sm-3">
        <div class="widget-stat card">
            <div class="card-body p-4">
                <div class="media ai-icon">
                    <span class="me-3 bgl-warning text-warning">
                        <svg id="icon-orders" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                            <polyline points="14 2 14 8 20 8"></polyline>
                            <line x1="16" y1="13" x2="8" y2="13"></line>
                            <line x1="16" y1="17" x2="8" y2="17"></line>
                            <polyline points="10 9 9 9 8 9"></polyline>
                        </svg>
                    </span>
                    <div class="media-body">
                        <p class="mb-1">Total Pesanan</p>
                        <h4 class="mb-0">{{ $orders }} orders</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-xxl-3 col-lg-3 col-sm-3">
        <div class="widget-stat card">
            <div class="card-body p-4">
                <div class="media ai-icon">
                    <span class="me-3 bgl-success text-success">
                        <svg id="icon-database-widget" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-database">
                            <ellipse cx="12" cy="5" rx="9" ry="3"></ellipse>
                            <path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3"></path>
                            <path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"></path>
                        </svg>
                    </span>
                    <div class="media-body">
                        <p class="mb-1">Pendapatan Hari Ini</p>
                        <h4 class="mb-0">{{ formatNumber($todayIncome) }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-xxl-3 col-lg-3 col-sm-3">
        <div class="widget-stat card">
            <div class="card-body  p-4">
                <div class="media ai-icon">
                    <span class="me-3 bgl-danger text-danger">
                        <svg id="icon-revenue" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-dollar-sign">
                            <line x1="12" y1="1" x2="12" y2="23"></line>
                            <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                        </svg>
                    </span>
                    <div class="media-body">
                        <p class="mb-1">Total Pendapatan</p>
                        <h4 class="mb-0">{{ formatNumber($totalIncome) }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-12">
    <div id="user-activity" class="card">
        <div class="card-header border-0 pb-0 d-sm-flex d-block">
            <h4 class="card-title">Grafik Pendapatan {{ indonesian_date($startDate, false) }} s/d {{ indonesian_date($lastDate, false) }}</h4>
            <div class="card-action mb-sm-0 my-2">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                    </li>
                </ul>
            </div>
        </div>

        <div class="card-body">
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade active show" id="user" role="tabpanel">
                    <canvas id="activity" height="156" width="651"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('activity').getContext('2d');
    const chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($dateData),
            datasets: [{
                label: 'Pendapatan Harian',
                data: @json($incomeData),
                borderColor: 'rgba(75, 192, 192, 1)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                fill: true,
            }]
        },
        options: {
            responsive: true,
            scales: {
                x: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Hari'
                    }
                },
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Pendapatan (dalam satuan mata uang)'
                    }
                }
            },
            plugins: {
                legend: {
                    display: true,
                    labels: {
                        color: 'rgb(75, 192, 192)',
                        usePointStyle: true
                    }
                }
            }
        }
    });
</script>
@endpush