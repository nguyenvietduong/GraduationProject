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
        position: relative;
    }

    /* .menu-info:hover {
                background-color: #f0f0f0;
                transform: scale(1.05);
            } */

    .menu-info.selected {
        border-color: #007bff;
        background-color: #e0f7ff;
    }
</style>
<div class="container-xxl">
    <div class="row">
        <div class="col-12">
            @include('backend.dish.component.filter.card', [
            'title' => __('messages.system.table.title') . ' đơn hàng',
            'todayArrivedCount' => $todayArrivedCount,
            ])

            <div class="card-body pt-0">
                @include('backend.dish.component.filter.filter')
            </div>

            <div class="card-body pt-0">
                <div class="table-responsive">
                    @include('backend.dish.component.table.table')
                </div>
            </div>
        </div>
    </div>
</div>

<!-- First Modal -->
<div class="modal fade" id="modalDish" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Danh sách món ăn</h1>
                <button type="button" class="btn-close btnCloseReservation" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row justify-content-center">
                    <div class="col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-header infoTableDish">
                                
                            </div>
                            <div class="card-body pt-0">
                                <table border="1" class="table mb-0 checkbox-all"
                                    id="datatable_1">
                                    <thead>
                                        <tr>
                                            <th class=" bg-primary">Tên món</th>
                                            <th class="text-center bg-primary">Số lượng</th>
                                            <th class="text-center bg-primary">Trạng thái</th>
                                        </tr>
                                    </thead>
                                    <tbody id="array-invoice-item-detail"></tbody>
                                </table>
                            </div><!--end card-body-->
                        </div><!--end card-->
                    </div> <!--end col-->
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary btnSaveDish">Lưu thông tin</button>
            </div>
        </div>
    </div>
</div>


@push('script')
<script src="{{ asset('backend/custom/customDish.js') }}"></script>
@endpush
@endsection