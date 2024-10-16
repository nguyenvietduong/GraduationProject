<?php

namespace App\Interfaces\Services;

interface MenuServiceInterface
{
    /**
     * Get a paginated list of Menus with optional filters.
     *
     * @param array $filters
     * @param int $perPage
     * @return mixed
     */
    public function getAllMenus(array $filters = [], int $perPage = 15);

    /**
     * Get the details of a Menu by ID.
     *
     * @param int $id
     * @return mixed
     */
    public function getMenuDetail(int $id);

    /**
     * Create a new Menu.
     *
     * @param array $data
     * @return mixed
     */
    public function createMenu(array $data);

    /**
     * Update a Menu by ID.
     *
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function updateMenu(int $id, array $data);

    /**
     * Delete a Menu by ID.
     *
     * @param int $id
     * @return bool
     */
    public function deleteMenu(int $id);
}