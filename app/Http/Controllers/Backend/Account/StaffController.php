<?php

namespace App\Http\Controllers\Backend\Account;

use App\Events\NotificationEvent;
use App\Http\Controllers\Controller;
use App\Interfaces\Services\AccountServiceInterface;
use App\Interfaces\Services\TempImageServiceInterface;
use App\Interfaces\Services\NotificationServiceInterface;
use App\Interfaces\Repositories\AccountRepositoryInterface;
use App\Interfaces\Repositories\RoleRepositoryInterface;
use App\Traits\HandleExceptionTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

// Requests
use App\Http\Requests\BackEnd\Accounts\ListRequest as AccountListRequest;
use App\Http\Requests\BackEnd\Accounts\StoreRequest as AccountStoreRequest;
use App\Http\Requests\BackEnd\Accounts\UpdateRequest as AccountUpdateRequest;

class StaffController extends Controller
{
    use HandleExceptionTrait;

    protected $accountService;
    protected $tempImageService;
    private $notificationService;
    protected $accountRepository;
    protected $roleRepository;

    // Base path for views
    const PATH_VIEW = 'backend.account.';
    const PER_PAGE_DEFAULt = 5;
    const OBJECT = 'staff';
    const ROLE = 2;

    public function __construct(
        AccountServiceInterface $accountService,
        TempImageServiceInterface $tempImageService,
        NotificationServiceInterface $notificationService,
        AccountRepositoryInterface $accountRepository,
        RoleRepositoryInterface $roleRepository,
    ) {
        $this->accountService = $accountService;
        $this->tempImageService = $tempImageService;
        $this->notificationService = $notificationService;
        $this->accountRepository = $accountRepository;
        $this->roleRepository = $roleRepository;
    }

    /**
     * Display a listing of users.
     *
     * @param AccountListRequest $request
     * @return \Illuminate\View\View
     */
    public function index(AccountListRequest $request)
    {
        $this->authorize('modules', '' . self::OBJECT . '.index');
        $this->tempImageService->deleteTempImagesForUser();
        // Validate the request data
        $request->validated();

        // Extract filters from request
        $params = $request->all();

        // Populate filters from the request
        $filters = [
            'search' => $params['keyword'] ?? '', // Đảm bảo tên này khớp với tên input tìm kiếm
            'start_date' => $params['start_date'] ?? '',
            'end_date' => $params['end_date'] ?? '',
            'status' => $params['status'] ?? '',
        ];

        // Get per_page value
        $perPage = $params['per_page'] ?? self::PER_PAGE_DEFAULt;
        $datas = $this->accountService->getAllAccount($filters, $perPage, [2, 3]);

        return view(self::PATH_VIEW . __FUNCTION__, [
            'object' => self::OBJECT,
            'totalRecords' => $this->accountRepository->countAccountsByRole([2, 3]), // Total records for display
            'datas' => $datas, // Pass the paginated users to the view
        ]);
    }

    /**
     * Show the form for creating a new Staff.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $this->authorize('modules', '' . self::OBJECT . '.create');
        return view(self::PATH_VIEW . __FUNCTION__, [
            'object' => self::OBJECT,
            'dataRole' => $this->roleRepository->pluck('name', 'id'),
        ]);
    }

    /**
     * Handle the storage of a new Staff.
     *
     * @param AccountStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(AccountStoreRequest $request)
    {
        // Validate the data from the request using AccountStoreRequest
        $data = $request->validated();
        try {
            // Create a new Staff
            $this->accountService->createAccount($data);

            return redirect()->back()->with('success', 'Staff created successfully');
        } catch (\Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Show the form for editing an Staff.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $this->authorize('modules', '' . self::OBJECT . '.edit');
        session()->forget('image_temp');
        // Retrieve the details of the Staff
        $data = $this->accountService->getAccountDetail($id);
        if ($data) {

            return view(self::PATH_VIEW . __FUNCTION__, [
                'data' => $data,
                'object' => self::OBJECT,
                'dataRole' => $this->roleRepository->where('name', '!=', 'Admin')->pluck('name', 'id'),
            ]);
        }

        abort(404);
    }

    /**
     * Handle the update of an Staff.
     *
     * @param int $id
     * @param AccountUpdateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, AccountUpdateRequest $request)
    {
        // Validate the data from the request using AccountUpdateRequest
        $data = $request->all();

        try {
            // Gửi thông báo chung
            $title = 'Account';
            $message = 'edited account!';

            Log::info('Starting update process for account ID: ' . $id); // Log thông tin

            event(new NotificationEvent($title, $message, 'info', Auth::user()->full_name));
            // dispatch(new SendNotificationJob($title, $message, 'info', Auth::user()->full_name)); // Thay thế 'info' và $review nếu cần

            $dataNotification = [
                'user_id' => Auth::user()->id,  // ID của người gửi thông báo
                'title' => $title,
                'message' => $message,
            ];

            Log::info('Preparing notification data: ', $dataNotification); // Log thông tin

            $this->notificationService->createNotification($dataNotification);

            // Cập nhật người dùng
            Log::info('Updating account with data: ', $data); // Log thông tin

            $this->accountService->updateAccount($id, $data);

            Log::info('Account updated successfully for user ID: ' . $id); // Log khi thành công

            // Update the Staff
            $this->accountService->updateAccount($id, $data);

            return redirect()->back()->with('success', 'Staff updated successfully');
        } catch (\Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Delete an Staff.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        try {
            // Delete the Staff
            $this->accountService->deleteAccount($id);

            return redirect()->back()->with('success', 'Staff delete successfully!');
        } catch (\Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
