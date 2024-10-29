<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Table;
use App\Interfaces\Services\TableServiceInterface;
use App\Interfaces\Repositories\TableRepositoryInterface;
use App\Traits\HandleExceptionTrait;
use App\Http\Requests\Backend\Tables\ListRequest as TableListRequest;
use App\Http\Requests\Backend\Tables\StoreRequest as TablesStoreRequest;
use App\Http\Requests\Backend\Tables\UpdateRequest as TablesUpdateRequest;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class TableController extends Controller
{
    use HandleExceptionTrait;

    protected $tableService;
    protected $tableRepository;

    const PATH_VIEW = 'backend.table.';
    const PER_PAGE_DEFAULT = 5;
    const OBJECT = 'table';

    public function __construct(TableServiceInterface $tableService, TableRepositoryInterface $tableRepository)
    {
        $this->tableService = $tableService;
        $this->tableRepository = $tableRepository;
    }

    public function index(TableListRequest $request)
    {

        // Extract filters from the request
        $params = $request->all();

        // Apply filters from the request
        $filters = [
            'search' => $params['keyword'] ?? '', // Ensure this matches the search input name
            'start_date' => $params['start_date'] ?? '',
            'end_date' => $params['end_date'] ?? '',
            'start_price' => $params['start_price'] ?? 0,
            'end_price' => $params['end_price'] ?? 0,
        ];
        // Get the per_page value
        $perPage = $params['per_page'] ?? self::PER_PAGE_DEFAULT;
        $tables = $this->tableRepository->getAllTables($filters, $perPage, self::OBJECT);
        $tableTotalRecords = $this->tableRepository->count();

        return view(self::PATH_VIEW . 'index', [
            'tables' => $tables,
            'tableTotalRecords' => $tableTotalRecords,
            'object' => self::OBJECT,
        ]);



    }

    /**
     * Show the form for creating a new table.
     *
     * @return View
     */
    public function create()
    {
        return view(self::PATH_VIEW . 'create', [
            'object' => self::OBJECT,
        ]);
    }

    /**
     * Store a newly created table in storage.
     *
     * @param TablesStoreRequest $request
     * @return RedirectResponse
     */
    public function store(TablesStoreRequest $request)
    {
        $data = $request->validated();

        // Kiểm tra và mã hóa lại `name` với cả hai ngôn ngữ
        $data['name'] = json_encode([
            'en' => $data['name']['en'] ?? 'Default Name',
            'vi' => $data['name']['vi'] ?? 'Tên mặc định'
        ], JSON_OBJECT_AS_ARRAY);


        // Kiểm tra và mã hóa lại `description` với cả hai ngôn ngữ
        $data['description'] = json_encode([
            'en' => $data['description']['en'] ?? 'No Description',
            'vi' => $data['description']['vi'] ?? 'Không có mô tả'
        ], JSON_OBJECT_AS_ARRAY);

        // Lưu dữ liệu vào database
        $this->tableRepository->createTable($data);

        return redirect()->route('admin.table.index')->with('success', __('messages.table.store.success'));
    }


    /**
     * Show the form for editing a Category.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        // Retrieve the details of the Category
        $table = $this->tableService->getTableDetail($id);
        if ($table) {
            return view(self::PATH_VIEW . __FUNCTION__, [
                'tableData' => $table,
                'object' => 'table',
            ]);
        }

        abort(404);
    }


    /**
     * Handle the update of a Category.
     *
     * @param int $id
     * @param TablesUpdateRequest $request
     * @return RedirectResponse
     */
    public function update($id, TablesUpdateRequest $request)
    {
        // Validate the data from the request using CategoryUpdateRequest
        $data = $request->validated();
        try {

            // Kiểm tra và mã hóa lại `name` với cả hai ngôn ngữ
            $data['name'] = json_encode([
                'en' => $data['name']['en'] ?? 'Default Name',
                'vi' => $data['name']['vi'] ?? 'Tên mặc định'
            ], JSON_OBJECT_AS_ARRAY);

            // Kiểm tra và mã hóa lại `description` với cả hai ngôn ngữ
            $data['description'] = json_encode([
                'en' => $data['description']['en'] ?? 'No Description',
                'vi' => $data['description']['vi'] ?? 'Không có mô tả'
            ], JSON_OBJECT_AS_ARRAY);
            // Update the table
            $this->tableService->updateTable($id, $data);

            return redirect()->route('admin.table.index')->with('success', 'Table updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Delete a Category.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        try {
            // Delete the Category
            $this->tableService->deleteTable($id);
            return redirect()->back()->with('success', 'Table deleted successfully');
        } catch (\Exception $e) {
            // Return a JSON response if there is an error
            return redirect()->back()->with('error', $e->getMessage());
        }
    }




}
