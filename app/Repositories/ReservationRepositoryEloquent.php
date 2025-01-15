<?php

namespace App\Repositories;

use App\Models\Reservation;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Interfaces\Repositories\ReservationRepositoryInterface;

class ReservationRepositoryEloquent extends BaseRepository implements ReservationRepositoryInterface
{
    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return Reservation::class;
    }

    /**
     * Apply criteria in current Query Repository.
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * Get a paginated list of Reviews with optional search functionality.
     *
     * @param array $filters
     * @param int $perPage
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getAllReservations(array $filters = [], $perPage = 5)
    {
        $query = $this->model->query();
        $query->where('status', '!=', ['completed', 'pending']);

        $query->whereDate('reservation_time', '=', now()->toDateString());

        // Apply search filters
        if (!empty($filters['name'])) {
            $query->where('name', 'like', '%' . $filters['name'] . '%');
        }

        if (!empty($filters['isCanceled'])) {
            $query->where('status', $filters['isCanceled']);
        } else {
            $query->where('status', '!=', 'canceled');
        }

        if (!empty($filters['email'])) {
            $query->where('email', $filters['email']);
        }

        if (!empty($filters['phone'])) {
            $query->where('phone', $filters['phone']);
        }

        if (!empty($filters['reservation_time'])) {
            // Adjust to match full datetime if needed
            $query->where('reservation_time', '=', $filters['reservation_time']);
        }

        // Sort by creation date (latest first)
        // $query->orderBy('reservation_time', '');
        $query->orderByRaw("
            CASE 
                WHEN status = 'canceled' THEN 1
                ELSE 0
            END ASC
        ");
        $query->orderByRaw("
            ABS(TIMESTAMPDIFF(SECOND, reservation_time, NOW())) ASC
        ");
        // $query->orderByRaw("FIELD(status, 'arrived', 'confirmed', 'pending','canceled') ASC");
        // Paginate results
        return $query->paginate($perPage);
    }

    public function getAllReservationsArrived(array $filters = [], $perPage = 5)
    {
        $query = $this->model->query();
        $query->where('status', '=', 'arrived');

        $query->whereDate('reservation_time', '=', now()->toDateString());

        // Apply search filters
        if (!empty($filters['code'])) {
            $query->where('code', 'like', '%' . $filters['code'] . '%');
        }


        if (!empty($filters['reservation_time'])) {
            // Adjust to match full datetime if needed
            $query->where('reservation_time', '=', $filters['reservation_time']);
        }

        // Sort by creation date (latest first)
        // $query->orderBy('reservation_time', '');
        $query->orderByRaw("
            ABS(TIMESTAMPDIFF(SECOND, reservation_time, NOW())) ASC
        ");
        // $query->orderByRaw("FIELD(status, 'arrived', 'confirmed', 'pending','canceled') ASC");
        // Paginate results
        return $query->paginate($perPage);
    }

    /**
     * Get Reservation detail by ID.
     *
     * @param int $id
     * @return \App\Models\Reservation
     */
    public function getReservationDetail($id)
    {
        return $this->find($id);
    }

    /**
     * Update an Reservation by ID.
     *
     * @param int $id
     * @param array $params
     * @return bool
     */
    public function updateReservation($id, $params)
    {
        return $this->update($params, $id);
    }

    /**
     * Create a new Reservation.
     *
     * @param array $params
     * @return \App\Models\Reservation
     */
    public function createReservation($params)
    {
        return $this->create($params);
    }

    /**
     * Get Reservation detail by ID (same as getReservationDetail).
     *
     * @param int $id
     * @return \App\Models\Reservation
     */
    public function detailReservation($id)
    {
        return $this->find($id);
    }

    /**
     * Delete an Reservation by ID.
     *
     * @param int $id
     * @return bool|null
     * @throws \Exception
     */
    public function deleteReservation($id)
    {
        return $this->delete($id);
    }

    public function getConfirmedReservationsByDate($date)
    {
        return $this->model->whereDate('reservation_time', '=', $date)
            ->where('status', '=', 'confirmed')
            ->get();
    }

    // Kiểm tra nếu đã có đặt chỗ cùng bàn và thời gian này
    public function existingReservation($IdTable, $data = [])
    {
        return $this->model->where('table_id', $IdTable)
            ->where('reservation_time', $data)
            ->first();
    }
}
