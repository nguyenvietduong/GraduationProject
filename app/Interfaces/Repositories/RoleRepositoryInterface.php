<?php

namespace App\Interfaces\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

interface RoleRepositoryInterface extends RepositoryInterface
{
    /**
     * Get a paginated list of Reviews with optional search functionality.
     *
     * @param array $filters
     * @param int $perPage
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getAllRoles(array $filters = [], $perPage = 5);

    /**
     * Get details of a Role by ID.
     *
     * @param int $id
     * @return mixed
     */
    public function getRoleDetail(int $id);

    /**
     * Update a Role by ID with new data.
     *
     * @param int $id
     * @param array $params
     * @return mixed
     */
    public function updateRole(int $id, array $params);

    /**
     * Create a new Role with data.
     *
     * @param array $params
     * @return mixed
     */
    public function createRole(array $params);

    /**
     * Get details of a Role by ID. (Possibly duplicates the `getRoleDetail` method)
     *
     * @param int $id
     * @return mixed
     */
    public function detailRole(int $id);

    /**
     * Delete a Role by ID.
     *
     * @param int $id
     * @return bool
     */
    public function deleteRole(int $id);
}
