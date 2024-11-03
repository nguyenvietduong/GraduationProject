<?php

namespace App\Interfaces\Services;

interface TableServiceInterface
{
    /**
     * Get a paginated list of Tables with optional filters.
     *
     * @param array $filters
     * @param int $perPage
     * @return mixed
     */
    public function getAllTables(array $filters = [], int $perPage = 15): mixed;

    /**
     * Get details of a Table by ID.
     *
     * @param int $id
     * @return mixed
     */
    public function getTableDetail(int $id): mixed;

    /**
     * Create a new Table.
     *
     * @param array $data
     * @return mixed
     */
    public function createTable(array $data): mixed;

    /**
     * Update a Table by ID.
     *
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function updateTable(int $id, array $data): mixed;

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
}
