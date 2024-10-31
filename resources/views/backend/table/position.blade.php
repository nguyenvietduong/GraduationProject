@extends('layout.backend')
@section('adminContent')
    <div class="container-xxl">
        <div class="card">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <h4 class="card-title">{{ __('messages.table.text.position_route') }}</h4>
                    </div>
                    <div class="col-auto ms-auto mt-1">
                        <a href="{{ route('admin.table.index') }}">
                            <button type="button" class="btn btn-warning w-100">
                                <i class="fa-solid fa-arrow-left me-1"></i>
                                {{ __('messages.table.text.back_previous') }}
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row tables" id="sortableTable">
            @if (isset($tables) && is_object($tables) && $tables->isNotEmpty())
                @foreach ($tables as $item)
                    @php
                        if ($item->status == 'available') {
                            $color = 'success';
                        } elseif ($item->status == 'occupied') {
                            $color = 'danger';
                        } elseif ($item->status == 'reserved') {
                            $color = 'warning';
                        } elseif ($item->status == 'out_of_service') {
                            $color = 'secondary';
                        }
                    @endphp
                    <div id="{{ $item->id }}" class="col-md-2 col-4 table_position" style="cursor: pointer;">
                        <div class="card text-center text-{{ $color }}">
                            <div class="card-body">
                                <i class="fa-solid fa-utensils fa-2xl p-3" style="font-size: 50px"></i>
                                <h4 class="card-title">{{renderDataByLang($item->name) ?? __('messages.system.no_data_available') }}</h4>
                                <p>({{ __('messages.table.text.max_guests') }} {{ $item->capacity }})</p>
                                <div class="status-container">
                                    @php
                                        $status = request('status') ?: old('status');
                                        $statuses = __('messages.table.status');
                                    @endphp
                                        @foreach ($statuses as $key => $option)
                                            @if ($key == $item->status)
                                                <span class="badge bg-{{ $color }}">{{ $option }}</span>
                                            @endif
                                        @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <span colspan="9" class="text-center">{{ __('messages.system.no_data_available') }}</span>
            @endif
        </div>
        <script>
            $(function() {
                $("#sortableTable").sortable();
            });
        </script>
        @push('script')
        <script src="{{ asset('backend/assets/custom/js/set-datetime.js') }}"></script>
        <script>
            var updatePositionUrl = "{{ route('admin.table.updatePositions') }}";
            var csrfToken = '{{ csrf_token() }}';
        </script>
        <script src="{{ asset('backend/assets/custom/js/ajax/set-position-table.js') }}"></script>
    @endpush
    @endsection
