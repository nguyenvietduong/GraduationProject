@extends('layout.frontend')
@section('contentUser')
    <!-- Start Hero -->
    @include('frontend.component.breadcrumb', [
        'titleHeader' => __('messages.system.front_end.page.about_us.contact_us.titleHeader') . '!',
        'title' => __('messages.system.front_end.page.about_us.contact_us.title'),
    ])
    <!-- End Hero -->

    <!-- Start Section-->
    <section class="relative md:py-24 py-16">
        <div class="container relative">
            <div class="grid grid-cols-1 text-center">
                <h3 class="mb-6 md:text-3xl text-2xl md:leading-normal leading-normal font-semibold">Danh sách đánh giá</h3>
            </div><!--end grid-->
            <div class="grid lg:grid-cols-2 grid-cols-1 gap-6">
                @foreach ($dataReviews as $itemReview)
                    <div
                        class="group relative overflow-hidden rounded-md shadow dark:shadow-gray-800 bg-white dark:bg-slate-900">
                        <div class="md:flex md:items-center">
                            <div class="p-6 w-full">
                                <a href="blog-detail.html" class="text-lg font-semibold hover:text-amber-500 block">
                                    @for ($i = 1; $i <= $itemReview->rating; $i++)
                                        ⭐
                                    @endfor
                                </a>
                                <p class="text-slate-400 mt-2">{{ $itemReview->comment }}</p>

                                <div
                                    class="mt-6 pt-6 flex justify-between items-center border-t border-gray-100 dark:border-gray-800">

                                    <span class="flex items-center text-[14px]"><i data-feather="calendar"
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
                            @if (
                                $i == 1 ||
                                    $i == $dataReviews->lastPage() ||
                                    ($i >= $dataReviews->currentPage() - 1 && $i <= $dataReviews->currentPage() + 1))
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
    </section>
    <!-- End Section -->

    <div class="container-fluid relative">
        <div class="grid grid-cols-1">
            <div class="w-full leading-[0] border-0">
                <iframe src="{{ $restaurantDatas->google_map_link }}" class="w-full h-[500px]" style="border:0;"
                    allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div><!--end grid-->
    </div><!--end container-->

    <style>
        .stars {
            display: flex;
            flex-direction: row-reverse;
            /* Đảo ngược thứ tự hiển thị */
            justify-content: space-between;
            width: 100%;
            max-width: 300px;
            margin: auto;
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
