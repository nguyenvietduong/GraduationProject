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

class ReservationController extends Controller
{
    use HandleExceptionTrait;

    protected $reservationService;
    protected $reservationRepository;
    protected $tableRepository;
    protected $menuRepository;
    protected $permissionRepository;

    // Base path for views
    const PATH_VIEW = 'backend.reservation.';
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
        $this->authorize('modules', '' . self::OBJECT . '.index');
        $request->validated();

        // Extract filters from the request
        $params = $request->all();

        // Apply filters from the request
        $filters = [
            'reservation_time' => $params['reservation_time'] ?? '',
            'name' => $params['name'] ?? '',
            'email' => $params['email'] ?? '',
            'phone' => $params['phone'] ?? '',
            'isCanceled' => $params['isCanceled'] ?? '',
        ];

        // Get the per_page value
        $perPage = $params['per_page'] ?? self::PER_PAGE_DEFAULT;

        return view(self::PATH_VIEW . __FUNCTION__, [
            'object' => self::OBJECT,
            'todayArrivedCount' =>  $this->reservationRepository->where('status', '!=', 'completed')->whereDate('reservation_time', '=', now()->toDateString())->count(),
            'datas' => $this->reservationService->getAllReservations($filters, $perPage, self::OBJECT), // Paginated reservation list for the view
        ]);
    }

    /**
     * Show the form for creating a new reservation.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view(self::PATH_VIEW . __FUNCTION__, [
            'object' => 'reservation',
        ]);
    }

    /**
     * Handle the storage of a new reservation.
     *
     * @param ReservationStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ReservationStoreRequest $request)
    {
        // Validate the data from the request using ReservationStoreRequest
        $data = $request->validated();
        try {
            // Create a new reservation
            $this->reservationService->createReservation($data);
            return redirect()->back()->with('success', 'Reservation created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Show the form for editing a reservation.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function detail($id)
    {
        $reservation = $this->reservationService->getReservationDetail($id);
        if ($reservation) {
            return view(self::PATH_VIEW . __FUNCTION__, [
                'data' => $reservation,
                'object' => 'reservation',
            ]);
        }

        abort(404);
    }

    /**
     * Show the form for editing a reservation.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $reservation = $this->reservationService->getReservationDetail($id);

        $tables = $this->tableRepository->get(['id', 'name', 'capacity', 'status', 'description']);

        $menus = Category::with('menus')->get();

        if ($reservation) {
            return view(self::PATH_VIEW . __FUNCTION__, [
                'reservationData' => $reservation,
                'object' => 'reservation',
                'listTables' => $tables,
                'listMenus' => $menus
            ]);
        }
        abort(404);
    }

    /**
     * Handle the update of a reservation.
     *
     * @param int $id
     * @param ReservationUpdateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, ReservationUpdateRequest $request)
    {
        // Validate the data from the request using ReservationUpdateRequest
        $data = $request->validated();

        try {
            // Update the reservation
            $this->reservationService->updateReservation($id, $data);
            return redirect()->route('admin.reservation.index')->with('success', 'Reservation updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Delete a reservation.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        try {
            // Delete the reservation
            $this->reservationService->deleteReservation($id);

            return redirect()->back()->with('success', 'Reservation deleted successfully');
        } catch (\Exception $e) {
            // Return a JSON response if there is an error
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function checkTableFullyBookedTimes(Request $request)
    {
        $selectedDate = $request->input('date');

        $fullyBookedTimes = $this->reservationService->checkTableFullyBookedTimes($selectedDate);

        // Return only the fully booked time slots as JSON
        return response()->json([
            'success' => true,
            'fullyBookedTimes' => $fullyBookedTimes,
        ]);
    }
}
