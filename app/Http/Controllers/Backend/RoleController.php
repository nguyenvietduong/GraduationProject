<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\Backend\RoleDataTable;
use App\Http\Controllers\Controller;
use App\Interfaces\Services\RoleServiceInterface;
use App\Interfaces\Repositories\RoleRepositoryInterface;
use App\Traits\HandleExceptionTrait;

// Requests
use App\Http\Requests\BackEnd\Roles\ListRequest as RoleListRequest;
use App\Http\Requests\BackEnd\Roles\StoreRequest as RoleStoreRequest;
use App\Http\Requests\BackEnd\Roles\UpdateRequest as RoleUpdateRequest;

class RoleController extends Controller
{
    use HandleExceptionTrait;

    protected $roleService;
    protected $roleRepository;

    // Base path for views
    const PATH_VIEW = 'backend.role.';
    const PER_PAGE_DEFAULT = 5;
    const OBJECT = 'role';

    public function __construct(
        RoleServiceInterface $roleService,
        RoleRepositoryInterface $roleRepository,
    ) {
        $this->roleService = $roleService;
        $this->roleRepository = $roleRepository;
    }

    /**
     * Display the list of roles.
     *
     * @param RoleListRequest $request
     * @return \Illuminate\View\View
     */
    public function index(RoleListRequest $request)
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
        ];

        // Get the per_page value
        $perPage = $params['per_page'] ?? self::PER_PAGE_DEFAULT;

        return view(self::PATH_VIEW . __FUNCTION__, [
            'object' => self::OBJECT,
            'roleTotalRecords' => $this->roleRepository->count(), // Total records for display
            'roleDatas' => $this->roleService->getAllRoles($filters, $perPage, self::OBJECT), // Paginated role list for the view
        ]);
    }

    /**
     * Show the form for creating a new role.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view(self::PATH_VIEW . __FUNCTION__, [
            'object' => 'role',
        ]);
    }

    /**
     * Handle the storage of a new role.
     *
     * @param RoleStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(RoleStoreRequest $request)
    {
        // Validate the data from the request using RoleStoreRequest
        $data = $request->validated();
        try {
            // Create a new role
            $this->roleService->createRole($data);
            return redirect()->back()->with('success', 'Role created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Show the form for editing a role.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        // Retrieve the details of the role
        $role = $this->roleService->getRoleDetail($id);
        if ($role) {
            return view(self::PATH_VIEW . __FUNCTION__, [
                'roleData' => $role,
                'object' => 'role',
            ]);
        }

        abort(404);
    }

    /**
     * Handle the update of a role.
     *
     * @param int $id
     * @param RoleUpdateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, RoleUpdateRequest $request)
    {
        // Validate the data from the request using RoleUpdateRequest
        $data = $request->validated();

        try {
            // Update the role
            $this->roleService->updateRole($id, $data);
            return redirect()->route('admin.role.index')->with('success', 'Role updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Delete a role.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        try {
            // Delete the role
            $this->roleService->deleteRole($id);

            return redirect()->back()->with('success', 'Role deleted successfully');
        } catch (\Exception $e) {
            // Return a JSON response if there is an error
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
