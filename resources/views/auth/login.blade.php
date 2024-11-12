@extends('layouts.app')
@section('content')
<div class="sm:w-[400px] w-full">
    <div class="relative overflow-hidden rounded-md shadow dark:shadow-gray-700 bg-white dark:bg-slate-950 p-6">
        <div class="text-center">
            <a href="{{ route('home') }}">
                <img src="/frontend/assets/images/logo-dark.png" class="mx-auto block dark:hidden" alt="">
                <img src="/frontend/assets/images/logo-light.png" class="mx-auto hidden dark:block" alt="">
            </a>
        </div>

        <form class="text-start lg:py-16 py-8" method="POST" action="{{ route('login') }}">
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
                    <label class="font-medium" for="LoginPassword">Password:</label>
                    <input id="LoginPassword" type="password" name="password"
                        class="mt-3 w-full py-2 px-3 h-10 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-100 dark:border-gray-800 focus:ring-0 @error('password') is-invalid @enderror"
                        placeholder="Password:" required>
                    @error('password')
                    <span class="err-message">*{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex justify-between mb-4">
                    <div class="flex items-center mb-0">
                        <input
                            class="form-checkbox rounded border-gray-100 dark:border-gray-800 text-amber-500 focus:border-amber-300 focus:ring focus:ring-offset-0 focus:ring-amber-200 focus:ring-opacity-50 me-2"
                            type="checkbox" value="" id="RememberMe">
                        <label class="form-checkbox-label text-slate-400" for="RememberMe">Remember
                            me</label>
                    </div>
                    <p class="text-slate-400 mb-0"><a href="{{ route('password.request') }}"
                            class="text-slate-400">Forgot password
                            ?</a></p>
                </div>

                <div class="mb-4">
                    <input type="submit"
                        class="py-2 px-5 inline-block tracking-wide align-middle duration-500 text-base text-center bg-amber-500 text-white rounded-md w-full"
                        value="Login / Sign in">
                </div>

                <div style="display: flex; gap: 10px;">
                    <!-- Facebook Button -->
                    <button type="button" class="py-2 px-5 w-full text-white rounded-md"
                        style="background-color: cornflowerblue;">
                        Facebook
                    </button>

                    <!-- Google Button -->
                    <button type="button" class="py-2 px-5 w-full text-gray-700 rounded-md"
                        style="background-color: white; border: 1px solid #ccc; color: #555;">
                        Google
                    </button>
                </div>

                <div class="text-center">
                    <span class="text-slate-400 me-2">Don't have an account ?</span> <a href="{{ route('register') }}"
                        class="text-slate-900 dark:text-white font-bold inline-block">Sign Up</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
