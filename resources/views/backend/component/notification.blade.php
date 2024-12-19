<li class="dropdown topbar-item">
    <a class="nav-link dropdown-toggle arrow-none nav-icon" data-bs-toggle="dropdown" href="#" role="button"
        aria-haspopup="false" aria-expanded="false" id="notificationDropdown">
        <i class="icofont-bell-alt"></i>
        <span class="alert-badge" id="countNotificationNoRead">{{ $unreadNotificationCount }}</span>
    </a>

    <style>
        .nav-link {
            position: relative;
        }

        .alert-badge {
            position: absolute;
            bottom: -10px;
            left: calc(50% + 5px);
            transform: translateX(-50%);
            background-color: red;
            color: white;
            border-radius: 50%;
            padding: 2px 4px;
            font-size: 0.65rem;
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 0 0 5px rgba(255, 0, 0, 0.8),
                0 0 10px rgba(255, 0, 0, 0.6),
                0 0 15px rgba(255, 0, 0, 0.4);
            transition: box-shadow 0.3s ease-in-out;
        }

        @keyframes flash {

            0%,
            100% {
                transform: scale(1);
                background-color: transparent;
                /* Original color */
            }

            50% {
                transform: scale(1.2);
                background-color: green;
                /* Change to green during the flash */
            }
        }

        .flash {
            animation: flash 0.5s ease-in-out 3;
            /* Flash 3 times */
        }
    </style>

    <div class="dropdown-menu stop dropdown-menu-end dropdown-lg py-0" id="notificationMenu" style="width:350px ; border-radius: 10px">
        <h5 class="dropdown-item-text m-0 py-2 d-flex justify-content-between align-items-center "
            style="border-radius: 10px 10px 0 0; border-bottom: 1px solid #ccc"
        >
            <span class="countNotification h5">Thông báo</span>
        </h5>
        <div class="form-group px-2 pt-2 pb-2 bg-success-subtle">
            <input type="text" class="form-control mb-2" id="searchInput"
                placeholder="{{ __('messages.system.button.search') }}">
            <div class="row">
                <div class="col-3">
                    <div class="form-check">
                        <input type="radio" class="form-check-input" name="notificationStatus" id="allNotifications"
                            value="all" checked>
                        <label class="form-check-label" for="allNotifications">All</label>
                    </div>
                </div>
                <div class="col-5">
                    <div class="form-check">
                        <input type="radio" class="form-check-input" name="notificationStatus"
                            id="unreadNotifications" value="unread">
                        <label class="form-check-label" for="unreadNotifications">Chưa đọc</label>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-check">
                        <input type="radio" class="form-check-input" name="notificationStatus" id="readNotifications"
                            value="read">
                        <label class="form-check-label" for="readNotifications">Đã đọc</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="ms-0" style="max-height:400px;" data-simplebar>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="allNotification" role="tabpanel" aria-labelledby="all-tab"
                    tabindex="0">
                    <!-- Notifications will be populated here -->
                </div>
            </div>
        </div>
        <a href="" class="dropdown-item text-center text-dark fs-13"></a>
        <div class="text-center p-1">
            <button id="btn-seed-all" class="btn btn-success" style="width: 100%;">Xem hết</button>
        </div>
    </div>
</li>

<script>
    function handleDropdownClick(element) {
        const notificationId = element.getAttribute('data-id');
        const jsonStringTitle = element.getAttribute('data-title');
        const jsonStringMessage = element.getAttribute('data-message-full');
        const jsonData = JSON.parse(jsonStringMessage);

        const title = jsonStringTitle;
        const reservationId = jsonData.id;
        const name = jsonData.name;
        const phone = jsonData.phone;
        const email = jsonData.email;
        const guest = jsonData.guests;
        const reservationTime = jsonData.reservation_time;
        const specialRequest = jsonData.special_request;

        const date = new Date(reservationTime);

        const year = date.getUTCFullYear();
        const month = ('0' + (date.getUTCMonth() + 1)).slice(-2);
        const day = ('0' + date.getUTCDate()).slice(-2);
        const hours = ('0' + date.getUTCHours()).slice(-2);
        const minutes = ('0' + date.getUTCMinutes()).slice(-2);
        const seconds = ('0' + date.getUTCSeconds()).slice(-2);

        // Xây dựng chuỗi ngày giờ theo định dạng yêu cầu
        const formattedDate = `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
        console.log(formattedDate);

        document.getElementById('messageModalLabel').innerText = `${title}`;
        document.getElementById('modalName').innerText = `Họ và Tên: ${name}`;
        document.getElementById('modalPhone').innerText = `Số điện thoại: ${phone}`;
        document.getElementById('modalEmail').innerText = `Email: ${email}`;
        document.getElementById('modalGuest').innerText = `Số khách: ${guest}`;
        document.getElementById('modalReservationTime').innerText = `Thời gian đặt: ${formattedDate}`;
        document.getElementById('modalSpecialRequest').innerText = `Yêu cầu đặc biệt: ${specialRequest}`;
        document.getElementById('reservation-detail').href = "{{ route('admin.reservation.detail', ':id') }}".replace(
            ':id', reservationId);

        $.ajax({
            url: `/notifications/${notificationId}/read`,
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                console.log(response);

                if (response) {
                    const notificationContainer = $('#allNotification');
                    $(element).removeClass('bg-warning bg-opacity-50');

                    notificationContainer.append(element);
                    countNotificationNoRead();
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Failed to mark notification as read:', textStatus, errorThrown);
            }
        });
    }

    function countNotificationNoRead() {
        $.ajax({
            url: '/count-new-notifications-endpoint',
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                $('#countNotificationNoRead').html(data);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('AJAX Error:', textStatus, errorThrown);
            }
        });
    }

    $(document).ready(function() {
        let notificationDropdownStatus = false;

        function timeSince(date) {
            const seconds = Math.floor((new Date() - new Date(date)) / 1000);
            const intervals = [{
                    label: 'year',
                    seconds: 31536000
                },
                {
                    label: 'month',
                    seconds: 2592000
                },
                {
                    label: 'day',
                    seconds: 86400
                },
                {
                    label: 'hour',
                    seconds: 3600
                },
                {
                    label: 'minute',
                    seconds: 60
                },
                {
                    label: 'second',
                    seconds: 1
                },
            ];

            for (const interval of intervals) {
                const count = Math.floor(seconds / interval.seconds);
                if (count > 0) {
                    return `${count} ${interval.label}${count !== 1 ? 's' : ''} ago`;
                }
            }
            return 'Just now';
        }

        $('#notificationDropdown').on('click', function(e) {
            e.stopPropagation();
            notificationDropdownStatus = true;
        });


        $('#btn-seed-all').on('click', function(e) {
            e.stopPropagation();
            notificationSeedAll();
        });

        function notificationSeedAll() {
            $.ajax({
                url: '/seed-all',
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    location.reload();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('AJAX Error:', textStatus, errorThrown);
                }
            });
        }

        let searchTimeout;

        function triggerSearch() {
            const searchQuery = $('#searchInput').val().trim();
            const notificationStatus = $('input[name="notificationStatus"]:checked')
                .val();

            clearTimeout(searchTimeout);

            searchTimeout = setTimeout(function() {
                if (!searchQuery && !notificationStatus) {
                    loadNotifications();
                } else {
                    searchNotifications(searchQuery, notificationStatus);
                }
            }, 2000);
        }

        $('#searchInput').on('input', triggerSearch);
        $('input[name="notificationStatus"]').on('change', triggerSearch);

        function searchNotifications(query, status, date) {
            const url = `/notifications/search?keyword=${query}&status=${status || 'all'}`;

            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    if (data.notifications.length === 0) {
                        $('#allNotification').html(
                            '<p class="text-center text-muted py-1 pt-3">No results found</p>'
                        );
                    } else {
                        displayNotifications(data.notifications, data.total);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('AJAX Search Error:', textStatus, errorThrown);
                }
            });
        }

        function loadNotifications() {
            $.ajax({
                url: '/notifications/index',
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    displayNotifications(data.notifications, data.total);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('AJAX Error:', textStatus, errorThrown);
                }
            });
        }

        // Populate notifications
        function displayNotifications(notifications, count) {
            $('#allNotification').empty();
            $('.countNotification').html(
                `Thông báo (${count || 0})`
            );

            if (Array.isArray(notifications)) {
                notifications.forEach(notification => {
                    try {
                        const messageData = JSON.parse(notification.message);

                        const reservationTime = messageData.reservation_time ?
                            new Date(messageData.reservation_time).toLocaleString('vi-VN', {
                                day: '2-digit',
                                month: '2-digit',
                                year: 'numeric',
                                hour: '2-digit',
                                minute: '2-digit',
                                second: '2-digit'
                            }) :
                            'No data available';

                        const notificationItem = `<a href="#" onclick="handleDropdownClick(this)" class="dropdown-item py-3 ${notification.user_id == null ? 'bg-warning bg-opacity-50' : ''}"
                            data-bs-toggle="modal"
                            data-bs-target="#messageModalNotification"
                            data-id="${notification.id}"
                            data-title="${notification.title}"
                            data-message-full='${notification.message}'>
                            <small class="float-end text-muted ps-2" data-created-at="${notification.created_at}">${timeSince(notification.created_at)}</small>
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0 bg-primary-subtle text-primary thumb-md rounded-circle">
                                    <i class="iconoir-wolf fs-4"></i>
                                </div>
                                <div class="flex-grow-1 ms-2 text-truncate">
                                    <h6 class="my-0 fw-normal text-dark fs-13">${notification.title}</h6>
                                    <small class="text-muted mb-0">${messageData.name || 'No data available'}</small>
                                    <br>
                                    <small class="text-muted mb-0">${messageData.phone || 'No data available'}</small>
                                    <br>
                                    <small class="text-muted mb-0">${reservationTime || 'No data available'}</small>
                                </div>
                            </div>
                        </a>`;
                        $('#allNotification').append(notificationItem);
                    } catch (error) {
                        console.error("Invalid JSON in notification message:", notification.message);
                    }
                });
            } else {
                console.error("Notifications data is not an array:", notifications);
            }
        }

        $('#notificationDropdown').on('show.bs.dropdown', loadNotifications);
    });
</script>
