@extends('layout.backend')

@section('adminContent')
    <div class="container-xxl">
        <div class="row justify-content-center">
            <div class="col-12">
                @include('backend.component.card-component', [
                    'title' => __('messages.system.table.title') . ' ' . __('messages.' . $object . '.title'),
                    'totalRecords' => $tableTotalRecords,
                    'createRoute' => route('admin.' . $object . '.create'), // Corrected the route syntax
                    'positionRoute' => route('admin.' . $object . '.position'),
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
    <script>
        $(document).ready(function() {
            $('body').on('change', '.status', function(e) {
                e.preventDefault();
                let id = $(this).data('table-id');
                let status = $(this).val();

                $.ajax({
                    url: '/table/updateStatus', // Use route helper for more reliable URL generation
                    method: "GET", // Change to "POST" if necessary
                    data: {
                        id: id,
                        status: status,
                        _token: '{{ csrf_token() }}' // Add CSRF token if needed
                    },
                    success: function(response) {
                        if (response.status === true) {
                            Swal.fire({
                                icon: 'success',
                                title: '{{ __('Success') }}', // Direct translation usage
                                text: 'Cập nhật trạng thái thành công',
                            }).then(() => {
                                window.location.reload(); // Reloads the page correctly
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: '{{ __('Error') }}',
                                text: response.errors,
                            }).then(() => {
                                window.location.reload()
                            });
                        }
                    },
                    error: function(xhr, status, error, response) {
                        console.log(response + 123);
                        Swal.fire({
                            icon: 'error',
                            title: '{{ __('Error') }}',
                            text: response.errors,
                        });
                    }
                });
            });
        });
    </script>
@endpush
