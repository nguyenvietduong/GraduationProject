(function ($) {
    "use strict"
    var PMD = {}
    var invoices
    let urlData = 'http://localhost:3000/invoice'
    let conditionTemp = 1
    var _token = $('meta[name="csrf-token"]').attr('content')





    //Check Arrived
    PMD.selectArrived = () => {
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
                success: function (response) {
                    if (response.data.status === 'arrived') {
                        PMD.renderTdMenu()

                        $('#exampleModal').modal('show')
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

    PMD.checkArrived = () => {
        let reservation = $('.selectReservation')
        let value = reservation.find('option:selected').val()
        if (value == 'arrived') {
            PMD.renderTdMenu()
        }
    }
    //End Check Arrived



    //Fetch Data Table & Menus
    PMD.fetchAvailableTables = (numberOfGuests = null) => {
        $.ajax({
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
        data.forEach(function (table) {
            $('#availableTables').append(`
            <div class="table-info col-3 mb-4" data-table-id="${table.id}" data-table-name="${table.name[language]}">
                <p>${language === 'vi' ? 'Bàn' : 'Table'}: ${table.name[language]}</p>
                <p>${language === 'vi' ? 'Số người tối đa' : 'Capacity'}: ${table.capacity}</p>
            </div>
        `)
        })
    }

    PMD.renderListMenu = (data) => {
        data.forEach(function (menu) {
            $('#availableMenu').append(`
                <div class="menu-info col-2 mb-4" data-menu-id="${menu.id}" data-menu-name="${menu.name[language]}" data-menu-price="${menu.price[language]}">
                    <img class="my-2" src="${menu.image}" alt="" width="60px" height="60px" style="border-radius: 50%object-fit: cover">
                    <p>${menu.name[language]}</p>
                    <p>${language === 'vi' ? 'Giá' : 'Price'}: ${menu.price[language]}</p>
                </div>
            `)
        })
    }

    PMD.renderTdMenu = () => {
        let reservation = $('.tdReservation')
        let reservationId = reservation.attr('data-reservation')
        let tableId = reservation.attr('data-table')
        let dataGuest = reservation.attr('data-guest')

        let html = `
        <td>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" dataReservationId="${reservationId}" dataTableId="${tableId}" dataGuests="${dataGuest}" data-bs-target="#exampleModal">
                Order
                </button>
            </td>
        `
        return reservation.append(html)
    }
    //End Render Data Table & Menus


    //Show Modal Data
    PMD.showBsModal = () => {

        $('#exampleModal').on('shown.bs.modal', async function (event) {
            let invoiceData = await PMD.fetchData(); // Đợi cho fetchData hoàn tất

            var button = $(event.relatedTarget)
            if (button.length) {
                var reservationId = button.attr('dataReservationId')
                var tableReservation = button.attr('dataTableId')
                var guestsReservation = button.attr('dataGuests')

                $('#reservationId').val(reservationId)
                $('#guestsReservation').val(guestsReservation)


                if ($.isNumeric(guestsReservation) && guestsReservation > 0) {
                    PMD.fetchAvailableTables(guestsReservation)
                } else {
                    PMD.fetchAvailableTables()
                }
            }

            // console.log(invoiceData);


            if (invoiceData && Array.isArray(invoiceData)) {
                const invoiceDetail = invoiceData.find(item => item.reservation_id === reservationId);
                console.log(invoiceDetail);
                if (invoiceDetail) {
                    console.log("Truong hop co detail");
                    let selectedMenus = {
                        id: invoiceDetail.id,
                        reservation_id: invoiceDetail.reservation_id,
                        invoice_item: invoiceDetail.invoice_item
                    };
                    await PMD.fetchAvailableMenus()

                    PMD.renderSelectedMenus(selectedMenus)
                    conditionTemp = 2
                    selectedMenus.invoice_item.forEach(item => {
                        $('.menu-info[data-menu-id="' + item.id + '"]').addClass('selected');

                    });

                    $('#availableMenu').off('click').on('click', '.menu-info', function () {
                        $(this).toggleClass('selected')
                        const menuId = $(this).data('menu-id')
                        const menuPrice = $(this).data('menu-price')
                        const menuName = $(this).data('menu-name')

                        if ($(this).hasClass('selected')) {
                            selectedMenus.invoice_item.push({ id: menuId, name: menuName, quantity: 1, price: menuPrice, total: menuPrice }) // Initialize quantity to 1
                            console.log(selectedMenus.invoice_item);
                        } else {
                            selectedMenus.invoice_item = selectedMenus.invoice_item.filter(menu => menu.id !== menuId)
                        }

                        PMD.renderSelectedMenus(selectedMenus)

                        $('#confirmSelection').toggle(selectedMenus.invoice_item.length > 0)
                    })


                    PMD.quantityInput(selectedMenus)

                    PMD.checkButtonAddInvoice(selectedMenus, true)
                } else {
                    console.log("Truong hop khong co detail");

                    let selectedMenus = {
                        id: reservationId,
                        reservation_id: reservationId,
                        totalAmount: 0,
                        invoice_item: []
                    };

                    PMD.fetchAvailableMenus()

                    selectedMenus.invoice_item = []
                    PMD.renderSelectedMenus(selectedMenus)
                    $('#confirmSelection').hide()

                    // const totalAmount = 0

                    $('#availableMenu').off('click').on('click', '.menu-info', function () {
                        $(this).toggleClass('selected')
                        const menuId = $(this).data('menu-id')
                        const menuPrice = $(this).data('menu-price')
                        const menuName = $(this).data('menu-name')

                        // totalAmount += menuPrice

                        if ($(this).hasClass('selected')) {
                            selectedMenus.invoice_item.push({ id: menuId, name: menuName, quantity: 1, price: menuPrice, total: menuPrice }) // Initialize quantity to 1
                            selectedMenus.totalAmount += menuPrice
                        } else {
                            selectedMenus.invoice_item = selectedMenus.invoice_item.filter(menu => menu.id !== menuId)
                            selectedMenus.totalAmount -= menuPrice

                        }

                        console.log(selectedMenus);

                        PMD.renderSelectedMenus(selectedMenus)

                        $('#confirmSelection').toggle(selectedMenus.invoice_item.length > 0)
                    })
                    console.log('Sau khi them mang thi log');

                    PMD.quantityInput(selectedMenus)

                    PMD.checkButtonAddInvoice(selectedMenus)
                }
            } else {
                console.error('Dữ liệu hóa đơn không hợp lệ:', invoiceData)
                return null;
            }

        })
    }
    //End Show Modal Data

    PMD.totalAmount = (selectedMenus) => {
        selectedMenus.invoice_item.forEach(item => {

        })
    }


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

    PMD.selectedTable = () => {
        $('#availableTables').on('click', '.table-info', function () {
            $('.table-info').removeClass('selected')
            $(this).addClass('selected')
            var tableId = $(this).data('table-id')
            var tableName = $(this).data('table-name')
            return tableId, tableName
        })

    }

    PMD.checkButtonAddInvoice = (item, invoice = false) => {
        $(document).on('click', '.btnSaveInvoice', function () {
            if (invoice == true) {
                PMD.updateInvoice(item)
            } else {
                PMD.addInvoice(item)
            }
            $('#exampleModal').modal('hide')
            executeExample('success')
        })
    }

    PMD.quantityInput = (selectedMenus) => {
        $('#array-menu').on('input', '.quantity-input', function () {
            const menuId = $(this).data('menu-id')
            const newQuantity = parseInt($(this).val(), 10) || 1
            console.log(newQuantity);
            const menu = selectedMenus.invoice_item.find(item => item.id === menuId)
            const newPrice = newQuantity * menu.price
            if (menu) {
                menu.quantity = newQuantity
                menu.total = newPrice
                console.log(newPrice)
                $('.price-invoice-item-' + menu.id).html(menu.total)
            }
        })
    }


    PMD.renderSelectedMenus = (selectedMenus) => {
        $('#array-menu').empty()
        if (selectedMenus.invoice_item.length === 0) {
            PMD.checkRenderButtonAmount(false)
            conditionTemp = 1
            $('#array-menu').append('<tr><td colspan="3" class="text-center">No items selected.</td></tr>')
        } else {
            PMD.checkRenderButtonAmount()
            conditionTemp = 2
            selectedMenus.invoice_item.forEach(menu => {
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
        }
    }



    //Json Server
    PMD.fetchData = async () => {
        try {
            const response = await fetch(urlData); // Chờ phản hồi từ fetch
            if (!response.ok) {
                throw new Error('Mạng lỗi hoặc file không tồn tại.');
            }
            const data = await response.json(); // Chờ chuyển đổi phản hồi thành JSON
            return data
        } catch (error) {
            console.error('Lỗi:', error);
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
            .catch(error => console.error('Lỗi khi thêm:', error));
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
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => console.log('Cập nhật thành công:', data))
            .catch(error => console.error('Lỗi khi cập nhật:', error));
    }
    //End Json Server



    $(document).ready(function () {
        PMD.fetchData(); // Gọi hàm ini
        PMD.selectArrived()
        PMD.checkArrived()
        PMD.fetchAvailableTables()
        PMD.showBsModal()
        // PMD.showModalMenu()
        PMD.guestReservation()
        PMD.selectedTable()
    })

})(jQuery)
