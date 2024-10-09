<div class="fixed top-1/4 -left-2 z-50">
    <span class="relative inline-block rotate-90">
        <input type="checkbox" class="checkbox opacity-0 absolute" id="chk" {{ session('theme')==='dark' ? 'checked'
            : '' }}>
        <label
            class="label bg-slate-900 dark:bg-white shadow dark:shadow-gray-800 cursor-pointer rounded-full flex justify-between items-center p-1 w-14 h-8"
            for="chk">
            <i data-feather="moon" class="w-[18px] h-[18px] text-yellow-500"></i>
            <i data-feather="sun" class="w-[18px] h-[18px] text-yellow-500"></i>
            <span class="ball bg-white dark:bg-slate-900 rounded-full absolute top-[2px] left-[2px] w-7 h-7"></span>
        </label>
    </span>
</div>

<script src="{{ asset('frontend/assets/custom/js/set-theme.js') }}"></script>
<script type="text/javascript">
    setTheme('{{ route('set.theme') }}')
</script>