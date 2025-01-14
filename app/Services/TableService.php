<?php

namespace App\Services;

use App\Interfaces\Services\TableServiceInterface;
use App\Interfaces\Repositories\TableRepositoryInterface;
use App\Models\Table;
use Illuminate\Database\Eloquent\ModelNotFoundException;
class TableService implements TableServiceInterface
{
    protected $tableRepository;

    public function __construct(TableRepositoryInterface $tableRepository)
    {
        $this->tableRepository = $tableRepository;
    }

    /**
     * Get a paginated list of tables with optional filters.
     *
     * @param array $filters
     * @param int $perPage
     * @return mixed
     */
    public function getAllTables(array $filters = [], int $perPage = 15): mixed
    {
        return $this->tableRepository->getAllTables($filters, $perPage);
    }

    /**
     * Get details of a table by ID.
     *
     * @param int $id
     * @return mixed
     */
    public function getTableDetail(int $id): mixed
    {
        $table = $this->tableRepository->getTableDetail($id);
        if (!$table) {
            throw new ModelNotFoundException("Table not found");
        }
        return $table;
    }

    /**
     * Create a new table.
     *
     * @param array $data
     * @return mixed
     */
    public function createTable(array $data): mixed
    {
        // Validation can be done here or in a FormRequest class
        return $this->tableRepository->createTable($data);
    }

    /**
     * Update a table by ID.
     *
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function updateTable(int $id, array $data): mixed
    {
        $table = $this->getTableDetail($id); // Check if the table exists
        

        return $this->tableRepository->updateTable($id, $data);
    }

    /**
     * Delete a table by ID.
     *
     * @param int $id
     * @return bool
     */
    public function deleteTable(int $id): bool
    {
        return $this->tableRepository->deleteTable($id);
    }
    public function getAllTablesByPosition(): mixed
    {
        return $this->tableRepository->getAllTablesByPosition();
    }
}
