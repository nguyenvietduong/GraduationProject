<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<<script>
    $(document).ready(function() {
        $('.favorite-btn').click(function() {
            var menuId = $(this).data('menu-id');
    
            $.ajax({
                url: '{{ route("favorite.toggle") }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    menu_id: menuId
                },
                success: function(response) {
                    {{-- alert(response.success);   --}}
    
                    // Cập nhật icon yêu thích theo trạng thái
                    if (response.status === 'added') {
                        $('#favorite-icon-' + menuId).removeClass('fa-regular fa-heart').addClass('fa-solid fa-heart');
                    } else {
                        $('#favorite-icon-' + menuId).removeClass('fa-solid fa-heart').addClass('fa-regular fa-heart');
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 401) {
                        alert('Bạn cần đăng nhập để thực hiện chức năng này.');
                        window.location.href = '{{ route("login") }}';
                    }
                }
            });
        });
    });
</script>