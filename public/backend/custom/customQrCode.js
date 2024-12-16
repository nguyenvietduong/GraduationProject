function confirm_pay_qrCode() {
    let userConfirm = confirm('Vui lòng xác nhận lại lần nữa!');
    if (!userConfirm) return;

    var reservationId = $('#btn-reservation-id').data('reservation-id');
    var voucherId = $('#voucher-discount').data('id-vouchar') || null;
    var totalPayment = $('.total-payment').html();
    let formattedAmount = totalPayment.replace(/[^0-9]/g, '');
    let csrfToken = $('meta[name="csrf-token"]').attr('content');

    if (!csrfToken) {
        console.error('CSRF token not found!');
        return;
    }

    let newTab = window.open('', '_blank'); // Open a blank tab immediately

    $.ajax({
        url: '/admin/invoice/store',
        type: 'POST',
        data: {
            reservation_id: reservationId,
            voucher_id: voucherId,
            total_payment: formattedAmount,
            payment_method: 'bank',
            _token: csrfToken
        },
        success: function(response) {
            if (response.error) {
                alert(response.error);
                setTimeout(() => location.reload(), 1000);
                return;
            }

            if (response.success) {
                $.ajax({
                    url: "/admin/invoice/exportPDF",
                    method: "POST",
                    data: {
                        reservation_id: reservationId,
                        _token: csrfToken
                    },
                    success: function(response) {
                        if (response.success) {
                            const pdfUrl = response.pdfUrl;
                            if (newTab) {
                                newTab.location.href = pdfUrl; // Redirect the new tab
                            }
                        } else {
                            if (newTab && !newTab.closed) newTab.close(); // Close the tab if export fails
                            alert('Error generating or saving the invoice.');
                        }
                    },
                    error: function(xhr, status, error) {
                        if (newTab && !newTab.closed) newTab.close(); // Close the tab if an error occurs
                        console.error('Error:', error);
                    }
                });
                setTimeout(() => location.reload(), 1000);
            }
        },
        error: function(xhr, status, error) {
            console.error('Error:', error);
        }
    });
}

(function ($) {
    $(document).ready(function () {
        $('.btn_qr_code').on('click', function () {
            var qrCodeModal = new bootstrap.Modal(document.getElementById('qr_code'));
            var exampleModal = $('#pay');
            var qrCodeImage = $('#qr-code-image');
            var totalPayment = $('.total-payment').html();
            let formattedAmount = totalPayment.replace(/[^0-9]/g, '');

            if (!formattedAmount || formattedAmount === '0') {
                alert('Vui lòng chọn món để được thanh toán!');
                return;
            }

            qrCodeImage.attr('src', `https://img.vietqr.io/image/TCB-19073092061017-compact2.jpg?amount=${formattedAmount}&addInfo=thanh-%20toan%20don%20hang%20&accountName=THANH%20TOAN%20DON%20DAT%20BAN`);
            qrCodeModal.show();
            exampleModal.addClass('modal-blur');

            $('#qr_code').one('hidden.bs.modal', function () {
                exampleModal.removeClass('modal-blur');
            });
        });
    });
})(jQuery);
