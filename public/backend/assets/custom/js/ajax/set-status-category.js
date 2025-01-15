$(document).ready(function () {
    $(document).on('change', '.status', function () {
        var select = $(this);

        select.val() == "active" ? select.closest('tr').removeClass("bg-secondary") : select.closest('tr').addClass("bg-secondary");
        var selectedValue = select.val();

        var categoryId = select.data('category-id'); // This should get the correct account ID

        var data = {
            _token: csrfToken,
            id: categoryId,
            status: selectedValue
        };

        $.ajax({
            url: updateStatusUrl, // Now pointing to the correct URL
            type: 'POST',
            data: data,
            success: function (response) {
                if (response.status == false) {
                    alert(response.message);
                } else {
                    executeExample('success');
                }
                window.location.reload();
                // Tùy chọn reload bảng để hiển thị trạng thái mới
            },
            error: function (xhr, status, error) {
                executeExample('error');
            }
        });
    });
});
