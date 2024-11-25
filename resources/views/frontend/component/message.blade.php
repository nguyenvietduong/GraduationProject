<button class="chat-button">
    <a href="{{ route('reservation') }}"
        class="flex items-center justify-center px-6 py-3 bg-blue-500 text-white text-lg rounded-full shadow-lg hover:bg-blue-600 transition">
        Đặt bàn ngay
    </a>
</button>

<style>
    /* Chat Button */
    .chat-button {
        position: fixed;
        bottom: 20px; /* Cách đáy 20px */
        left: 20px; /* Cách bên trái 20px */
        background-color: #007bff; /* Màu nền */
        color: white; /* Màu chữ */
        border: none; /* Không có viền */
        border-radius: 50%; /* Hình tròn */
        width: 170px; /* Chiều rộng */
        height: 60px; /* Chiều cao */
        font-size: 15px; /* Kích thước chữ */
        cursor: pointer; /* Con trỏ khi hover */
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3); /* Đổ bóng */
        z-index: 1000; /* Độ ưu tiên cao */
        animation: bounce 2s infinite; /* Hiệu ứng nhảy */
    }

    /* Hiệu ứng cho chữ nhấp nháy */
    .chat-button a {
        font-size: 15px;
        animation: text-blink 1.5s infinite;
    }

    /* Hiệu ứng nhảy của nút */
    @keyframes bounce {
        0%, 100% {
            transform: translateY(0);
        }
        50% {
            transform: translateY(-10px);
        }
    }

    /* Hiệu ứng chữ nhấp nháy */
    @keyframes text-blink {
        0%, 100% {
            color: white;
        }
        50% {
            color: yellow;
        }
    }

    /* Hiệu ứng hover thu phóng */
    .chat-button:hover {
        transform: scale(1.1);
        transition: transform 0.3s ease;
    }
</style>
