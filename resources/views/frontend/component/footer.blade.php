<footer class="relative bg-slate-950 dark:bg-slate-950/20 text-gray-200">
    <div class="container relative">
        <div class="grid grid-cols-12">
            <div class="col-span-12">
                <div class="py-[60px] px-0">
                    <div class="grid lg:grid-cols-3 md:grid-cols-2 justify-center gap-6">
                        <div class="text-center">
                            <h5 class="tracking-[1px] text-gray-100 font-medium text-lg mb-4">{{ __('messages.restaurant.fields.opening_hours') }}</h5>
                            <p class="mb-2 text-gray-200/80">{{ $restaurantDatas->opening_hours }} AM - {{ $restaurantDatas->closing_time }} PM</p>
                            
                        </div>

                        <div class="text-center">
                            <h5 class="tracking-[1px] text-gray-100 font-medium text-lg mb-4">{{ __('messages.restaurant.fields.phone') }}</h5>
                            <p class="mb-2"><a href="tel:+152534-468-854" class="text-gray-200/80">{{ $restaurantDatas->phone }}</a></p>
                            {{-- <p class="mb-0"><a href="mailto:contact@example.com"
                                    class="text-gray-200/80">contact@example.com</a></p> --}}
                        </div>

                        <div class="text-center">
                            <h5 class="tracking-[1px] text-gray-100 font-medium text-lg mb-4">{{ __('messages.restaurant.fields.address') }}</h5>
                            <p class="mb-0 text-gray-200/80">{{ $restaurantDatas->address }}</p>
                        </div>
                    </div>
                    <!--end grid-->


                    <div class="grid grid-cols-1 mt-12">
                        <div class="text-center">
                            <img src="{{checkFile($restaurantDatas->image) }}" class="block mx-auto" alt="">
                            <p class="max-w-xl mx-auto mt-6">{{ $restaurantDatas->description }}</p>
                        </div>

                        <ul class="list-none text-center mt-6">
                            <li class="inline"><a href="https://1.envato.market/veganfry" target="_blank"
                                    class="size-8 inline-flex items-center justify-center tracking-wide align-middle text-base border border-gray-800 hover:border-amber-500 rounded-md hover:bg-amber-500"><i
                                        data-feather="shopping-cart" class="size-4 align-middle"
                                        title="Buy Now"></i></a></li>
                            <li class="inline"><a href="https://dribbble.com/shreethemes" target="_blank"
                                    class="size-8 inline-flex items-center justify-center tracking-wide align-middle text-base border border-gray-800 hover:border-amber-500 rounded-md hover:bg-amber-500"><i
                                        data-feather="dribbble" class="size-4 align-middle"
                                        title="dribbble"></i></a></li>
                            <li class="inline"><a href="http://linkedin.com/company/shreethemes" target="_blank"
                                    class="size-8 inline-flex items-center justify-center tracking-wide align-middle text-base border border-gray-800 hover:border-amber-500 rounded-md hover:bg-amber-500"><i
                                        data-feather="linkedin" class="size-4 align-middle"
                                        title="Linkedin"></i></a></li>
                            <li class="inline"><a href="https://www.facebook.com/shreethemes" target="_blank"
                                    class="size-8 inline-flex items-center justify-center tracking-wide align-middle text-base border border-gray-800 hover:border-amber-500 rounded-md hover:bg-amber-500"><i
                                        data-feather="facebook" class="size-4 align-middle"
                                        title="facebook"></i></a></li>
                            <li class="inline"><a href="https://www.instagram.com/shreethemes/" target="_blank"
                                    class="size-8 inline-flex items-center justify-center tracking-wide align-middle text-base border border-gray-800 hover:border-amber-500 rounded-md hover:bg-amber-500"><i
                                        data-feather="instagram" class="size-4 align-middle"
                                        title="instagram"></i></a></li>
                            <li class="inline"><a href="https://twitter.com/shreethemes" target="_blank"
                                    class="size-8 inline-flex items-center justify-center tracking-wide align-middle text-base border border-gray-800 hover:border-amber-500 rounded-md hover:bg-amber-500"><i
                                        data-feather="twitter" class="size-4 align-middle" title="twitter"></i></a>
                            </li>
                            <li class="inline"><a href="mailto:support@shreethemes.in"
                                    class="size-8 inline-flex items-center justify-center tracking-wide align-middle text-base border border-gray-800 hover:border-amber-500 rounded-md hover:bg-amber-500"><i
                                        data-feather="mail" class="size-4 align-middle" title="email"></i></a>
                            </li>
                        </ul>
                        <!--end icon-->
                    </div>
                    <!--end grid-->
                </div>
            </div>
        </div>
        <!--end grid-->
    </div>
    <!--end container-->

    <div class="py-[30px] px-0 border-t border-slate-800">
        <div class="container relative text-center">
            <div class="grid md:grid-cols-1">
                <p class="mb-0">©
                    <script>
                        document.write(new Date().getFullYear())
                    </script> ĐỒ ÁN TỐT NGHIỆP <i class="mdi mdi-heart text-red-600"></i> TRƯỜNG <a
                        href="https://shreethemes.in/" target="_blank" class="text-reset">FPT POLYTECHNIC</a>.
                </p>
            </div>
            <!--end grid-->
        </div>
        <!--end container-->
    </div>
</footer>