@extends('layout.frontend')
@section('contentUser')
    <!-- Start Hero -->
    @include('frontend.component.breadcrumb', [
        'titleHeader' => __('messages.system.front_end.page.about_us.contact_us.titleHeader') . '!',
        'title' => __('messages.system.front_end.page.about_us.contact_us.title')
    ])
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
                        <h5 class="title h5 text-lg font-semibold">{{ __('messages.system.front_end.page.about_us.contact_us.phone') }}</h5>

                        <div class="mt-5">
                            <a href="tel:+152534-468-854"
                               class="btn btn-link text-amber-500 hover:text-amber-500 after:bg-amber-500 transition duration-500">(+84)385906406</a>
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
                        <h5 class="title h5 text-lg font-semibold">{{ __('messages.system.front_end.page.about_us.contact_us.email') }}</h5>

                        <div class="mt-5">
                            <a href="mailto:contact@example.com"
                               class="btn btn-link text-amber-500 hover:text-amber-500 after:bg-amber-500 transition duration-500">duongnv@hblab.vn</a>
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
                        <h5 class="title h5 text-lg font-semibold">{{ __('messages.system.front_end.page.about_us.contact_us.location') }}</h5>

                        <div class="mt-5">
                            <a href="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.8639311820657!2d105.74468687486281!3d21.038129780613566!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x313455e940879933%3A0xcf10b34e9f1a03df!2zVHLGsOG7nW5nIENhbyDEkeG6s25nIEZQVCBQb2x5dGVjaG5pYw!5e0!3m2!1svi!2s!4v1728206811213!5m2!1svi!2s"
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
                            <h3 class="mb-6 text-2xl leading-normal font-semibold">{{ __('messages.system.front_end.page.about_us.contact_us.form.title') }}
                                !</h3>

                            <form method="post" name="myForm" id="myForm" onsubmit="return validateForm()">
                                @csrf
                                <p class="mb-0" id="error-msg"></p>
                                <div id="simple-msg"></div>
                                <div class="grid lg:grid-cols-12 gap-4">
                                    <div class="col-span-12">
                                        <label
                                            for="subject">{{ __('messages.system.front_end.page.about_us.contact_us.form.point') }}
                                            :</label>

                                        <div class="stars">
                                            <input type="radio" id="star1" name="rating" value="1"/>
                                            <label for="star1" class="star">★</label>
                                            <input type="radio" id="star2" name="rating" value="2"/>
                                            <label for="star2" class="star">★</label>
                                            <input type="radio" id="star3" name="rating" value="3" checked/>
                                            <label for="star3" class="star">★</label>
                                            <input type="radio" id="star4" name="rating" value="4"/>
                                            <label for="star4" class="star">★</label>
                                            <input type="radio" id="star5" name="rating" value="5"/>
                                            <label for="star5" class="star">★</label>
                                        </div>
                                    </div>

                                    <div class="col-span-12">
                                        <label
                                            for="comment">{{ __('messages.system.front_end.page.about_us.contact_us.form.comment') }}
                                            :</label>
                                        <textarea name="comment" id="comment"
                                                  class="w-full py-2 px-3 h-28 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-100 dark:border-gray-800 focus:ring-0 textarea"
                                        ></textarea>
                                    </div>

                                    <div class="col-span-12">
                                        <button type="submit" id="submit" name="send"
                                                class="py-2 px-5 inline-block tracking-wide align-middle duration-500 text-base text-center bg-amber-500 text-white rounded-md w-full">{{ __('messages.system.front_end.page.about_us.contact_us.form.sendMessage') }}</button>
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

    <style>
        .stars {
            display: flex; /* Sử dụng Flexbox */
            justify-content: space-between; /* Dãn cách đều giữa các sao */
            width: 100%; /* Đảm bảo chiều rộng đầy đủ */
            max-width: 300px; /* Thiết lập chiều rộng tối đa cho các sao */
            margin: auto; /* Để căn giữa trong phần tử cha */
        }

        .stars input {
            display: none; /* Ẩn các ô input */
        }

        .stars label {
            font-size: 2rem; /* Kích thước sao */
            color: gray; /* Màu sao không chọn */
            cursor: pointer; /* Con trỏ khi di chuột vào sao */
            transition: color 0.2s; /* Hiệu ứng chuyển màu mượt mà */
        }

        /* Tô màu vàng cho tất cả các sao bên trái đã chọn */
        .stars input:checked ~ label {
            color: gold; /* Màu vàng cho các sao đã chọn bên trái */
        }

        /* Tô màu vàng cho sao đã chọn */
        .stars input:checked + label {
            color: gold; /* Màu vàng cho sao đã chọn */
        }

        /* Tô màu vàng khi hover và tất cả các sao bên trái */
        .stars label:hover,
        .stars label:hover ~ label {
            color: gold; /* Màu vàng khi di chuột vào sao */
        }

        /* Tô màu vàng cho tất cả các sao đã chọn khi hover */
        .stars input:checked + label:hover,
        .stars input:checked + label:hover ~ label {
            color: gold; /* Màu vàng cho tất cả các sao đã chọn */
        }

        /* Khi hover vào label thì tô màu vàng cho tất cả các sao bên trái */
        .stars label:hover {
            color: gold; /* Màu vàng khi hover */
        }
    </style>
@endsection
