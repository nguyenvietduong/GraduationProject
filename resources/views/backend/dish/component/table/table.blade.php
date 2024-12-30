<table border="1" class="table mb-0 checkbox-all" id="datatable_1">
    <thead class="table-light">
        <tr>
            <th style="width: 16px;">
                <div class="form-check mb-0 ms-n1">
                </div>
            </th>
            {{-- <th>#</th> --}}
            <th>Mã đơn hàng</th>
            <th>{{ __('messages.reservation.fields.reservation_information') }}</th>
            <th>{{ __('messages.reservation.fields.guests') }}</th>
            <th>Thời gian đặt</th>
            <th>{{ __('messages.system.status') }}</th>
            <th>{{ __('messages.reservation.fields.table') }}</th>
            {{-- <th>{{ __('messages.reservation.fields.dish') }}</th> --}}
            <!-- <th class="text-center">{{ __('messages.system.table.fields.action') }}</th> -->
        </tr>
    </thead>
    <tbody>
        @if (isset($datas) && is_object($datas) && $datas->isNotEmpty())
            @foreach ($datas as $data)
                <tr class="{{ $data->status == 'pending' ? 'bg-warning bg-opacity-50' : '' }} tdReservation-{{ $data->id }}"
                    data-reservation="{{ $data->id }}" data-table="{{ $data->table_id }}"
                    data-guest="{{ $data->guests }}" data-reservation-code="{{ $data->code }}">
                    <td style="width: 16px;">
                        <div class="form-check">
                        </div>
                    </td>
                    {{-- <td>{{ $data->id ?? __('messages.system.no_data_available') }}</td> --}}
                    <td>{{ $data->code ?? __('messages.system.no_data_available') }}</td>
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
                    <td>
                        @php
                            $status = request('status') ?: old('status');
                            $statuses = __('messages.reservation.status');
                        @endphp

                        <select name="status" disabled class="form-select status selectReservation"
                            data-account-id="{{ $data->id }}">
                            @foreach ($statuses as $key => $option)
                                <option value="" @selected($data->status == $key)>{{ $option }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td style="">
                        @php
                            $reservationDetails = $data->reservationDetails;
                            // dd($reservationDetails)
                        @endphp
                        @if (isset($reservationDetails) && count($reservationDetails))
                            @foreach ($reservationDetails as $reservationDetail)
                                @php
                                    $table = $reservationDetail->table;
                                @endphp
                                <p>{{ $table->name ?? __('messages.system.no_data_available') }}</p>
                            @endforeach
                        @else
                            <p>Chưa chọn</p>
                        @endif

                    </td>

                    {{-- <td class="text-end">
                        <div class="d-flex align-items-center">
                            <a href="{{ route(__('messages.' . $object . '.edit.route'), $data->id) }}" class="me-2">
                                <button class=" btn btn-primary">Đặt món</button>
                            </a>

                            <button onclick="executeExample('handleDismiss', 'myForm_{{ $data->id }}')"
                                type="button" class="btn btn-warning">
                                Thanh toán
                            </button>
                        </div>
                    </td> --}}
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="8" class="text-center">{{ __('messages.system.no_data_available') }}</td>
            </tr>
        @endif
    </tbody>
</table>

<div class="pagination-container mt-2">
    {{ $datas->links() }}
</div>
