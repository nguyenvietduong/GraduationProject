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
                    <h5 class="title h5 text-lg font-semibold">
                        {{ __('messages.system.front_end.page.about_us.contact_us.phone') }}
                    </h5>

                    <div class="mt-5">
                        <a href="tel:+152534-468-854" class="btn btn-link text-amber-500 hover:text-amber-500 after:bg-amber-500 transition duration-500">{{ $restaurantDatas->phone }}</a>
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
                    <h5 class="title h5 text-lg font-semibold">


                        {{ __('messages.system.front_end.page.about_us.contact_us.email') }}
                    </h5>

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
                    <h5 class="title h5 text-lg font-semibold">
                        {{ __('messages.system.front_end.page.about_us.contact_us.location') }}
                    </h5>

                    <div class="mt-5">
                        <a href="{{ $restaurantDatas->google_map_link }}"
                            data-type="iframe"
                            class="video-play-icon read-more lightbox btn btn-link text-amber-500 hover:text-amber-500 after:bg-amber-500 transition duration-500">View
                            on Google map</a>
                    </div>
                </div>
            </div>
        </div><!--end grid-->
    </div>

    <div class="container relative mt-16">
        <div class="grid lg:grid-cols-2 grid-cols-1 gap-6">
            @foreach ($dataReviews as $itemReview)
            <div class="group relative overflow-hidden rounded-md shadow dark:shadow-gray-800 bg-white dark:bg-slate-900">
                <div class="md:flex md:items-center">
                    <div class="p-6 w-full">
                        <a href="blog-detail.html"
                            class="text-lg font-semibold hover:text-amber-500 block">
                            @for ($i = 1; $i <= $itemReview->rating; $i++)
                                ⭐
                                @endfor
                        </a>
                        <p class="text-slate-400 mt-2">{{ $itemReview->comment }}</p>

                        <div
                            class="mt-6 pt-6 flex justify-between items-center border-t border-gray-100 dark:border-gray-800">
                            <span class="flex items-center">
                                <img src="{{ checkFile($itemReview->user->image) }}"
                                    class="size-7 rounded-full" alt>
                                <a href="#"
                                    class="ms-2 text-slate-400 hover:text-amber-500">{{ $itemReview->user->full_name }}</a>
                            </span>

                            <span
                                class="flex items-center text-[14px]"><i
                                    data-feather="calendar"
                                    class="h-4 w-4"></i> <span
                                    class="ms-1 text-slate-400"></span>{{ date('d/m/Y', strtotime($itemReview->created_at)) }}</span>
                        </div>
                    </div>
                </div>
            </div><!--end content-->
            @endforeach
        </div><!--end content-->
    </div><!--end grid-->

    <div class="grid md:grid-cols-12 grid-cols-1 mt-6">
        <div class="md:col-span-12 text-center">
            <nav aria-label="Page navigation example" class="inline-block">
                <ul class="inline-flex items-center w-full space-x-3">
                    <!-- Nút Previous -->
                    @if ($dataReviews->onFirstPage())
                    <li>
                        <span
                            class="w-[40px] h-[40px] flex justify-center items-center text-slate-400 bg-gray-100 dark:bg-slate-700 rounded-s-lg border border-gray-100 dark:border-gray-800">
                            <i data-feather="chevron-left" class="w-4 h-4"></i>
                        </span>
                    </li>
                    @else
                    <li>
                        <a href="{{ $dataReviews->previousPageUrl() }}"
                            class="w-[40px] h-[40px] flex justify-center items-center text-slate-400 bg-white dark:bg-slate-900 rounded-s-lg hover:text-white border border-gray-100 dark:border-gray-800 hover:border-amber-500 dark:hover:border-amber-500 hover:bg-amber-500 dark:hover:bg-amber-500">
                            <i data-feather="chevron-left" class="w-4 h-4"></i>
                        </a>
                    </li>
                    @endif

                    <!-- Vòng lặp phân trang -->
                    @for ($i = 1; $i <= $dataReviews->lastPage(); $i++)
                        @if ($i == 1 || $i == $dataReviews->lastPage() || ($i >= $dataReviews->currentPage() - 1 && $i <= $dataReviews->currentPage() + 1))
                            <li>
                                <a href="{{ $dataReviews->url($i) }}"
                                    class="w-[40px] h-[40px] flex justify-center items-center {{ $i == $dataReviews->currentPage() ? 'text-white bg-amber-500 border border-amber-500' : 'text-slate-400 hover:text-white bg-white dark:bg-slate-900 border border-gray-100 dark:border-gray-800 hover:border-amber-500 dark:hover:border-amber-500 hover:bg-amber-500 dark:hover:bg-amber-500' }}">
                                    {{ $i }}
                                </a>
                            </li>
                            @elseif ($i == $dataReviews->currentPage() - 2 || $i == $dataReviews->currentPage() + 2)
                            <li><span class="text-gray-500">...</span></li>
                            @endif
                            @endfor

                            <!-- Nút Next -->
                            @if ($dataReviews->hasMorePages())
                            <li>
                                <a href="{{ $dataReviews->nextPageUrl() }}"
                                    class="w-[40px] h-[40px] flex justify-center items-center text-slate-400 bg-white dark:bg-slate-900 rounded-e-lg hover:text-white border border-gray-100 dark:border-gray-800 hover:border-amber-500 dark:hover:border-amber-500 hover:bg-amber-500 dark:hover:bg-amber-500">
                                    <i data-feather="chevron-right" class="w-4 h-4"></i>
                                </a>
                            </li>
                            @else
                            <li>
                                <span
                                    class="w-[40px] h-[40px] flex justify-center items-center text-slate-400 bg-gray-100 dark:bg-slate-700 rounded-e-lg border border-gray-100 dark:border-gray-800">
                                    <i data-feather="chevron-right" class="w-4 h-4"></i>
                                </span>
                            </li>
                            @endif
                </ul>
            </nav>
        </div>
    </div>
    </div><!--end container-->

    <div class="container md:mt-16 mt-16">
        <div class="grid md:grid-cols-12 grid-cols-1 items-center gap-6">
            <div class="lg:col-span-7 md:col-span-6">
                <img src="/frontend/assets/images/contact.svg" alt="">
            </div>

            <div class="lg:col-span-5 md:col-span-6">
                <div class="lg:ms-5">
                    <div class="bg-white dark:bg-slate-900 rounded-md shadow dark:shadow-gray-700 p-6">
                        <h3 class="mb-6 text-2xl leading-normal font-semibold">
                            {{ __('messages.system.front_end.page.about_us.contact_us.form.title') }}
                            !
                        </h3>
                        @if ($errors->any())
                        <div class="error-container">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

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
                                        <input type="radio" id="star1" name="rating" value="1" />
                                        <label for="star1" class="star">★</label>
                                        <input type="radio" id="star2" name="rating" value="2" />
                                        <label for="star2" class="star">★</label>
                                        <input type="radio" id="star3" name="rating" value="3" checked />
                                        <label for="star3" class="star">★</label>
                                        <input type="radio" id="star4" name="rating" value="4" />
                                        <label for="star4" class="star">★</label>
                                        <input type="radio" id="star5" name="rating" value="5" />
                                        <label for="star5" class="star">★</label>
                                    </div>
                                </div>

                                <div class="col-span-12">

                                    <label for="invoiceCode" class="block text-sm font-medium text-gray-700">Invoice Code :</label>
                                    <input type="text" id="invoiceCode" name="invoiceCode"
                                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                        placeholder="Enter your Invoice Code">
                                </div>

                                <div class="col-span-12">
                                    <label
                                        for="comment">{{ __('messages.system.front_end.page.about_us.contact_us.form.comment') }}
                                        :</label>
                                    <textarea name="comment" id="comment"
                                        class="w-full py-2 px-3 h-28 bg-white dark:bg-slate-900 dark:text-slate-200 rounded-md shadow-sm border border-gray-300 dark:border-gray-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                        placeholder="Enter your comment"></textarea>
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
                src="{{ $restaurantDatas->google_map_link }}"
                class="w-full h-[500px]" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div><!--end grid-->
</div><!--end container-->

<style>
    .stars {
        display: flex;
        /* Sử dụng Flexbox */
        justify-content: space-between;
        /* Dãn cách đều giữa các sao */
        width: 100%;
        /* Đảm bảo chiều rộng đầy đủ */
        max-width: 300px;
        /* Thiết lập chiều rộng tối đa cho các sao */
        margin: auto;
        /* Để căn giữa trong phần tử cha */
    }

    .stars input {
        display: none;
        /* Ẩn các ô input */
    }

    .stars label {
        font-size: 2rem;
        /* Kích thước sao */
        color: gray;
        /* Màu sao không chọn */
        cursor: pointer;
        /* Con trỏ khi di chuột vào sao */
        transition: color 0.2s;
        /* Hiệu ứng chuyển màu mượt mà */
    }

    /* Tô màu vàng cho tất cả các sao bên trái đã chọn */
    .stars input:checked~label {
        color: gold;
        /* Màu vàng cho các sao đã chọn bên trái */
    }

    /* Tô màu vàng cho sao đã chọn */
    .stars input:checked+label {
        color: gold;
        /* Màu vàng cho sao đã chọn */
    }

    /* Tô màu vàng khi hover và tất cả các sao bên trái */
    .stars label:hover,
    .stars label:hover~label {
        color: gold;
        /* Màu vàng khi di chuột vào sao */
    }

    /* Tô màu vàng cho tất cả các sao đã chọn khi hover */
    .stars input:checked+label:hover,
    .stars input:checked+label:hover~label {
        color: gold;
        /* Màu vàng cho tất cả các sao đã chọn */
    }

    /* Khi hover vào label thì tô màu vàng cho tất cả các sao bên trái */
    .stars label:hover {
        color: gold;
        /* Màu vàng khi hover */
    }

    .error-container {
        background-color: #f8d7da;
        /* Màu nền đỏ nhạt */
        border: 1px solid #f5c6cb;
        /* Đường viền đỏ */
        color: #721c24;
        /* Màu chữ đỏ đậm */
        padding: 10px;
        /* Đệm bên trong */
        margin-bottom: 20px;
        /* Khoảng cách dưới */
        border-radius: 4px;
        /* Bo góc */
    }

    .error-container ul {
        list-style-type: disc;
        /* Dấu chấm tròn cho danh sách */
        padding-left: 20px;
        /* Khoảng cách bên trái cho danh sách */
    }

    .error-container li {
        margin: 5px 0;
        /* Khoảng cách giữa các mục danh sách */
    }
</style>
@endsection