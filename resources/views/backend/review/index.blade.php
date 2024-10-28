@extends('layout.backend')
@section('adminContent')
<div class="container-xxl">
    <div class="row">
        <div class="col-12">
            @include('backend.component.card-component', [
            'title' => __('messages.system.table.title') . ' ' . __('messages.' . $object . '.title'),
            'totalRecords' => $reviewTotalRecords,
            'createRoute' => null // Corrected the route syntax
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
@endsection