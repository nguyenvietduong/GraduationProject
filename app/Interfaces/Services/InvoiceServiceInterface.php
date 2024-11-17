<?php

namespace App\Interfaces\Services;

interface InvoiceServiceInterface
{
    /**
     * Get a paginated list of Invoices with optional filters.
     *
     * @param array $filters
     * @param int $perPage
     * @param string $Invoice
     * @return mixed
     */
    public function getAllInvoices(array $filters = [], int $perPage = 10);

    /**
     * Get details of a Invoice by ID.
     *
     * @param int $id
     * @return mixed
     */
    public function getInvoiceDetail(int $id);

}
