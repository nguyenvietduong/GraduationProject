<table border="1" class="table mb-0 checkbox-all table-centered table-hover">
    <thead class="table-light">
        <tr>
            <th style="width: 16px;">
                <div class="form-check mb-0 ms-n1">
                    <input type="checkbox" class="form-check-input" name="select-all" id="select-all">
                </div>
            </th>
            <th class="ps-0">#</th>
            <th class="ps-0">{{ __('messages.'. $object .'.fields.name') }}</th>
            <th class="ps-0">{{ __('messages.'. $object .'.fields.price') }}</th>
            <th class="ps-0">{{ __('messages.'. $object .'.fields.category_id') }}</th>
            <th class="ps-0">{{ __('messages.'. $object .'.fields.image_url') }}</th>
            <th class="ps-0">{{ __('messages.'. $object .'.fields.status') }}</th>
            <th>{{ __('messages.system.table.fields.created_at') }}</th>
            <th>{{ __('messages.system.table.fields.action') }}</th>
        </tr>
    </thead>
    <tbody>
        @if (isset($menuDatas) && is_object($menuDatas) && $menuDatas->isNotEmpty())
        @foreach ($menuDatas as $item)
        <tr class="{{$item->status == "active" ? "" : "bg_status"}}">
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
                    {{renderDataByLang($item->name) ?? __('messages.system.no_data_available') }}
                </p>
            </td>
            <td class="ps-0">
                <p class="d-inline-block align-middle mb-0">
                    {{renderDataByLang($item->price , "price")?? __('messages.system.no_data_available') }}
                </p>
            </td>
            <td class="ps-0">
                <p class="d-inline-block align-middle mb-0">
                    
                    {{ renderDataByLang($item->category->name) ?? __('messages.system.no_data_available') }}
                </p>
            </td>
            <td class="ps-0">
               <img src="{{checkFile($item->image_url) }}" alt="Image" style="width:60px">

            </td>
            <td>
                @php
                    $status = request('status') ?: old('status');
                    $statuses = __('messages.menu.status');
                @endphp

                <select name="status" class="form-select status" data-menu-id="{{ $item->id }}">
                    @foreach ($statuses as $key => $option)
                        <option value="{{ $key }}" @selected($status == $key) @selected($item->status == $key)>
                            {{ $option }}
                        </option>
                    @endforeach
                </select>
            </td>
            <td>
                <span>{{ date('d/m/Y H:i:s', strtotime($item->created_at)) ?? __('messages.system.no_data_available')
                    }}</span>
            </td>
            <td>
                <div class="d-flex align-items-center">
                    <a href="{{ route(__('messages.' . $object . '.edit.route'), $item->id) }}" class="me-2">
                        <i class="fas fa-edit btn btn-primary btn-sm"></i>
                    </a>
                    <form action="{{ route(__('messages.' . $object . '.destroy.route'), $item->id) }}" method="post"
                        class="d-inline-block" id="myForm_{{$item->id}}">
                        @csrf
                        @method('DELETE')
                        <button onclick="executeExample('handleDismiss', 'myForm_{{$item->id}}')" type="button"
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
            <td colspan="9" class="text-center">{{ __('messages.system.no_data_available') }}</td>
        </tr>
        @endif
    </tbody>
</table>

<div class="pagination-container p-2">
    {{ $menuDatas->links() }}
</div>