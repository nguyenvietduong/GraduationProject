<?php

namespace App\Http\Controllers\Backend\Promotion;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Promotion\ListRequest;
use App\Http\Requests\Backend\Promotion\StoreRequest;
use App\Http\Requests\Backend\Promotion\UpdateRequest;
use App\Interfaces\Repositories\PromotionRepositoryInterface as PromotionRepository;
use App\Interfaces\Services\PromotionServiceInterface as PromotionService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    const PATH_VIEW = 'backend.promotion.';
    const PER_PAGE_DEFAULT = 5;
    const OBJECT = 'promotion';

    protected $promotionService;
    protected $promotionRepository;

    public function __construct(
        PromotionRepository $promotionRepository,
        PromotionService $promotionService
    ) {
        $this->promotionRepository = $promotionRepository;
        $this->promotionService = $promotionService;
    }

    public function index(ListRequest $request)
    {
        $this->authorize('modules', '' . self::OBJECT . '.index');
        $request->validated();
        $params = $request->all();

        $filters = [
            'search' => $params['keyword'] ?? '', // Ensure this matches the search input name
            'start_date' => $params['start_date'] ?? '',
            'end_date' => $params['end_date'] ?? '',
            'is_active' => $params['is_active'] ?? ''
        ];

        // dd($filters);

        $perPage = $params['per_page'] ?? self::PER_PAGE_DEFAULT;

        $data = $this->promotionService->getAllPromotions($filters, $perPage, self::OBJECT);
        // dd($data);

        // $data['title'] = json_decode($data['title']);
        // $data['description'] = json_decode($data['description']);
        // $data['discount'] = json_decode($data['discount']);
        // $data['min_order_value'] = json_decode($data['min_order_value']);
        // $data['max_discount'] = json_decode($data['max_discount']);


        return view(
            self::PATH_VIEW . __FUNCTION__,
            [
                'object' => self::OBJECT,
                'promotionTotalRecords' => $this->promotionRepository->count(),
                'promotionDatas' => $data,
            ]
        );
    }

    public function create()
    {
        $this->authorize('modules', '' . self::OBJECT . '.create');
        return view(self::PATH_VIEW . __FUNCTION__, [
            'object' => 'promotion',
        ]);
    }

    public function store(StoreRequest $request)
    {
        try {
            $this->promotionService->createPromotion($request);
            return redirect()->back()->with('success', 'Promotion created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function edit($id)
    {
        $this->authorize('modules', '' . self::OBJECT . '.edit');
        $data = $this->promotionService->getPromotionDetail($id);
        return view(self::PATH_VIEW . __FUNCTION__, [
            'object' => 'promotion',
            'promotionData' => $data,
        ]);
    }


    public function update($id, UpdateRequest $request)
    {
        try {
            $this->promotionService->updatePromotion($id, $request);
            return redirect()->route('admin.promotion.index')->with('success', 'Permission updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $this->promotionService->deletePromotion($id);
            return redirect()->back()->with('success', 'Permission deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

}
