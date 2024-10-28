<?php

namespace App\Interfaces\Services;

interface NotificationServiceInterface
{
    /**
     * Get a paginated list of Notifications with optional filters.
     *
     * @param array $filters
     * @return mixed
     */
    public function getAllNotifications(array $filters = []);

    /**
     * Get the details of a Notification by ID.
     *
     * @param int $id
     * @return mixed
     */
    public function getNotificationDetail(int $id);

    /**
     * Create a new Notification.
     *
     * @param array $data
     * @return mixed
     */
    public function createNotification(array $data);

    /**
     * Update a Notification by ID.
     *
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function updateNotification(int $id, array $data);

    /**
     * Delete a Notification by ID.
     *
     * @param int $id
     * @return bool
     */
    public function deleteNotification(int $id);
}
