// $(document).on('click', '.read-notification', function () {
//     // Function to update the notification count
//     function updateNewNotificationCount() {
//         $.ajax({
//             url: '/count-new-notifications-endpoint',
//             method: 'GET',
//             success: function (data) {
//                 $('#new-notification-count').text('Notification (' + data + ')');
//             },
//             error: function (xhr, status, error) {
//                 console.error('Error in updateNewNotificationCount AJAX:', error);
//             }
//         });
//     }

//     var notificationId = $(this).data('id');

//     $('#messageModal' + notificationId).modal('show');

//     $.ajax({
//         url: '/notifications/' + notificationId + '/read',
//         type: 'POST',
//         data: {
//             _token: csrfToken
//         },
//         success: function (response) {
//             if (response.success) {
//                 var $row = $('#tr-notification-id-' + notificationId);
                
//                 var $rowMenu = $('#notification-id-' + notificationId);

//                 $('#notificationTableBody').append($row);
//                 $('#notificationTableBody').append($rowMenu);

//                 $row.removeClass('bg-warning bg-opacity-50');
//                 $rowMenu.removeClass('bg-warning bg-opacity-50');

//                 $row.find('.read-notification').text('View Message');

//                 updateNewNotificationCount();
//             }
//         },
//         error: function (xhr) {
//             console.log(xhr.responseText);
//         }
//     });
// });

// // $(document).ready(function () {

// //     // // Function to update the notification count
// //     // function updateNewNotificationCount() {
// //     //     $.ajax({
// //     //         url: '/count-new-notifications-endpoint',
// //     //         method: 'GET',
// //     //         success: function (data) {
// //     //             if (data && typeof data.unreadNotificationCount !== 'undefined') {
// //     //                 $('#new-review-count').text('Notification (' + data.unreadNotificationCount + ')');
// //     //             } else {
// //     //                 console.error('Invalid data format:', data);
// //     //             }
// //     //         },
// //     //         error: function (xhr, status, error) {
// //     //             console.error('Error in updateNewNotificationCount AJAX:', error);
// //     //         }
// //     //     });
// //     // }

// //     // // Handle notification click event to show modal and mark as read
// //     // $(document).on('click', '.notification-item', function () {
// //     //     var notificationId = $(this).data('id');

// //     //     $('#messageModal' + notificationId).modal('show');

// //     //     $.ajax({
// //     //         url: '/notifications/' + notificationId + '/read',
// //     //         type: 'POST',
// //     //         data: {
// //     //             _token: '{{ csrf_token() }}'
// //     //         },
// //     //         success: function (response) {
// //     //             if (response.success) {
// //     //                 alert(123);
// //     //                 var $row = $('#tr-notification-id-' + notificationId);

// //     //                 // Move the notification row in the table and mark it as read
// //     //                 $('#notificationTableBody').append($row);
// //     //                 $row.removeClass('bg-warning bg-opacity-50');
// //     //                 $row.find('.read-notification').text('View Message');

// //     //                 // Update notification count
// //     //                 updateNewNotificationCount();
// //     //             }
// //     //         },
// //     //         error: function (xhr) {
// //     //             console.log(xhr.responseText);
// //     //         }
// //     //     });
// //     // });

// //     // Listen for notification events and update the count
// //     // window.Echo.channel('reviews')
// //     //     .listen('NotificationEvent', (e) => {
// //     //         updateNewNotificationCount();
// //     //     });
// // });
