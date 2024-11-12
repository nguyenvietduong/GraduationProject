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
                                    Cảm Nhận <br> Sự Khác Biệt</h1>
                                <p class="text-white/70 text-lg max-w-xl">Món salad mì trộn phong cách deli của tôi với
                                    nhiều
                                    rau củ! Tôi thay thế một phần mì bằng bí mùa hè xoắn và sốt tahini béo ngậy.</p>

                                <div class="mt-8">
                                    <a href="{{ route('menu') }}"
                                        class="py-2 px-5 inline-block tracking-wide align-middle duration-500 text-base text-center text-amber-500 hover:text-white bg-transparent hover:bg-amber-500 border border-amber-500">Xem
                                        Thực Đơn</a>
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
                                    Cảm Nhận <br> Mọi Người</h1>
                                <p class="text-white/70 text-lg max-w-xl">Món salad mì trộn phong cách deli của tôi với
                                    nhiều
                                    rau củ! Tôi thay thế một phần mì bằng bí mùa hè xoắn và sốt tahini béo ngậy.</p>

                                <div class="mt-8">
                                    <a href="{{ route('reservation') }}"
                                        class="py-2 px-5 inline-block tracking-wide align-middle duration-500 text-base text-center text-amber-500 hover:text-white bg-transparent hover:bg-amber-500 border border-amber-500">Đặt
                                        Bàn</a>
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
                        <h4 class="text-3xl font-semibold">Câu Chuyện Của Chúng Tôi</h4>

                        <p class="text-slate-400 mt-6">Ý tưởng phong cách nhà hàng đồ ăn của chúng tôi lấy cảm hứng từ phong
                            cách ăn uống quốc tế, đặc biệt là tại châu Á. Khám phá những quầy đồ ăn sôi động khi các đầu bếp
                            làm việc không ngừng.</p>
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
                                <h5 class="text-white/80 group-hover:text-white duration-500 text-xl">Thực Đơn Ăn Tối</h5>
                            </div>
                        </div>

                        <div class="group relative">
                            <img src="/frontend/assets/images/menu/m3.jpg" alt="">
                            <div class="absolute inset-0 bg-slate-950/50"></div>
                            <div class="absolute inset-0 m-6 border border-white/30"></div>
                            <div class="absolute bottom-12 start-0 end-0 text-center">
                                <h5 class="text-white/80 group-hover:text-white duration-500 text-xl">Thực Đơn Tráng Miệng
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container relative md:mt-24 mt-16">
            <div class="grid grid-cols-1 pb-8 text-center">
                <h3 class="mb-6 md:text-3xl text-2xl md:leading-normal leading-normal font-semibold">Dịch Vụ</h3>

                <p class="text-slate-400 max-w-xl mx-auto">Ý tưởng phong cách nhà hàng đồ ăn của chúng tôi lấy cảm hứng từ
                    phong cách ăn uống quốc tế, đặc biệt là tại châu Á.</p>
            </div><!--end grid-->

            <div class="grid grid-cols-1 lg:grid-cols-3 md:grid-cols-2 mt-6 gap-6">
                <div class="md:px-6 duration-500 text-center">
                    <div
                        class="size-20 bg-amber-500/5 mx-auto text-amber-500 text-3xl flex align-middle justify-center items-center shadow-sm dark:shadow-gray-800">
                        <i class="mdi mdi-pizza"></i>
                    </div>

                    <div class="content mt-7">
                        <a href="#" class="title h5 text-lg font-medium hover:text-amber-500">Đáp ứng phong cách ẩm
                            thực</a>
                        <p class="text-slate-400 mt-3">Đáp ứng phong cách ẩm thực của mọi người</p>
                    </div>
                </div>

                <div class="md:px-6 duration-500 text-center">
                    <div
                        class="size-20 bg-amber-500/5 mx-auto text-amber-500 text-3xl flex align-middle justify-center items-center shadow-sm dark:shadow-gray-800">
                        <i class="mdi mdi-silverware"></i>
                    </div>

                    <div class="content mt-7">
                        <a href="#" class="title h5 text-lg font-medium hover:text-amber-500">Chất lượng nhà hàng</a>
                        <p class="text-slate-400 mt-3"> Chất lượng nhà hàng đặt lên hàng đầu </p>
                    </div>
                </div>

                <div class="md:px-6 duration-500 text-center">
                    <div
                        class="size-20 bg-amber-500/5 mx-auto text-amber-500 text-3xl flex align-middle justify-center items-center shadow-sm dark:shadow-gray-800">
                        <i class="mdi mdi-moped-outline"></i>
                    </div>

                    <div class="content mt-7">
                        <a href="#" class="title h5 text-lg font-medium hover:text-amber-500">Giao hàng tận nhà</a>
                        <p class="text-slate-400 mt-3">Giao hàng tận nơi, đến tận tay người dùng</p>
                    </div>
                </div>
            </div>
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
                                        data-group="all">{{ __('All') }}</li>

                                    @foreach ($categories as $category)
                                        <li class="text-sm uppercase font-medium mt-3 cursor-pointer relative border-b border-transparent text-slate-400 duration-500"
                                            data-group="{{ $category->id }}">
                                            {{ $category->name ?? __('Unknown Name') }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-9 md:col-span-9">
                    <div id="grid" class="md:flex flex-wrap">
                        @foreach ($categories as $category)
                            @foreach ($category->menus as $menu)
                                <div class="group lg:w-1/4 md:w-1/3 picture-item p-3" data-groups='["{{ $category->id }}"]'>
                                    <div class="group relative overflow-hidden shadow dark:shadow-gray-800">
                                        <img src="{{ checkFile($menu->image_url) }}" alt="{{ $menu->name ?? 'No Name' }}">
                                        <div
                                            class="absolute inset-0 bg-gradient-to-t from-slate-950 to-transparent opacity-0 group-hover:opacity-100 duration-500">
                                        </div>

                                        <div
                                            class="absolute -bottom-0 group-hover:bottom-6 start-6 end-6 text-center opacity-0 group-hover:opacity-100 duration-500">
                                            <a href="#"
                                                class="text-lg h5 block text-white hover:text-amber-500 duration-500">{{ $menu->name ?? __('Food Name') }}</a>
                                            <h5 class="text-amber-500 font-medium">{{ $menu->price }} VND</h5>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>