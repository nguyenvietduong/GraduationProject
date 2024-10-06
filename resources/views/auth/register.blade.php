@extends('layout.auth')
@section('contentAuth')
    <div class="sm:w-[400px] w-full">
        <div class="relative overflow-hidden rounded-md shadow dark:shadow-gray-700 bg-white dark:bg-slate-950 p-6">
            <div class="text-center">
                <a href="index.html">
                    <img src="/frontend/assets/images/logo-dark.png" class="mx-auto block dark:hidden" alt="">
                    <img src="/frontend/assets/images/logo-light.png" class="mx-auto hidden dark:block" alt="">
                </a>
            </div>

            <form class="text-start lg:py-16 py-8" action="https://shreethemes.in/veganfry/layouts/signup-success.html">
                <div class="grid grid-cols-1">
                    <div class="mb-4">
                        <label class="font-medium" for="RegisterName">Your Name:</label>
                        <input id="RegisterName" type="text"
                            class="mt-3 w-full py-2 px-3 h-10 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-100 dark:border-gray-800 focus:ring-0"
                            placeholder="Harry">
                    </div>

                    <div class="mb-4">
                        <label class="font-medium" for="LoginEmail">Email Address:</label>
                        <input id="LoginEmail" type="email"
                            class="mt-3 w-full py-2 px-3 h-10 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-100 dark:border-gray-800 focus:ring-0"
                            placeholder="name@example.com">
                    </div>

                    <div class="mb-4">
                        <label class="font-medium" for="LoginPassword">Password:</label>
                        <input id="LoginPassword" type="password"
                            class="mt-3 w-full py-2 px-3 h-10 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-100 dark:border-gray-800 focus:ring-0"
                            placeholder="Password:">
                    </div>

                    <div class="mb-4">
                        <div class="flex items-center w-full mb-0">
                            <input
                                class="form-checkbox rounded border-gray-100 dark:border-gray-800 text-amber-500 focus:border-amber-300 focus:ring focus:ring-offset-0 focus:ring-amber-200 focus:ring-opacity-50 me-2"
                                type="checkbox" value="" id="AcceptT&C">
                            <label class="form-check-label text-slate-400" for="AcceptT&C">I Accept <a href="#"
                                    class="text-amber-500">Terms And Condition</a></label>
                        </div>
                    </div>

                    <div class="mb-4">
                        <input type="submit"
                            class="py-2 px-5 inline-block tracking-wide align-middle duration-500 text-base text-center bg-amber-500 text-white rounded-md w-full"
                            value="Register">
                    </div>

                    <div class="text-center">
                        <span class="text-slate-400 me-2">Already have an account ? </span> <a href="{{ route('login') }}"
                            class="text-slate-900 dark:text-white font-bold inline-block">Sign in</a>
                    </div>
                </div>
            </form>

            <div class="text-center">
                <p class="mb-0 text-slate-400">©
                    <script>
                        document.write(new Date().getFullYear())
                    </script> Veganfry. Designed by <a href="https://shreethemes.in/" target="_blank"
                        class="text-reset">Shreethemes</a>.
                </p>
            </div>
        </div>
    </div>
@endsection
