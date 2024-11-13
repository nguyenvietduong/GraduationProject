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
                                <h5 class="mt-2 mb-0 fw-bold">24k</h5>
                            </div>
                            <!--end col-->
                            <div class="col-3 align-self-center">
                                <div
                                    class="d-flex justify-content-center align-items-center thumb-xl bg-light rounded-circle mx-auto">
                                    <i class="fa-solid fa-user" style="color: green"></i>
                                </div>
                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->

                    </div>
                    <!--end card-body-->
                </div>
                <!--end card-->
            </div>
            <!--end col-->
            <div class="col-md-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row d-flex justify-content-center border-dashed-bottom pb-3">
                            <div class="col-9">
                                <p class="text-dark mb-0 fw-semibold fs-14">Món ăn</p>
                                <h5 class="mt-2 mb-0 fw-bold">100</h5>
                            </div>
                            <!--end col-->
                            <div class="col-3 align-self-center">
                                <div
                                    class="d-flex justify-content-center align-items-center thumb-xl bg-light rounded-circle mx-auto">
                                    <i class="fa-solid fa-bowl-food" style="color: coral"></i>
                                </div>
                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->
                    </div>
                    <!--end card-body-->
                </div>
                <!--end card-->
            </div>
            <!--end col-->
            <div class="col-md-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row d-flex justify-content-center border-dashed-bottom pb-3">
                            <div class="col">
                                <p class="text-dark mb-0 fw-semibold fs-14">Doanh thu tháng</p>
                                <h5 class="mt-2 mb-0 fw-bold" ">1.000.000 VNĐ</h3>
                          </div>
                          <!--end col-->
                          <div class="col-3 align-self-center">
                            <div class="d-flex justify-content-center align-items-center thumb-xl bg-light rounded-circle mx-auto">
                              <i class="fa-regular fa-money-bill-1" style="color: green"></i>
                            </div>
                        </div>
                          <!--end col-->
                      </div>
                      <!--end row-->
                  
                  </div>
                  <!--end card-body-->
              </div>
              <!--end card-->
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row d-flex justify-content-center border-dashed-bottom pb-3">
                            <div class="col">
                                <p class="text-dark mb-0 fw-semibold fs-14">Doanh Năm</p>
                                <h5 class="mt-2 mb-0 fw-bold" ">1.000.000 VNĐ</h5>
                          </div>
                          <!--end col-->
                          <div class="col-3 align-self-center">
                            <div class="d-flex justify-content-center align-items-center thumb-xl bg-light rounded-circle mx-auto">
                              <i class="fa-regular fa-money-bill-1" style="color: green"></i>
                            </div>
                        </div>
                          <!--end col-->
                      </div>
                      <!--end row-->
                  
                  </div>
                  <!--end card-body-->
              </div>
              <!--end card-->
            </div>
            <!--end col-->
        </div>
        <!--end row-->
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                          <div class="col-5">
                            <select name="" id="" class="form-select">
                              <option value="">Tháng 1</option>
                              <option value="">Tháng 2</option>
                              <option value="">Tháng 3</option>
                              <option value="">Tháng 4</option>
                              <option value="">Tháng 5</option>
                            </select>
                          </div>
                          <div class="col-5">
                            <select name="" id="" class="form-select">
                              <option value="">2021</option>
                              <option value="">2022</option>
                              <option value="">2023</option>
                              <option value="">2024</option>
                              <option value="">2025</option>
                            </select>
                          </div>
                          <button class="col-2 btn btn-primary">Tìm kiếm</button>
                        </div>
                        <!--end row-->
                    </div>
                    <!--end card-header-->
                    <div class="card-body pt-0">
                        <div id="audience_overview" class="apex-charts"></div>
                    </div>
                    <!--end card-body-->
                </div>
                <!--end card-->
            </div>
            <!--end col-->
            <div class="col-md-6 col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col" >
                                <p class="text-dark mb-0 fw-semibold fs-14">Doanh thu hôm nay</p>
                                <h4 class="mt-2 mb-0 fw-bold" style="color: green">1.000.000 VNĐ</h4>
                            </div>
                            <!--end col-->
                            <div class="col-3 align-self-center">
                              <div class="d-flex justify-content-center align-items-center thumb-xl bg-light rounded-circle mx-auto">
                                <i class="fa-regular fa-money-bill-1" style="color: green"></i>
                              </div>
                          </div>
                            <!--end col-->
                        </div>
                        <!--end row-->
                    
                    </div>
                    <!--end card-body-->
                </div>
                <!--end card-->
            </div>
            <!--end col-->
        </div>
        <!--end row-->
        <div class="row">
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <div class="card-title">Đơn hàng</div>
              </div>
              <div class="card-body">
                <div class="chart-container">
                  <canvas id="lineChart"></canvas>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card">
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
        </div>
        

    </div><!-- container -->

    <!--Start Rightbar-->
    <!--Start Rightbar/offcanvas-->

    <script src="{{ asset('backend/assets/libs/chart.js/chart.min.js') }}"></script>
    <script>
        var lineChart = document.getElementById("lineChart").getContext("2d"),
            barChart = document.getElementById("barChart").getContext("2d")
        var myLineChart = new Chart(lineChart, {
            type: "line",
            data: {
                labels: [
                    "tháng 1",
                    "tháng 2",
                    "tháng 3",
                    "tháng 4",
                    "tháng 5",
                    "tháng 6",
                    "tháng 7",
                    "tháng 8",
                    "tháng 9",
                    "tháng 10",
                    "tháng 11",
                    "tháng 12",
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
                        542, 480, 430, 550, 530, 453, 380, 434, 568, 610, 700, 900,
                    ],
                }, ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    position: "bottom",
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
                    "tháng 1",
                    "tháng 2",
                    "tháng 3",
                    "tháng 4",
                    "tháng 5",
                    "tháng 6",
                    "tháng 7",
                    "tháng 8",
                    "tháng 9",
                    "tháng 10",
                    "tháng 11",
                    "tháng 12",
                ],
                datasets: [{
                    label: "Doanh thu",
                    backgroundColor: "rgb(23, 125, 255)",
                    borderColor: "rgb(23, 125, 255)",
                    data: [3, 2, 9, 5, 4, 6, 4, 6, 7, 8, 7, 4],
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
