document.addEventListener('DOMContentLoaded', function () {
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

    startDateInput.addEventListener('change', function () {
        if (endDateInput.value && new Date(startDateInput.value) > new Date(endDateInput.value)) {
            endDateInput.value = ''; // Reset end date if start date is after it
        }
    });

    endDateInput.addEventListener('change', function () {
        if (startDateInput.value && new Date(startDateInput.value) > new Date(endDateInput.value)) {
            startDateInput.value = ''; // Reset start date if end date is before it
        }
    });
});