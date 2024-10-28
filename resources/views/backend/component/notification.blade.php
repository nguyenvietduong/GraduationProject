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
        <h5 class="dropdown-item-text m-0 py-3 d-flex justify-content-between align-items-center">
            Notifications</span>
            <a href="#" class="badge text-body-tertiary badge-pill">
                <i class="iconoir-plus-circle fs-4"></i>
            </a>
        </h5>
        <div class="ms-0" style="max-height:230px;" data-simplebar>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="allNotification" role="tabpanel" aria-labelledby="all-tab"
                    tabindex="0">
                    <!-- Notifications will be populated here -->
                </div>
            </div>
        </div>
        <a href="#" class="dropdown-item text-center text-dark fs-13"><i class="fi-arrow-right"></i>
        </a>
    </div>
</li>

<script>
    function handleDropdownClick(element) {
        // Assume this is your JSON string
        const jsonStringTitle = element.getAttribute('data-title');
        
        const jsonStringMessage = element.getAttribute('data-message-full');

        // If it's a string, parse it
        const jsonData = JSON.parse(jsonStringMessage); // Skip this step if you already have a JavaScript object

        // Now, you can access each property
        const data = jsonData.data;
        const type = jsonData.type;
        const title = jsonStringTitle;
        const message = jsonData.message;
        const createdAt = jsonData.created_at;

        // Display each property in the console or use them in your UI
        console.log("Data:", data);
        console.log("Type:", type);
        console.log("Title:", title);
        console.log("Message:", message);
        console.log("Created At:", createdAt);

        // Assuming you want to display them in a modal
        document.getElementById('modalTitle').innerText = `Title: ${title}`;
        document.getElementById('modalType').innerText = `Type: ${type}`;
        document.getElementById('modalMessage').innerText = `Message: ${message}`;
        document.getElementById('modalData').innerText = `Data: ${data}`;
        document.getElementById('modalCreatedAt').innerText = `Created At: ${createdAt}`;
    }
</script>

<script>
    $(document).ready(function() {
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

        $('.nav-link.dropdown-toggle').on('click', function() {
            const $dropdownMenu = $('#notificationMenu');

            // Check if the dropdown is already open
            if ($dropdownMenu.hasClass('show')) {
                // Dropdown is closed, so trigger the AJAX request
                $.ajax({
                    url: '/notifications/index',
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {

                        // Clear the previous notifications
                        $('#allNotification').empty();

                        // Update the notifications count using the total property
                        const notificationCount = data.total; // Use total from the response
                        $('.dropdown-item-text').html('Notifications (' + notificationCount + ') <a href="#" class="badge text-body-tertiary badge-pill"><i class="iconoir-plus-circle fs-4"></i></a>'); // Update the badge with the count

                        // Check if notifications is an array and iterate
                        if (Array.isArray(data.notifications)) {
                            data.notifications.forEach(function(notification) {
                                // Parse the message to an object
                                const messageData = JSON.parse(notification.message);

                                // Create the notification HTML with relative time
                                const notificationItem = `
                            <a href="#" onclick="handleDropdownClick(this)" class="dropdown-item py-3 ${notification.user_id == null ? 'bg-warning bg-opacity-50' : ''}" 
                                data-bs-toggle="modal" 
                                data-bs-target="#messageModalNotification" 
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

                                // Append to notifications container
                                $('#allNotification').append(notificationItem);
                            });
                        } else {
                            console.error('Notifications data is not an array:', data.notifications);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('AJAX Error:', textStatus, errorThrown);
                    }
                });
            }
        });
    });
</script>