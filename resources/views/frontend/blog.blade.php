@extends('layout.frontend')
@section('contentUser')
<!-- Start Hero -->
@include('frontend.component.breadcrumb', [
    'titleHeader' => 'Blog và tin tức mới nhất',
    'title' => 'Blogs',
])
<!-- End Hero -->

<section class="relative md:py-24 py-16">
    <div class="container relative">
        <div class="grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-6">
            @foreach ($blogDatas as $item)
                <div
                    class="group relative overflow-hidden rounded-md shadow dark:shadow-gray-800 bg-white dark:bg-slate-900">
                    <div class="relative overflow-hidden">
                        <img src="{{ checkFile($item->image) }}"
                            class="w-full object-cover group-hover:scale-110 group-hover:rotate-3 duration-500"
                            alt=""
                            style="height: 200px;object-fit: cover; object-position: center;">
                    </div>                    

                    <div class="p-6">
                        <a href="{{ route('blog.detail', $item->slug) }}" class="text-lg hover:text-amber-500 h5" style="display: block;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">{{ $item->title }}</a>

                        <div
                            class="mt-6 pt-6 flex justify-between items-center border-t border-gray-100 dark:border-gray-800">
                            <span class="flex items-center">
                                <img src="{{ checkFile($item->user->image) }}" class="size-7 rounded-full" alt="">
                                <a href="#"
                                    class="ms-2 text-slate-400 hover:text-amber-500">{{ $item->user->full_name }}</a>
                            </span>

                            <span class="flex items-center text-[14px]"><i data-feather="calendar" class="h-4 w-4"></i>
                                <span
                                    class="ms-1 text-slate-400">{{ date('d/m/Y', strtotime($item->created_at)) }}</span></span>
                        </div>
                    </div>
                </div><!--end content-->
            @endforeach
        </div><!--end grid-->

        <div class="grid md:grid-cols-12 grid-cols-1 mt-6">
            <div class="md:col-span-12 text-center">
                <nav aria-label="Page navigation example" class="inline-block">
                    <ul class="inline-flex items-center w-full space-x-3">
                        <!-- Nút Previous -->
                        @if ($blogDatas->onFirstPage())
                            <li>
                                <span
                                    class="w-[40px] h-[40px] flex justify-center items-center text-slate-400 bg-gray-100 dark:bg-slate-700 rounded-s-lg border border-gray-100 dark:border-gray-800">
                                    <i data-feather="chevron-left" class="w-4 h-4"></i>
                                </span>
                            </li>
                        @else
                            <li>
                                <a href="{{ $blogDatas->previousPageUrl() }}"
                                    class="w-[40px] h-[40px] flex justify-center items-center text-slate-400 bg-white dark:bg-slate-900 rounded-s-lg hover:text-white border border-gray-100 dark:border-gray-800 hover:border-amber-500 dark:hover:border-amber-500 hover:bg-amber-500 dark:hover:bg-amber-500">
                                    <i data-feather="chevron-left" class="w-4 h-4"></i>
                                </a>
                            </li>
                        @endif

                        <!-- Vòng lặp phân trang -->
                        @for ($i = 1; $i <= $blogDatas->lastPage(); $i++)
                            @if ($i == 1 || $i == $blogDatas->lastPage() || ($i >= $blogDatas->currentPage() - 1 && $i <= $blogDatas->currentPage() + 1))
                                <li>
                                    <a href="{{ $blogDatas->url($i) }}"
                                        class="w-[40px] h-[40px] flex justify-center items-center {{ $i == $blogDatas->currentPage() ? 'text-white bg-amber-500 border border-amber-500' : 'text-slate-400 hover:text-white bg-white dark:bg-slate-900 border border-gray-100 dark:border-gray-800 hover:border-amber-500 dark:hover:border-amber-500 hover:bg-amber-500 dark:hover:bg-amber-500' }}">
                                        {{ $i }}
                                    </a>
                                </li>
                            @elseif ($i == $blogDatas->currentPage() - 2 || $i == $blogDatas->currentPage() + 2)
                                <li><span class="text-gray-500">...</span></li>
                            @endif
                        @endfor

                        <!-- Nút Next -->
                        @if ($blogDatas->hasMorePages())
                            <li>
                                <a href="{{ $blogDatas->nextPageUrl() }}"
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
@endsection