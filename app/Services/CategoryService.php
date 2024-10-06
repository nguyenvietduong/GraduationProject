<?php

namespace App\Services;

use App\Interfaces\Repositories\CategoryRepositoryInterface;
use App\Interfaces\Services\CategoryServiceInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;

class CategoryService extends BaseService implements CategoryServiceInterface
{
    protected $categoryRepository;

    /**
     * Create a new instance of CategoryService.
     *
     * @param CategoryRepositoryInterface $categoryRepository
     */
    public function __construct(
        CategoryRepositoryInterface $categoryRepository,
    ) {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Get a paginated list of Categories with optional filters.
     *
     * @param array $filters
     * @param int $perPage
     * @return mixed
     * @throws Exception
     */
    public function getAllCategory(array $filters = [], int $perPage = 5)
    {
        try {
            // Retrieve Categories from the repository using filters and pagination
            return $this->categoryRepository->getAllCategory($filters, $perPage);
        } catch (Exception $e) {
            // Handle any exceptions that occur while retrieving Categories
            throw new Exception('Unable to retrieve Category list: ' . $e->getMessage());
        }
    }

    /**
     * Get the details of a category by ID.
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
            throw new ModelNotFoundException('Category not found with ID: ' . $id);
        } catch (Exception $e) {
            // Handle other errors if necessary
            throw new Exception('Unable to retrieve category details: ' . $e->getMessage());
        }
    }

    /**
     * Create a new category.
     *
     * @param array $data
     * @return mixed
     */

    public function createCategory(array $data)
    {
        try {
            return $this->categoryRepository->createCategory($data);
        } catch (\Exception $e) {
            throw new \Exception('Unable to create category: ' . $e->getMessage());
        }
    }

    /**
     * Update a category by ID.
     *
     * @param int $id
     * @param array $data
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function updateCategory(int $id, array $data)
    {
        try {
            return $this->categoryRepository->updateCategory($id, $data);
        } catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException('Category not found with ID: ' . $id);
        } catch (\Exception $e) {
            throw new \Exception('Unable to update category: ' . $e->getMessage());
        }
    }

    /**
     * Delete a category by ID.
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
            throw new ModelNotFoundException('Category not found with ID: ' . $id);
        } catch (Exception $e) {
            // Handle other errors if necessary
            throw new Exception('Unable to delete category: ' . $e->getMessage());
        }
    }
}
