$(document).ready(function() {
    $('#submitPromotion').on('click', function(e) {
        e.preventDefault(); // Ngăn form gửi dữ liệu truyền thống

        let promotion = $('#promotion').val(); // Lấy giá trị mã giảm giá
        if (promotion === "") {
            $('#promotion').css('border', '1px solid red');
            $('<style>#promotion::placeholder { color: red; }</style>').appendTo('head');
            $('#promotion').attr('placeholder', 'Vui lòng nhập mã !!!');
            return; // Dừng lại nếu ô nhập liệu trống
        } else {
            $('#promotion').css('border', '1px solid grey');
            $('<style>#promotion::placeholder { color: grey ; }</style>').appendTo('head');
            $('#promotion').attr('placeholder', 'Nhập mã giảm giá');
        }
        console.log(promotion);
        
        $.ajax({
            url: '/check-promotion', // URL xử lý kiểm tra mã giảm giá
            type: 'POST',
            data: {
                _token: csrfToken,
                promotion: promotion
            },
            success: function(response) {
                // Kiểm tra phản hồi từ máy chủ
                if (response.valid) {
                    $('#voucher').html(`<p style="color: green">Mã giảm giá hợp lệ! Giảm giá: ${response.promotion}%</p>`);
                } else {
                    $('#voucher').html('<p style="color: red">Mã giảm giá không hợp lệ hoặc đã hết hạn.</p>');
                }
            },
            error: function(xhr, status, error) {
                $('.error').html('<p style="color: red">Có lỗi xảy ra khi kiểm tra mã giảm giá.</p>');
                console.error('Error:', error);
            }
        });
    });
});