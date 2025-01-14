<table border="1" class="table mb-0 checkbox-all table-centered table-hover">
    <thead class="table-light">
        <tr>
            <th style="width: 16px;">
                <div class="form-check mb-0 ms-n1">
                </div>
            </th>
            <th class="ps-0">#</th>
            <th class="ps-0">{{ __('messages.'. $object .'.fields.name') }}</th>
            <th>{{ __('messages.system.table.fields.created_at') }}</th>
            <th>{{ __('messages.system.table.fields.updated_at') }}</th>
            <th>{{ __('messages.system.table.fields.action') }}</th>
        </tr>
    </thead>
    <tbody>
        @if (isset($permissionDatas) && is_object($permissionDatas) && $permissionDatas->isNotEmpty())
        @foreach ($permissionDatas as $item)
        <tr>
            <td style="width: 16px;">
                <div class="form-check">
                </div>
            </td>
            <td class="ps-0">
                {{ $item->id ?? __('messages.system.no_data_available') }}
            </td>
            <td class="ps-0">
                <p class="d-inline-block align-middle mb-0">
                    {{ $item->name ?? __('messages.system.no_data_available') }}
                </p>
            </td>
            <td>
                <span>{{ date('d/m/Y H:i:s', strtotime($item->created_at)) ?? __('messages.system.no_data_available')
                    }}</span>
            </td>
            <td>
                <span>{{ date('d/m/Y H:i:s', strtotime($item->updated_at)) ?? __('messages.system.no_data_available')
                    }}</span>
            </td>
            <td>
                <div class="d-flex align-items-center">
                    <a href="{{ route(__('messages.' . $object . '.edit.route'), $item->id) }}" class="me-2">
                        <i class="fas fa-edit btn btn-primary btn-sm"></i>
                    </a>
                    {{-- <form action="{{ route(__('messages.' . $object . '.destroy.route'), $item->id) }}" method="post"
                        class="d-inline-block" id="myForm_{{ $item->id }}">
                        @csrf
                        @method('DELETE')
                        <button onclick="executeExample('handleDismiss', 'myForm_{{ $item->id }}')" type="button"
                            class="btn btn-danger btn-sm">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </form> --}}
                </div>
            </td>
        </tr>
        @endforeach
        @else
        <tr>
            <td colspan="6" class="text-center">{{ __('messages.system.no_data_available') }}</td>
        </tr>
        @endif
    </tbody>
</table>

<div class="pagination-container p-2">
    {{ $permissionDatas->links() }}
</div>