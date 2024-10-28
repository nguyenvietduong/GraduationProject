<?php

namespace App\Services;

use App\Interfaces\Repositories\NotificationRepositoryInterface;
use App\Interfaces\Services\NotificationServiceInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;
use Illuminate\Support\Facades\Auth;

class NotificationService extends BaseService implements NotificationServiceInterface
{
    protected $notificationRepository;

    /**
     * Create a new instance of NotificationService.
     *
     * @param NotificationRepositoryInterface $notificationRepository
     */
    public function __construct(
        NotificationRepositoryInterface $notificationRepository,
    ) {
        $this->notificationRepository = $notificationRepository;
    }

    /**
     * Get a paginated list of Categories with optional filters.
     *
     * @param array $filters
     * @param int $perPage
     * @return mixed
     * @throws Exception
     */
    public function getAllNotifications(array $filters = [])
    {
        try {
            // Retrieve Categories from the repository using filters and pagination
            return $this->notificationRepository->getAllNotifications($filters);
        } catch (Exception $e) {
            // Handle any exceptions that occur while retrieving Categories
            throw new Exception('Unable to retrieve Notification list: ' . $e->getMessage());
        }
    }

    /**
     * Get the details of a notification by ID.
     *
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function getNotificationDetail(int $id)
    {
        try {
            return $this->notificationRepository->getNotificationDetail($id);
        } catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException('Notification not found with ID: ' . $id);
        } catch (Exception $e) {
            // Handle other errors if necessary
            throw new Exception('Unable to retrieve notification details: ' . $e->getMessage());
        }
    }

    /**
     * Create a new notification.
     *
     * @param array $data
     * @return mixed
     */

    public function createNotification(array $data)
    {
        try {
            return $this->notificationRepository->createNotification($data);
        } catch (\Exception $e) {
            throw new \Exception('Unable to create notification: ' . $e->getMessage());
        }
    }

    /**
     * Update a notification by ID.
     *
     * @param int $id
     * @param array $data
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function updateNotification(int $id, array $data)
    {
        try {
            return $this->notificationRepository->updateNotification($id, $data);
        } catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException('Notification not found with ID: ' . $id);
        } catch (\Exception $e) {
            throw new \Exception('Unable to update notification: ' . $e->getMessage());
        }
    }

    /**
     * Delete a notification by ID.
     *
     * @param int $id
     * @return bool
     * @throws ModelNotFoundException
     */
    public function deleteNotification(int $id)
    {
        try {
            return $this->notificationRepository->deleteNotification($id);
        } catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException('Notification not found with ID: ' . $id);
        } catch (Exception $e) {
            // Handle other errors if necessary
            throw new Exception('Unable to delete notification: ' . $e->getMessage());
        }
    }

    public function countUnreadNotifications(): int
    {
        if (Auth::check()) {
            $userId = Auth::user()->id; 
            return $this->notificationRepository->countUnreadNotifications($userId);
        }
    
        return 0;
    }    
}
