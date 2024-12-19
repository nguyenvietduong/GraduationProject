@extends('layouts.app')
@section('content')
    <style>
        .small-logo {
            width: 250px;
            /* Adjust the width as needed */
            height: auto;
            /* Maintain aspect ratio */
        }
    </style>
    <div class="sm:w-[400px] w-full">
        <div class="relative overflow-hidden rounded-md shadow dark:shadow-gray-700 bg-white dark:bg-slate-950 p-6">
            <div class="text-center">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('frontend/assets/images/huongvietblack.png') }}" class="mx-auto block dark:hidden small-logo" alt="">
                    <img src="{{ asset('frontend/assets/images/huongviet.png') }}" class="mx-auto hidden dark:block small-logo" alt="">
                </a>
            </div>

            <form class="text-start lg:py-16 py-8" method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="grid grid-cols-1">
                    <div class="mb-4">
                        <label class="font-medium" for="LoginEmail">Email:</label>
                        <input id="LoginEmail" type="email" name="email" value="{{ old('email') }}"
                               class="mt-3 w-full py-2 px-3 h-10 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-100 dark:border-gray-800 focus:ring-0 @error('email') is-invalid @enderror"
                               placeholder="name@example.com" required>
                        @error('email')
                        <span class="err-message">*{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <input type="submit"
                               class="py-2 px-5 inline-block tracking-wide align-middle duration-500 text-base text-center bg-amber-500 text-white rounded-md w-full"
                               value="Gửi mail">
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
