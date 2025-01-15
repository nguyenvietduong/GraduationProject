(function ($) {
    $(document).ready(function () {
        const qrCodeModal = new bootstrap.Modal(document.getElementById('qr_code'));
        const exampleModal = $('#pay');
        const qrCodeImage = $('#qr-code-image');
        const csrfToken = $('meta[name="csrf-token"]').attr('content');
        let isPaymentSuccessful = false;

        if (!csrfToken) {
            console.error('CSRF token not found!');
            return;
        }

        $('.btn_qr_code').on('click', function () {
            const totalPayment = $('.total-payment').html();
            const formattedAmount = totalPayment.replace(/[^0-9]/g, '');
            const reservationCode = $('#btn-reservation-id').data('reservation-code');

            if (!formattedAmount || formattedAmount === '0') {
                alert('Vui lòng chọn món để được thanh toán!');
                return;
            }

            const MY_BANK = {
                BANK_ID: 'MB',
                ACCOUNT_NO: '0385906406',
                INFO: `Thanh toan don dat ban${reservationCode}`
            };

            qrCodeImage.attr('src', `https://img.vietqr.io/image/${MY_BANK.BANK_ID}-${MY_BANK.ACCOUNT_NO}-compact2.jpg?amount=${formattedAmount}&addInfo=${MY_BANK.INFO}&accountName=NHA%20HANG%20HUONG%20VIET%20`);
            qrCodeModal.show();
            // exampleModal.addClass('modal-blur');

            const checkPaymentInterval = setInterval(async () => {
                if (!isPaymentSuccessful && await checkPaid(formattedAmount, MY_BANK.INFO)) {
                    clearInterval(checkPaymentInterval);
                    isPaymentSuccessful = true;
                    processPayment();
                }
            }, 1000);
        });

        exampleModal.on('hide.bs.modal', function () {
            $(this).removeClass('modal-blur');
        });

        async function checkPaid(price, content) {
            try {
                const response = await fetch("https://script.google.com/macros/s/AKfycbz0PDo8CgUaDwpzvLAuzgjn5g0xWfHTBpudE6LeD_FparLVH---BbDD7zUpoZPo11Wh1g/exec");
                
                if (!response.ok) {
                    console.error('Error with fetch:', response.status, response.statusText);
                    return false;
                }
        
                const data = await response.json();
                const lastPayment = data?.data?.[data.data.length - 1];  // Cập nhật với đúng cấu trúc
        
                if (!lastPayment) {
                    console.error('Invalid data structure or no data received:', data);
                    return false;
                }
        
                const lastPrice = lastPayment['Giá trị'];
                const lastContent = lastPayment['Mô tả'];
        
                console.log('Last payment:', lastPayment);
        
                // So sánh giá trị thanh toán và mô tả
                if (lastPrice >= price && lastContent.includes(content)) {
                    return true; // Thanh toán thành công
                }
        
                return false; // Thanh toán chưa thành công
            } catch (error) {
                console.error("Error occurred during payment check:", error);
                return false;
            }
        }        

        function processPayment() {
            const reservationId = $("#idDonhang").attr('iddonhang');
            const voucherId = $('#voucher-discount').data('id-vouchar') || null;
            const totalPayment = $('.total-payment').html();
            const formattedAmount = totalPayment.replace(/[^0-9]/g, '');

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
                success: function (response) {
                    if (response.success) {
                        const pdfUrl = response.pdfUrl;
                        window.open(pdfUrl, '_blank');
                        $('#create-reservation').modal('hide')
                        localStorage.setItem('showSuccessMessage', 'true')
                        window.location.reload()
                        // }, 3000);                   
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Error during invoice store:', error);
                }
            });

            qrCodeModal.hide();
            exampleModal.removeClass('modal-blur');
        }

    });
})(jQuery);
