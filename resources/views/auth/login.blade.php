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

        <form class="text-start lg:py-16 py-8" method="POST" action="{{ route('login') }}">
            @csrf
            <div class="grid grid-cols-1">
                <div class="mb-4">
                    <label class="font-medium" for="LoginEmail">Email <span style="color: red">*</span></label>
                    <input id="LoginEmail" type="text" name="email" value="{{ old('email') }}"
                        class="mt-3 w-full py-2 px-3 h-10 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-100 dark:border-gray-800 focus:ring-0 @error('login') is-invalid @enderror"
                        placeholder="ten@example.com" required>
                </div>

                <div class="mb-4">
                    <label class="font-medium" for="LoginPassword">Mật khẩu <span style="color: red">*</span></label>
                    <input id="LoginPassword" type="password" name="password"
                        class="mt-3 w-full py-2 px-3 h-10 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-100 dark:border-gray-800 focus:ring-0 @error('password') is-invalid @enderror"
                        placeholder="Mật khẩu" required>
                </div>

                <div class="flex justify-between mb-4">
                    <div class="flex items-center mb-0">
                        <input
                            class="form-checkbox rounded border-gray-100 dark:border-gray-800 text-amber-500 focus:border-amber-300 focus:ring focus:ring-offset-0 focus:ring-amber-200 focus:ring-opacity-50 me-2"
                            type="checkbox" value="" id="RememberMe">
                    </div>
                    <p class="text-slate-400 mb-0"><a href="{{ route('password.request') }}"
                            class="text-slate-400">Quên mật khẩu?</a></p>
                </div>

                @error('login')
                <span class="err-message">*{{ $message }}</span>
                @enderror
                <div class="mb-4">
                    <input type="submit"
                        class="py-2 px-5 inline-block tracking-wide align-middle duration-500 text-base text-center bg-amber-500 text-white rounded-md w-full"
                        value="Đăng nhập">
                </div>

                <div class="text-center">
                    <span class="text-slate-400 me-2">Bạn chưa có tài khoản?</span> <a href="{{ route('register') }}"
                        class="text-slate-900 dark:text-white font-bold inline-block">Đăng ký</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
