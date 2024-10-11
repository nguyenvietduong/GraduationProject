<?php

namespace App\Repositories;

use App\Models\Notification;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Interfaces\Repositories\NotificationRepositoryInterface;

class NotificationRepositoryEloquent extends BaseRepository implements NotificationRepositoryInterface
{
    /**
     * Specify the model class name.
     *
     * @return string
     */
    public function model()
    {
        return Notification::class;
    }

    /**
     * Apply criteria in the current Query Repository.
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * Get a paginated list of Notifications with optional search functionality.
     *
     * @param array $filters
     * @param int $perPage
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getAllNotifications(array $filters = [], $perPage = 5)
    {
        $query = $this->model->query();

        // Apply search filters
        if (!empty($filters['search'])) {
            $query->where(function ($q) use ($filters) {
                $q->where('title', 'like', '%' . $filters['search'] . '%')
                ->orWhere('message', 'like', '%' . $filters['search' . '%']);
            });
        }

        if (!empty($filters['start_date'])) {
            $query->whereDate('created_at', '>=', $filters['start_date']);
        }

        if (!empty($filters['end_date'])) {
            $query->whereDate('created_at', '<=', $filters['end_date']);
        }

        if (!empty($filters['title'])) {
            $query->where('title', $filters['title']);
        }

        // Sort by creation date (latest first)
        $query->orderBy('created_at', 'desc');

        // Paginate results
        return $query->paginate($perPage);
    }

    /**
     * Get notification details by ID.
     *
     * @param int $id
     * @return \App\Models\Notification
     */
    public function getNotificationDetail($id)
    {
        return $this->find($id);
    }

    /**
     * Update an notification by ID.
     *
     * @param int $id
     * @param array $params
     * @return bool
     */
    public function updateNotification($id, $params)
    {
        return $this->update($params, $id);
    }

    /**
     * Create a new notification.
     *
     * @param array $params
     * @return \App\Models\Notification
     */
    public function createNotification($params)
    {
        return $this->create($params);
    }

    /**
     * Get notification details by ID (same as getNotificationDetail).
     *
     * @param int $id
     * @return \App\Models\Notification
     */
    public function detailNotification($id)
    {
        return $this->find($id);
    }

    /**
     * Delete an notification by ID.
     *
     * @param int $id
     * @return bool|null
     * @throws \Exception
     */
    public function deleteNotification($id)
    {
        return $this->delete($id);
    }
}
