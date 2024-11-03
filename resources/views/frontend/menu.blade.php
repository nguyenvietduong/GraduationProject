@extends('layout.frontend')
@section('contentUser')
    <!-- Start Hero -->
    @include('frontend.component.breadcrumb',[
        $titleHeader = 'Out Menu',
        $title = 'Menu'
    ])
    <!-- End Hero -->

    <!-- Start -->
    <section class="relative pt-6 md:pb-24 pb-16 bg-gray-50 dark:bg-slate-800">
        <div class="container relative">
            <div class="grid md:grid-cols-12">
                <div class="lg:col-span-3 md:col-span-3 p-3">
                    <div class="shadow dark:shadow-gray-800 bg-white dark:bg-slate-900 p-4 sticky top-20">
                        <div class="filters-group-wrap text-center">
                            <div class="filters-group">
                                <ul class="mb-0 list-none container-filter-border-bottom filter-options">
                                    <li class="text-sm uppercase font-medium cursor-pointer relative border-b border-transparent text-slate-400 duration-500 active"
                                        data-group="all">{{ __('All') }}</li> <!-- Thêm hàm dịch __() để lấy nội dung theo ngôn ngữ -->

                                    @foreach ($categories as $category)
                                        <li class="text-sm uppercase font-medium mt-3 cursor-pointer relative border-b border-transparent text-slate-400 duration-500"
                                            data-group="{{ $category->id }}">
                                            {{ $category->name[app()->getLocale()] ?? __('Unknown Name') }}
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
                                        <img src="{{ asset('frontend/assets/images/menu/' . $menu->image_url) }}" class="" alt="{{ $menu->name[app()->getLocale()] ?? 'No Name' }}">

                                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950 to-transparent opacity-0 group-hover:opacity-100 duration-500"></div>

                                        <div class="absolute -bottom-0 group-hover:bottom-6 start-6 end-6 text-center opacity-0 group-hover:opacity-100 duration-500">
                                            <a href="#"
                                               class="text-lg h5 block text-white hover:text-amber-500 duration-500">{{ $menu->name[app()->getLocale()] ?? __('Food Name') }}</a>
                                            <h5 class="text-amber-500 font-medium">{{ $menu->price[app()->getLocale()] ?? __('0 VND') }}</h5>
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
    <!-- End -->
@endsection
