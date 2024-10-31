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
        'vi' => 'Đặt bàn thành công!',
        'en' => 'Booking successful!',
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

            if ($reservationNew === false) {
                // Reservation failed, send cancellation email
                if (isset($data['email'])) {
                    Mail::to($data['email'])->send(new ReservationCancellationMail($data));
                }
                return response()->json([
                    'success' => false,
                    'message' => App::getLocale() == 'vi' ? self::bookingFailed['vi'] : self::bookingFailed['en'],
                ], 400); // Bad Request
            }

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
                'data' => $reservationNew // Optionally include reservation data
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
        // Validate incoming request
        $request->validate([
            'date' => 'required|date',
            'time' => 'required|string',
            'duration' => 'required|integer|min:1', // Duration in hours
        ]);

        // Get the date, time, and duration from the request
        $date = $request->input('date'); // e.g., "2024-10-30"
        $time = $request->input('time'); // e.g., "12:00"
        $duration = $request->input('duration'); // e.g., 2 for 2 hours

        // Combine date and time into a single DateTime object
        $reservationStartTime = \Carbon\Carbon::parse("$date $time");
        $reservationEndTime = $reservationStartTime->copy()->addHours($duration); // Calculate end time

        // Get IDs of tables that are reserved during the specified time
        $reservedTableIds = Reservation::whereBetween('reservation_time', [$reservationStartTime, $reservationEndTime])
            ->pluck('table_id'); // Get IDs of reserved tables

        // Find available tables
        $availableTables = Table::whereNotIn('id', $reservedTableIds)->get();

        // Count total tables and available tables
        $totalTables = Table::count(); // Total number of tables
        $availableCount = $availableTables->count(); // Count of available tables

        // Return response
        return response()->json([
            'available' => $availableTables, // Optionally, you might want to return just IDs or a summary
            'count' => $availableCount,
            'message' => $availableCount === 0
                ? 'Sorry, all tables are reserved during this time.'
                : "$availableCount table(s) available.",
        ]);
    }
}
