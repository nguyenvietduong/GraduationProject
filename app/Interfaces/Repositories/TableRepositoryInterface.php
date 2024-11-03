<?php

namespace App\Interfaces\Repositories;
use Illuminate\Pagination\LengthAwarePaginator;
use Prettus\Repository\Contracts\RepositoryInterface;

interface TableRepositoryInterface extends RepositoryInterface
{
    /**
     * Get a paginated list of Tables with optional search functionality.
     *
     * @param array $filters
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getAllTables(array $filters = [], int $perPage = 5): LengthAwarePaginator;

    /**
     * Get details of a Table by ID.
     *
     * @param int $id
     * @return mixed
     */
    public function getTableDetail(int $id): mixed;

    /**
     * Update a Table by ID with new data.
     *
     * @param int $id
     * @param array $params
     * @return mixed
     */
    public function updateTable(int $id, array $params): mixed;

    /**
     * Create a new Table with data.
     *
     * @param array $params
     * @return mixed
     */
    public function createTable(array $params): mixed;

    /**
     * Delete a Table by ID.
     *
     * @param int $id
     * @return bool
     */
    public function deleteTable(int $id): bool;

    /**
     * Get all data by position.
     *
     * @return mixed
     */
    public function getAllTablesByPosition(): mixed;

    public function checkAvailableTables($reservation_time, array $params);
}
