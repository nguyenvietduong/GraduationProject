<?php

namespace App\Repositories;

use App\Models\Promotion;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Interfaces\Repositories\PromotionRepositoryInterface;

class PromotionRepositoryEloquent extends BaseRepository implements PromotionRepositoryInterface
{
    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return Promotion::class;
    }

    /**
     * Apply criteria in current Query Repository.
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * Get a paginated list of promotions with optional search functionality.
     *
     * @param array $filters
     * @param int $perPage
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getAllPromotions(array $filters = [], $perPage = 5)
    {
        $query = $this->model->query();

        // Apply search filters
        if (!empty($filters['search'])) {
            $query->where(function ($q) use ($filters) {
                $q->where('code', 'like', '%' . $filters['search'] . '%')
                    ->orWhere('title', 'like', '%' . $filters['search'] . '%')
                    ;
            });
        }

        if (!empty($filters['start_date'])) {
            $query->whereDate('start_date', '>=', $filters['start_date']);
        }

        if (!empty($filters['end_date'])) {
            $query->whereDate('end_date', '<=', $filters['end_date']);
        }

        if (!empty($filters['is_active'])) {
            $query->where('is_active', $filters['is_active']);
        }

        // Sort by creation date (latest first)
        $query->orderBy('id', 'desc');

        // Paginate results
        return $query->paginate($perPage);
    }

    /**
     * Get promotion detail by ID.
     *
     * @param int $id
     * @return App\Models\Promotion
     */
    public function getPromotionDetail($id)
    {
        return $this->find($id);
    }

    /**
     * Update an promotion by ID.
     *
     * @param int $id
     * @param array $params
     * @return bool
     */
    public function updatePromotion($id, $params)
    {
        return $this->update($params, $id);
    }

    /**
     * Create a new promotion.
     *
     * @param array $params
     * @return App\Models\Promotion
     */
    public function createPromotion($params)
    {
        // dd($params); die;
        return $this->create($params);
    }

    /**
     * Get promotion detail by ID (same as getpromotionDetail).
     *
     * @param int $id
     * @return App\Models\Promotion
     */
    public function detailPromotion($id)
    {
        return $this->find($id);
    }

    /**
     * Delete an promotion by ID.
     *
     * @param int $id
     * @return bool|null
     * @throws \Exception
     */
    public function deletePromotion($id)
    {
        return $this->delete($id);
    }
}
