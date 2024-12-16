$(document).ready(function () {
    // Event listener for the status change
    $(document).on('change', '.status', function () {
        var select = $(this);
        var selectedValue = select.val();
        var accountId = select.data('account-id'); // Get the correct account ID
        var data = {
            _token: csrfToken,
            id: accountId,
            status: selectedValue
        };

        $.ajax({
            url: updateStatusUrl, // URL chính xác
            type: 'POST',
            data: data,
            success: function (response) {
                executeExample('success');
        
                // Kiểm tra trạng thái trả về
                if (response.data.status === 'arrived') {
                    var idReservation = response.data.id;
                    var guestsReservation = response.data.guests;
        
                    // Gán giá trị cho input ẩn
                    $('#reservationId').val(idReservation);
                    $('#guestsReservation').val(guestsReservation);
        
                    // Hiển thị modal
                    $('#exampleModal').modal('show');
                } 
                
                // if (response.data.status === 'confirmed') {
                //     console.log("Confirmed status received. Reloading the page...");
        
                //     // Thêm log kiểm tra xem hàm có chạy tới đây không
                //     setTimeout(() => {
                //         // Reload bằng cách thay đổi href
                //         window.location.href = window.location.href;
                //     }, 1000);
                // }
            },
            error: function (xhr, status, error) {
                // Gọi hàm xử lý lỗi
                console.error("Error occurred: ", error);
                executeExample('error');
            }
        });        
    });

    // Hàm gọi AJAX để lấy các bàn trống
    function fetchAvailableTables(numberOfGuests = null) {

        $.ajax({
            url: '/get-available-tables', // Đường dẫn tới API lấy bàn trống
            type: 'GET',
            data: {
                guests: numberOfGuests // Gửi số người nếu có
            },
            success: function (response) {
                // Xóa danh sách bàn cũ
                $('#availableTables').empty();

                if (response.tables && response.tables.length > 0) {
                    // Duyệt qua danh sách bàn có sẵn và hiển thị
                    response.tables.forEach(function (table) {
                        $('#availableTables').append(`
                            <div class="table-info col-3 mb-4" data-table-id="${table.id}" data-table-name="${table.name[language]}">
                                <p>${language === 'vi' ? 'Bàn' : 'Table'}: ${table.name[language]}</p>
                                <p>${language === 'vi' ? 'Số người tối đa' : 'Capacity'}: ${table.capacity}</p>
                            </div>
                        `);
                    });
                } else {
                    $('#availableTables').html(`<p>${language === 'vi' ? 'Không có bàn nào phù hợp.' : 'No tables are available.'}</p>`);
                }
            },
            error: function () {
                $('#availableTables').html(`<p>${language === 'vi' ? 'Có lỗi xảy ra khi lấy thông tin bàn.' : 'An error occurred while retrieving table information.'}`);
            }
        });
    }

    // Hàm gọi AJAX để lấy các bàn trống
    function fetchAvailableMenus(numberOfGuests = null) {
        $.ajax({
            url: '/get-available-menus',
            type: 'GET',
            data: {
                guests: numberOfGuests // Gửi số người nếu có
            },
            success: function (response) {
                $('#availableMenu').empty();

                if (response.menus && response.menus.length > 0) {
                    // Duyệt qua danh sách bàn có sẵn và hiển thị
                    response.menus.forEach(function (menu) {
                        $('#availableMenu').append(`
                            <div class="menu-info col-2 mb-4" data-menu-id="${menu.id}" data-menu-name="${menu.name[language]}" data-menu-image="${menu.image}">
                                <img class="my-2" src="${menu.image}" alt="" width="60px" height="60px" style="border-radius: 50%;object-fit: cover;">
                                <p>${menu.name[language]}</p>
                                <p>${language === 'vi' ? 'Giá' : 'Price'}: ${menu.price[language]}</p>
                            </div>
                        `);
                    });
                } else {
                    $('#availableMenus').html(`<p>${language === 'vi' ? 'Không có món ăn nào phù hợp.' : 'No dishes match.'}</p>`);
                }
            },
            error: function () {
                $('#availableMenus').html(`<p>${language === 'vi' ? 'Có lỗi xảy ra khi lấy thông tin món ăn.' : 'An error occurred while retrieving dish information.'}</p>`);
            }
        });
    }

    $('#exampleModal').on('shown.bs.modal', function (event) {
        var button = $(event.relatedTarget); 

        if (button.length) { 
            var reservationId = button.data('reservation-id'); 
            var guestsReservation = button.data('guestsreservation'); 

            $('#reservationId').val(reservationId);
            $('#guestsReservation').val(guestsReservation);

            if ($.isNumeric(guestsReservation) && guestsReservation > 0) {
                fetchAvailableTables(guestsReservation);
            } else {
                fetchAvailableTables(); 
            }
        } else {
            var initialGuests = $('#guestsReservation').val();

            if ($.isNumeric(initialGuests) && initialGuests > 0) {
                fetchAvailableTables(initialGuests);
            } else {
                fetchAvailableTables();
            }
        }

        // Listen for user input on the guest reservation field
        $('#guestsReservation').on('input', function () {
            const numberOfGuests = $(this).val();

            // Clear any existing timers on the element itself
            clearTimeout($(this).data('typingTimer'));

            // Set a new timer and store it on the element
            $(this).data('typingTimer', setTimeout(function () {
                if ($.isNumeric(numberOfGuests) && numberOfGuests > 0) {
                    fetchAvailableTables(numberOfGuests);
                } else {
                    fetchAvailableTables();
                    $('#availableTables').html('<p>Vui lòng nhập số người hợp lệ.</p>');
                }
            }, 2000)); // 2000ms delay
        });

        $('#availableTables').on('click', '.table-info', function () {
            // Remove the 'selected' class from any other table-info elements
            $('.table-info').removeClass('selected');
            // Add the 'selected' class to the clicked element
            $(this).addClass('selected');

            var tableId = $(this).data('table-id');
            var tableName = $(this).data('table-name');

            if (tableId > 0) {
                $('#confirmTable').hide(); // This will hide the button on page load

                // Show the button based on your specific conditions
                // Example: if a table is selected
                if (tableId > 0) {
                    // Show the nextModal button if a valid table is selected
                    $('#nextModal').show();

                    $('#exampleModalToggleLabel2').text(`Chọn Món Ăn - ${tableName}`);
                    $('#idTable_').val(tableId);
                }
            }
        });
    });

    // Event listener for the modal show
    $('#exampleModalToggle2').on('shown.bs.modal', function (event) {
        // Initialize selectedMenus object
        var idTable_ = $('#idTable_').val();

        let selectedMenus = {
            idTable: idTable_, // Get the table ID
            selected_dish: [] // Initialize the selected_dish array
        };

        // Function to render selected menus in the "Món đã chọn" section
        function renderSelectedMenus() {
            $('#array-menu').empty();
            if (selectedMenus.selected_dish.length === 0) {
                $('#array-menu').append('<tr><td colspan="3" class="text-center">No items selected.</td></tr>');
            } else {
                selectedMenus.selected_dish.forEach(menu => {
                    $('#array-menu').append(`
                    <tr>
                        <td><img class="my-2" src="${menu.image}" alt="" width="40px" height="40px" style="border-radius: 50%;object-fit: cover;"></td>
                        <td>${menu.name}</td>
                        <td>
                            <input type="number" class="quantity-input" data-menu-id="${menu.id}" min="1" value="${menu.quantity}">
                        </td>
                    </tr>
                `);
                });
            }
        }

        fetchAvailableMenus();

        // Clear previously selected items
        selectedMenus.selected_dish = []; // Reset selected_dish
        renderSelectedMenus();
        $('#confirmSelection').hide();

        // Log the selectedMenus object when modal is shown
        console.log('Selected menus when modal is shown:', selectedMenus);

        // Clear and re-apply click event to avoid multiple bindings
        $('#availableMenu').off('click').on('click', '.menu-info', function () {
            $(this).toggleClass('selected');
            const menuId = $(this).data('menu-id');
            const menuImage = $(this).data('menu-image');
            const menuName = $(this).data('menu-name');

            // Add or remove item from selectedMenus based on its selection status
            if ($(this).hasClass('selected')) {
                // Add new dish to selected_dish
                selectedMenus.selected_dish.push({ id: menuId, image: menuImage, name: menuName, quantity: 1 }); // Initialize quantity to 1
            } else {
                // Remove dish from selected_dish
                selectedMenus.selected_dish = selectedMenus.selected_dish.filter(menu => menu.id !== menuId);
            }

            // Update the selected items display
            renderSelectedMenus();

            // Log the updated selectedMenus array
            console.log('Updated selected menus:', selectedMenus);

            // Toggle the visibility of the confirm button based on selected items
            $('#confirmSelection').toggle(selectedMenus.selected_dish.length > 0);
        });

        // Event listener for quantity input changes
        $('#array-menu').on('input', '.quantity-input', function () {
            const menuId = $(this).data('menu-id');
            const newQuantity = parseInt($(this).val(), 10) || 1; // Default to 1 if invalid input
            const menu = selectedMenus.selected_dish.find(item => item.id === menuId);
            if (menu) {
                menu.quantity = newQuantity; // Update the quantity
            }
            // Log after updating quantity
            console.log('Selected menus after quantity change:', selectedMenus);
        });
    });
});
