<?php 

namespace App\Repositories;

use App\Models\Restaurant;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Interfaces\Repositories\RestaurantRepositoryInterface;

class RestaurantRepositoryEloquent extends BaseRepository implements RestaurantRepositoryInterface

{
    protected $model;

     /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return Restaurant::class;
    }

    /**
     * Get a paginated list of Reviews with optional search functionality.
     *
     * @param array $filters
     * @param int $perPage
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */

     public function  getAllRestaurant(array $filters = [], $perPage = 5)

     {
        $query = $this->model->query();
        

        return  $query->paginate($perPage);

     }

      /**
     * Get account details by user ID.
     *
     * @param int $id
     * @return \App\Models\User|null
     */
    public function getRestaurantDetail(int $id)
    {
        return $this->find($id);
    }


    /**
     * Update an account by user ID.
     *
     * @param int $id
     * @param array $params
     * @return bool
     */
    public function  updateRestaurant(int $id, array $params)
    {
        return $this->update($params, $id);
    }

    







}