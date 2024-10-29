@extends('layout.backend')
@section('adminContent')
    <div class="container-xxl">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <h4 class="card-title">{{ __('messages.system.button.create') }}
                                    {{ __('messages.' . $object . '.title') }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
                @include('backend.promotion.component.form.create_form')
            </div>
        </div>
        @push('script')
            <script src="{{ asset('backend/custom/promotionCustom.js') }}"></script>
        @endpush
    @endsection
