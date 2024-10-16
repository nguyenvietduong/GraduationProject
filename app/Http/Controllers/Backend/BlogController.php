<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\Backend\BlogDataTable;
use App\Http\Controllers\Controller;
use App\Interfaces\Repositories\PermissionRepositoryInterface as PermissionRepository;
use App\Interfaces\Services\BlogServiceInterface;
use App\Interfaces\Repositories\BlogRepositoryInterface;
use App\Traits\HandleExceptionTrait;

// Requests
use App\Http\Requests\BackEnd\Blogs\ListRequest as BlogListRequest;
use App\Http\Requests\BackEnd\Blogs\StoreRequest as BlogStoreRequest;
use App\Http\Requests\BackEnd\Blogs\UpdateRequest as BlogUpdateRequest;

class BlogController extends Controller
{
    use HandleExceptionTrait;

    protected $blogService;
    protected $blogRepository;

    protected $permissionRepository;

    // Base path for views
    const PATH_VIEW = 'backend.blog.';
    const PER_PAGE_DEFAULT = 5;
    const OBJECT = 'blog';

    public function __construct(
        BlogServiceInterface $blogService,
        BlogRepositoryInterface $blogRepository,
        PermissionRepository $permissionRepository,
    ) {
        $this->blogService = $blogService;
        $this->blogRepository = $blogRepository;
        $this->permissionRepository = $permissionRepository;
    }

    /**
     * Display the list of blogs.
     *
     * @param BlogListRequest $request
     * @return \Illuminate\View\View
     */
    public function index(BlogListRequest $request)
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
        // Retrieve the details of the blog
        $blog = $this->blogService->getBlogDetail($id);
        if ($blog) {
            return view(self::PATH_VIEW . __FUNCTION__, [
                'blogData' => $blog,
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
        // Validate the data from the request using BlogUpdateRequest
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
