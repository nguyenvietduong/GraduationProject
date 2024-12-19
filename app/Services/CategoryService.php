<?php

namespace App\Services;

use App\Interfaces\Repositories\CategoryRepositoryInterface;
use App\Interfaces\Services\CategoryServiceInterface;
use App\Models\Category;
use App\Models\Menu;
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
     * Get a paginated list of categories with optional filters.
     *
     * @param array $filters
     * @param int $perPage
     * @return mixed
     * @throws Exception
     */
    public function getAllCategories(array $filters = [], int $perPage = 5)
    {
        try {
            // Retrieve categories from the repository using filters and pagination
            return $this->categoryRepository->getAllCategories($filters, $perPage);
        } catch (Exception $e) {
            // Handle any exceptions that occur while retrieving categories
            throw new Exception('Unable to retrieve category list: ' . $e->getMessage());
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
            throw new ModelNotFoundException('Category does not exist with ID: ' . $id);
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
            // Create the category
            $data['guard_name'] = 'web';

            return $this->categoryRepository->createCategory($data);
        } catch (Exception $e) {
            // Handle any errors that occur during category creation
            throw new Exception('Unable to create category: ' . $e->getMessage());
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
            $data['guard_name'] = 'web';
            return $this->categoryRepository->updateCategory($id, $data);
        } catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException('Category does not exist with ID: ' . $id);
        } catch (Exception $e) {
            // Handle other errors if necessary
            throw new Exception('Unable to update category: ' . $e->getMessage());
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
            $isDelete =  $this->categoryRepository->deleteCategory($id);
            if($isDelete){
                $category = Category::where('slug', 'chua-phan-loai')->first();
                Menu::where('category_id', $id)->update(['category_id' => $category->id]);
            }
            return $isDelete;
        } catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException('Category does not exist with ID: ' . $id);
        } catch (Exception $e) {
            // Handle other errors if necessary
            throw new Exception('Unable to delete category: ' . $e->getMessage());
        }
    }
}
