$(document).ready(function () {
    $(document).on('change', '.status', function () {
        var select = $(this);
        var selectedValue = select.val();
        var accountId = select.data('account-id'); // This should get the correct account ID
        
        var data = {
            _token: csrfToken, 
            id: accountId,        
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
                alert(xhr.responseJSON.message);
                window.location.reload();
            }
        });        
    });
});
