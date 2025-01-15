<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Interfaces\Repositories\PermissionRepositoryInterface as PermissionRepository;
use App\Interfaces\Services\MenuServiceInterface;
use App\Interfaces\Repositories\MenuRepositoryInterface;
use App\Interfaces\Repositories\CategoryRepositoryInterface;
use App\Models\Invoice_item;
use App\Traits\HandleExceptionTrait;
use Illuminate\Support\Str;

// Requests
use App\Http\Requests\BackEnd\Menus\ListRequest as MenuListRequest;
use App\Http\Requests\BackEnd\Menus\StoreRequest as MenuStoreRequest;
use App\Http\Requests\BackEnd\Menus\UpdateRequest as MenuUpdateRequest;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    use HandleExceptionTrait;

    protected $menuService;
    protected $menuRepository;
    protected $categoryRepository;

    protected $permissionRepository;

    // Base path for views
    const PATH_VIEW = 'backend.menu.';
    const PER_PAGE_DEFAULT = 5;
    const OBJECT = 'menu';

    public function __construct(
        MenuServiceInterface $menuService,
        MenuRepositoryInterface $menuRepository,
        CategoryRepositoryInterface $categoryRepository,
        PermissionRepository $permissionRepository,

    ) {
        $this->menuService = $menuService;
        $this->menuRepository = $menuRepository;
        $this->categoryRepository = $categoryRepository;
        $this->permissionRepository = $permissionRepository;
    }

    /**
     * Display the list of menus.
     *
     * @param MenuListRequest $request
     * @return \Illuminate\View\View
     */
    public function index(MenuListRequest $request)
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
            'start_price' => $params['start_price'] ?? 0,
            'end_price' => $params['end_price'] ?? 0,
            'status' => $params['status'] ?? '',
            'category' => $params['category'] ?? '',
        ];
        // Get the per_page value
        $perPage = $params['per_page'] ?? self::PER_PAGE_DEFAULT;
        return view(self::PATH_VIEW . __FUNCTION__, [
            'object' => self::OBJECT,
            'categories' => $this->categoryRepository->getAllCategories(),
            'menuTotalRecords' => $this->menuRepository->count(), // Total records for display
            'menuDatas' => $this->menuService->getAllMenus($filters, $perPage, self::OBJECT), // Paginated menu list for the view
        ]);
    }

    /**
     * Show the form for creating a new menu.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $this->authorize('modules', '' . self::OBJECT . '.create');
        // $this->authorize('modules', 'edit accounts');
        return view(self::PATH_VIEW . __FUNCTION__, [
            'object' => 'menu',
            "categories" => $this->categoryRepository->getAllCategories()
        ]);
    }

    /**
     * Handle the storage of a new menu.
     *
     * @param MenuStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(MenuStoreRequest $request)
    {
        // Validate the data from the request using MenuStoreRequest
        $data = $request->validated();
        try {
            // Create a new menu
            $this->menuService->createMenu($data);
            return redirect()->back()->with('success', 'Menu created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Show the form for editing a menu.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $this->authorize('modules', '' . self::OBJECT . '.edit');
        // Retrieve the details of the menu
        $menu = $this->menuService->getMenuDetail($id);
        // dd($menu);
        if ($menu) {
            return view(self::PATH_VIEW . __FUNCTION__, [
                'menuData' => $menu,
                'object' => 'menu',
                "categories" => $this->categoryRepository->getAllCategories()
            ]);
        }

        abort(404);
    }

    /**
     * Handle the update of a menu.
     *
     * @param int $id
     * @param MenuUpdateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, MenuUpdateRequest $request)
    {
        // Validate the data from the request using MenuUpdateRequest
        $data = $request->validated();
        $data["currency"] = $request->currency;
        $data["image_old"] = $request->get("image_old");
        try {
            $hasInvalidStatus = Invoice_item::where('menu_id', $id)
                ->whereRaw('JSON_EXTRACT(status_menu, "$.\"1\"") != "0"')
                ->exists();

            if ($hasInvalidStatus) {
                return redirect()->back()->with('error', 'Không thể cập nhật vì món ăn này đang được xử lý trong hóa đơn.');
            }
            // Update the menu
            $this->menuService->updateMenu($id, $data);
            return redirect()->route('admin.menu.index')->with('success', 'Menu updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Delete a menu.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        try {
            // Delete the menu
            $this->menuService->deleteMenu($id);

            return redirect()->back()->with('success', 'Menu deleted successfully');
        } catch (\Exception $e) {
            // Return a JSON response if there is an error
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function permission()
    {
        $menus = $this->menuRepository->all();
        $permissions = $this->permissionRepository->all();
        // dd($permissions);
        return view('backend.menu.permission', [
            'object' => 'menu',
            'menus' => $menus,
            'permissions' => $permissions
        ]);
    }


    public function updatePermission(Request $request)
    {
        try {
            // Delete the menu
            // echo 1; die;
            $this->menuService->updatePermission($request);

            return redirect()->back()->with('success', 'Menu Permission update successfully');
        } catch (\Exception $e) {
            // Return a JSON response if there is an error
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}