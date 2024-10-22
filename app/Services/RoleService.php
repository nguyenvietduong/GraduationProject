<?php

namespace App\Services;

use App\Interfaces\Repositories\RoleRepositoryInterface;
use App\Interfaces\Services\RoleServiceInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;

class RoleService extends BaseService implements RoleServiceInterface
{
    protected $roleRepository;

    /**
     * Create a new instance of RoleService.
     *
     * @param RoleRepositoryInterface $roleRepository
     */
    public function __construct(
        RoleRepositoryInterface $roleRepository,
    ) {
        $this->roleRepository = $roleRepository;
    }

    /**
     * Get a paginated list of roles with optional filters.
     *
     * @param array $filters
     * @param int $perPage
     * @return mixed
     * @throws Exception
     */
    public function getAllRoles(array $filters = [], int $perPage = 5)
    {
        try {
            // Retrieve roles from the repository using filters and pagination
            return $this->roleRepository->getAllRoles($filters, $perPage);
        } catch (Exception $e) {
            // Handle any exceptions that occur while retrieving roles
            throw new Exception('Unable to retrieve role list: ' . $e->getMessage());
        }
    }

    /**
     * Get the details of a role by its ID.
     *
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function getRoleDetail(int $id)
    {
        try {
            return $this->roleRepository->getRoleDetail($id);
        } catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException('Role does not exist with ID: ' . $id);
        } catch (Exception $e) {
            // Handle other errors if necessary
            throw new Exception('Unable to retrieve role details: ' . $e->getMessage());
        }
    }

    /**
     * Create a new role.
     *
     * @param array $data
     * @return mixed
     */
    public function createRole(array $data)
    {
        try {
            // Create the role
            return $this->roleRepository->createRole($data);
        } catch (Exception $e) {
            // Handle any errors that occur during role creation
            throw new Exception('Unable to create role: ' . $e->getMessage());
        }
    }

    /**
     * Update a role by its ID.
     *
     * @param int $id
     * @param array $data
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function updateRole(int $id, array $data)
    {
        try {
            return $this->roleRepository->updateRole($id, $data);
        } catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException('Role does not exist with ID: ' . $id);
        } catch (Exception $e) {
            // Handle other errors if necessary
            throw new Exception('Unable to update role: ' . $e->getMessage());
        }
    }

    /**
     * Delete a role by its ID.
     *
     * @param int $id
     * @return bool
     * @throws ModelNotFoundException
     */
    public function deleteRole(int $id)
    {
        try {
            return $this->roleRepository->deleteRole($id);
        } catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException('Role does not exist with ID: ' . $id);
        } catch (Exception $e) {
            // Handle other errors if necessary
            throw new Exception('Unable to delete role: ' . $e->getMessage());
        }
    }

    /**
     * Update permissions for roles based on the request input.
     *
     * @param $request
     * @throws ModelNotFoundException
     * @throws Exception
     */
    public function updatePermission($request)
    {
        try {
            $permissions = $request->input('permission');

            if (count($permissions)) {
                foreach ($permissions as $key => $val) {
                    $role = $this->roleRepository->getRoleDetail($key);
                    $role->permissions()->detach(); // Detach existing permissions
                    $role->permissions()->sync($val); // Sync new permissions
                }
            }
        } catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException('Role does not exist.');
        } catch (Exception $e) {
            // Handle other errors if necessary
            throw new Exception('Unable to update permissions: ' . $e->getMessage());
        }
    }
}
