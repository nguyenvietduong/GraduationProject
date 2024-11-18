<table border="1" class="table mb-0 checkbox-all" id="datatable_1">
    <thead class="table-light">
        <tr>
            <th style="width: 16px;">
                <div class="form-check mb-0 ms-n1">
                </div>
            </th>
            <th>#</th>
            <th>{{ __('messages.reservation.fields.reservation_information') }}</th>
            <th>{{ __('messages.reservation.fields.guests') }}</th>
            <th>{{ __('messages.reservation.fields.reservation_time') }}</th>
            {{-- <th>{{ __('messages.system.status') }}</th> --}}
            <th>{{ __('messages.invoice.fields.payment_method') }}</th>
            <th>{{ __('messages.invoice.fields.status') }}</th>
            <th>{{ __('messages.invoice.fields.total_amount') }}</th>
            <th>{{ __('messages.system.table.fields.action') }}</th>
            {{-- <th>{{ __('messages.reservation.fields.dish') }}</th> --}}
            <!-- <th class="text-center">{{ __('messages.system.table.fields.action') }}</th> -->
        </tr>
    </thead>
    <tbody>
        @if (isset($invoiceDatas) && is_object($invoiceDatas) && $invoiceDatas->isNotEmpty())
            @foreach ($invoiceDatas as $data)
                <tr class="{{ $data->status == 'pending' ? 'bg-warning bg-opacity-50' : '' }} tdReservation-{{ $data->id }}"
                    data-reservation="{{ $data->id }}" data-table="{{ $data->table_id }}"
                    data-guest="{{ $data->guests }}">
                    <td style="width: 16px;">
                        <div class="form-check">
                        </div>
                    </td>
                    <td>{{ $data->id ?? __('messages.system.no_data_available') }}</td>
                    <td>
                        <ul>
                            <li>{{ __('messages.reservation.fields.full_name') }}:
                                {{ $data->name ?? __('messages.system.no_data_available') }}</li>
                            <li>{{ __('messages.reservation.fields.email') }}:
                                {{ $data->email ?? __('messages.system.no_data_available') }}</li>
                            <li>{{ __('messages.reservation.fields.phone') }}:
                                {{ $data->phone ?? __('messages.system.no_data_available') }}</li>
                        </ul>
                    </td>
                    <td>{{ $data->guests ?? __('messages.system.no_data_available') }}</td>
                    <td>
                        <div>{{ date('H:i:s', strtotime($data->reservation_time)) }}</div>
                        <div>{{ date('d/m/Y', strtotime($data->reservation_time)) }}</div>
                    </td>
                    {{-- <td>
                        @php
                            $status = request('status') ?: old('status');
                            $statuses = __('messages.reservation.status');
                        @endphp

                        @foreach ($statuses as $key => $option)
                            @if ($data->status == $key)
                                <span class="badge bg-primary">{{ $option }}</span>
                            @endif
                        @endforeach
                    </td> --}}
                    <td>
                        @php
                            $pay = request('pay') ?: old('pay');
                            $pays = __('messages.invoice.payment_method');
                        @endphp

                        @foreach ($pays as $key => $option)
                            @if ($data->invoice->payment_method == $key)
                                <span class="badge bg-primary">{{ $option }}</span>
                            @endif
                        @endforeach
                    </td>
                    <td>
                        @php
                            $status_invoice = request('status_invoice') ?: old('status_invoice');
                            $statuses_invoice = __('messages.invoice.status');
                        @endphp

                        @foreach ($statuses_invoice as $key => $option)
                            @if ($data->invoice->status == $key)
                                <span class="badge bg-primary">{{ $option }}</span>
                            @endif
                        @endforeach
                    </td>
                    <td>
                        {{ number_format($data->invoice->total_amount) ?? __('messages.system.no_data_available') }}
                    </td>
                    <td>
                        <div class="d-flex align-items-center">
                            {{-- <a href="{{ route(__('messages.' . $object . '.detail.route'), $data->id) }}"
                                class="me-2">
                                <i class="fas fa-eye btn btn-success btn-sm"></i>
                            </a> --}}
                            <button type="button" class="btn btn-primary btn-sm me-2" data-bs-toggle="modal"
                                data-bs-target="#bd-example-modal-xl-{{ $data->id }}">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                
                @include('backend.invoice.component.modal')
            @endforeach
        @else
            <tr>
                <td colspan="8" class="text-center">{{ __('messages.system.no_data_available') }}</td>
            </tr>
        @endif
    </tbody>
</table>

<div class="pagination-container mt-2">
    {{ $invoiceDatas->links() }}
</div>
