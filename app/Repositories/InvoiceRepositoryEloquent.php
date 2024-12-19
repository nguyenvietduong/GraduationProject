<?php

namespace App\Repositories;

use App\Models\Invoice;
use App\Models\Reservation;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Interfaces\Repositories\InvoiceRepositoryInterface;
use App\Models\Invoice_item;

class InvoiceRepositoryEloquent extends BaseRepository implements InvoiceRepositoryInterface
{
    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return Invoice::class;
    }

    /**
     * Apply criteria in current Query Repository.
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * Get a paginated list of Invoices with optional search functionality.
     *
     * @param array $filters
     * @param int $perPage
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getAllInvoices(array $filters = [], $perPage = 10)
    {
        $query = Reservation::query();
        $query->where('status', 'completed');

        // Apply search filters
        if (!empty($filters['search'])) {
            $query->where(function ($q) use ($filters) {
                $q->where('name', 'like', '%' . $filters['search'] . '%')
                    ->orWhere('phone', 'like', '%' . $filters['search'] . '%')
                    ->orWhere('code', 'like', '%' . $filters['search'] . '%')
                    ->orWhere('email', 'like', '%' . $filters['search'] . '%');
            });
        }

        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        if (!empty($filters['start_date'])) {
            $query->whereDate('created_at', '>=', $filters['start_date']);
        }

        if (!empty($filters['end_date'])) {
            $query->whereDate('created_at', '<=', $filters['end_date']);
        }
        // Order by created date (newest first)
        $query->orderBy('id', 'desc');
        // Paginate results
        return $query->paginate($perPage);
    }

    /**
     * Get Invoice detail by ID.
     *
     * @param int $id
     * @return \App\Models\Invoice
     */
    public function getInvoiceDetail($id)
    {
        // Lấy hóa đơn đầu tiên có reservation_id bằng $id
        $invoice = $this->model->where('reservation_id', $id)->first();

        // Nạp các Invoice_item liên quan đến hóa đơn này
        $invoice->load('invoiceItems');

        return $invoice;
    }
}
