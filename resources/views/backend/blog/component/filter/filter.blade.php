<div class="col-12 col-md mb-2">
    <div class="row">
        <div class="col-2">
            <label for="start_date">{{ __('messages.system.start') }}</label> <!-- Thêm id cho label -->
        </div>
        <div class="col-10">
            <input type="datetime-local" class="form-control" id="start_date" name="start_date"
                value="{{ request('start_date') ?: old('start_date') }}">
        </div>
    </div>
</div>

<div class="col-12 col-md mb-2">
    <div class="row">
        <div class="col-2">
            <label for="end_date">{{ __('messages.system.end') }}</label> <!-- Thêm id cho label -->
        </div>
        <div class="col-10">
            <input type="datetime-local" class="form-control" id="end_date" name="end_date"
                value="{{ request('end_date') ?: old('end_date') }}">
        </div>
    </div>
</div>

<div class="col-12 col-md mb-2">
    <input type="text" class="form-control" id="search" placeholder="Search..." name="keyword"
        value="{{ request('keyword') ?: old('keyword') }}">
</div>