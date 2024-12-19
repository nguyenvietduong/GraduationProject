<div class="col-12 col-md mb-2">
    <div class="row">
        <div class="col-4">
            <label for="start_date">{{ __('messages.system.start') }}</label> <!-- Thêm id cho label -->
        </div>
        <div class="col-8">
            <input type="date" class="form-control" id="start_date" name="start_date"
                value="{{ request('start_date') ?: old('start_date') }}">
        </div>
    </div>
</div>

<div class="col-12 col-md mb-2">
    <div class="row">
        <div class="col-4">
            <label for="end_date">{{ __('messages.system.end') }}</label> <!-- Thêm id cho label -->
        </div>
        <div class="col-8">
            <input type="date" class="form-control" id="end_date" name="end_date"
                value="{{ request('end_date') ?: old('end_date') }}">
        </div>
    </div>
</div>

<div class="col-12 col-md-auto mb-2">
    <!-- Keep this column for status dropdown -->
    @php
    $status = request('status') ?: old('status');
    $statuses = __('messages.blog.status');
    @endphp
    <select name="status" class="form-select status filter">
        @foreach ($statuses as $key => $option)
        <option value="{{ $key }}" {{ $status==$key ? 'selected' : '' }}>
            {{ $option }}
        </option>
        @endforeach
    </select>
</div>

<div class="col-12 col-md mb-2">
    <input type="text" class="form-control" id="search" placeholder="Search..." name="keyword"
        value="{{ request('keyword') ?: old('keyword') }}">
</div>