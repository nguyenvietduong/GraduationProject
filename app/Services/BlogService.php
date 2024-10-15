<?php

namespace App\Services;

use App\Interfaces\Repositories\BlogRepositoryInterface;
use App\Interfaces\Services\BlogServiceInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Hash;
use Exception;

class BlogService extends BaseService implements BlogServiceInterface
{
    protected $blogRepository;

    /**
     * Tạo mới instance của BlogService.
     *
     * @param BlogRepositoryInterface $blogRepository
     */
    public function __construct(
        BlogRepositoryInterface $blogRepository,
    ) {
        $this->blogRepository = $blogRepository;
    }

    /**
     * Get a paginated list of blogs with optional filters.
     *
     * @param array $filters
     * @param int $perPage
     * @return mixed
     * @throws Exception
     */
    public function getAllBlogs(array $filters = [], int $perPage = 5)
    {
        try {
            // Retrieve blogs from the repository using filters and pagination
            return $this->blogRepository->getAllBlogs($filters, $perPage);
        } catch (Exception $e) {
            // Handle any exceptions that occur while retrieving blogs
            throw new Exception('Unable to retrieve blog list: ' . $e->getMessage());
        }
    }

    /**
     * Lấy chi tiết của blog theo ID.
     *
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function getBlogDetail(int $id)
    {
        try {
            return $this->blogRepository->getBlogDetail($id);
        } catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException('Blog không tồn tại với ID: ' . $id);
        } catch (Exception $e) {
            // Xử lý lỗi khác nếu cần thiết
            throw new Exception('Không thể lấy chi tiết blog: ' . $e->getMessage());
        }
    }

    /**
     * Tạo mới một blog.
     *
     * @param array $data
     * @return mixed
     */
    public function createBlog(array $data)
    {
        try {
            // Create the blog
            $data['guard_name'] = 'web';

            return $this->blogRepository->createBlog($data);
        } catch (Exception $e) {
            // Handle any errors that occur during blog creation
            throw new Exception('Unable to create blog: ' . $e->getMessage());
        }
    }

    /**
     * Cập nhật một blog theo ID.
     *
     * @param int $id
     * @param array $data
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function updateBlog(int $id, array $data)
    {
        try {
            $data['guard_name'] = 'web';

            return $this->blogRepository->updateBlog($id, $data);
        } catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException('Blog không tồn tại với ID: ' . $id);
        } catch (Exception $e) {
            // Xử lý lỗi khác nếu cần thiết
            throw new Exception('Không thể cập nhật blog: ' . $e->getMessage());
        }
    }

    /**
     * Xóa một blog theo ID.
     *
     * @param int $id
     * @return bool
     * @throws ModelNotFoundException
     */
    public function deleteBlog(int $id)
    {
        try {
            return $this->blogRepository->deleteBlog($id);
        } catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException('Blog không tồn tại với ID: ' . $id);
        } catch (Exception $e) {
            // Xử lý lỗi khác nếu cần thiết
            throw new Exception('Không thể xóa blog: ' . $e->getMessage());
        }
    }



    public function updatePermission($request)
    {
        try {
            $permissions = $request->input('permission');
            // dd($permissions);
            if (count($permissions)) {
                foreach ($permissions as $key => $val) {
                    $blog = $this->blogRepository->getBlogDetail($key);
                    $blog->permissions()->detach();
                    $blog->permissions()->sync($val);
                }
            }
            // return $this->blogRepository->updateBlog($id, $data);
        } catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException('');
        } catch (Exception $e) {
            // Xử lý lỗi khác nếu cần thiết
            throw new Exception('Không thể cập nhật phân quyền: ' . $e->getMessage());
        }
    }

}
