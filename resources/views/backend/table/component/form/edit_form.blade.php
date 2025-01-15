<form id="myForm" class="p-4 pt-3" action="{{ route('admin.' . $object . '.update', $tableData->id) }}" method="post">
    @csrf
    @method('PUT')
    <div class="form-group">
        <div class="row">
            <!-- Tên bàn VI -->
            <div class="col-lg-6 col-12 mb-2">
                <label for="name" class="form-label">Tên bàn <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                    name="name" value="{{ $tableData->name }}" placeholder="Tên bàn">

                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-lg-6 col-12 mb-2">
                <label for="description" class="form-label">Mô tả</label>
                <input type="text" class="form-control @error('description') is-invalid @enderror" id="description"
                    name="description" value="{{ $tableData->description }}" placeholder="Mô tả">
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row">
            <!-- Trạng thái -->
            <div class="col-lg-6 col-12 col-sm-12 mb-2 ">
                <label for="name" class="form-label">{{ __('messages.' . $object . '.fields.status') }} <span
                        class="text-danger">*</span></label>
                <select name="status" id="status" class="form-control @error('status') is-invalid @enderror"
                    {{ old('status', $tableData->status) == 'occupied' ? 'disabled' : '' }} required>
                    <option value="available" @selected(old('status', $tableData->status) == 'available')>Còn chỗ</option>
                    <option value="occupied" @selected(old('status', $tableData->status) == 'occupied')>Đang dùng</option>
                    <option value="reserved" @selected(old('status', $tableData->status) == 'reserved')>Có người đặt</option>
                    <option value="out_of_service" @selected(old('status', $tableData->status) == 'out_of_service')>Không hoạt động</option>
                </select>

                {{-- Thêm input hidden nếu status là occupied --}}
                @if (old('status', $tableData->status) == 'occupied')
                    <input type="hidden" name="status" value="occupied">
                @endif
                @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Sức chứa -->
            <div class="col-lg-6 col-12 mb-2">
                <label for="capacity" class="form-label">{{ __('messages.table.fields.capacity') }} <span
                        class="text-danger">*</span></label>
                <input type="number" class="form-control @error('capacity') is-invalid @enderror" id="capacity"
                    name="capacity" value="{{ $tableData->capacity }}" min="1" required readonly>
                @error('capacity')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

        </div>

        <!-- Vị trí -->
        {{-- <div class="mb-2">
            <label for="position" class="form-label">{{ __('messages.table.fields.position') }} <span
                    class="text-danger">*</span></label>
            <input type="number" class="form-control @error('position') is-invalid @enderror" id="position"
                name="position" value="{{ $tableData->position }}"
                placeholder="{{ __('messages.table.fields.position') }}" onkeyup="checkPosition(this)" required>
            @error('position')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div> --}}

        <!--end row-->
    </div>
    <!--end form-group-->

    <div class="d-flex justify-content-end mt-3">
        <button type="button" class="btn btn-primary me-2"
            onclick="executeExample('handleDismiss', 'myForm')">{{ __('messages.system.button.update') }}</button>
        <a href="{{ route(__('messages.' . $object . '.index.route')) }}"> <button type="button"
                class="btn btn-danger">{{ __('messages.system.button.cancel') }}</button></a>
    </div>
</form>
