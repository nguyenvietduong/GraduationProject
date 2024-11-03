@extends('layout.frontend')
@section('contentUser')
<!-- Start Hero -->
@include('frontend.component.breadcrumb', [
'titleHeader' => __('messages.system.front_end.page.reservation.titleHeader'),
'title' => __('messages.system.front_end.page.reservation.title')
])
<!-- End Hero -->
<style>
    /* Error message styling */
    .text-red-500 {
        color: red;
        /* Change color to red */
        font-size: 0.875rem;
        /* Slightly smaller font size */
    }

    /* Input error border styling */
    .border-red-500 {
        border-color: red !important;
        /* Make border red for errors */
    }

    /* Fade-in effect for messages */
    .fade-in {
        opacity: 0;
        /* Initially hidden */
        transition: opacity 0.5s ease-in;
        /* Transition for fade-in effect */
    }

    /* Success message styling */
    .fade-in.show {
        opacity: 1;
        /* Make visible when shown */
        background-color: darkgreen;
        /* Background color for success message */
        color: white;
        /* Text color */
        padding: 10px 15px;
        /* Add padding for spacing */
        border-radius: 5px;
        /* Rounded corners */
        margin-top: 10px;
        /* Space above the message */
    }

    /* Optional: Close button for messages */
    .success-message {
        position: relative;
        /* Positioning for the close button */
    }

    /* Close button styling */
    .success-message .close {
        position: absolute;
        top: 5px;
        /* Adjust as needed */
        right: 10px;
        /* Adjust as needed */
        cursor: pointer;
        /* Pointer cursor on hover */
        color: white;
        /* Close button color */
        font-size: 0.875rem;
        /* Size of the close button text */
    }

    /* Error message styling */
    .error-message {
        background-color: darkred;
        /* Background color for error message */
        color: white;
        /* Text color */
        padding: 10px 15px;
        /* Add padding for spacing */
        border-radius: 5px;
        /* Rounded corners */
        margin-top: 10px;
        /* Space above the message */
        opacity: 0;
        /* Initially hidden */
        transition: opacity 0.5s ease-in;
        /* Transition for fade-in effect */
    }

    .error-message.show {
        opacity: 1;
        /* Make visible when shown */
    }
</style>

<!-- Start -->
<section class="relative md:py-24 py-16">
    <div class="container relative">
        <div class="flex justify-center">
            <div class="lg:w-2/4">
                <div class="section-title mb-4">
                    <h4 class="text-2xl font-semibold mb-4">{{ __('messages.system.front_end.page.reservation.title') }}</h4> <!-- Khu vực thông báo -->
                    <div id="responseMessage" class="mt-4"></div>
                    <p class="text-slate-400 para-desc">{{ __('messages.system.front_end.page.reservation.messages') }}</p>
                </div>
                <form id="reservationForm" action="{{ route('reservation') }}" method="post">
                    @csrf <!-- Don't forget to include the CSRF token -->
                    <div class="grid md:grid-cols-2 gap-4 mt-6">
                        <!-- Các trường nhập liệu như cũ -->
                        <div>
                            <label class="">{{ __('messages.reservation.fields.full_name') }}</label>
                            <input name="name" id="name" type="text" class="mt-2 w-full py-2 px-3 h-10 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-100 dark:border-gray-800 focus:ring-0 @error('name') border-red-500 @enderror" placeholder="{{ __('messages.reservation.fields.name_placeholder') }}" value="{{ old('name') }}">
                            @error('name')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <label class="">{{ __('messages.reservation.fields.email') }}</label>
                            <input name="email" id="email" type="email" class="mt-2 w-full py-2 px-3 h-10 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-100 dark:border-gray-800 focus:ring-0 @error('email') border-red-500 @enderror" placeholder="{{ __('messages.reservation.fields.email_placeholder') }}" value="{{ old('email') }}">
                            @error('email')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <label class="">{{ __('messages.reservation.fields.phone') }}</label>
                            <input name="phone" type="number" id="phone" class="mt-2 w-full py-2 px-3 h-10 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-100 dark:border-gray-800 focus:ring-0 @error('phone') border-red-500 @enderror" placeholder="{{ __('messages.reservation.fields.phone_placeholder') }}" value="{{ old('phone') }}">
                            @error('phone')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <label class="">{{ __('messages.reservation.fields.guests') }}</label>
                            <input type="number" min="0" autocomplete="off" id="guests" name="guests" class="mt-2 w-full py-2 px-3 h-10 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-100 dark:border-gray-800 focus:ring-0 @error('guests') border-red-500 @enderror" required="" placeholder="{{ __('messages.reservation.fields.guests_placeholder') }}" value="{{ old('guests') }}">
                            @error('guests')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label class="">{{ __('messages.reservation.fields.date') }}</label>
                            <select name="date" id="dateSelect" class="mt-2 w-full py-2 px-3 h-10 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-100 dark:border-gray-800 focus:ring-0 @error('date') border-red-500 @enderror"></select>
                            @error('date')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <label class="">{{ __('messages.reservation.fields.time') }}</label>
                            <select name="input-time" id="input-time" class="mt-2 w-full py-2 px-3 h-10 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-100 dark:border-gray-800 focus:ring-0 @error('input-time') border-red-500 @enderror">
                                <option value="">{{ __('messages.reservation.fields.time') }}</option>
                                @for ($i = 8; $i < 24; $i +=0.5)
                                    @php
                                    $displayHour=floor($i);
                                    $displayMinute=($i - $displayHour) * 60;

                                    // Format time as 24-hour
                                    $formattedTime=sprintf('%02d:%02d', $displayHour, $displayMinute);
                                    // Use the same value as the formatted time
                                    $timeValue=sprintf('%02d:%02d', $displayHour, $displayMinute);
                                    @endphp
                                    <option value="{{ $timeValue }}">{{ $formattedTime }}
                                    <p>(Het ban)</p>
                                    </option>
                                    @endfor
                            </select>
                            @error('input-time')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div><!--end grid-->

                    <div class="grid grid-cols-1 mt-4">
                        <label class="">{{ __('messages.reservation.fields.special_request') }}</label>
                        <textarea name="special_request" class="mt-2 w-full py-2 px-3 h-32 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-100 dark:border-gray-800 focus:ring-0" placeholder="{{ __('messages.reservation.fields.special_request_placeholder') }}">{{ old('special_request') }}</textarea>
                        @error('special_request')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 mt-4">
                        <input type="submit" id="submit" name="send" class="py-2 px-5 inline-block tracking-wide align-middle duration-500 text-base text-center bg-amber-500 text-white rounded-md mt-2 w-full" value="{{ __('messages.system.button.book_a_table') }}">
                    </div>
                </form><!--end form-->
            </div>
        </div>
    </div>
</section>
<!-- End -->

<script>
    $(document).ready(function() {
        $('#reservationForm').on('submit', function(event) {
            event.preventDefault(); // Prevent the default form submission

            var submitButton = $('#submit'); // Reference to the submit button
            var originalButtonText = submitButton.val(); // Store original button text
            submitButton.prop('disabled', true).val('Processing...'); // Disable button and change text
            // Get form data
            var formData = $(this).serialize();

            $.ajax({
                url: $(this).attr('action'), // Get URL from form action attribute
                type: 'POST',
                data: formData,
                success: function(response) {
                    // Create and display success message
                    var successMessage = '<div class="success-message fade-in show">' +
                        response.message +
                        '<span class="close" onclick="$(this).parent().remove();">&times;</span>' +
                        '</div>';
                    $('#responseMessage').html(successMessage);

                    // Reset the form
                    $('#reservationForm')[0].reset();

                    // Re-enable the button and reset text
                    submitButton.prop('disabled', false).val(originalButtonText); // Reset to original text

                    // Clear response message after 2 seconds
                    setTimeout(function() {
                        $('#responseMessage').html('');
                    }, 2000);
                },
                error: function(xhr) {
                    console.log(xhr);
                    // Clear previous error messages
                    $('.error-message').remove();

                    // Show error messages
                    var errorsBook = xhr.responseJSON.message;
                    var errors = xhr.responseJSON.errors;
                    if (errorsBook && !errors) {
                        var errorMessage = '<div class="error-message fade-in show">' +
                            errorsBook +
                            '<span class="close" onclick="$(this).parent().remove();">&times;</span>' +
                            '</div>';
                        $('#responseMessage').html(errorMessage);

                        // Reset the form if necessary
                        $('#reservationForm')[0].reset(); // Uncomment if you want to reset on general error

                        // Clear response message after 2 seconds
                        setTimeout(function() {
                            $('#responseMessage').html('');
                        }, 2000);
                    }
                    if (errors) {
                        $.each(errors, function(key, value) {
                            // Find the input field associated with the error
                            var inputField = $('[name="' + key + '"]');

                            // Add red border to input field
                            inputField.addClass('border-red-500');

                            // Create and display the error message below the input field
                            var errorMessage = '<div class="errorInput" style="color: red;">' + value[0] + '</div>';
                            inputField.after(errorMessage);
                        });

                        // Set a timeout to clear the errors
                        setTimeout(function() {
                            // Remove error message elements
                            $('.errorInput').remove(); // This will remove the error messages

                            // Remove red border class from all inputs with errors
                            $.each(errors, function(key) {
                                var inputField = $('[name="' + key + '"]');
                                inputField.removeClass('border-red-500'); // Remove the red border from input fields that had errors
                            });
                        }, 2000);
                    }

                    // Re-enable the button and reset text
                    submitButton.prop('disabled', false).val(originalButtonText); // Reset to original text

                    // Re-enable the button after a delay
                    setTimeout(function() {
                        submitButton.prop('disabled', false).val(originalButtonText); // Reset button text
                    }, 2000); // Adjust delay as needed
                }
            });
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const selectDate = document.getElementById('dateSelect');
        const today = new Date();

        // Function to format date to YYYY-MM-DD
        const formatDate = (date) => date.toISOString().split('T')[0];

        // Add today and the next six days as options
        for (let i = 0; i < 7; i++) {
            const optionDate = new Date(today);
            optionDate.setDate(today.getDate() + i); // Increment the date
            const option = document.createElement('option');
            option.value = formatDate(optionDate);
            option.textContent = formatDate(optionDate); // Display in the dropdown
            selectDate.appendChild(option);
        }

        // Listen for changes in the date selection
        selectDate.addEventListener('change', function() {
            const selectedDate = this.value; // Get the selected date

            // Call AJAX to check availability
            if (selectedDate) {
                $.ajax({
                    url: '/checkTable', // Route to check availability
                    method: 'GET', // Change this to POST if needed
                    data: {
                        date: selectedDate, // Send the selected date
                        _token: csrfToken // CSRF token for protection
                    },
                    success: function(response) {
                        if (response.success) {
                            // Check availability based on server response
                            const availability = response.availability;
                            const timeSlotKey = selectedTime; // Use the selected time as the key

                            if (availability[timeSlotKey]) {
                                // Time is available
                                alert('Time is available!');
                            } else {
                                // Time is not available
                                alert('Selected time is already booked.');
                                $('#input-time').val(''); // Reset the selection if not available
                            }
                        } else {
                            alert('Could not check availability. Please try again.');
                        }
                    },
                    error: function() {
                        alert('An error occurred. Please try again.');
                    }
                });
            }
        });
    });
</script>
@endsection