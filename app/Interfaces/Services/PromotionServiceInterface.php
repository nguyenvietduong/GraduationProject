<?php

namespace App\Interfaces\Services;

interface PromotionServiceInterface
{
    /**
     * Get a paginated list of Promotions with optional filters.
     *
     * @param array $filters
     * @param int $perPage
     * @param string $promotion
     * @return mixed
     */
    public function getAllPromotions(array $filters = [], int $perPage = 15);

    /**
     * Get details of a promotion by ID.
     *
     * @param int $id
     * @return mixed
     */
    public function getPromotionDetail(int $id);

    /**
     * Create a new promotion.
     *
     * @param array $data
     * @return mixed
     */
    public function createPromotion($request);

    /**
     * Update a promotion by ID.
     *
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function updatePromotion(int $id, $request);

    /**
     * Delete a promotion by ID.
     *
     * @param int $id
     * @return bool
     */
    public function deletePromotion(int $id);
}
