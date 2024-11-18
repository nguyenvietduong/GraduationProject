<div class="row justify-content-center">
    <div class="col-md-12 col-lg-12">
        <div class="card">
            <div class="row mt-2">
                <div class="col-md-3">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="year" name="type" value="year" checked>
                        <label class="form-check-label" for="year">Năm</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="month" name="type" value="month">
                        <label class="form-check-label" for="month">Tháng</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="day" name="type" value="day">
                        <label class="form-check-label" for="day">Ngày</label>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-6">
                            <div class="row">
                                <div class="col-5">
                                    <label for="start_year">Thời gian bắt đầu:</label>
                                </div>
                                <div class="col-7">
                                    <input type="date" id="start_date" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="row">
                                <div class="col-5">
                                    <label for="end_year">Thời gian kết thúc:</label>
                                </div>
                                <div class="col-7">
                                    <input type="date" id="end_date" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-1">
                    <button type="button" id="export_btn_revenue" class="btn btn-primary export_btn">PDF</button>
                </div>
            </div>
            <div class="card-body" style="position: relative;">
                @include('backend.statistical.component.loading')
                <canvas id="revenueChart" dir="ltr" width="400" height="150"></canvas>
                <p class="no-data-message" style="display: none; text-align: center; padding-top: 130px;">Không thể lấy
                    được dữ liệu</p>
            </div>
        </div><!--end card-->
    </div> <!--end col-->
</div><!--end row-->