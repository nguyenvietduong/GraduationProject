<?php 

namespace App\Interfaces\Repositories;

use prettus\Repository\Contracts\RepositoryInterface;

interface RestaurantRepositoryInterface extends RepositoryInterface

{
    /**
     * Get a paginated list of Reviews with optional search functionality.
     *
     * @param array $filters
     * @param int $perPage
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getAllRestaurant(array $filters = [], $perPage = 5);

    /**
     * Get restaurant details by ID.
     *
     * @param int $id
     * @return mixed
     */
    public function getRestaurantDetail(int $id);

    /**
     *  Update an restaurant by ID with new data.
     * 
     *  @param int $id
     *  @param array $params
     *  @return mixed
    */

    public function updateRestaurant(int $id, array $params);
}