$(document).ready(function () {
    $(document).on('change', '.status', function () {
        var select = $(this);
        var selectedValue = select.val();
        var reviewId = select.data('review-id');

        var data = {
            _token: csrfToken,
            id: reviewId,
            status: selectedValue
            
        };

        $.ajax({
            url: updateStatusReviewUrl,
            type: 'POST',
            data: data,
            success: function (response) {
                var $tr = $('#tr-review-id-' + reviewId);

                $tr.removeClass('bg-warning bg-opacity-50');

                if (selectedValue === 'active' || selectedValue === 'inactive') {

                    $tr.appendTo($tr.closest('table').find('tbody'));
                } else if (selectedValue === 'pending') {
                    $tr.addClass('bg-warning bg-opacity-50');

                    $tr.prependTo($tr.closest('table').find('tbody'));
                }

                updateNewReviewCount();

                executeExample('success');
            },
            error: function (xhr, status, error) {
                executeExample('error');
            }
        });
    });

    // Hàm để lấy số lượng review mới
    function updateNewReviewCount() {
        $.ajax({
            url: '/count-new-reviews-endpoint',
            method: 'GET',
            success: function (data) {
                if (data && data.newReviewCount !== undefined) {
                    $('#new-review-count').text('Review (' + data.newReviewCount + ')');
                } else {
                    console.error('Invalid data format:', data);
                }
            },
            error: function (xhr, status, error) {
                console.error('Error in updateNewReviewCount AJAX:', error);
            }
        });
    }

    window.Echo.channel('reviews')
        .listen('ReviewEvent', (e) => {
            updateNewReviewCount();
        });
});
