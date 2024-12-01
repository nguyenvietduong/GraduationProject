<button class="chat-button" onclick="location.href='{{ route('reservation') }}'">
    <div class="icon-wrapper">
        <i class="fas fa-book"></i> <!-- Icon -->
        <span class="chat-text">Đặt bàn ngay</span>
    </div>
</button>

<style>
    /* Chat Button Styles */
    .chat-button {
        position: fixed;
        bottom: 20px;
        left: 20px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 50%;
        width: 60px;
        height: 60px;
        font-size: 15px;
        cursor: pointer;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        z-index: 1000;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        transition: all 0.5s ease;
    }

    .chat-button .icon-wrapper {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
        transition: opacity 0.5s ease;
    }

    .chat-button .chat-text {
        display: none;
        margin-left: 10px;
        font-size: 14px;
        white-space: nowrap;
    }

    .chat-button.expanded {
        width: 170px;
        border-radius: 30px;
    }

    .chat-button.expanded .chat-text {
        display: inline;
    }

    .chat-button.expanded .fas {
        margin-right: 5px;
    }
</style>

<script>
    const chatButton = document.querySelector('.chat-button');

    // Hàm để bật ra
    const expandButton = () => {
        chatButton.classList.add('expanded');
        setTimeout(collapseButton, 3000); // Sau 3 giây bật vào
    };

    // Hàm để bật vào
    const collapseButton = () => {
        chatButton.classList.remove('expanded');
        setTimeout(expandButton, 3000); // Sau 3 giây bật ra lại
    };

    // Khởi chạy hiệu ứng
    setTimeout(expandButton, 3000); // Sau 3 giây bắt đầu bật ra
</script>

<!-- Font Awesome CDN -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
