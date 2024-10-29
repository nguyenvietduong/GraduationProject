<?php

namespace App\Interfaces\Services;

interface ReviewServiceInterface
{
    /**
     * Get a paginated list of Reviews with optional filters.
     *
     * @param array $filters
     * @param int $perPage
     * @param string $review
     * @return mixed
     */
    public function getAllReviews(array $filters = [], int $perPage = 15);

    /**
     * Get details of a Reviews by ID.
     *
     * @param int $id
     * @return mixed
     */
    public function getReviewDetail(int $id);

    /**
     * Create a new Reviews.
     *
     * @param array $data
     * @return mixed
     */
    public function createReview(array $data);

    /**
     * Update a Reviews by ID.
     *
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function updateReview(int $id, array $data);

    /**
     * Delete a Reviews by ID.
     *
     * @param int $id
     * @return bool
     */
    public function deleteReview(int $id);

    public function countNewReviews();
}
