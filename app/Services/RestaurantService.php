<?php 

namespace App\Services;

use App\Interfaces\Repositories\RestaurantRepositoryInterface;
use App\Interfaces\Services\RestaurantServiceInterface;
use App\Interfaces\Services\ImageServiceInterface;

use Illuminate\Http\UploadedFile;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Hash;
use Exception;
use Illuminate\Support\Facades\Storage;

class RestaurantService extends BaseService  implements RestaurantServiceInterface

{
    protected $restaurantRepository;
    protected $imageService;

    
    /**
     * Tạo mới instance của RoleService.
     *
     * @param RestaurantRepositoryInterface $restaurantRepository
     * @param ImageServiceInterface $imageService
     * 
     */
    public function __construct(
        RestaurantRepositoryInterface $restaurantRepository,
        ImageServiceInterface $imageService
    ) {
        $this->restaurantRepository = $restaurantRepository;
        $this->imageService = $imageService;
    }


     /**
     * Get a paginated list of roles with optional filters.
     *
     * @param array $filters
     * @param int $perPage
     * @return mixed
     * @throws Exception
     */
    public function getAllRestaurant(array $filters = [], int $perPage = 5)
    {
        try {
            // Retrieve roles from the repository using filters and pagination
            return $this->restaurantRepository->getAllRestaurant($filters, $perPage);
        } catch (Exception $e) {
            // Handle any exceptions that occur while retrieving roles
            throw new Exception('Unable to retrieve restaurant list: ' . $e->getMessage());
        }
    }


    /**
     * Get account details by ID.
     *
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function getRestaurantDetail(int $id)
    {
        try {
            // Retrieve account details from the repository by ID
            return $this->restaurantRepository->getRestaurantDetail($id);
        } catch (ModelNotFoundException $e) {
            // Handle case where the account is not found
            throw new ModelNotFoundException('Account not found with ID: ' . $id);
        } catch (Exception $e) {
            // Handle any other exceptions that occur while retrieving account details
            throw new Exception('Unable to retrieve account details: ' . $e->getMessage());
        }
    }

    /**
     *  Update an restaurant by ID,
     * 
     *  @param int $id
     *  @param array $data
     *  @return mixed
     *  @throws ModelNotFoundException
     */

    public function updateRestaurant(int $id, array $data)
    {
        $oldRestaurant = $this->restaurantRepository->getRestaurantDetail($id);
        $oldImagePath =  $oldRestaurant->image;
        $image = null;

        try {

            if (isset($data['image'])) {
                $data['image'] = $this->imageService->updateImageS3('restaurant_files', $data['image'], $oldImagePath);

            } elseif (session('image_temp')) {
                $tempImageName = session('image_temp');
                $tempImagePath = $tempImageName;


                if (Storage::exists($tempImagePath)) {
                    $fullTempImagePath =  Storage::path($tempImagePath);
                    $image = new UploadedFile( 
                                $fullTempImagePath,
                                $tempImagePath,
                                null,
                                null,
                                true
                
                        
                        
                    );

                    $data['image'] = $this->imageService->updateImageS3('restaurant_files', $image, $oldImagePath);
                    $this->imageService->deleteImage($tempImagePath);

                } else {
                    dd('Temp file does not exist in local storage.');
                }
            }
            
        $this->restaurantRepository->updateRestaurant($id,  $data);

        } catch (Exception $e) {
            $this->restaurantRepository->updateRestaurant($id, $oldRestaurant->toArray());

            $this->imageService->handleImageException($e, $data);
            throw new Exception('Unable to update restaurant: ' . $e->getMessage());
        
        }

    }

    
}

