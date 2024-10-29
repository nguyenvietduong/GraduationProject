<?php

namespace App\Services;

use App\Interfaces\Repositories\MenuRepositoryInterface;
use App\Interfaces\Services\MenuServiceInterface;
use App\Interfaces\Services\ImageServiceInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Exception;

class MenuService extends BaseService implements MenuServiceInterface
{
    protected $menuRepository;
    protected $imageService;
    /**
     * Create a new instance of MenuService.
     *
     * @param MenuRepositoryInterface $menuRepository
     */
    public function __construct(
        MenuRepositoryInterface $menuRepository,
        ImageServiceInterface $imageService
    ) {
        $this->menuRepository = $menuRepository;
        $this->imageService = $imageService;
    }

    /**
     * Get a paginated list of Categories with optional filters.
     *
     * @param array $filters
     * @param int $perPage
     * @return mixed
     * @throws Exception
     */
    public function getAllMenus(array $filters = [], int $perPage = 5)
    {
        try {
            // Retrieve Categories from the repository using filters and pagination
            return $this->menuRepository->getAllMenus($filters, $perPage);
        } catch (Exception $e) {
            // Handle any exceptions that occur while retrieving Categories
            throw new Exception('Unable to retrieve Menu list: ' . $e->getMessage());
        }
    }

    /**
     * Get the details of a menu by ID.
     *
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function getMenuDetail(int $id)
    {
        try {
            return $this->menuRepository->getMenuDetail($id);
        } catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException('Menu not found with ID: ' . $id);
        } catch (Exception $e) {
            // Handle other errors if necessary
            throw new Exception('Unable to retrieve menu details: ' . $e->getMessage());
        }
    }

    /**
     * Create a new menu.
     *
     * @param array $data
     * @return mixed
     */

    public function createMenu(array $data)
    {
        try {
            // Hash the password before storing it
            $image = null;
            // if($data["currency"] == "VND") {
            //     $data["price"] = $data["price"]/24000;
            // }
            // Handle image upload from the request if present
            if (isset($data['image_url'])) {
                $data['image_url'] = $this->imageService->storeImage('menu_files', $data['image_url']);
            } elseif (session('image_temp')) {
                // Handle temporary image if session data exists
                $tempImageName = session('image_temp');
                $tempImagePath = $tempImageName;

                // Check if the temporary image exists in storage
                if (Storage::exists($tempImagePath)) {
                    $fullTempImagePath = Storage::path($tempImagePath);
                    $image = new UploadedFile(
                        $fullTempImagePath,
                        $tempImageName,
                        null,
                        null,
                        true
                    );

                    // Store the image in S3 and delete the temporary image
                    $data['image_url'] = $this->imageService->storeImage('account_files', $image);
                    $this->imageService->deleteImage($tempImagePath);
                } else {
                    dd('Temp file does not exist in local storage.'); // Debugging statement for missing temp file
                }
            }
            // Tạo một tài khoản mới bằng cách sử dụng repository
            $this->menuRepository->createMenu($data);
        } catch (Exception $e) {
            // Xóa tài khoản vừa tạo nếu có lỗi
            if (isset($menu) && $menu) {
                $menu->delete(); // Xóa tài khoản
            }

            // Handle image storage exceptions
            $this->imageService->handleImageException($e, $data);
            throw new Exception('Unable to create account: ' . $e->getMessage());
        }
    }

    /**
     * Update a menu by ID.
     *
     * @param int $id
     * @param array $data
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function updateMenu(int $id, array $data)
    {
        try {
            if($data["currency"] == "VND") {
                $data["price"] = $data["price"]/24000;
            }
            if(isset($data['image_url'])) {
                $data['image_url'] = $this->imageService->storeImage('menu_files', $data['image_url']);
            }else{
                $data['image_url'] = $data["image_old"];
            }
            return $this->menuRepository->updateMenu($id, $data);
        } catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException('Menu not found with ID: ' . $id);
        } catch (\Exception $e) {
            throw new \Exception('Unable to update menu: ' . $e->getMessage());
        }
    }

    /**
     * Delete a menu by ID.
     *
     * @param int $id
     * @return bool
     * @throws ModelNotFoundException
     */
    public function deleteMenu(int $id)
    {
        try {
            return $this->menuRepository->deleteMenu($id);
        } catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException('Menu not found with ID: ' . $id);
        } catch (Exception $e) {
            // Handle other errors if necessary
            throw new Exception('Unable to delete menu: ' . $e->getMessage());
        }
    }
}
