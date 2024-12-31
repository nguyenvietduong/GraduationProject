<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Interfaces\Services\TempImageServiceInterface;
use App\Interfaces\Repositories\PermissionRepositoryInterface as PermissionRepository;
use App\Interfaces\Services\BlogServiceInterface;
use App\Interfaces\Services\NotificationServiceInterface;
use App\Events\NotificationEvent;
use App\Interfaces\Repositories\BlogRepositoryInterface;
use App\Traits\HandleExceptionTrait;
use Illuminate\Support\Facades\Log;

// Requests
use App\Http\Requests\BackEnd\Blogs\ListRequest as BlogListRequest;
use App\Http\Requests\BackEnd\Blogs\StoreRequest as BlogStoreRequest;
use App\Http\Requests\BackEnd\Blogs\UpdateRequest as BlogUpdateRequest;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    use HandleExceptionTrait;

    protected $blogService;
    protected $blogRepository;
    protected $tempImageService;
    protected $permissionRepository;
    private $notificationService;

    // Base path for views
    const PATH_VIEW = 'backend.blog.';
    const PER_PAGE_DEFAULT = 5;
    const OBJECT = 'blog';

    public function __construct(
        TempImageServiceInterface $tempImageService,
        BlogServiceInterface $blogService,
        BlogRepositoryInterface $blogRepository,
        PermissionRepository $permissionRepository,
        NotificationServiceInterface $notificationService,
    ) {
        $this->tempImageService = $tempImageService;
        $this->blogService = $blogService;
        $this->blogRepository = $blogRepository;
        $this->permissionRepository = $permissionRepository;
        $this->notificationService = $notificationService;
    }

    /**
     * Display the list of blogs.
     *
     * @param BlogListRequest $request
     * @return \Illuminate\View\View
     */
    public function index(BlogListRequest $request)
    {
        $this->authorize('modules', '' . self::OBJECT . '.index');
        $this->tempImageService->deleteTempImagesForUser();
        session()->forget('image_blog_temp'); // Clear temporary image value
        // Validate the request data
        $request->validated();

        // Extract filters from the request
        $params = $request->all();

        // Apply filters from the request
        $filters = [
            'search' => $params['keyword'] ?? '', // Ensure this matches the search input name
            'start_date' => $params['start_date'] ?? '',
            'end_date' => $params['end_date'] ?? '',
            'status' => $params['status'] ?? '',
        ];

        // Get the per_page value
        $perPage = $params['per_page'] ?? self::PER_PAGE_DEFAULT;

        return view(self::PATH_VIEW . __FUNCTION__, [
            'object' => self::OBJECT,
            'blogTotalRecords' => $this->blogRepository->count(), // Total records for display
            'blogDatas' => $this->blogService->getAllBlogs($filters, $perPage, self::OBJECT), // Paginated blog list for the view
        ]);
    }

    /**
     * Show the form for creating a new blog.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $this->authorize('modules', '' . self::OBJECT . '.create');

        return view(self::PATH_VIEW . __FUNCTION__, [
            'object' => 'blog',
        ]);
    }

    /**
     * Handle the storage of a new blog.
     *
     * @param BlogStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(BlogStoreRequest $request)
    {
        // Validate the data from the request using BlogStoreRequest
        $data = $request->validated();
        try {
            // Create a new blog
            $this->blogService->createBlog($data);

            if (session('image_blog_temp') != null) {
                session()->forget('image_blog_temp');        
            }

            return redirect()->back()->with('success', 'Blog created successfully');
        } catch (\Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Show the form for editing a blog.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $this->authorize('modules', '' . self::OBJECT . '.edit');
        // Retrieve the details of the blog
        $blog = $this->blogService->getBlogDetail($id);
        if ($blog) {

            return view(self::PATH_VIEW . __FUNCTION__, [
                'data' => $blog,
                'object' => 'blog',
            ]);
        }

        abort(404);
    }

    /**
     * Handle the update of a blog.
     *
     * @param int $id
     * @param BlogUpdateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, BlogUpdateRequest $request)
    {
        $data = $request->validated();

        try {
            // Update the blog
            $this->blogService->updateBlog($id, $data);

            return redirect()->route('admin.blog.index')->with('success', 'Blog updated successfully');
        } catch (\Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Delete a blog.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        try {
            // Delete the blog
            $this->blogService->deleteBlog($id);

            return redirect()->back()->with('success', 'Blog deleted successfully');
        } catch (\Exception $e) {
            // Return a JSON response if there is an error

            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
