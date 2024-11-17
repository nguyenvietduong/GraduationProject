<div class="row justify-content-center">
    <div class="col-md-12 col-lg-12">
        <div class="card">
            <div class="row mt-2">
                <div class="col-md-12">
                    <div class="row mt-2">
                        <div class="col-md-12 mt-2">
                            <div class="row">
                                <div class="col-2">
                                    <div class="row">
                                        <div class="col-5">
                                            <label for="sortMenuType">Sắp xếp:</label>
                                        </div>
                                        <div class="col-7">
                                            <select id="sortMenuType" class="form-control">
                                                <option value="most" selected>Nhiều</option>
                                                <option value="least">Ít</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="row">
                                        <div class="col-5">
                                            <label for="limitMenu">Số lượng món:</label>
                                        </div>
                                        <div class="col-7">
                                            <input type="number" id="limitMenu" class="form-control" placeholder="Tất cả">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="row">
                                        <div class="col-5">
                                            <label for="startDateMenu">Ngày bắt đầu:</label>
                                        </div>
                                        <div class="col-7">
                                            <input type="date" id="startDateMenu" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="row">
                                        <div class="col-5">
                                            <label for="endDateMenu">Ngày kết thúc:</label>
                                        </div>
                                        <div class="col-7">
                                            <input type="date" id="endDateMenu" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-1">
                                    <button type="button" id="export_btn_menu" class="btn btn-primary">PDF</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card-body" style="position: relative;">
                        @include('backend.statistical.component.loading')
                        <canvas id="menuChart" dir="ltr" style="display: block; box-sizing: border-box;width: 300px;height: 300px;"></canvas>
                        <p class="no-data-message" style="display: none; text-align: center; padding-top: 130px;">Không có dữ liệu</p>
                    </div>
                </div>
            </div>
        </div><!-- end card -->
    </div> <!-- end col -->
</div><!-- end row -->
