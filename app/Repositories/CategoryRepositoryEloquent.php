<?php

namespace App\Repositories;

use App\Models\Category;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Interfaces\Repositories\CategoryRepositoryInterface;

class CategoryRepositoryEloquent extends BaseRepository implements CategoryRepositoryInterface
{
    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return Category::class;
    }

    /**
     * Apply criteria in current Query Repository.
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * Get a paginated list of Categorys with optional search functionality.
     *
     * @param array $filters
     * @param int $perPage
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getAllCategories(array $filters = [], $perPage = 5)
    {
        $query = $this->model->query();

        // Apply search filters
        if (!empty($filters['search'])) {
            $query->where(function ($q) use ($filters) {
                $q->where('name', 'like', '%' . $filters['search'] . '%');
            });
        }

        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        if (!empty($filters['start_date'])) {
            $query->whereDate('created_at', '>=', $filters['start_date']);
        }

        if (!empty($filters['end_date'])) {
            $query->whereDate('created_at', '<=', $filters['end_date']);
        }

        // Sort by creation date (latest first)
        $query->orderByRaw("FIELD(status, 'active', 'inactive')");
        // Order by created date (newest first)
        $query->orderBy('id', 'desc');
        // Paginate results
        return $query->paginate($perPage);
    }

    /**
     * Get Category detail by ID.
     *
     * @param int $id
     * @return \App\Models\Category
     */
    public function getCategoryDetail($id)
    {
        return $this->find($id);
    }

    /**
     * Update an Category by ID.
     *
     * @param int $id
     * @param array $params
     * @return bool
     */
    public function updateCategory($id, $params)
    {
        return $this->update($params, $id);
    }

    /**
     * Create a new Category.
     *
     * @param array $params
     * @return \App\Models\Category
     */
    public function createCategory($params)
    {
        return $this->create($params);
    }

    /**
     * Get Category detail by ID (same as getCategoryDetail).
     *
     * @param int $id
     * @return \App\Models\Category
     */
    public function detailCategory($id)
    {
        return $this->find($id);
    }

    /**
     * Delete an Category by ID.
     *
     * @param int $id
     * @return bool|null
     * @throws \Exception
     */
    public function deleteCategory($id)
    {
        return $this->delete($id);
    }
}
