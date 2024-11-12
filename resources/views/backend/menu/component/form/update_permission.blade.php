<form action="{{ route('admin.role.updatePermission') }}" id="myForm" method="post" class="box">
    @csrf
    <table class="table table-striped table-bordered">
        <tr>
            <th></th>
            @foreach ($roles as $role)
                <th class="text-center">{{ $role->name }}</th>
            @endforeach
        </tr>
        @foreach ($permissions as $permission)
            <tr>
                <td>
                    <div class="">
                        {{ $permission->name }}
                        <span style="color:red;">({{ $permission->slug }})</span>
                    </div>
                </td>
                @foreach ($roles as $role)
                    <td class="text-center">
                        <input {{ collect($role->permissions)->contains('id', $permission->id) ? 'checked' : '' }}
                            type="checkbox" name="permission[{{ $role->id }}][]" value="{{ $permission->id }}"
                            class="form-check-input" id="flexCheckDefault">
                    </td>
                @endforeach
            </tr>
        @endforeach
    </table>
    <div class="d-flex justify-content-end m-3">
        <button type="button" class="btn btn-primary me-2" onclick="executeExample('handleDismiss', 'myForm')">Lưu
            lại</button>
        <a href="{{ route(__('messages.' . $object . '.index.route')) }}"> <button type="button"
                class="btn btn-danger">{{ __('messages.system.button.cancel') }}</button></a>
    </div>
</form>