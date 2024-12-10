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

        .table-info.selected {
            border-color: #007bff;
            background-color: #e0f7ff;
        }

        .menu-info {
            padding: 10px;
            border: 2px solid #ccc;
            border-radius: 8px;
            text-align: center;
            cursor: pointer;
            transition: transform 0.2s, background-color 0.2s;
        }

        .menu-info:hover {
            background-color: #f0f0f0;
            transform: scale(1.05);
        }

        .menu-info.selected {
            border-color: #007bff;
            background-color: #e0f7ff;
        }
    </style>
    <div class="container-xxl">
        <div class="row">
            <div class="col-12">
                @include('backend.reservation.component.filter.card', [
                    'title' => __('messages.system.table.title') . ' đơn hàng',
                    'totalRecords' => $totalRecords,
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
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                                                    <div class="col-lg-8">
                                                        <div class="input-group">
                                                            <input type="" class="form-control searchMenu"
                                                                placeholder="Tìm kiếm món ăn"
                                                                aria-describedby="button-addon3">
                                                        </div>
                                                    </div><!--end col-->
                                                    <div class="col-lg-4">
                                                    </div><!--end col-->

                                                </div> <!--end row-->
                                                <div class="col-md-8 col-lg-8">
                                                    <div class="card-header px-0">

                                                    </div><!--end card-header-->
                                                    <div id="availableMenu" class="row">
                                                    </div>
                                                </div> <!--end col-->
                                                <div class="col-md-4 col-lg-4">
                                                    <div class="card">
                                                        <div class="card-header px-0">
                                                            <div class="row align-items-center">
                                                                <div class="col">
                                                                    {{-- <p>Món đã chọn:</p> --}}
                                                                    {{-- <input type="hidden" name="" id="idTable_"> --}}
                                                                </div><!--end col-->
                                                            </div> <!--end row-->
                                                        </div><!--end card-header-->
                                                        <div class="card-body pt-0">
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
                                                                        <th class="text-center">Số lượng</th>
                                                                        <th class="text-end">Thành tiền</th>
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
                                    <h5 style="display: none" class="voucher-discount"></h5>
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
                                    
                                    <button class="btn btn-primary py-2 px-3 mx-1 mt-3 btn_paid" id="">Đã thanh
                                        toán</button>
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
    @push('script')
        <script src="{{ asset('backend/custom/customTemp.js') }}"></script>
        <script src="{{ asset('backend/custom/data.js') }}"></script>
        <script src="{{ asset('backend/custom/customReservation.js') }}"></script>
        <script src="{{ asset('backend/custom/customPayment.js?v=108') }}"></script>
    @endpush
@endsection