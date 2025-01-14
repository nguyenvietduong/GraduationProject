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
            return response;
        } catch (error) {
            console.error(error);
            throw error;
        }
    };


    PMD.createInvoiceDataDetail = (item, guest) => {
        if (item.list_table == null) {
            alert('Vui lòng chọn bàn!');
        } else {
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
    }


    PMD.updateInvoiceDataDetail = (item) => {
        if (item.list_table == null) {
            alert('Vui lòng chọn bàn!');
        } else {

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
    }


    //Check Arrived
    PMD.selectArrived = async () => {
        $(document).on('change', '.selectReservation', function (e) {
            e.preventDefault();

            // Hiển thị spinner
            showSpinner();

            let selectedValue = $(this).val();
            let accountId = $(this).attr('data-account-id');
            let data = {
                _token: _token,
                id: accountId,
                status: selectedValue
            };

            $.ajax({
                url: '/admin/reservation/updateStatus',
                type: 'POST',
                data: data,
                success: async function (response) {
                    hideSpinner();
                    if (response.data.status === 'arrived') {
                        await PMD.renderTdMenu(accountId);
                        await PMD.renderSelectArrived(accountId);
                    }

                    if (response.data.status === 'confirmed') {
                        setTimeout(() => {
                            window.location.href = window.location.href;
                        }, 1000);
                    }

                    if (response.data.status === 'canceled') {
                        setTimeout(() => {
                            window.location.href = window.location.href;
                        }, 1000);
                    }
                    executeExample('success');
                },
                error: function (xhr, status, error) {
                    // Ẩn spinner khi có lỗi
                    spinner.style.display = 'none';
                    executeExample('error');
                }
            });
        });
    };

    function showSpinner() {
        document.querySelector('.overlay').style.display = 'block';
        document.querySelector('.spinner').style.display = 'block';
        document.querySelector('.startbar').classList.add('blur'); // Thêm lớp làm mờ startbar
        document.querySelector('.topbar').classList.add('blur'); // Thêm lớp làm mờ topbar
    }

    function hideSpinner() {
        document.querySelector('.overlay').style.display = 'none';
        document.querySelector('.spinner').style.display = 'none';
        document.querySelector('.startbar').classList.remove('blur'); // Xóa lớp làm mờ startbar
        document.querySelector('.topbar').classList.remove('blur'); // Xóa lớp làm mờ topbar
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
                // return
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
        let unactive
        let reserved
        data.forEach(function (table) {
            (table.status == 'occupied') ? disable = ' disableTable' : disable = '';
            (table.status == 'out_of_service') ? unactive = ' unactive' : unactive = '';
            (table.status == 'reserved') ? reserved = ' reserved' : reserved = ''

            $('#availableTables').append(`
            <div class="table-info col-3 mb-4${disable}${unactive}${reserved}" data-table-id="${table.id}" data-table-name="${table.name}">
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
                ${cate.menus && cate.menus.length > 0 ? cate.menus.map(menu =>
                `
                    <div class="menu-info col-2 mb-4 ${menu.status !== 'active' ? 'sold-out' : ''}" 
                    data-menu-id="${menu.id}" 
                    data-menu-name="${menu.name}" 
                    data-menu-price="${menu.price}">
                    <img class="my-2" src="/storage/${menu.image_url}" alt="" style="width: 60px; height: 60px; border-radius: 50%; object-fit: cover;">
                    <p>${menu.name}</p>
                    <p>Giá: ${PMD.formatCurrency(menu.price)}đ</p>
                    </div>
                    `
            ).join('') : '<p>Không có menu nào</p>'}
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
            <button class="btn btn-warning" data-bs-toggle="modal" id="btn-reservation-id"
            dataReservationId="${reservationId}" data-reservation-id="${reservationId}" data-reservation-code="${dataCode}" data-bs-target="#pay">Thanh toán</button>
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
            let dataItem = await PMD.getInvoiceDataDetail(reservationId);
            if (invoiceData.length != []) {
                console.log(111111);
                const dataInvoiceItem = dataItem.invoice_item
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
                    Object.entries(item.status_menu).forEach(([key, value]) => {
                        if (key == 2 && value != 0 || key == 3 && value != 0) {
                            $('.menu-info[data-menu-id="' + item.id + '"]').addClass('selected cursor-not-allowed-menu');
                        } else {
                            $('.menu-info[data-menu-id="' + item.id + '"]').addClass('selected')
                        }
                    })
                })


                $('#availableMenu').off('click').on('click', '.menu-info', function () {
                    if (!$(this).hasClass('cursor-not-allowed-menu')) {
                        $(this).toggleClass('selected')
                        const menuId = $(this).data('menu-id')
                        const menuPrice = $(this).data('menu-price')
                        const menuName = $(this).data('menu-name')

                        if ($(this).hasClass('selected')) {
                            selectedMenus.invoice_item.push({ id: menuId, name: menuName, quantity: 1, price: menuPrice, total: menuPrice, is_served: 0, status_menu_id: 'active' }) // Initialize quantity to 1
                        } else {
                            selectedMenus.invoice_item = selectedMenus.invoice_item.filter(menu => menu.id !== menuId)
                        }
                        PMD.renderSelectedMenus(selectedMenus)
                        $('#confirmSelection').toggle(selectedMenus.invoice_item.length > 0)
                    }

                })
                await PMD.searchMenuItem(selectedMenus)
                PMD.quantityInput(selectedMenus, dataInvoiceItem)

                PMD.checkButtonAddInvoice(selectedMenus, guestsReservation, true)
                return
            } else {
                console.log(22222);

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
                        selectedMenus.invoice_item.push({ id: menuId, name: menuName, quantity: 1, price: menuPrice, total: menuPrice, served: 0, status_menu_id: 'active' }) // Initialize quantity to 1
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


    PMD.checkBoxServed = (arrayItem) => {
        $('.served-checkbox').each(function () {
            if ($(this).is(':checked')) {
                let servedMenuId = $(this).data('served-id')
                const existingMenu = arrayItem.invoice_item.find(menu => menu.id === servedMenuId);
                existingMenu.is_served = 1;
            }
            return arrayItem
        });
    }



    //Button Add Invoice
    PMD.checkButtonAddInvoice = (item, guest, invoice = false) => {
        $(document).on('click', '.btnSaveInvoice', function () {
            if (item.list_table == '') {
                alert('Vui lòng chọn bàn!!');
            } else {
                if (invoice == true) {
                    PMD.getStatusDish(item)
                } else {
                    PMD.createInvoiceDataDetail(item, guest)
                }
            }
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
    PMD.quantityInput = (selectedMenus, dataInvoice = null) => {
        // Xử lý khi thay đổi số lượng qua input
        $('#array-menu').on('input', '.quantity-input', function () {
            const menuId = $(this).data('menu-id');
            const input = $(`.quantity-input[data-menu-id="${menuId}"]`);
            const menu = selectedMenus.invoice_item.find(item => item.id === menuId);
            const currentValue = menu.quantity
            const inputQuantityPrimary = $('.quantityPrimary-' + menuId)
            quantityPrimary = inputQuantityPrimary.text()
            const newQuantity = parseInt($(this).val(), 10) || 1; // Nếu không có giá trị, mặc định là 1
            const newQuantityPrimary = $(this).val() - parseInt(quantityPrimary)
            menu.quantity = newQuantity;
            menu.total = menu.quantity * menu.price;
            let totalFormat = PMD.formatCurrency(menu.total);
            $('.price-invoice-item-' + menu.id).html(totalFormat);
            inputQuantityPrimary.html(newQuantityPrimary)
            PMD.totalAmount(selectedMenus); // Tính lại tổng số tiền
        });

        // Xử lý khi nhấn nút giảm số lượng
        $(document).off('click').on('click', '.decrease-btn', function () {
            console.log("Click dec..");
            let quantityPrimary = 0
            const menuId = $(this).data('menu-id');
            const input = $(`.quantity-input[data-menu-id="${menuId}"]`);
            const inputQuantityPrimary = $('.quantityPrimary-' + menuId)
            quantityPrimary = inputQuantityPrimary.text()

            // const currentValue = parseInt(input.val(), 10);
            const menu = selectedMenus.invoice_item.find(item => item.id === menuId);
            const currentValue = menu.quantity
            if (dataInvoice != null) {
                console.log("dataInvoice " + dataInvoice);

                const dataInvoiceItem = dataInvoice.find(item => item.id === menuId)

                if (parseInt(quantityPrimary) != 0) {
                    if (menu && currentValue > 1) {
                        const newQuantity = currentValue - 1;
                        const newQuantityPrimary = quantityPrimary - 1
                        menu.quantity = newQuantity;
                        menu.total = newQuantity * menu.price;
                        input.val(newQuantity); // Cập nhật lại số lượng trong ô input
                        inputQuantityPrimary.html(newQuantityPrimary)
                        let totalFormat = PMD.formatCurrency(menu.total);
                        $('.price-invoice-item-' + menu.id).html(totalFormat);
                        PMD.totalAmount(selectedMenus); // Tính lại tổng số tiền
                    }
                } else {
                    if (menu && currentValue > 1 && dataInvoiceItem.quantity < currentValue) {
                        const newQuantity = currentValue - 1;
                        const newQuantityPrimary = quantityPrimary - 1
                        menu.quantity = newQuantity;
                        menu.total = newQuantity * menu.price;
                        input.val(newQuantity); // Cập nhật lại số lượng trong ô input
                        inputQuantityPrimary.html(newQuantityPrimary)
                        let totalFormat = PMD.formatCurrency(menu.total);
                        $('.price-invoice-item-' + menu.id).html(totalFormat);
                        PMD.totalAmount(selectedMenus); // Tính lại tổng số tiền
                    }
                }
            } else {
                if (menu && currentValue > 1) {
                    const newQuantity = currentValue - 1;
                    const newQuantityPrimary = parseInt(quantityPrimary) - 1
                    menu.quantity = newQuantity;
                    menu.total = newQuantity * menu.price;
                    input.val(newQuantity); // Cập nhật lại số lượng trong ô input
                    inputQuantityPrimary.html(newQuantityPrimary)
                    let totalFormat = PMD.formatCurrency(menu.total);
                    $('.price-invoice-item-' + menu.id).html(totalFormat);
                    PMD.totalAmount(selectedMenus); // Tính lại tổng số tiền
                }
            }


        });

        // Xử lý khi nhấn nút tăng số lượng
        $('#array-menu').off('click').on('click', '.increase-btn', function () {
            let quantityPrimary = 0

            const menuId = $(this).data('menu-id');
            const input = $(`.quantity-input[data-menu-id="${menuId}"]`);
            const inputQuantityPrimary = $('.quantityPrimary-' + menuId)
            quantityPrimary = inputQuantityPrimary.text()

            // const currentValue = parseInt(input.val(), 10);
            const menu = selectedMenus.invoice_item.find(item => item.id === menuId);
            const currentValue = menu.quantity
            // const currentValue = parseInt(input.val(), 10);
            const newQuantity = currentValue + 1;
            const newQuantityPrimary = parseInt(quantityPrimary) + 1
            menu.quantity = newQuantity;
            menu.total = newQuantity * menu.price;
            input.val(newQuantity); // Cập nhật lại số lượng trong ô input
            inputQuantityPrimary.html(newQuantityPrimary)
            let totalFormat = PMD.formatCurrency(menu.total);
            $('.price-invoice-item-' + menu.id).html(totalFormat);
            PMD.totalAmount(selectedMenus); // Tính lại tổng số tiền
        });

        // $('.btnCloseReservation').on('click', function () {
        //     alert('ajsd')
        //     newQuantity = currentValue
        // })

    };

    //End Quantity Input

    PMD.getStatusDish = (selectedMenus) => {
        $('tr[data-status-menu-id]').each(function () {
            let menuId = $(this).data('status-menu-id')

            let invoiceItem = selectedMenus.invoice_item.find(item => item.id === menuId);

            if (invoiceItem) {
                // Khởi tạo lại status_menu với giá trị mặc định
                let statusCount = { 1: 0, 2: 0, 3: 0 };

                // Duyệt qua tất cả các button có số lượng món trong dòng này
                $(this).find('.btn').each(function () {
                    // Lấy số lượng món từ text của button
                    let quantity = parseInt($(this).text());

                    // Lấy class của button để xác định trạng thái
                    let buttonClass = $(this).attr('class');
                    let selectedValue = null;

                    // Kiểm tra class để xác định trạng thái
                    if (buttonClass.includes('primary')) {
                        selectedValue = 1; // Xác nhận
                    } else if (buttonClass.includes('warning')) {
                        selectedValue = 2; // Đang nấu
                    } else if (buttonClass.includes('success')) {
                        selectedValue = 3; // Hoàn thành
                    }

                    // Cộng số lượng vào trạng thái tương ứng
                    if (selectedValue !== null) {
                        statusCount[selectedValue] += quantity;
                    }
                });

                // Cập nhật lại status_menu cho invoiceItem
                invoiceItem.status_menu = statusCount;
            }
        });


        PMD.updateInvoiceDataDetail(selectedMenus)
    }


    //Start Render Selected Menu
    PMD.renderSelectedMenus = async (selectedMenus) => {

        $('#array-menu').empty()
        if (selectedMenus.invoice_item.length === 0) {
            PMD.checkRenderButtonAmount(false)
            conditionTemp = 1
            $('#array-menu').append('<tr><td colspan="4" class="text-center">No items selected</td></tr>')
        } else {
            PMD.checkRenderButtonAmount()
            conditionTemp = 2
            let html = ''
            await selectedMenus.invoice_item.forEach(menu => {

                let total = PMD.formatCurrency(menu.total)
                if (menu.status_menu_id == 'active') {
                    html += `
                            <tr data-status-menu-id="${menu.id}">
                                <td>${menu.name}</td>
                                <td class="text-center">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <button class="btn btn-danger btn-sm decrease-btn me-2" data-menu-id="${menu.id}">-</button>
                                        <input type="text" class="quantity-input form-control" data-menu-id="${menu.id}" min="1" value="${menu.quantity}" readonly>
                                        <button class="btn btn-secondary btn-sm increase-btn ms-2" data-menu-id="${menu.id}">+</button>
                                    </div>
                                </td>
                                <td class="text-end"><span class="price-invoice-item-${menu.id}">${total}</span>đ</td>
                                <td>
                        `
                } else {
                    html += `
                        <tr data-status-menu-id="${menu.id}" class="bg_status">
                            <td>${menu.name}</td>
                            <td class="text-center">
                                <div class="d-flex align-items-center justify-content-center">
                                    <input type="text" class="quantity-input form-control" data-menu-id="${menu.id}" min="1" value="${menu.quantity}" readonly>
                                </div>
                            </td>
                            <td class="text-end"><span class="price-invoice-item-${menu.id}">${total}</span>đ</td>
                            <td>
                    `
                }

                if (menu.status_menu != null) {
                    Object.entries(menu.status_menu).forEach(([key, value]) => {
                        let type = ''
                        if (key == 1) {
                            type = 'primary quantityPrimary-' + menu.id
                        } else if (key == 2) {
                            type = 'warning'
                        } else if (key == 3) {
                            type = 'success'
                        }
                        html += `
                                <button type="button" class="btn btn-${type} btn-sm text-end">${value}</button>
                        `
                    })
                } else {
                    html += `
                                <button type="button" class="btn btn-primary btn-sm text-end quantityPrimary-${menu.id}">1</button>
                                <button type="button" class="btn btn-warning btn-sm text-end">0</button>
                                <button type="button" class="btn btn-success btn-sm text-end">0</button>
                        `
                }
                html += '</td><tr>'


            })
            $('#array-menu').append(html)
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

    PMD.showErrorMessage = () => {
        if (localStorage.getItem('showErrorMessage') === 'true') {
            executeExample('error')
            localStorage.removeItem('showErrorMessage') // Xóa sau khi hiển thị
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

            $('.errorReservation').html('')

            let _this = $(this)

            let name = $('input[name="nameAddNew"]').val()
            let email = $('input[name="emailAddNew"]').val()
            let phone = $('input[name="phoneAddNew"]').val()
            let guest = $('input[name="guestAddNew"]').val()
            let message = $('textarea[name="messageAddNew"]').val()
            let code = PMD.randomCodeReservation()
            let checked = true

            $('.errNameReservation').text('');
            $('.errEmailReservation').text('');
            $('.errPhoneReservation').text('');
            $('.errGuestReservation').text('');

            if (!name) {
                $('.errNameReservation').append('Tên khách hàng không được trống')
                checked = false
            } else if (name.length > 255) {
                $('.errNameReservation').append('Tên khách hàng không được quá 255 ký tự');
                checked = false;
            }

            if (!email) {
                $('.errEmailReservation').append('Email khách hàng không được trống')
                checked = false
            } else if (!/^\S+@\S+\.\S+$/.test(email)) {
                $('.errEmailReservation').append('Email không hợp lệ');
                checked = false;
            }

            if (!phone) {
                $('.errPhoneReservation').append('SDT khách hàng không được trống')
                checked = false
            } else if (!/^\d{10,11}$/.test(phone)) {
                $('.errPhoneReservation').append('Số điện thoại phải là số từ 10 đến 11 chữ số');
                checked = false;
            }

            if (!guest) {
                $('.errGuestReservation').append('Số lượng khách hàng không được trống')
                checked = false
            } else if (isNaN(guest) || parseInt(guest) <= 0) {
                $('.errGuestReservation').append('Số lượng khách phải là số lớn hơn 0');
                checked = false;
            } else if (isNaN(guest) || parseInt(guest) > 100) {
                $('.errGuestReservation').append('Số lượng khách không được vượt quá 100');
                checked = false;
            }

            if (checked == true) {
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
                        $('#create-reservation').modal('hide')
                        localStorage.setItem('showSuccessMessage', 'true')
                        window.location.reload()
                    },
                    error: function (xhr, status, error) {
                        executeExample('error')
                    }
                })
            }

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
