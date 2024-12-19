@extends('layout.frontend')
@section('contentUser')
<!-- Start Hero -->
@include('frontend.component.breadcrumb',[
$titleHeader = 'Danh sách món ăn',
$title = 'Món ăn'
])
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<style>
    /* Trái tim mặc định có màu xám */
.favorite-action .fa-heart {
    color: red;
    transition: color 0.3s ease;
}

/* Khi yêu thích thì đổi sang màu đỏ */
.favorite-action .fa-heart.favorited {
    color: red;
}

</style>
<!-- End Hero -->
<!-- Start -->
<section class="relative md:py-24 py-16" style="background-color: aliceblue">
    <div class="container relative">
        <div class="grid grid-cols-1 items-center gap-6">
            <div class="filters-group-wrap text-center">
                <div class="filters-group">
                    <ul class="mb-0 list-none container-filter-border-bottom filter-options space-x-3">
                        <li class="inline-block text-sm uppercase font-medium mb-3 cursor-pointer relative border-b border-transparent text-slate-400 duration-500 active"
                            data-group="all">Tất cả</li>
                        @foreach ($categories as $category)
                        <li class="inline-block text-sm uppercase font-medium mb-3 cursor-pointer relative border-b border-transparent text-slate-400 duration-500"
                            data-group="{{ $category->id }}">{{ $category->name ?? '' }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <!--grid-->
    </div>
    <!--end container-->

    <div class="container relative mt-8">
        <div id="grid" class="md:flex justify-center">
            @foreach ($categories as $category)
            @foreach ($category->menus as $menu)
            <div class="group lg:w-1/5 md:w-1/3 picture-item p-3 mt-6" data-groups='["{{ $category->id }}"]'>
                <img src="{{ checkFile($menu->image_url) }}"
                    class="rounded-full size-32 mx-auto group-hover:animate-[spin_10s_linear_infinite]" alt="{{ $menu->name ?? '' }}">

                <div class="mt-4 text-center">
                    <a href="#" class="text-lg h7 block hover:text-amber-500 duration-500">
                        {{ $menu->name ?? '' }}
                    </a>

                    <h5 class="text-amber-500 font-medium mt-2">

                        {{ number_format($menu->price, 0, ',', '.') }} đ

                        @if(isset($bestSeller) && $menu->id === $bestSeller->id)
                            <span class="text-sm font-semibold text-red-500 ml-2" style="color: red">(Best Seller)</span>
                        @endif
                    </h5>
                </div>
                <div class="favorite-action text-xl text-center mt-2">
                    <a href="javascript:void(0);" class="favorite-btn" data-menu-id="{{ $menu->id }}">
                        <!-- Icon trái tim với màu đỏ -->
                        <span class="font-semibold text-red-500 ml-2" style="color: red">{{ $menu->favoritedBy->count() }}</span>
                        @if(auth()->check())
                            <i id="favorite-icon-{{ $menu->id }}" class="{{ $menu->favorited ? 'text-red-500 fa-solid fa-heart' : 'text-gray-500 fa-regular fa-heart' }}"></i>
                        @else
                            <i id="favorite-icon" class="text-red-500 fa-solid fa-heart"></i>
                        @endif 
                    </a>
                </div>                       
            </div>
            <!--end col-->
            @endforeach
            @endforeach
        </div>
    </div>
    <!--end container-->
</section>
<!--end section-->
<!-- End -->
@include('backend.ajax.favorite')

@endsection