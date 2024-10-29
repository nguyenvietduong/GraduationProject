<?php

namespace App\Http\Controllers\Backend\Category;

use App\Events\NotificationEvent;
use App\Http\Controllers\Controller;
use App\Interfaces\Services\CategoryServiceInterface;
use App\Interfaces\Repositories\CategoryRepositoryInterface;
use App\Interfaces\Services\NotificationServiceInterface;
use App\Traits\HandleExceptionTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
// Requests
use App\Http\Requests\BackEnd\Categories\ListRequest as CategoryListRequest;
use App\Http\Requests\BackEnd\Categories\StoreRequest as CategoryStoreRequest;
use App\Http\Requests\BackEnd\Categories\UpdateRequest as CategoryUpdateRequest;

class CategoryController extends Controller
{
    use HandleExceptionTrait;

    protected $categoryService;
    protected $categoryRepository;
    private $notificationService;
    // Base path for views
    const PATH_VIEW        = 'backend.category.';
    const PER_PAGE_DEFAULT = 5;
    const OBJECT           = 'category';

    public function __construct(
        CategoryServiceInterface $categoryService,
        CategoryRepositoryInterface $categoryRepository,
        NotificationServiceInterface $notificationService,
    ) {
        $this->categoryService    = $categoryService;
        $this->categoryRepository = $categoryRepository;
        $this->notificationService = $notificationService;
    }

    /**
     * Display the list of Categorys.
     *
     * @param CategoryListRequest $request
     * @return \Illuminate\View\View
     */
    public function index(CategoryListRequest $request)
    {
        // $this->authorize('modules', '' . self::OBJECT . '.index');
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
        // $this->authorize('modules', 'edit accounts');
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
        // Retrieve the details of the Category
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
            // // Gửi thông báo chung
            // $title = 'Category';
            // $message = 'edited category!';

            // Log::info('Starting update process for category ID: ' . $id); // Log thông tin

            // event(new NotificationEvent($title, $message, 'info', Auth::user()->full_name));
            // // dispatch(new SendNotificationJob($title, $message, 'info', Auth::user()->full_name)); // Thay thế 'info' và $review nếu cần

            // $dataNotification = [
            //     'user_id' => Auth::user()->id,  // ID của người gửi thông báo
            //     'title' => $title,
            //     'message' => $message,
            // ];

            // Log::info('Preparing notification data: ', $dataNotification); // Log thông tin

            // $this->notificationService->createNotification($dataNotification);

            // // Cập nhật danh mục
            // Log::info('Updating category with data: ', $data); // Log thông tin
            // Update the Category
            $this->categoryService->updateCategory($id, $data);

            // Log::info('Category updated successfully for ID: ' . $id); // Log khi thành công

            return redirect()->route('admin.category.index')->with('success', 'Category updated successfully');
        } catch (\Exception $e) {
            // Log::error('Error updating category: ' . $e->getMessage()); // Ghi log chi tiết lỗi
            // Log::error('Exception trace: ', ['trace' => $e->getTraceAsString()]); // Log thêm trace để chi tiết hơn về lỗi
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
