@extends('layout.frontend')
@section('contentUser')
<!-- Start Hero -->
@include('frontend.component.breadcrumb', [
    'titleHeader' => $blogData->title,
    'title' => 'Blog Detail',
])
<!-- End Hero -->

<section class="relative md:py-24 py-16">
    <div class="container relative">
        <div class="flex justify-center">
            <div class="lg:w-4/4">
                <div class="p-6 rounded-md shadow dark:shadow-gray-800">
                    <img src="{{ checkFile($blogData->image) }}" class="rounded shadow" alt="">

                    <p class="text-slate-400 mb-4 mt-5">{!! $blogData->content !!}</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection