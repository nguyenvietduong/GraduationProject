<li class="dropdown topbar-item">
    <a class="nav-link dropdown-toggle arrow-none nav-icon" data-bs-toggle="dropdown" href="#" role="button"
        aria-haspopup="false" aria-expanded="false">
        @if(Auth::check())
        <img src="{{ checkFile(Auth::user()->image) }}" alt class="thumb-lg rounded-circle">
        @else
        <img src="" alt class="thumb-lg rounded-circle">
        @endif
    </a>
    <div class="dropdown-menu dropdown-menu-end py-0">
        <div class="d-flex align-items-center dropdown-item py-2 bg-secondary-subtle">
            <div class="flex-shrink-0">
                @if(Auth::check())
                <img src="{{ checkFile(Auth::user()->image) }}" alt class="thumb-md rounded-circle">
                @else
                <img src="" alt class="thumb-md rounded-circle">
                @endif
            </div>
            <div class="flex-grow-1 ms-2 text-truncate align-self-center">
                <h6 class="my-0 fw-medium text-dark fs-13">{{ Auth::user()->full_name ?? 'No data available' }}</h6>
                <small class="text-muted mb-0">
                    @if(Auth::check())
                    {{ Auth::user()->role_id == 1 ? __('messages.role.role.manager') : (Auth::user()->role_id == 2 ?
                    __('messages.role.role.admin') : '') }}
                    @endif
                </small>
            </div>
            <!--end media-body-->
        </div>
        <div class="dropdown-divider mt-0"></div>
        <small class="text-muted px-2 pb-1 d-block">{{ __('messages.system.account') }}</small>
        <a class="p-3" href="{{ route('admin.profile') }}"><i class="las la-user fs-18 me-1 align-text-bottom"></i>
            {{ __('messages.system.profile') }}</a>
        {{-- <a class="dropdown-item" href="pages-faq.html"><i class="las la-wallet fs-18 me-1 align-text-bottom"></i>
            Earning</a> --}}
        <small class="text-muted px-2 py-1 d-block ml-5">{{ __('messages.system.setting') }}</small>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: inline;">
            @csrf
            <button type="button" onclick="executeExample('handleDismiss', 'logout-form')" class="text-danger border-0 bg-transparent ps-3 mb-1">
                <i class="las la-power-off fs-18 me-1 align-text-bottom"></i> {{ __('messages.system.logout') }}
            </button>
        </form>
    </div>
</li>