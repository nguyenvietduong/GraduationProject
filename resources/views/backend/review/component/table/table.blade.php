<table border="1" class="table mb-0 checkbox-all" id="datatable_1">
    <thead class="table-light">
        <tr>
            <th style="width: 16px;">
                <div class="form-check mb-0 ms-n1">
                </div>
            </th>
            <th>Mã hóa đơn</th>
            <th class="ps-0">{{ __('messages.review.fields.review_creator') }}</th>
            <th>{{ __('messages.review.fields.rating') }}</th>
            <th>{{ __('messages.review.fields.comment') }}</th>
            <th>{{ __('messages.system.status') }}</th>
            <th>{{ __('messages.system.table.fields.created_at') }}</th>
        </tr>
    </thead>
    <tbody>
        @if (isset($reviewDatas) && is_object($reviewDatas) && $reviewDatas->isNotEmpty())
        @foreach ($reviewDatas as $data)
        <tr id="tr-review-id-{{ $data->id }}" class="{{ $data->status == 'pending' ? 'bg-warning bg-opacity-50' : '' }}">
            <td style="width: 16px;">
                <div class="form-check">
                </div>
            </td>
            <td>{{ $data->id ?? __('messages.system.no_data_available') }}</td>
            <td class="ps-0">
                <p class="d-inline-block align-middle mb-0">
                    Ma don hang <span class="badge text-bg-success">{{ $data->invoice->reservation->code ?? __('messages.system.no_data_available') }}</span>
                    <br>
                    Thong Tin nguoi dat
                    <ul>
                        <li>{{ $data->invoice->reservation->user->full_name ?? __('messages.system.no_data_available') }}</li>
                        <li>{{ $data->invoice->reservation->user->phone ?? __('messages.system.no_data_available') }}</li>
                        <li>{{ $data->invoice->reservation->user->email ?? __('messages.system.no_data_available') }}</li>
                    </ul>

                </p>
            </td>
            <td>{{ $data->rating ?? __('messages.system.no_data_available') }}★</td>
            <td>{{ $data->comment ?? __('messages.system.no_data_available') }}</td>
            <td>
                @php
                $status = request('status') ?: old('status');
                $statuses = __('messages.review.status');
                @endphp

                <select name="status" class="form-select status" data-review-id="{{ $data->id }}">
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
        </tr>
        @endforeach
        @else
        <tr>
            <td colspan="6" class="text-center">{{ __('messages.system.no_data_available') }}</td>
        </tr>
        @endif
    </tbody>
</table>

<div class="pagination-container">
    {{ $reviewDatas->links() }}
</div>