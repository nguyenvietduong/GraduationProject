<div class="col-8 container">
    <div class="row">

        <div class="col-12 col-md mb-2">
            <div class="row">
                <div class="col-5">
                    <label for="reservation_time">Thời gian đặt</label> <!-- Thêm id cho label -->
                </div>
                <div class="col-7">
                    <input type="date" class="form-control" id="reservation_time" name="reservation_time"
                        value="{{ request('reservation_time') ?: old('reservation_time') }}">
                </div>
            </div>
        </div>

        <div class="col-12 col-md mb-2">
            <input type="text" class="form-control" id="name" placeholder="Họ tên ..." name="name"
                value="{{ request('name') ?: old('name') }}">
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md mb-2">
            <input type="text" class="form-control" id="email" placeholder="Email ..." name="email"
                value="{{ request('email') ?: old('email') }}">
        </div>

        <div class="col-12 col-md mb-2">
            <input type="text" class="form-control" id="phone" placeholder="Số điện thoại..." name="phone"
                value="{{ request('phone') ?: old('phone') }}">
        </div>

        <div class="col-12 col-md mb-2">
            <div class="form-check">
                <input class="form-check-input" {{ request()->get('isCanceled') ? 'checked' : '' }} type="checkbox" name="isCanceled" id="flexRadioDefault1">
                <label class="form-check-label" for="flexRadioDefault1">
                    Đã hủy
                </label>
            </div>
        </div>
    </div>
</div>
