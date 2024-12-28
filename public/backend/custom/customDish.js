(function ($) {
    "use strict"
    var PMD = {}
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
            let array = response
            return array;
        } catch (error) {
            console.error(error);
            throw error;
        }
    };

    PMD.checkInvoiceDetail = () => {
        let allReservation = $('.selectReservation')
        allReservation.each( async (index, item) => {
            let tdReservation = $(item).attr('data-account-id')
            let reservation = $('.tdReservation-' + tdReservation)
            let reservationId = reservation.attr('data-reservation')
            console.log(reservationId);
            
            let invoiceDetail = await PMD.getInvoiceDataDetail(reservationId)

            if (invoiceDetail && Object.keys(invoiceDetail).length > 0) {
                let html = `
                    <td>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        dataReservationId="${reservationId}" data-bs-target="#modalDish">
                            Xem danh sách
                        </button>
                    </td>
                `;
                return reservation.append(html);
            }

        })
        
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
                    // executeExample('success')
                },
                error: function (xhr, status, error) {
                    executeExample('error')
                }
            })
        }
    }

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


    PMD.closeBSModal = () => {
        $('#modalDish').on('hidden.bs.modal', function () {
            $('.table-info').removeClass('cursor-not-allowed')
        })
    }

    //Show Modal Data
    PMD.showBsModal = () => {
        $('#modalDish').on('show.bs.modal', async function (event) {
            var button = $(event.relatedTarget)
            if (button.length) {
                var reservationId = button.attr('dataReservationId')
            }
            console.log(12345);
            
            let invoiceData = await PMD.getInvoiceDataDetail(reservationId);
            console.log(invoiceData);

            PMD.renderListInvoiceItem(invoiceData)
            
        })
    }
    //End Show Modal Data

    PMD.renderListInvoiceItem = async (invoiceItem) =>{
        let html = ''
            await invoiceItem.invoice_item.forEach(menu => {
                let total = PMD.formatCurrency(menu.total)
                html += `
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
                `
                if (menu.is_served == 1) {
                    html += `
                    <td class="text-center"><input class="served-checkbox" checked disabled data-served-id="${menu.id}" type="checkbox" name="" id=""></td>
                    </tr>
                    `
                } else {
                    html += `
                    <td class="text-center"><input class="served-checkbox" data-served-id="${menu.id}" type="checkbox" name="" id=""></td>
                    </tr>
                    `
                }
            })
            $('#array-invoice-item-detail').append(html)
    }


    //Start Render Button Amount
    PMD.checkRenderButtonAmount = (condition = true, invoice = false) => {
        if (condition == true) {
            if (conditionTemp == 1) {
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



    PMD.showSuccessMessage = () => {
        if (localStorage.getItem('showSuccessMessage') === 'true') {
            executeExample('success')
            localStorage.removeItem('showSuccessMessage') // Xóa sau khi hiển thị
        }
    }

    PMD.formatCurrency = (number) => {
        return number.toLocaleString();
    }


    //End Show Modal Data
    $(document).ready(function () {
        PMD.showSuccessMessage()
        PMD.checkInvoiceDetail()
        PMD.showBsModal()
        PMD.closeBSModal()
    })
})(jQuery)
