<script>
    // Show Edit Form
    document.getElementById('editButton').addEventListener('click', function() {
        document.getElementById('infoDisplay').style.display = 'none';
        document.getElementById('editForm').style.display = 'block';
        document.getElementById('div-edit').style.display = 'none';
        document.getElementById('div-cancel').style.display = 'block';
    });

    document.getElementById('cancelButton').addEventListener('click', function() {
        document.getElementById('infoDisplay').style.display = 'block';
        document.getElementById('editForm').style.display = 'none';
        document.getElementById('div-edit').style.display = 'block';
        document.getElementById('div-cancel').style.display = 'none';
    });

    // Trigger File Input Click When Change Image Icon Is Clicked
    document.getElementById('changeImage').addEventListener('click', function() {
        document.getElementById('profileImageInput').click();
    });

    // Handle Image File Selection
    document.getElementById('profileImageInput').addEventListener('change', function() {
        var file = this.files[0];
        if (file) {
            var reader = new FileReader();

            // Update Profile Image Preview
            reader.onload = function(e) {
                document.getElementById('profileImagePreview').src = e.target.result;
                // Enable the Upload Button and Show Form
                document.getElementById('uploadImageButton').style.display = 'block';
            };

            reader.readAsDataURL(file);
        }
    });

    // Handle Form Submission via AJAX
    document.getElementById('updateProfileImageForm').addEventListener('submit', function(e) {
        e.preventDefault(); // Prevent default form submission

        var formData = new FormData(this); // Get form data

        $.ajax({
            url: $(this).attr('action'), // Get the action URL from the form
            type: 'POST',
            data: formData,
            contentType: false, // Do not set any content type header
            processData: false, // Do not process the data
            success: function(response) {
                if (response.success) {
                    // Update the profile image preview with the new image
                    // $('#profileImagePreview').attr('src', response.new_image_url);
                    executeExample('success'); // Call success function

                    setTimeout(function () {
                            // Trigger the click event on the reload button
                            location.reload(); 
                        }, 2500);
                } else {
                    alert('Failed to update profile image.');
                }
            },
            error: function(xhr, status, error) {
                alert('An error occurred: ' + xhr.responseText);
            }
        });
    });
</script>