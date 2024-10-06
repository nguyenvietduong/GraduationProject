<?php

namespace App\Interfaces\Services;

interface AccountServiceInterface
{
    /**
     * Get a paginated list of accounts with optional filters.
     *
     * @param array $filters
     * @param int $perPage
     * @return mixed
     */
    public function getAllAccount(array $filters = [], int $perPage = 15, $role = 'user');

    /**
     * Get account details by ID.
     *
     * @param int $id
     * @return mixed
     */
    public function getAccountDetail(int $id);

    /**
     * Create a new account.
     *
     * @param array $data
     * @return mixed
     */
    public function createAccount(array $data);

    /**
     * Update an account by ID.
     *
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function updateAccount(int $id, array $data);

    /**
     * Delete an account by ID.
     *
     * @param int $id
     * @return bool
     */
    public function deleteAccount(int $id);

    /**
     * Count the number of accounts with a specific role.
     *
     * @param string $role
     * @return int
     */
    public function countAccountsByRole(string $role);

    /**
     * Get a list of friends for a specific user by user ID.
     *
     * @param int $id
     * @return mixed
     */
    public function getFriendsByUserId(int $id);
}
