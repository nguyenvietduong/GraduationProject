@php
    $perPageOptions = [5, 10, 15, 20, 50, 100];
@endphp
<form method="get" action="" id="form_filter">
    <div class="card">
        <div class="card-header">
            <div class="row align-items-center">
                <div class="col-12 col-md-auto mb-2">
                    <!-- Keep this column for per_page dropdown -->
                    @php
                        $per_page = request('per_page') ?: old('per_page');
                    @endphp
                    <select name="per_page" class="form-select per_page filter">
                        @foreach ($perPageOptions as $option)
                            <option {{ $per_page == $option ? 'selected' : '' }} value="{{ $option }}">
                                {{ $option }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-8 container">
                    <div class="row">
                        <div class="col-12 col-md mb-2">
                            <div class="row">
                                <div class="col-5">
                                    <label for="reservation_time">Thời gian đặt</label> <!-- Thêm id cho label -->
                                </div>
                                <div class="col-7">
                                    <input type="datetime-local" class="form-control" id="reservation_time"
                                        name="reservation_time"
                                        value="{{ request('reservation_time') ?: old('reservation_time') }}">
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md mb-2">
                            <input type="text" class="form-control" id="name" placeholder="Mã đơn đặt bàn..."
                                name="code" value="{{ request('code') ?: old('code') }}">
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-auto mb-2">
                    <div class="d-flex">
                        <button type="submit" id="filter-button" name="search"
                            class="btn btn-primary d-flex align-items-center  mx-1">
                            <i class="iconoir-filter-alt me-1"></i>
                            {{ __('messages.system.button.search') }}
                        </button>
                        <button type="submit" id="form_filter_reset-btn" class="btn btn-secondary mx-1"
                            style="display: none">
                            <i class="iconoir-filter-alt me-1"></i>
                            {{ __('messages.system.button.reset') }}
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</form>

<script>
    const btnReset = document.getElementById('form_filter_reset-btn');
 
 // Hàm kiểm tra query string để quyết định hiển thị nút Reset
 function updateResetButtonFromQuery() {
     const urlParams = new URLSearchParams(window.location.search);
 
     // Kiểm tra nếu có ít nhất một query string có giá trị
     const hasFilters = Array.from(urlParams.entries()).some(
         ([key, value]) => value.trim() !== "" && key !== "per_page"
     );
 
     // Hiển thị hoặc ẩn nút Reset dựa trên trạng thái
     btnReset.style.display = hasFilters ? 'block' : 'none';
 }
 
 // Sự kiện click nút Reset
 btnReset.addEventListener('click', function (e) {
     e.preventDefault();
     const url = new URL(window.location);
     Array.from(url.searchParams.keys()).forEach(key => {
         if (key !== 'per_page') {
             url.searchParams.delete(key);
         }
     });
     window.location = url.toString();
 });
 
 // Kiểm tra trạng thái ban đầu
 updateResetButtonFromQuery();
 </script>