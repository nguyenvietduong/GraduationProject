<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Interfaces\Services\TempImageServiceInterface;
use App\Interfaces\Repositories\PermissionRepositoryInterface as PermissionRepository;
use App\Interfaces\Services\ReviewServiceInterface;
use App\Interfaces\Services\NotificationServiceInterface;
use App\Interfaces\Repositories\ReviewRepositoryInterface;
use App\Traits\HandleExceptionTrait;

// Requests
use App\Http\Requests\BackEnd\Reviews\ListRequest as ReviewListRequest;

class ReviewController extends Controller
{
    use HandleExceptionTrait;

    protected $reviewService;
    protected $reviewRepository;
    protected $tempImageService;
    protected $permissionRepository;
    private $notificationService;

    // Base path for views
    const PATH_VIEW = 'backend.review.';
    const PER_PAGE_DEFAULT = 5;
    const OBJECT = 'review';

    public function __construct(
        TempImageServiceInterface $tempImageService,
        ReviewServiceInterface $reviewService,
        ReviewRepositoryInterface $reviewRepository,
        PermissionRepository $permissionRepository,
        NotificationServiceInterface $notificationService,
    ) {
        $this->tempImageService = $tempImageService;
        $this->reviewService = $reviewService;
        $this->reviewRepository = $reviewRepository;
        $this->permissionRepository = $permissionRepository;
        $this->notificationService = $notificationService;
    }

    /**
     * Display the list of reviews.
     *
     * @param ReviewListRequest $request
     * @return \Illuminate\View\View
     */
    public function index(ReviewListRequest $request)
    {
        $this->authorize('modules', '' . self::OBJECT . '.index');
        $this->tempImageService->deleteTempImagesForUser();
        session()->forget('image_review_temp'); // Clear temporary image value
        // Validate the request data
        $request->validated();

        // Extract filters from the request
        $params = $request->all();

        // Apply filters from the request
        $filters = [
            'search' => $params['keyword'] ?? '', // Ensure this matches the search input name
            'start_date' => $params['start_date'] ?? '',
            'end_date' => $params['end_date'] ?? '',
            'status' => $params['status'] ?? '',
        ];

        // Get the per_page value
        $perPage = $params['per_page'] ?? self::PER_PAGE_DEFAULT;

        return view(self::PATH_VIEW . __FUNCTION__, [
            'object' => self::OBJECT,
            'reviewTotalRecords' => $this->reviewRepository->count(), // Total records for display
            'reviewDatas' => $this->reviewService->getAllReviews($filters, $perPage, self::OBJECT), // Paginated review list for the view
        ]);
    }
}
