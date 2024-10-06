<form id="filter-form" class="row g-2" method="get" action="{{ route('admin.category.index') }}">
    <div class="col-auto">
        @php
            $perpage = request('perpage') ?: old('perpage');
        @endphp
        <div class="uk-flex uk-flex-middle uk-flex-space-between">
            <select name="perpage" class="form-control input-sm perpage filter mr10">
                @for ($i = 5; $i <= 200; $i += 5)
                    <option {{ $perpage == $i ? 'selected' : '' }} value="{{ $i }}">{{ $i }} {{ config('apps.setup.perpage') }}</option>
                @endfor
            </select>
        </div>
    </div>
    <div class="col-auto">
        <input type="text" class="form-control" id="search" placeholder="Search..." name="keyword" value="{{ request('keyword') ?: old('keyword') }}">
    </div>

    <div class="col-auto">
        <button type="submit" id="filter-button" name="search" value="search"
            class="btn bg-primary-subtle text-primary d-flex align-items-center">
            <i class="iconoir-filter-alt me-1"></i>
            Search
        </button>
    </div>

    <div class="col-auto">
        <a href="{{ route($config['seo']['create']['route']) }}">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addBoard">
                <i class="fa-solid fa-plus me-1"></i>
                {{ $config['seo']['create']['title'] }}
            </button>
        </a>
    </div>
</form>
