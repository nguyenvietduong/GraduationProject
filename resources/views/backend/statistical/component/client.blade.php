<div class="row justify-content-center">
    <div class="col-md-12 col-lg-12">
        <div class="card">
            <div class="row mt-2">
                <div class="col-md-4">
                    <div class="row mt-2">
                        <div class="col-md-12 mt-2">
                            <div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-5">
                                            <label for="start_year">Số khách hàng:</label>
                                        </div>
                                        <div class="col-7">
                                            <input type="number" id="limit" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mt-2">
                                    <div class="row">
                                        <div class="col-5">
                                            <label for="start_year">Thời gian bắt đầu:</label>
                                        </div>
                                        <div class="col-7">
                                            <input type="date" id="startDateClient" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mt-2">
                                    <div class="row">
                                        <div class="col-5">
                                            <label for="end_year">Thời gian kết thúc:</label>
                                        </div>
                                        <div class="col-7">
                                            <input type="date" id="endDateClient" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-1 mt-2">
                            <button type="button" id="export_btn_client" class="btn btn-primary">PDF</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card-body" style="position: relative;">
                        @include('backend.statistical.component.loading')
                        <canvas id="clientChart" dir="ltr" style="display: block; box-sizing: border-box;"></canvas>
                        <p class="no-data-message" style="display: none; text-align: center; padding-top: 130px;">Không thể
                            lấy
                            được dữ liệu</p>
                    </div>
                </div>
            </div>
        </div><!--end card-->
    </div> <!--end col-->
</div><!--end row-->
