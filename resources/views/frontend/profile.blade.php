@extends('layout.frontend')
@section('contentUser')
<!-- Start Hero -->
@include('frontend.component.breadcrumb',[
$titleHeader = '',
$title = 'Profile'
])
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
<form action="{{ route('profile') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <section class="relative md:py-24 py-16">
        <div class="container relative">
            <div class="flex justify-center">
                <div class="lg:w-2/4">
                    <div>
                        <label class="">{{ __('messages.account.fields.full_name') }}</label>
                        <input name="full_name" id="full_name" value="{{ $auth->full_name }}" type="text"
                            class="mt-2 w-full py-2 px-3 h-10 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-100 dark:border-gray-800 focus:ring-0 @error('full_name') border-red-500 @enderror"
                            placeholder="{{ __('messages.account.fields.name_placeholder') }}"
                            value="{{ old('full_name') }}">
                        @error('full_name')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label class="">{{ __('messages.account.fields.phone') }}</label>
                        <input name="phone" id="phone" value="{{ $auth->phone }}" type="text"
                            class="mt-2 w-full py-2 px-3 h-10 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-100 dark:border-gray-800 focus:ring-0 @error('phone') border-red-500 @enderror"
                            placeholder="{{ __('messages.account.fields.phone_placeholder') }}"
                            value="{{ old('phone') }}">
                        @error('phone')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label class="">{{ __('messages.account.fields.date') }}</label>
                        <input name="birthday" id="birthday" value="{{ $auth->birthday }}" type="date"
                            class="mt-2 w-full py-2 px-3 h-10 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-100 dark:border-gray-800 focus:ring-0 @error('date') border-red-500 @enderror"
                            placeholder="{{ __('messages.account.fields.date_bd') }}"
                            value="{{ old('birthday') }}">
                        @error('birthday')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label class="">{{ __('messages.account.fields.email') }}</label>
                        <input name="email" id="email" value="{{ $auth->email }}" type="text"
                            class="mt-2 w-full py-2 px-3 h-10 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-100 dark:border-gray-800 focus:ring-0 @error('email') border-red-500 @enderror"
                            placeholder="{{ __('messages.account.fields.email_placeholder') }}"
                            value="{{ old('email') }}">
                        @error('email')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label class="">{{ __('messages.account.fields.address') }}</label>
                        <input name="address" id="address" value="{{ $auth->address }}" type="text"
                            class="mt-2 w-full py-2 px-3 h-10 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-100 dark:border-gray-800 focus:ring-0 @error('address') border-red-500 @enderror"
                            placeholder="{{ __('messages.account.fields.address_placeholder') }}"
                            value="{{ old('address') }}">
                        @error('address')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Image upload section -->
                    <div>
                        <label class="">Hình ảnh</label>
                        <img id="profileImagePreview" src="{{ checkFile(Auth::user()->image) ?? '' }}"
                             alt="Profile Image" height="150" width="150" class="rounded-circle">
                        
                        <input type="file" name="image" id="image"
                               class="mt-2 w-full py-2 px-3 h-10 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-100 dark:border-gray-800 focus:ring-0">
                        
                        @error('image')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 mt-4">
                        <input type="submit"
                            class="py-2 px-5 inline-block tracking-wide align-middle duration-500 text-base text-center bg-amber-500 text-white rounded-md mt-2 w-full"
                            value="{{ __('messages.system.button.update_profile') }}">
                    </div>
                </div>
            </div>
        </div>
    </section>
</form>


<script>
    document.getElementById('image').addEventListener('change', function(event) {
        const file = event.target.files[0];
        
        // Kiểm tra nếu có file và file là một hình ảnh
        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                document.getElementById('profileImagePreview').src = e.target.result;
            }
            
            // Đọc nội dung của file ảnh và hiển thị
            reader.readAsDataURL(file);
        }
    });
</script>


@endsection