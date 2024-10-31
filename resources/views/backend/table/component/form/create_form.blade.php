<form id="myForm" class="p-4 pt-3" action="{{ route(__('messages.table.store.route')) }}" method="post">
    @csrf

    <div class="form-group">
        <div class="row">
            <!-- Tên bàn EN-->
            <div class="col-lg-6 col-12 mb-2">
                <label for="name" class="form-label">{{ __('messages.table.fields.name_en') }}</label>
                <input type="text" class="form-control @error('name.en') is-invalid @enderror" id="name" name="name[en]"
                       value="{{ old('name.en') }}" placeholder="{{ __('messages.table.fields.name_en') }}">

                @error('name.en')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <!-- Tên bàn VI-->
            <div class="col-lg-6 col-12 mb-2">
                <label for="name" class="form-label">{{ __('messages.table.fields.name_vi') }}</label>
                <input type="text" class="form-control @error('name.vi') is-invalid @enderror" id="name" name="name[vi]"
                       value="{{ old('name.vi') }}" placeholder="{{ __('messages.table.fields.name_vi') }}">

                @error('name.vi')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

        </div>

        <div class="row">
            <!-- Mô tả  EN-->
            <div class="col-lg-6 col-12 mb-2">
                <label for="description" class="form-label">{{ __('messages.table.fields.description_en') }}</label>
                <input type="text" class="form-control @error('description.en') is-invalid @enderror" id="description2"
                       name="description[en]" value="{{ old('description.en') }}" placeholder="{{ __('messages.table.fields.description_en') }}">
                @error('description.en')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Mô tả VI-->
            <div class="col-lg-6 col-12 mb-2">
                <label for="description" class="form-label">{{ __('messages.table.fields.description_vi') }}</label>
                <input type="text" class="form-control @error('description.vi') is-invalid @enderror" id="description"
                       name="description[vi]" value="{{ old('description.vi') }}" placeholder="{{ __('messages.table.fields.description_vi') }}">
                @error('description.vi')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row">
            <!-- Trạng thái -->
            <div class="col-lg-6 col-12 mb-2">
                <label for="status" class="form-label">{{ __('messages.table.fields.status') }}</label>
                <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required>
                    <option value="available" {{ old('status') == 'available' ? 'selected' : '' }}>Available</option>
                    <option value="occupied" {{ old('status') == 'occupied' ? 'selected' : '' }}>Occupied</option>
                    <option value="reserved" {{ old('status') == 'reserved' ? 'selected' : '' }}>Reserved</option>
                    <option value="out_of_service" {{ old('status') == 'out_of_service' ? 'selected' : '' }}>Out of
                        Service
                    </option>
                </select>
                @error('status')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Sức chứa -->
            <div class="col-lg-6 col-12 mb-2">
                <label for="capacity" class="form-label">{{ __('messages.table.fields.capacity') }}</label>
                <input type="number" class="form-control @error('capacity') is-invalid @enderror" id="capacity"
                       name="capacity" value="{{ old('capacity') }}" min="1" required>
                @error('capacity')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        {{-- <!-- Vị trí -->
        <div class="mb-2">
            <label for="position" class="form-label">{{ __('messages.table.fields.position') }}</label>
            <input type="number" class="form-control @error('position') is-invalid @enderror" id="position"
                   name="position" value="{{ old('position') }}" placeholder="{{ __('messages.table.fields.position') }}" onkeyup="checkPosition(this)"
                   required>
            @error('position')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div> --}}

    </div>

    <div class="d-flex justify-content-end mt-3">
        <button type="submit" class="btn btn-primary me-2">{{ __('messages.system.button.create') }}</button>
        <a href="{{ route(__('messages.table.index.route')) }}">
            <button type="button" class="btn btn-danger">{{ __('messages.system.button.cancel') }}</button>
        </a>
    </div>
</form>
