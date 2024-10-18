<?php

namespace App\Interfaces\Services;

interface BlogServiceInterface
{
    /**
     * Get a paginated list of Reviews with optional filters.
     *
     * @param array $filters
     * @param int $perPage
     * @param string $blog
     * @return mixed
     */
    public function getAllBlogs(array $filters = [], int $perPage = 15);

    /**
     * Get details of a Blog by ID.
     *
     * @param int $id
     * @return mixed
     */
    public function getBlogDetail(int $id);

    /**
     * Create a new Blog.
     *
     * @param array $data
     * @return mixed
     */
    public function createBlog(array $data);

    /**
     * Update a Blog by ID.
     *
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function updateBlog(int $id, array $data);

    /**
     * Delete a Blog by ID.
     *
     * @param int $id
     * @return bool
     */
    public function deleteBlog(int $id);
}
