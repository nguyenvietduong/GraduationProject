<?php

namespace App\Interfaces\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

interface AccountRepositoryInterface extends RepositoryInterface
{

    /**
     * Get a paginated list of accounts with optional search functionality.
     *
     * @param array $filters
     * @param int $perPage
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getAllAccount(array $filters = [], $perPage = 5, $role = 'user');

    /**
     * Count users with a specific role.
     *
     * @param array $role
     * @return int
     */
    public function countAccountsByRole(array $role = []);

    /**
     * Get account friends by ID.
     *
     * @param int $id
     * @return mixed
     */
    public function getFriendsByUserId(int $id);

    /**
     * Get account details by ID.
     *
     * @param int $id
     * @return mixed
     */
    public function getAccountDetail(int $id);

    /**
     * Update an account by ID with new data.
     *
     * @param int $id
     * @param array $params
     * @return mixed
     */
    public function updateAccount(int $id, array $params);

    /**
     * Create a new account with the provided data.
     *
     * @param array $params
     * @return mixed
     */
    public function createAccount(array $params);

    /**
     * Delete an account by ID.
     *
     * @param int $id
     * @return bool
     */
    public function deleteAccount(int $id);
}
