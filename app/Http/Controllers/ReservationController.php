<?php

namespace App\Http\Controllers;

use App\Events\NotificationEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\Reservation\StoreRequest;
use App\Interfaces\Services\ReservationServiceInterface;
use App\Interfaces\Repositories\ReservationRepositoryInterface;
use App\Models\Reservation;
use App\Models\Table;
use App\Services\NotificationService;
use App\Traits\HandleExceptionTrait;
use Illuminate\Http\Request;
use App\Mail\ReservationCancellationMail;
use App\Mail\ReservationConfirmed;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;
// Requests

class ReservationController extends Controller
{
    use HandleExceptionTrait;

    const successfulReservation = [
        'vi' => 'Đơn đặt bàn cảu bạn đã được ghi lại!',
        'en' => 'Your table reservation has been recorded!',
    ];

    const bookingFailed = [
        'vi' => 'Đặt bàn không thành công do không còn đủ bàn vào thời gian đó!',
        'en' => 'Reservation failed due to lack of tables at that time!',
    ];

    protected $reservationService;
    protected $reservationRepository;
    protected $notificationService;

    public function __construct(
        ReservationServiceInterface $reservationService,
        ReservationRepositoryInterface $reservationRepository,
        NotificationService $notificationService,
    ) {
        $this->reservationService = $reservationService;
        $this->reservationRepository = $reservationRepository;
        $this->notificationService = $notificationService;
    }

    /**
     * Show the form for creating a new reservation.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('frontend.reservation');
    }

    /**
     * Handle the storage of a new reservation.
     *
     * @param StoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request)
    {
        // Validate the data from the request using ReservationStoreRequest
        $data = $request->validated();

        try {
            // Create a new reservation
            $reservationNew = $this->reservationService->createReservation($data);

            // Reservation created successfully
            $notificationData = [
                'title' => __('messages.system.titleNotificationReservation'),
                'message' => $reservationNew
            ];

            $this->notificationService->createNotification($notificationData);
            event(new NotificationEvent($reservationNew));

            // Send confirmation email
            if (isset($reservationNew->email)) {
                Mail::to($reservationNew->email)->send(new ReservationConfirmed($reservationNew));
            }

            return response()->json([
                'success' => true,
                'message' => App::getLocale() == 'vi' ? self::successfulReservation['vi'] : self::successfulReservation['en'],
                'data' => $reservationNew
            ], 201); // Created
        } catch (\Exception $e) {
            \Log::error('Reservation store error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'An error occurred: ' . $e->getMessage()
            ], 500); // Internal Server Error
        }
    }

    public function checkAvailability(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'time' => 'required|string',
            'duration' => 'required|integer|min:1',
        ]);

        $date = $request->input('date');
        $time = $request->input('time');
        $duration = $request->input('duration');

        $reservationStartTime = \Carbon\Carbon::parse("$date $time");
        $reservationEndTime = $reservationStartTime->copy()->addHours($duration);

        $reservedTableIds = Reservation::whereBetween('reservation_time', [$reservationStartTime, $reservationEndTime])
            ->pluck('table_id');

        $availableTables = Table::whereNotIn('id', $reservedTableIds)->get();

        $totalTables = Table::count();
        $availableCount = $availableTables->count();

        return response()->json([
            'available' => $availableTables,
            'count' => $availableCount,
            'message' => $availableCount === 0
                ? 'Sorry, all tables are reserved during this time.'
                : "$availableCount table(s) available.",
        ]);
    }

    public function detail($reservationId)
    {
        // Tìm đơn hàng dựa vào ID
        $reservation = Reservation::find($reservationId);

        // Kiểm tra nếu đơn hàng tồn tại
        if ($reservation) {
            return response()->json([
                'success' => true,
                'data' => $reservation
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Reservation not found.'
            ], 404);
        }
    }

    public function canceled($reservationId)
    {
        $reservation = Reservation::find($reservationId);
    
        if (!$reservation) {
            return response()->json([
                'success' => false,
                'message' => 'Reservation not found.'
            ], 404);
        }
    
        if ($reservation->status === 'pending') {
            $reservation->update(['status' => 'canceled']);
    
            return response()->json([
                'success' => true,
                'data' => $reservation->status,
                'message' => 'Reservation has been canceled successfully.'
            ]);
        }
    
        return response()->json([
            'success' => false,
            'data' => $reservation->status,
            'message' => 'Reservation could not be canceled because it is not pending.'
        ], 400);
    }    
}
