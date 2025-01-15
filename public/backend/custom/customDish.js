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
        allReservation.each(async (index, item) => {
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


    PMD.updateInvoiceDataDetail = (objMenus, invoice_id) => {

        let data = {
            _token: _token,
            invoice_id: invoice_id,
            objMenus: objMenus
        }

        $.ajax({
            url: '/update-status-menu-invoice-detail',
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

    PMD.saveDish = (invoice_id) => {
        $(document).on('click', '.btnSaveDish', function () {
            let objMenus = {};

            // Duyệt qua tất cả các menu_id
            $('tr[data-menu-id]').each(function () {
                let menuId = $(this).data('menu-id')

                // Nếu menuId chưa có trong objMenus, khởi tạo đối tượng statusCount
                if (!objMenus[menuId]) {
                    objMenus[menuId] = { 1: 0, 2: 0, 3: 0 };
                }

                // Duyệt qua tất cả các select trong dòng hiện tại có cùng menu_id
                $(this).find('.quantityDishMenus').each(function () {
                    let quantity = parseInt($(this).text());
                    let select = $(this).siblings('td').find('select')
                    let selectedValue = select.val();
                    objMenus[menuId][selectedValue] += quantity; // Tăng số lượng món cho trạng thái đã chọn
                });
            });

            console.log(objMenus);

            PMD.updateInvoiceDataDetail(objMenus, invoice_id)

            $('#modalDish').modal('hide')

            localStorage.setItem('showSuccessMessage', 'true')

            window.location.reload()
        })
    }

    //Show Modal Data
    PMD.showBsModal = () => {
        $('#modalDish').on('show.bs.modal', async function (event) {
            var button = $(event.relatedTarget);
            if (button.length) {
                var reservationId = button.attr('dataReservationId');
            }
    
            // Biến lưu trữ dữ liệu cũ
            let previousInvoiceData = null;
    
            // Hàm cập nhật dữ liệu liên tục
            const updateInvoiceData = async () => {
                // Lấy dữ liệu mới
                let invoiceData = await PMD.getInvoiceDataDetail(reservationId);
    
                // Nếu chưa có dữ liệu cũ (lần đầu tiên mở modal), lưu dữ liệu mới vào previousInvoiceData
                if (previousInvoiceData === null) {
                    previousInvoiceData = invoiceData;
                    PMD.renderListInvoiceItem(invoiceData); // Render dữ liệu ban đầu
                    PMD.saveDish(invoiceData.invoice_id);    // Lưu dữ liệu ban đầu
                } else {
                    // So sánh dữ liệu mới và dữ liệu cũ
                    if (JSON.stringify(invoiceData) !== JSON.stringify(previousInvoiceData)) {
                        PMD.renderListInvoiceItem(invoiceData); // Render lại dữ liệu mới
                        PMD.saveDish(invoiceData.invoice_id);    // Lưu dữ liệu mới
                        previousInvoiceData = invoiceData;       // Cập nhật dữ liệu cũ
                    }
                }
    
                // Gọi lại hàm sau 5 giây nếu modal vẫn còn hiển thị
                if ($('#modalDish').is(':visible')) {
                    setTimeout(updateInvoiceData, 5000);
                }
            };
    
            // Gọi hàm ngay lập tức khi mở modal
            await updateInvoiceData();
        });
    };      
    //End Show Modal Data

    PMD.renderListInvoiceItem = async (invoiceItem) => {
        let html = '';
        let htmlTable = ''; // Khởi tạo mới biến htmlTable
    
        // Thêm thông tin bàn
        htmlTable += `<h5>Thông tin bàn: `;
        invoiceItem.list_table.forEach((table, index) => {
            htmlTable += table.name;
            if (index !== invoiceItem.list_table.length - 1) {
                htmlTable += ', ';
            }
        });
        htmlTable += `</h5>`; // Kết thúc thẻ HTML
    
        // Thêm thông tin món ăn
        await invoiceItem.invoice_item.forEach(menu => {
            let total = PMD.formatCurrency(menu.total);
            console.log(menu);
    
            Object.entries(menu.status_menu).forEach(([key, value]) => {
                if (value != 0) {
                    let optionsHtml = '';
    
                    if (key == 1) {
                        optionsHtml = `
                            <select class="form-select" data-select-key="${key}">
                                <option value="1" selected>Xác nhận</option>
                                <option value="2">Đang nấu</option>
                            </select>`;
                    } else if (key == 2) {
                        optionsHtml = `
                            <select class="form-select" data-select-key="${key}">
                                <option value="2" selected>Đang nấu</option>
                                <option value="3">Hoàn thành</option>
                            </select>`;
                    } else if (key == 3) {
                        optionsHtml = `
                            <select class="form-select" data-select-key="${key}">
                                <option value="3" selected>Hoàn thành</option>
                            </select>`;
                    }
    
                    html += `
                        <tr data-menu-id="${menu.id}" ${key == 1 ? 'class="bg_status"' : ''}> 
                            <td>${menu.name}</td>
                            <td class="text-center quantityDishMenus">${value}</td>
                            <td class="text-center">${optionsHtml}</td>
                        </tr>`;
                }
            });
        });
    
        // Ghi đè nội dung HTML thay vì thêm
        $('.infoTableDish').html(htmlTable);
        $('#array-invoice-item-detail').html(html);
    };    


    PMD.closeBSModal = () => {
        $('#modalDish').on('hidden.bs.modal', function () {
            $(this).find('#array-invoice-item-detail').html('');
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
        // PMD.saveDish()
    })
})(jQuery)
