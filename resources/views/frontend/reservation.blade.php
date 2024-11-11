@extends('layout.frontend')
@section('contentUser')
    <!-- Start Hero -->
    @include('frontend.component.breadcrumb', [
        'titleHeader' => __('messages.system.front_end.page.reservation.titleHeader'),
        'title' => __('messages.system.front_end.page.reservation.title'),
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

        select option[disabled] {
            color: #999;
            /* Màu sắc nhạt cho các tùy chọn hết bàn */
            background-color: #f0f0f0;
            /* Màu nền nhạt cho các tùy chọn hết bàn */
        }
    </style>

    <!-- Start -->
    <section class="relative md:py-24 py-16">
        <div class="container relative">
            <div class="flex justify-center">
                <div class="lg:w-2/4">
                    <div class="section-title mb-4">
                        <h4 class="text-2xl font-semibold mb-4">{{ __('messages.system.front_end.page.reservation.title') }}
                        </h4> <!-- Khu vực thông báo -->
                        <div id="responseMessage" class="mt-4"></div>
                        <p class="text-slate-400 para-desc">{{ __('messages.system.front_end.page.reservation.messages') }}
                        </p>
                    </div>
                    <form id="reservationForm" action="{{ route('reservation') }}" method="post">
                        @csrf <!-- Don't forget to include the CSRF token -->
                        <div class="grid md:grid-cols-2 gap-4 mt-6">
                            <!-- Các trường nhập liệu như cũ -->
                            <div>
                                <label class="">{{ __('messages.reservation.fields.full_name') }} <span style="color: red">*</span></label>
                                <input name="name" id="name" type="text"
                                    class="mt-2 w-full py-2 px-3 h-10 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-100 dark:border-gray-800 focus:ring-0 @error('name') border-red-500 @enderror"
                                    placeholder="{{ __('messages.reservation.fields.name_placeholder') }}"
                                    value="{{ old('name', Auth::check() ? Auth::user()->full_name : '') }}">
                                @error('name')
                                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <label class="">{{ __('messages.reservation.fields.email') }} <span style="color: red">*</span></label>
                                <input name="email" id="email" type="email"
                                    class="mt-2 w-full py-2 px-3 h-10 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-100 dark:border-gray-800 focus:ring-0 @error('email') border-red-500 @enderror"
                                    placeholder="{{ __('messages.reservation.fields.email_placeholder') }}"
                                    value="{{ old('email', Auth::check() ? Auth::user()->email : '') }}">
                                @error('email')
                                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <label class="">{{ __('messages.reservation.fields.phone') }} <span style="color: red">*</span></label>
                                <input name="phone" type="number" id="phone" 
                                    class="mt-2 w-full py-2 px-3 h-10 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-100 dark:border-gray-800 focus:ring-0 @error('phone') border-red-500 @enderror"
                                    placeholder="{{ __('messages.reservation.fields.phone_placeholder') }}"
                                    value="{{ old('phone', Auth::check() ? Auth::user()->phone : '') }}">
                                @error('phone')
                                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <label class="">{{ __('messages.reservation.fields.guests') }} <span style="color: red">*</span></label>
                                <input type="number" min="0" autocomplete="off" id="guests" name="guests"
                                    class="mt-2 w-full py-2 px-3 h-10 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-100 dark:border-gray-800 focus:ring-0 @error('guests') border-red-500 @enderror"
                                    required="" placeholder="{{ __('messages.reservation.fields.guests_placeholder') }}"
                                    value="{{ old('guests') }}">
                                @error('guests')
                                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <label class="">{{ __('messages.reservation.fields.date') }} <span style="color: red">*</span></label>
                                <!-- Chỉ cho phép chọn ngày hôm nay trở đi -->
                                <input type="date" min="{{ \Carbon\Carbon::today()->toDateString() }}"
                                    autocomplete="off" id="date" name="date"
                                    class="mt-2 w-full py-2 px-3 h-10 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-100 dark:border-gray-800 focus:ring-0 @error('date') border-red-500 @enderror"
                                    required="" placeholder="{{ __('messages.reservation.fields.date_placeholder') }}"
                                    value="{{ old('date') }}">
                                @error('date')
                                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <label>{{ __('messages.reservation.fields.time') }} <span style="color: red">*</span></label>
                                <select name="input-time" id="input-time"
                                    class="mt-2 w-full py-2 px-3 h-10 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-100 dark:border-gray-800 focus:ring-0 @error('input-time') border-red-500 @enderror">
                                    <option value="">{{ __('messages.reservation.fields.time') }}</option>
                                    @for ($i = 8; $i < 24; $i += 0.5)
                                        @php
                                            $displayHour = floor($i);
                                            $displayMinute = ($i - $displayHour) * 60;
                                            $formattedTime = sprintf('%02d:%02d', $displayHour, $displayMinute);
                                            $timeValue = sprintf('%02d:%02d', $displayHour, $displayMinute);
                                        @endphp
                                        <option value="{{ $timeValue }}" data-available="false">{{ $formattedTime }}
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
                            <textarea name="special_request"
                                class="mt-2 w-full py-2 px-3 h-32 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-100 dark:border-gray-800 focus:ring-0"
                                placeholder="{{ __('messages.reservation.fields.special_request_placeholder') }}">{{ old('special_request') }}</textarea>
                            @error('special_request')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 mt-4">
                            <input type="submit" id="submit" name="send"
                                class="py-2 px-5 inline-block tracking-wide align-middle duration-500 text-base text-center bg-amber-500 text-white rounded-md mt-2 w-full"
                                value="{{ __('messages.system.button.book_a_table') }}">
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

                // Get form data
                var formData = $(this).serialize();

                // Show the loading overlay
                $('#loadingOverlay').show();

                $.ajax({
                    url: $(this).attr('action'), // Lấy URL từ thuộc tính action của form
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        // Kiểm tra nếu thành công
                        if (response.success) {
                            // Lưu thông tin đơn đặt bàn vào localStorage
                            let reservations = JSON.parse(localStorage.getItem('myReservation')) || [];
                            // Thêm đơn đặt chỗ mới vào mảng
                            reservations.push(response.data.id);
                            // Lưu lại mảng vào localStorage
                            localStorage.setItem('myReservation', JSON.stringify(reservations));

                            // Tạo và hiển thị thông báo thành công
                            var successMessage = '<div class="success-message fade-in show">' +
                                response.message +
                                '<span class="close" onclick="$(this).parent().remove();">&times;</span>' +
                                '</div>';
                            $('#responseMessage').html(successMessage);

                            // Reset form
                            $('#reservationForm')[0].reset();

                            $('#loadingOverlay').hide(); // Ẩn overlay khi xong

                            // Xóa thông báo sau 2 giây
                            setTimeout(function() {
                                $('#responseMessage').html('');
                            }, 2000);
                        } else {
                            // Xử lý khi có lỗi (nếu có)
                            alert('Error: ' + response.message);
                        }
                    },
                    error: function(xhr) {
                        console.log(xhr);
                        // Xử lý khi có lỗi server
                        alert('An error occurred. Please try again.');
                    }
                });
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const selectDate = document.getElementById('date');
            const inputTime = document.getElementById('input-time');
            const today = new Date();

            const formatDate = (date) => date.toISOString().split('T')[0];

            // Đảm bảo không thể chọn ngày trong quá khứ
            selectDate.setAttribute('min', formatDate(today));

            // Kiểm tra tình trạng khả dụng của bàn khi người dùng thay đổi ngày
            checkAvailability(selectDate.value);

            // Lắng nghe sự kiện thay đổi ngày
            selectDate.addEventListener('change', function() {
                checkAvailability(this.value);
                // Reset giờ khi thay đổi ngày
                inputTime.value = '';
            });

            // Lắng nghe sự kiện thay đổi giờ
            inputTime.addEventListener('change', function() {
                const selectedOption = inputTime.options[inputTime.selectedIndex];
                if (selectedOption.getAttribute('data-available') === 'false') {
                    alert('Giờ đã chọn đã hết bàn.');
                    inputTime.value = ''; // Reset lại lựa chọn
                }
            });

            // Kiểm tra tình trạng khả dụng của bàn theo ngày và giờ đã chọn
            function checkAvailability(date) {
                if (date) {
                    $.ajax({
                        url: '/checkTable',
                        method: 'GET',
                        data: {
                            date: date,
                            _token: csrfToken
                        },
                        success: function(response) {
                            if (response.success) {
                                const fullyBookedTimes = response
                                    .fullyBookedTimes; // Danh sách các giờ đã hết bàn

                                $('#input-time option').each(function() {
                                    const timeSlot = $(this).val();

                                    if (fullyBookedTimes.includes(
                                            timeSlot
                                            )) { // Kiểm tra nếu giờ nằm trong danh sách hết bàn
                                        $(this).text(
                                            `${timeSlot} - (Hết bàn)`); // Hiển thị "(Hết bàn)"
                                        $(this).attr('data-available', 'false');
                                        $(this).attr('disabled',
                                            'disabled'); // Thêm thuộc tính disabled
                                    } else {
                                        $(this).text(timeSlot); // Nếu còn bàn, chỉ hiển thị giờ
                                        $(this).attr('data-available', 'true');
                                        $(this).removeAttr(
                                            'disabled'); // Bỏ thuộc tính disabled
                                    }
                                });
                            } else {
                                alert('Không thể kiểm tra tình trạng khả dụng. Vui lòng thử lại.');
                            }
                        },
                        error: function() {
                            alert('Đã có lỗi xảy ra. Vui lòng thử lại.');
                        }
                    });
                }
            }
        });
    </script>
@endsection
