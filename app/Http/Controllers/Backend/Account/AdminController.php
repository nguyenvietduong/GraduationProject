<?php

namespace App\Http\Controllers\Backend\Account;

use App\Http\Controllers\Controller;
use App\Interfaces\Services\AccountServiceInterface;
use App\Interfaces\Services\TempImageServiceInterface;
use App\Interfaces\Repositories\AccountRepositoryInterface;
use App\Interfaces\Repositories\RoleRepositoryInterface;
use App\Traits\HandleExceptionTrait;

// Requests
use App\Http\Requests\BackEnd\Accounts\ListRequest as AccountListRequest;
use App\Http\Requests\BackEnd\Accounts\StoreRequest as AccountStoreRequest;
use App\Http\Requests\BackEnd\Accounts\UpdateRequest as AccountUpdateRequest;

class AdminController extends Controller
{
    use HandleExceptionTrait;

    protected $accountService;
    protected $tempImageService;
    protected $accountRepository;
    protected $roleRepository;

    // Base path for views
    const PATH_VIEW = 'backend.account.';
    const PER_PAGE_DEFAULt = 5;
    const OBJECT = 'admin';
    const ROLE = 1;

    public function __construct(
        AccountServiceInterface $accountService,
        TempImageServiceInterface $tempImageService,
        AccountRepositoryInterface $accountRepository,
        RoleRepositoryInterface $roleRepository,
    ) {
        $this->accountService = $accountService;
        $this->tempImageService = $tempImageService;
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

        return view(self::PATH_VIEW . __FUNCTION__, [
            'object' => self::OBJECT,
            'totalRecords' => $this->accountRepository->countAccountsByRole(self::ROLE), // Total records for display
            'datas' => $this->accountService->getAllAccount($filters, $perPage, self::ROLE), // Pass the paginated users to the view
        ]);
    }

    /**
     * Show the form for creating a new admin.
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
     * Handle the storage of a new admin.
     *
     * @param AccountStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(AccountStoreRequest $request)
    {
        // Validate the data from the request using AccountStoreRequest
        $data = $request->all();
        try {
            // Create a new admin
            $this->accountService->createAccount($data);

            return redirect()->back()->with('success', 'Admin created successfully');
        } catch (\Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Show the form for editing an admin.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $this->authorize('modules', '' . self::OBJECT . '.edit');
        session()->forget('image_temp');
        // Retrieve the details of the admin
        $data = $this->accountService->getAccountDetail($id);
        if ($data) {

            return view(self::PATH_VIEW . __FUNCTION__, [
                'data' => $data,
                'object' => self::OBJECT,
                'dataRole' => $this->roleRepository->pluck('name', 'id'),
            ]);
        }

        abort(404);
    }

    /**
     * Handle the update of an admin.
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
            // Update the admin
            $this->accountService->updateAccount($id, $data);

            return redirect()->back()->with('success', 'Admin updated successfully');
        } catch (\Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Delete an admin.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        try {
            // Delete the admin
            $this->accountService->deleteAccount($id);

            return redirect()->back()->with('success', 'Admin delete successfully!');
        } catch (\Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
