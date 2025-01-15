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

class UserController extends Controller
{
    use HandleExceptionTrait;

    protected $accountService;
    protected $tempImageService;
    private $notificationService;
    protected $accountRepository;
    protected $roleRepository;

    // Base path for views
    const PATH_VIEW = 'backend.account.';
    const PER_PAGE_DEFAULT = 5;
    const OBJECT = 'user';
    const ROLE = 4;

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
     * Hiển thị danh sách người dùng.
     *
     * @param AccountListRequest $request
     * @return \Illuminate\View\View
     */
    public function index(AccountListRequest $request)
    {
        $this->authorize('modules', '' . self::OBJECT . '.index');
        $this->tempImageService->deleteTempImagesForUser();
        // Xác thực dữ liệu từ request
        $request->validated();

        // Trích xuất các bộ lọc từ request
        $params = $request->all();

        // Điền bộ lọc từ request
        $filters = [
            'search' => $params['keyword'] ?? '', // Đảm bảo tên này khớp với tên input tìm kiếm
            'start_date' => $params['start_date'] ?? '',
            'end_date' => $params['end_date'] ?? '',
            'status' => $params['status'] ?? '',
        ];

        // Lấy giá trị per_page
        $perPage = $params['per_page'] ?? self::PER_PAGE_DEFAULT;

        return view(self::PATH_VIEW . __FUNCTION__, [
            'object' => self::OBJECT,
            'totalRecords' => $this->accountRepository->countAccountsByRole([self::ROLE]), // Tổng số bản ghi để hiển thị
            'datas' => $this->accountService->getAllAccount($filters, $perPage, self::ROLE), // Truyền danh sách người dùng đã phân trang đến view
        ]);
    }

    /**
     * Hiển thị form để tạo người dùng mới.
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
     * Xử lý lưu trữ một người dùng mới.
     *
     * @param AccountStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(AccountStoreRequest $request)
    {
        // Xác thực dữ liệu từ request bằng AccountStoreRequest
        $data = $request->validated();
        try {
            // Tạo một người dùng mới
            $this->accountService->createAccount($data);

            return redirect()->back()->with('success', 'Người dùng đã được tạo thành công');
        } catch (\Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Hiển thị form để chỉnh sửa một người dùng.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $this->authorize('modules', '' . self::OBJECT . '.edit');
        session()->forget('image_temp'); // Xóa giá trị tạm thời của hình ảnh
        // Lấy thông tin chi tiết của người dùng
        $data = $this->accountService->getAccountDetail($id);
        if ($data) {

            return view(self::PATH_VIEW . __FUNCTION__, [
                'data' => $data,
                'object' => self::OBJECT,
                'dataRole' => $this->roleRepository->pluck('name', 'id'),
            ]);
        }

        abort(404); // Hiện trang lỗi 404 nếu không tìm thấy người dùng
    }

    /**
     * Xử lý cập nhật một người dùng.
     *
     * @param int $id
     * @param AccountUpdateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, AccountUpdateRequest $request)
    {
        // Xác thực dữ liệu từ request bằng AccountUpdateRequest
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

            return redirect()->back()->with('success', 'Người dùng đã được cập nhật thành công');
        } catch (\Exception $e) {
            Log::error('Error updating account: ' . $e->getMessage()); // Ghi log chi tiết lỗi
            Log::error('Exception trace: ', ['trace' => $e->getTraceAsString()]); // Log thêm trace để chi tiết hơn về lỗi

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Xóa một người dùng.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try {
            // Xóa người dùng
            $this->accountService->deleteAccount($id);

            return redirect()->back()->with('success', 'User delete successfully!');
        } catch (\Exception $e) {
            // Trả về phản hồi JSON nếu có lỗi

            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
