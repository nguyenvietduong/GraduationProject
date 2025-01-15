<?php

namespace App\Services;

use App\Interfaces\Repositories\PromotionRepositoryInterface;
use App\Interfaces\Services\PromotionServiceInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;

class PromotionService extends BaseService implements PromotionServiceInterface
{
    protected $promotionRepository;

    /**
     * Tạo mới instance của PromotionService.
     *
     * @param PromotionRepositoryInterface $promotionRepository
     */
    public function __construct(
        PromotionRepositoryInterface $promotionRepository,
    ) {
        $this->promotionRepository = $promotionRepository;
    }

    /**
     * Get a paginated list of promotions with optional filters.
     *
     * @param array $filters
     * @param int $perPage
     * @return mixed
     * @throws Exception
     */
    public function getAllpromotions(array $filters = [], int $perPage = 5)
    {
        try {
            // Retrieve promotions from the repository using filters and pagination
            return $this->promotionRepository->getAllPromotions($filters, $perPage);
        } catch (Exception $e) {
            // Handle any exceptions that occur while retrieving promotions
            throw new Exception('Unable to retrieve Promotion list: ' . $e->getMessage());
        }
    }

    /**
     * Lấy chi tiết của promotion theo ID.
     *
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function getPromotionDetail(int $id)
    {
        try {
            return $this->promotionRepository->getPromotionDetail($id);
        } catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException('Promotion không tồn tại với ID: ' . $id);
        } catch (Exception $e) {
            // Xử lý lỗi khác nếu cần thiết
            throw new Exception('Không thể lấy chi tiết promotion: ' . $e->getMessage());
        }
    }

    /**
     * Tạo mới một promotion.
     *
     * @param array $data
     * @return mixed
     */
    public function createPromotion($request)
    {
        try {

            $data = $request->except(['_token', 'send']);


            // $data['title'] = json_encode($data['title']);
            // $data['description'] = json_encode($data['description']);
            // $data['discount'] = json_encode($data['discount']);
            // $data['min_order_value'] = json_encode($data['min_order_value']);
            // $data['max_discount'] = json_encode($data['max_discount']);

            dd($data);
            return $this->promotionRepository->createPromotion($data);
        } catch (Exception $e) {
            echo $e->getMessage();
            die;
            throw new Exception('Unable to create promotion: ' . $e->getMessage());
        }
    }

    /**
     * Cập nhật một promotion theo ID.
     *
     * @param int $id
     * @param array $data
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function updatePromotion(int $id, $request)
    {
        try {
            $data = $request->except(['_token', '_method']);

            $data['discount'] = formatDiscount($request->input('discount'));
            $data['max_discount'] = formatDiscount($request->input('max_discount'));
            $data['min_order_value'] = formatDiscount($request->input('min_order_value'));

            // dd($data);
            return $this->promotionRepository->updatePromotion($id, $data);
        } catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException('Promotion không tồn tại với ID: ' . $id);
        } catch (Exception $e) {
            echo $e->getMessage();
            die;
            throw new Exception('Không thể cập nhật promotion: ' . $e->getMessage());
        }
    }

    /**
     * Xóa một promotion theo ID.
     *
     * @param int $id
     * @return bool
     * @throws ModelNotFoundException
     */
    public function deletePromotion(int $id)
    {
        try {
            return $this->promotionRepository->deletePromotion($id);
        } catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException('Promotion không tồn tại với ID: ' . $id);
        } catch (Exception $e) {
            // Xử lý lỗi khác nếu cần thiết
            throw new Exception('Không thể xóa promotion: ' . $e->getMessage());
        }
    }
}
