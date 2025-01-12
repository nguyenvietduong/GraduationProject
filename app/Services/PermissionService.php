<?php

namespace App\Services;

use App\Interfaces\Repositories\PermissionRepositoryInterface;
use App\Interfaces\Services\PermissionServiceInterface;
use App\Models\Role;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;

class PermissionService extends BaseService implements PermissionServiceInterface
{
    protected $permissionRepository;

    /**
     * Create a new instance of PermissionService.
     *
     * @param PermissionRepositoryInterface $permissionRepository
     */
    public function __construct(
        PermissionRepositoryInterface $permissionRepository,
    ) {
        $this->permissionRepository = $permissionRepository;
    }

    /**
     * Get a paginated list of permissions with optional filters.
     *
     * @param array $filters
     * @param int $perPage
     * @return mixed
     * @throws Exception
     */
    public function getAllPermissions(array $filters = [], int $perPage = 5)
    {
        try {
            // Retrieve permissions from the repository using filters and pagination
            return $this->permissionRepository->getAllPermissions($filters, $perPage);
        } catch (Exception $e) {
            // Handle any exceptions that occur while retrieving permissions
            throw new Exception('Unable to retrieve permission list: ' . $e->getMessage());
        }
    }

    /**
     * Get the details of a permission by ID.
     *
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function getPermissionDetail(int $id)
    {
        try {
            return $this->permissionRepository->getPermissionDetail($id);
        } catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException('Permission does not exist with ID: ' . $id);
        } catch (Exception $e) {
            // Handle other errors if necessary
            throw new Exception('Unable to retrieve permission details: ' . $e->getMessage());
        }
    }

    /**
     * Create a new permission.
     *
     * @param array $data
     * @return mixed
     */
    public function createPermission(array $data)
    {
        try {

            $permission = $this->permissionRepository->createPermission($data);

            $role = Role::find(1);
            $role->permissions()->attach($permission->id);
        } catch (Exception $e) {
            // Handle any errors that occur during permission creation
            throw new Exception('Unable to create permission: ' . $e->getMessage());
        }
    }

    /**
     * Update a permission by ID.
     *
     * @param int $id
     * @param array $data
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function updatePermission(int $id, array $data)
    {
        try {
            return $this->permissionRepository->updatePermission($id, $data);
        } catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException('Permission does not exist with ID: ' . $id);
        } catch (Exception $e) {
            // Handle other errors if necessary
            throw new Exception('Unable to update permission: ' . $e->getMessage());
        }
    }

    /**
     * Delete a permission by ID.
     *
     * @param int $id
     * @return bool
     * @throws ModelNotFoundException
     */
    public function deletePermission(int $id)
    {
        try {
            return $this->permissionRepository->deletePermission($id);
        } catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException('Permission does not exist with ID: ' . $id);
        } catch (Exception $e) {
            // Handle other errors if necessary
            throw new Exception('Unable to delete permission: ' . $e->getMessage());
        }
    }
}
