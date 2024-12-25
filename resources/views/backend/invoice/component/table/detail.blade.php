<h4 class="m-3">{{ __('messages.invoice.fields.invoice_detail') }}</h4>
<table border="1" class="table mb-0 checkbox-all">
    <thead class="table-light">
        <tr>
            <th style="width: 16px;">
                <div class="form-check mb-0 ms-n1">
                </div>
            </th>
            <th>#</th>
            <th>{{ __('messages.invoice.fields.menu') }}</th>
            <th>{{ __('messages.invoice.fields.quantity') }}</th>
            <th>{{ __('messages.invoice.fields.price') }}</th>
            <th>{{ __('messages.invoice.fields.total') }}</th>
        </tr>
    </thead>
    <tbody>
        @if (isset($invoiceDetail) && is_object($invoiceDetail) && $invoiceDetail->isNotEmpty())
            @foreach ($invoiceDetail as $key => $data)
                <tr>
                    <td style="width: 16px;">
                        <div class="form-check">
                        </div>
                    </td>
                    <td>{{ $key + 1 ?? __('messages.system.no_data_available') }}</td>
                    <td>{{ $data->menu_name ?? __('messages.system.no_data_available') }}</td>
                    <td>{{ $data->quantity ?? __('messages.system.no_data_available') }}</td>
                    <td>{{ $data->price ?? __('messages.system.no_data_available') }}</td>
                    <td>{{ $data->total ?? __('messages.system.no_data_available') }}</td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="8" class="text-center">{{ __('messages.system.no_data_available') }}</td>
            </tr>
        @endif
    </tbody>
</table>
<h4 class="m-3 ">{{ __('messages.reservation_details.fields.reservation_detail') }}</h4>
<table border="1" class="table mb-0 checkbox-all">
    <thead class="table-light">
        <tr>
            <th style="width: 16px;">
                <div class="form-check mb-0 ms-n1">
                </div>
            </th>
            <th>#</th>
            <th>{{ __('messages.reservation_details.fields.table_id') }}</th>
            <th>{{ __('messages.reservation_details.fields.guests_detail') }}</th>
        </tr>
    </thead>
    <tbody>
        @if (isset($reservationDetail) && is_object($reservationDetail) && $reservationDetail->isNotEmpty())
            @foreach ($reservationDetail as $key => $data)
                <tr>
                    <td style="width: 16px;">
                        <div class="form-check">
                        </div>
                    </td>
                    <td>{{ $key + 1 ?? __('messages.system.no_data_available') }}</td>
                    <td>{{ $data->table_name ?? __('messages.system.no_data_available') }}</td>
                    <td>{{ $data->guests_detail ?? __('messages.system.no_data_available') }}</td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="8" class="text-center">{{ __('messages.system.no_data_available') }}</td>
            </tr>
        @endif
    </tbody>
</table>