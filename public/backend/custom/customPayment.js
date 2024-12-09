(function ($) {
    "use strict"
    var CUONG = {}
    var invoices
    let urlData = 'http://graduationproject.test/admin/payment/'
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
    CUONG.fetchAllVoucher = async (url) => {
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
        if (menuItems.invoice.invoice_items.length === 0) {
            $('#list_menu_item').append('<tr><td colspan="3" class="text-center">No items selected.</td></tr>')
        } else {
            await menuItems.invoice.invoice_items.forEach(item => {
                $('#list_menu_item').append(`
                    <tr>
                        <td>${item.menu.name}</td>
                        <td>
                            <span>${item.quantity}</span>
                        </td>
                        <td class="price-invoice-item-${item.id}">${formatNumber(item.menu.price*item.quantity)}</td>
                    </tr>
                `)
            })
            $('#list_menu_item').append(`
                <tr style="background-color: burlywood">
                    <td colspan="2">
                        <b>Tổng hóa đơn</b>
                    </td>
                    <td><b>${formatNumber(menuItems.invoice.total_amount)}</b></td>
                </tr>
            `)
        }
    }
    CUONG.renderVoucherItem = async (voucherItems) => {
        $('#render_voucher').empty()
        if (voucherItems.length == 0) {
            $('#render_voucher').append('')
        } else {
            await voucherItems.forEach(voucher => {
                $('#render_voucher').append(`
                    <div class="col-4 d-flex gap-1 border rounded py-1">
                        <input type="radio" name="use_voucher" id="${voucher.id}">
                        <div class="div">
                            <p class="m-0">${voucher.title}</p>
                            <small>Mô tả: ${voucher.description}</small>
                        </div>
                    </div>
                `)
            })
        }
    }
    CUONG.renderAllVoucher = async (allVoucher) => {
        $('#render_voucher').empty()
        if (allVoucher.length == 0) {
            $('#render_voucher').append('')
        } else {
            await allVoucher.forEach(voucher => {
                $('#render_voucher').append(`
                    <div class="col-4 d-flex gap-1 border rounded py-1">
                        <input type="radio" name="use_voucher" id="${voucher.id}">
                        <div class="div">
                            <p class="m-0">${voucher.title}</p>
                            <small>Mô tả: ${voucher.description}</small>
                        </div>
                    </div>
                `)
            })
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
                    const pdfContent = data.pdfContent;
                    const fileName = data.fileName;

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
                invoiceDetail = await CUONG.fetchInvoiceDetail(`/admin/payment/${reservationId}`);
                CUONG.renderMenuItem(invoiceDetail);

            let voucher_discount = 0;
            let code;
            let list_tables = invoiceDetail.reservation.reservation_details;// check 
            console.log(invoiceDetail);
            $('#pay').find('.btn_paid').attr('id', `btn_paid_${reservationId}`);
            var total_amount = invoiceDetail.invoice.total_amount;
            let total_payment = invoiceDetail.invoice.total_amount;
            $('#pay').find('.total-amount').text(formatNumber(total_amount))
            $('#pay').find('.total-payment').text(formatNumber(total_payment))

            $('input[name="payment_method"]').on('change', function () {
                if ($(this).val() === 'bank') {
                    $('#qr-image').show(); // Hiển thị hình ảnh QR khi chọn "Chuyển khoản"
                } else {
                    $('#qr-image').hide(); // Ẩn hình ảnh QR khi chọn phương thức khác
                }
            });
            let allVoucher = await CUONG.fetchVoucher(`/getAllVoucher`);
            console.log(allVoucher[1].promotion_users.length);
            CUONG.renderAllVoucher(allVoucher);
            let feedback = $('#pay').find('.feedback-voucher');

            $('#pay').on('click', '.btn-apply-voucher', async function () {
                let inputVoucher = $('#pay').find('.input-voucher').val();
                let voucher = await CUONG.fetchVoucher(`/searchVoucher?code=${inputVoucher}`);
                console.log(voucher);
                
                if (voucher.length == 0) {
                    feedback.text(`Không tồn tại mã giảm giá`).css("color", "red");
                } else {
                    CUONG.renderVoucherItem(voucher);
                    feedback.text(``);
                }
            });
            $('#pay').on('change', 'input[name="use_voucher"]', async function () {
                if (this.checked) {
                    const selectedVoucherId = this.id;
                    let checkVoucher = await CUONG.fetchVoucher(`/checkVoucher?id=${selectedVoucherId}&totalAmount=${total_amount}`);
                    let dataVoucher = checkVoucher['data'];

                    if (!dataVoucher) {
                        feedback.text(`${checkVoucher.message}`).css("color", "red");
                        code = "";
                        voucher_discount = 0;
                        total_payment = total_amount;
                        $('#pay').find('.voucher-discount').hide();
                        $('#pay').find('.total-payment').text(formatNumber(total_amount));
                    } else {
                        code = dataVoucher.code;
                        feedback.text(`${checkVoucher.message}`).css("color", "green");
                        if (dataVoucher.type == 'fixed') {
                            total_payment = total_amount - dataVoucher.discount
                            voucher_discount = dataVoucher.discount
                        } else {
                            if (total_amount * dataVoucher.discount / 100 > dataVoucher.max_discount) {
                                total_payment = total_amount - dataVoucher.max_discount
                                voucher_discount = dataVoucher.max_discount
                            } else {
                                total_payment = total_amount - (total_amount * dataVoucher.discount) / 100
                                voucher_discount = (total_amount * dataVoucher.discount) / 100
                            }
                        }
                        $('#pay').find('.voucher-discount').text(`Giảm giá : ${formatNumber(voucher_discount)}`);
                        $('#pay').find('.voucher-discount').show();
                        $('#pay').find('.total-payment').text(formatNumber(total_payment));
                    }
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
        }

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
