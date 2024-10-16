<?php

namespace App\Interfaces\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

interface MenuRepositoryInterface extends RepositoryInterface
{
    /**
     * Get a paginated list of Menus with optional search functionality.
     *
     * @param array $filters
     * @param int $perPage
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getAllMenus(array $filters = [], $perPage = 5);

    /**
     * Get menu details by ID.
     *
     * @param int $id
     * @return mixed
     */
    public function getMenuDetail(int $id);

    /**
     * Update an menu by ID with new data.
     *
     * @param int $id
     * @param array $params
     * @return mixed
     */
    public function updateMenu(int $id, array $params);

    /**
     * Create a new menu with the provided data.
     *
     * @param array $params
     * @return mixed
     */
    public function createMenu(array $params);

    /**
     * Get menu details by ID. (May duplicate `getMenuDetail` method)
     *
     * @param int $id
     * @return mixed
     */
    public function detailMenu(int $id);

    /**
     * Delete an menu by ID.
     *
     * @param int $id
     * @return bool
     */
    public function deleteMenu(int $id);
}