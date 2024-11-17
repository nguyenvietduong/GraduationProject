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

    PMD.fetchAvailableMenus = async (dataSearch = '') => {
        await $.ajax({
            url: '/get-available-menus',
            type: 'GET',
            data: {
                key: dataSearch
            },
            success: function (response) {
                // return
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
        let active
        let html


        html = `
        <div class="card-body pt-0">
        <ul class="nav nav-tabs" role="tablist">`

        data.forEach(function (cate) {

            cate.slug == 'bua-sang' ? active = 'active' : active = ''

            html += `  <li class="nav-item" role="presentation">
                <a class="nav-link ${active}" data-bs-toggle="tab"
                    href="#${cate.slug}" role="tab"
                    aria-selected="true">${cate.name}</a>
            </li>`
        })
        html += '</ul>'

        html += '<div class="tab-content">'
        data.forEach(function (cate) {
            cate.slug == 'bua-sang' ? active = 'active show' : active = ''
            html += `
            <div class="tab-pane p-3 ${active}" id="${cate.slug}" role="tabpanel">
                <div class="row">
                ${cate.menus && cate.menus.length > 0 ? cate.menus.map(menu => `
                    <div class="menu-info col-2 mb-4" data-menu-id="${menu.id}" data-menu-name="${menu.name}" data-menu-price="${menu.price}">
                        <img class="my-2" src="${menu.image}" alt="" style="width: 60px; height: 60px; border-radius: 50%; object-fit: cover;">
                        <p>${menu.name}</p>
                        <p>Giá: ${menu.price}</p>
                    </div>
                `).join('') : '<p>Không có menu nào</p>'}
                </div>
            </div>
        `
        })
        html += '</div>'
        html += '</div>'

        $('#availableMenu').append(html)
        // data.forEach(function (menu) {
        //     $('#availableMenu').append(`
        //         <div class="menu-info col-2 mb-4" data-menu-id="${menu.id}" data-menu-name="${menu.name}" data-menu-price="${menu.price}">
        //             <img class="my-2" src="${menu.image}" alt="" width="60px" height="60px" style="border-radius: 50%object-fit: cover">
        //             <p>${menu.name}</p>
        //             <p>Giá: ${menu.price}</p>
        //         </div>
        //     `)
        // })
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

    PMD.renderNotiTable = (guest = null) => {
        let html
        let table = Math.ceil(guest / 6)
        html = `Đơn hàng với ${guest} khác hàng. Nên chọn tối thiểu ${table} bàn.`
        $('#notiTable').empty()
        $('#notiTable').append(html)
    }

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
                PMD.renderNotiTable(guestsReservation)
            }

            if (invoiceData && Array.isArray(invoiceData)) {
                const invoiceDetail = invoiceData.find(item => item.reservation_id === reservationId)
                if (invoiceDetail) {
                    let selectedMenus = {
                        id: invoiceDetail.id,
                        reservation_id: invoiceDetail.reservation_id,
                        totalAmount: invoiceDetail.totalAmount,
                        list_table: invoiceDetail.list_table,
                        list_table_old: [],
                        invoice_item: invoiceDetail.invoice_item
                    }

                    let oldTable = invoiceDetail.list_table
                    console.log(oldTable);

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
                            selectedMenus.list_table = selectedMenus.list_table.filter(table => table.id !== tableId)
                        }
                    })

                    $('#availableMenu').off('click').on('click', '.menu-info', function () {
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
                    await PMD.searchMenuItem(selectedMenus)
                    PMD.quantityInput(selectedMenus)
                    PMD.checkButtonAddInvoice(selectedMenus, guestsReservation, true)
                } else {
                    let selectedMenus = {
                        id: reservationId,
                        reservation_id: reservationId,
                        totalAmount: 0,
                        list_table: [],
                        list_table_old: [],
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
                    })

                    $('#availableMenu').off('click').on('click', '.menu-info', function () {
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
                    PMD.searchMenuItem(selectedMenus)
                    PMD.quantityInput(selectedMenus)
                    PMD.checkButtonAddInvoice(selectedMenus, guestsReservation)
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



    PMD.deleteSearchMenu = async (selectedMenus) => {
        $('.searchMenu').val('')
        await PMD.fetchAvailableMenus()
        await PMD.renderSelectedMenuItem(selectedMenus)
    }



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



    //Button Add Invoice
    PMD.checkButtonAddInvoice = (item, guest, invoice = false) => {
        $(document).on('click', '.btnSaveInvoice', function () {
            if (invoice == true) {
                PMD.updateInvoice(item)
            } else {
                PMD.checkTableSelected(item, guest)
                PMD.addInvoice(item)
            }
            // $('#exampleModal').modal('hide')

            localStorage.setItem('showSuccessMessage', 'true');

            // Reload lại trang sau khi modal đóng
            $('#exampleModal').on('hidden.bs.modal', function () {
                window.location.reload();
            });
        })
    }
    //End Button Add Invoice



    PMD.searchMenuItem = async (selectedMenus) => {
        let timeout = null;
        $(document).on('keyup', '.searchMenu', async function () {
            clearTimeout(timeout)
            timeout = setTimeout(async () => {
                let input = $(this).val()
                await PMD.fetchAvailableMenus(input)
                await PMD.renderSelectedMenuItem(selectedMenus)
            }, 1000);
        });
    }


    PMD.renderSelectedMenuItem = async (selectedMenus) => {
        await selectedMenus.invoice_item.forEach(item => {
            $('.menu-info[data-menu-id="' + item.id + '"]').addClass('selected')
        })
    }



    //Check Table Selected
    PMD.checkTableSelected = (item, guest) => {
        let selectedTableId = item.list_table
        // let oldSelectedTable = item.list_table_old
        let reservationId = item.reservation_id

        // if (tableId != selectedTableId) {
        let option = {
            _token: _token,
            reservation_id: reservationId,
            table_id: selectedTableId,
            guest: guest
            // old_table_id: oldSelectedTable
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
        // }
    }


    PMD.resetSelectedTables = () => {
        $('#exampleModal').on('hidden.bs.modal', function () {
            $('.table-info').removeClass('selected');
        });
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
                        <td class="text-center">
                            <input type="number" class="px-3 quantity-input form-control w-50" data-menu-id="${menu.id}" min="1" value="${menu.quantity}">
                        </td>
                        <td class="price-invoice-item-${menu.id} text-end">${menu.total}đ</td>
                    </tr>
                `)
            })
            $('#array-menu').append(`
            <tr>
                
                <td colspan="3" class="text-end px-2">Tổng hóa đơn: <span class="total-invoice">0</span>đ</td>
            </tr>
            `)
            PMD.totalAmount(selectedMenus)
        }
    }
    //End Render Selected Menu


    PMD.showSuccessMessage = () => {
        if (localStorage.getItem('showSuccessMessage') === 'true') {
            executeExample('success');
            localStorage.removeItem('showSuccessMessage'); // Xóa sau khi hiển thị
        }
    }


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

    //End Show Modal Data
    $(document).ready(function () {
        PMD.showSuccessMessage()
        PMD.fetchData()
        PMD.selectArrived()
        PMD.checkArrived()
        PMD.fetchAvailableTables()
        PMD.showBsModal()
        PMD.resetSelectedTables()
    })
})(jQuery)
