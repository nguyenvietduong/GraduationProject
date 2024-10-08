<!-- resources/views/components/search-form.blade.php -->
@php
$perPageOptions = [5, 10, 15, 20, 50, 100];
@endphp

<form method="get" action="">
    <div class="card">
        <div class="card-header">
            <div class="row align-items-center">
                <div class="col-12 col-md-auto mb-2">
                    <!-- Keep this column for per_page dropdown -->
                    @php
                    $per_page = request('per_page') ?: old('per_page');
                    @endphp
                    <select name="per_page" class="form-select per_page filter">
                        @foreach ($perPageOptions as $option)
                        <option {{ $per_page==$option ? 'selected' : '' }} value="{{ $option }}">
                            {{ $option }}
                        </option>
                        @endforeach
                    </select>
                </div>

                @if(in_array($object, ['user', 'admin', 'staff']))
                @include('backend.account.component.filter.filter')
                @else
                @include('backend.' . $object . '.component.filter.filter')
                @endif

                <div class="col-12 col-md-auto mb-2">
                    <!-- Align button to the right -->
                    <button type="submit" id="filter-button" name="search" value="search"
                        class="btn btn-primary d-flex align-items-center w-100">
                        <!-- Add w-100 for full width -->
                        <i class="iconoir-filter-alt me-1"></i>
                        {{ __('messages.system.button.search') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>