<?php

namespace App\Services;

use App\Interfaces\Repositories\PermissionRepositoryInterface;
use App\Interfaces\Services\PermissionServiceInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;

class PermissionService extends BaseService implements PermissionServiceInterface
{
    protected $permissionRepository;

    /**
     * Tạo mới instance của PermissionService.
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
            throw new Exception('Unable to retrieve Permission list: ' . $e->getMessage());
        }
    }

    /**
     * Lấy chi tiết của permission theo ID.
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
            throw new ModelNotFoundException('Permission không tồn tại với ID: ' . $id);
        } catch (Exception $e) {
            // Xử lý lỗi khác nếu cần thiết
            throw new Exception('Không thể lấy chi tiết permission: ' . $e->getMessage());
        }
    }

    /**
     * Tạo mới một permission.
     *
     * @param array $data
     * @return mixed
     */
    public function createPermission(array $data)
    {
        try {
            // $data['guard_name'] = 'web';
            // echo 1; die;
            // dd($data);
            // Create the permission
            return $this->permissionRepository->createPermission($data);
        } catch (Exception $e) {
            echo $e->getMessage();
            die();
            // Handle any errors that occur during permission creation
            throw new Exception('Unable to create permission: ' . $e->getMessage());
        }
    }

    /**
     * Cập nhật một permission theo ID.
     *
     * @param int $id
     * @param array $data
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function updatePermission(int $id, array $data)
    {
        try {
            $data['guard_name'] = 'web';

            return $this->permissionRepository->updatePermission($id, $data);
        } catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException('Permission không tồn tại với ID: ' . $id);
        } catch (Exception $e) {
            // Xử lý lỗi khác nếu cần thiết
            throw new Exception('Không thể cập nhật permission: ' . $e->getMessage());
        }
    }

    /**
     * Xóa một permission theo ID.
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
            throw new ModelNotFoundException('Permission không tồn tại với ID: ' . $id);
        } catch (Exception $e) {
            // Xử lý lỗi khác nếu cần thiết
            echo $e->getMessage();
            die();
            throw new Exception('Không thể xóa permission: ' . $e->getMessage());
        }
    }
}
