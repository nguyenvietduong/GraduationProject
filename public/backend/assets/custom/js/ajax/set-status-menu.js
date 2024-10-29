$(document).ready(function () {
    $(document).on('change', '.status', function () {
        var select = $(this);
        select.val() == "active" ? select.closest('tr').removeClass("bg_status") : select.closest('tr').addClass("bg_status");
        var selectedValue = select.val();
        var accountId = select.data('menu-id'); // This should get the correct account ID
        
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
                executeExample('error');
            }
        });        
    });
});
// console.log("oke");
