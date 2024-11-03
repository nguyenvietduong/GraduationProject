<?php

namespace App\Services;

use App\Interfaces\Repositories\ReservationRepositoryInterface;
use App\Interfaces\Repositories\TableRepositoryInterface;
use App\Interfaces\Services\ReservationServiceInterface;
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

            // Chọn bàn trống đầu tiên và gán cho đặt chỗ
            $data['table_id'] = $availableTables->first()->id;
            $data['status'] = 'confirmed'; // Tự động xác nhận
            // Tạo đặt chỗ
            return $this->reservationRepository->createReservation($data);
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
}
