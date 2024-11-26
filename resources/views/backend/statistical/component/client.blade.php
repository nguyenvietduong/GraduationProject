<div class="row justify-content-center">
    <div class="col-md-12 col-lg-12">
        <div class="card">
            <div class="row mt-2">
                <div class="col-md-3 d-flex align-items-center">
                    <label for="day" class="form-label me-2 mb-0">Ngày</label>
                    <input type="number" name="day" id="day" class="form-control" min="1" max="31">
                </div>
                <div class="col-md-3 d-flex align-items-center">
                    <label for="month" class="form-label me-2 mb-0">Tháng</label>
                    <select name="month" id="month" class="form-control">
                        <option value="">--- Chọn tháng ---</option>
                        @for ($stt_month = 1; $stt_month <= 12; $stt_month++)
                            <option value="{{ $stt_month }}">Tháng {{ $stt_month }}</option>
                        @endfor
                    </select>
                </div>
                <div class="col-md-3 d-flex align-items-center">
                    <label for="type" class="form-label me-2 mb-0">Năm</label>
                    @php
                        $arr_year = [
                            '2020' => 2020,
                            '2021' => 2021,
                            '2022' => 2022,
                            '2023' => 2023,
                            '2024' => 2024,
                            'all'  => 'Tất cả'
                        ];
                    @endphp
                    <select name="year" id="year" class="form-control">
                        <option value="">--- Chọn năm ---</option>
                        @foreach ($arr_year as $item => $value)
                            <option value="{{ $item }}">{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="button" id="export_btn_client" class="btn btn-primary">Xuất PDF</button>
                </div>
            </div>
            <div class="card-body" style="position: relative;">
                @include('backend.statistical.component.loading')
                <canvas id="customerChart" dir="ltr" width="400" height="150"></canvas>
                <p class="no-data-message" style="display: none; text-align: center; padding-top: 130px;">Không thể lấy
                    được dữ liệu</p>
            </div>
        </div><!--end card-->
    </div> <!--end col-->
</div><!--end row-->
