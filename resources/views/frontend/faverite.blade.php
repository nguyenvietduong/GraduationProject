@extends('layout.frontend')
@section('contentUser')
<!-- Start Hero -->
@include('frontend.component.breadcrumb',[
$titleHeader = 'Yêu thích',
$title = 'Danh sách yêu thích'
])

<!-- End Hero -->

<!-- Start -->
<div class="container mx-auto py-10">
    <h1 class="text-3xl font-bold text-center mb-8">Danh sách sản phẩm yêu thích</h1>

    <div class="mt-20">
        @if ($favorites->isEmpty())
            <p class="text-center text-gray-500">Bạn chưa thêm sản phẩm nào vào danh sách yêu thích.</p>
        @else
            <div class="grid lg:grid-cols-4 sm:grid-cols-2 grid-cols-1 gap-6">
                @foreach ($favorites as $menu)
                    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                        <img src="{{ checkFile($menu->image_url) }}" alt="{{ $menu->name }}" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <h5 class="text-lg font-semibold text-gray-800">{{ $menu->name }}</h5>
                            <p class="text-gray-600 mt-2 line-clamp-3">{{ $menu->description }}</p>
                            <p class="text-gray-900 font-bold mt-4">Giá: {{ number_format($menu->price, 0, ',', '.') }} VND</p>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
    
</div>

<!-- End -->
@endsection