@extends('layout.backend')

@section('adminContent')
<div class="container-xxl">
    <div class="row justify-content-center">
        <div class="col-12">
            @include('backend.component.card-component', [
                'title' => __('messages.system.table.title') . ' ' . __('messages.' . $object . '.title'),
                'totalRecords' => $tableTotalRecords,
                'createRoute' => route('admin.' . $object . '.create'), // Corrected the route syntax
                'positionRoute' => route('admin.'.$object.'.position'),
            ])

            <div class="card-body pt-0">
                @include('backend.component.filter', [
                    'object' => $object,
                ])
            </div>
        </div>

        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="table-responsive">
                    @include('backend.table.component.table.table')
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
