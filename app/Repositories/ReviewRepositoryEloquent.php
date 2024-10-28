<?php

namespace App\Repositories;

use App\Models\Review;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Interfaces\Repositories\ReviewRepositoryInterface;

class ReviewRepositoryEloquent extends BaseRepository implements ReviewRepositoryInterface
{
    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return Review::class;
    }

    /**
     * Apply criteria in current Query Repository.
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * Get a paginated list of Reviews with optional search functionality.
     *
     * @param array $filters
     * @param int $perPage
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getAllReviews(array $filters = [], $perPage = 5)
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

        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        // Sort by status (pending first) and then by creation date (latest first)
        $query->orderByRaw("CASE WHEN status = 'pending' THEN 0 ELSE 1 END")
            ->orderBy('id', 'desc');

        // Paginate results
        return $query->paginate($perPage);
    }

    /**
     * Get Reviews detail by ID.
     *
     * @param int $id
     * @return \App\Models\Review
     */
    public function getReviewDetail($id)
    {
        return $this->find($id);
    }

    /**
     * Update an Reviews by ID.
     *
     * @param int $id
     * @param array $params
     * @return bool
     */
    public function updateReview($id, $params)
    {
        return $this->update($params, $id);
    }

    /**
     * Create a new Reviews.
     *
     * @param array $params
     * @return \App\Models\Review
     */
    public function createReview($params)
    {
        return $this->create($params);
    }

    /**
     * Get Reviews detail by ID (same as getReviewDetail).
     *
     * @param int $id
     * @return \App\Models\Review
     */
    public function detailReview($id)
    {
        return $this->find($id);
    }

    /**
     * Delete an Reviews by ID.
     *
     * @param int $id
     * @return bool|null
     * @throws \Exception
     */
    public function deleteReview($id)
    {
        return $this->delete($id);
    }

    public function countNewReviews(): int
    {
        $query = $this->model->query();

        return $query->where('status', 'pending')->count(); // Adjust based on your criteria
    }
}
