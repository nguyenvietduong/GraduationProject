(function ($) {
    "use strict"
    var PMD = {}
    var TC = {}
    var invoices
    let urlData = 'http://localhost:3000/invoice'
    let conditionTemp = 1
    var _token = $('meta[name="csrf-token"]').attr('content')



    //Check Arrived
    PMD.selectArrived = async () => {
        $(document).on('change', '.selectReservation', function (e) {
            let selectedValue = $(this).val()
            let accountId = $(this).attr('data-account-id')
            let data = {
                _token: _token,
                id: accountId,
                status: selectedValue
            }
            $.ajax({
                url: '/admin/reservation/updateStatus',
                type: 'POST',
                data: data,
                success: async function (response) {
                    if (response.data.status === 'arrived') {
                        await PMD.renderTdMenu(accountId)
                        await PMD.renderSelectArrived(accountId)
                        // $('#exampleModal').modal('show')
                    }
                    executeExample('success')
                },
                error: function (xhr, status, error) {
                    executeExample('error')
                }
            })
            e.preventDefault()
        })
    }

    PMD.checkArrived = async () => {
        let reservation = $('.selectReservation')
        reservation.each((index, item) => {
            let value = $(item).find('option:selected').val()
            let reservationSelectId = $(item).attr('data-account-id')
            if (value == 'arrived') {
                PMD.renderTdMenu(reservationSelectId)
            }
        })
    }

    PMD.renderSelectArrived = async (accountId) => {
        // Chọn tất cả các phần tử select với lớp selectReservation và có data-account-id tương ứng
        let reservation = $('.selectReservation[data-account-id="' + accountId + '"]');

        // Xóa tất cả các option hiện có trong select
        reservation.empty();

        // Tạo HTML cho option "Đã đến"
        let html = `
            <option value="arrived" selected>
                Đã đến
            </option>
        `;

        // Thêm option "Đã đến" vào select
        reservation.append(html);
    };
    //End Check Arrived



    //Fetch Data Table & Menus
    PMD.fetchAvailableTables = async (numberOfGuests = null) => {
        await $.ajax({
            url: '/get-available-tables',
            type: 'GET',
            data: {
                guests: numberOfGuests
            },
            success: function (response) {
                $('#availableTables').empty()
                let data = response.tables
                if (data && data.length > 0) {
                    PMD.renderListTable(data)
                } else {
                    $('#availableTables').html(`<p>${language === 'vi' ? 'Không có bàn nào phù hợp.' : 'No tables are available.'}</p>`)
                }
            },
            error: function () {
                $('#availableTables').html(`<p>${language === 'vi' ? 'Có lỗi xảy ra khi lấy thông tin bàn.' : 'An error occurred while retrieving table information.'}`)
            }
        })
    }

    PMD.fetchAvailableMenus = async (numberOfGuests = null) => {
        await $.ajax({
            url: '/get-available-menus',
            type: 'GET',
            data: {
                guests: numberOfGuests
            },
            success: function (response) {
                $('#availableMenu').empty()
                let data = response.menus
                if (data && data.length > 0) {
                    PMD.renderListMenu(data)
                } else {
                    $('#availableMenus').html(`<p>${language === 'vi' ? 'Không có món ăn nào phù hợp.' : 'No dishes match.'}</p>`)
                }
            },
            error: function () {
                $('#availableMenus').html(`<p>${language === 'vi' ? 'Có lỗi xảy ra khi lấy thông tin món ăn.' : 'An error occurred while retrieving dish information.'}</p>`)
            }
        })
    }
    //Fetch Data Table & Menus



    //Render Data Table & Menus
    PMD.renderListTable = (data) => {
        let disable
        data.forEach(function (table) {
            (table.status == 'occupied') ? disable = 'disableTable' : disable = ''
            $('#availableTables').append(`
            <div class="table-info col-3 mb-4 ${disable}" data-table-id="${table.id}" data-table-name="${table.name}">
                <p>Bàn: ${table.name}</p>
                <p>Số người tối đa: ${table.capacity}</p>
            </div>
        `)
        })
    }

    PMD.renderListMenu = (data) => {
        data.forEach(function (menu) {
            $('#availableMenu').append(`
                <div class="menu-info col-2 mb-4" data-menu-id="${menu.id}" data-menu-name="${menu.name}" data-menu-price="${menu.price}">
                    <img class="my-2" src="${menu.image}" alt="" width="60px" height="60px" style="border-radius: 50%object-fit: cover">
                    <p>${menu.name}</p>
                    <p>Giá: ${menu.price}</p>
                </div>
            `)
        })
    }

    PMD.renderTdMenu = (accountId) => {
        let reservation = $('.tdReservation-' + accountId)
        let reservationId = reservation.attr('data-reservation')
        let tableId = reservation.attr('data-table')
        let dataGuest = reservation.attr('data-guest')
        let html = `
        <td>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" 
            dataReservationId="${reservationId}" dataTableId="${tableId}" dataGuests="${dataGuest}" data-bs-target="#exampleModal">
            Đặt món
            </button>
            <button class="btn btn-warning" data-bs-toggle="modal" 
            dataReservationId="${reservationId}" data-bs-target="#pay">Thanh toán</button>
        </td>
        `
        return reservation.append(html)
    }
    //End Render Data Table & Menus



    //Show Modal Data
    PMD.showBsModal = () => {
        $('#exampleModal').on('show.bs.modal', async function (event) {
            await $('#exampleModal .nav-tabs li:first-child a').tab('show')
            let invoiceData = await PMD.fetchData()
            var button = $(event.relatedTarget)
            if (button.length) {
                var reservationId = button.attr('dataReservationId')
                var tableReservation = button.attr('dataTableId')
                var guestsReservation = button.attr('dataGuests')
                $('#reservationId').val(reservationId)
                $('#guestsReservation').val(guestsReservation)

                // if ($.isNumeric(guestsReservation) && guestsReservation > 0) {
                //     await PMD.fetchAvailableTables(guestsReservation)
                //     $('.table-info[data-table-id="' + tableReservation + '"]').addClass('selected')
                // } else {
                //     PMD.fetchAvailableTables()
                // }
            }

            if (invoiceData && Array.isArray(invoiceData)) {
                const invoiceDetail = invoiceData.find(item => item.reservation_id === reservationId)
                if (invoiceDetail) {
                    let selectedMenus = {
                        id: invoiceDetail.id,
                        reservation_id: invoiceDetail.reservation_id,
                        totalAmount: invoiceDetail.totalAmount,
                        list_table: invoiceDetail.list_table,
                        invoice_item: invoiceDetail.invoice_item
                    }
                    await PMD.fetchAvailableMenus()

                    PMD.renderSelectedMenus(selectedMenus)
                    conditionTemp = 2

                    selectedMenus.list_table.forEach(item => {
                        $('.table-info[data-table-id="' + item.id + '"]').addClass('selected')
                    })

                    selectedMenus.invoice_item.forEach(item => {
                        $('.menu-info[data-menu-id="' + item.id + '"]').addClass('selected')
                    })

                    $('#availableTables').off('click').on('click', '.table-info', function () {
                        $(this).toggleClass('selected')
                        const tableId = $(this).data('table-id')
                        const tableName = $(this).data('table-name')

                        if ($(this).hasClass('selected')) {
                            selectedMenus.list_table.push({ id: tableId, name: tableName })
                        } else {
                            selectedMenus.list_table = selectedMenus.list_table.filter(menu => menu.id !== tableId)
                        }
                        // PMD.renderSelectedMenus(selectedMenus)
                        // $('#confirmSelection').toggle(selectedMenus.invoice_item.length > 0)
                    })

                    $('#availableMenu').off('click').on('click', '.menu-info', function () {
                        $('.searchMenu').val('')

                        $(this).toggleClass('selected')
                        const menuId = $(this).data('menu-id')
                        const menuPrice = $(this).data('menu-price')
                        const menuName = $(this).data('menu-name')

                        if ($(this).hasClass('selected')) {
                            selectedMenus.invoice_item.push({ id: menuId, name: menuName, quantity: 1, price: menuPrice, total: menuPrice }) // Initialize quantity to 1
                            console.log(selectedMenus.invoice_item)
                        } else {
                            selectedMenus.invoice_item = selectedMenus.invoice_item.filter(menu => menu.id !== menuId)
                        }
                        PMD.renderSelectedMenus(selectedMenus)
                        $('#confirmSelection').toggle(selectedMenus.invoice_item.length > 0)
                    })
                    PMD.quantityInput(selectedMenus)
                    PMD.checkButtonAddInvoice(selectedMenus, tableReservation, true)
                } else {
                    let selectedMenus = {
                        id: reservationId,
                        reservation_id: reservationId,
                        totalAmount: 0,
                        list_table: [],
                        invoice_item: []
                    }
                    PMD.fetchAvailableMenus()
                    selectedMenus.invoice_item = []
                    PMD.renderSelectedMenus(selectedMenus)
                    $('#confirmSelection').hide()


                    $('#availableTables').off('click').on('click', '.table-info', function () {
                        $(this).toggleClass('selected')
                        const tableId = $(this).data('table-id')
                        const tableName = $(this).data('table-name')

                        if ($(this).hasClass('selected')) {
                            selectedMenus.list_table.push({ id: tableId, name: tableName })
                        } else {
                            selectedMenus.list_table = selectedMenus.list_table.filter(menu => menu.id !== tableId)
                        }
                        // PMD.renderSelectedMenus(selectedMenus)
                        // $('#confirmSelection').toggle(selectedMenus.invoice_item.length > 0)
                    })

                    $('#availableMenu').off('click').on('click', '.menu-info', function () {
                        $('.searchMenu').val('')
                        $(this).toggleClass('selected')
                        const menuId = $(this).data('menu-id')
                        const menuPrice = $(this).data('menu-price')
                        const menuName = $(this).data('menu-name')

                        if ($(this).hasClass('selected')) {
                            selectedMenus.invoice_item.push({ id: menuId, name: menuName, quantity: 1, price: menuPrice, total: menuPrice }) // Initialize quantity to 1
                        } else {
                            selectedMenus.invoice_item = selectedMenus.invoice_item.filter(menu => menu.id !== menuId)
                        }
                        PMD.renderSelectedMenus(selectedMenus)
                        $('#confirmSelection').toggle(selectedMenus.invoice_item.length > 0)
                    })
                    PMD.quantityInput(selectedMenus)
                    PMD.checkButtonAddInvoice(selectedMenus, tableReservation)
                }
            } else {
                console.error('Dữ liệu hóa đơn không hợp lệ:', invoiceData)
                return null
            }

        })
    }
    //End Show Modal Data



    //Start Total Amount
    PMD.totalAmount = (selectedMenus) => {
        let tempTotal = 0
        selectedMenus.invoice_item.forEach(item => {
            tempTotal += item.total
        })
        selectedMenus.totalAmount = tempTotal
        $('.total-invoice').html(selectedMenus.totalAmount)
    }
    //End Total Amount



    //Start Render Button Amount
    PMD.checkRenderButtonAmount = (condition = true, invoice = false) => {
        if (condition == true) {
            if (conditionTemp == 1) {
                let html = `<button class="btn btn-primary btnSaveInvoice">Lưu hóa đơn</button>`
                $('.modal-footer').append(html)
            }
        }
        if (condition == false) {
            $('.modal-footer').empty()
        }
    }
    //End Render Button Amount



    //Start Guest Reservation
    PMD.guestReservation = () => {
        $('#guestsReservation').on('input', function () {
            const numberOfGuests = $(this).val()
            clearTimeout($(this).data('typingTimer'))
            $(this).data('typingTimer', setTimeout(function () {
                if ($.isNumeric(numberOfGuests) && numberOfGuests > 0) {
                    PMD.fetchAvailableTables(numberOfGuests)
                } else {
                    PMD.fetchAvailableTables()
                    $('#availableTables').html('<p>Vui lòng nhập số người hợp lệ.</p>')
                }
            }, 500))
        })
    }
    //End Guest Reservation



    //Selected Table
    PMD.selectedTable = () => {
        $('#availableTables').on('click', '.table-info', function () {
            $('.table-info').removeClass('selected')
            $(this).addClass('selected')
            var tableId = $(this).data('table-id')
            var tableName = $(this).data('table-name')
            return tableId, tableName
        })
    }
    //End Selected Table



    //Button Add Invoice
    PMD.checkButtonAddInvoice = (item, tableId, invoice = false) => {
        $(document).on('click', '.btnSaveInvoice', function () {
            PMD.checkTableSelected(tableId, item.reservation_id)
            if (invoice == true) {
                PMD.updateInvoice(item)
            } else {
                PMD.addInvoice(item)
            }
            $('#exampleModal').modal('hide')
            executeExample('success')
        })
    }
    //End Button Add Invoice



PMD.searchMenuItem = () => {
    $(document).on('keyup', '.searchMenu', function(){
        console.log(123123);
    })
}



//Check Table Selected
    PMD.checkTableSelected = (tableId, reservationId) => {
        let selectedTableId = $('.table-info.selected').attr('data-table-id')
        if (tableId != selectedTableId) {
            let option = {
                _token: _token,
                reservation_id: reservationId,
                table_id: selectedTableId
            }
            $.ajax({
                url: '/admin/reservation/updateTableStatus',
                type: 'POST',
                data: option,
                success: function (response) {
                    console.log("Update Success!")
                },
                error: function (xhr, status, error) {
                    console.log('Error:' + error)
                }
            })
        }
    }



    //Quantity Input
    PMD.quantityInput = (selectedMenus) => {
        $('#array-menu').on('input', '.quantity-input', function () {
            const menuId = $(this).data('menu-id')
            const newQuantity = parseInt($(this).val(), 10) || 1
            const menu = selectedMenus.invoice_item.find(item => item.id === menuId)
            const newPrice = newQuantity * menu.price
            if (menu) {
                menu.quantity = newQuantity
                menu.total = newPrice
                $('.price-invoice-item-' + menu.id).html(menu.total)
                PMD.totalAmount(selectedMenus)
            }
        })
    }
    //End Quantity Input



    //Start Render Selected Menu
    PMD.renderSelectedMenus = async (selectedMenus) => {
        $('#array-menu').empty()
        if (selectedMenus.invoice_item.length === 0) {
            PMD.checkRenderButtonAmount(false)
            conditionTemp = 1
            $('#array-menu').append('<tr><td colspan="3" class="text-center">No items selected.</td></tr>')
        } else {
            PMD.checkRenderButtonAmount()
            conditionTemp = 2
            await selectedMenus.invoice_item.forEach(menu => {
                $('#array-menu').append(`
                    <tr>
                        <td>${menu.name}</td>
                        <td>
                            <input type="number" class="quantity-input" data-menu-id="${menu.id}" min="1" value="${menu.quantity}">
                        </td>
                        <td class="price-invoice-item-${menu.id}">${menu.total}</td>
                    </tr>
                `)
            })
            $('#array-menu').append(`
            <tr>
                <td>Tổng hóa đơn: <span class="total-invoice">0</span></td>
            </tr>
            `)
            PMD.totalAmount(selectedMenus)
        }
    }
    //End Render Selected Menu



    //Json Server
    PMD.fetchData = async () => {
        try {
            const response = await fetch(urlData)
            if (!response.ok) {
                throw new Error('Mạng lỗi hoặc file không tồn tại.')
            }
            const data = await response.json()
            return data
        } catch (error) {
            console.error('Lỗi:', error)
        }
    }

    PMD.addInvoice = (item) => {
        fetch(urlData, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(item)
        })
            .then(response => response.json())
            .then(data => console.log('Thêm thành công:', data))
            .catch(error => console.error('Lỗi khi thêm:', error))
    }

    PMD.updateInvoice = (item) => {
        fetch(`${urlData}/${item.reservation_id}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(item)
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`)
                }
                return response.json()
            })
            .then(data => console.log('Cập nhật thành công:', data))
            .catch(error => console.error('Lỗi khi cập nhật:', error))
    }
    //End Json Server

    



    // future payment

    TC.fetchInvoiceDetail = async (url) => {
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

    TC.fetchVoucher = async (url) => {
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

    TC.renderMenuItem = async (menuItems) => {
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
                        <td class="price-invoice-item-${menu.id}">${menu.total}</td>
                    </tr>
                `)
            })
        }
    }
    TC.addInvoice = (data) => {

        fetch("http://graduationproject.test/admin/invoice/store", {
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

    TC.exportAndSavePDF = (data) => {
        fetch("http://graduationproject.test/admin/invoice/exportPDF", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Mở URL của file PDF đã lưu trong tab mới
                    window.open(data.file_url, '_blank');
                } else {
                    alert('Lỗi khi tạo và lưu hóa đơn.');
                }
                console.log(data);

            })
            .catch(error => console.error('Lỗi khi thêm:', error));
    }
    //Show Modal Data
    TC.showBsModal = () => {
        $('#pay').on('show.bs.modal', async function (event) {
            var button = $(event.relatedTarget)
            let reservationId;
            let invoiceDetail;

            if (button.length) {
                reservationId = button.attr('dataReservationId')
                invoiceDetail = await TC.fetchInvoiceDetail(`${urlData}?reservation_id=${reservationId}`)
                console.log(invoiceDetail);
                TC.renderMenuItem(invoiceDetail);
            }
            let voucher_discount = 0;
            let code;

            $('#pay').find('.btn_paid').attr('id', `btn_paid_${reservationId}`);

            let total_amount = invoiceDetail[0].totalAmount;
            let total_payment = invoiceDetail[0].totalAmount;
            $('#pay').find('.total-amount').text(total_amount)
            $('#pay').find('.total-payment').text(total_payment)
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
                let voucher = await TC.fetchVoucher(`/checkVoucher?code=${inputVoucher}&totalAmount=${total_amount}`);
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
                    console.log(total_payment);

                    $('#pay').find('.voucher-discount').text(voucher_discount);
                    $('#pay').find('.total-payment').text(total_payment);
                } else {
                    $('#pay').find('.voucher-discount').text('0');
                    $('#pay').find('.total-payment').text(total_amount);
                    feedback.text("Mã giảm giá không hợp lệ").css("color", "red");
                }
            });

            // $("#btn_voucher").click(async (e) => {
            //     let input_voucher = $("#input_voucher");
            //     let feedback_voucher = $("#feedback_voucher");
            //     voucher = await TC.fetchVoucher(`/checkVoucher?code=${input_voucher.val()}&totalAmount=${invoiceDetail[0].totalAmount}`);
            //     console.log(voucher);
            //     if (voucher[0]) {
            //         input_voucher.addClass("is-valid");
            //         feedback_voucher.addClass("valid-feedback");
            //         feedback_voucher.text("Mã giảm giá hợp lệ");


            //         total_payment = (voucher[0].type == "fixed")
            //             ? invoiceDetail[0].totalAmount - voucher[0].discount
            //             : invoiceDetail[0].totalAmount - (((invoiceDetail[0].totalAmount / 100 * voucher[0].discount)
            //                 >= voucher[0].max_discount) ? voucher[0].max_discount : (invoiceDetail[0].totalAmount / 100 * voucher[0].discount));


            //         $("#total_payment").text(`${total_payment}`)
            //         $("#voucher").text(`${(voucher[0].type == "fixed")
            //             ? voucher[0].discount
            //             : ((invoiceDetail[0].totalAmount / 100 * voucher[0].discount)
            //                 >= voucher[0].max_discount) ? voucher[0].max_discount : (invoiceDetail[0].totalAmount / 100 * voucher[0].discount)}`)
            //     } else {
            //         input_voucher.addClass("is-invalid");
            //         feedback_voucher.addClass("invalid-feedback");
            //         feedback_voucher.text("Mã giảm giá không hợp lệ");
            //     }
            // })
            $(`#btn_paid_${reservationId}`).off('click').click((e) => {
                let payment_method = $('input[name="payment_method"]:checked').val();
                let data = {
                    _token: _token,
                    ...invoiceDetail[0],
                    total_payment,
                    payment_method,
                    voucher_discount,
                    code
                }
                $('#pay').modal('hide'),

                    TC.addInvoice(data)
                TC.exportAndSavePDF(data)
                setTimeout(() => {
                    window.location.reload();
                }, 3000)
            });

        })
        $('#pay').on('hidden.bs.modal', function () {
            // Đặt lại các giá trị giảm giá
            $('#pay').find('.input-voucher').val('');
            $('#pay').find('.feedback-voucher').text('');
            $('#pay').find('.voucher-discount').text(0);  // Đặt lại giảm giá về 0
            $('#pay').find('.total-payment').text(totalAmount); // Đặt lại tổng thanh toán về tổng hóa đơn
        });
    }

    //End Show Modal Data
    $(document).ready(function () {
        PMD.fetchData()
        PMD.selectArrived()
        PMD.checkArrived()
        PMD.fetchAvailableTables()
        PMD.showBsModal()
        PMD.guestReservation()
        PMD.searchMenuItem()
        PMD.selectedTable()
        TC.showBsModal()
    })
})(jQuery)
