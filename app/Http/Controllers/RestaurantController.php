<?php 

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Interfaces\Repositories\RestaurantRepositoryInterface;
use App\Interfaces\Services\RestaurantServiceInterface;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

use App\Http\Requests\BackEnd\Restaurants\ListRequest as  ListRestaurantRequest;

use App\Models\Restaurant;

class RestaurantController extends Controller 
{
    protected  $restaurantService;
    protected  $restaurantRepository;
    const PATH_VIEW = 'backend.restaurant.';

    public function __construct(
        RestaurantServiceInterface $restaurantService,
        RestaurantRepositoryInterface $restaurantRepository,
    ) {
        $this->restaurantService = $restaurantService;
        $this->restaurantRepository = $restaurantRepository;
    }

    /**
     * Display the list of roles.
     *
     * @param  ListRestaurantRequest $request
     * @return \Illuminate\View\View
     */

     public function compose(View $view) 
     {
         $restaurantDatas = $this->restaurantRepository->first();
         $description = json_decode($restaurantDatas->description, true);
         $priceData = json_decode($restaurantDatas->price, true); // Giả sử bạn có giá trong cơ sở dữ liệu cũng được lưu dưới dạng JSON
     
         $view->with('description', $description);
         $view->with('priceData', $priceData);
     }
     
     
}


