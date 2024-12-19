@extends('layout.backend')
@section('adminContent')
<div class="container-xxl">
    <div class="row">
        <div class="col-12">
            @include('backend.component.card-component', [
            'title' => "Danh sách tin tức",
            'totalRecords' => $blogTotalRecords,
            'createRoute' => route('admin.' . $object . '.create'), // Corrected the route syntax
            ])

            <div class="card-body pt-0">
                @include('backend.component.filter')
            </div>

            <div class="card-body pt-0">
                <div class="table-responsive">
                    @include('backend.' . $object . '.component.table.table')
                </div>
            </div>
        </div>
    </div>
</div>

@push('script')
<script>
    var updateStatusUrl = '{{ route("admin.blog.updateStatus") }}';
    var csrfToken = '{{ csrf_token() }}';
</script>
<script src="{{ asset('backend/assets/custom/js/ajax/set-status-blog.js') }}"></script>
@endpush
@endsection