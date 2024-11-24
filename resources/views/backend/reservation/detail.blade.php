@extends('layout.backend')
@section('adminContent')
@push('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
<div class="container-xxl">
    <div class="row">

        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <h4 class="card-title">Chi tiết đơn hàng</h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card">
                    <div class="card-body p-0">
                        <div class="row g-0 h-100">
                            @include('backend.' . $object . '.component.form.detail')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('script')
    @endpush
    @endsection