<table class="table mb-0 checkbox-all" id="datatable_1">
    <thead class="table-light">
        <tr>
            <th style="width: 16px;">
                <div class="form-check mb-0 ms-n1">
                    <input type="checkbox" class="form-check-input" name="select-all" id="select-all">
                </div>
            </th>
            <th class="ps-0">{{ __('messages.account.fields.full_name') }}</th>
            <th>{{ __('messages.account.fields.email') }}</th>
            <th>{{ __('messages.account.fields.phone') }}</th>
            <th>{{ __('messages.account.fields.address') }}</th>
            <th>{{ __('messages.system.status') }}</th>
            <th>{{ __('messages.system.table.fields.created_at') }}</th>
            <th class="text-center">{{ __('messages.system.table.fields.action') }}</th>
        </tr>
    </thead>
    <tbody>
        @if (isset($datas) && is_object($datas) && $datas->isNotEmpty())
        @foreach ($datas as $data)
        <tr>
            <td style="width: 16px;">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" value="{{ $data->id }}" name="check"
                        id="customCheck{{ $data->id }}">
                </div>
            </td>
            <td class="ps-0">
                <img src="{{ checkFile($data->image) }}" alt height="40">
                <p class="d-inline-block align-middle mb-0">
                    {{ $data->full_name ?? __('messages.system.no_data_available') }}
                </p>
            </td>
            <td>{{ $data->email ?? __('messages.system.no_data_available') }}</td>
            <td>{{ $data->phone ?? __('messages.system.no_data_available') }}</td>
            <td>{{ $data->address ?? __('messages.system.no_data_available') }}</td>
            <td>
                @php
                $status = request('status') ?: old('status');
                $statuses = __('messages.account.status');
                @endphp

                <select name="status" class="form-select status" data-account-id="{{ $data->id }}">
                    @foreach ($statuses as $key => $option)
                    <option value="{{ $key }}" @selected($status==$key) @selected($data->status == $key)>
                        {{ $option }}
                    </option>
                    @endforeach
                </select>
            </td>
            <td>
                <span>{{ date('d/m/Y H:i:s', strtotime($data->created_at)) }}</span>
            </td>
            <td class="text-end">
                <div class="d-flex align-items-center">
                    <a href="{{ route(__('messages.account.' . $object . '.edit.route'), $data->id) }}" class="me-2">
                        <i class="fas fa-edit btn btn-primary btn-sm"></i>
                    </a>
                    <form action="{{ route(__('messages.account.' . $object . '.destroy.route'), $data->id) }}"
                        method="post" class="d-inline-block" id="myForm_{{ $data->id }}">
                        @csrf
                        @method('DELETE')
                        <button onclick="executeExample('handleDismiss', 'myForm_{{ $data->id }}')" type="button"
                            class="btn btn-danger btn-sm">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </form>
                </div>
            </td>
        </tr>
        @endforeach
        @else
        <tr>
            <td colspan="8" class="text-center">{{ __('messages.system.no_data_available') }}</td>
        </tr>
        @endif
    </tbody>
</table>

<div class="pagination-container">
    {{ $datas->links() }}
</div>