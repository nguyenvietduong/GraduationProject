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

    <div class="dropdown-menu stop dropdown-menu-end dropdown-lg py-0" id="notificationMenu">
        <!-- Dropdown content will be dynamically populated here -->
        <h5 class="dropdown-item-text m-0 py-2 d-flex justify-content-between align-items-center">
            <span class="countNotification">Notifications</span>
        </h5>
        <input type="text" class="form-control" id="searchInput" placeholder="{{ __('messages.system.button.search') }}">
        <div class="ms-0" style="max-height:230px;" data-simplebar>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="allNotification" role="tabpanel" aria-labelledby="all-tab"
                    tabindex="0">
                    <!-- Notifications will be populated here -->
                </div>
            </div>
        </div>
        <a href="" class="dropdown-item text-center text-dark fs-13"></a>
    </div>
</li>

<script>
    function handleDropdownClick(element) {
        const notificationId = element.getAttribute('data-id');
        const jsonStringTitle = element.getAttribute('data-title');
        const jsonStringMessage = element.getAttribute('data-message-full');
        const jsonData = JSON.parse(jsonStringMessage);

        const data = jsonData.data;
        const type = jsonData.type;
        const title = jsonStringTitle;
        const message = jsonData.message;
        const createdAt = jsonData.created_at;

        document.getElementById('modalTitle').innerText = `Title: ${title}`;
        document.getElementById('modalType').innerText = `Type: ${type}`;
        document.getElementById('modalMessage').innerText = `Message: ${message}`;
        document.getElementById('modalData').innerText = `Data: ${data}`;
        document.getElementById('modalCreatedAt').innerText = `Created At: ${createdAt}`;

        // AJAX request to mark the notification as read
        $.ajax({
            url: `/notifications/${notificationId}/read`,
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}' // Include CSRF token for security
            },
            success: function(response) {
                console.log(response);

                if (response) {
                    // Move the read notification to the bottom of the list
                    const notificationContainer = $('#allNotification');
                    $(element).removeClass('bg-warning bg-opacity-50'); // Remove highlight class if present

                    // Append the notification to the end of the container
                    notificationContainer.append(element);
                    countNotificationNoRead();
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Failed to mark notification as read:', textStatus, errorThrown);
            }
        });
    }
</script>

<script>
    function countNotificationNoRead() {
        $.ajax({
            url: '/count-new-notifications-endpoint',
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                $('#countNotificationNoRead').html(data); // Update the notification count
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('AJAX Error:', textStatus, errorThrown);
            }
        });
    }
</script>

<script>
    $(document).ready(function() {
        let notificationDropdownStatus = false;

        // Function to calculate time since the notification was created
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

        // Open dropdown and mark status as true when clicked
        $('#notificationDropdown').on('click', function(e) {
            e.stopPropagation();
            notificationDropdownStatus = true;
        });

        let searchTimeout;

        $('#searchInput').on('input', function() {
            const searchQuery = $(this).val().trim();

            clearTimeout(searchTimeout);

            searchTimeout = setTimeout(function() {
                if (!searchQuery) {
                    loadNotifications();
                } else {
                    searchNotifications(searchQuery);
                }
            }, 2000);
        });

        function searchNotifications(query) {
            $.ajax({
                url: `/notifications/search?keyword=${query}`,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    if (data.notifications.length === 0) {
                        $('#allNotification').html('<p class="text-center text-muted py-1 pt-3">No results found</p>');
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
                `Notifications (${count || 0})`
            );

            if (Array.isArray(notifications)) {
                notifications.forEach(notification => {
                    try {
                        const messageData = JSON.parse(notification.message);
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
                                    <small class="text-muted mb-0">${messageData.data || 'No data available'}</small>
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