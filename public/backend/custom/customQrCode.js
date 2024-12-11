function confirm_pay_qrCode() {
    let userConfirm = confirm('Vui lòng xác nhận lại lần nữa!');

    var reservationId = $('#btn-reservation-id').data('reservation-id');
    var voucherId = $('#voucher-discount').data('id-vouchar');
    var totalPayment = $('.total-payment').html();
    let formattedAmount = totalPayment.replace(/[.đ]/g, '');

    if (userConfirm) {
        $.ajax({
            url: '/admin/invoice/store',
            type: 'POST',
            data: {
                reservation_id: reservationId,
                voucher_id: voucherId,
                total_payment: formattedAmount,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.error) {
                    alert(response.error);
                    setTimeout(function() {
                        location.reload();
                    }, 1000);  // 3000ms = 3 seconds
                } 
                
                if (response.success) {
                    // Pass the required parameters to the exportAndSavePDF function
                    alert('Thanh toán thành công');
                    setTimeout(function() {
                        location.reload();
                    }, 1000);  // 3000ms = 3 seconds
                    exportAndSavePDF(reservationId, voucherId, formattedAmount);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
            }
        });
    }
}

const exportAndSavePDF = (reservationId, voucherId, formattedAmount) => {
    $.ajax({
        url: "/admin/invoice/exportPDF",
        method: "POST",
        data: {
            reservation_id: reservationId,
            code: voucherId,
            total_payment: formattedAmount,
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            if (response.success) {
                const pdfContent = response.pdfContent;
                const fileName = response.fileName;

                // Convert base64 to binary
                const binary = atob(pdfContent);
                const array = new Uint8Array(binary.length);
                for (let i = 0; i < binary.length; i++) {
                    array[i] = binary.charCodeAt(i);
                }

                // Create a Blob with PDF data
                const blob = new Blob([array], { type: 'application/pdf' });

                // Open the PDF in a new tab
                const pdfURL = URL.createObjectURL(blob);
                window.open(pdfURL, '_blank');
            } else {
                alert('Error creating and saving the invoice.');
            }
        },
        error: function(xhr, status, error) {
            console.error('Error:', error);
        }
    });
};

(function ($) {
    $(document).ready(function () {
        // Bắt sự kiện click vào nút QR Code
        $('.btn_qr_code').on('click', function () {
            // Lấy các modal
            var qrCodeModal = new bootstrap.Modal(document.getElementById('qr_code'));
            var exampleModal = $('#pay');
            var qrCodeImage = $('#qr-code-image');
            var totalPayment = $('.total-payment').html();
            let formattedAmount = totalPayment.replace(/[.đ]/g, '');
            
            // Cập nhật thuộc tính src của thẻ img
            qrCodeImage.attr('src', `https://img.vietqr.io/image/TCB-19073092061017-compact2.jpg?amount=${formattedAmount}&addInfo=dong%20qop%20quy%20vac%20xin&accountName=THANH%20TOAN%20DON%20DAT%20BAN`);
            
            // Hiển thị QR Code Modal
            qrCodeModal.show();

            // Thêm lớp mờ cho exampleModal
            exampleModal.addClass('modal-blur');

            // Khi QR Code Modal bị đóng, xóa lớp mờ
            document.getElementById('qr_code').addEventListener('hidden.bs.modal', function () {
                exampleModal.removeClass('modal-blur');
            });
        });
    });
})(jQuery);