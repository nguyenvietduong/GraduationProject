<li class="dropdown">
    <a class="nav-link dropdown-toggle arrow-none nav-icon" data-bs-toggle="dropdown" href="#" role="button"
        aria-haspopup="false" aria-expanded="false">
        <span class="fi {{ App::getLocale() === 'vi' ? 'fi-vn' : 'fi-us' }}"></span>
    </a>
    <div class="dropdown-menu">
        <div class="dropdown-item set-language" data-language="en">
            <span class="fi fi-us me-2"></span>{{ __('messages.system.lang.en') }}
        </div>
        <div class="dropdown-item set-language" data-language="vi">
            <span class="fi fi-vn me-2"></span>{{ __('messages.system.lang.vi') }}
        </div>
    </div>
</li>


<script>
    document.addEventListener('DOMContentLoaded', () => {
        const dropdownItems = document.querySelectorAll('.set-language');

        dropdownItems.forEach(item => {
            item.addEventListener('click', function () {
                const language = this.getAttribute('data-language');

                // Gửi yêu cầu AJAX để thay đổi ngôn ngữ
                changeLanguage(language);
            });
        });
    });

    function changeLanguage(language) {
        // Sử dụng fetch API để gửi yêu cầu AJAX
        fetch('/change-language', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // Đảm bảo bạn đã có CSRF token
            },
            body: JSON.stringify({
                language: language
            })
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Thành công, reload lại trang
                    window.location.reload();
                } else {
                    // Xử lý lỗi nếu có
                    console.error('Error changing language:', data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }
</script>