@extends('layout.backend')
@section('adminContent')
<div class="container-xxl">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <h4 class="card-title">{{ __('messages.system.table.title') . ' ' . __('messages.' . $object . '.title') }} ({{ $notificationTotalRecords }})</h4>
                        </div>
                    </div>
                </div>
            </div>


            <div class="card-body pt-0">
                @include('backend.component.filter', [
                'object' => $object,
                ])
            </div>
        </div>

        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="table-responsive">
                    @include('backend.notification.component.table.table')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
