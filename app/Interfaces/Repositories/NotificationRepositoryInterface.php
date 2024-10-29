<?php

namespace App\Interfaces\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

interface NotificationRepositoryInterface extends RepositoryInterface
{
    /**
     * Get a paginated list of Notifications with optional search functionality.
     *
     * @param array $filters
     * @param int $perPage
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getAllNotifications(array $filters = []);

    /**
     * Get notification details by ID.
     *
     * @param int $id
     * @return mixed
     */
    public function getNotificationDetail(int $id);

    /**
     * Update an notification by ID with new data.
     *
     * @param int $id
     * @param array $params
     * @return mixed
     */
    public function updateNotification(int $id, array $params);

    /**
     * Create a new notification with the provided data.
     *
     * @param array $params
     * @return mixed
     */
    public function createNotification(array $params);

    /**
     * Get notification details by ID. (May duplicate `getNotificationDetail` method)
     *
     * @param int $id
     * @return mixed
     */
    public function detailNotification(int $id);

    /**
     * Delete an notification by ID.
     *
     * @param int $id
     * @return bool
     */
    public function deleteNotification(int $id);
}
