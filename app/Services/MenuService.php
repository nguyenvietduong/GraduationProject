<?php

namespace App\Services;

use App\Interfaces\Repositories\MenuRepositoryInterface;
use App\Interfaces\Services\MenuServiceInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;

class MenuService extends BaseService implements MenuServiceInterface
{
    protected $menuRepository;

    /**
     * Create a new instance of MenuService.
     *
     * @param MenuRepositoryInterface $menuRepository
     */
    public function __construct(
        MenuRepositoryInterface $menuRepository,
    ) {
        $this->menuRepository = $menuRepository;
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
            return $this->menuRepository->createMenu($data);
        } catch (\Exception $e) {
            throw new \Exception('Unable to create menu: ' . $e->getMessage());
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
