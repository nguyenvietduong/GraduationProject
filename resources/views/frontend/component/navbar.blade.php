<nav id="topnav" class="defaultscroll is-sticky">
    <div class="container relative">
        <!-- Logo container-->
        <a class="logo" href="{{ route('home') }}">
            <span class="inline-block dark:hidden">
                <img src="{{ asset('frontend/assets/images/logo-dark.png') }}" class="l-dark" alt="">
                <img src="{{ asset('frontend/assets/images/logo-light.png') }}" class="l-light" alt="">
            </span>
            <img src="{{ asset('frontend/assets/images/logo-light.png') }}" class="hidden dark:inline-block"
                alt="">
        </a>
        <!-- End Logo container-->

        <!-- Start Mobile Toggle -->
        <div class="menu-extras">
            <div class="menu-item">
                <a class="navbar-toggle" id="isToggle" onclick="toggleMenu()">
                    <div class="lines">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </a>
            </div>
        </div>
        <!-- End Mobile Toggle -->

        <!--Login button Start-->
        <ul class="buy-button list-none mb-0">
            <li class="dropdown inline-block relative ps-0.5">
                <!-- Nút đặt bàn với sự kiện onclick để mở/đóng menu thả xuống -->
                <button data-dropdown-toggle="dropdown"
                    class="dropdown-toggle size-9 inline-flex items-center justify-center tracking-wide align-middle duration-500 text-base text-center rounded-full bg-amber-500 border border-amber-500 text-white"
                    type="button" onclick="reservationHistory(event)">
                    <i data-feather="calendar" class="h-4 w-4"></i>
                </button>

                <!-- Menu thả xuống -->
                <div id="dropdownMenu"
                    class="dropdown-menu absolute end-0 m-0 mt-4 z-10 w-[400px] rounded-md bg-white dark:bg-slate-900 shadow dark:shadow-gray-800 hidden">
                    <ul class="py-3 text-start" aria-labelledby="dropdownDefault">
                        <!-- Danh sách đơn đặt bàn sẽ được thêm vào đây -->
                        <table class="w-full border-collapse text-sm">
                            <thead>
                                <tr>
                                    <th class="border-b py-2 px-4 text-center" style="font-size: 13px">Thông tin</th>
                                    <th class="border-b py-2 px-4 text-center" style="font-size: 13px">Số người</th>
                                    <th class="border-b py-2 px-4 text-center" style="font-size: 13px">Thời gian</th>
                                    <th class="border-b py-2 px-4 text-center" style="font-size: 13px">Trạng thái</th>
                                    <th class="border-b py-2 px-4 text-center" style="font-size: 13px"></th>
                                </tr>
                            </thead>
                            <tbody id="reservationTableBody" class="text-sm">
                                <!-- Các dòng dữ liệu sẽ được thêm vào đây -->
                            </tbody>
                        </table>
                    </ul>
                </div>
            </li>
        </ul>
        <!--Login button End-->

        @include('frontend.component.navigation')
        <!--end navigation-->
    </div>
    <!--end container-->
</nav>
<style>
    #dropdownMenu {
        width: 800px;
        /* Điều chỉnh theo ý muốn */
    }
</style>

<script>
    const reservationStatuses = @json(__('messages.reservation.status'));

    document.addEventListener("click", function(event) {
        const dropdown = document.getElementById("dropdownMenu");
        const reservationButton = event.target.closest("[data-dropdown-toggle='dropdown']");
    });

    function reservationHistory(event) {
        event.stopPropagation(); // Prevent click from closing the dropdown
        const dropdown = document.getElementById("dropdownMenu");
        dropdown.classList.toggle("hidden");

        if (!dropdown.classList.contains("hidden")) {
            displayReservations();
        }
    }

    function cancelReservation(reservationId, event) {
        event.stopPropagation();
        let confirmCancelReservation = confirm('Bạn có chắc chắn muốn hủy');

        if (confirmCancelReservation) {
            $.ajax({
                url: `reservation/${reservationId}/canceled`, // Sử dụng backticks `...` thay cho dấu nháy đơn
                type: 'GET',
                success: function(response) {
                    // Tìm hàng có reservationId tương ứng
                    const row = document.querySelector(`tr[data-reservation-id="${reservationId}"]`);

                    // Đổi màu hàng để biểu thị trạng thái đã hủy
                    row.style.backgroundColor = 'cadetblue';

                    // Cập nhật trạng thái thành "đã hủy"
                    row.querySelector('.status').innerText = 'Đã hủy';

                    // Ẩn nút "Hủy"
                    row.querySelector('.cancel-button').classList.add('hidden');

                    alert('Bạn đã hủy đặt bàn!');
                },
                error: function(error) {
                    console.error('Error canceling reservation:', error);
                    // Xử lý lỗi
                }
            });
        }
    }

    // Function to display reservations
    function displayReservations() {
        const reservationTableBody = document.getElementById("reservationTableBody");
        reservationTableBody.innerHTML = ""; // Clear previous rows

        // Lấy danh sách ID đơn hàng từ localStorage
        const reservationIds = JSON.parse(localStorage.getItem('myReservation')) || [];

        if (reservationIds.length === 0) {
            const emptyRow = document.createElement("tr");
            emptyRow.innerHTML = `
            <td colspan="5" class="text-center py-2 text-gray-500">Không có đơn đặt hàng</td>
        `;
            reservationTableBody.appendChild(emptyRow);
        } else {
            reservationIds.forEach(reservationId => {
                $.ajax({
                    url: `reservation/${reservationId}/detail`,
                    type: 'GET',
                    success: function(response) {
                        const reservation = response.data;

                        // Chuyển đổi thời gian thành định dạng mong muốn
                        const reservationDate = new Date(reservation.reservation_time);
                        const formattedTime = reservationDate.toLocaleString('vi-VN', {
                            hour: '2-digit',
                            minute: '2-digit',
                            second: '2-digit',
                            day: '2-digit',
                            month: '2-digit',
                            year: 'numeric'
                        });

                        // Kiểm tra trạng thái để áp dụng lớp CSS
                        const rowClass = reservation.status === 'canceled' ?
                            'background-color: cadetblue' : '';
                        const buttonClass = reservation.status === 'canceled' ? 'hidden' : '';

                        // Tạo chuỗi HTML
                        const rowHTML = `
                            <tr style="${rowClass}" data-reservation-id="${reservation.id}">
                                <td class="border-b py-2 px-4 text-center" style="font-size: 13px">
                                    <ul>
                                        <li>${reservation.name}</li>
                                        <li>${reservation.email}</li>
                                        <li>${reservation.phone}</li>
                                    </ul>
                                </td>
                                <td class="border-b py-2 px-4 text-center" style="font-size: 13px">${reservation.guests}</td>
                                <td class="border-b py-2 px-4 text-center" style="font-size: 13px">${formattedTime}</td>
                                <td class="border-b py-2 px-4 text-center status" style="font-size: 13px">
                                    ${reservationStatuses[reservation.status]}
                                </td>
                                <td class="border-b py-2 px-4 text-center" style="font-size: 13px">
                                    <button type="button" class="text-red-500 button hover:underline cancel-button ${buttonClass}" onclick="cancelReservation(${reservation.id}, event)">
                                        Hủy
                                    </button>
                                </td>
                            </tr>
                        `;

                        reservationTableBody.innerHTML += rowHTML
                    },
                    error: function(error) {
                        console.log("Error fetching reservation details:", error);
                    }
                });
            });
        }
    }
</script>
