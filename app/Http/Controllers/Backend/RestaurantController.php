<?php 

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Interfaces\Repositories\PermissionRepositoryInterface as PermissionRepository;
use App\Interfaces\Repositories\RestaurantRepositoryInterface;
use App\Interfaces\Services\RestaurantServiceInterface;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Auth;

use App\Traits\HandleExceptionTrait;

// Requests

use App\Http\Requests\BackEnd\Restaurants\ListRequest as  ListRestaurantRequest;
use App\Http\Requests\BackEnd\Restaurants\UpdateRequest as  UpdateRestaurantRequest;
use App\Models\Restaurant;
use App\Services\ImageService;
use Illuminate\Http\Request;
class RestaurantController extends Controller 
{
    use HandleExceptionTrait;
    protected  $restaurantService;
    protected  $restaurantRepository;
    protected   $permissionRepository;
    protected   $imageService;

    const PATH_VIEW = 'backend.restaurant.';
    const PER_PAGE_DEFAULT = 5;
    const OBJECT = 'restaurant';


    public function __construct(
        RestaurantServiceInterface $restaurantService,
        RestaurantRepositoryInterface $restaurantRepository,
        PermissionRepository $permissionRepository,
        ImageService $imageService

    ) {
        $this->restaurantService = $restaurantService;
        $this->restaurantRepository = $restaurantRepository;
        $this->permissionRepository = $permissionRepository;
        $this->imageService = $imageService;
    }

/**
     * Display the list of roles.
     *
     * @param  ListRestaurantRequest $request
     * @return \Illuminate\View\View
     */
    public function index(ListRestaurantRequest $request)
    {
        session()->forget('image_temp'); // Clear temporary image value
    
        // Get the per_page value
        $perPage = $request->get('per_page', self::PER_PAGE_DEFAULT);
        
        // Lấy dữ liệu nhà hàng
        $restaurantDatas = $this->restaurantRepository->first();
        
        // Giải mã mô tả JSON
        $description = json_decode($restaurantDatas->description, true); // true để lấy về mảng thay vì đối tượng
    
        // Lấy ngôn ngữ hiện tại
        $currentLocale = app()->getLocale();
    
        return view(self::PATH_VIEW . __FUNCTION__, [
            'object' => self::OBJECT,
            'restaurantDatas' => $restaurantDatas,
            'description' => $description,
            'currentLocale' => $currentLocale,
        ]);
    }
    
    /**
     * Update the account's profile image.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */

    public function updateRestaurantImage(Request  $request)
    {
        $request->validate(
            ['restaurant_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',]
        );
        $data = $this->restaurantRepository->first();


        try {
            $newImagePath = $this->imageService->updateImage(
                'restaurant_image',
                $request->file('restaurant_image'),
                $data->image

            );

            $data->image = $newImagePath;
            $data->save();
        

            return response()->json([
                'success' => true,
                'new_image_url' => Storage::url($newImagePath),
            ]);
        } catch (\Exception $e) {
            return  response()->json(['success' => false, 'message' => 'Failed to update restaurant image']);
        }

    }

     /**
     * Handle the update of an admin.
     *
     * @param int $id
     * @param UpdateRestaurantRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */

     public function updateRestaurant($id, Request $request)
{
    try {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'phone' => 'required|digits_between:10,11|numeric',
            'slug' => 'required|string',
            'opening_hours' => 'required|string',
            'closing_time' => 'required|string',
            'google_map_link' => 'required|string',
            'description' => 'required|string',  
             
        ]);

        

        
        $this->restaurantService->updateRestaurant($id, $validatedData);

        return response()->json(['message' => 'Restaurant updated successfully'], 200);

    } catch (\Illuminate\Validation\ValidationException $e) {
        return response()->json(['error' => $e->errors()], 422);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}

     



}

