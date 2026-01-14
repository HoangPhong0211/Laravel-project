@extends('admin.layout')

@section('content')
<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tổng quan cửa hàng</h1>
    </div>

    <div class="row">

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Doanh thu thực tế</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($totalRevenue) }} đ</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Tổng đơn hàng</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalOrders }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-shopping-bag fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Chờ xử lý</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pendingOrders }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clock fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Sản phẩm</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalProducts }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-tshirt fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Biểu đồ doanh thu năm nay</h6>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="myAreaChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Tỷ lệ đơn hàng</h6>
                </div>
            <div class="card-body">
                <div class="chart-pie pt-4 pb-2">
                    <canvas id="myPieChart"></canvas>
                </div>

                <div class="mt-4 text-center small">
                    <span class="mr-2">
                        <i class="fas fa-circle text-warning"></i> Chờ duyệt
                    </span>
                    <span class="mr-2">
                        <i class="fas fa-circle text-primary"></i> Đang giao
                    </span>
                    <span class="mr-2">
                        <i class="fas fa-circle text-success"></i> Hoàn thành
                    </span>
                    <span class="mr-2">
                        <i class="fas fa-circle text-danger"></i> Hủy
                    </span>
                </div>
            </div>
        </div>
    </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // 1. Biểu đồ Doanh thu (Area Chart)
    // 1. Biểu đồ Doanh thu (Area Chart) - Đã việt hóa
    var ctx = document.getElementById("myAreaChart");
    var myLineChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ["Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7", "Tháng 8", "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12"],
            datasets: [{
                label: "Doanh thu",
                lineTension: 0.3,
                backgroundColor: "rgba(78, 115, 223, 0.05)",
                borderColor: "rgba(78, 115, 223, 1)",
                pointRadius: 3,
                pointBackgroundColor: "rgba(78, 115, 223, 1)",
                pointBorderColor: "rgba(78, 115, 223, 1)",
                pointHoverRadius: 3,
                pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                pointHitRadius: 10,
                pointBorderWidth: 2,
                data: @json($chartData), 
            }],
        },
        options: {
            maintainAspectRatio: false,
            layout: { padding: { left: 10, right: 25, top: 25, bottom: 0 } },
            scales: {
                xAxes: [{ gridLines: { display: false, drawBorder: false }, ticks: { maxTicksLimit: 7 } }],
                yAxes: [{ 
                    ticks: { 
                        maxTicksLimit: 5, 
                        padding: 10, 
                        // SỬA: Thêm chữ 'đ' và format số kiểu Việt Nam
                        callback: function(value) { 
                            return new Intl.NumberFormat('vi-VN').format(value) + ' đ'; 
                        } 
                    }, 
                    gridLines: { color: "rgb(234, 236, 244)", zeroLineColor: "rgb(234, 236, 244)", drawBorder: false, borderDash: [2], zeroLineBorderDash: [2] } 
                }],
            },
            legend: { display: false },
            tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                titleMarginBottom: 10,
                titleFontColor: '#6e707e',
                titleFontSize: 14,
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                intersect: false,
                mode: 'index',
                caretPadding: 10,
                callbacks: {
                    // SỬA: Hiển thị tooltip có chữ 'đ'
                    label: function(tooltipItem, chart) {
                        var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                        return datasetLabel + ': ' + new Intl.NumberFormat('vi-VN').format(tooltipItem.yLabel) + ' đ';
                    }
                }
            }
        }
    });

    // 2. Biểu đồ Tròn (Pie Chart)
    var ctxPie = document.getElementById("myPieChart");
    var myPieChart = new Chart(ctxPie, {
        type: 'doughnut',
        data: {
            labels: ["Chờ duyệt", "Đang giao", "Hoàn thành", "Hủy"],
            datasets: [{
                data: @json($pieData), 
                backgroundColor: ['#f6c23e', '#4e73df', '#1cc88a', '#e74a3b'],
                hoverBackgroundColor: ['#dda20a', '#2e59d9', '#17a673', '#be2617'],
                hoverBorderColor: "rgba(234, 236, 244, 1)",
            }],
        },
        options: {
            maintainAspectRatio: false,
            tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                caretPadding: 10,
            },
            legend: {
                display: false // QUAN TRỌNG: Phải để false để không hiện chú thích mặc định đè lên
            },
            cutoutPercentage: 80,
        },
    });
</script>
@endsection