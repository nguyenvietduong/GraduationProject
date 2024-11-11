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
            <li class="dropdown inline-block relative pe-1">
                <button data-dropdown-toggle="dropdown" class="dropdown-toggle align-middle inline-flex search-dropdown"
                    type="button">
                    <i data-feather="search" class="size-5 dark-icon"></i>
                    <i data-feather="search" class="size-5 white-icon text-white"></i>
                </button>
                <!-- Dropdown menu -->
                <div class="dropdown-menu absolute overflow-hidden end-0 m-0 mt-5 z-10 md:w-52 w-48 rounded-md bg-white dark:bg-slate-900 shadow dark:shadow-gray-800 hidden"
                    onclick="event.stopPropagation();">
                    <div class="relative">
                        <i data-feather="search" class="size-4 absolute top-[9px] end-3"></i>
                        <input type="text"
                            class="h-9 px-3 pe-10 w-full border-0 focus:ring-0 outline-none bg-white dark:bg-slate-900 shadow dark:shadow-gray-800"
                            name="s" id="searchItem" placeholder="Search...">
                    </div>
                </div>
            </li>

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

            <li class="inline-block ps-0.5">
                <a href="javascript:void(0)"
                    class="size-9 inline-flex items-center justify-center tracking-wide align-middle duration-500 text-base text-center rounded-full bg-amber-500 text-white">
                    <i data-feather="heart" class="h-4 w-4"></i>
                </a>
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
                    alert
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
                        const rowClass = reservation.status === 'canceled' ? 'background-color: cadetblue' : '';
                        const buttonClass = reservation.status === 'canceled' ? 'hidden' : '';

                        // Tạo chuỗi HTML
                        const rowHTML = `
                            <tr style="${rowClass}" style="">
                                <td class="border-b py-2 px-4 text-center" style="font-size: 13px">
                                    <ul>
                                        <li>${reservation.name}</li>
                                        <li>${reservation.email}</li>
                                        <li>${reservation.phone}</li>
                                    </ul>
                                </td>
                                <td class="border-b py-2 px-4 text-center" style="font-size: 13px">${reservation.guests}</td>
                                <td class="border-b py-2 px-4 text-center" style="font-size: 13px">${formattedTime}</td>
                                <td class="border-b py-2 px-4 text-center" style="font-size: 13px">
                                    ${reservationStatuses[reservation.status]}
                                </td>
                                <td class="border-b py-2 px-4 text-center" style="font-size: 13px">
                                    <button type="button" class="text-red-500 button hover:underline ${buttonClass}" onclick="cancelReservation(${reservation.id}, event)">
                                        Hủy
                                    </button>
                                </td>
                            </tr>
                        `;

                        if (reservation.status == 'confirmed') {
                            reservationTableBody.innerHTML += rowHTML;
                        } else {
                            reservationTableBody.innerHTML += rowHTML;
                        }
                    },
                    error: function(error) {
                        console.log("Error fetching reservation details:", error);
                    }
                });
            });
        }
    }
</script>
