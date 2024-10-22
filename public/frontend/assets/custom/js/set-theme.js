function setTheme(url) {
    $(document).ready(function () {
        $('#chk').change(function () {
            let theme = $(this).is(':checked') ? 'dark' : 'light';
            // Get CSRF token from meta tag
            const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

            $.ajax({
                url: url, // Your route to set the theme
                type: 'POST',
                data: {
                    theme: theme,
                    _token: csrfToken // Include CSRF token for security
                },
                success: function (response) {
                    if (response.success) {
                        // Optionally handle success (e.g., notify user)
                        // console.log('Theme updated successfully');
                    }
                },
                error: function (xhr) {
                    // Optionally handle error
                    // console.log('Error updating theme', xhr);
                }
            });
        });
    });
}