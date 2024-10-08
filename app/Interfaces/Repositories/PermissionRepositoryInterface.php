<?php

namespace App\Interfaces\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

interface PermissionRepositoryInterface extends RepositoryInterface
{
    /**
     * Get a paginated list of Permissions with optional search functionality.
     *
     * @param array $filters
     * @param int $perPage
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getAllPermissions(array $filters = [], $perPage = 5);

    /**
     * Get details of a Permission by ID.
     *
     * @param int $id
     * @return mixed
     */
    public function getPermissionDetail(int $id);

    /**
     * Update a Permission by ID with new data.
     *
     * @param int $id
     * @param array $params
     * @return mixed
     */
    public function updatePermission(int $id, array $params);

    /**
     * Create a new Permission with data.
     *
     * @param array $params
     * @return mixed
     */
    public function createPermission(array $params);

    /**
     * Get details of a Permission by ID. (Possibly duplicates the `getPermissionDetail` method)
     *
     * @param int $id
     * @return mixed
     */
    public function detailPermission(int $id);

    /**
     * Delete a Permission by ID.
     *
     * @param int $id
     * @return bool
     */
    public function deletePermission(int $id);
}
