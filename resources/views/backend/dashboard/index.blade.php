@extends('layout.backend')

@section('adminContent')
    <div class="container-xxl">
        <div class="row justify-content-center">
            @if(Auth::check() && Auth::user()->role_id == 1)
            <div class="col-md-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row d-flex justify-content-center border-dashed-bottom pb-3">
                            <div class="col-8">
                                <p class="text-dark mb-0 fw-semibold fs-14">Số tài khoản</p>
                                <h5 class="mt-2 mb-0 fw-bold">{{ number_format($data['countUser'] / 1000, 3, '.', '') }}
                                </h5>
                            </div>
                            <div class="col-4 d-flex justify-content-center align-items-center">
                                <div
                                    class="d-flex justify-content-center align-items-center thumb-xl bg-light rounded-circle mx-auto">
                                    <i class="fa-solid fa-user" style="color: green"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row d-flex justify-content-center border-dashed-bottom pb-3">
                            <div class="col-8">
                                <p class="text-dark mb-0 fw-semibold fs-14">Danh mục</p>
                                <h5 class="mt-2 mb-0 fw-bold">{{ number_format($data['countCategory'], 0, '.', '.') }}</h5>
                            </div>
                            <div class="col-4 d-flex justify-content-center align-items-center">
                                <div
                                    class="d-flex justify-content-center align-items-center thumb-xl bg-light rounded-circle mx-auto">
                                    <i class="fa-solid fa-list" style="color: rgb(32, 59, 182)"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row d-flex justify-content-center border-dashed-bottom pb-3">
                            <div class="col-8">
                                <p class="text-dark mb-0 fw-semibold fs-14">Món ăn</p>
                                <h5 class="mt-2 mb-0 fw-bold">{{ number_format($data['countFood'], 0, '.', '.') }}</h5>
                            </div>
                            <div class="col-4 d-flex justify-content-center align-items-center">
                                <div
                                    class="d-flex justify-content-center align-items-center thumb-xl bg-light rounded-circle mx-auto">
                                    <i class="fa-solid fa-bowl-food" style="color: coral"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row d-flex justify-content-center border-dashed-bottom pb-3">
                            <div class="col-8">
                                <p class="text-dark mb-0 fw-semibold fs-14">Bài viết</p>
                                <h5 class="mt-2 mb-0 fw-bold">{{ number_format($data['countBlog'], 0, '.', '.') }}</h5>
                            </div>
                            <div class="col-4 d-flex justify-content-center align-items-center">
                                <div
                                    class="d-flex justify-content-center align-items-center thumb-xl bg-light rounded-circle mx-auto">
                                    <i class="fa-solid fa-newspaper" style="color: rgb(29, 29, 29)"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row d-flex justify-content-center border-dashed-bottom pb-3">
                            <div class="col-8">
                                <p class="text-dark mb-0 fw-semibold fs-14">Bàn</p>
                                <h5 class="mt-2 mb-0 fw-bold">{{ number_format($data['countTable'], 0, '.', '.') }}</h5>
                            </div>
                            <div class="col-4 d-flex justify-content-center align-items-center">
                                <div
                                    class="d-flex justify-content-center align-items-center thumb-xl bg-light rounded-circle mx-auto">
                                    <i class="fa-solid fa-chair" style="color: rgb(193, 27, 27)"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row d-flex justify-content-center border-dashed-bottom pb-3">
                            <div class="col">
                                <p class="text-dark mb-0 fw-semibold fs-14">Doanh thu năm </p>
                                <h5 class="mt-2 mb-0 fw-bold">{{ number_format($data['totalYear'], 0, '.', '.') }} VNĐ</h5>
                            </div>
                            <div class="col-4 d-flex justify-content-center align-items-center">
                                <div
                                    class="d-flex justify-content-center align-items-center thumb-xl bg-light rounded-circle mx-auto">
                                    <i class="fa-regular fa-money-bill-1" style="color: green"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row d-flex justify-content-center border-dashed-bottom pb-3">
                            <div class="col">
                                <p class="text-dark mb-0 fw-semibold fs-14">Doanh thu tháng</p>
                                <h5 class="mt-2 mb-0 fw-bold">{{ number_format($data['totalMonth'], 0, '.', '.') }} VNĐ</h3>
                                          </div>
                                          <div class=" col-4 d-flex justify-content-center align-items-center">
                                    <div
                                        class="d-flex justify-content-center align-items-center thumb-xl bg-light rounded-circle mx-auto">
                                        <i class="fa-regular fa-money-bill-1" style="color: green"></i>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            <div class="
            @if(Auth::check() && Auth::user()->role_id == 1)
                col-md-6 col-lg-3
            @else 
                col-md-12 col-lg-12
            @endif">
                <div class="card">
                    <div class="card-body">
                        <div class="row d-flex justify-content-center border-dashed-bottom pb-3">
                            <div class="col">
                                <p class="text-dark mb-0 fw-semibold fs-14">Doanh thu hôm nay</p>
                                <h5 class="mt-2 mb-0 fw-bold">{{ number_format($data['totalToday'], 0, '.', '.') }} VNĐ</h5>
                            </div>
                            <div class="col-4 d-flex justify-content-center align-items-center">
                                <div
                                    class="d-flex justify-content-center align-items-center thumb-xl bg-light rounded-circle mx-auto">
                                    <i class="fa-regular fa-money-bill-1" style="color: green"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end row-->
        <!--end row-->
        {{-- start chart --}}
        <div class="row card">
            {{-- <div class="col-md-6 col-lg-8">
                <div class="card-header">
                    <form method="GET" class="row align-items-center">
                        <div class="col-5">
                            <select name="ca" id="yearSelect" class="form-select">
                                <option value="all">--Chọn ca---</option>
                                <option value="morning" @selected("morning" == request('ca'))>Buổi sáng</option>
                                <option value="afternoon" @selected("afternoon" == request('ca'))>Buổi trưa</option>
                                <option value="evening" @selected("evening" == request('ca'))>Buổi tối</option>
                            </select>
                        </div>
                        <button class="col-2 btn btn-primary">Tìm kiếm</button>
                    </form>
                </div>
            </div> --}}
            <div class="col-md-12">
                <div class="card-header">
                    <div class="card-title h4">Thống kê đơn hàng hôm nay</div>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="lineChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card-header">
                    <div class="card-title h4">Thống kê doanh thu hôm nay</div>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="barChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        
        <script src="{{ asset('backend/assets/libs/chart.js/chart.min.js') }}"></script>
        <script>
            const dataChart = @json($data['dataChart']);
        
            const lineChart = document.getElementById("lineChart").getContext("2d");
            const barChart = document.getElementById("barChart").getContext("2d");
        
            const myLineChart = new Chart(lineChart, {
                type: "line",
                data: {
                    labels: dataChart.map(item => item.period), // Sử dụng period thay vì date
                    datasets: [{
                        label: "Đơn hàng",
                        borderColor: "#1d7af3",
                        pointBorderColor: "#1d7af3",
                        pointBackgroundColor: "#FFF",
                        pointBorderWidth: 2,
                        pointHoverRadius: 4,
                        pointHoverBorderWidth: 1,
                        pointRadius: 4,
                        backgroundColor: "transparent",
                        fill: true,
                        borderWidth: 1,
                        data: dataChart.map(item => item.order),
                    }],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: "top",
                            labels: {
                                usePointStyle: true,
                                padding: 10,
                                color: "#1d7af3",
                            },
                        },
                        tooltip: {
                            bodySpacing: 4,
                            mode: "nearest",
                            intersect: false,
                            position: "nearest",
                            padding: 10,
                        },
                    },
                    layout: {
                        padding: {
                            left: 15,
                            right: 15,
                            top: 15,
                            bottom: 15,
                        },
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                        },
                    },
                },
            });
        
            const myBarChart = new Chart(barChart, {
                type: "bar",
                data: {
                    labels: dataChart.map(item => item.period),
                    datasets: [{
                        label: "Doanh thu",
                        backgroundColor: "rgb(23, 125, 255)",
                        borderColor: "rgb(23, 125, 255)",
                        data: dataChart.map(item => item.total),
                    }],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                        },
                    },
                },
            });
        </script>
@endsection
