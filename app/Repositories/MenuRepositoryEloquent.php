<?php

namespace App\Repositories;

use App\Models\Menu;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Interfaces\Repositories\MenuRepositoryInterface;

class MenuRepositoryEloquent extends BaseRepository implements MenuRepositoryInterface
{
    /**
     * Specify the model class name.
     *
     * @return string
     */
    public function model()
    {
        return Menu::class;
    }

    /**
     * Apply criteria in the current Query Repository.
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
    /**
     * Get a paginated list of Menus with optional search functionality.
     *
     * @param array $filters
     * @param int $perPage
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getAllMenus(array $filters = [], $perPage = 5)
    {
        $query = $this->model->query();

        // Apply search filters
        if (!empty($filters['search'])) {
            $query->where(function ($q) use ($filters) {
                $q->where('name', 'like', '%' . $filters['search'] . '%');
            });
        }

        // Sort by creation date (latest first)
        $query->orderBy('created_at', 'desc');

        // Paginate results
        return $query->paginate($perPage);
    }

    /**
     * Get menu details by ID.
     *
     * @param int $id
     * @return \App\Models\Menu
     */
    public function getMenuDetail($id)
    {
        return $this->find($id);
    }

    /**
     * Update an menu by ID.
     *
     * @param int $id
     * @param array $params
     * @return bool
     */
    public function updateMenu($id, $params)
    {
        return $this->update($params, $id);
    }

    /**
     * Create a new menu.
     *
     * @param array $params
     * @return \App\Models\Menu
     */
    public function createMenu($params)
    {
        return $this->create($params);
    }

    /**
     * Get menu details by ID (same as getMenuDetail).
     *
     * @param int $id
     * @return \App\Models\Menu
     */
    public function detailMenu($id)
    {
        return $this->find($id);
    }

    /**
     * Delete an menu by ID.
     *
     * @param int $id
     * @return bool|null
     * @throws \Exception
     */
    public function deleteMenu($id)
    {
        return $this->delete($id);
    }
}
