@extends('layout.frontend')
@section('contentUser')
    <!-- Start Hero -->
<<<<<<< Updated upstream
    @include('frontend.component.breadcrumb', [$title = 'Contact Us'])
=======
    @include('frontend.component.breadcrumb', [
        $titleHeader = 'Get In Touch!', 
        $title = 'Contact Us'
    ])
>>>>>>> Stashed changes
    <!-- End Hero -->

    <!-- Start Section-->
    <section class="relative md:py-24 py-16">
        <div class="container relative">
            <div class="grid grid-cols-1 lg:grid-cols-3 md:grid-cols-2 gap-6">
                <div class="text-center px-6">
                    <div class="relative text-transparent">
                        <div
                            class="size-14 bg-amber-500/5 text-amber-500 rounded-xl text-2xl flex align-middle justify-center items-center mx-auto shadow-sm dark:shadow-gray-800">
                            <i data-feather="phone"></i>
                        </div>
                    </div>

                    <div class="content mt-7">
                        <h5 class="title h5 text-lg font-semibold">Phone</h5>
                        <p class="text-slate-400 mt-3">The phrasal sequence of the is now so that many campaign and benefit
                        </p>

                        <div class="mt-5">
                            <a href="tel:+152534-468-854"
                                class="btn btn-link text-amber-500 hover:text-amber-500 after:bg-amber-500 transition duration-500">+152
                                534-468-854</a>
                        </div>
                    </div>
                </div>

                <div class="text-center px-6">
                    <div class="relative text-transparent">
                        <div
                            class="size-14 bg-amber-500/5 text-amber-500 rounded-xl text-2xl flex align-middle justify-center items-center mx-auto shadow-sm dark:shadow-gray-800">
                            <i data-feather="mail"></i>
                        </div>
                    </div>

                    <div class="content mt-7">
                        <h5 class="title h5 text-lg font-semibold">Email</h5>
                        <p class="text-slate-400 mt-3">The phrasal sequence of the is now so that many campaign and benefit
                        </p>

                        <div class="mt-5">
                            <a href="mailto:contact@example.com"
                                class="btn btn-link text-amber-500 hover:text-amber-500 after:bg-amber-500 transition duration-500">contact@example.com</a>
                        </div>
                    </div>
                </div>

                <div class="text-center px-6">
                    <div class="relative text-transparent">
                        <div
                            class="size-14 bg-amber-500/5 text-amber-500 rounded-xl text-2xl flex align-middle justify-center items-center mx-auto shadow-sm dark:shadow-gray-800">
                            <i data-feather="map-pin"></i>
                        </div>
                    </div>

                    <div class="content mt-7">
                        <h5 class="title h5 text-lg font-semibold">Location</h5>
                        <p class="text-slate-400 mt-3">C/54 Northwest Freeway, Suite 558, <br> Houston, USA 485</p>

                        <div class="mt-5">
                            <a href="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d39206.002432144705!2d-95.4973981212445!3d29.709510002925988!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8640c16de81f3ca5%3A0xf43e0b60ae539ac9!2sGerald+D.+Hines+Waterwall+Park!5e0!3m2!1sen!2sin!4v1566305861440!5m2!1sen!2sin"
                                data-type="iframe"
                                class="video-play-icon read-more lightbox btn btn-link text-amber-500 hover:text-amber-500 after:bg-amber-500 transition duration-500">View
                                on Google map</a>
                        </div>
                    </div>
                </div>
            </div><!--end grid-->
        </div>

        <div class="container md:mt-24 mt-16">
            <div class="grid md:grid-cols-12 grid-cols-1 items-center gap-6">
                <div class="lg:col-span-7 md:col-span-6">
                    <img src="/frontend/assets/images/contact.svg" alt="">
                </div>

                <div class="lg:col-span-5 md:col-span-6">
                    <div class="lg:ms-5">
                        <div class="bg-white dark:bg-slate-900 rounded-md shadow dark:shadow-gray-700 p-6">
                            <h3 class="mb-6 text-2xl leading-normal font-semibold">Get in touch !</h3>

                            <form method="post" name="myForm" id="myForm" onsubmit="return validateForm()">
                                <p class="mb-0" id="error-msg"></p>
                                <div id="simple-msg"></div>
                                <div class="grid lg:grid-cols-12 gap-4">
                                    <div class="lg:col-span-6">
                                        <label for="name">Your Name:</label>
                                        <input name="name" id="name" type="text"
                                            class="w-full py-2 px-3 h-10 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-100 dark:border-gray-800 focus:ring-0"
                                            placeholder="Name :">
                                    </div>

                                    <div class="lg:col-span-6">
                                        <label for="email">Your Email:</label>
                                        <input name="email" id="email" type="email"
                                            class="w-full py-2 px-3 h-10 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-100 dark:border-gray-800 focus:ring-0"
                                            placeholder="Email :">
                                    </div>

                                    <div class="col-span-12">
                                        <label for="subject">Your Question:</label>
                                        <input name="subject" id="subject"
                                            class="w-full py-2 px-3 h-10 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-100 dark:border-gray-800 focus:ring-0"
                                            placeholder="Subject :">
                                    </div>

                                    <div class="col-span-12">
                                        <label for="comments">Your Comment:</label>
                                        <textarea name="comments" id="comments"
                                            class="w-full py-2 px-3 h-28 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-100 dark:border-gray-800 focus:ring-0 textarea"
                                            placeholder="Message :"></textarea>
                                    </div>

                                    <div class="col-span-12">
                                        <button type="submit" id="submit" name="send"
                                            class="py-2 px-5 inline-block tracking-wide align-middle duration-500 text-base text-center bg-amber-500 text-white rounded-md w-full">Send
                                            Message</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--end container-->
    </section>
    <!-- End Section -->

    <div class="container-fluid relative">
        <div class="grid grid-cols-1">
            <div class="w-full leading-[0] border-0">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.8639311820657!2d105.74468687486281!3d21.038129780613566!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x313455e940879933%3A0xcf10b34e9f1a03df!2zVHLGsOG7nW5nIENhbyDEkeG6s25nIEZQVCBQb2x5dGVjaG5pYw!5e0!3m2!1svi!2s!4v1728206811213!5m2!1svi!2s"
                    class="w-full h-[500px]" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div><!--end grid-->
    </div><!--end container-->
@endsection
