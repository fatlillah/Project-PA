@extends('layouts.apps')
@section('header-content')
<div class="header-left">
    <div class="dashboard_bar">
        Dashboard
    </div>
</div>
@endsection
@push('css')
<style>
    #productSalesChart {
        max-width: 200px;
        max-height: 200px;
        margin: 0 auto;
    }
    .widget-stat .card-body {
        overflow: hidden;
    }
    .widget-stat .media-body {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>
@endpush
@section('content')
<div class="row">
    <div class="col-xl-4 col-xxl-4 col-lg-4 col-sm-12">
        <div class="card">
            <div class="card-header border-0">
                <div>
                    <h4 class="fs-20 font-w700">Produk Terlaris</h4>
                    <span class="fs-14 font-w400 d-block">Data penjualan untuk 3 produk teratas</span>
                </div>  
            </div>  
            <div class="card-body">
                <canvas id="productSalesChart"></canvas>
                <div class="mb-3 mt-4">
                    <h4 class="fs-18 font-w600">Nama Produk</h4>
                </div>
                <div id="chart-legend">
                    <!-- Legend will be populated here -->
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-8 col-xxl-8 col-lg-8 col-sm-12">
        <div class="row"> 
            <div class="col-xl-6 col-xxl-6 col-lg-6 col-sm-6 mb-3">
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
            <div class="col-xl-6 col-xxl-6 col-lg-6 col-sm-6 mb-3">
                <div class="widget-stat card">
                    <div class="card-body p-4">
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
        <div class="row">
            <div class="col-12">
                <div class="widget-stat card">
                    <div class="card-body p-4">
                        <div class="media ai-icon">
                            <span class="me-3 bgl-info text-info">
                                <svg id="icon-orders" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-list">
                                    <line x1="8" y1="6" x2="21" y2="6"></line>
                                    <line x1="8" y1="12" x2="21" y2="12"></line>
                                    <line x1="8" y1="18" x2="21" y2="18"></line>
                                    <line x1="3" y1="6" x2="3" y2="6"></line>
                                    <line x1="3" y1="12" x2="3" y2="12"></line>
                                    <line x1="3" y1="18" x2="3" y2="18"></line>
                                </svg>
                            </span>
                            <div class="media-body">
                                <p class="mb-1">Daftar Pesanan</p>
                            </div>
                        </div>
                        <div class="table-responsive mt-3">
                            <div id="table-data">
                                @include('layouts.pagination.table-order')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>   
    <div class="col-12">
        <div id="user-activity" class="card">
            <div class="card-header border-0 pb-0 d-sm-flex d-block">
                <h4 class="card-title">Grafik Pendapatan</h4>
                <div class="card-action mb-sm-0 my-2">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#user" role="tab">
                                Hari
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#bounce" role="tab">
                                Bulan
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#session-duration" role="tab">
                                Tahun
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
    
            <div class="card-body">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade active show" id="user" role="tabpanel">
                        <canvas id="activityDaily" height="156" width="651"></canvas>
                    </div>
                    <div class="tab-pane fade" id="bounce" role="tabpanel">
                        <canvas id="activityMonthly" height="156" width="651"></canvas>
                    </div>
                    <div class="tab-pane fade" id="session-duration" role="tabpanel">
                        <canvas id="activityYearly" height="156" width="651"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
{{-- script untuk grafik pendapatan --}}
<script>
    // Daily income chart
    const ctxDaily = document.getElementById('activityDaily').getContext('2d');
    const chartDaily = new Chart(ctxDaily, {
        type: 'line',
        data: {
            labels: @json($dateData['daily']),
            datasets: [{
                label: 'Pendapatan Harian',
                data: @json($incomeDataDaily),
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

    // Monthly income chart
    const ctxMonthly = document.getElementById('activityMonthly').getContext('2d');
    const chartMonthly = new Chart(ctxMonthly, {
        type: 'line',
        data: {
            labels: @json($dateData['monthly']),
            datasets: [{
                label: 'Pendapatan Bulanan',
                data: @json($incomeDataMonthly),
                borderColor: 'rgba(54, 162, 235, 1)',
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
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
                        text: 'Bulan'
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
                        color: 'rgb(54, 162, 235)',
                        usePointStyle: true
                    }
                }
            }
        }
    });

    // Yearly income chart
    const ctxYearly = document.getElementById('activityYearly').getContext('2d');
    const chartYearly = new Chart(ctxYearly, {
        type: 'line',
        data: {
            labels: @json($dateData['yearly']),
            datasets: [{
                label: 'Pendapatan Tahunan',
                data: @json($incomeDataYearly),
                borderColor: 'rgba(255, 99, 132, 1)',
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
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
                        text: 'Tahun'
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
                        color: 'rgb(255, 99, 132)',
                        usePointStyle: true
                    }
                }
            }
        }
    });
</script>
{{-- script untuk grafik produk terlaris --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var ctx = document.getElementById('productSalesChart').getContext('2d');
        var productSalesData = @json($productSales);

        var labels = productSalesData.map(function (item) {
            return item.product.name;
        });

        var data = productSalesData.map(function (item) {
            return item.total_sold;
        });

        var backgroundColors = [
            '#886CC0', '#26E023', '#61CFF1', '#FFDA7C', '#FF86B1',
            '#C0C0C0', '#FFA07A', '#E9967A', '#B0E0E6', '#D8BFD8'
        ];

        var chart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: labels,
                datasets: [{
                    data: data,
                    backgroundColor: backgroundColors
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });

        // Generate custom legend
        var legendHtml = '';
        chart.data.labels.forEach(function(label, index) {
            var percentage = ((chart.data.datasets[0].data[index] / data.reduce((a, b) => a + b, 0)) * 100).toFixed(0);
            legendHtml += `
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <span class="fs-18 font-w500">
                        <svg class="me-3" width="20" height="20" viewbox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect width="20" height="20" rx="6" fill="${backgroundColors[index]}"></rect>
                        </svg>
                        ${label} (${percentage}%)
                    </span>
                    <span class="fs-18 font-w600">${chart.data.datasets[0].data[index]} pcs </span>
                </div>
            `;
        });

        document.getElementById('chart-legend').innerHTML = legendHtml;
    });
</script>
{{-- script untuk pagination --}}
<script>
    $(document).ready(function() {
        $(document).on('click', '.pagination a', function(event) {
            event.preventDefault();
            let page = $(this).attr('href').split('page=')[1];
            fetch_data(page);
        });
    
        function fetch_data(page) {
            $.ajax({
                url: "/dashboard?page=" + page,
                success: function(data) {
                    $('#table-data').html(data);
                }
            });
        }
    });
</script>
@endpush