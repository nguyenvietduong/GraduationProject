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


    CUONG.cancelReservation = (data) => {
        let invoiceId = (data.invoice == null) ? '' : data.invoice.id
        let option = {
            _token: _token,
            reservation_id: data.reservation.id,
            invoice_id: invoiceId,
            reservation_detail: data.reservation.reservation_details,
            invoiceDetails: data
        }

        console.log(option);

        $.ajax({
            url: '/cancel-reservation-payment',
            type: 'POST',
            data: option,
            success: async function (response) {
                if (response.success === true) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Thành công!',
                        text: response.message,
                    }).then(() => {
                        window.location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Thất bại!',
                        text: response.message,
                    });
                }
            },
            error: function (xhr, status, error) {
                let errorMessage = 'Đã xảy ra lỗi. Vui lòng thử lại.';

                // Kiểm tra nếu server trả về message cụ thể
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMessage = xhr.responseJSON.message;
                }

                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi!',
                    text: errorMessage,
                });
            }
        })
    }


    CUONG.renderMenuItem = async (menuItems) => {
        console.log(menuItems);
        $('#list_menu_item').empty()

        if (menuItems.invoice == null) {
            $('#list_menu_item').append('<tr><td colspan="3" class="text-center">No items selected.</td></tr>')
        } else {
            await menuItems.invoice.invoice_items.forEach(item => {
                $('#list_menu_item').append(`
                    <tr>
                        <td>${item.menu.name}</td>
                        <td>
                            <span>${item.quantity}</span>
                        </td>
                        <td class="price-invoice-item-${item.id}">${formatNumber(item.menu.price * item.quantity)}</td>
                    </tr>
                `)
            })
            $('#list_menu_item').append(`
                <tr style="background-color: burlywood" data-reservation-id-payment="${menuItems.reservation.id}">
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
                            <small class="m-0">Mô tả: ${voucher.description}</small> <br>
                            <small>Số lượng: ${(voucher.total - voucher.promotion_users.length) <= 0 ? 0 : voucher.total - voucher.promotion_users.length}</small>
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
                            <small class="m-0">Mô tả: ${voucher.description}</small> <br>
                            <small >Số lượng: ${(voucher.total - voucher.promotion_users.length) <= 0 ? 0 : voucher.total - voucher.promotion_users.length}</small>
                        </div>
                    </div>
                `)
            })
        }
    }
    CUONG.addInvoice = (data) => {
        $.ajax({
            url: "/admin/invoice/store",
            method: "POST",
            headers: {
                'Content-Type': 'application/json'
            },
            data: JSON.stringify(data),
            success: function (response) {
                if (response.success === true) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Thành công!',
                        text: response.message,
                    }).then(() => {
                        window.location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Thất bại!',
                        text: response.message,
                    }).then(() => {
                        window.location.reload();
                    });
                }
            },
            error: function (xhr, status, error) {
                let errorMessage = 'Đã xảy ra lỗi. Vui lòng thử lại.';

                // Kiểm tra nếu server trả về message cụ thể
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMessage = xhr.responseJSON.message;
                }

                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi!',
                    text: errorMessage,
                }).then(() => {
                    window.location.reload();
                });
            }
        });
    }

    CUONG.exportAndSavePDF = (reservationId) => {
        $.ajax({
            url: "/admin/invoice/exportPDF",
            method: "POST",
            data: {
                reservation_id: reservationId,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                console.log(response);
                if (response.success) {
                    const pdfUrl = response.pdfUrl;

                    // Mở PDF trong một tab mới
                    window.open(pdfUrl, '_blank');
                } else {
                    alert('Lỗi khi tạo và lưu hóa đơn.');
                }
            },
            error: function (xhr, status, error) {
                console.error('Error:', error);
            }
        });
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
                $("#idDonhang").attr("idDonHang", invoiceDetail.reservation.id);
                let voucher_discount = 0;
                let code;
                $('#pay').find('.btn_paid').attr('id', `btn_paid_${reservationId}`);
                $('#pay').find('.btn_cancel_reservation').attr('id', `btn_cancel_reservation_${reservationId}`);

                let total_amount = 0
                let total_payment = 0

                if (invoiceDetail.invoice) {
                    total_amount = invoiceDetail.invoice.total_amount
                    total_payment = invoiceDetail.invoice.total_amount
                }

                $('#pay').find('.total-amount').text(formatNumber(total_amount))
                $('#pay').find('.total-payment').text(formatNumber(total_payment))

                // $('input[name="payment_method"]').on('change', function () {
                //     if ($(this).val() === 'bank') {
                //         $('#qr-image').show(); // Hiển thị hình ảnh QR khi chọn "Chuyển khoản"
                //     } else {
                //         $('#qr-image').hide(); // Ẩn hình ảnh QR khi chọn phương thức khác
                //     }
                // });
                let allVoucher = await CUONG.fetchVoucher(`/getAllVoucher`);
                CUONG.renderAllVoucher(allVoucher);
                let feedback = $('#pay').find('.feedback-voucher');

                $('#pay').on('click', '.btn-apply-voucher', async function () {
                    let inputVoucher = $('#pay').find('.input-voucher').val();
                    let voucher = await CUONG.fetchVoucher(`/searchVoucher?code=${inputVoucher}`);
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
                            if (total_payment <= 0 && dataVoucher.type == 'fixed') {
                                total_payment = 0
                                voucher_discount = voucher_discount - total_amount
                            }
                            $('#pay').find('.voucher-discount').text(`Giảm giá : ${formatNumber(voucher_discount)}`);
                            $('#pay').find('.voucher-discount').attr('data-id-vouchar', selectedVoucherId);
                            $('#pay').find('.voucher-discount').show();
                            $('#pay').find('.total-payment').text(formatNumber(total_payment));
                        }
                    }
                });
                $(`#btn_paid_${reservationId}`).off('click').click(async (e) => {
                    if (total_amount == 0 && total_payment == 0) {
                        alert('Vui lòng chọn món để được thanh toán!')
                        return
                    }

                    let checkDish = true

                    await invoiceDetail.invoice.invoice_items.forEach(menu => {
                        let hasKey1 = false;
                        let hasKey2 = false;

                        Object.entries(JSON.parse(menu.status_menu)).forEach(([key, value]) => {
                            if (key == 1 && value != 0) {
                                hasKey1 = true;
                            }
                            if (key == 2 && value != 0) {
                                hasKey2 = true;

                            }
                        });

                        if (hasKey1 || hasKey2) {
                            checkDish = false; // Nếu có cả key 1 và key 2 với giá trị khác 0
                        }

                    });

                    if (checkDish) {
                        let payment_method = 'cash';
                        let data = {
                            _token: _token,
                            invoiceDetail,
                            total_payment,
                            voucher_discount,
                            code,
                            payment_method
                        };

                        $('#pay').modal('hide');

                        CUONG.addInvoice(data);
                        CUONG.exportAndSavePDF(reservationId);
                        // setTimeout(() => {
                        //     window.location.reload();
                        // }, 3000);
                    } else {
                        alert('Món ăn chưa lên đầy đủ!');
                        return;
                    }
                });

                if (invoiceDetail && invoiceDetail.invoice && invoiceDetail.invoice.invoice_items != null) {
                    let checkDish = true
                    await invoiceDetail.invoice.invoice_items.forEach(menu => {
                        let hasKey1 = false;
                        let hasKey2 = false;

                        Object.entries(JSON.parse(menu.status_menu)).forEach(([key, value]) => {
                            if (key == 2 && value != 0) {
                                hasKey1 = true;
                            }
                            if (key == 3 && value != 0) {
                                hasKey2 = true;
                            }
                        });

                        if (hasKey1 || hasKey2) {
                            checkDish = false; // Nếu có cả key 1 và key 2 với giá trị khác 0
                        }
                    });

                    if (checkDish) {
                        $(`#btn_cancel_reservation_${reservationId}`).off('click').on('click', async function () {
                            if (confirm('Bạn có chắc chắn muốn hủy đơn hàng không?')) {
                                if (confirm('Đơn hàng sẽ bị hủy?')) {
                                    CUONG.cancelReservation(invoiceDetail)
                                }
                            }
                        })

                    } else {
                        $(`#btn_cancel_reservation_${reservationId}`).prop('disabled', true);
                        // alert('Món ăn đã lên hoặc đang làm, không thể hủy');
                        return;
                    }
                } else {
                    $(`#btn_cancel_reservation_${reservationId}`).prop('disabled', true);
                    return
                }



            }

        })
        $('#pay').on('hidden.bs.modal', function () {
            $('#pay').off('click', '.btn-apply-voucher');
            $('#pay').off('change', 'input[name="use_voucher"]');
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
