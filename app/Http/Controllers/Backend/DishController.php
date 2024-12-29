<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Interfaces\Repositories\MenuRepositoryInterface;
use App\Interfaces\Repositories\PermissionRepositoryInterface as PermissionRepository;
use App\Interfaces\Repositories\TableRepositoryInterface;
use App\Interfaces\Services\ReservationServiceInterface;
use App\Interfaces\Repositories\ReservationRepositoryInterface;
use App\Models\Category;
use App\Traits\HandleExceptionTrait;

// Requests
use App\Http\Requests\BackEnd\Reservation\ListRequest as ReservationListRequest;
use App\Http\Requests\BackEnd\Reservation\StoreRequest as ReservationStoreRequest;
use App\Http\Requests\BackEnd\Reservation\UpdateRequest as ReservationUpdateRequest;
use Illuminate\Http\Request;

class DishController extends Controller
{
    use HandleExceptionTrait;

    protected $reservationService;
    protected $reservationRepository;
    protected $tableRepository;
    protected $menuRepository;
    protected $permissionRepository;

    // Base path for views
    const PATH_VIEW = 'backend.dish.';
    const PER_PAGE_DEFAULT = 5;
    const OBJECT = 'reservation';

    public function __construct(
        ReservationServiceInterface $reservationService,
        ReservationRepositoryInterface $reservationRepository,
        TableRepositoryInterface $tableRepository,
        MenuRepositoryInterface $menuRepository,
        PermissionRepository $permissionRepository,
    ) {
        $this->reservationService = $reservationService;
        $this->reservationRepository = $reservationRepository;
        $this->tableRepository = $tableRepository;
        $this->menuRepository = $menuRepository;
        $this->permissionRepository = $permissionRepository;
    }

    /**
     * Display the list of reservations.
     *
     * @param ReservationListRequest $request
     * @return \Illuminate\View\View
     */
    public function index(ReservationListRequest $request)
    {
        $this->authorize('modules', 'dish.index');
        $request->validated();

        // Extract filters from the request
        $params = $request->all();

        // Apply filters from the request
        $filters = [
            'reservation_time' => $params['reservation_time'] ?? '',
            'code' => $params['code'] ?? '',
        ];

        // Get the per_page value
        $perPage = $params['per_page'] ?? self::PER_PAGE_DEFAULT;

        return view(self::PATH_VIEW . __FUNCTION__, [
            'object' => self::OBJECT,
            'todayArrivedCount' =>  $this->reservationRepository->where('status', '=', 'arrived')->whereDate('reservation_time', '=', now()->toDateString())->count(),
            'datas' => $this->reservationService->getAllReservationsArrived($filters, $perPage, self::OBJECT), // Paginated reservation list for the view
        ]);
    }
}
