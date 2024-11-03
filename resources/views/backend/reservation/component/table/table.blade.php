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
            <th>{{ __('messages.system.status') }}</th>
            <th>{{ __('messages.reservation.fields.table') }}</th>
            {{-- <th>{{ __('messages.reservation.fields.dish') }}</th> --}}
            <!-- <th class="text-center">{{ __('messages.system.table.fields.action') }}</th> -->
        </tr>
    </thead>
    <tbody>
        @if (isset($datas) && is_object($datas) && $datas->isNotEmpty())
            @foreach ($datas as $data)
                <tr class="{{ $data->status == 'pending' ? 'bg-warning bg-opacity-50' : '' }} tdReservation"
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
                    <td>
                        @php
                            $status = request('status') ?: old('status');
                            $statuses = __('messages.reservation.status');
                        @endphp

                        <select name="status" class="form-select status selectReservation"
                            data-account-id="{{ $data->id }}">
                            @foreach ($statuses as $key => $option)
                                @if ($data->status == 'pending')
                                    @if ($key != 'completed' && $key != 'arrived')
                                        <option value="{{ $key }}" @selected($status == $key)
                                            @selected($data->status == $key)>
                                            {{ $option }}
                                        </option>
                                    @endif
                                @elseif ($data->status == 'confirmed')
                                    @if ($key != 'pending' && $key != 'canceled' && $key != 'completed')
                                        <option value="{{ $key }}" @selected($status == $key)
                                            @selected($data->status == $key)>
                                            {{ $option }}
                                        </option>
                                    @endif
                                @elseif ($data->status == 'canceled')
                                    @if ($key == 'canceled')
                                        <option value="{{ $key }}" @selected($status == $key)
                                            @selected($data->status == $key)>
                                            {{ $option }}
                                        </option>
                                    @endif
                                @elseif ($data->status == 'arrived')
                                    @if ($key != 'pending' && $key != 'canceled' && $key != 'confirmed')
                                        <option value="{{ $key }}" @selected($status == $key)
                                            @selected($data->status == $key)>
                                            {{ $option }}
                                        </option>
                                    @endif
                                @else
                                    @if ($key != 'pending' && $key != 'completed')
                                        <option value="{{ $key }}" @selected($status == $key)
                                            @selected($data->status == $key)>
                                            {{ $option }}
                                        </option>
                                    @endif
                                @endif
                            @endforeach
                        </select>
                    </td>
                    <td>
                        @if ($data->table_id == null && $data->status == 'arrived')
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-reservation-id="{{ $data->id }}" data-guestsReservation="{{ $data->guests }}"
                                data-bs-target="#exampleModal">
                                {{ __('messages.system.button.choose_table') }}
                            </button>
                        @else
                            <ul>
                                <li>{{ __('messages.table.fields.name') }}:
                                    {{ $data->table->name[App::getLocale()] ?? __('messages.system.no_data_available') }}
                                </li>
                                <li>{{ __('messages.table.fields.description') }}:
                                    {{ $data->table->description[App::getLocale()] ?? __('messages.system.no_data_available') }}
                                </li>
                                <li>{{ __('messages.table.fields.capacity') }}:
                                    {{ $data->table->capacity ?? __('messages.system.no_data_available') }}</li>
                            </ul>
                        @endif
                    </td>

                    <!-- <td class="text-end">
                <div class="d-flex align-items-center">
                    <a href="{{ route(__('messages.' . $object . '.edit.route'), $data->id) }}" class="me-2">
                        <i class="fas fa-edit btn btn-primary btn-sm"></i>
                    </a>
                    <form action="{{ route(__('messages.' . $object . '.destroy.route'), $data->id) }}"
                        method="post" class="d-inline-block" id="myForm_{{ $data->id }}">
                        @csrf
                        @method('DELETE')
                        <button onclick="executeExample('handleDismiss', 'myForm_{{ $data->id }}')" type="button"
                            class="btn btn-danger btn-sm">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </form>
                </div>
            </td> -->
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