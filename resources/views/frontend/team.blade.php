@extends('layout.frontend')
@section('contentUser')
    <!-- Start Hero -->
    <section
        class="relative md:py-44 py-32 bg-[url('../..//frontend/assets/images/bg/pages.html')] bg-no-repeat bg-bottom bg-cover">
        <div class="absolute inset-0 bg-gradient-to-t from-slate-900 to-slate-900/70"></div>
        <div class="container relative">
            <div class="grid grid-cols-1 text-center mt-6">
                <div>
                    <h5 class="md:text-4xl text-3xl md:leading-normal leading-normal font-medium text-white mb-0">Our Chefs
                    </h5>
                </div>

                <ul class="tracking-[0.5px] mb-0 inline-block mt-5">
                    <li class="inline-block capitalize font-medium duration-500 ease-in-out text-white/50 hover:text-white">
                        <a href="index.html">Veganfry</a>
                    </li>
                    <li class="inline-block text-base text-white/50 mx-0.5 ltr:rotate-0 rtl:rotate-180"><i
                            class="mdi mdi-chevron-right"></i></li>
                    <li class="inline-block capitalize font-medium duration-500 ease-in-out text-white" aria-current="page">
                        Team</li>
                </ul>
            </div>
        </div>
    </section><!--end section-->
    <div class="relative">
        <div
            class="shape absolute sm:-bottom-px -bottom-[2px] start-0 end-0 overflow-hidden z-1 text-white dark:text-slate-900">
            <svg class="w-full h-auto scale-[2.0] origin-top" viewBox="0 0 2880 48" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path d="M0 48H1437.5H2880V0H2160C1442.5 52 720 0 720 0H0V48Z" fill="currentColor"></path>
            </svg>
        </div>
    </div>
    <!-- End Hero -->

    <!-- Start -->
    <section class="relative md:py-24 py-16">
        <div class="container relative">
            <div class="grid lg:grid-cols-4 sm:grid-cols-2 grid-cols-1 gap-6">
                <div class="group relative overflow-hidden rounded-md duration-500">
                    <img src="/frontend/assets/images/client/1.jpg"
                        class="rounded-md shadow dark:shadow-gray-800 group-hover:scale-110 duration-500" alt="">
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-slate-950 group-hover:via-slate-950/70 to-transparent">
                    </div>

                    <div class="absolute p-6 -bottom-[84px] group-hover:bottom-0 start-0 end-0 text-center duration-500">
                        <a href="#" class="text-white hover:text-amber-500 h5 text-lg font-medium">Gary Brook</a>

                        <p class="text-white/70 mt-1">Master Chef</p>

                        <ul class="list-none mt-2">
                            <li class="inline"><a href="#"
                                    class="size-8 inline-flex items-center justify-center align-middle rounded-full bg-amber-500 text-white"><i
                                        data-feather="facebook" class="h-4 w-4"></i></a></li>
                            <li class="inline"><a href="#"
                                    class="size-8 inline-flex items-center justify-center align-middle rounded-full bg-amber-500 text-white"><i
                                        data-feather="instagram" class="h-4 w-4"></i></a></li>
                            <li class="inline"><a href="#"
                                    class="size-8 inline-flex items-center justify-center align-middle rounded-full bg-amber-500 text-white"><i
                                        data-feather="linkedin" class="h-4 w-4"></i></a></li>
                            <li class="inline"><a href="#"
                                    class="size-8 inline-flex items-center justify-center align-middle rounded-full bg-amber-500 text-white"><i
                                        data-feather="twitter" class="h-4 w-4"></i></a></li>
                        </ul><!--end icon-->
                    </div>
                </div><!--end content-->

                <div class="group relative overflow-hidden rounded-md duration-500">
                    <img src="/frontend/assets/images/client/2.jpg"
                        class="rounded-md shadow dark:shadow-gray-800 group-hover:scale-110 duration-500" alt="">
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-slate-950 group-hover:via-slate-950/70 to-transparent">
                    </div>

                    <div class="absolute p-6 -bottom-[84px] group-hover:bottom-0 start-0 end-0 text-center duration-500">
                        <a href="#" class="text-white hover:text-amber-500 h5 text-lg font-medium">Leena Dolman</a>

                        <p class="text-white/70 mt-1">Master Chef</p>

                        <ul class="list-none mt-2">
                            <li class="inline"><a href="#"
                                    class="size-8 inline-flex items-center justify-center align-middle rounded-full bg-amber-500 text-white"><i
                                        data-feather="facebook" class="h-4 w-4"></i></a></li>
                            <li class="inline"><a href="#"
                                    class="size-8 inline-flex items-center justify-center align-middle rounded-full bg-amber-500 text-white"><i
                                        data-feather="instagram" class="h-4 w-4"></i></a></li>
                            <li class="inline"><a href="#"
                                    class="size-8 inline-flex items-center justify-center align-middle rounded-full bg-amber-500 text-white"><i
                                        data-feather="linkedin" class="h-4 w-4"></i></a></li>
                            <li class="inline"><a href="#"
                                    class="size-8 inline-flex items-center justify-center align-middle rounded-full bg-amber-500 text-white"><i
                                        data-feather="twitter" class="h-4 w-4"></i></a></li>
                        </ul><!--end icon-->
                    </div>
                </div><!--end content-->

                <div class="group relative overflow-hidden rounded-md duration-500">
                    <img src="/frontend/assets/images/client/3.jpg"
                        class="rounded-md shadow dark:shadow-gray-800 group-hover:scale-110 duration-500" alt="">
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-slate-950 group-hover:via-slate-950/70 to-transparent">
                    </div>

                    <div class="absolute p-6 -bottom-[84px] group-hover:bottom-0 start-0 end-0 text-center duration-500">
                        <a href="#" class="text-white hover:text-amber-500 h5 text-lg font-medium">Carol Francis</a>

                        <p class="text-white/70 mt-1">Master Chef</p>

                        <ul class="list-none mt-2">
                            <li class="inline"><a href="#"
                                    class="size-8 inline-flex items-center justify-center align-middle rounded-full bg-amber-500 text-white"><i
                                        data-feather="facebook" class="h-4 w-4"></i></a></li>
                            <li class="inline"><a href="#"
                                    class="size-8 inline-flex items-center justify-center align-middle rounded-full bg-amber-500 text-white"><i
                                        data-feather="instagram" class="h-4 w-4"></i></a></li>
                            <li class="inline"><a href="#"
                                    class="size-8 inline-flex items-center justify-center align-middle rounded-full bg-amber-500 text-white"><i
                                        data-feather="linkedin" class="h-4 w-4"></i></a></li>
                            <li class="inline"><a href="#"
                                    class="size-8 inline-flex items-center justify-center align-middle rounded-full bg-amber-500 text-white"><i
                                        data-feather="twitter" class="h-4 w-4"></i></a></li>
                        </ul><!--end icon-->
                    </div>
                </div><!--end content-->

                <div class="group relative overflow-hidden rounded-md duration-500">
                    <img src="/frontend/assets/images/client/4.jpg"
                        class="rounded-md shadow dark:shadow-gray-800 group-hover:scale-110 duration-500" alt="">
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-slate-950 group-hover:via-slate-950/70 to-transparent">
                    </div>

                    <div class="absolute p-6 -bottom-[84px] group-hover:bottom-0 start-0 end-0 text-center duration-500">
                        <a href="#" class="text-white hover:text-amber-500 h5 text-lg font-medium">Joe Thomas</a>

                        <p class="text-white/70 mt-1">Master Chef</p>

                        <ul class="list-none mt-2">
                            <li class="inline"><a href="#"
                                    class="size-8 inline-flex items-center justify-center align-middle rounded-full bg-amber-500 text-white"><i
                                        data-feather="facebook" class="h-4 w-4"></i></a></li>
                            <li class="inline"><a href="#"
                                    class="size-8 inline-flex items-center justify-center align-middle rounded-full bg-amber-500 text-white"><i
                                        data-feather="instagram" class="h-4 w-4"></i></a></li>
                            <li class="inline"><a href="#"
                                    class="size-8 inline-flex items-center justify-center align-middle rounded-full bg-amber-500 text-white"><i
                                        data-feather="linkedin" class="h-4 w-4"></i></a></li>
                            <li class="inline"><a href="#"
                                    class="size-8 inline-flex items-center justify-center align-middle rounded-full bg-amber-500 text-white"><i
                                        data-feather="twitter" class="h-4 w-4"></i></a></li>
                        </ul><!--end icon-->
                    </div>
                </div><!--end content-->

                <div class="group relative overflow-hidden rounded-md duration-500">
                    <img src="/frontend/assets/images/client/5.jpg"
                        class="rounded-md shadow dark:shadow-gray-800 group-hover:scale-110 duration-500" alt="">
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-slate-950 group-hover:via-slate-950/70 to-transparent">
                    </div>

                    <div class="absolute p-6 -bottom-[84px] group-hover:bottom-0 start-0 end-0 text-center duration-500">
                        <a href="#" class="text-white hover:text-amber-500 h5 text-lg font-medium">Michael
                            gordon</a>

                        <p class="text-white/70 mt-1">Master Chef</p>

                        <ul class="list-none mt-2">
                            <li class="inline"><a href="#"
                                    class="size-8 inline-flex items-center justify-center align-middle rounded-full bg-amber-500 text-white"><i
                                        data-feather="facebook" class="h-4 w-4"></i></a></li>
                            <li class="inline"><a href="#"
                                    class="size-8 inline-flex items-center justify-center align-middle rounded-full bg-amber-500 text-white"><i
                                        data-feather="instagram" class="h-4 w-4"></i></a></li>
                            <li class="inline"><a href="#"
                                    class="size-8 inline-flex items-center justify-center align-middle rounded-full bg-amber-500 text-white"><i
                                        data-feather="linkedin" class="h-4 w-4"></i></a></li>
                            <li class="inline"><a href="#"
                                    class="size-8 inline-flex items-center justify-center align-middle rounded-full bg-amber-500 text-white"><i
                                        data-feather="twitter" class="h-4 w-4"></i></a></li>
                        </ul><!--end icon-->
                    </div>
                </div><!--end content-->

                <div class="group relative overflow-hidden rounded-md duration-500">
                    <img src="/frontend/assets/images/client/6.jpg"
                        class="rounded-md shadow dark:shadow-gray-800 group-hover:scale-110 duration-500" alt="">
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-slate-950 group-hover:via-slate-950/70 to-transparent">
                    </div>

                    <div class="absolute p-6 -bottom-[84px] group-hover:bottom-0 start-0 end-0 text-center duration-500">
                        <a href="#" class="text-white hover:text-amber-500 h5 text-lg font-medium">Elisa
                            Brinegarer</a>

                        <p class="text-white/70 mt-1">Master Chef</p>

                        <ul class="list-none mt-2">
                            <li class="inline"><a href="#"
                                    class="size-8 inline-flex items-center justify-center align-middle rounded-full bg-amber-500 text-white"><i
                                        data-feather="facebook" class="h-4 w-4"></i></a></li>
                            <li class="inline"><a href="#"
                                    class="size-8 inline-flex items-center justify-center align-middle rounded-full bg-amber-500 text-white"><i
                                        data-feather="instagram" class="h-4 w-4"></i></a></li>
                            <li class="inline"><a href="#"
                                    class="size-8 inline-flex items-center justify-center align-middle rounded-full bg-amber-500 text-white"><i
                                        data-feather="linkedin" class="h-4 w-4"></i></a></li>
                            <li class="inline"><a href="#"
                                    class="size-8 inline-flex items-center justify-center align-middle rounded-full bg-amber-500 text-white"><i
                                        data-feather="twitter" class="h-4 w-4"></i></a></li>
                        </ul><!--end icon-->
                    </div>
                </div><!--end content-->

                <div class="group relative overflow-hidden rounded-md duration-500">
                    <img src="/frontend/assets/images/client/7.jpg"
                        class="rounded-md shadow dark:shadow-gray-800 group-hover:scale-110 duration-500" alt="">
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-slate-950 group-hover:via-slate-950/70 to-transparent">
                    </div>

                    <div class="absolute p-6 -bottom-[84px] group-hover:bottom-0 start-0 end-0 text-center duration-500">
                        <a href="#" class="text-white hover:text-amber-500 h5 text-lg font-medium">Milton Bryant</a>

                        <p class="text-white/70 mt-1">Master Chef</p>

                        <ul class="list-none mt-2">
                            <li class="inline"><a href="#"
                                    class="size-8 inline-flex items-center justify-center align-middle rounded-full bg-amber-500 text-white"><i
                                        data-feather="facebook" class="h-4 w-4"></i></a></li>
                            <li class="inline"><a href="#"
                                    class="size-8 inline-flex items-center justify-center align-middle rounded-full bg-amber-500 text-white"><i
                                        data-feather="instagram" class="h-4 w-4"></i></a></li>
                            <li class="inline"><a href="#"
                                    class="size-8 inline-flex items-center justify-center align-middle rounded-full bg-amber-500 text-white"><i
                                        data-feather="linkedin" class="h-4 w-4"></i></a></li>
                            <li class="inline"><a href="#"
                                    class="size-8 inline-flex items-center justify-center align-middle rounded-full bg-amber-500 text-white"><i
                                        data-feather="twitter" class="h-4 w-4"></i></a></li>
                        </ul><!--end icon-->
                    </div>
                </div><!--end content-->

                <div class="group relative overflow-hidden rounded-md duration-500">
                    <img src="/frontend/assets/images/client/8.jpg"
                        class="rounded-md shadow dark:shadow-gray-800 group-hover:scale-110 duration-500" alt="">
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-slate-950 group-hover:via-slate-950/70 to-transparent">
                    </div>

                    <div class="absolute p-6 -bottom-[84px] group-hover:bottom-0 start-0 end-0 text-center duration-500">
                        <a href="#" class="text-white hover:text-amber-500 h5 text-lg font-medium">Tomas Burgess</a>

                        <p class="text-white/70 mt-1">Master Chef</p>

                        <ul class="list-none mt-2">
                            <li class="inline"><a href="#"
                                    class="size-8 inline-flex items-center justify-center align-middle rounded-full bg-amber-500 text-white"><i
                                        data-feather="facebook" class="h-4 w-4"></i></a></li>
                            <li class="inline"><a href="#"
                                    class="size-8 inline-flex items-center justify-center align-middle rounded-full bg-amber-500 text-white"><i
                                        data-feather="instagram" class="h-4 w-4"></i></a></li>
                            <li class="inline"><a href="#"
                                    class="size-8 inline-flex items-center justify-center align-middle rounded-full bg-amber-500 text-white"><i
                                        data-feather="linkedin" class="h-4 w-4"></i></a></li>
                            <li class="inline"><a href="#"
                                    class="size-8 inline-flex items-center justify-center align-middle rounded-full bg-amber-500 text-white"><i
                                        data-feather="twitter" class="h-4 w-4"></i></a></li>
                        </ul><!--end icon-->
                    </div>
                </div><!--end content-->
            </div><!--end grid-->
        </div>
    </section>
    <!-- End -->
@endsection
