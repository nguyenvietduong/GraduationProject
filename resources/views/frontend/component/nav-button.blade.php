<ul class="buy-button list-none mb-0">
    <li class="dropdown inline-block relative pe-1">
        <button data-dropdown-toggle="dropdown" class="dropdown-toggle align-middle inline-flex search-dropdown"
            type="button">
            <i data-feather="search" class="size-5 dark-icon"></i>
            <i data-feather="search" class="size-5 white-icon text-white"></i>
        </button>
        <!-- Dropdown menu -->
        <div class="dropdown-menu absolute overflow-hidden end-0 m-0 mt-5 z-10 md:w-52 w-48 rounded-md bg-white dark:bg-slate-900 shadow dark:shadow-gray-800 hidden"
            onclick="event.stopPropagation();">
            <div class="relative">
                <i data-feather="search" class="size-4 absolute top-[9px] end-3"></i>
                <input type="text"
                    class="h-9 px-3 pe-10 w-full border-0 focus:ring-0 outline-none bg-white dark:bg-slate-900 shadow dark:shadow-gray-800"
                    name="s" id="searchItem" placeholder="Search...">
            </div>
        </div>
    </li>

    <li class="dropdown inline-block relative ps-0.5">
        <button data-dropdown-toggle="dropdown"
            class="dropdown-toggle size-9 inline-flex items-center justify-center tracking-wide align-middle duration-500 text-base text-center rounded-full bg-amber-500 border border-amber-500 text-white"
            type="button">
            <i data-feather="shopping-cart" class="h-4 w-4"></i>
        </button>
        <!-- Dropdown menu -->
        <div class="dropdown-menu absolute end-0 m-0 mt-4 z-10 w-64 rounded-md bg-white dark:bg-slate-900 shadow dark:shadow-gray-800 hidden"
            onclick="event.stopPropagation();">
            <ul class="py-3 text-start" aria-labelledby="dropdownDefault">
                <li class="py-1.5 px-4">Empty Cart</li>
            </ul>
        </div>
    </li>

    <li class="inline-block ps-0.5">
        <a href="javascript:void(0)"
            class="size-9 inline-flex items-center justify-center tracking-wide align-middle duration-500 text-base text-center rounded-full bg-amber-500 text-white">
            <i data-feather="heart" class="h-4 w-4"></i>
        </a>
    </li>
</ul>