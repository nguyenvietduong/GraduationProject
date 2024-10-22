import './bootstrap';

window.addEventListener('DOMContentLoaded', function () {
    const toastContainer = document.getElementById('toastPlacement');

    window.Echo.channel('notifications')
        .listen('NotificationEvent', (e) => {
            console.log(e);

            // Tạo một thông báo mới
            const toastElement = document.createElement('div');
            toastElement.classList.add('toast', 'fade', 'show');
            toastElement.innerHTML = `
                <div class="toast-header">
                    <img src="assets/images/logo-sm.png" alt="" height="20" class="me-1">
                    <h5 class="me-auto my-0">${e.title}</h5>
                    <small>Just now</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    ${e.data} ${e.message}
                </div>
            `;

            // Thêm thông báo vào vùng hiển thị toast
            toastContainer.appendChild(toastElement);

            // Tự động đóng thông báo sau 5 giây
            setTimeout(() => {
                toastElement.classList.remove('show');
                toastElement.classList.add('hide');
                toastElement.remove();
            }, 5000);
        });
});


