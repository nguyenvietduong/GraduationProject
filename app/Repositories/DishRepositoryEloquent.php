<?php

namespace App\Repositories;

use App\Models\Reservation;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Interfaces\Repositories\DishRepositoryInterface;

class DishRepositoryEloquent extends BaseRepository implements DishRepositoryInterface
{
    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return Reservation::class;
    }

}
