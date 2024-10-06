@extends('layout.frontend')
@section('contentUser')
    <!-- Start Hero -->
    <section class="relative md:py-44 py-32 bg-[url('../../assets/images/bg/pages.html')] bg-no-repeat bg-bottom bg-cover">
        <div class="absolute inset-0 bg-gradient-to-t from-slate-900 to-slate-900/70"></div>
        <div class="container relative">
            <div class="grid grid-cols-1 text-center mt-6">
                <div>
                    <h5 class="md:text-4xl text-3xl md:leading-normal leading-normal font-medium text-white mb-0">
                        Reservation</h5>
                </div>

                <ul class="tracking-[0.5px] mb-0 inline-block mt-5">
                    <li class="inline-block capitalize font-medium duration-500 ease-in-out text-white/50 hover:text-white">
                        <a href="index.html">Veganfry</a>
                    </li>
                    <li class="inline-block text-base text-white/50 mx-0.5 ltr:rotate-0 rtl:rotate-180"><i
                            class="mdi mdi-chevron-right"></i></li>
                    <li class="inline-block capitalize font-medium duration-500 ease-in-out text-white" aria-current="page">
                        Reservation</li>
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
            <div class="flex justify-center">
                <div class="lg:w-2/4">
                    <div class="section-title mb-4">
                        <h4 class="text-2xl font-semibold mb-4">Reserve A Table</h4>
                        <p class="text-slate-400 para-desc">We make it a priority to offer flexible services to
                            accomodate your needs</p>
                    </div>

                    <form>
                        <div class="grid md:grid-cols-2 gap-4 mt-6">
                            <div>
                                <label class="">Your Name</label>
                                <input name="name" id="name" type="text"
                                    class="mt-2 w-full py-2 px-3 h-10 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-100 dark:border-gray-800 focus:ring-0"
                                    placeholder="First Name :">
                            </div>

                            <div>
                                <label class="">Your Email</label>
                                <input name="email" id="email" type="email"
                                    class="mt-2 w-full py-2 px-3 h-10 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-100 dark:border-gray-800 focus:ring-0"
                                    placeholder="Your email :">
                            </div>

                            <div>
                                <label class="">Phone no.</label>
                                <input name="number" type="number" id="phone-number"
                                    class="mt-2 w-full py-2 px-3 h-10 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-100 dark:border-gray-800 focus:ring-0"
                                    placeholder="Phone no. :">
                            </div>

                            <div>
                                <label class="">Person</label>
                                <input type="number" min="0" autocomplete="off" id="adult"
                                    class="mt-2 w-full py-2 px-3 h-10 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-100 dark:border-gray-800 focus:ring-0"
                                    required="" placeholder="Person :">
                            </div>

                            <div>
                                <label class="">Date</label>
                                <input name="date" type="date"
                                    class="mt-2 w-full py-2 px-3 h-10 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-100 dark:border-gray-800 focus:ring-0 start"
                                    placeholder="(ex: mm/ dd/ yy)">
                            </div>

                            <div>
                                <label class="">Time</label>
                                <input name="time" type="text" id="input-time"
                                    class="mt-2 w-full py-2 px-3 h-10 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-100 dark:border-gray-800 focus:ring-0 timepicker"
                                    placeholder="(ex: 8:00 p.m)">
                            </div>
                        </div><!--end grid-->

                        <div class="grid grid-cols-1 mt-4">
                            <input type="submit" id="submit" name="send"
                                class="py-2 px-5 inline-block tracking-wide align-middle duration-500 text-base text-center bg-amber-500 text-white rounded-md mt-2 w-full"
                                value="Book a table">
                        </div><!--end grid-->
                    </form><!--end form-->
                </div>
            </div>
        </div>
    </section>
    <!-- End -->
@endsection
