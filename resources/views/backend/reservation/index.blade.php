@extends('layout.backend')
@section('adminContent')
    <style>
        .table-info {
            padding: 10px;
            border: 2px solid #ccc;
            border-radius: 8px;
            text-align: center;
            cursor: pointer;
            transition: transform 0.2s, background-color 0.2s;
        }


        .menu-info {
            padding: 10px;
            border: 2px solid #ccc;
            border-radius: 8px;
            text-align: center;
            cursor: pointer;
            transition: transform 0.2s, background-color 0.2s;
            position: relative;
        }

        .menu-info.selected {
            border-color: #00ff40;
            background-color: #d1ffe4;
        }

        /* Giao diện Sold Out */
        .menu-info.sold-out {
            opacity: 0.6;
            /* Làm mờ */
            pointer-events: none;
            /* Không thể click */
            cursor: not-allowed !important;
            /* Con trỏ cấm */
            background-color: #f9f9f9;
            /* Nền nhạt */
            border-color: rgba(255, 0, 0, 0.9);
        }

        .menu-info.sold-out img {
            filter: grayscale(100%);
            /* Ảnh đen trắng */
        }

        .menu-info.sold-out::after {
            content: "Sold Out";
            /* Thêm chữ */
            transform: translate(-50%, -50%);
            background-color: rgba(255, 0, 0, 0.9);
            /* Nền mờ */
            color: white;
            font-size: 16px;
            font-weight: bold;
            padding: 5px 10px;
            border-radius: 4px;
            text-transform: uppercase;
        }
    </style>
    <div class="container-xxl">
        <div class="row">
            <div class="col-12">
                @include('backend.reservation.component.filter.card', [
                    'title' => __('messages.system.table.title') . ' đơn hàng',
                    'todayArrivedCount' => $todayArrivedCount,
                ])

                <div class="card-body pt-0">
                    @include('backend.component.filter')
                </div>

                <div class="card-body pt-0">
                    <div class="table-responsive">
                        @include('backend.' . $object . '.component.table.table')
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- First Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Chọn Bàn</h1>
                    <button type="button" class="btn-close btnCloseReservation" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">


                    <div class="row justify-content-center">
                        <div class="col-md-12 col-lg-12">
                            <div class="card">
                                <div class="card-body pt-0">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-bs-toggle="tab" href="#table" role="tab"
                                                aria-selected="true">Chọn bàn</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#menu" role="tab"
                                                aria-selected="false">Chọn món ăn</a>
                                        </li>
                                    </ul>

                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div class="tab-pane p-3 active" id="table" role="tabpanel">
                                            <p id="notiTable" class="text-danger text-uppercase mb-4"></p>
                                            <input type="hidden" id="reservationId">
                                            <div id="availableTables" class="row"></div>
                                        </div>
                                        <div class="tab-pane p-3" id="menu" role="tabpanel">
                                            <div class="row justify-content-center">
                                                <div class="row align-items-center">
                                                    <div class="col-lg-7">
                                                        <div class="input-group">
                                                            <input type="" class="form-control searchMenu"
                                                                placeholder="Tìm kiếm món ăn"
                                                                aria-describedby="button-addon3">
                                                        </div>
                                                    </div><!--end col-->
                                                    <div class="col-lg-5">
                                                        <div class="">
                                                            <h5>Chú thích</h5>
                                                            <button class="btn btn-primary btn-sm">0</button>: Số lượng món
                                                            xác nhận
                                                            <button class="btn btn-warning btn-sm">0</button>: Số lượng món
                                                            đang nấu
                                                            <button class="btn btn-success btn-sm">0</button>: Số lượng món
                                                            hoàn thành
                                                        </div>
                                                    </div><!--end col-->

                                                </div> <!--end row-->
                                                <div class="col-md-7 col-lg-7">
                                                    <div class="card-header px-0">

                                                    </div><!--end card-header-->
                                                    <div id="availableMenu" class="row">
                                                    </div>
                                                </div> <!--end col-->
                                                <div class="col-md-5 col-lg-5">
                                                    <div class="card">
                                                        <div class="card-header px-0">
                                                            <div class="row align-items-center">
                                                                <div class="col">

                                                                </div><!--end col-->
                                                            </div> <!--end row-->
                                                        </div><!--end card-header-->
                                                        <div class="card-body pt-0 px-0">
                                                            <div class="row align-items-center">
                                                                <div class="col">
                                                                    <h5 class="">Món đã chọn:</h5>
                                                                    <input type="hidden" name="" id="idTable_">
                                                                </div><!--end col-->
                                                            </div>
                                                            <table border="1" class="table mb-0 checkbox-all"
                                                                id="datatable_1">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Tên món</th>
                                                                        <th class="text-center" style="width: 160px">Số
                                                                            lượng</th>
                                                                        <th class="text-center">Thành tiền</th>
                                                                        <th class="text-center">Lên món</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="array-menu"></tbody>
                                                            </table>
                                                        </div><!--end card-body-->
                                                    </div><!--end card-->
                                                </div> <!--end col-->
                                            </div>
                                        </div>
                                    </div>
                                </div><!--end card-body-->
                            </div><!--end card-->
                        </div> <!--end col-->
                    </div>
                </div>
                <div class="modal-footer modal-footer-reservation">
                </div>
            </div>
        </div>
    </div>

    <!--  -->
    <div class="modal fade" id="pay" tabindex="-1" aria-labelledby="paylable" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="paylable">Thanh toán</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-7 col-lg-7">
                            <div class="card">
                                <div class="card-body pt-0">
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="row align-items-center">
                                                <div class="col">
                                                    <p>Món đã chọn:</p>
                                                    <input type="hidden" name="" id="">
                                                </div><!--end col-->
                                            </div> <!--end row-->
                                        </div><!--end card-header-->
                                        <div class="card-body pt-0">
                                            <table border="1" class="table mb-0 checkbox-all" id="">
                                                <thead>
                                                    <tr>
                                                        <th>Tên món</th>
                                                        <th>Số lượng</th>
                                                        <th>Thành tiền</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="list_menu_item">
                                                </tbody>
                                            </table>
                                        </div><!--end card-body-->
                                    </div><!--end card-->
                                </div><!--end card-body-->
                            </div><!--end card-->
                        </div> <!--end col-->
                        <div class="col-md-5 col-lg-5">
                            <div class="card">
                                <div class="card-header">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <p>Thanh toán</p>
                                        </div><!--end col-->
                                    </div> <!--end row-->
                                </div><!--end card-header-->
                                <div class="card-body pt-0">
                                    <h5 style="display: none"><span class="total-amount">0</span></h5>
                                    <h5 style="display: none" class="voucher-discount" id="voucher-discount"
                                        data-id-vouchar=""></h5>
                                    <h5>Tổng thanh toán : <span class="total-payment">0</span></h5>
                                    <hr>
                                    <label>Nhập mã giảm giá</label>
                                    <div class="row mt-3">
                                        <div class="col-6">
                                            <style>
                                                .input-voucher {
                                                    text-transform: uppercase;
                                                    /* Chuyển đổi văn bản nhập vào thành chữ hoa */
                                                }
                                            </style>
                                            <input type="text" class="form-control input-voucher"
                                                placeholder="Nhập mã giảm giá" value="">
                                            <span class="feedback-voucher"></span>
                                        </div>
                                        <div class="col-6">
                                            <button class="btn btn-secondary btn-apply-voucher">Nhập mã giảm giá</button>
                                        </div>
                                        <div class="row  my-2" id="render_voucher">

                                        </div>
                                    </div>

                                    <button type="button" class="btn btn-primary py-2 px-3 mx-1 mt-3 btn_qr_code"
                                        id="idDonhang" data-id="">
                                        QR Code
                                    </button>
                                    <button class="btn btn-primary py-2 px-3 mx-1 mt-3 btn_paid" id="">Trả tiền
                                        mặt</button>
                                    <button class="btn btn-danger py-2 px-3 mx-1 mt-3 btn_cancel_reservation"
                                        id="">Hủy đơn</button>
                                </div><!--end card-body-->
                            </div><!--end card-->
                        </div>
                    </div>
                </div>
                <div class="modal-footer-1">
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="qr_code" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">QR Code</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img class="text-center" id="qr-code-image" src="" alt="QR Code" width="380px">
                </div>
                <div class="modal-footer">
                    {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary" onclick="checkPaid()">Check ngay</button>
                    <button type="button" class="btn btn-primary" onclick="confirm_pay_qrCode()">Xác nhận chuyển khoản</button> --}}
                </div>
            </div>
        </div>
    </div>

    <div class="cursor-not-allowed-menu" title="Đã lên món không thể hủy"></div>

    @push('script')
        <script src="{{ asset('backend/custom/customQrCode.js') }}"></script>
        <script src="{{ asset('backend/custom/customTemp.js') }}"></script>
        <script src="{{ asset('backend/custom/data.js') }}"></script>
        <script src="{{ asset('backend/custom/customReservation.js') }}"></script>
        <script src="{{ asset('backend/custom/customPayment.js') }}"></script>
    @endpush
@endsection
