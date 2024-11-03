<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Interfaces\Repositories\PermissionRepositoryInterface as PermissionRepository;
use App\Interfaces\Services\ReservationServiceInterface;
use App\Interfaces\Repositories\ReservationRepositoryInterface;
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

    protected $permissionRepository;

    // Base path for views
    const PATH_VIEW = 'backend.reservation.';
    const PER_PAGE_DEFAULT = 5;
    const OBJECT = 'reservation';

    public function __construct(
        ReservationServiceInterface $reservationService,
        ReservationRepositoryInterface $reservationRepository,
        PermissionRepository $permissionRepository,
    ) {
        $this->reservationService = $reservationService;
        $this->reservationRepository = $reservationRepository;
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
        $request->validated();

        // Extract filters from the request
        $params = $request->all();

        // Apply filters from the request
        $filters = [
            'search' => $params['keyword'] ?? '', // Ensure this matches the search input name
            'start_date' => $params['start_date'] ?? '',
            'end_date' => $params['end_date'] ?? '',
        ];

        // Get the per_page value
        $perPage = $params['per_page'] ?? self::PER_PAGE_DEFAULT;

        return view(self::PATH_VIEW . __FUNCTION__, [
            'object' => self::OBJECT,
            'totalRecords' => $this->reservationRepository->count(), // Total records for display
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
    public function edit($id)
    {
        $reservation = $this->reservationService->getReservationDetail($id);
        if ($reservation) {
            return view(self::PATH_VIEW . __FUNCTION__, [
                'reservationData' => $reservation,
                'object' => 'reservation',
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
