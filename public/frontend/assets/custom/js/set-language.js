document.addEventListener('DOMContentLoaded', function() {
    const languageItems = document.querySelectorAll('.dropdown-item');

    // Add click event listener to each item
    languageItems.forEach(item => {
        item.addEventListener('click', (event) => {
            event.preventDefault(); // Prevent default behavior

            const selectedLanguage = item.getAttribute('data-language'); // Get selected language
            console.log(selectedLanguage); // Log selected language for debugging

            // Get CSRF token from meta tag
            const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

            // Send AJAX request to set the language
            fetch('/set-language', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken // Include CSRF token
                },
                body: JSON.stringify({
                    language: selectedLanguage
                })
            })
            .then(response => {
                if (response.ok) {
                    location.reload(); // Reload page to apply new language
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    });
});