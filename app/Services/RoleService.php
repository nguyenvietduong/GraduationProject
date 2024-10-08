<?php

namespace App\Services;

use App\Interfaces\Repositories\RoleRepositoryInterface;
use App\Interfaces\Services\RoleServiceInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Hash;
use Exception;

class RoleService extends BaseService implements RoleServiceInterface
{
    protected $roleRepository;

    /**
     * Tạo mới instance của RoleService.
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
     * Lấy chi tiết của role theo ID.
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
            throw new ModelNotFoundException('Role không tồn tại với ID: ' . $id);
        } catch (Exception $e) {
            // Xử lý lỗi khác nếu cần thiết
            throw new Exception('Không thể lấy chi tiết role: ' . $e->getMessage());
        }
    }

    /**
     * Tạo mới một role.
     *
     * @param array $data
     * @return mixed
     */
    public function createRole(array $data)
    {
        try {
            // Create the role
            $data['guard_name'] = 'web';

            return $this->roleRepository->createRole($data);
        } catch (Exception $e) {
            // Handle any errors that occur during role creation
            throw new Exception('Unable to create role: ' . $e->getMessage());
        }
    }

    /**
     * Cập nhật một role theo ID.
     *
     * @param int $id
     * @param array $data
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function updateRole(int $id, array $data)
    {
        try {
            $data['guard_name'] = 'web';

            return $this->roleRepository->updateRole($id, $data);
        } catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException('Role không tồn tại với ID: ' . $id);
        } catch (Exception $e) {
            // Xử lý lỗi khác nếu cần thiết
            throw new Exception('Không thể cập nhật role: ' . $e->getMessage());
        }
    }

    /**
     * Xóa một role theo ID.
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
            throw new ModelNotFoundException('Role không tồn tại với ID: ' . $id);
        } catch (Exception $e) {
            // Xử lý lỗi khác nếu cần thiết
            throw new Exception('Không thể xóa role: ' . $e->getMessage());
        }
    }



    public function updatePermission($request)
    {
        try {
            $permissions = $request->input('permission');
            // dd($permissions);
            if (count($permissions)) {
                foreach ($permissions as $key => $val) {
                    $role = $this->roleRepository->getRoleDetail($key);
                    $role->permissions()->detach();
                    $role->permissions()->sync($val);
                }
            }
            // return $this->roleRepository->updateRole($id, $data);
        } catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException('');
        } catch (Exception $e) {
            // Xử lý lỗi khác nếu cần thiết
            throw new Exception('Không thể cập nhật phân quyền: ' . $e->getMessage());
        }
    }

}
