<?php

namespace App\Repositories;

use App\Models\Table;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Interfaces\Repositories\TableRepositoryInterface;

class TableRepositoryEloquent extends BaseRepository implements TableRepositoryInterface
{
    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return Table::class;
    }

    /**
     * Apply criteria in current Query Repository.
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * Get a paginated list of tables with optional search functionality.
     *
     * @param array $filters
     * @param int $perPage
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getAllTables(array $filters = [], $perPage = 5): \Illuminate\Pagination\LengthAwarePaginator
    {
        $query = $this->model->query();
        // Apply search filters for table name and position
        if (!empty($filters['search'])) {
            $query->where(function ($q) use ($filters) {
                $q->where('name', 'like', '%' . $filters['search'] . '%')
                    ->orWhere('position', 'like', '%' . $filters['search'] . '%');
            });
        }

        // Filter by status if provided
        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }
        if (!empty($filters['start_date'])) {
            $query->whereDate('created_at', '>=', $filters['start_date']);
        }

        if (!empty($filters['end_date'])) {
            $query->whereDate('created_at', '<=', $filters['end_date']);
        }

        // Sort by creation date (latest first)
        $query->orderBy('id', 'desc');

        // Paginate results
        return $query->paginate($perPage);
    }

    /**
     * Get table detail by ID.
     *
     * @param int $id
     * @return \App\Models\Table
     */
    public function getTableDetail($id): mixed
    {
        return $this->find($id);
    }

    /**
     * Update a table by ID.
     *
     * @param int $id
     * @param array $params
     * @return bool
     */
    public function updateTable($id, $params): mixed
    {
        return $this->update($params, $id);
    }

    /**
     * Create a new table.
     *
     * @param array $params
     * @return \App\Models\Table
     */
    public function createTable($params): mixed
    {
        return $this->create($params);
    }

    /**
     * Delete a table by ID.
     *
     * @param int $id
     * @return bool|null
     * @throws \Exception
     */
    public function deleteTable($id): bool
    {
        return $this->delete($id);
    }

    /**
     * Get all data by position.
     *
     * @return mixed
     */
    public function getAllTablesByPosition(): mixed
    {
        $query = $this->model->query();
        $query->orderBy('position', 'asc');
        return $query->get();
    }

    public function checkAvailableTables($reservationTime, $guests)
    {
        try {
            $seatsPerTable = 6;
            $requiredTables = ceil($guests / $seatsPerTable);
     
            $twoHoursBefore = \Carbon\Carbon::parse($reservationTime)->subHours(2);
            $twoHoursAfter = \Carbon\Carbon::parse($reservationTime)->addHours(2);
     
            // Sửa lại truy vấn nếu không còn cột table_id
            $availableTables = $this->model->where('status', 'available')
                ->whereDoesntHave('reservations', function ($query) use ($twoHoursBefore, $twoHoursAfter) {
                    // Sửa đổi phần này nếu bạn không còn sử dụng `table_id` trong bảng `reservations`
                    $query->where('reservation_time', '>=', $twoHoursBefore)
                        ->where('reservation_time', '<=', $twoHoursAfter)
                        ->whereIn('status', ['confirmed', 'completed']);
                })
                ->get();
     
            $availableTablesCount = $availableTables->count();
     
            if ($availableTablesCount >= $requiredTables) {
                return true;
            }
     
            return false;
        } catch (Exception $e) {
            \Log::error('Error checking available tables: ' . $e->getMessage());
            return false;
        }
    }      
}
