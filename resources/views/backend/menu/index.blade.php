@extends('layout.backend')
@section('adminContent')
@push('css')
<!-- Include DataTables CSS and JS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<style>
    /* Ẩn phần hiển thị thông tin */
    .dataTables_info {
        display: none;
        /* Ẩn thông tin */
    }

    /* Ẩn phần phân trang */
    .dataTables_paginate {
        display: none;
        /* Ẩn phân trang */
    }

    /* Ẩn phần hiển thị số bản ghi */
    .dataTables_length {
        display: none;
        /* Ẩn phần hiển thị số bản ghi */
    }
</style>

@endpush

<div class="container-xxl">
    <div class="row justify-content-center">
        <div class="col-12">
            @include('backend.component.card-component', [
            'title' => __('messages.system.table.title') . ' ' . __('messages.' . $object . '.title'),
            'totalRecords' => $menuTotalRecords,
            'createRoute' => route('admin.' . $object . '.create'), // Corrected the route syntax
            'permission' => TRUE,
            ])
        </div>

        <div class="col-md-12 col-lg-12">
            {{-- <div class="card">
                <div class="table-responsive">
                    @include('backend.menu.component.table.table')
                </div>
            </div> --}}

            <div class="card">
                <div class="card-body pt-0">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab">
                            <a class="nav-link py-2 active" id="step1-tab" data-bs-toggle="tab" href="#step1">{{
                                __('messages.menu.meal_times.breakfast') }}</a>
                            <a class="nav-link py-2" id="step2-tab" data-bs-toggle="tab" href="#step2">{{
                                __('messages.menu.meal_times.lunch') }}</a>
                            <a class="nav-link py-2" id="step3-tab" data-bs-toggle="tab" href="#step3">{{
                                __('messages.menu.meal_times.dinner') }}</a>
                            <a class="nav-link py-2" id="step4-tab" data-bs-toggle="tab" href="#step4">{{
                                __('messages.menu.meal_times.all_day') }}</a>
                        </div>
                    </nav>

                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane active" id="step1">
                            <h4 class="card-title my-4">{{ __('messages.menu.categories.starter') }}</h4>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table border="1" id="breakfast_starter"
                                            class="table mb-0 checkbox-all table-centered table-hover">
                                            <thead class="table-light">
                                                <tr>
                                                    <th style="width: 16px;">
                                                        <div class="form-check mb-0 ms-n1">
                                                            <input type="checkbox" class="form-check-input"
                                                                name="select-all">
                                                        </div>
                                                    </th>
                                                    <th class="ps-0">#</th>
                                                    <th class="ps-0">{{ __('messages.'. $object .'.fields.name') }}
                                                    </th>
                                                    <th>{{ __('messages.'. $object .'.fields.description') }}</th>
                                                    <th>{{ __('messages.'. $object .'.fields.price') }}</th>
                                                    <th>{{ __('messages.'. $object .'.fields.category') }}</th>
                                                    <th>{{ __('messages.'. $object .'.fields.meal_time') }}</th>
                                                    <th>{{ __('messages.system.table.fields.created_at') }}</th>
                                                    <th>{{ __('messages.system.table.fields.action') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (isset($menuDatas) && is_object($menuDatas) &&
                                                $menuDatas->isNotEmpty())
                                                @foreach ($menuDatas as $item)
                                                @if($item->meal_time == 'breakfast' && $item->category == 'starter')
                                                <tr>
                                                    <td style="width: 16px;">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input"
                                                                value="{{ $item->id }}" name="check"
                                                                id="customCheck{{ $item->id }}">
                                                        </div>
                                                    </td>
                                                    <td class="ps-0">
                                                        {{ $item->id ?? __('messages.system.no_data_available') }}
                                                    </td>
                                                    <td class="ps-0">
                                                        <p class="d-inline-block align-middle mb-0">
                                                            {{ $item->name ??
                                                            __('messages.system.no_data_available') }}
                                                        </p>
                                                    </td>
                                                    <td class="ps-0">
                                                        {{ $item->description ??
                                                        __('messages.system.no_data_available') }}
                                                    </td>
                                                    <td class="ps-0">
                                                        {{ number_format($item->price, 2) ??
                                                        __('messages.system.no_data_available') }} VND
                                                    </td>
                                                    <td class="ps-0">
                                                        {{ $item->category ??
                                                        __('messages.system.no_data_available') }}
                                                    </td>
                                                    <td class="ps-0">
                                                        {{ $item->meal_time ??
                                                        __('messages.system.no_data_available') }}
                                                    </td>
                                                    <td>
                                                        <span>{{ date('d/m/Y H:i:s', strtotime($item->created_at))
                                                            ?? __('messages.system.no_data_available')
                                                            }}</span>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <a href="{{ route(__('messages.' . $object . '.edit.route'), $item->id) }}"
                                                                class="me-2">
                                                                <i class="fas fa-edit btn btn-primary btn-sm"></i>
                                                            </a>
                                                            <form
                                                                action="{{ route(__('messages.' . $object . '.destroy.route'), $item->id) }}"
                                                                method="post" class="d-inline-block"
                                                                id="myForm_{{ $item->id }}">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button
                                                                    onclick="executeExample('handleDismiss', 'myForm_{{ $item->id }}')"
                                                                    type="button" class="btn btn-danger btn-sm">
                                                                    <i class="fas fa-trash-alt"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endif
                                                @endforeach
                                                @else
                                                <tr>
                                                    <td colspan="12" class="text-center">{{
                                                        __('messages.system.no_data_available') }}</td>
                                                </tr>
                                                @endif
                                            </tbody>
                                        </table>

                                        {{-- <div class="pagination-container p-2">
                                            {{ $menuDatas->links() }}
                                        </div> --}}
                                    </div>
                                </div>
                            </div>

                            <h4 class="card-title my-4">{{ __('messages.menu.categories.main_course') }}</h4>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table border="1" id="breakfast_main_course"
                                            class="table mb-0 checkbox-all table-centered table-hover">
                                            <thead class="table-light">
                                                <tr>
                                                    <th style="width: 16px;">
                                                        <div class="form-check mb-0 ms-n1">
                                                            <input type="checkbox" class="form-check-input"
                                                                name="select-all" id="select-all">
                                                        </div>
                                                    </th>
                                                    <th class="ps-0">#</th>
                                                    <th class="ps-0">{{ __('messages.'. $object .'.fields.name') }}
                                                    </th>
                                                    <th>{{ __('messages.'. $object .'.fields.description') }}</th>
                                                    <th>{{ __('messages.'. $object .'.fields.price') }}</th>
                                                    <th>{{ __('messages.'. $object .'.fields.category') }}</th>
                                                    <th>{{ __('messages.'. $object .'.fields.meal_time') }}</th>
                                                    <th>{{ __('messages.system.table.fields.created_at') }}</th>
                                                    <th>{{ __('messages.system.table.fields.action') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (isset($menuDatas) && is_object($menuDatas) &&
                                                $menuDatas->isNotEmpty())
                                                @foreach ($menuDatas as $item)
                                                @if($item->meal_time == 'breakfast' && $item->category == 'main_course')
                                                <tr>
                                                    <td style="width: 16px;">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input"
                                                                value="{{ $item->id }}" name="check"
                                                                id="customCheck{{ $item->id }}">
                                                        </div>
                                                    </td>
                                                    <td class="ps-0">
                                                        {{ $item->id ?? __('messages.system.no_data_available') }}
                                                    </td>
                                                    <td class="ps-0">
                                                        <p class="d-inline-block align-middle mb-0">
                                                            {{ $item->name ??
                                                            __('messages.system.no_data_available') }}
                                                        </p>
                                                    </td>
                                                    <td class="ps-0">
                                                        {{ $item->description ??
                                                        __('messages.system.no_data_available') }}
                                                    </td>
                                                    <td class="ps-0">
                                                        {{ number_format($item->price, 2) ??
                                                        __('messages.system.no_data_available') }} VND
                                                    </td>
                                                    <td class="ps-0">
                                                        {{ $item->category ??
                                                        __('messages.system.no_data_available') }}
                                                    </td>
                                                    <td class="ps-0">
                                                        {{ $item->meal_time ??
                                                        __('messages.system.no_data_available') }}
                                                    </td>
                                                    <td>
                                                        <span>{{ date('d/m/Y H:i:s', strtotime($item->created_at))
                                                            ?? __('messages.system.no_data_available')
                                                            }}</span>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <a href="{{ route(__('messages.' . $object . '.edit.route'), $item->id) }}"
                                                                class="me-2">
                                                                <i class="fas fa-edit btn btn-primary btn-sm"></i>
                                                            </a>
                                                            <form
                                                                action="{{ route(__('messages.' . $object . '.destroy.route'), $item->id) }}"
                                                                method="post" class="d-inline-block"
                                                                id="myForm_{{ $item->id }}">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button
                                                                    onclick="executeExample('handleDismiss', 'myForm_{{ $item->id }}')"
                                                                    type="button" class="btn btn-danger btn-sm">
                                                                    <i class="fas fa-trash-alt"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endif
                                                @endforeach
                                                @else
                                                <tr>
                                                    <td colspan="12" class="text-center">{{
                                                        __('messages.system.no_data_available') }}</td>
                                                </tr>
                                                @endif
                                            </tbody>
                                        </table>

                                        {{-- <div class="pagination-container p-2">
                                            {{ $menuDatas->links() }}
                                        </div> --}}
                                    </div>
                                </div>
                            </div>

                            <h4 class="card-title my-4">{{ __('messages.menu.categories.dessert') }}</h4>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table border="1" id="breakfast_dessert"
                                            class="table mb-0 checkbox-all table-centered table-hover">
                                            <thead class="table-light">
                                                <tr>
                                                    <th style="width: 16px;">
                                                        <div class="form-check mb-0 ms-n1">
                                                            <input type="checkbox" class="form-check-input"
                                                                name="select-all" id="select-all">
                                                        </div>
                                                    </th>
                                                    <th class="ps-0">#</th>
                                                    <th class="ps-0">{{ __('messages.'. $object .'.fields.name') }}
                                                    </th>
                                                    <th>{{ __('messages.'. $object .'.fields.description') }}</th>
                                                    <th>{{ __('messages.'. $object .'.fields.price') }}</th>
                                                    <th>{{ __('messages.'. $object .'.fields.category') }}</th>
                                                    <th>{{ __('messages.'. $object .'.fields.meal_time') }}</th>
                                                    <th>{{ __('messages.system.table.fields.created_at') }}</th>
                                                    <th>{{ __('messages.system.table.fields.action') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (isset($menuDatas) && is_object($menuDatas) &&
                                                $menuDatas->isNotEmpty())
                                                @foreach ($menuDatas as $item)
                                                @if($item->meal_time == 'breakfast' && $item->category == 'dessert')
                                                <tr>
                                                    <td style="width: 16px;">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input"
                                                                value="{{ $item->id }}" name="check"
                                                                id="customCheck{{ $item->id }}">
                                                        </div>
                                                    </td>
                                                    <td class="ps-0">
                                                        {{ $item->id ?? __('messages.system.no_data_available') }}
                                                    </td>
                                                    <td class="ps-0">
                                                        <p class="d-inline-block align-middle mb-0">
                                                            {{ $item->name ??
                                                            __('messages.system.no_data_available') }}
                                                        </p>
                                                    </td>
                                                    <td class="ps-0">
                                                        {{ $item->description ??
                                                        __('messages.system.no_data_available') }}
                                                    </td>
                                                    <td class="ps-0">
                                                        {{ number_format($item->price, 2) ??
                                                        __('messages.system.no_data_available') }} VND
                                                    </td>
                                                    <td class="ps-0">
                                                        {{ $item->category ??
                                                        __('messages.system.no_data_available') }}
                                                    </td>
                                                    <td class="ps-0">
                                                        {{ $item->meal_time ??
                                                        __('messages.system.no_data_available') }}
                                                    </td>
                                                    <td>
                                                        <span>{{ date('d/m/Y H:i:s', strtotime($item->created_at))
                                                            ?? __('messages.system.no_data_available')
                                                            }}</span>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <a href="{{ route(__('messages.' . $object . '.edit.route'), $item->id) }}"
                                                                class="me-2">
                                                                <i class="fas fa-edit btn btn-primary btn-sm"></i>
                                                            </a>
                                                            <form
                                                                action="{{ route(__('messages.' . $object . '.destroy.route'), $item->id) }}"
                                                                method="post" class="d-inline-block"
                                                                id="myForm_{{ $item->id }}">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button
                                                                    onclick="executeExample('handleDismiss', 'myForm_{{ $item->id }}')"
                                                                    type="button" class="btn btn-danger btn-sm">
                                                                    <i class="fas fa-trash-alt"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endif
                                                @endforeach
                                                @else
                                                <tr>
                                                    <td colspan="12" class="text-center">{{
                                                        __('messages.system.no_data_available') }}</td>
                                                </tr>
                                                @endif
                                            </tbody>
                                        </table>

                                        {{-- <div class="pagination-container p-2">
                                            {{ $menuDatas->links() }}
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                            <!--end row-->
                        </div>

                        <div class="tab-pane" id="step2">
                            <h4 class="card-title my-4">{{ __('messages.menu.categories.starter') }}</h4>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table border="1" id="lunch_starter"
                                            class="table mb-0 checkbox-all table-centered table-hover">
                                            <thead class="table-light">
                                                <tr>
                                                    <th style="width: 16px;">
                                                        <div class="form-check mb-0 ms-n1">
                                                            <input type="checkbox" class="form-check-input"
                                                                name="select-all">
                                                        </div>
                                                    </th>
                                                    <th class="ps-0">#</th>
                                                    <th class="ps-0">{{ __('messages.'. $object .'.fields.name') }}
                                                    </th>
                                                    <th>{{ __('messages.'. $object .'.fields.description') }}</th>
                                                    <th>{{ __('messages.'. $object .'.fields.price') }}</th>
                                                    <th>{{ __('messages.'. $object .'.fields.category') }}</th>
                                                    <th>{{ __('messages.'. $object .'.fields.meal_time') }}</th>
                                                    <th>{{ __('messages.system.table.fields.created_at') }}</th>
                                                    <th>{{ __('messages.system.table.fields.action') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (isset($menuDatas) && is_object($menuDatas) &&
                                                $menuDatas->isNotEmpty())
                                                @foreach ($menuDatas as $item)
                                                @if($item->meal_time == 'lunch' && $item->category == 'starter')
                                                @dd($item)
                                                <tr>
                                                    <td style="width: 16px;">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input"
                                                                value="{{ $item->id }}" name="check"
                                                                id="customCheck_{{ $item->id }}">
                                                        </div>
                                                    </td>
                                                    <td class="ps-0">
                                                        {{ $item->id ?? __('messages.system.no_data_available') }}
                                                    </td>
                                                    <td class="ps-0">
                                                        <p class="d-inline-block align-middle mb-0">
                                                            {{ $item->name ??
                                                            __('messages.system.no_data_available') }}
                                                        </p>
                                                    </td>
                                                    <td class="ps-0">
                                                        {{ $item->description ??
                                                        __('messages.system.no_data_available') }}
                                                    </td>
                                                    <td class="ps-0">
                                                        {{ number_format($item->price, 2) ??
                                                        __('messages.system.no_data_available') }} VND
                                                    </td>
                                                    <td class="ps-0">
                                                        {{ $item->category ??
                                                        __('messages.system.no_data_available') }}
                                                    </td>
                                                    <td class="ps-0">
                                                        {{ $item->meal_time ??
                                                        __('messages.system.no_data_available') }}
                                                    </td>
                                                    <td>
                                                        <span>{{ date('d/m/Y H:i:s', strtotime($item->created_at))
                                                            ?? __('messages.system.no_data_available')
                                                            }}</span>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <a href="{{ route(__('messages.' . $object . '.edit.route'), $item->id) }}"
                                                                class="me-2">
                                                                <i class="fas fa-edit btn btn-primary btn-sm"></i>
                                                            </a>
                                                            <form
                                                                action="{{ route(__('messages.' . $object . '.destroy.route'), $item->id) }}"
                                                                method="post" class="d-inline-block"
                                                                id="myForm_{{ $item->id }}">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button
                                                                    onclick="executeExample('handleDismiss', 'myForm_{{ $item->id }}')"
                                                                    type="button" class="btn btn-danger btn-sm">
                                                                    <i class="fas fa-trash-alt"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endif
                                                @endforeach
                                                @else
                                                <tr>
                                                    <td colspan="12" class="text-center">{{
                                                        __('messages.system.no_data_available') }}</td>
                                                </tr>
                                                @endif
                                            </tbody>
                                        </table>

                                        {{-- <div class="pagination-container p-2">
                                            {{ $menuDatas->links() }}
                                        </div> --}}
                                    </div>
                                </div>
                            </div>

                            <h4 class="card-title my-4">{{ __('messages.menu.categories.main_course') }}</h4>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table border="1" id="lunch_main_course"
                                            class="table mb-0 checkbox-all table-centered table-hover">
                                            <thead class="table-light">
                                                <tr>
                                                    <th style="width: 16px;">
                                                        <div class="form-check mb-0 ms-n1">
                                                            <input type="checkbox" class="form-check-input"
                                                                name="select-all" id="select-all">
                                                        </div>
                                                    </th>
                                                    <th class="ps-0">#</th>
                                                    <th class="ps-0">{{ __('messages.'. $object .'.fields.name') }}
                                                    </th>
                                                    <th>{{ __('messages.'. $object .'.fields.description') }}</th>
                                                    <th>{{ __('messages.'. $object .'.fields.price') }}</th>
                                                    <th>{{ __('messages.'. $object .'.fields.category') }}</th>
                                                    <th>{{ __('messages.'. $object .'.fields.meal_time') }}</th>
                                                    <th>{{ __('messages.system.table.fields.created_at') }}</th>
                                                    <th>{{ __('messages.system.table.fields.action') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (isset($menuDatas) && is_object($menuDatas) &&
                                                $menuDatas->isNotEmpty())
                                                @foreach ($menuDatas as $item)
                                                @if($item->meal_time == 'lunch' && $item->category == 'main_course')
                                                <tr>
                                                    <td style="width: 16px;">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input"
                                                                value="{{ $item->id }}" name="check"
                                                                id="customCheck{{ $item->id }}">
                                                        </div>
                                                    </td>
                                                    <td class="ps-0">
                                                        {{ $item->id ?? __('messages.system.no_data_available') }}
                                                    </td>
                                                    <td class="ps-0">
                                                        <p class="d-inline-block align-middle mb-0">
                                                            {{ $item->name ??
                                                            __('messages.system.no_data_available') }}
                                                        </p>
                                                    </td>
                                                    <td class="ps-0">
                                                        {{ $item->description ??
                                                        __('messages.system.no_data_available') }}
                                                    </td>
                                                    <td class="ps-0">
                                                        {{ number_format($item->price, 2) ??
                                                        __('messages.system.no_data_available') }} VND
                                                    </td>
                                                    <td class="ps-0">
                                                        {{ $item->category ??
                                                        __('messages.system.no_data_available') }}
                                                    </td>
                                                    <td class="ps-0">
                                                        {{ $item->meal_time ??
                                                        __('messages.system.no_data_available') }}
                                                    </td>
                                                    <td>
                                                        <span>{{ date('d/m/Y H:i:s', strtotime($item->created_at))
                                                            ?? __('messages.system.no_data_available')
                                                            }}</span>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <a href="{{ route(__('messages.' . $object . '.edit.route'), $item->id) }}"
                                                                class="me-2">
                                                                <i class="fas fa-edit btn btn-primary btn-sm"></i>
                                                            </a>
                                                            <form
                                                                action="{{ route(__('messages.' . $object . '.destroy.route'), $item->id) }}"
                                                                method="post" class="d-inline-block"
                                                                id="myForm_{{ $item->id }}">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button
                                                                    onclick="executeExample('handleDismiss', 'myForm_{{ $item->id }}')"
                                                                    type="button" class="btn btn-danger btn-sm">
                                                                    <i class="fas fa-trash-alt"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endif
                                                @endforeach
                                                @else
                                                <tr>
                                                    <td colspan="12" class="text-center">{{
                                                        __('messages.system.no_data_available') }}</td>
                                                </tr>
                                                @endif
                                            </tbody>
                                        </table>

                                        {{-- <div class="pagination-container p-2">
                                            {{ $menuDatas->links() }}
                                        </div> --}}
                                    </div>
                                </div>
                            </div>

                            <h4 class="card-title my-4">{{ __('messages.menu.categories.dessert') }}</h4>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table border="1" id="dinner_dessert"
                                            class="table mb-0 checkbox-all table-centered table-hover">
                                            <thead class="table-light">
                                                <tr>
                                                    <th style="width: 16px;">
                                                        <div class="form-check mb-0 ms-n1">
                                                            <input type="checkbox" class="form-check-input"
                                                                name="select-all" id="select-all">
                                                        </div>
                                                    </th>
                                                    <th class="ps-0">#</th>
                                                    <th class="ps-0">{{ __('messages.'. $object .'.fields.name') }}
                                                    </th>
                                                    <th>{{ __('messages.'. $object .'.fields.description') }}</th>
                                                    <th>{{ __('messages.'. $object .'.fields.price') }}</th>
                                                    <th>{{ __('messages.'. $object .'.fields.category') }}</th>
                                                    <th>{{ __('messages.'. $object .'.fields.meal_time') }}</th>
                                                    <th>{{ __('messages.system.table.fields.created_at') }}</th>
                                                    <th>{{ __('messages.system.table.fields.action') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (isset($menuDatas) && is_object($menuDatas) &&
                                                $menuDatas->isNotEmpty())
                                                @foreach ($menuDatas as $item)
                                                @if($item->meal_time == 'dinner' && $item->category == 'dessert')
                                                <tr>
                                                    <td style="width: 16px;">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input"
                                                                value="{{ $item->id }}" name="check"
                                                                id="customCheck{{ $item->id }}">
                                                        </div>
                                                    </td>
                                                    <td class="ps-0">
                                                        {{ $item->id ?? __('messages.system.no_data_available') }}
                                                    </td>
                                                    <td class="ps-0">
                                                        <p class="d-inline-block align-middle mb-0">
                                                            {{ $item->name ??
                                                            __('messages.system.no_data_available') }}
                                                        </p>
                                                    </td>
                                                    <td class="ps-0">
                                                        {{ $item->description ??
                                                        __('messages.system.no_data_available') }}
                                                    </td>
                                                    <td class="ps-0">
                                                        {{ number_format($item->price, 2) ??
                                                        __('messages.system.no_data_available') }} VND
                                                    </td>
                                                    <td class="ps-0">
                                                        {{ $item->category ??
                                                        __('messages.system.no_data_available') }}
                                                    </td>
                                                    <td class="ps-0">
                                                        {{ $item->meal_time ??
                                                        __('messages.system.no_data_available') }}
                                                    </td>
                                                    <td>
                                                        <span>{{ date('d/m/Y H:i:s', strtotime($item->created_at))
                                                            ?? __('messages.system.no_data_available')
                                                            }}</span>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <a href="{{ route(__('messages.' . $object . '.edit.route'), $item->id) }}"
                                                                class="me-2">
                                                                <i class="fas fa-edit btn btn-primary btn-sm"></i>
                                                            </a>
                                                            <form
                                                                action="{{ route(__('messages.' . $object . '.destroy.route'), $item->id) }}"
                                                                method="post" class="d-inline-block"
                                                                id="myForm_{{ $item->id }}">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button
                                                                    onclick="executeExample('handleDismiss', 'myForm_{{ $item->id }}')"
                                                                    type="button" class="btn btn-danger btn-sm">
                                                                    <i class="fas fa-trash-alt"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endif
                                                @endforeach
                                                @else
                                                <tr>
                                                    <td colspan="12" class="text-center">{{
                                                        __('messages.system.no_data_available') }}</td>
                                                </tr>
                                                @endif
                                            </tbody>
                                        </table>

                                        {{-- <div class="pagination-container p-2">
                                            {{ $menuDatas->links() }}
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                            <!--end row-->
                        </div>
                    </div>
                </div>
                <!--end card-body-->
            </div>
            <!--end card-->
        </div>
    </div>
</div>
@push('script')
<script>
    $(document).ready(function() {
        $('#breakfast_starter, #breakfast_main_course, #breakfast_dessert, #lunch_starter, #lunch_main_course, #lunch_dessert, #dinner_starter, #dinner_main_course, #dinner_dessert, #all_day_starter, #all_day_main_course, #all_day_dessert').DataTable({
            // Tùy chọn DataTables
            searching: true, // Bật tìm kiếm
            info: true,      // Hiển thị thông tin
            paging: false,    // Bật phân trang
            ordering: false,  // Bật sắp xếp
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/Vietnamese.json' // Ngôn ngữ tiếng Việt
            }
        });
    });
</script>

@endpush
@endsection