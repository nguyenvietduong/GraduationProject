<?php

namespace App\Services;

use App\Interfaces\Repositories\InvoiceRepositoryInterface;
use App\Interfaces\Services\InvoiceServiceInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;

class InvoiceService extends BaseService implements InvoiceServiceInterface
{
    protected $InvoiceRepository;

    /**
     * Create a new instance of InvoiceService.
     *
     * @param InvoiceRepositoryInterface $InvoiceRepository
     */
    public function __construct(
        InvoiceRepositoryInterface $InvoiceRepository,
    ) {
        $this->InvoiceRepository = $InvoiceRepository;
    }

    /**
     * Get a paginated list of categories with optional filters.
     *
     * @param array $filters
     * @param int $perPage
     * @return mixed
     * @throws Exception
     */
    public function getAllInvoices(array $filters = [], int $perPage = 10)
    {
        try {
            // Retrieve categories from the repository using filters and pagination
            return $this->InvoiceRepository->getAllInvoices($filters, $perPage);
        } catch (Exception $e) {
            // Handle any exceptions that occur while retrieving categories
            throw new Exception('Unable to retrieve Invoice list: ' . $e->getMessage());
        }
    }

    /**
     * Get the details of a Invoice by ID.
     *
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function getInvoiceDetail(int $id)
    {
        try {
            return $this->InvoiceRepository->getInvoiceDetail($id);
        } catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException('Invoice does not exist with ID: ' . $id);
        } catch (Exception $e) {
            // Handle other errors if necessary
            throw new Exception('Unable to retrieve Invoice details: ' . $e->getMessage());
        }
    }
}
