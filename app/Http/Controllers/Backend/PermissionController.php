<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Interfaces\Services\PermissionServiceInterface;
use App\Interfaces\Repositories\PermissionRepositoryInterface;
use App\Models\Role;
use App\Traits\HandleExceptionTrait;

// Requests
use App\Http\Requests\BackEnd\Permissions\ListRequest as PermissionListRequest;
use App\Http\Requests\BackEnd\Permissions\StoreRequest as PermissionStoreRequest;
use App\Http\Requests\BackEnd\Permissions\UpdateRequest as PermissionUpdateRequest;
use Illuminate\Support\Facades\Auth;

class PermissionController extends Controller
{
    use HandleExceptionTrait;

    protected $permissionService;
    protected $permissionRepository;

    // Base path for views
    const PATH_VIEW = 'backend.permission.';
    const PER_PAGE_DEFAULT = 5;
    const OBJECT = 'permission';

    public function __construct(
        PermissionServiceInterface $permissionService,
        PermissionRepositoryInterface $permissionRepository,
    ) {
        $this->permissionService = $permissionService;
        $this->permissionRepository = $permissionRepository;
    }

    /**
     * Display the list of permissions.
     *
     * @param PermissionListRequest $request
     * @return \Illuminate\View\View
     */
    public function index(PermissionListRequest $request)
    {
        $this->authorize('modules', '' . self::OBJECT . '.index');
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
        ];

        // Get the per_page value
        $perPage = $params['per_page'] ?? self::PER_PAGE_DEFAULT;

        // dd($this->permissionService->getAllPermissions($filters, $perPage, self::OBJECT));
        return view(self::PATH_VIEW . __FUNCTION__, [
            'object' => self::OBJECT,
            'permissionTotalRecords' => $this->permissionRepository->count(), // Total records for display
            'permissionDatas' => $this->permissionService->getAllPermissions($filters, $perPage, self::OBJECT), // Paginated permission list for the view
        ]);
    }

    /**
     * Show the form for creating a new permission.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $this->authorize('modules', '' . self::OBJECT . '.create');
        return view(self::PATH_VIEW . __FUNCTION__, [
            'object' => 'permission',
        ]);
    }

    /**
     * Handle the storage of a new permission.
     *
     * @param PermissionStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PermissionStoreRequest $request)
    {
        // Validate the data from the request using PermissionStoreRequest
        $data = $request->validated();
        // dd($data);
        try {
            // Create a new permission
            $this->permissionService->createPermission($data);
            return redirect()->back()->with('success', 'Permission created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Show the form for editing a permission.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $this->authorize('modules', '' . self::OBJECT . '.edit');
        // Retrieve the details of the permission
        $permission = $this->permissionService->getPermissionDetail($id);
        if ($permission) {
            return view(self::PATH_VIEW . __FUNCTION__, [
                'permissionData' => $permission,
                'object' => 'permission',
            ]);
        }

        abort(404);
    }

    /**
     * Handle the update of a permission.
     *
     * @param int $id
     * @param PermissionUpdateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($permission, PermissionUpdateRequest $request)
    {
        // Validate the data from the request using PermissionUpdateRequest
        $data = $request->validated();

        try {
            // Update the permission
            $this->permissionService->updatePermission($permission, $data);
            return redirect()->route('admin.permission.index')->with('success', 'Permission updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Delete a permission.
     *
     * @param int $permission
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($permission)
    {
        try {
            // Delete the permission
            $this->permissionService->deletePermission($permission);

            return redirect()->back()->with('success', 'Permission deleted successfully');
        } catch (\Exception $e) {
            // Return a JSON response if there is an error
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function ajaxGetPermission()
    {
        $user = Auth::user(); // Lấy người dùng hiện tại

        $role = Role::with('permissions')->find($user->role_id);
        return [
            'response' => response()->json(['message' => 'Status updated successfully']),
            'data' => $role
        ];

    }
}
