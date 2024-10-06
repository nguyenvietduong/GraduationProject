<div class="card">
    <div class="card-header">
        <div class="row align-items-center">
            <div class="col-auto">
                <h4 class="card-title">{{ $title }} ({{ $totalRecords }})</h4>
            </div>                        

            <div class="col-auto ms-auto mt-1">
                <a href="{{ $createRoute }}">
                    <button type="button" class="btn btn-primary w-100">
                        <i class="fa-solid fa-plus me-1"></i>
                        {{ __('messages.system.button.addNew') }}
                    </button>
                </a>
            </div>
        </div>
    </div>
</div>
