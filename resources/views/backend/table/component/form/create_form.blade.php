<form id="myForm" class="p-4 pt-3" action="{{ route(__('messages.table.store.route')) }}" method="post">
    @csrf

    <div class="form-group">
        <div class="row">
            <!-- Tên bàn VI-->
            <div class="col-lg-6 col-12 mb-2">
                <label for="name" class="form-label">Tên bàn <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                    name="name" value="{{ old('name') }}" placeholder="Tên bàn">

                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-lg-6 col-12 mb-2">
                <label for="description" class="form-label">Mô tả</label>
                <input type="text" class="form-control @error('description') is-invalid @enderror" id="description"
                    name="description" value="{{ old('description') }}" placeholder="Mô tả">
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row">
            <!-- Trạng thái -->
            <div class="col-lg-6 col-12 mb-2">
                <label for="status" class="form-label">{{ __('messages.table.fields.status') }} <span
                        class="text-danger">*</span></label>
                <select name="status" id="status" class="form-control @error('status') is-invalid @enderror"
                    required>
                    <option value="available" {{ old('status') == 'available' ? 'selected' : '' }}>Còn chỗ</option>
                    <option value="occupied" {{ old('status') == 'occupied' ? 'selected' : '' }}>Đang dùng</option>
                    <option value="reserved" {{ old('status') == 'reserved' ? 'selected' : '' }}>Có người đặt</option>
                    <option value="out_of_service" {{ old('status') == 'out_of_service' ? 'selected' : '' }}>Không hoạt động
                    </option>
                </select>
                @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Sức chứa -->
            <div class="col-lg-6 col-12 mb-2">
                <label for="capacity" class="form-label">{{ __('messages.table.fields.capacity') }} <span
                        class="text-danger">*</span></label>
                <input type="number" class="form-control @error('capacity') is-invalid @enderror" id="capacity"
                    name="capacity" value="{{ old('capacity') }}" min="1" required>
                @error('capacity')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-end mt-3">
        <button type="submit" class="btn btn-primary me-2">{{ __('messages.system.button.create') }}</button>
        <a href="{{ route(__('messages.table.index.route')) }}">
            <button type="button" class="btn btn-danger">{{ __('messages.system.button.cancel') }}</button>
        </a>
    </div>
</form>
