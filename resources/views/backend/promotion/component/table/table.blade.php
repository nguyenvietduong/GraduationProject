<table border="1" class="table mb-0 checkbox-all table-centered table-hover">
    <thead class="table-light">
        <tr>
            <th style="width: 16px;">
                <div class="form-check mb-0 ms-n1">
                    <input type="checkbox" class="form-check-input" name="select-all" id="select-all">
                </div>
            </th>
            <th class="ps-0">#</th>
            <th class="ps-0">{{ __('messages.' . $object . '.fields.name') }}</th>
            <th class="ps-0">{{ __('messages.' . $object . '.fields.code') }}</th>
            <th class="text-center">{{ __('messages.system.table.fields.action') }}</th>
            <th>{{ __('messages.system.table.fields.created_at') }}</th>
            <th>{{ __('messages.system.table.fields.updated_at') }}</th>
            <th>{{ __('messages.system.table.fields.action') }}</th>
        </tr>
    </thead>
    <tbody>
        @if (isset($promotionDatas) && is_object($promotionDatas) && $promotionDatas->isNotEmpty())
            @foreach ($promotionDatas as $item)
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
                            {{ $item->title ?? __('messages.system.no_data_available') }}
                        </p>
                    </td>
                    <td class="ps-0">
                        <p class="d-inline-block align-middle mb-0">
                            {{ $item->code ?? __('messages.system.no_data_available') }}
                        </p>
                    </td>
                    <td class="text-center">
                        <p class="d-inline-block align-middle mb-0">
                            <select name="" class="form-select statusPromotion"
                                data-promotion="{{ $item->id }}" id="">
                                @foreach (__('messages.promotion.status') as $key => $value)
                                    <option value="{{ $key }}" @selected($item->is_active == $key)>
                                        {{ $value }}</option>
                                @endforeach
                            </select>
                        </p>
                    </td>
                    <td>
                        <span>{{ date('d/m/Y H:i:s', strtotime($item->created_at)) ?? __('messages.system.no_data_available') }}</span>
                    </td>
                    <td class="updatePromotion">
                        <span>{{ date('d/m/Y H:i:s', strtotime($item->updated_at)) ?? __('messages.system.no_data_available') }}</span>
                    </td>
                    <td>
                        <div class="d-flex align-items-center">
                            <button type="button" class="btn btn-primary btn-sm me-2" data-bs-toggle="modal"
                                data-bs-target="#bd-example-modal-xl-{{ $item->id }}">
                                <i class="fas fa-eye"></i>
                            </button>
                            <a href="{{ route(__('messages.' . $object . '.edit.route'), $item->id) }}" class="me-2">
                                <button class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </button>
                            </a>
                            <form action="{{ route(__('messages.' . $object . '.destroy.route'), $item->id) }}"
                                method="post" class="d-inline-block" id="myForm_{{ $item->id }}">
                                @csrf
                                @method('DELETE')
                                <button onclick="executeExample('handleDismiss', 'myForm_{{ $item->id }}')"
                                    type="button" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @include('backend.promotion.component.modal')
            @endforeach
        @else
            <tr>
                <td colspan="6" class="text-center">{{ __('messages.system.no_data_available') }}</td>
            </tr>
        @endif
    </tbody>
</table>


<div class="pagination-container p-2">
    {{ $promotionDatas->links() }}
</div>
