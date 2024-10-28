<!-- favicon -->
<link rel="shortcut icon" href="{{ asset('frontend/assets/images/favicon.ico') }}">
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- Css -->
<link href="{{ asset('frontend/assets/libs/tiny-slider/tiny-slider.css') }}" rel="stylesheet">
<link href="{{ asset('frontend/assets/libs/tobii/css/tobii.min.css') }}" rel="stylesheet">
<link href="{{ asset('frontend/assets/libs/swiper/css/swiper.min.css') }}" rel="stylesheet">
<!-- Main Css -->
<link href="{{ asset('frontend/assets/libs/%40mdi/font/css/materialdesignicons.min.css') }}" rel="stylesheet"
    type="text/css">
<link href="{{ asset('frontend/assets/css/tailwind.min.css') }}" rel="stylesheet" type="text/css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<!-- Include jQuery (if not already included) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- resources/views/layouts/app.blade.php -->
<meta name="user-id" content="{{ Auth::id() }}">

<!-- Flatpickr CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

<!-- Flatpickr JS -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<style>
    /* Chat Button */
    .chat-button {
        position: fixed;
        bottom: 20px;
        /* Cách đáy 20px */
        left: 20px;
        /* Cách bên trái 20px */
        background-color: #007bff;
        /* Màu nền */
        color: white;
        /* Màu chữ */
        border: none;
        /* Không có viền */
        border-radius: 50%;
        /* Hình tròn */
        width: 60px;
        /* Chiều rộng */
        height: 60px;
        /* Chiều cao */
        font-size: 24px;
        /* Kích thước chữ */
        cursor: pointer;
        /* Con trỏ khi hover */
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        /* Đổ bóng */
        z-index: 1000;
        /* Độ ưu tiên cao */
    }

    /* Chat Popup */
    .chat-popup {
        position: fixed;
        bottom: 80px;
        /* Nằm trên nút chat 20px */
        left: 20px;
        /* Căn bên trái */
        width: 300px;
        /* Chiều rộng */
        max-height: 400px;
        /* Chiều cao tối đa */
        background-color: white;
        /* Màu nền */
        border: 1px solid #ccc;
        /* Viền */
        border-radius: 8px;
        /* Bo góc */
        display: none;
        /* Ẩn ban đầu */
        flex-direction: column;
        /* Hướng dọc */
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        /* Đổ bóng */
        z-index: 1000;
        /* Độ ưu tiên cao */
        opacity: 0;
        /* Ẩn với độ mờ */
        transition: opacity 0.3s ease;
        /* Hiệu ứng mờ */
    }

    /* Hiện popup khi active */
    .chat-popup.active {
        display: flex;
        /* Hiện popup khi active */
        opacity: 1;
        /* Hiện với độ mờ */
    }

    /* Chat Header */
    .chat-header {
        background-color: #007bff;
        /* Màu nền */
        color: white;
        /* Màu chữ */
        padding: 10px;
        /* Padding */
        border-radius: 8px 8px 0 0;
        /* Bo góc trên */
        display: flex;
        /* Flexbox */
        justify-content: space-between;
        /* Căn giữa */
        align-items: center;
        /* Căn giữa dọc */
    }

    /* Chat Body */
    .chat-body {
        padding: 10px;
        /* Padding */
        overflow-y: auto;
        /* Cuộn dọc */
        flex-grow: 1;
        /* Mở rộng chiều cao */
        max-height: 300px;
        /* Chiều cao tối đa của chat body */
    }

    /* Messages */
    .message {
        margin-bottom: 10px;
        /* Khoảng cách dưới mỗi tin nhắn */
        border-radius: 5px;
        /* Bo góc */
        padding: 5px 10px;
        /* Padding */
        max-width: 80%;
        /* Chiều rộng tối đa */
        position: relative;
        /* Để đặt các mũi tên nếu cần */
    }

    .message.sent {
        background-color: #e0f7fa;
        /* Màu cho tin nhắn gửi */
        align-self: flex-end;
        /* Căn bên phải */
    }

    .message.received {
        background-color: #fff3e0;
        /* Màu cho tin nhắn nhận */
        align-self: flex-start;
        /* Căn bên trái */
    }

    /* Chat Input */
    .chat-input {
        display: flex;
        /* Flexbox */
        padding: 10px;
        /* Padding */
        border-top: 1px solid #ccc;
        /* Viền trên */
    }

    .chat-input input {
        flex-grow: 1;
        /* Chiếm không gian còn lại */
        padding: 10px;
        /* Padding */
        border: 1px solid #ccc;
        /* Viền */
        border-radius: 5px;
        /* Bo góc */
    }

    .chat-input button {
        background-color: #007bff;
        /* Màu nền */
        color: white;
        /* Màu chữ */
        border: none;
        /* Không có viền */
        border-radius: 5px;
        /* Bo góc */
        margin-left: 5px;
        /* Khoảng cách bên trái */
        padding: 10px;
        /* Padding */
        cursor: pointer;
        /* Con trỏ khi hover */
    }
</style>

@vite('resources/js/checkUserSession.js')