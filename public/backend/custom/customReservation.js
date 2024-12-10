(function ($) {
    "use strict"
    var PMD = {}
    var TC = {}
    var invoices
    let urlData = 'http://localhost:3000/invoice'
    let conditionTemp = 1
    var _token = $('meta[name="csrf-token"]').attr('content')


    PMD.getInvoiceDataDetail = async (reservationId) => {
        try {
            const response = await $.ajax({
                url: '/get-invoice-item-data',
                type: 'GET',
                data: {
                    reservation_id: reservationId
                }
            });
            console.log(response); // In kết quả trong console
            return response;
        } catch (error) {
            console.error(error);
            throw error;
        }
    };


    PMD.createInvoiceDataDetail = (item, guest) => {
        let data = {
            _token: _token,
            guests_detail: guest,
            reservation_id: item.reservation_id,
            reservation_code: item.reservation_code,
            total_amount: item.totalAmount,
            list_table: item.list_table,
            invoice_item: item.invoice_item,
        }

        $.ajax({
            url: '/create-invoice-detail',
            type: 'POST',
            data: data,
            success: async function (response) {
                executeExample('success')
            },
            error: function (xhr, status, error) {
                executeExample('error')
            }
        })
    }


    PMD.updateInvoiceDataDetail = (item) => {
        let data = {
            _token: _token,
            invoice_id: item.invoice_id,
            reservation_id: item.reservation_id,
            total_amount: item.totalAmount,
            list_table: item.list_table,
            invoice_item: item.invoice_item,
        }

        $.ajax({
            url: '/update-invoice-detail',
            type: 'POST',
            data: data,
            success: async function (response) {
                executeExample('success')
            },
            error: function (xhr, status, error) {
                executeExample('error')
            }
        })
    }


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
        let reservation = $('.selectReservation[data-account-id="' + accountId + '"]')

        // Xóa tất cả các option hiện có trong select
        reservation.empty()

        // Tạo HTML cho option "Đã đến"
        let html = `
            <option value="arrived" selected>
                Đã đến cửa hàng
            </option>
        `

        // Thêm option "Đã đến" vào select
        reservation.append(html)
    }
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
            dataType: 'json', // Đảm bảo rằng response phải là JSON
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
            error: function (xhr, status, error) {
                console.error(xhr.responseText)
                console.error(`Status: ${status}, Error: ${error}`)
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
                        <img class="my-2" src="/storage/${menu.image_url}" alt="" style="width: 60px; height: 60px; border-radius: 50%; object-fit: cover;">
                        <p>${menu.name}</p>
                        <p>Giá: ${PMD.formatCurrency(menu.price)}đ</p>
                    </div>
                `).join('') : '<p>Không có menu nào</p>'}
                </div>
            </div>
        `
        })
        html += '</div>'
        html += '</div>'

        $('#availableMenu').append(html)
    }

    PMD.renderTdMenu = (accountId) => {
        let reservation = $('.tdReservation-' + accountId)
        let reservationId = reservation.attr('data-reservation')
        let tableId = reservation.attr('data-table')
        let dataGuest = reservation.attr('data-guest')
        let dataCode = reservation.attr('data-reservation-code')
        let html = `
        <td>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
            dataReservationId="${reservationId}" dataTableId="${tableId}" dataGuests="${dataGuest}" dataReservationCode="${dataCode}" data-bs-target="#exampleModal">
            Đặt món
            </button>
            <button class="btn btn-warning" data-bs-toggle="modal"
            dataReservationId="${reservationId}" data-bs-target="#pay">Thanh toán</button>
        </td>
        `
        return reservation.append(html)
    }
    //End Render Data Table & Menus

    PMD.sumTableMin = (guest = null) => {
        let tableMin = Math.ceil(guest / 6)
        return tableMin
    }

    PMD.renderNotiTable = (guest = null) => {
        let html
        let table = PMD.sumTableMin(guest)
        html = `Đơn hàng với ${guest} khách hàng. Nên chọn ${table} bàn.`
        $('#notiTable').empty()
        $('#notiTable').append(html)
    }

    PMD.closeBSModal = () => {
        $('#exampleModal').on('hidden.bs.modal', function () {
            $('.table-info').removeClass('cursor-not-allowed')
        })
    }

    //Show Modal Data
    PMD.showBsModal = () => {
        $('#exampleModal').on('show.bs.modal', async function (event) {
            await $('#exampleModal .nav-tabs li:first-child a').tab('show')
            var button = $(event.relatedTarget)
            if (button.length) {
                var reservationId = button.attr('dataReservationId')
                var tableReservation = button.attr('dataTableId')
                var guestsReservation = button.attr('dataGuests')
                var reservationCode = button.attr('dataReservationCode')
                $('#reservationId').val(reservationId)
                PMD.renderNotiTable(guestsReservation)
            }
            let invoiceData = await PMD.getInvoiceDataDetail(reservationId);
            console.log(invoiceData);

            if (invoiceData.length != []) {
                let selectedMenus = {
                    invoice_id: invoiceData.invoice_id,
                    reservation_id: invoiceData.reservation_id,
                    totalAmount: invoiceData.total_amount,
                    list_table: invoiceData.list_table,
                    invoice_item: invoiceData.invoice_item
                }


                $('.table-info').addClass('cursor-not-allowed')

                await PMD.fetchAvailableMenus()

                PMD.renderSelectedMenus(selectedMenus)
                conditionTemp = 2

                selectedMenus.list_table.forEach(item => {
                    $('.table-info[data-table-id="' + item.id + '"]').addClass('selected')
                })

                selectedMenus.invoice_item.forEach(item => {
                    $('.menu-info[data-menu-id="' + item.id + '"]').addClass('selected')
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
                return
            } else {
                let selectedMenus = {
                    reservation_id: reservationId,
                    reservation_code: reservationCode,
                    totalAmount: 0,
                    list_table: [],
                    invoice_item: []
                }
                PMD.fetchAvailableMenus()
                selectedMenus.invoice_item = []
                PMD.renderSelectedMenus(selectedMenus)
                $('#confirmSelection').hide()


                $('#availableTables').off('click').on('click', '.table-info', function () {
                    let validationTable = PMD.sumTableMin(guestsReservation)

                    if (!$(this).hasClass('selected')) {
                        // Kiểm tra nếu đã chọn đủ số lượng bàn
                        if (selectedMenus.list_table.length >= validationTable) {
                            alert(`Bạn chỉ được chọn tối đa ${validationTable} bàn.`);
                            return;
                        }
                    }

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
                return
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
        let totalAmountFormat = PMD.formatCurrency(selectedMenus.totalAmount)
        $('.total-invoice').html(totalAmountFormat)
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
                // <tr>
                //     <td colspan="3" class="text-end px-2">Tổng hóa đơn: <span class="total-invoice">0</span>đ</td>
                // </tr>
                let html = `
                <strong class="mx-3">Tổng hóa đơn: <span class="total-invoice">0</span>đ</strong>
                <button class="btn btn-primary btnSaveInvoice">Lưu hóa đơn</button>`
                $('.modal-footer-reservation').append(html)
            }
        }
        if (condition == false) {
            $('.modal-footer-reservation').empty()
        }
    }
    //End Render Button Amount



    //Button Add Invoice
    PMD.checkButtonAddInvoice = (item, guest, invoice = false) => {
        $(document).on('click', '.btnSaveInvoice', function () {
            if (invoice == true) {
                PMD.updateInvoiceDataDetail(item)

            } else {
                PMD.checkTableSelected(item, guest)
                PMD.createInvoiceDataDetail(item, guest)
            }
            $('#exampleModal').on('hidden.bs.modal', function () {
                window.location.reload()
            })
        })
    }
    //End Button Add Invoice



    PMD.searchMenuItem = async (selectedMenus) => {
        let timeout = null
        $(document).on('keyup', '.searchMenu', async function () {
            clearTimeout(timeout)
            timeout = setTimeout(async () => {
                let input = $(this).val()
                await PMD.fetchAvailableMenus(input)
                await PMD.renderSelectedMenuItem(selectedMenus)
            }, 1000)
        })
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
            $('.table-info').removeClass('selected')
        })
    }




    //Quantity Input
    PMD.quantityInput = (selectedMenus) => {
        // Xử lý khi thay đổi số lượng qua input
        $('#array-menu').on('input', '.quantity-input', function () {
            const menuId = $(this).data('menu-id');
            const newQuantity = parseInt($(this).val(), 10) || 1; // Nếu không có giá trị, mặc định là 1
            const menu = selectedMenus.invoice_item.find(item => item.id === menuId);

            if (menu) {
                if (newQuantity > 100) {
                    alert('Không được chọn quá 100 món cho mỗi loại!');
                    $(this).val(100); // Đặt giá trị tối đa là 100
                    menu.quantity = 100;
                } else {
                    menu.quantity = newQuantity;
                }

                menu.total = menu.quantity * menu.price;
                let totalFormat = PMD.formatCurrency(menu.total);
                $('.price-invoice-item-' + menu.id).html(totalFormat);
                PMD.totalAmount(selectedMenus); // Tính lại tổng số tiền
            }
        });

        // Xử lý khi nhấn nút giảm số lượng
        $('#array-menu').on('click', '.decrease-btn', function () {
            const menuId = $(this).data('menu-id');
            const input = $(`.quantity-input[data-menu-id="${menuId}"]`);
            const currentValue = parseInt(input.val(), 10);
            const menu = selectedMenus.invoice_item.find(item => item.id === menuId);

            if (menu && currentValue > 1) {
                const newQuantity = currentValue - 1;
                menu.quantity = newQuantity;
                menu.total = newQuantity * menu.price;
                input.val(newQuantity); // Cập nhật lại số lượng trong ô input
                let totalFormat = PMD.formatCurrency(menu.total);
                $('.price-invoice-item-' + menu.id).html(totalFormat);
                PMD.totalAmount(selectedMenus); // Tính lại tổng số tiền
            }
        });

        // Xử lý khi nhấn nút tăng số lượng
        $('#array-menu').on('click', '.increase-btn', function () {
            const menuId = $(this).data('menu-id');
            const input = $(`.quantity-input[data-menu-id="${menuId}"]`);
            const currentValue = parseInt(input.val(), 10);
            const menu = selectedMenus.invoice_item.find(item => item.id === menuId);

            if (menu) {
                if (currentValue >= 100) {
                    alert('Không được chọn quá 100 món cho mỗi loại!');
                    return; // Không tăng thêm số lượng
                }

                const newQuantity = currentValue + 1;
                menu.quantity = newQuantity;
                menu.total = newQuantity * menu.price;
                input.val(newQuantity); // Cập nhật lại số lượng trong ô input
                let totalFormat = PMD.formatCurrency(menu.total);
                $('.price-invoice-item-' + menu.id).html(totalFormat);
                PMD.totalAmount(selectedMenus); // Tính lại tổng số tiền
            }
        });
    };

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
                let total = PMD.formatCurrency(menu.total)
                $('#array-menu').append(`
                    <tr>
                        <td>${menu.name}</td>
                        <td class="text-center">
                            <div class="d-flex align-items-center justify-content-center">
                                <button class="btn btn-danger btn-sm decrease-btn me-2" data-menu-id="${menu.id}">-</button>
                                <input type="text" class="quantity-input form-control text-center px-3 w-50" data-menu-id="${menu.id}" min="1" value="${menu.quantity}">
                                <button class="btn btn-success btn-sm increase-btn ms-2" data-menu-id="${menu.id}">+</button>
                            </div>
                        </td>
                        <td class="text-end"><span class="price-invoice-item-${menu.id}">${total}</span>đ</td>
                    </tr>
                `)
            })
            PMD.totalAmount(selectedMenus)
        }
    }
    //End Render Selected Menu


    PMD.showSuccessMessage = () => {
        if (localStorage.getItem('showSuccessMessage') === 'true') {
            executeExample('success')
            localStorage.removeItem('showSuccessMessage') // Xóa sau khi hiển thị
        }
    }


    PMD.randomCodeReservation = () => {
        const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        let code = '';

        for (let i = 0; i < 9; i++) {
            const randomIndex = Math.floor(Math.random() * characters.length);
            code += characters[randomIndex];
        }
        return code;
    }


    //Create New Reservation
    PMD.createReservationNew = () => {
        $(document).on('click', '.btnCreateReservation', function (e) {
            e.preventDefault()
            let _this = $(this)

            let name = $('input[name="name"]').val()
            let email = $('input[name="email"]').val()
            let phone = $('input[name="phone"]').val()
            let guest = $('input[name="guest"]').val()
            let message = $('textarea[name="message"]').val()
            let code = PMD.randomCodeReservation()

            let data = {
                'code': code,
                'name': name,
                'email': email,
                'phone': phone,
                'guests': guest,
                'special_request': message
            }

            $.ajax({
                url: '/create-new-reservation',
                type: 'POST',
                data: data,
                headers: {
                    'X-CSRF-TOKEN': _token
                },
                success: async function (response) {
                    executeExample('success')
                },
                error: function (xhr, status, error) {
                    executeExample('error')
                }
            })

        })
    }

    PMD.formatCurrency = (number) => {
        return number.toLocaleString();
    }

    //End Show Modal Data
    $(document).ready(function () {
        PMD.showSuccessMessage()
        PMD.selectArrived()
        PMD.checkArrived()
        PMD.fetchAvailableTables()
        PMD.createReservationNew()
        PMD.showBsModal()
        PMD.resetSelectedTables()
        PMD.closeBSModal()
    })
})(jQuery)
