@php
    $titleHeader = $titleHeader ?? '';
    $title = $title ?? '';
@endphp
<section
    class="relative py-32 bg-no-repeat bg-bottom bg-cover"
    style="background-image: url('{{ asset('frontend/assets/images/bg/bg1.jpg') }}')">
    <div class="absolute inset-0 bg-gradient-to-t from-slate-900 to-slate-900/70"></div>
    <div class="container relative">
        <div class="grid grid-cols-1 text-center mt-2">
            <div>
                <h5 class="md:text-4xl text-3xl md:leading-normal leading-normal font-medium text-white mb-0">
                    {{ $titleHeader }}
                </h5>
            </div>

            <ul class="tracking-[0.5px] mb-0 inline-block mt-5">
                <li class="inline-block capitalize font-medium duration-500 ease-in-out text-white/50 hover:text-white">
                    <a href="{{ route('home') }}">{{ $restaurantDatas->name }}</a>
                </li>
                <li class="inline-block text-base text-white/50 mx-0.5 ltr:rotate-0 rtl:rotate-180"><i
                        class="mdi mdi-chevron-right"></i></li>
                <li class="inline-block capitalize font-medium duration-500 ease-in-out text-white" aria-current="page">
                    {{ $title }}
                </li>
            </ul>
        </div>
    </div>
</section><!--end section-->
<div class="relative">
    <div
        class="shape absolute sm:-bottom-px -bottom-[2px] start-0 end-0 overflow-hidden z-1 text-white dark:text-slate-900">
        <svg class="w-full h-auto scale-[2.0] origin-top" viewBox="0 0 2880 48" fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <path d="M0 48H1437.5H2880V0H2160C1442.5 52 720 0 720 0H0V48Z" fill="currentColor"></path>
        </svg>
    </div>
</div>
