<?php

namespace App\Services;

use App\Interfaces\Repositories\ReviewRepositoryInterface;
use App\Interfaces\Services\ReviewServiceInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Hash;
use Exception;

class ReviewService extends BaseService implements ReviewServiceInterface
{
    protected $reviewRepository;

    /**
     * Tạo mới instance của ReviewService.
     *
     * @param ReviewRepositoryInterface $reviewRepository
     */
    public function __construct(
        ReviewRepositoryInterface $reviewRepository,
    ) {
        $this->reviewRepository = $reviewRepository;
    }

    /**
     * Get a paginated list of reviews with optional filters.
     *
     * @param array $filters
     * @param int $perPage
     * @return mixed
     * @throws Exception
     */
    public function getAllReviews(array $filters = [], int $perPage = 5)
    {
        try {
            // Retrieve reviews from the repository using filters and pagination
            return $this->reviewRepository->getAllReviews($filters, $perPage);
        } catch (Exception $e) {
            // Handle any exceptions that occur while retrieving reviews
            throw new Exception('Unable to retrieve review list: ' . $e->getMessage());
        }
    }

    /**
     * Lấy chi tiết của review theo ID.
     *
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function getReviewDetail(int $id)
    {
        try {
            return $this->reviewRepository->getReviewDetail($id);
        } catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException('Reviews không tồn tại với ID: ' . $id);
        } catch (Exception $e) {
            // Xử lý lỗi khác nếu cần thiết
            throw new Exception('Không thể lấy chi tiết review: ' . $e->getMessage());
        }
    }

    /**
     * Tạo mới một review.
     *
     * @param array $data
     * @return mixed
     */
    public function createReview(array $data)
    {
        try {
            // Create the review
            $data['guard_name'] = 'web';

            return $this->reviewRepository->createReview($data);
        } catch (Exception $e) {
            // Handle any errors that occur during review creation
            throw new Exception('Unable to create review: ' . $e->getMessage());
        }
    }

    /**
     * Cập nhật một review theo ID.
     *
     * @param int $id
     * @param array $data
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function updateReview(int $id, array $data)
    {
        try {
            $data['guard_name'] = 'web';

            return $this->reviewRepository->updateReview($id, $data);
        } catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException('Reviews không tồn tại với ID: ' . $id);
        } catch (Exception $e) {
            // Xử lý lỗi khác nếu cần thiết
            throw new Exception('Không thể cập nhật review: ' . $e->getMessage());
        }
    }

    /**
     * Xóa một review theo ID.
     *
     * @param int $id
     * @return bool
     * @throws ModelNotFoundException
     */
    public function deleteReview(int $id)
    {
        try {
            return $this->reviewRepository->deleteReview($id);
        } catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException('Reviews không tồn tại với ID: ' . $id);
        } catch (Exception $e) {
            // Xử lý lỗi khác nếu cần thiết
            throw new Exception('Không thể xóa review: ' . $e->getMessage());
        }
    }



    public function updatePermission($request)
    {
        try {
            $permissions = $request->input('permission');
            // dd($permissions);
            if (count($permissions)) {
                foreach ($permissions as $key => $val) {
                    $review = $this->reviewRepository->getReviewDetail($key);
                    $review->permissions()->detach();
                    $review->permissions()->sync($val);
                }
            }
            // return $this->reviewRepository->updateReview($id, $data);
        } catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException('');
        } catch (Exception $e) {
            // Xử lý lỗi khác nếu cần thiết
            throw new Exception('Không thể cập nhật phân quyền: ' . $e->getMessage());
        }
    }

}
