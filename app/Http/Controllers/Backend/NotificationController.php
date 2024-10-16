<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Interfaces\Repositories\PermissionRepositoryInterface as PermissionRepository;
use App\Interfaces\Services\NotificationServiceInterface;
use App\Interfaces\Repositories\NotificationRepositoryInterface;
use App\Traits\HandleExceptionTrait;

// Requests
use App\Http\Requests\BackEnd\Notifications\ListRequest as NotificationListRequest;
use App\Http\Requests\BackEnd\Notifications\StoreRequest as NotificationStoreRequest;
use App\Http\Requests\BackEnd\Notifications\UpdateRequest as NotificationUpdateRequest;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    use HandleExceptionTrait;

    protected $notificationService;
    protected $notificationRepository;

    protected $permissionRepository;

    // Base path for views
    const PATH_VIEW = 'backend.notification.';
    const PER_PAGE_DEFAULT = 5;
    const OBJECT = 'notification';

    public function __construct(
        NotificationServiceInterface $notificationService,
        NotificationRepositoryInterface $notificationRepository,
        PermissionRepository $permissionRepository,
    ) {
        $this->notificationService = $notificationService;
        $this->notificationRepository = $notificationRepository;
        $this->permissionRepository = $permissionRepository;
    }

    /**
     * Display the list of notifications.
     *
     * @param NotificationListRequest $request
     * @return \Illuminate\View\View
     */
    public function index(NotificationListRequest $request)
    {
        session()->forget('image_temp'); // Clear temporary image value
        // Validate the request data
        $request->validated();

        // Extract filters from the request
        $params = $request->all();

        // Apply filters from the request
        $filters = [
            'search' => $params['keyword'] ?? '', // Ensure this matches the search input name
            'start_date' => $params['start_date'] ?? '',
            'end_date' => $params['end_date'] ?? '',
            'title' => $params['title'] ?? '',
        ];

        // Get the per_page value
        $perPage = $params['per_page'] ?? self::PER_PAGE_DEFAULT;

        return view(self::PATH_VIEW . __FUNCTION__, [
            'object' => self::OBJECT,
            'notificationTotalRecords' => $this->notificationRepository->count(), // Total records for display
            'notificationDatas' => $this->notificationService->getAllNotifications($filters, $perPage, self::OBJECT), // Paginated notification list for the view
        ]);
    }

    /**
     * Show the form for creating a new notification.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $this->authorize('modules', 'edit accounts');
        return view(self::PATH_VIEW . __FUNCTION__, [
            'object' => 'notification',
        ]);
    }

    /**
     * Handle the storage of a new notification.
     *
     * @param NotificationStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(NotificationStoreRequest $request)
    {
        // Validate the data from the request using NotificationStoreRequest
        $data = $request->validated();
        try {
            // Create a new notification
            $this->notificationService->createNotification($data);
            return redirect()->back()->with('success', 'Notification created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Show the form for editing a notification.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        // Retrieve the details of the notification
        $notification = $this->notificationService->getNotificationDetail($id);
        if ($notification) {
            return view(self::PATH_VIEW . __FUNCTION__, [
                'notificationData' => $notification,
                'object' => 'notification',
            ]);
        }

        abort(404);
    }

    /**
     * Handle the update of a notification.
     *
     * @param int $id
     * @param NotificationUpdateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, NotificationUpdateRequest $request)
    {
        // Validate the data from the request using NotificationUpdateRequest
        $data = $request->validated();

        try {
            // Update the notification
            $this->notificationService->updateNotification($id, $data);
            return redirect()->route('admin.notification.index')->with('success', 'Notification updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Delete a notification.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        try {
            // Delete the notification
            $this->notificationService->deleteNotification($id);

            return redirect()->back()->with('success', 'Notification deleted successfully');
        } catch (\Exception $e) {
            // Return a JSON response if there is an error
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function permission()
    {
        $notifications = $this->notificationRepository->all();
        $permissions = $this->permissionRepository->all();
        // dd($permissions);
        return view('backend.notification.permission', [
            'object' => 'notification',
            'notifications' => $notifications,
            'permissions' => $permissions
        ]);
    }


    public function updatePermission(Request $request)
    {
        try {
            // Delete the notification
            // echo 1; die;
            $this->notificationService->updatePermission($request);

            return redirect()->back()->with('success', 'Notification Permission update successfully');
        } catch (\Exception $e) {
            // Return a JSON response if there is an error
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
