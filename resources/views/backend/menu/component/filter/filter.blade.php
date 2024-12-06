<div class="col-5 container">
    <div class="row">
        <div class="col-12 col-md mb-2">
            <div class="row">
                <div class="col-4">
                    <label for="start_date">{{ __('messages.system.start') }}</label> <!-- Thêm id cho label -->
                </div>
                <div class="col-8">
                    <input type="date" class="form-control" id="start_date" name="start_date"
                        value="{{ request('start_date') ?: old('start_date') }}">
                </div>
            </div>
        </div>

        <div class="col-12 col-md mb-2">
            <div class="row">
                <div class="col-4">
                    <label for="end_date">{{ __('messages.system.end') }}</label> <!-- Thêm id cho label -->
                </div>
                <div class="col-8">
                    <input type="date" class="form-control" id="end_date" name="end_date"
                        value="{{ request('end_date') ?: old('end_date') }}">
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md mb-2">
            <div class="row">
                <div class="col-4">
                    <label for="start_price">{{ __('messages.menu.filters.start_price') }}</label>
                    <!-- Thêm id cho label -->
                </div>
                <div class="col-8">
                    <input type="number" class="form-control" id="start_price" name="start_price" step=""
                        value="{{ request('start_price') ?: old('start_price') }}">
                </div>
            </div>
        </div>

        <div class="col-12 col-md mb-2">
            <div class="row">
                <div class="col-4">
                    <label for="end_price">{{ __('messages.menu.filters.end_price') }}</label>
                    <!-- Thêm id cho label -->
                </div>
                <div class="col-8">
                    <input type="number" class="form-control" id="end_price" name="end_price" step=""
                        value="{{ request('end_price') ?: old('end_price') }}">
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-8 col-md mb-2 container">
    <div class="row ">
        <div class="mb-2 row">
            <input type="text" class="form-control" id="search"
                placeholder="{{ app()->getLocale() !== 'en' ? 'Tìm kiếm theo tên ...' : 'Name search ...' }}"
                name="keyword" value="{{ request('keyword') ?: old('keyword') }}">
        </div>
        <div class="row ">
            @php
                $status = request('status') ?: old('status');
                $statuses = __('messages.menu.status');
            @endphp
            <div class="col-6" style="padding: 2px">
                <select name="status" class="form-select  filter ">
                    <option value="">--Trạng thái--</option>
                    @foreach ($statuses as $key => $option)
                        <option value="{{ $key }}" {{ $status == $key ? 'selected' : '' }}>
                            {{ $option }}
                        </option>
                    @endforeach
                </select>
            </div>
            @php
            $categoryOld = request('category') ?: old('category');
            @endphp
            <div class="col-6" style="padding: 2px">
                <select name="category" class="form-select  filter ">
                    <option value="">--Danh mục--</option>
                    @foreach ($categories as $category)
                        <option value="{{$category->id}}" {{ $categoryOld == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</div>



<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Lấy ngày hiện tại
        const today = new Date();
        const dd = String(today.getDate()).padStart(2, '0');
        const mm = String(today.getMonth() + 1).padStart(2, '0'); // Tháng bắt đầu từ 0
        const yyyy = today.getFullYear();

        // Tạo chuỗi định dạng YYYY-MM-DDTHH:MM
        const maxDateTime =
            `${yyyy}-${mm}-${dd}T${String(today.getHours()).padStart(2, '0')}:${String(today.getMinutes()).padStart(2, '0')}`;

        // Thiết lập giá trị max cho input datetime-local
        document.getElementById('start_date').setAttribute('max', maxDateTime);
        document.getElementById('end_date').setAttribute('max', maxDateTime);

        // Kiểm tra ngày bắt đầu và ngày kết thúc
        const startDateInput = document.getElementById('start_date');
        const endDateInput = document.getElementById('end_date');

        startDateInput.addEventListener('change', function() {
            if (endDateInput.value && new Date(startDateInput.value) > new Date(endDateInput.value)) {
                endDateInput.value = ''; // Reset end date if start date is after it
            }
        });

        endDateInput.addEventListener('change', function() {
            if (startDateInput.value && new Date(startDateInput.value) > new Date(endDateInput.value)) {
                startDateInput.value = ''; // Reset start date if end date is before it
            }
        });
    });
</script>
