<?php

namespace App\Interfaces\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

interface InvoiceRepositoryInterface extends RepositoryInterface
{
    /**
     * Get a paginated list of Categories with optional search functionality.
     *
     * @param array $filters
     * @param int $perPage
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getAllInvoices(array $filters = [], $perPage = 10);

    /**
     * Get details of a Invoice by ID.
     *
     * @param int $id
     * @return mixed
     */
    public function getInvoiceDetail(int $id);

}
