@extends('layout.frontend')
@section('contentUser')
<!-- Start Hero -->
@include('frontend.component.breadcrumb',[
$titleHeader = 'Out Menu',
$title = 'Menu'
])
<!-- End Hero -->
<!-- Start -->
<section class="relative md:py-24 py-16">
    <div class="container relative">
        <div class="grid grid-cols-1 items-center gap-6">
            <div class="filters-group-wrap text-center">
                <div class="filters-group">
                    <ul class="mb-0 list-none container-filter-border-bottom filter-options space-x-3">
                        <li class="inline-block text-sm uppercase font-medium mb-3 cursor-pointer relative border-b border-transparent text-slate-400 duration-500 active"
                            data-group="all">All</li>
                        @foreach ($categories as $category)
                        <li class="inline-block text-sm uppercase font-medium mb-3 cursor-pointer relative border-b border-transparent text-slate-400 duration-500"
                            data-group="{{ $category->id }}">{{ $category->name ?? __('Unknown Name') }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div><!--grid-->
    </div><!--end container-->

    <div class="container relative mt-8">
        <div id="grid" class="md:flex justify-center">
            @foreach ($categories as $category)
            @foreach ($category->menus as $menu)
            <div class="group lg:w-1/5 md:w-1/3 picture-item p-3 mt-6" data-groups='["{{ $category->id }}"]'>
                <img src="{{ checkFile($menu->image_url) }}"
                    class="rounded-full size-32 mx-auto group-hover:animate-[spin_10s_linear_infinite]" alt="{{ $menu->name ?? 'No Name' }}">

                <div class="mt-4 text-center">
                    <a href="#" class="text-lg h7 block hover:text-amber-500 duration-500">{{ $menu->name ?? __('Food Name') }}</a>

                    <h5 class="text-amber-500 font-medium mt-4">{{ $menu->price }} VND</h5>
                </div>
            </div><!--end col-->
            @endforeach
            @endforeach
        </div>
    </div><!--end container-->
</section><!--end section-->
<!-- End -->
@endsection