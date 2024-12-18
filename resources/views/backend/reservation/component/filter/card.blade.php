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