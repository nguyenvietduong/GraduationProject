@extends('layout.backend')

@section('adminContent')
    <div class="container-xxl">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row d-flex justify-content-center border-dashed-bottom pb-3">
                            <div class="col-9">
                                <p class="text-dark mb-0 fw-semibold fs-14">Số người đang sử dụng</p>
                                <h5 class="mt-2 mb-0 fw-bold">{{ number_format($data['countUser'] / 1000, 3, '.', '') }}
                                </h5>
                            </div>
                            <div class="col-3 align-self-center">
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
                            <div class="col-9">
                                <p class="text-dark mb-0 fw-semibold fs-14">Món ăn</p>
                                <h5 class="mt-2 mb-0 fw-bold">{{ number_format($data['countFood'], 0, '.', '.') }}</h5>
                            </div>
                            <div class="col-3 align-self-center">
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
                            <div class="col">
                                <p class="text-dark mb-0 fw-semibold fs-14">Doanh thu tháng</p>
                                <h5 class="mt-2 mb-0 fw-bold" ">{{ number_format($data['totalMonth'], 0, '.', '.') }} VNĐ</h3>
                              </div>
                              <div class="col-3 align-self-center">
                                <div class="d-flex justify-content-center align-items-center thumb-xl bg-light rounded-circle mx-auto">
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
                                    <p class="text-dark mb-0 fw-semibold fs-14">Doanh thu Năm </p>
                                    <h5 class="mt-2 mb-0 fw-bold">{{ number_format($data['totalYear'], 0, '.', '.') }} VNĐ</h5>
                              </div>
                              <div class="col-3 align-self-center">
                                <div class="d-flex justify-content-center align-items-center thumb-xl bg-light rounded-circle mx-auto">
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
                                <div class="col-9">
                                    <p class="text-dark mb-0 fw-semibold fs-14">Số người đang sử dụng</p>
                                    <h5 class="mt-2 mb-0 fw-bold">{{ number_format($data['countUser'] / 1000, 3, '.', '') }}</h5>
                                </div>
                                <div class="col-3 align-self-center">
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
                                <div class="col-9">
                                    <p class="text-dark mb-0 fw-semibold fs-14">Món ăn</p>
                                    <h5 class="mt-2 mb-0 fw-bold">{{ number_format($data['countFood'], 0, '.', '.') }}</h5>
                                </div>
                                <div class="col-3 align-self-center">
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
                                <div class="col">
                                    <p class="text-dark mb-0 fw-semibold fs-14">Doanh thu tháng</p>
                                    <h5 class="mt-2 mb-0 fw-bold" ">{{ number_format($data['totalMonth'], 0, '.', '.') }}
                                    VNĐ</h3>
                            </div>
                            <div class="col-3 align-self-center">
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
                                <p class="text-dark mb-0 fw-semibold fs-14">Doanh thu Năm </p>
                                <h5 class="mt-2 mb-0 fw-bold">{{ number_format($data['totalYear'], 0, '.', '.') }} VNĐ</h5>
                            </div>
                            <div class="col-3 align-self-center">
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
        <?php
        $months = [
            '1' => 'Tháng 1',
            '2' => 'Tháng 2',
            '3' => 'Tháng 3',
            '4' => 'Tháng 4',
            '5' => 'Tháng 5',
            '6' => 'Tháng 6',
            '7' => 'Tháng 7',
            '8' => 'Tháng 8',
            '9' => 'Tháng 9',
            '10' => 'Tháng 10',
            '11' => 'Tháng 11',
            '12' => 'Tháng 12',
        ];
        $years = [2020, 2021, 2022, 2023, 2024];
        ?>
        {{-- start filter --}}
        <div class="row justify-content-center">

            <div class="col-md-6 col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col">
                                <p class="text-dark mb-0 fw-semibold fs-14">Doanh thu hôm nay</p>
                                <h4 class="mt-2 mb-0 fw-bold" style="color: green">
                                    {{ number_format($data['totalToday'], 0, '.', '.') }} VNĐ</h4>
                            </div>
                            <div class="col-3 align-self-center">
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
        {{-- end filter --}}
        <!--end row-->
        {{-- start chart --}}
        <div class="row card">
            <div class="col-md-6 col-lg-8">
                <div class="card-header">
                    <form method="GET" class="row align-items-center">
                        <div class="col-5">
                            <select name="month" id="monthSelect" class="form-select">
                                <option value="">---chọn tháng---</option>
                                @foreach ($months as $key => $value)
                                    <option value="{{ $key }}" @selected($key == request('month'))>{{ $value }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-5">
                            <select name="year" id="yearSelect" class="form-select">
                                <option value="">--chọn năm ---</option>
                                @foreach ($years as $year)
                                    <option value="{{ $year }}" @selected($year == request('year'))>{{ $year }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <button class="col-2 btn btn-primary">Tìm kiếm</button>
                    </form>

                </div>
            </div>
            <div class="col-md-12">
                <div class="card-header">
                    <div class="card-title">Đơn hàng</div>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="lineChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card-header">
                    <div class="card-title">Doanh thu</div>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="barChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        {{-- end chart --}}

    </div>
    <script src="{{ asset('backend/assets/libs/chart.js/chart.min.js') }}"></script>
    <script>
        const dataChart = @json($data['dataChart']);
        var lineChart = document.getElementById("lineChart").getContext("2d"),
            barChart = document.getElementById("barChart").getContext("2d")
        var myLineChart = new Chart(lineChart, {
            type: "line",
            data: {
                labels: [
                    ...dataChart.map(item => {
                        return item.date
                    })
                ],
                datasets: [{
                    label: "Đơn hàng",
                    borderColor: "#1d7af3",
                    pointBorderColor: "#FFF",
                    pointBackgroundColor: "#1d7af3",
                    pointBorderWidth: 2,
                    pointHoverRadius: 4,
                    pointHoverBorderWidth: 1,
                    pointRadius: 4,
                    backgroundColor: "transparent",
                    fill: true,
                    borderWidth: 2,
                    data: [
                        ...dataChart.map(item => {
                            return item.order
                        })
                    ],
                }, ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    position: "top",
                    labels: {
                        padding: 10,
                        fontColor: "#1d7af3",
                    },
                },
                tooltips: {
                    bodySpacing: 4,
                    mode: "nearest",
                    intersect: 0,
                    position: "nearest",
                    xPadding: 10,
                    yPadding: 10,
                    caretPadding: 10,
                },
                layout: {
                    padding: {
                        left: 15,
                        right: 15,
                        top: 15,
                        bottom: 15
                    },
                },
            },
        });
        var myBarChart = new Chart(barChart, {
            type: "bar",
            data: {
                labels: [
                    ...dataChart.map(item => {
                        return item.date
                    })
                ],
                datasets: [{
                    label: "Doanh thu",
                    backgroundColor: "rgb(23, 125, 255)",
                    borderColor: "rgb(23, 125, 255)",
                    data: [...dataChart.map(item => {
                        return item.total
                    })],
                }, ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                        },
                    }, ],
                },
            },
        });
    </script>
@endsection
