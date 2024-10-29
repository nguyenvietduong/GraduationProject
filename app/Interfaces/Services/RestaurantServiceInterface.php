<?php 

namespace App\Interfaces\Services;

interface RestaurantServiceInterface
{
    /**
     * Get a paginated list of Reviews with optional filters.
     *
     * @param array $filters
     * @param int $perPage
     * @param string $role
     * @return mixed
     */
    public function getAllRestaurant(array $filters = [], int $perPage = 5);

    /**
     * Get account details by ID.
     *
     * @param int $id
     * @return mixed
     */
    public function getRestaurantDetail(int $id);

    /**
     * Update an restaurant by ID
     * 
     *  @param int $id 
     *  @param array $data
     *  @return mixed
     * 
     */
    public function updateRestaurant(int $id, array $data);
}