import './bootstrap';

window.Echo.channel('notifications')
    .listen('NotificationEvent', (e) => {

        // const $dropdownMenu = $('#notificationMenu');

        // Check if the notification dropdown is open
        // if ($dropdownMenu.hasClass('show')) {
        //     const dataNotification = e.dataNotification; // Assuming this is where your data comes from
        //     console.log(dataNotification);

        //     // Ensure dataNotification is defined before using it
        //     if (dataNotification) {
        //         alert(123);
        //         function timeSince(date) {
        //             const seconds = Math.floor((new Date() - new Date(date)) / 1000);
        //             const intervals = [{
        //                 label: 'year',
        //                 seconds: 31536000
        //             },
        //             {
        //                 label: 'month',
        //                 seconds: 2592000
        //             },
        //             {
        //                 label: 'day',
        //                 seconds: 86400
        //             },
        //             {
        //                 label: 'hour',
        //                 seconds: 3600
        //             },
        //             {
        //                 label: 'minute',
        //                 seconds: 60
        //             },
        //             {
        //                 label: 'second',
        //                 seconds: 1
        //             },
        //             ];

        //             for (const interval of intervals) {
        //                 const count = Math.floor(seconds / interval.seconds);
        //                 if (count > 0) {
        //                     return `${count} ${interval.label}${count !== 1 ? 's' : ''} ago`;
        //                 }
        //             }
        //             return 'Just now';
        //         };

        //         const notificationItemNew = `
        //         <a href="#" class="dropdown-item py-3 bg-warning bg-opacity-50" 
        //            data-bs-toggle="modal" 
        //            data-bs-target="#messageModalNotification">
        //             <small class="float-end text-muted ps-2">
        //                    ${timeSince(dataNotification.created_at)}
        //             </small>
        //             <div class="d-flex align-items-center">
        //                 <div class="flex-shrink-0 bg-primary-subtle text-primary thumb-md rounded-circle">
        //                     <i class="iconoir-wolf fs-4"></i>
        //                 </div>
        //                 <div class="flex-grow-1 ms-2 text-truncate">
        //                     <h6 class="my-0 fw-normal text-dark fs-13">${dataNotification.title}</h6>
        //                     <small class="text-muted mb-0">${dataNotification.data || 'No data available'}</small>
        //                 </div>
        //             </div>
        //         </a>`;

        //         // Prepend to notifications container to move it to the top
        //         $('#allNotification').prepend(notificationItemNew);
        //     } else {
        //         console.error('dataNotification is not defined.');
        //     }
        // }

        // Add flash class to the notification icon
        $('#notificationDropdown').addClass('flash');

        countNotificationNoRead();

        // Remove flash class after animation duration
        setTimeout(() => {
            $('#notificationDropdown').removeClass('flash');
        }, 1500); // Adjust the timeout to match the animation duration
    });
