<table border="1" class="table mb-0 checkbox-all table-centered table-hover">
    <thead class="table-light">
        <tr>
            <th style="width: 16px;">
                <div class="form-check mb-0 ms-n1">
                    <input type="checkbox" class="form-check-input" name="select-all" id="select-all">
                </div>
            </th>
            <th class="ps-0">#</th>
            <th class="ps-0">{{ __('messages.'. $object .'.fields.user_id') }}</th>
            <th class="ps-0">{{ __('messages.'. $object .'.fields.title') }}</th>
            <th class="ps-0">{{ __('messages.'. $object .'.fields.message') }}</th>
            <th>{{ __('messages.system.table.fields.created_at') }}</th>
            <th>{{ __('messages.system.table.fields.updated_at') }}</th>
        </tr>
    </thead>
    <tbody>
        @if (isset($notificationDatas) && is_object($notificationDatas) && $notificationDatas->isNotEmpty())
        @foreach ($notificationDatas as $item)
        <tr>
            <td style="width: 16px;">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" value="{{ $item->id }}" name="check"
                        id="customCheck{{ $item->id }}">
                </div>
            </td>
            <td class="ps-0">
                {{ $item->id ?? __('messages.system.no_data_available') }}
            </td>
            <td class="ps-0">
                <p class="d-inline-block align-middle mb-0">
                    {{ $item->user->full_name ?? __('messages.system.no_data_available') }}
                </p>
            </td>
            <td class="ps-0">
                <p class="d-inline-block align-middle mb-0">
                    {{ $item->title ?? __('messages.system.no_data_available') }}
                </p>
            </td>
            <td class="ps-0">
                <p class="d-inline-block align-middle mb-0">
                    {{ $item->message ?? __('messages.system.no_data_available') }}
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
        </tr>
        @endforeach
        @else
        <tr>
            <td colspan="7" class="text-center">{{ __('messages.system.no_data_available') }}</td>
        </tr>
        @endif
    </tbody>
</table>

<div class="pagination-container p-2">
    {{ $notificationDatas->links() }}
</div>
