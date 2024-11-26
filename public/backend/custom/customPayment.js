(function ($) {
    "use strict"
    var CUONG = {}
    var invoices
    let urlData = 'http://localhost:3000/invoice'
    let conditionTemp = 1
    var _token = $('meta[name="csrf-token"]').attr('content')

    const formatNumber = (amount) => {
        return new Intl.NumberFormat('vi-VN').format(amount) + ' đ';
    };

    CUONG.fetchInvoiceDetail = async (url) => {
        try {
            const response = await fetch(url)
            if (!response.ok) {
                throw new Error('Mạng lỗi hoặc file không tồn tại.')
            }
            const data = await response.json()
            return data
        } catch (error) {
            console.error('Lỗi:', error)
        }
    }

    CUONG.fetchVoucher = async (url) => {
        try {
            const response = await fetch(url)
            if (!response.ok) {
                throw new Error('Mạng lỗi hoặc file không tồn tại.')
            }
            const data = await response.json()
            return data
        } catch (error) {
            console.error('Lỗi:', error)
        }
    }

    CUONG.renderMenuItem = async (menuItems) => {
        $('#list_menu_item').empty()
        if (menuItems[0].invoice_item.length === 0) {
            $('#list_menu_item').append('<tr><td colspan="3" class="text-center">No items selected.</td></tr>')
        } else {
            await menuItems[0].invoice_item.forEach(menu => {
                $('#list_menu_item').append(`
                    <tr>
                        <td>${menu.name}</td>
                        <td>
                            <span>${menu.quantity}</span>
                        </td>
                        <td class="price-invoice-item-${menu.id}">${formatNumber(menu.total)}</td>
                    </tr>
                `)
            })
            $('#list_menu_item').append(`
                <tr>
                    <td colspan="2">
                        <span>Tổng hóa đơn  </span>
                    </td>
                    <td>${formatNumber(menuItems[0].totalAmount)}</td>
                </tr>
            `)
        }
    }
    CUONG.addInvoice = (data) => {
        fetch("/admin/invoice/store", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        })
            .then(response => response.json())
            .then(data => executeExample('success'),

            )
            .catch(error => console.error('Lỗi khi thêm:', error))
    }

    CUONG.exportAndSavePDF = (data) => {
        fetch("/admin/invoice/exportPDF", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const pdfContent = data.pdfContent; // Nội dung PDF dạng Base64
                    const binary = atob(pdfContent);
                    const array = new Uint8Array(binary.length);
                    for (let i = 0; i < binary.length; i++) {
                        array[i] = binary.charCodeAt(i);
                    }

                    const blob = new Blob([array], { type: 'application/pdf' });

                    // Mở PDF trong một tab mới
                    const pdfURL = URL.createObjectURL(blob);
                    window.open(pdfURL, '_blank');
                } else {
                    alert('Lỗi khi tạo và lưu hóa đơn.');
                }
            })
            .catch(error => console.error('Lỗi khi thêm:', error));
    }
    //Show Modal Data
    CUONG.showBsModal = () => {
        $('#pay').on('show.bs.modal', async function (event) {
            var button = $(event.relatedTarget)
            let reservationId;
            let invoiceDetail;

            if (button.length) {
                reservationId = button.attr('dataReservationId')
                invoiceDetail = await CUONG.fetchInvoiceDetail(`${urlData}?reservation_id=${reservationId}`)
                CUONG.renderMenuItem(invoiceDetail);
            }
            let voucher_discount = 0;
            let code;
            let list_tables = invoiceDetail[0].list_table;
            $('#pay').find('.btn_paid').attr('id', `btn_paid_${reservationId}`);

            var total_amount = invoiceDetail[0].totalAmount;
            let total_payment = invoiceDetail[0].totalAmount;
            $('#pay').find('.total-amount').text(formatNumber(total_amount))
            $('#pay').find('.total-payment').text(formatNumber(total_payment))
            $('input[name="payment_method"]').on('change', function () {
                if ($(this).val() === 'bank') {
                    $('#qr-image').show(); // Hiển thị hình ảnh QR khi chọn "Chuyển khoản"
                } else {
                    $('#qr-image').hide(); // Ẩn hình ảnh QR khi chọn phương thức khác
                }
            });
            $('#pay').find('.btn-apply-voucher').off('click').on('click', async function () {
                let inputVoucher = $('#pay').find('.input-voucher').val();
                let feedback = $('#pay').find('.feedback-voucher');
                let voucher = await CUONG.fetchVoucher(`/checkVoucher?code=${inputVoucher}&totalAmount=${total_amount}`);

                if (voucher[0]) {
                    code = voucher[0].code;
                    feedback.text("Mã giảm giá hợp lệ").css("color", "green");
                    if (voucher[0].type == 'fixed') {
                        total_payment = total_amount - voucher[0].discount
                        voucher_discount = voucher[0].discount
                    } else {
                        if (total_amount * voucher[0].discount / 100 > voucher[0].max_discount) {
                            total_payment = total_amount - voucher[0].max_discount
                            voucher_discount = voucher[0].max_discount
                        } else {
                            total_payment = total_amount - (total_amount * voucher[0].discount) / 100
                            voucher_discount = (total_amount * voucher[0].discount) / 100
                        }
                    }
                    $('#pay').find('.voucher-discount').text(`Giảm giá : ${formatNumber(voucher_discount)}`);
                    $('#pay').find('.voucher-discount').show();
                    $('#pay').find('.total-payment').text(formatNumber(total_payment));
                } else {
                    $('#pay').find('.voucher-discount').hide();
                    $('#pay').find('.total-payment').text(formatNumber(total_amount));
                    feedback.text("Mã giảm giá không hợp lệ").css("color", "red");
                }
            });
            $(`#btn_paid_${reservationId}`).off('click').click((e) => {
                let payment_method = $('input[name="payment_method"]:checked').val();
                let data = {
                    _token: _token,
                    ...invoiceDetail[0],
                    total_payment,
                    payment_method,
                    voucher_discount,
                    code,
                    list_tables
                }

                $('#pay').modal('hide'),

                    CUONG.addInvoice(data)
                CUONG.exportAndSavePDF(data)
                setTimeout(() => {
                    window.location.reload();
                }, 3000)
            });

        })
        $('#pay').on('hidden.bs.modal', function () {
            // Đặt lại các giá trị giảm giá
            $('#pay').find('.input-voucher').val('');
            $('#pay').find('.feedback-voucher').text('');
            $('#pay').find('.voucher-discount').hide();  // Đặt lại giảm giá về 0
        });
    }

    //End Show Modal Data
    $(document).ready(function () {
        CUONG.showBsModal()
    })
})(jQuery)
