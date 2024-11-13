<table border="1" class="table mb-0 checkbox-all" id="datatable_1">
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
                    <td>{{ $data->menu->name ?? __('messages.system.no_data_available') }}</td>
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
