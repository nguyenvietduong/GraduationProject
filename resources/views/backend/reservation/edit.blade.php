@extends('layout.backend')
@section('adminContent')
    <div class="container-xxl">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <h4 class="card-title mb-3">{{ __('messages.system.button.update') }}
                                    {{ __('messages.' . $object . '.title') }} mã : {{ $reservationData->code }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
                @include('backend.reservation.component.form.edit_form')
            </div>
        </div>
    </div>
@endsection
