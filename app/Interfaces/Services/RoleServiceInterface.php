<?php

namespace App\Interfaces\Services;

interface RoleServiceInterface
{
    /**
     * Get a paginated list of Reviews with optional filters.
     *
     * @param array $filters
     * @param int $perPage
     * @param string $role
     * @return mixed
     */
    public function getAllRoles(array $filters = [], int $perPage = 15);

    /**
     * Get details of a Role by ID.
     *
     * @param int $id
     * @return mixed
     */
    public function getRoleDetail(int $id);

    /**
     * Create a new Role.
     *
     * @param array $data
     * @return mixed
     */
    public function createRole(array $data);

    /**
     * Update a Role by ID.
     *
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function updateRole(int $id, array $data);

    /**
     * Delete a Role by ID.
     *
     * @param int $id
     * @return bool
     */
    public function deleteRole(int $id);
    public function updatePermission($request);

}
