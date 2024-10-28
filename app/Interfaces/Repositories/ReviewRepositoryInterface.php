<?php

namespace App\Interfaces\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

interface ReviewRepositoryInterface extends RepositoryInterface
{
    /**
     * Get a paginated list of Reviews with optional search functionality.
     *
     * @param array $filters
     * @param int $perPage
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getAllReviews(array $filters = [], $perPage = 5);

    /**
     * Get details of a Reviews by ID.
     *
     * @param int $id
     * @return mixed
     */
    public function getReviewDetail(int $id);

    /**
     * Update a Reviews by ID with new data.
     *
     * @param int $id
     * @param array $params
     * @return mixed
     */
    public function updateReview(int $id, array $params);

    /**
     * Create a new Reviews with data.
     *
     * @param array $params
     * @return mixed
     */
    public function createReview(array $params);

    /**
     * Get details of a Reviews by ID. (Possibly duplicates the `getReviewDetail` method)
     *
     * @param int $id
     * @return mixed
     */
    public function detailReview(int $id);

    /**
     * Delete a Reviews by ID.
     *
     * @param int $id
     * @return bool
     */
    public function deleteReview(int $id);

    public function countNewReviews();
}
