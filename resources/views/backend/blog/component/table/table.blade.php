<table border="1" class="table mb-0 checkbox-all" id="datatable_1">
    <thead class="table-light">
        <tr>
            <th style="width: 16px;">
                <div class="form-check mb-0 ms-n1">
                </div>
            </th>
            <th>#</th>
            <th class="ps-0" style="width: 200px;">{{ __('messages.blog.fields.title') }}</th>
            <th>{{ __('messages.blog.fields.blog_creator') }}</th>
            <th>{{ __('messages.system.status') }}</th>
            <th>{{ __('messages.system.table.fields.created_at') }}</th>
            <th class="text-center">{{ __('messages.system.table.fields.action') }}</th>
        </tr>
    </thead>
    <tbody>
        @if (isset($blogDatas) && is_object($blogDatas) && $blogDatas->isNotEmpty())
            @foreach ($blogDatas as $data)
                <tr>
                    <td style="width: 16px;">
                        <div class="form-check">
                        </div>
                    </td>
                    <td>{{ $data->id ?? __('messages.system.no_data_available') }}</td>
                    <td class="ps-0">
                        <p class="d-inline-block align-middle mb-0">
                            {{ $data->title ?? __('messages.system.no_data_available') }}
                        </p>
                    </td>
                    <td>{{ $data->user->full_name ?? __('messages.system.no_data_available') }}</td>
                    <td>
                        @php
                            $status = request('status') ?: old('status');
                            $statuses = __('messages.blog.status');
                        @endphp

                        <select name="status" class="form-select status" data-blog-id="{{ $data->id }}">
                            @foreach ($statuses as $key => $option)
                                <option value="{{ $key }}" @selected($status == $key) @selected($data->status == $key)>
                                    {{ $option }}
                                </option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <span>{{ date('d/m/Y H:i:s', strtotime($data->created_at)) }}</span>
                    </td>
                    <td class="text-end">
                        <div class="d-flex align-items-center">
                            <a href="{{ route(__('messages.' . $object . '.edit.route'), $data->id) }}" class="me-2">
                                <i class="fas fa-edit btn btn-primary btn-sm"></i>
                            </a>
                            <form action="{{ route(__('messages.' . $object . '.destroy.route'), $data->id) }}" method="post"
                                class="d-inline-block" id="myForm_{{ $data->id }}">
                                @csrf
                                @method('DELETE')
                                <button onclick="executeExample('handleDismiss', 'myForm_{{ $data->id }}')" type="button"
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
                <td colspan="7" class="text-center">{{ __('messages.system.no_data_available') }}</td>
            </tr>
        @endif
    </tbody>
</table>

<div class="pagination-container">
    {{ $blogDatas->links() }}
</div>