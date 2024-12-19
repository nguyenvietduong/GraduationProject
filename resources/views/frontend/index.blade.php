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

    <section class="relative md:py-16 py-8">
        <div class="container relative">
            <div class="grid grid-cols-1 pb-8 text-center">
                <h3 class="mb-6 md:text-3xl text-2xl md:leading-normal leading-normal font-semibold">Thực đơn của nhà hàng</h3>

                <p class="text-slate-400 max-w-xl mx-auto">Vô vàn món ăn ẩm thực nội ngoại</p>
            </div><!--end grid-->
        </div>
    </section>

    <section class="relative pb-8">
        <div class="container relative">
            <div class="grid md:grid-cols-12">
                <div class="lg:col-span-3 md:col-span-3 p-3">
                    <div class="" style="padding: 30px 0;border: 1px solid #f0f0f0;box-shadow: 10px 10px 10px rgba(0, 0, 0, 0.1) , -8px -8px 8px white">
                        <div class="filters-group-wrap text-center">
                            <div class="filters-group">
                                <ul class="mb-0 list-none container-filter-border-bottom filter-options">
                                    <li class="text-sm uppercase font-medium cursor-pointer relative border-b border-transparent text-slate-400 duration-500 active"
                                        data-group="all">Tất cả</li>

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
                                        <img src="{{ checkFile($menu->image_url) }}"
                                            style="display: block;width:100%; height:150px ; border-radius:10px"
                                         alt="{{ $menu->name ?? 'No Name' }}">
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


    <section class="relative md:py-16 py-8">
        <div class="container relative md:mt-8">
            <div class="grid grid-cols-1 pb-8 text-center">
                <h3 class="mb-6 md:text-3xl text-2xl md:leading-normal leading-normal font-semibold">Tin Tức mới</h3>

                {{-- <p class="text-slate-400 max-w-xl mx-auto">Ý tưởng phong cách nhà hàng đồ ăn của chúng tôi lấy cảm hứng từ
                    phong cách ăn uống quốc tế, đặc biệt là tại châu Á.</p> --}}
            </div><!--end grid-->

            <div class="grid grid-cols-1 lg:grid-cols-3 md:grid-cols-2 mt-6 gap-6">

                @foreach ($listBlogs as $listBlog)
                    <div class="md:px-6 duration-500 text-center" style="display: flex;flex-direction: column; justify-content: center; align-items: center">
                        <div
                            class="d-flex justify-center ">
                            <img src="{{ checkFile($listBlog->image) }}" alt="" class="d-block" style="width 200px;height:200px; ">
                        </div>

                        <div class="content mt-7" style="width: 310px;white-space: nowrap;overflow: hidden;">
                            <a href="{{ route('blog.detail', $listBlog->slug) }}" style="text-overflow: ellipsis" class="title h5 text-lg font-medium hover:text-amber-500" style="font-size: 10px">{{ $listBlog->title }}</a>
                            <p class="text-slate-400 mt-3">{{ date('d/m/Y', strtotime($listBlog->created_at)) }}</p>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>