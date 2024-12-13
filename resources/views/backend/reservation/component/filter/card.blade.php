<div class="card">
    <div class="card-header">
        <div class="row align-items-center">
            <div class="col-auto">
                <h4 class="card-title">{{ $title }} - Hôm nay ({{$todayArrivedCount ?? ''}} đơn)</h4>
            </div>
            <div class="col-auto ms-auto mt-1">
                <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal"
                    data-bs-target="#create-reservation">
                    <i class="fa-solid fa-plus me-1"></i>
                    Tạo đơn mới
                </button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade bd-example-modal-lg" id="create-reservation" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title m-0" id="myLargeModalLabel">Tạo đơn mới</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div><!--end modal-header-->
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-6">
                        <label class="mb-2">Họ tên</label>
                        <div class="input-group mb-2">
                            <input type="text" name="name" class="form-control">
                        </div>
                        <label class="mb-2">Email</label>
                        <div class="input-group mb-2">
                            <input type="text" name="email" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <label class="mb-2">Điện thoại</label>
                        <div class="input-group mb-2">
                            <input type="text" name="phone" class="form-control">
                        </div>
                        <label class="mb-2">Số người</label>
                        <div class="input-group mb-2">
                            <input type="number" name="guest" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <label class="form-label" for="message">Ghi chú</label>
                        <textarea class="form-control" name="message" rows="5" id="message"></textarea>
                    </div>
                </div><!--end row-->
            </div><!--end modal-body-->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary btnCreateReservation">Tạo đơn</button>
            </div><!--end modal-footer-->
        </div><!--end modal-content-->
    </div><!--end modal-dialog-->
</div>
