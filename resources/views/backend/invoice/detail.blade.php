@extends('layout.backend')
@section('adminContent')
    <div class="container-xxl">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <h4 class="card-title">{{ __('messages.system.button.detail') }}
                                {{ __('messages.' . $object . '.title') }}</h4>
                        </div>
                        <div class="col-auto ms-auto mt-1">
                            <a href="{{ route('admin.invoice.index') }}">
                                <button type="button" class="btn btn-warning w-100">
                                    <i class="fa-solid fa-arrow-left me-1"></i>
                                    {{ __('messages.table.text.back_previous') }}
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="table-responsive">
                        @include('backend.invoice.component.table.detail')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
