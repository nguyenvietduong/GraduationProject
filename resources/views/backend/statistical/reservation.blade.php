@extends('layout.backend')

@section('adminContent')
    <div class="container-xxl">
        <!--end row-->
        {{-- start chart --}}
        <div class="row card">
            <div class="col-md-6 col-lg-8">
                <div class="card-header">
                    <form method="GET" class="row align-items-center">
                        <div class="col-4">
                            <label for="startDate">Ngày bắt đầu</label>
                            <input class="form-control" type="date" name="startDate" id="startDate"
                                value="{{ request()->get('startDate') ?? date('Y-m-d') }}">
                        </div>
                        <div class="col-4">
                            <label for="endDate">Ngày kết thúc</label>
                            <input class="form-control" type="date" name="endDate" id="endDate"
                                value="{{ request()->get('endDate') ?? date('Y-m-d') }}">
                        </div>
                        <div class="col-2 align-self-end">
                            <button class="btn btn-primary">Tìm kiếm</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card-header">
                    <div class="card-title h4">Thống kê đơn hàng theo ngày</div>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="lineChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <script src="{{ asset('backend/assets/libs/chart.js/chart.min.js') }}"></script>
        <script>
            const dataChart = @json($data['dataChart']);

            const lineChart = document.getElementById("lineChart").getContext("2d");

            const myLineChart = new Chart(lineChart, {
                type: "line",
                data: {
                    labels: dataChart.map(item => item.date), // Ngày
                    datasets: [{
                        label: "Số đơn hàng",
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
                        data: dataChart.map(item => item.order), // Số lượng đơn hàng
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
        </script>
    @endsection
