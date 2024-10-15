<?php

namespace App\Interfaces\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

interface BlogRepositoryInterface extends RepositoryInterface
{
    /**
     * Get a paginated list of Reviews with optional search functionality.
     *
     * @param array $filters
     * @param int $perPage
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getAllBlogs(array $filters = [], $perPage = 5);

    /**
     * Get details of a Blog by ID.
     *
     * @param int $id
     * @return mixed
     */
    public function getBlogDetail(int $id);

    /**
     * Update a Blog by ID with new data.
     *
     * @param int $id
     * @param array $params
     * @return mixed
     */
    public function updateBlog(int $id, array $params);

    /**
     * Create a new Blog with data.
     *
     * @param array $params
     * @return mixed
     */
    public function createBlog(array $params);

    /**
     * Get details of a Blog by ID. (Possibly duplicates the `getBlogDetail` method)
     *
     * @param int $id
     * @return mixed
     */
    public function detailBlog(int $id);

    /**
     * Delete a Blog by ID.
     *
     * @param int $id
     * @return bool
     */
    public function deleteBlog(int $id);
}
