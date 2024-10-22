<?php

namespace App\Interfaces\Services;

interface CategoryServiceInterface
{
    /**
     * Get a paginated list of Categorys with optional filters.
     *
     * @param array $filters
     * @param int $perPage
     * @param string $Category
     * @return mixed
     */
    public function getAllCategories(array $filters = [], int $perPage = 15);

    /**
     * Get details of a Category by ID.
     *
     * @param int $id
     * @return mixed
     */
    public function getCategoryDetail(int $id);

    /**
     * Create a new Category.
     *
     * @param array $data
     * @return mixed
     */
    public function createCategory(array $data);

    /**
     * Update a Category by ID.
     *
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function updateCategory(int $id, array $data);

    /**
     * Delete a Category by ID.
     *
     * @param int $id
     * @return bool
     */
    public function deleteCategory(int $id);

}
