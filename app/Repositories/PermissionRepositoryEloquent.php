<?php

namespace App\Repositories;

use App\Models\Permission;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Interfaces\Repositories\PermissionRepositoryInterface;

class PermissionRepositoryEloquent extends BaseRepository implements PermissionRepositoryInterface
{
    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return Permission::class;
    }

    /**
     * Apply criteria in current Query Repository.
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * Get a paginated list of Permissions with optional search functionality.
     *
     * @param array $filters
     * @param int $perPage
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getAllPermissions(array $filters = [], $perPage = 5)
    {
        $query = $this->model->query();

        // Apply search filters
        if (!empty($filters['search'])) {
            $query->where(function ($q) use ($filters) {
                $q->where('name', 'like', '%' . $filters['search'] . '%');
            });
        }

        if (!empty($filters['start_date'])) {
            $query->whereDate('created_at', '>=', $filters['start_date']);
        }

        if (!empty($filters['end_date'])) {
            $query->whereDate('created_at', '<=', $filters['end_date']);
        }

        // Sort by creation date (latest first)
        $query->orderBy('id', 'desc');

        // Paginate results
        return $query->paginate($perPage);
    }

    /**
     * Get Permission detail by ID.
     *
     * @param int $id
     * @return App\Models\Permission
     */
    public function getPermissionDetail($id)
    {
        return $this->find($id);
    }

    /**
     * Update an Permission by ID.
     *
     * @param int $id
     * @param array $params
     * @return bool
     */
    public function updatePermission($id, $params)
    {
        return $this->update($params, $id);
    }

    /**
     * Create a new Permission.
     *
     * @param array $params
     * @return App\Models\Permission
     */
    public function createPermission($params)
    {
        // dd($params); die;
        return $this->create($params);
    }

    /**
     * Get Permission detail by ID (same as getPermissionDetail).
     *
     * @param int $id
     * @return App\Models\Permission
     */
    public function detailPermission($id)
    {
        return $this->find($id);
    }

    /**
     * Delete an Permission by ID.
     *
     * @param int $id
     * @return bool|null
     * @throws \Exception
     */
    public function deletePermission($id)
    {
        return $this->delete($id);
    }
}
