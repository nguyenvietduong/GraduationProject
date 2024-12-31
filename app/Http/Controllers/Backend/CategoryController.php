<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Interfaces\Services\CategoryServiceInterface;
use App\Interfaces\Repositories\CategoryRepositoryInterface;
use App\Interfaces\Services\NotificationServiceInterface;
use App\Traits\HandleExceptionTrait;
// Requests
use App\Http\Requests\BackEnd\Categories\ListRequest as CategoryListRequest;
use App\Http\Requests\BackEnd\Categories\StoreRequest as CategoryStoreRequest;
use App\Http\Requests\BackEnd\Categories\UpdateRequest as CategoryUpdateRequest;

class CategoryController extends Controller
{
    use HandleExceptionTrait;

    protected $categoryService;
    protected $categoryRepository;
    // Base path for views
    const PATH_VIEW        = 'backend.category.';
    const PER_PAGE_DEFAULT = 5;
    const OBJECT           = 'category';

    public function __construct(
        CategoryServiceInterface $categoryService,
        CategoryRepositoryInterface $categoryRepository,
    ) {
        $this->categoryService    = $categoryService;
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Display the list of Categorys.
     *
     * @param CategoryListRequest $request
     * @return \Illuminate\View\View
     */
    public function index(CategoryListRequest $request)
    {
        $this->authorize('modules', '' . self::OBJECT . '.index');
        session()->forget('image_temp'); // Clear temporary image value
        // Validate the request data
        $request->validated();

        // Extract filters from the request
        $params = $request->all();

        // Apply filters from the request
        $filters = [
            'search'     => $params['keyword'] ?? '', // Ensure this matches the search input name
            'start_date' => $params['start_date'] ?? '',
            'end_date'   => $params['end_date'] ?? '',
            'status' => $params['status'] ?? '',
        ];
        // Get the per_page value
        $perPage = $params['per_page'] ?? self::PER_PAGE_DEFAULT;

        return view(self::PATH_VIEW . __FUNCTION__, [
            'object'                => self::OBJECT,
            'categoryTotalRecords'  => $this->categoryRepository->count(), // Total records for display
            'categoryDatas'         => $this->categoryService->getAllCategories($filters, $perPage, self::OBJECT), // Paginated Category list for the view
        ]);
    }

    /**
     * Show the form for creating a new Category.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $this->authorize('modules', '' . self::OBJECT . '.create');
        return view(self::PATH_VIEW . __FUNCTION__, [
            'object' => 'category',
        ]);
    }

    /**
     * Handle the storage of a new Category.
     *
     * @param CategoryStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CategoryStoreRequest $request)
    {
        // Validate the data from the request using CategoryStoreRequest
        $data         = $request->validated();
        try {
            // Create a new Category
            $this->categoryService->createCategory($data);
            return redirect()->back()->with('success', 'Category created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Show the form for editing a Category.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $this->authorize('modules', '' . self::OBJECT . '.edit');
        $category = $this->categoryService->getCategoryDetail($id);
        if ($category) {
            return view(self::PATH_VIEW . __FUNCTION__, [
                'categoryData' => $category,
                'object'       => 'category',
            ]);
        }

        abort(404);
    }

    /**
     * Handle the update of a Category.
     *
     * @param int $id
     * @param CategoryUpdateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, CategoryUpdateRequest $request)
    {
        // Validate the data from the request using CategoryUpdateRequest
        $data = $request->validated();
        try {
            $this->categoryService->updateCategory($id, $data);
            return redirect()->route('admin.category.index')->with('success', 'Category updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Delete a Category.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        try {
            // Delete the Category
            $this->categoryService->deleteCategory($id);
            return redirect()->back()->with('success', 'Category deleted successfully');
        } catch (\Exception $e) {
            // Return a JSON response if there is an error
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
