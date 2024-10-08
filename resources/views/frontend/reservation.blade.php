@extends('layout.frontend')
@section('contentUser')
    <!-- Start Hero -->
<<<<<<< Updated upstream
    @include('frontend.component.breadcrumb', [$title = 'Reservation'])
=======
    @include('frontend.component.breadcrumb', [
        $titleHeader = 'Reservation', 
        $title = 'Reservation'
    ])
>>>>>>> Stashed changes
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
