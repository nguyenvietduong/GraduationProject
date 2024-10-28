$(document).ready(function () {
    $(document).on('change', '.status', function () {
        var select = $(this);
        var selectedValue = select.val();
        var blogId = select.data('blog-id'); // This should get the correct blog ID
        
        var data = {
            _token: csrfToken, 
            id: blogId,        
            status: selectedValue
        };

        $.ajax({
            url: updateStatusUrl, // Now pointing to the correct URL
            type: 'POST',
            data: data,
            success: function (response) {
                executeExample('success');
            },
            error: function (xhr, status, error) {
                executeExample('error');
            }
        });        
    });
});
