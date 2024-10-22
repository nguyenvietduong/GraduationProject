// JavaScript code
import './bootstrap';

const userIdMeta = document.querySelector('meta[name="user-id"]');
const userId = userIdMeta ? userIdMeta.getAttribute('content') : null;

if (userId) {
    window.Echo.channel(`user-session.${userId}`)
        .listen('.user-logged-in', () => {
            Swal.fire({
                title: 'Cảnh báo!',
                text: 'Tài khoản của bạn đã được đăng nhập từ một thiết bị khác.',
                icon: 'warning',
                confirmButtonText: 'OK'
            }).then(() => {
                // Tải lại trang ngay sau khi người dùng nhấn OK
                location.reload();
            });

            // Tải lại trang tự động sau 5 giây
            setTimeout(() => {
                location.reload();
            }, 5000); // 5000ms = 5 giây
        });
}
