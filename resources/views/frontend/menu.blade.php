@extends('layout.frontend')
@section('contentUser')
    <!-- Start Hero -->
    <section class="relative md:py-44 py-32 bg-[url('../..//frontend/assets/images/bg/pages.html')] bg-no-repeat bg-bottom bg-cover">
        <div class="absolute inset-0 bg-gradient-to-t from-slate-900 to-slate-900/70"></div>
        <div class="container relative">
            <div class="grid grid-cols-1 text-center mt-6">
                <div>
                    <h5 class="md:text-4xl text-3xl md:leading-normal leading-normal font-medium text-white mb-0">Our Menus
                    </h5>
                </div>

                <ul class="tracking-[0.5px] mb-0 inline-block mt-5">
                    <li class="inline-block capitalize font-medium duration-500 ease-in-out text-white/50 hover:text-white">
                        <a href="index.html">Veganfry</a>
                    </li>
                    <li class="inline-block text-base text-white/50 mx-0.5 ltr:rotate-0 rtl:rotate-180"><i
                            class="mdi mdi-chevron-right"></i></li>
                    <li class="inline-block capitalize font-medium duration-500 ease-in-out text-white" aria-current="page">
                        Menus</li>
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
            <div class="grid grid-cols-1 items-center gap-6">
                <div class="filters-group-wrap text-center">
                    <div class="filters-group">
                        <ul class="mb-0 list-none container-filter-border-bottom filter-options space-x-3">
                            <li class="inline-block text-sm uppercase font-medium mb-3 cursor-pointer relative border-b border-transparent text-slate-400 duration-500 active"
                                data-group="all">All</li>
                            <li class="inline-block text-sm uppercase font-medium mb-3 cursor-pointer relative border-b border-transparent text-slate-400 duration-500"
                                data-group="break">Breakfast</li>
                            <li class="inline-block text-sm uppercase font-medium mb-3 cursor-pointer relative border-b border-transparent text-slate-400 duration-500"
                                data-group="lunch">Lunch</li>
                            <li class="inline-block text-sm uppercase font-medium mb-3 cursor-pointer relative border-b border-transparent text-slate-400 duration-500"
                                data-group="dinner">Dinner</li>
                            <li class="inline-block text-sm uppercase font-medium mb-3 cursor-pointer relative border-b border-transparent text-slate-400 duration-500"
                                data-group="tea">Tea & Coffee</li>
                        </ul>
                    </div>
                </div>
            </div><!--grid-->
        </div><!--end container-->

        <div class="container relative mt-8">
            <div id="grid" class="md:flex justify-center">
                <div class="group lg:w-1/5 md:w-1/3 picture-item p-3 mt-6" data-groups='["break"]'>
                    <img src="/frontend/assets/images/menu/1.jpg"
                        class="rounded-full size-32 mx-auto group-hover:animate-[spin_10s_linear_infinite]" alt="">

                    <div class="mt-4 text-center">
                        <a href="#" class="text-lg h5 block hover:text-amber-500 duration-500">Black bean dip</a>
                        <span class="text-slate-400 mt-2 block">A reader will be distracted by the readable</span>

                        <h5 class="text-amber-500 font-medium mt-4">$25.00</h5>
                    </div>
                </div><!--end col-->

                <div class="group lg:w-1/5 md:w-1/3 picture-item p-3 mt-6" data-groups='["lunch"]'>
                    <img src="/frontend/assets/images/menu/2.jpg"
                        class="rounded-full size-32 mx-auto group-hover:animate-[spin_10s_linear_infinite]" alt="">

                    <div class="mt-4 text-center">
                        <a href="#" class="text-lg h5 block hover:text-amber-500 duration-500">Onion Pizza</a>
                        <span class="text-slate-400 mt-2 block">A reader will be distracted by the readable</span>

                        <h5 class="text-amber-500 font-medium mt-4">$25.00</h5>
                    </div>
                </div><!--end col-->

                <div class="group lg:w-1/5 md:w-1/3 picture-item p-3 mt-6" data-groups='["break"]'>
                    <img src="/frontend/assets/images/menu/3.jpg"
                        class="rounded-full size-32 mx-auto group-hover:animate-[spin_10s_linear_infinite]" alt="">

                    <div class="mt-4 text-center">
                        <a href="#" class="text-lg h5 block hover:text-amber-500 duration-500">Chicken Breast</a>
                        <span class="text-slate-400 mt-2 block">A reader will be distracted by the readable</span>

                        <h5 class="text-amber-500 font-medium mt-4">$25.00</h5>
                    </div>
                </div><!--end col-->

                <div class="group lg:w-1/5 md:w-1/3 picture-item p-3 mt-6" data-groups='["dinner"]'>
                    <img src="/frontend/assets/images/menu/4.jpg"
                        class="rounded-full size-32 mx-auto group-hover:animate-[spin_10s_linear_infinite]" alt="">

                    <div class="mt-4 text-center">
                        <a href="#" class="text-lg h5 block hover:text-amber-500 duration-500">Veg Pizza</a>
                        <span class="text-slate-400 mt-2 block">A reader will be distracted by the readable</span>

                        <h5 class="text-amber-500 font-medium mt-4">$25.00</h5>
                    </div>
                </div><!--end col-->

                <div class="group lg:w-1/5 md:w-1/3 picture-item p-3 mt-6" data-groups='["break"]'>
                    <img src="/frontend/assets/images/menu/5.jpg"
                        class="rounded-full size-32 mx-auto group-hover:animate-[spin_10s_linear_infinite]" alt="">

                    <div class="mt-4 text-center">
                        <a href="#" class="text-lg h5 block hover:text-amber-500 duration-500">Cordon Bleu</a>
                        <span class="text-slate-400 mt-2 block">A reader will be distracted by the readable</span>

                        <h5 class="text-amber-500 font-medium mt-4">$25.00</h5>
                    </div>
                </div><!--end col-->

                <div class="group lg:w-1/5 md:w-1/3 picture-item p-3 mt-6" data-groups='["lunch"]'>
                    <img src="/frontend/assets/images/menu/6.jpg"
                        class="rounded-full size-32 mx-auto group-hover:animate-[spin_10s_linear_infinite]" alt="">

                    <div class="mt-4 text-center">
                        <a href="#" class="text-lg h5 block hover:text-amber-500 duration-500">Boerewors</a>
                        <span class="text-slate-400 mt-2 block">A reader will be distracted by the readable</span>

                        <h5 class="text-amber-500 font-medium mt-4">$25.00</h5>
                    </div>
                </div><!--end col-->

                <div class="group lg:w-1/5 md:w-1/3 picture-item p-3 mt-6" data-groups='["break"]'>
                    <img src="/frontend/assets/images/menu/7.jpg"
                        class="rounded-full size-32 mx-auto group-hover:animate-[spin_10s_linear_infinite]"
                        alt="">

                    <div class="mt-4 text-center">
                        <a href="#" class="text-lg h5 block hover:text-amber-500 duration-500">Tarte Tatin</a>
                        <span class="text-slate-400 mt-2 block">A reader will be distracted by the readable</span>

                        <h5 class="text-amber-500 font-medium mt-4">$25.00</h5>
                    </div>
                </div><!--end col-->

                <div class="group lg:w-1/5 md:w-1/3 picture-item p-3 mt-6" data-groups='["tea"]'>
                    <img src="/frontend/assets/images/menu/8.jpg"
                        class="rounded-full size-32 mx-auto group-hover:animate-[spin_10s_linear_infinite]"
                        alt="">

                    <div class="mt-4 text-center">
                        <a href="#" class="text-lg h5 block hover:text-amber-500 duration-500">Green Tea</a>
                        <span class="text-slate-400 mt-2 block">A reader will be distracted by the readable</span>

                        <h5 class="text-amber-500 font-medium mt-4">$25.00</h5>
                    </div>
                </div><!--end col-->

                <div class="group lg:w-1/5 md:w-1/3 picture-item p-3 mt-6" data-groups='["lunch"]'>
                    <img src="/frontend/assets/images/menu/9.jpg"
                        class="rounded-full size-32 mx-auto group-hover:animate-[spin_10s_linear_infinite]"
                        alt="">

                    <div class="mt-4 text-center">
                        <a href="#" class="text-lg h5 block hover:text-amber-500 duration-500">Special Coffee</a>
                        <span class="text-slate-400 mt-2 block">A reader will be distracted by the readable</span>

                        <h5 class="text-amber-500 font-medium mt-4">$25.00</h5>
                    </div>
                </div><!--end col-->

                <div class="group lg:w-1/5 md:w-1/3 picture-item p-3 mt-6" data-groups='["dinner"]'>
                    <img src="/frontend/assets/images/menu/10.jpg"
                        class="rounded-full size-32 mx-auto group-hover:animate-[spin_10s_linear_infinite]"
                        alt="">

                    <div class="mt-4 text-center">
                        <a href="#" class="text-lg h5 block hover:text-amber-500 duration-500">Lemon Tea</a>
                        <span class="text-slate-400 mt-2 block">A reader will be distracted by the readable</span>

                        <h5 class="text-amber-500 font-medium mt-4">$25.00</h5>
                    </div>
                </div><!--end col-->

                <div class="group lg:w-1/5 md:w-1/3 picture-item p-3 mt-6" data-groups='["tea"]'>
                    <img src="/frontend/assets/images/menu/11.jpg"
                        class="rounded-full size-32 mx-auto group-hover:animate-[spin_10s_linear_infinite]"
                        alt="">

                    <div class="mt-4 text-center">
                        <a href="#" class="text-lg h5 block hover:text-amber-500 duration-500">Pancakes</a>
                        <span class="text-slate-400 mt-2 block">A reader will be distracted by the readable</span>

                        <h5 class="text-amber-500 font-medium mt-4">$25.00</h5>
                    </div>
                </div><!--end col-->

                <div class="group lg:w-1/5 md:w-1/3 picture-item p-3 mt-6" data-groups='["lunch"]'>
                    <img src="/frontend/assets/images/menu/12.jpg"
                        class="rounded-full size-32 mx-auto group-hover:animate-[spin_10s_linear_infinite]"
                        alt="">

                    <div class="mt-4 text-center">
                        <a href="#" class="text-lg h5 block hover:text-amber-500 duration-500">American Item</a>
                        <span class="text-slate-400 mt-2 block">A reader will be distracted by the readable</span>

                        <h5 class="text-amber-500 font-medium mt-4">$25.00</h5>
                    </div>
                </div><!--end col-->

                <div class="group lg:w-1/5 md:w-1/3 picture-item p-3 mt-6" data-groups='["tea"]'>
                    <img src="/frontend/assets/images/menu/13.jpg"
                        class="rounded-full size-32 mx-auto group-hover:animate-[spin_10s_linear_infinite]"
                        alt="">

                    <div class="mt-4 text-center">
                        <a href="#" class="text-lg h5 block hover:text-amber-500 duration-500">Country side
                            pizza</a>
                        <span class="text-slate-400 mt-2 block">A reader will be distracted by the readable</span>

                        <h5 class="text-amber-500 font-medium mt-4">$25.00</h5>
                    </div>
                </div><!--end col-->

                <div class="group lg:w-1/5 md:w-1/3 picture-item p-3 mt-6" data-groups='["dinner"]'>
                    <img src="/frontend/assets/images/menu/14.jpg"
                        class="rounded-full size-32 mx-auto group-hover:animate-[spin_10s_linear_infinite]"
                        alt="">

                    <div class="mt-4 text-center">
                        <a href="#" class="text-lg h5 block hover:text-amber-500 duration-500">Chilly garlic
                            potato</a>
                        <span class="text-slate-400 mt-2 block">A reader will be distracted by the readable</span>

                        <h5 class="text-amber-500 font-medium mt-4">$25.00</h5>
                    </div>
                </div><!--end col-->

                <div class="group lg:w-1/5 md:w-1/3 picture-item p-3 mt-6" data-groups='["tea"]'>
                    <img src="/frontend/assets/images/menu/15.jpg"
                        class="rounded-full size-32 mx-auto group-hover:animate-[spin_10s_linear_infinite]"
                        alt="">

                    <div class="mt-4 text-center">
                        <a href="#" class="text-lg h5 block hover:text-amber-500 duration-500">Brownie with
                            vanilla</a>
                        <span class="text-slate-400 mt-2 block">A reader will be distracted by the readable</span>

                        <h5 class="text-amber-500 font-medium mt-4">$25.00</h5>
                    </div>
                </div><!--end col-->
            </div>
        </div><!--end container-->
    </section><!--end section-->
    <!-- End -->
@endsection
