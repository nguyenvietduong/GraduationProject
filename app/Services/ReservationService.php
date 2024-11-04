<?php

namespace App\Services;

use App\Interfaces\Repositories\ReservationRepositoryInterface;
use App\Interfaces\Repositories\TableRepositoryInterface;
use App\Interfaces\Services\ReservationServiceInterface;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;

class ReservationService extends BaseService implements ReservationServiceInterface
{
    protected $reservationRepository;
    protected $tableRepository;

    /**
     * Create a new instance of ReservationService.
     *
     * @param ReservationRepositoryInterface $reservationRepository
     * @param ReservationRepositoryInterface $reservationRepository
     */
    public function __construct(
        ReservationRepositoryInterface $reservationRepository,
        TableRepositoryInterface $tableRepository,
    ) {
        $this->reservationRepository = $reservationRepository;
        $this->tableRepository = $tableRepository;
    }

    /**
     * Get a paginated list of reservations with optional filters.
     *
     * @param array $filters
     * @param int $perPage
     * @return mixed
     * @throws Exception
     */
    public function getAllReservations(array $filters = [], int $perPage = 5)
    {
        try {
            // Retrieve reservations from the repository using filters and pagination
            return $this->reservationRepository->getAllReservations($filters, $perPage);
        } catch (Exception $e) {
            // Handle any exceptions that occur while retrieving reservations
            throw new Exception('Unable to retrieve reservation list: ' . $e->getMessage());
        }
    }

    /**
     * Get the details of a reservation by its ID.
     *
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function getReservationDetail(int $id)
    {
        try {
            return $this->reservationRepository->getReservationDetail($id);
        } catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException('Reservation does not exist with ID: ' . $id);
        } catch (Exception $e) {
            // Handle other errors if necessary
            throw new Exception('Unable to retrieve reservation details: ' . $e->getMessage());
        }
    }

    /**
     * Create a new reservation.
     *
     * @param array $data
     * @return mixed
     */
    public function createReservation(array $data)
    {
        try {
            // Tạo thời gian đặt chỗ
            $reservation_time = \Carbon\Carbon::parse($data['date'] . ' ' . $data['input-time']);
            $data['reservation_time'] = $reservation_time;

            // Kiểm tra bàn trống cho thời gian này
            $availableTables = $this->tableRepository->checkAvailableTables($reservation_time, $data['guests']);
            if ($availableTables->isEmpty()) {
                throw new Exception('No tables are available for the selected time.');
            }

            // Duyệt qua danh sách bàn trống và kiểm tra trùng lặp
            foreach ($availableTables as $table) {
                // Kiểm tra nếu đã có đặt chỗ cùng bàn và thời gian này
                $existingReservation = $this->reservationRepository->existingReservation($table->id, $data['reservation_time']);
                // Nếu không trùng lặp, chọn bàn này
                if (!$existingReservation) {
                    $data['table_id'] = $table->id;
                    $data['status'] = 'confirmed'; // Tự động xác nhận

                    // Tạo đặt chỗ
                    return $this->reservationRepository->createReservation($data);
                }
            }

            // Nếu không tìm được bàn nào phù hợp, ném ngoại lệ
            throw new Exception('No tables are available without conflicts for the selected time.');
        } catch (Exception $e) {
            \Log::error('Unable to create reservation: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Update a reservation by its ID.
     *
     * @param int $id
     * @param array $data
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function updateReservation(int $id, array $data)
    {
        try {
            return $this->reservationRepository->updateReservation($id, $data);
        } catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException('Reservation does not exist with ID: ' . $id);
        } catch (Exception $e) {
            // Handle other errors if necessary
            throw new Exception('Unable to update reservation: ' . $e->getMessage());
        }
    }

    /**
     * Delete a reservation by its ID.
     *
     * @param int $id
     * @return bool
     * @throws ModelNotFoundException
     */
    public function deleteReservation(int $id)
    {
        try {
            return $this->reservationRepository->deleteReservation($id);
        } catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException('Reservation does not exist with ID: ' . $id);
        } catch (Exception $e) {
            // Handle other errors if necessary
            throw new Exception('Unable to delete reservation: ' . $e->getMessage());
        }
    }

    public function checkTableFullyBookedTimes($selectedDate)
    {
        // Convert selected date to Carbon for further processing
        $now = Carbon::parse($selectedDate);
        $totalTables = 10;
        $threshold = $totalTables * (2 / 3);

        // Get all confirmed reservations for the selected date
        $reservations = $this->reservationRepository->getConfirmedReservationsByDate($now);

        // Group reservations by time slot (hour and 30 minutes)
        $overdueReservationsByTimeSlot = $reservations->groupBy(function ($reservation) {
            $reservationTime = Carbon::parse($reservation->reservation_time);
            $hour = $reservationTime->format('H');
            $minutes = $reservationTime->minute < 30 ? '00' : '30';
            return "$hour:$minutes";
        });

        $fullyBookedTimeSlots = [];

        foreach ($overdueReservationsByTimeSlot as $timeSlot => $timeSlotReservations) {
            $reservationCount = $timeSlotReservations->count();
            // Add time slot to fully booked list if reservations exceed the threshold
            if ($reservationCount >= $threshold) {
                $fullyBookedTimeSlots[] = $timeSlot; // Only store times that are fully booked
            }
        }

        return $fullyBookedTimeSlots;
    }
}
