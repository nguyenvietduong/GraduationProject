<?php

namespace App\Interfaces\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

interface PromotionRepositoryInterface extends RepositoryInterface
{
    /**
     * Get a paginated list of promotions with optional search functionality.
     *
     * @param array $filters
     * @param int $perPage
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getAllPromotions(array $filters = [], $perPage = 5);

    /**
     * Get details of a promotion by ID.
     *
     * @param int $id
     * @return mixed
     */
    public function getPromotionDetail(int $id);

    /**
     * Update a promotion by ID with new data.
     *
     * @param int $id
     * @param array $params
     * @return mixed
     */
    public function updatePromotion(int $id, array $params);

    /**
     * Create a new promotion with data.
     *
     * @param array $params
     * @return mixed
     */
    public function createPromotion(array $params);

    /**
     * Get details of a promotion by ID. (Possibly duplicates the `getpromotionDetail` method)
     *
     * @param int $id
     * @return mixed
     */
    public function detailPromotion(int $id);

    /**
     * Delete a promotion by ID.
     *
     * @param int $id
     * @return bool
     */
    public function deletePromotion(int $id);
}
