@extends('layout.backend')

@section('adminContent')
    <div class="container-xxl">
        <div class="row justify-content-center">
            <div class="col-12">
                @include('backend.component.card-component', [
                    'title' => __('messages.system.table.title') . ' ' . __('messages.table.title'),
                    'totalRecords' => $tableTotalRecords,
                    'createRoute' => route('admin.table.create'),
                ])

                <div class="card-body pt-0">
                    @include('backend.component.filter', [
                        'object' => 'table',
                    ])
                </div>
            </div>

            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>{{ __('messages.table.fields.name') }}</th>
                                <th>{{ __('messages.table.fields.capacity') }}</th>
                                <th>{{ __('messages.table.fields.status') }}</th>
                                <th>{{ __('messages.table.fields.description') }}</th>
                                <th>{{ __('messages.table.fields.position') }}</th>
                                <th>{{ __('messages.system.table.fields.action') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($tables as $table)
                                <tr>
                                    <td>{{ $table->localized_name ?? 'No Name Available' }}</td>
                                    <td>{{ $table->capacity }}</td>
                                    <td>
                                        <select name="status" data-id="{{ $table->id }}" data-status="{{ $table->status }}" class="form-control selectStatus">
                                            @foreach(\App\Models\Table::$STATUS as $keyX => $itemX)
                                                <option
                                                    value="{{ $keyX }}" {{ ($table->status == $keyX) ? 'selected' : '' }}>{{ $itemX }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>{{ $table->localized_description ?? 'No Description Available' }}</td>
                                    <td>{{ $table->position }}</td>
                                    <td>
                                        <a href="{{ route('admin.table.edit', $table->id) }}" class="btn btn-success btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>



                                        <form action="{{ route(__('messages.' . $object . '.destroy.route'), $table->id) }}" method="post"
                                              class="d-inline-block" id="myForm">
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="executeExample('handleDismiss', 'myForm')" type="button"
                                                    class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $tables->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script type="text/javascript">
        $('body').on('change', '.selectStatus', function (e) {
            e.preventDefault();
            let id = $(this).data('id');
            let status = $(this).val();
            $.ajax({
                url: '{{ url('table/updateStatus') }}',
                method: "GET",
                data: {
                    'id': id,
                    'status': status
                },
                success: function (response) {
                    const data = response;
                    if (data.status) {
                        Swal.fire({
                            icon: 'success',
                            title: translations.successTitle, // Use your translation
                            text: 'Cập nhật trạng thái thành công', // Flash message from session
                        });
                    }
                    window.location.reload = true;
                }
            });
        });
    </script>
@endpush
