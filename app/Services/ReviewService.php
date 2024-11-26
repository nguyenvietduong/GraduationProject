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
     * Create a new instance of ReviewService.
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
     * Get the details of a review by ID.
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
            throw new ModelNotFoundException('Review does not exist with ID: ' . $id);
        } catch (Exception $e) {
            // Handle other errors if necessary
            throw new Exception('Unable to retrieve review details: ' . $e->getMessage());
        }
    }

    /**
     * Create a new review.
     *
     * @param array $data
     * @return mixed
     */
    public function createReview(array $data)
    {
        try {
            // Create the review
            $data['status'] = 'active';

            return $this->reviewRepository->createReview($data);
        } catch (Exception $e) {
            // Handle any errors that occur during review creation
            throw new Exception('Unable to create review: ' . $e->getMessage());
        }
    }

    /**
     * Update a review by ID.
     *
     * @param int $id
     * @param array $data
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function updateReview(int $id, array $data)
    {
        try {
            return $this->reviewRepository->updateReview($id, $data);
        } catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException('Review does not exist with ID: ' . $id);
        } catch (Exception $e) {
            // Handle other errors if necessary
            throw new Exception('Unable to update review: ' . $e->getMessage());
        }
    }

    /**
     * Delete a review by ID.
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
            throw new ModelNotFoundException('Review does not exist with ID: ' . $id);
        } catch (Exception $e) {
            // Handle other errors if necessary
            throw new Exception('Unable to delete review: ' . $e->getMessage());
        }
    }

    public function countNewReviews(): int
    {
        return $this->reviewRepository->countNewReviews();
    }
}
