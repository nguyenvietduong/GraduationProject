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

    .table-info:hover {
        background-color: #f0f0f0;
        transform: scale(1.05);
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
            @include('backend.component.card-component', [
            'title' => __('messages.system.table.title') . ' ' . __('messages.' . $object . '.title'),
            'totalRecords' => $totalRecords,
            'createRoute' => route('admin.' . $object . '.create'), // Corrected the route syntax
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
                <p>Vui lòng chọn bàn:</p>
                <input type="hidden" id="reservationId">

                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Số người</span>
                    <input type="number" class="form-control" id="guestsReservation">
                </div>

                <!-- Nơi để hiển thị thông tin các bàn có sẵn -->
                <div id="availableTables" class="row"></div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" style="display: none;" id="nextModal" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal">Tiếp tục chọn món ăn</button>
            </div>
        </div>
    </div>
</div>

<!-- Second Modal -->
<div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalToggleLabel2"></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-8">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col">
                                    <p>Vui lòng chọn món ăn:</p>
                                </div><!--end col-->
                            </div> <!--end row-->
                        </div><!--end card-header-->
                        <div id="availableMenu" class="row"></div>
                    </div> <!--end col-->
                    <div class="col-md-4 col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <p>Món đã chọn:</p>
                                        <input type="hidden" name="" id="idTable_">
                                    </div><!--end col-->
                                </div> <!--end row-->
                            </div><!--end card-header-->
                            <div class="card-body pt-0">
                                <table border="1" class="table mb-0 checkbox-all" id="datatable_1">
                                    <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>Tên món</th>
                                            <th>Số lượng</th>
                                        </tr>
                                    </thead>
                                    <tbody id="array-menu"></tbody>
                                </table>
                            </div><!--end card-body-->
                        </div><!--end card-->
                    </div> <!--end col-->
                </div><!--end row-->
            </div>
            <div class="modal-footer">
                <button class="btn btn-success">Đặt hàng</button>
            </div>
        </div>
    </div>
</div>

@push('script')
<script>
    var updateStatusUrl = '{{ route("admin.reservation.updateStatus") }}';
    var csrfToken = '{{ csrf_token() }}';
</script>
<script src="{{ asset('backend/assets/custom/js/ajax/set-status-reservation.js') }}"></script>
@endpush
@endsection