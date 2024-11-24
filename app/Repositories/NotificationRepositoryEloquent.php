<?php

namespace App\Repositories;

use App\Models\Notification;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Interfaces\Repositories\NotificationRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\DB;

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
    public function getAllNotifications(array $filters = [])
    {
        $query = $this->model->newQuery()
            ->leftJoin('notification_user', function ($join) {
                $join->on('notifications.id', '=', 'notification_user.notification_id')
                    ->where('notification_user.user_id', '=', auth()->id());
            })
            ->select('notifications.*', 'notification_user.user_id as user_id')
            ->orderByRaw('CASE WHEN notification_user.user_id IS NULL THEN 0 ELSE 1 END ASC') // Unread first
            ->orderBy('notifications.created_at', 'desc'); // Then by date created

        // Apply status filter for read/unread
        if (!empty($filters['status'])) {
            if ($filters['status'] == 'read') {
                // Filter only read notifications (i.e., has an entry in notification_user)
                $query->whereNotNull('notification_user.user_id');
            } elseif ($filters['status'] == 'unread') {
                // Filter only unread notifications (i.e., no entry in notification_user)
                $query->whereNull('notification_user.user_id');
            }
        }

        // Apply search filters
        if (!empty($filters['search'])) {
            $query->where(function ($q) use ($filters) {
                $q->where('title', 'like', '%' . $filters['search'] . '%')
                    ->orWhereRaw('JSON_EXTRACT(notifications.message, "$.name") LIKE ?', ['%' . $filters['search'] . '%'])
                    ->orWhereRaw('JSON_EXTRACT(notifications.message, "$.email") LIKE ?', ['%' . $filters['search'] . '%'])
                    ->orWhereRaw('JSON_EXTRACT(notifications.message, "$.phone") LIKE ?', ['%' . $filters['search'] . '%']);
            });
        }

        // Paginate results
        return $query->get();
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

    /**
     * Count the number of unread notifications for a specific user.
     *
     * @return int
     */
    public function countUnreadNotifications(int $userId): int
    {
        return Notification::whereNotExists(function ($query) use ($userId) {
            $query->select(DB::raw(1))
                ->from('notification_user')
                ->whereRaw('notification_user.notification_id = notifications.id')
                ->where('notification_user.user_id', $userId);
        })->count();
    }
}
