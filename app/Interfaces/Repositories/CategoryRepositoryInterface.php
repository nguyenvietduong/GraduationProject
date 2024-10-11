<?php

namespace App\Interfaces\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

interface CategoryRepositoryInterface extends RepositoryInterface
{
    /**
     * Get a paginated list of Categories with optional search functionality.
     *
     * @param array $filters
     * @param int $perPage
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getAllCategories(array $filters = [], $perPage = 5);

    /**
     * Get details of a Category by ID.
     *
     * @param int $id
     * @return mixed
     */
    public function getCategoryDetail(int $id);

    /**
     * Update a Category by ID with new data.
     *
     * @param int $id
     * @param array $params
     * @return mixed
     */
    public function updateCategory(int $id, array $params);

    /**
     * Create a new Category with data.
     *
     * @param array $params
     * @return mixed
     */
    public function createCategory(array $params);

    /**
     * Get details of a Category by ID. (Possibly duplicates the `getCategoryDetail` method)
     *
     * @param int $id
     * @return mixed
     */
    public function detailCategory(int $id);

    /**
     * Delete a Category by ID.
     *
     * @param int $id
     * @return bool
     */
    public function deleteCategory(int $id);
}
