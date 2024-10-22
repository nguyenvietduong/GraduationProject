document.addEventListener('DOMContentLoaded', function () {
    const imageInput = document.getElementById('imageInput');
    const imagePreview = document.getElementById('imagePreview');
    const removeImageBtn = document.getElementById('removeImageBtn');

    // Truyền biến hasImageTemp từ HTML vào
    const hasImageTemp = window.hasImageTemp || false;

    // Hiển thị nút xóa nếu có ảnh tạm thời trong session
    if (hasImageTemp) {
        removeImageBtn.style.display = 'block';
    }

    // Lắng nghe sự kiện khi người dùng chọn ảnh
    imageInput.addEventListener('change', function () {
        const file = imageInput.files[0];
        if (file) {
            const reader = new FileReader();

            reader.onload = function (e) {
                imagePreview.src = e.target.result;
                imagePreview.style.display = 'block';
                removeImageBtn.style.display = 'block'; // Hiển thị nút xóa khi có ảnh mới
            }

            reader.readAsDataURL(file);
        } else {
            imagePreview.src = '';
            imagePreview.style.display = 'none';
            removeImageBtn.style.display = 'none'; // Ẩn nút xóa nếu không có ảnh
        }
    });

    // Xử lý sự kiện xóa ảnh
    removeImageBtn.addEventListener('click', function () {
        // Gửi yêu cầu ajax để xóa ảnh tạm thời trong session
        fetch('/remove-temp-image', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ remove_image: true })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                imagePreview.src = '';
                imagePreview.style.display = 'none';
                removeImageBtn.style.display = 'none'; // Ẩn nút xóa sau khi xóa ảnh
            }
        });
    });
});