<div class="col-12 col-md mb-2">
    <div class="row">
        <div class="col-2">
            <label for="start_date">{{ __('messages.system.start') }}</label> <!-- Thêm id cho label -->
        </div>
        <div class="col-10">
            <input type="datetime-local" class="form-control" id="start_date" name="start_date"
                value="{{ request('start_date') ?: old('start_date') }}">
        </div>
    </div>
</div>

<div class="col-12 col-md mb-2">
    <div class="row">
        <div class="col-2">
            <label for="end_date">{{ __('messages.system.end') }}</label> <!-- Thêm id cho label -->
        </div>
        <div class="col-10">
            <input type="datetime-local" class="form-control" id="end_date" name="end_date"
                value="{{ request('end_date') ?: old('end_date') }}">
        </div>
    </div>
</div>

<div class="col-12 col-md mb-2">
    <input type="text" class="form-control" id="search" placeholder="Search..." name="keyword"
        value="{{ request('keyword') ?: old('keyword') }}">
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Lấy ngày hiện tại
        const today = new Date();
        const dd = String(today.getDate()).padStart(2, '0');
        const mm = String(today.getMonth() + 1).padStart(2, '0'); // Tháng bắt đầu từ 0
        const yyyy = today.getFullYear();
        
        // Tạo chuỗi định dạng YYYY-MM-DDTHH:MM
        const maxDateTime = `${yyyy}-${mm}-${dd}T${String(today.getHours()).padStart(2, '0')}:${String(today.getMinutes()).padStart(2, '0')}`;

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