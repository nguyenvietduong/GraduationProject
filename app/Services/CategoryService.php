<?php

namespace App\Services;

use App\Interfaces\Repositories\CategoryRepositoryInterface;
use App\Interfaces\Services\CategoryServiceInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Hash;
use Exception;

class CategoryService extends BaseService implements CategoryServiceInterface
{
    protected $categoryRepository;

    /**
     * Tạo mới instance của CategoryService.
     *
     * @param CategoryRepositoryInterface $categoryRepository
     */
    public function __construct(
        CategoryRepositoryInterface $categoryRepository,
    ) {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Get a paginated list of Categorys with optional filters.
     *
     * @param array $filters
     * @param int $perPage
     * @return mixed
     * @throws Exception
     */
    public function getAllCategories(array $filters = [], int $perPage = 5)
    {
        try {
            // Retrieve Categorys from the repository using filters and pagination
            return $this->categoryRepository->getAllCategories($filters, $perPage);
        } catch (Exception $e) {
            // Handle any exceptions that occur while retrieving Categorys
            throw new Exception('Unable to retrieve category list: ' . $e->getMessage());
        }
    }

    /**
     * Lấy chi tiết của Category theo ID.
     *
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function getCategoryDetail(int $id)
    {
        try {
            return $this->categoryRepository->getCategoryDetail($id);
        } catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException('Category không tồn tại với ID: ' . $id);
        } catch (Exception $e) {
            // Xử lý lỗi khác nếu cần thiết
            throw new Exception('Không thể lấy chi tiết Category: ' . $e->getMessage());
        }
    }

    /**
     * Tạo mới một Category.
     *
     * @param array $data
     * @return mixed
     */
    public function createCategory(array $data)
    {
        try {
            // Create the Category
            $data['guard_name'] = 'web';

            return $this->categoryRepository->createCategory($data);
        } catch (Exception $e) {
            // Handle any errors that occur during Category creation
            throw new Exception('Unable to create Category: ' . $e->getMessage());
        }
    }

    /**
     * Cập nhật một Category theo ID.
     *
     * @param int $id
     * @param array $data
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function updateCategory(int $id, array $data)
    {
        try {
            $data['guard_name'] = 'web';

            return $this->categoryRepository->updateCategory($id, $data);
        } catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException('Category không tồn tại với ID: ' . $id);
        } catch (Exception $e) {
            // Xử lý lỗi khác nếu cần thiết
            throw new Exception('Không thể cập nhật Category: ' . $e->getMessage());
        }
    }

    /**
     * Xóa một Category theo ID.
     *
     * @param int $id
     * @return bool
     * @throws ModelNotFoundException
     */
    public function deleteCategory(int $id)
    {
        try {
            return $this->categoryRepository->deleteCategory($id);
        } catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException('Category không tồn tại với ID: ' . $id);
        } catch (Exception $e) {
            // Xử lý lỗi khác nếu cần thiết
            throw new Exception('Không thể xóa Category: ' . $e->getMessage());
        }
    }

}
