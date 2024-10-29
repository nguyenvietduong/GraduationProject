<?php

namespace App\Repositories;

use App\Models\Blog;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Interfaces\Repositories\BlogRepositoryInterface;

class BlogRepositoryEloquent extends BaseRepository implements BlogRepositoryInterface
{
    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return Blog::class;
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
    public function getAllBlogs(array $filters = [], $perPage = 5)
    {
        $query = $this->model->query();

        // Apply search filters
        if (!empty($filters['search'])) {
            $query->where(function ($q) use ($filters) {
                $q->where('title', 'like', '%' . $filters['search'] . '%');
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

        // Sort by creation date (latest first)
        $query->orderBy('id', 'desc');

        // Paginate results
        return $query->paginate($perPage);
    }

    /**
     * Get Blog detail by ID.
     *
     * @param int $id
     * @return \App\Models\Blog
     */
    public function getBlogDetail($id)
    {
        return $this->find($id);
    }

    /**
     * Update an Blog by ID.
     *
     * @param int $id
     * @param array $params
     * @return bool
     */
    public function updateBlog($id, $params)
    {
        return $this->update($params, $id);
    }

    /**
     * Create a new Blog.
     *
     * @param array $params
     * @return \App\Models\Blog
     */
    public function createBlog($params)
    {
        return $this->create($params);
    }

    /**
     * Get Blog detail by ID (same as getBlogDetail).
     *
     * @param int $id
     * @return \App\Models\Blog
     */
    public function detailBlog($id)
    {
        return $this->find($id);
    }

    /**
     * Delete an Blog by ID.
     *
     * @param int $id
     * @return bool|null
     * @throws \Exception
     */
    public function deleteBlog($id)
    {
        return $this->delete($id);
    }
}
