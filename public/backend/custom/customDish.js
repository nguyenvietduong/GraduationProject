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

PMD.saveDish = () => {
    $(document).on('click', '.btnSaveDish', function(){
        
    })
}

    //Show Modal Data
    PMD.showBsModal = () => {
        $('#modalDish').on('show.bs.modal', async function (event) {
            var button = $(event.relatedTarget)
            if (button.length) {
                var reservationId = button.attr('dataReservationId')
            }
            
            let invoiceData = await PMD.getInvoiceDataDetail(reservationId);

            PMD.renderListInvoiceItem(invoiceData)
        })
    }
    //End Show Modal Data

    PMD.renderListInvoiceItem = async (invoiceItem) =>{
        let html = ''
            await invoiceItem.invoice_item.forEach(menu => {
                let total = PMD.formatCurrency(menu.total)
                
                Object.entries(menu.status_menu).forEach(([key, value]) => {
                    if(value != 0){
                        let optionsHtml = '';

                        if (key == 1) {
                            optionsHtml = `
                                <select name="" class="form-select" id="">
                                    <option value="1" selected>Xác nhận</option>
                                    <option value="2">Đang nấu</option>
                                    <option value="3">Hoàn thành</option>
                                </select>
                            `;
                        } else if (key == 2) {
                            optionsHtml = `
                                <select name="" class="form-select" id="">
                                    <option value="2" selected>Đang nấu</option>
                                    <option value="3">Hoàn thành</option>
                                </select>
                            `;
                        } else if (key == 3) {
                            optionsHtml = `
                                <input type="text" readonly name="" class="form-control" value="Hoàn thành" id="">
                            `;
                        }
                    
                        html += `
                        <tr>
                            <td>${menu.name}</td>
                            <td class="text-center">${value}</td>
                            <td class="text-center">${total}đ</td>
                            <td class="text-center">${optionsHtml}</td>
                        </tr>`;
                    }
                })

            })
            $('#array-invoice-item-detail').append(html)
    }


    PMD.closeBSModal = () => {
        $('#modalDish').on('hidden.bs.modal', function () {
            $('.table-info').removeClass('cursor-not-allowed')
        })
    }


    PMD.showSuccessMessage = () => {
        if (localStorage.getItem('showSuccessMessage') === 'true') {
            executeExample('success')
            localStorage.removeItem('showSuccessMessage') // Xóa sau khi hiển thị
        }
    }

    PMD.formatCurrency = (number) => {
        return number.toLocaleString();
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

    //End Show Modal Data
    $(document).ready(function () {
        PMD.showSuccessMessage()
        PMD.checkInvoiceDetail()
        PMD.showBsModal()
        PMD.closeBSModal()
    })
})(jQuery)
