<?php

namespace App\Interfaces\Services;

interface PermissionServiceInterface
{
    /**
     * Get a paginated list of Permissions with optional filters.
     *
     * @param array $filters
     * @param int $perPage
     * @param string $Permission
     * @return mixed
     */
    public function getAllPermissions(array $filters = [], int $perPage = 15);

    /**
     * Get details of a Permission by ID.
     *
     * @param int $id
     * @return mixed
     */
    public function getPermissionDetail(int $id);

    /**
     * Create a new Permission.
     *
     * @param array $data
     * @return mixed
     */
    public function createPermission(array $data);

    /**
     * Update a Permission by ID.
     *
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function updatePermission(int $id, array $data);

    /**
     * Delete a Permission by ID.
     *
     * @param int $id
     * @return bool
     */
    public function deletePermission(int $id);
}
