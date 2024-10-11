@extends('layouts.app')
@section('content')
    <div class="sm:w-[400px] w-full">
        <div class="relative overflow-hidden rounded-md shadow dark:shadow-gray-700 bg-white dark:bg-slate-950 p-6">
            <div class="text-center">
                <a href="index.html">
                    <img src="/frontend/assets/images/logo-dark.png" class="mx-auto block dark:hidden" alt="">
                    <img src="/frontend/assets/images/logo-light.png" class="mx-auto hidden dark:block" alt="">
                </a>
            </div>

            <form class="text-start lg:py-16 py-8" method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="grid grid-cols-1">
                    <div class="mb-4">
                        <label class="font-medium" for="LoginEmail">Email Address:</label>
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
                               value="Send Password Reset Link">
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
