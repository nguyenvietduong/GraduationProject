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
        $query->orderBy('position','asc');
        return $query->get();
    }

    public function checkAvailableTables($reservationTime, $guests)
    {
        // Tính toán số lượng bàn cho phép đặt online
        $totalTables = $this->model->count();
        $onlineReservableTablesCount = ceil($totalTables * (2 / 3));

        // Calculate the time window for reservations (2 hours before and 2 hours after the desired reservation time)
        $twoHoursBefore = \Carbon\Carbon::parse($reservationTime)->subHours(2);
        $twoHoursAfter = \Carbon\Carbon::parse($reservationTime)->addHours(2);

        // Lấy danh sách các bàn trống, sắp xếp để ưu tiên bàn có sức chứa gần nhất và giới hạn theo số lượng cho phép
        return $this->model->where('status', 'available') // Chỉ lấy những bàn có trạng thái "available"
            ->where('capacity', '>=', $guests)
            ->whereDoesntHave('reservations', function ($query) use ($twoHoursBefore, $twoHoursAfter) {
                $query->where('reservation_time', '>=', $twoHoursBefore) // Check for reservations starting after two hours before the desired time
                    ->where('reservation_time', '<=', $twoHoursAfter) // And ending before two hours after the reservation time
                    ->where('status', 'confirmed');
            })
            ->orderByRaw('capacity - ? ASC', [$guests]) // Sắp xếp theo độ chênh lệch giữa sức chứa và số khách
            ->take($onlineReservableTablesCount)
            ->get();
    }
}
