@extends('layout.frontend')
@section('contentUser')
    <!-- Start Hero -->
    <!-- Slide -->
    <section class="swiper-slider-hero relative block h-screen" id="home">
        <div class="swiper-container absolute end-0 top-0 w-full h-full">
            <div class="swiper-wrapper">
                <div class="swiper-slide flex items-center overflow-hidden">
                    <div class="slide-inner absolute end-0 top-0 w-full h-full slide-bg-image flex items-center bg-center;"
                        data-background="/frontend/assets/images/bg/bg1.jpg">
                        <div class="absolute inset-0 bg-slate-900/60"></div>
                        <div class="container relative">
                            <div class="grid grid-cols-1">
                                <h1
                                    class="font-semibold lg:leading-normal leading-normal text-4xl lg:text-6xl text-white mb-5">
                                    Taste The <br> Difference</h1>
                                <p class="text-white/70 text-lg max-w-xl">My veggie-packed take on a deli-style pasta
                                    salad! I swap spiralized summer squash for half the noodles and a creamy tahini
                                    dressing.</p>

                                <div class="mt-8">
                                    <a href="menu-one.html"
                                        class="py-2 px-5 inline-block tracking-wide align-middle duration-500 text-base text-center text-amber-500 hover:text-white bg-transparent hover:bg-amber-500 border border-amber-500">View
                                        Our Menu</a>
                                </div>
                            </div><!--end grid-->
                        </div><!--end container-->
                    </div><!-- end slide-inner -->
                </div> <!-- end swiper-slide -->

                <div class="swiper-slide flex items-center overflow-hidden">
                    <div class="slide-inner absolute end-0 top-0 w-full h-full slide-bg-image flex items-center bg-center;"
                        data-background="/frontend/assets/images/bg/bg2.jpg">
                        <div class="absolute inset-0 bg-slate-900/60"></div>
                        <div class="container relative">
                            <div class="grid grid-cols-1">
                                <h1
                                    class="font-semibold lg:leading-normal leading-normal text-4xl lg:text-6xl text-white mb-5">
                                    Taste The <br> Everyone</h1>
                                <p class="text-white/70 text-lg max-w-xl">My veggie-packed take on a deli-style pasta
                                    salad! I swap spiralized summer squash for half the noodles and a creamy tahini
                                    dressing.</p>

                                <div class="mt-8">
                                    <a href="reservation.html"
                                        class="py-2 px-5 inline-block tracking-wide align-middle duration-500 text-base text-center text-amber-500 hover:text-white bg-transparent hover:bg-amber-500 border border-amber-500">Book
                                        A Table</a>
                                </div>
                            </div><!--end grid-->
                        </div><!--end container-->
                    </div><!-- end slide-inner -->
                </div> <!-- end swiper-slide -->
            </div>
            <!-- end swiper-wrapper -->

            <!-- swipper controls -->
            <!-- <div class="swiper-pagination"></div> -->
            <div
                class="swiper-button-next bg-transparent size-[35px] leading-[35px] -mt-[30px] bg-none border border-solid border-white/50 text-white hover:bg-amber-500 hover:border-amber-500 rounded-full text-center">
            </div>
            <div
                class="swiper-button-prev bg-transparent size-[35px] leading-[35px] -mt-[30px] bg-none border border-solid border-white/50 text-white hover:bg-amber-500 hover:border-amber-500 rounded-full text-center">
            </div>
        </div><!--end container-->
    </section><!--end section-->
    <!-- Hero End -->

    <!-- Start -->
    <section class="relative md:py-24 py-16">
        <div class="container relative">
            <div class="flex justify-center">
                <div class="lg:w-1/2 md:w-2/3 w-full">
                    <div class="text-center">
                        <h4 class="text-3xl font-semibold">Our Story</h4>

                        <p class="text-slate-400 mt-6">Our buzzy food-hall style concept is inspired by international
                            dining styles, especially in Asia. Explore the following fast-action food stations as busy
                            chefs perform.</p>
                    </div>
                </div>
            </div>

            <div class="flex justify-center mt-10">
                <div class="lg:w-2/3 w-full">
                    <div class="grid md:grid-cols-2 gap-6">
                        <div class="group relative">
                            <img src="/frontend/assets/images/menu/m1.jpg" alt="">
                            <div class="absolute inset-0 bg-slate-950/50"></div>
                            <div class="absolute inset-0 m-6 border border-white/30"></div>
                            <div class="absolute bottom-12 start-0 end-0 text-center">
                                <h5 class="text-white/80 group-hover:text-white duration-500 text-xl">Dining Menu</h5>
                            </div>
                        </div>

                        <div class="group relative">
                            <img src="/frontend/assets/images/menu/m3.jpg" alt="">
                            <div class="absolute inset-0 bg-slate-950/50"></div>
                            <div class="absolute inset-0 m-6 border border-white/30"></div>
                            <div class="absolute bottom-12 start-0 end-0 text-center">
                                <h5 class="text-white/80 group-hover:text-white duration-500 text-xl">Dessert Menu</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container relative md:mt-24 mt-16">
            <div class="grid grid-cols-1 pb-8 text-center">
                <h3 class="mb-6 md:text-3xl text-2xl md:leading-normal leading-normal font-semibold">Services</h3>

                <p class="text-slate-400 max-w-xl mx-auto">Our buzzy food-hall style concept is inspired by
                    international dining styles, especially in Asia.</p>
            </div><!--end grid-->

            <div class="grid grid-cols-1 lg:grid-cols-3 md:grid-cols-2 mt-6 gap-6">
                <div class="md:px-6 duration-500 text-center">
                    <div
                        class="size-20 bg-amber-500/5 mx-auto text-amber-500 text-3xl flex align-middle justify-center items-center shadow-sm dark:shadow-gray-800">
                        <i class="mdi mdi-pizza"></i>
                    </div>

                    <div class="content mt-7">
                        <a href="#" class="title h5 text-lg font-medium hover:text-amber-500">Food Meets Style</a>
                        <p class="text-slate-400 mt-3">The phrasal sequence of the is now so that many campaign and
                            benefit</p>

                        <div class="mt-5">
                            <a href="#" class="hover:text-amber-500">Read More <i class="mdi mdi-arrow-right"></i></a>
                        </div>
                    </div>
                </div>

                <div class="md:px-6 duration-500 text-center">
                    <div
                        class="size-20 bg-amber-500/5 mx-auto text-amber-500 text-3xl flex align-middle justify-center items-center shadow-sm dark:shadow-gray-800">
                        <i class="mdi mdi-silverware"></i>
                    </div>

                    <div class="content mt-7">
                        <a href="#" class="title h5 text-lg font-medium hover:text-amber-500">Quality Check</a>
                        <p class="text-slate-400 mt-3">The phrasal sequence of the is now so that many campaign and
                            benefit</p>

                        <div class="mt-5">
                            <a href="#" class="hover:text-amber-500">Read More <i class="mdi mdi-arrow-right"></i></a>
                        </div>
                    </div>
                </div>

                <div class="md:px-6 duration-500 text-center">
                    <div
                        class="size-20 bg-amber-500/5 mx-auto text-amber-500 text-3xl flex align-middle justify-center items-center shadow-sm dark:shadow-gray-800">
                        <i class="mdi mdi-moped-outline"></i>
                    </div>

                    <div class="content mt-7">
                        <a href="#" class="title h5 text-lg font-medium hover:text-amber-500">Home Delivery</a>
                        <p class="text-slate-400 mt-3">The phrasal sequence of the is now so that many campaign and
                            benefit</p>

                        <div class="mt-5">
                            <a href="#" class="hover:text-amber-500">Read More <i class="mdi mdi-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section
        class="relative pt-24 pb-40 bg-[url('../..//frontend/assets/images/bg/pages.html')] bg-no-repeat bg-fixed bg-top bg-cover">
        <div class="absolute inset-0 bg-slate-950/50"></div>
        <div class="container">
            <div class="flex justify-center relative mt-20">
                <div class="relative lg:w-1/3 md:w-1/2 w-full">
                    <div class="absolute -top-20 md:-start-24 -start-0">
                        <i class="mdi mdi-format-quote-open text-9xl text-white opacity-50"></i>
                    </div>

                    <div class="absolute bottom-28 md:-end-24 -end-0">
                        <i class="mdi mdi-format-quote-close text-9xl text-white opacity-50"></i>
                    </div>

                    <div class="tiny-single-item">
                        <div class="tiny-slide">
                            <div class="text-center">
                                <p class="text-lg text-white/80 italic"> " Veganfry made the processes so easy. Veganfry
                                    instantly increased the amount of interest and ultimately saved us over $10,000. "
                                </p>

                                <div class="text-center mt-5">
                                    <ul class="text-xl font-medium text-amber-400 list-none mb-2">
                                        <li class="inline"><i class="mdi mdi-star"></i></li>
                                        <li class="inline"><i class="mdi mdi-star"></i></li>
                                        <li class="inline"><i class="mdi mdi-star"></i></li>
                                        <li class="inline"><i class="mdi mdi-star"></i></li>
                                        <li class="inline"><i class="mdi mdi-star"></i></li>
                                    </ul>

                                    <img src="/frontend/assets/images/client/1.jpg"
                                        class="h-14 w-14 rounded-full shadow-md dark:shadow-gray-700 mx-auto"
                                        alt="">
                                    <h6 class="mt-2 font-medium text-white">Christa Smith</h6>
                                    <span class="text-white/70 text-sm">Manager</span>
                                </div>
                            </div>
                        </div>

                        <div class="tiny-slide">
                            <div class="text-center">
                                <p class="text-lg text-white/80 italic"> " I highly recommend Veganfry as the new way to
                                    sell your home "by owner". My home sold in 24 hours for the asking price. Best $400
                                    you could spend to sell your home. " </p>

                                <div class="text-center mt-5">
                                    <ul class="text-xl font-medium text-amber-400 list-none mb-2">
                                        <li class="inline"><i class="mdi mdi-star"></i></li>
                                        <li class="inline"><i class="mdi mdi-star"></i></li>
                                        <li class="inline"><i class="mdi mdi-star"></i></li>
                                        <li class="inline"><i class="mdi mdi-star"></i></li>
                                        <li class="inline"><i class="mdi mdi-star"></i></li>
                                    </ul>

                                    <img src="/frontend/assets/images/client/2.jpg"
                                        class="h-14 w-14 rounded-full shadow-md dark:shadow-gray-700 mx-auto"
                                        alt="">
                                    <h6 class="mt-2 font-medium text-white">Christa Smith</h6>
                                    <span class="text-white/70 text-sm">Manager</span>
                                </div>
                            </div>
                        </div>

                        <div class="tiny-slide">
                            <div class="text-center">
                                <p class="text-lg text-white/80 italic"> " My favorite part about selling my home myself
                                    was that we got to meet and get to know the people personally. This made it so much
                                    more enjoyable! " </p>

                                <div class="text-center mt-5">
                                    <ul class="text-xl font-medium text-amber-400 list-none mb-2">
                                        <li class="inline"><i class="mdi mdi-star"></i></li>
                                        <li class="inline"><i class="mdi mdi-star"></i></li>
                                        <li class="inline"><i class="mdi mdi-star"></i></li>
                                        <li class="inline"><i class="mdi mdi-star"></i></li>
                                        <li class="inline"><i class="mdi mdi-star"></i></li>
                                    </ul>

                                    <img src="/frontend/assets/images/client/3.jpg"
                                        class="h-14 w-14 rounded-full shadow-md dark:shadow-gray-700 mx-auto"
                                        alt="">
                                    <h6 class="mt-2 font-medium text-white">Christa Smith</h6>
                                    <span class="text-white/70 text-sm">Manager</span>
                                </div>
                            </div>
                        </div>

                        <div class="tiny-slide">
                            <div class="text-center">
                                <p class="text-lg text-white/80 italic"> " Great experience all around! Easy to use and
                                    efficient. " </p>

                                <div class="text-center mt-5">
                                    <ul class="text-xl font-medium text-amber-400 list-none mb-2">
                                        <li class="inline"><i class="mdi mdi-star"></i></li>
                                        <li class="inline"><i class="mdi mdi-star"></i></li>
                                        <li class="inline"><i class="mdi mdi-star"></i></li>
                                        <li class="inline"><i class="mdi mdi-star"></i></li>
                                        <li class="inline"><i class="mdi mdi-star"></i></li>
                                    </ul>

                                    <img src="/frontend/assets/images/client/4.jpg"
                                        class="h-14 w-14 rounded-full shadow-md dark:shadow-gray-700 mx-auto"
                                        alt="">
                                    <h6 class="mt-2 font-medium text-white">Christa Smith</h6>
                                    <span class="text-white/70 text-sm">Manager</span>
                                </div>
                            </div>
                        </div>

                        <div class="tiny-slide">
                            <div class="text-center">
                                <p class="text-lg text-white/80 italic"> " Veganfry made selling my home easy and stress
                                    free. They went above and beyond what is expected. " </p>

                                <div class="text-center mt-5">
                                    <ul class="text-xl font-medium text-amber-400 list-none mb-2">
                                        <li class="inline"><i class="mdi mdi-star"></i></li>
                                        <li class="inline"><i class="mdi mdi-star"></i></li>
                                        <li class="inline"><i class="mdi mdi-star"></i></li>
                                        <li class="inline"><i class="mdi mdi-star"></i></li>
                                        <li class="inline"><i class="mdi mdi-star"></i></li>
                                    </ul>

                                    <img src="/frontend/assets/images/client/5.jpg"
                                        class="h-14 w-14 rounded-full shadow-md dark:shadow-gray-700 mx-auto"
                                        alt="">
                                    <h6 class="mt-2 font-medium text-white">Christa Smith</h6>
                                    <span class="text-white/70 text-sm">Manager</span>
                                </div>
                            </div>
                        </div>

                        <div class="tiny-slide">
                            <div class="text-center">
                                <p class="text-lg text-white/80 italic"> " Veganfry is fair priced, quick to respond,
                                    and easy to use. I highly recommend their services! " </p>

                                <div class="text-center mt-5">
                                    <ul class="text-xl font-medium text-amber-400 list-none mb-2">
                                        <li class="inline"><i class="mdi mdi-star"></i></li>
                                        <li class="inline"><i class="mdi mdi-star"></i></li>
                                        <li class="inline"><i class="mdi mdi-star"></i></li>
                                        <li class="inline"><i class="mdi mdi-star"></i></li>
                                        <li class="inline"><i class="mdi mdi-star"></i></li>
                                    </ul>

                                    <img src="/frontend/assets/images/client/6.jpg"
                                        class="h-14 w-14 rounded-full shadow-md dark:shadow-gray-700 mx-auto"
                                        alt="">
                                    <h6 class="mt-2 font-medium text-white">Christa Smith</h6>
                                    <span class="text-white/70 text-sm">Manager</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--end grid-->
        </div>

        <div class="absolute bottom-0 start-0 end-0 text-center px-3">
            <h4 class="md:text-3xl text-2xl md:leading-normal leading-normal font-semibold text-white mb-6">Choose your
                mixture & order now!</h4>
        </div>
    </section>

    <section class="relative pt-6 md:pb-24 pb-16 bg-gray-50 dark:bg-slate-800">
        <div class="container relative">
            <div class="grid md:grid-cols-12">
                <div class="lg:col-span-3 md:col-span-3 p-3">
                    <div class="shadow dark:shadow-gray-800 bg-white dark:bg-slate-900 p-4 sticky top-20">
                        <div class="filters-group-wrap text-center">
                            <div class="filters-group">
                                <ul class="mb-0 list-none container-filter-border-bottom filter-options">
                                    <li class="text-sm uppercase font-medium cursor-pointer relative border-b border-transparent text-slate-400 duration-500 active"
                                        data-group="all">All</li>
                                    <li class="text-sm uppercase font-medium mt-3 cursor-pointer relative border-b border-transparent text-slate-400 duration-500"
                                        data-group="1">Breakfast</li>
                                    <li class="text-sm uppercase font-medium mt-3 cursor-pointer relative border-b border-transparent text-slate-400 duration-500"
                                        data-group="lunch">Lunch</li>
                                    <li class="text-sm uppercase font-medium mt-3 cursor-pointer relative border-b border-transparent text-slate-400 duration-500"
                                        data-group="dinner">Dinner</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-9 md:col-span-9">
                    <div id="grid" class="md:flex">
                        <div class="group lg:w-1/4 md:w-1/3 picture-item p-3" data-groups='["1"]'>
                            <div class="group relative overflow-hidden shadow dark:shadow-gray-800">
                                <img src="/frontend/assets/images/menu/1.jpg" class="" alt="">

                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-slate-950 to-transparent opacity-0 group-hover:opacity-100 duration-500">
                                </div>

                                <div
                                    class="absolute -bottom-0 group-hover:bottom-6 start-6 end-6 text-center opacity-0 group-hover:opacity-100 duration-500">
                                    <a href="#"
                                        class="text-lg h5 block text-white hover:text-amber-500 duration-500">Black bean
                                        dip</a>
                                    <h5 class="text-amber-500 font-medium">$25.00</h5>
                                </div>
                            </div>
                        </div>

                        <div class="group lg:w-1/4 md:w-1/3 picture-item p-3" data-groups='["1"]'>
                            <div class="group relative overflow-hidden shadow dark:shadow-gray-800">
                                <img src="/frontend/assets/images/menu/2.jpg" class="" alt="">

                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-slate-950 to-transparent opacity-0 group-hover:opacity-100 duration-500">
                                </div>

                                <div
                                    class="absolute -bottom-0 group-hover:bottom-6 start-6 end-6 text-center opacity-0 group-hover:opacity-100 duration-500">
                                    <a href="#"
                                        class="text-lg h5 block text-white hover:text-amber-500 duration-500">Onion
                                        Pizza</a>
                                    <h5 class="text-amber-500 font-medium">$25.00</h5>
                                </div>
                            </div>
                        </div>

                        <div class="group lg:w-1/4 md:w-1/3 picture-item p-3" data-groups='["break"]'>
                            <div class="group relative overflow-hidden shadow dark:shadow-gray-800">
                                <img src="/frontend/assets/images/menu/3.jpg" class="" alt="">

                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-slate-950 to-transparent opacity-0 group-hover:opacity-100 duration-500">
                                </div>

                                <div
                                    class="absolute -bottom-0 group-hover:bottom-6 start-6 end-6 text-center opacity-0 group-hover:opacity-100 duration-500">
                                    <a href="#"
                                        class="text-lg h5 block text-white hover:text-amber-500 duration-500">Chicken
                                        Breast</a>
                                    <h5 class="text-amber-500 font-medium">$25.00</h5>
                                </div>
                            </div>
                        </div>

                        <div class="group lg:w-1/4 md:w-1/3 picture-item p-3" data-groups='["dinner"]'>
                            <div class="group relative overflow-hidden shadow dark:shadow-gray-800">
                                <img src="/frontend/assets/images/menu/4.jpg" class="" alt="">

                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-slate-950 to-transparent opacity-0 group-hover:opacity-100 duration-500">
                                </div>

                                <div
                                    class="absolute -bottom-0 group-hover:bottom-6 start-6 end-6 text-center opacity-0 group-hover:opacity-100 duration-500">
                                    <a href="#"
                                        class="text-lg h5 block text-white hover:text-amber-500 duration-500">Veg
                                        Pizza</a>
                                    <h5 class="text-amber-500 font-medium">$25.00</h5>
                                </div>
                            </div>
                        </div>

                        <div class="group lg:w-1/4 md:w-1/3 picture-item p-3" data-groups='["break"]'>
                            <div class="group relative overflow-hidden shadow dark:shadow-gray-800">
                                <img src="/frontend/assets/images/menu/5.jpg" class="" alt="">

                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-slate-950 to-transparent opacity-0 group-hover:opacity-100 duration-500">
                                </div>

                                <div
                                    class="absolute -bottom-0 group-hover:bottom-6 start-6 end-6 text-center opacity-0 group-hover:opacity-100 duration-500">
                                    <a href="#"
                                        class="text-lg h5 block text-white hover:text-amber-500 duration-500">Cordon
                                        Bleu</a>
                                    <h5 class="text-amber-500 font-medium">$25.00</h5>
                                </div>
                            </div>
                        </div>

                        <div class="group lg:w-1/4 md:w-1/3 picture-item p-3" data-groups='["lunch"]'>
                            <div class="group relative overflow-hidden shadow dark:shadow-gray-800">
                                <img src="/frontend/assets/images/menu/6.jpg" class="" alt="">

                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-slate-950 to-transparent opacity-0 group-hover:opacity-100 duration-500">
                                </div>

                                <div
                                    class="absolute -bottom-0 group-hover:bottom-6 start-6 end-6 text-center opacity-0 group-hover:opacity-100 duration-500">
                                    <a href="#"
                                        class="text-lg h5 block text-white hover:text-amber-500 duration-500">Boerewors</a>
                                    <h5 class="text-amber-500 font-medium">$25.00</h5>
                                </div>
                            </div>
                        </div>

                        <div class="group lg:w-1/4 md:w-1/3 picture-item p-3" data-groups='["break"]'>
                            <div class="group relative overflow-hidden shadow dark:shadow-gray-800">
                                <img src="/frontend/assets/images/menu/7.jpg" class="" alt="">

                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-slate-950 to-transparent opacity-0 group-hover:opacity-100 duration-500">
                                </div>

                                <div
                                    class="absolute -bottom-0 group-hover:bottom-6 start-6 end-6 text-center opacity-0 group-hover:opacity-100 duration-500">
                                    <a href="#"
                                        class="text-lg h5 block text-white hover:text-amber-500 duration-500">Tarte
                                        Tatin</a>
                                    <h5 class="text-amber-500 font-medium">$25.00</h5>
                                </div>
                            </div>
                        </div>

                        <div class="group lg:w-1/4 md:w-1/3 picture-item p-3" data-groups='["tea"]'>
                            <div class="group relative overflow-hidden shadow dark:shadow-gray-800">
                                <img src="/frontend/assets/images/menu/8.jpg" class="" alt="">

                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-slate-950 to-transparent opacity-0 group-hover:opacity-100 duration-500">
                                </div>

                                <div
                                    class="absolute -bottom-0 group-hover:bottom-6 start-6 end-6 text-center opacity-0 group-hover:opacity-100 duration-500">
                                    <a href="#"
                                        class="text-lg h5 block text-white hover:text-amber-500 duration-500">Green
                                        Tea</a>
                                    <h5 class="text-amber-500 font-medium">$25.00</h5>
                                </div>
                            </div>
                        </div>

                        <div class="group lg:w-1/4 md:w-1/3 picture-item p-3" data-groups='["lunch"]'>
                            <div class="group relative overflow-hidden shadow dark:shadow-gray-800">
                                <img src="/frontend/assets/images/menu/9.jpg" class="" alt="">

                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-slate-950 to-transparent opacity-0 group-hover:opacity-100 duration-500">
                                </div>

                                <div
                                    class="absolute -bottom-0 group-hover:bottom-6 start-6 end-6 text-center opacity-0 group-hover:opacity-100 duration-500">
                                    <a href="#"
                                        class="text-lg h5 block text-white hover:text-amber-500 duration-500">Special
                                        Coffee</a>
                                    <h5 class="text-amber-500 font-medium">$25.00</h5>
                                </div>
                            </div>
                        </div>

                        <div class="group lg:w-1/4 md:w-1/3 picture-item p-3" data-groups='["dinner"]'>
                            <div class="group relative overflow-hidden shadow dark:shadow-gray-800">
                                <img src="/frontend/assets/images/menu/10.jpg" class="" alt="">

                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-slate-950 to-transparent opacity-0 group-hover:opacity-100 duration-500">
                                </div>

                                <div
                                    class="absolute -bottom-0 group-hover:bottom-6 start-6 end-6 text-center opacity-0 group-hover:opacity-100 duration-500">
                                    <a href="#"
                                        class="text-lg h5 block text-white hover:text-amber-500 duration-500">Lemon
                                        Tea</a>
                                    <h5 class="text-amber-500 font-medium">$25.00</h5>
                                </div>
                            </div>
                        </div>

                        <div class="group lg:w-1/4 md:w-1/3 picture-item p-3" data-groups='["tea"]'>
                            <div class="group relative overflow-hidden shadow dark:shadow-gray-800">
                                <img src="/frontend/assets/images/menu/11.jpg" class="" alt="">

                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-slate-950 to-transparent opacity-0 group-hover:opacity-100 duration-500">
                                </div>

                                <div
                                    class="absolute -bottom-0 group-hover:bottom-6 start-6 end-6 text-center opacity-0 group-hover:opacity-100 duration-500">
                                    <a href="#"
                                        class="text-lg h5 block text-white hover:text-amber-500 duration-500">Pancakes</a>
                                    <h5 class="text-amber-500 font-medium">$25.00</h5>
                                </div>
                            </div>
                        </div>

                        <div class="group lg:w-1/4 md:w-1/3 picture-item p-3" data-groups='["lunch"]'>
                            <div class="group relative overflow-hidden shadow dark:shadow-gray-800">
                                <img src="/frontend/assets/images/menu/12.jpg" class="" alt="">

                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-slate-950 to-transparent opacity-0 group-hover:opacity-100 duration-500">
                                </div>

                                <div
                                    class="absolute -bottom-0 group-hover:bottom-6 start-6 end-6 text-center opacity-0 group-hover:opacity-100 duration-500">
                                    <a href="#"
                                        class="text-lg h5 block text-white hover:text-amber-500 duration-500">American
                                        Item</a>
                                    <h5 class="text-amber-500 font-medium">$25.00</h5>
                                </div>
                            </div>
                        </div>

                        <div class="group lg:w-1/4 md:w-1/3 picture-item p-3" data-groups='["tea"]'>
                            <div class="group relative overflow-hidden shadow dark:shadow-gray-800">
                                <img src="/frontend/assets/images/menu/13.jpg" class="" alt="">

                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-slate-950 to-transparent opacity-0 group-hover:opacity-100 duration-500">
                                </div>

                                <div
                                    class="absolute -bottom-0 group-hover:bottom-6 start-6 end-6 text-center opacity-0 group-hover:opacity-100 duration-500">
                                    <a href="#"
                                        class="text-lg h5 block text-white hover:text-amber-500 duration-500">Country
                                        side pizza</a>
                                    <h5 class="text-amber-500 font-medium">$25.00</h5>
                                </div>
                            </div>
                        </div>

                        <div class="group lg:w-1/4 md:w-1/3 picture-item p-3" data-groups='["dinner"]'>
                            <div class="group relative overflow-hidden shadow dark:shadow-gray-800">
                                <img src="/frontend/assets/images/menu/14.jpg" class="" alt="">

                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-slate-950 to-transparent opacity-0 group-hover:opacity-100 duration-500">
                                </div>

                                <div
                                    class="absolute -bottom-0 group-hover:bottom-6 start-6 end-6 text-center opacity-0 group-hover:opacity-100 duration-500">
                                    <a href="#"
                                        class="text-lg h5 block text-white hover:text-amber-500 duration-500">Chilly
                                        garlic potato</a>
                                    <h5 class="text-amber-500 font-medium">$25.00</h5>
                                </div>
                            </div>
                        </div>

                        <div class="group lg:w-1/4 md:w-1/3 picture-item p-3" data-groups='["tea"]'>
                            <div class="group relative overflow-hidden shadow dark:shadow-gray-800">
                                <img src="/frontend/assets/images/menu/15.jpg" class="" alt="">

                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-slate-950 to-transparent opacity-0 group-hover:opacity-100 duration-500">
                                </div>

                                <div
                                    class="absolute -bottom-0 group-hover:bottom-6 start-6 end-6 text-center opacity-0 group-hover:opacity-100 duration-500">
                                    <a href="#"
                                        class="text-lg h5 block text-white hover:text-amber-500 duration-500">Brownie
                                        with vanilla</a>
                                    <h5 class="text-amber-500 font-medium">$25.00</h5>
                                </div>
                            </div>
                        </div>

                        <div class="group lg:w-1/4 md:w-1/3 picture-item p-3" data-groups='["break"]'>
                            <div class="group relative overflow-hidden shadow dark:shadow-gray-800">
                                <img src="/frontend/assets/images/menu/1.jpg" class="" alt="">

                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-slate-950 to-transparent opacity-0 group-hover:opacity-100 duration-500">
                                </div>

                                <div
                                    class="absolute -bottom-0 group-hover:bottom-6 start-6 end-6 text-center opacity-0 group-hover:opacity-100 duration-500">
                                    <a href="#"
                                        class="text-lg h5 block text-white hover:text-amber-500 duration-500">Black bean
                                        dip</a>
                                    <h5 class="text-amber-500 font-medium">$25.00</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container relative md:mt-24 mt-16">
            <div class="grid grid-cols-1 pb-8 text-center">
                <h3 class="mb-6 md:text-3xl text-2xl md:leading-normal leading-normal font-semibold">Food Blogs</h3>

                <p class="text-slate-400 max-w-xl mx-auto">Our buzzy food-hall style concept is inspired by
                    international dining styles, especially in Asia.</p>
            </div><!--end grid-->

            <div class="grid grid-cols-1 lg:grid-cols-3 md:grid-cols-2 mt-6 gap-6">
                <div
                    class="group relative overflow-hidden rounded-md shadow dark:shadow-gray-800 bg-white dark:bg-slate-900">
                    <div class="relative overflow-hidden">
                        <img src="/frontend/assets/images/blog/1.jpg"
                            class="group-hover:scale-110 group-hover:rotate-3 duration-500" alt="">

                        <div class="absolute bottom-0 start-0 p-6">
                            <a href="#"
                                class="bg-amber-500 text-white text-[12px] font-semibold px-2.5 py-0.5">Salad</a>
                        </div>
                    </div>

                    <div class="p-6">
                        <a href="blog-detail.html" class="text-lg hover:text-amber-500 h5">Giant Multi-Stuffed Soft
                            Pretzel</a>
                        <p class="text-slate-400 mt-2">Ut enim ad minim veniamquis nostrud exercitation ullamco</p>

                        <div
                            class="mt-6 pt-6 flex justify-between items-center border-t border-gray-100 dark:border-gray-800">
                            <span class="flex items-center">
                                <img src="/frontend/assets/images/client/1.jpg" class="size-7 rounded-full"
                                    alt="">
                                <a href="#" class="ms-2 text-slate-400 hover:text-amber-500">Calvin Carlo</a>
                            </span>

                            <span class="flex items-center text-[14px]"><i data-feather="calendar" class="h-4 w-4"></i>
                                <span class="ms-1 text-slate-400">April 10, 2024</span></span>
                        </div>
                    </div>
                </div><!--end content-->

                <div
                    class="group relative overflow-hidden rounded-md shadow dark:shadow-gray-800 bg-white dark:bg-slate-900">
                    <div class="relative overflow-hidden">
                        <img src="/frontend/assets/images/blog/2.jpg"
                            class="group-hover:scale-110 group-hover:rotate-3 duration-500" alt="">

                        <div class="absolute bottom-0 start-0 p-6">
                            <a href="#"
                                class="bg-amber-500 text-white text-[12px] font-semibold px-2.5 py-0.5">Breakfast</a>
                        </div>
                    </div>

                    <div class="p-6">
                        <a href="blog-detail.html" class="text-lg hover:text-amber-500 h5">Romantic Breakfast for
                            Two</a>
                        <p class="text-slate-400 mt-2">Ut enim ad minim veniamquis nostrud exercitation ullamco</p>

                        <div
                            class="mt-6 pt-6 flex justify-between items-center border-t border-gray-100 dark:border-gray-800">
                            <span class="flex items-center">
                                <img src="/frontend/assets/images/client/1.jpg" class="size-7 rounded-full"
                                    alt="">
                                <a href="#" class="ms-2 text-slate-400 hover:text-amber-500">Calvin Carlo</a>
                            </span>

                            <span class="flex items-center text-[14px]"><i data-feather="calendar" class="h-4 w-4"></i>
                                <span class="ms-1 text-slate-400">April 10, 2024</span></span>
                        </div>
                    </div>
                </div><!--end content-->

                <div
                    class="group relative overflow-hidden rounded-md shadow dark:shadow-gray-800 bg-white dark:bg-slate-900">
                    <div class="relative overflow-hidden">
                        <img src="/frontend/assets/images/blog/3.jpg"
                            class="group-hover:scale-110 group-hover:rotate-3 duration-500" alt="">

                        <div class="absolute bottom-0 start-0 p-6">
                            <a href="#"
                                class="bg-amber-500 text-white text-[12px] font-semibold px-2.5 py-0.5">Breads</a>
                        </div>
                    </div>

                    <div class="p-6">
                        <a href="blog-detail.html" class="text-lg hover:text-amber-500 h5">Macchiato Pumpkin Soup</a>
                        <p class="text-slate-400 mt-2">Ut enim ad minim veniamquis nostrud exercitation ullamco</p>

                        <div
                            class="mt-6 pt-6 flex justify-between items-center border-t border-gray-100 dark:border-gray-800">
                            <span class="flex items-center">
                                <img src="/frontend/assets/images/client/1.jpg" class="size-7 rounded-full"
                                    alt="">
                                <a href="#" class="ms-2 text-slate-400 hover:text-amber-500">Calvin Carlo</a>
                            </span>

                            <span class="flex items-center text-[14px]"><i data-feather="calendar" class="h-4 w-4"></i>
                                <span class="ms-1 text-slate-400">April 10, 2024</span></span>
                        </div>
                    </div>
                </div><!--end content-->
            </div>
        </div>
    </section>
    <!-- End -->

    <!-- Insta Post Start -->
    <div class="container-fluid relative">
        <div class="grid grid-cols-1 relative">
            <div class="tiny-twelve-item">
                <div class="tiny-slide">
                    <div class="card border-0 rounded-0">
                        <div class="card-body p-0">
                            <a href="/frontend/assets/images/menu/1.jpg" class="lightbox d-inline-block" title="">
                                <img src="/frontend/assets/images/menu/1.jpg" class="" alt="Insta Post">
                                <div class="overlay bg-dark"></div>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="tiny-slide">
                    <div class="card border-0 rounded-0">
                        <div class="card-body p-0">
                            <a href="/frontend/assets/images/menu/2.jpg" class="lightbox d-inline-block" title="">
                                <img src="/frontend/assets/images/menu/2.jpg" class="" alt="Insta Post">
                                <div class="overlay bg-dark"></div>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="tiny-slide">
                    <div class="card border-0 rounded-0">
                        <div class="card-body p-0">
                            <a href="/frontend/assets/images/menu/3.jpg" class="lightbox d-inline-block" title="">
                                <img src="/frontend/assets/images/menu/3.jpg" class="" alt="Insta Post">
                                <div class="overlay bg-dark"></div>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="tiny-slide">
                    <div class="card border-0 rounded-0">
                        <div class="card-body p-0">
                            <a href="/frontend/assets/images/menu/4.jpg" class="lightbox d-inline-block" title="">
                                <img src="/frontend/assets/images/menu/4.jpg" class="" alt="Insta Post">
                                <div class="overlay bg-dark"></div>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="tiny-slide">
                    <div class="card border-0 rounded-0">
                        <div class="card-body p-0">
                            <a href="/frontend/assets/images/menu/5.jpg" class="lightbox d-inline-block" title="">
                                <img src="/frontend/assets/images/menu/5.jpg" class="" alt="Insta Post">
                                <div class="overlay bg-dark"></div>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="tiny-slide">
                    <div class="card border-0 rounded-0">
                        <div class="card-body p-0">
                            <a href="/frontend/assets/images/menu/6.jpg" class="lightbox d-inline-block" title="">
                                <img src="/frontend/assets/images/menu/6.jpg" class="" alt="Insta Post">
                                <div class="overlay bg-dark"></div>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="tiny-slide">
                    <div class="card border-0 rounded-0">
                        <div class="card-body p-0">
                            <a href="/frontend/assets/images/menu/7.jpg" class="lightbox d-inline-block" title="">
                                <img src="/frontend/assets/images/menu/7.jpg" class="" alt="Insta Post">
                                <div class="overlay bg-dark"></div>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="tiny-slide">
                    <div class="card border-0 rounded-0">
                        <div class="card-body p-0">
                            <a href="/frontend/assets/images/menu/8.jpg" class="lightbox d-inline-block" title="">
                                <img src="/frontend/assets/images/menu/8.jpg" class="" alt="Insta Post">
                                <div class="overlay bg-dark"></div>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="tiny-slide">
                    <div class="card border-0 rounded-0">
                        <div class="card-body p-0">
                            <a href="/frontend/assets/images/menu/9.jpg" class="lightbox d-inline-block" title="">
                                <img src="/frontend/assets/images/menu/9.jpg" class="" alt="Insta Post">
                                <div class="overlay bg-dark"></div>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="tiny-slide">
                    <div class="card border-0 rounded-0">
                        <div class="card-body p-0">
                            <a href="/frontend/assets/images/menu/10.jpg" class="lightbox d-inline-block" title="">
                                <img src="/frontend/assets/images/menu/10.jpg" class="" alt="Insta Post">
                                <div class="overlay bg-dark"></div>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="tiny-slide">
                    <div class="card border-0 rounded-0">
                        <div class="card-body p-0">
                            <a href="/frontend/assets/images/menu/11.jpg" class="lightbox d-inline-block" title="">
                                <img src="/frontend/assets/images/menu/11.jpg" class="" alt="Insta Post">
                                <div class="overlay bg-dark"></div>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="tiny-slide">
                    <div class="card border-0 rounded-0">
                        <div class="card-body p-0">
                            <a href="/frontend/assets/images/menu/12.jpg" class="lightbox d-inline-block" title="">
                                <img src="/frontend/assets/images/menu/12.jpg" class="" alt="Insta Post">
                                <div class="overlay bg-dark"></div>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="tiny-slide">
                    <div class="card border-0 rounded-0">
                        <div class="card-body p-0">
                            <a href="/frontend/assets/images/menu/13.jpg" class="lightbox d-inline-block" title="">
                                <img src="/frontend/assets/images/menu/13.jpg" class="" alt="Insta Post">
                                <div class="overlay bg-dark"></div>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="tiny-slide">
                    <div class="card border-0 rounded-0">
                        <div class="card-body p-0">
                            <a href="/frontend/assets/images/menu/14.jpg" class="lightbox d-inline-block" title="">
                                <img src="/frontend/assets/images/menu/14.jpg" class="" alt="Insta Post">
                                <div class="overlay bg-dark"></div>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="tiny-slide">
                    <div class="card border-0 rounded-0">
                        <div class="card-body p-0">
                            <a href="/frontend/assets/images/menu/15.jpg" class="lightbox d-inline-block" title="">
                                <img src="/frontend/assets/images/menu/15.jpg" class="" alt="Insta Post">
                                <div class="overlay bg-dark"></div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="absolute top-2/4 -translate-y-2/4 start-2/4 ltr:-translate-x-2/4 rtl:translate-x-2/4 text-center">
                <a href="https://www.instagram.com/shreethemes/" target="_blank"
                    class="size-9 inline-flex items-center justify-center tracking-wide align-middle duration-500 text-base text-center rounded-md bg-amber-500 border border-amber-500 text-white"><i
                        data-feather="instagram" class="size-4"></i></a>
            </div>
        </div><!--end grid-->
    </div><!--end container-->
    <!-- Insta Post End -->
@endsection
