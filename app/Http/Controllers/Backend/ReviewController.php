<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Interfaces\Services\TempImageServiceInterface;
use App\Interfaces\Repositories\PermissionRepositoryInterface as PermissionRepository;
use App\Interfaces\Services\ReviewServiceInterface;
use App\Interfaces\Services\NotificationServiceInterface;
use App\Events\NotificationEvent;
use App\Interfaces\Repositories\ReviewRepositoryInterface;
use App\Traits\HandleExceptionTrait;
use Illuminate\Support\Facades\Log;

// Requests
use App\Http\Requests\BackEnd\Reviews\ListRequest as ReviewListRequest;
use App\Http\Requests\BackEnd\Reviews\StoreRequest as ReviewStoreRequest;
use App\Http\Requests\BackEnd\Reviews\UpdateRequest as ReviewUpdateRequest;
use Illuminate\Support\Facades\Auth;

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
        ];

        // Get the per_page value
        $perPage = $params['per_page'] ?? self::PER_PAGE_DEFAULT;

        return view(self::PATH_VIEW . __FUNCTION__, [
            'object' => self::OBJECT,
            'reviewTotalRecords' => $this->reviewRepository->count(), // Total records for display
            'reviewDatas' => $this->reviewService->getAllReviews($filters, $perPage, self::OBJECT), // Paginated review list for the view
        ]);
    }

    /**
     * Show the form for creating a new review.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {

        return view(self::PATH_VIEW . __FUNCTION__, [
            'object' => 'review',
        ]);
    }

    /**
     * Handle the storage of a new review.
     *
     * @param ReviewStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ReviewStoreRequest $request)
    {
        // Validate the data from the request using ReviewStoreRequest
        $data = $request->validated();
        try {
            // Create a new review
            $this->reviewService->createReview($data);

            return redirect()->back()->with('success', 'Review created successfully');
        } catch (\Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Show the form for editing a review.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        // Retrieve the details of the review
        $review = $this->reviewService->getReviewDetail($id);
        if ($review) {

            return view(self::PATH_VIEW . __FUNCTION__, [
                'data' => $review,
                'object' => 'review',
            ]);
        }

        abort(404);
    }

    /**
     * Handle the update of a review.
     *
     * @param int $id
     * @param ReviewUpdateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, ReviewUpdateRequest $request)
    {
        // Validate the data from the request using ReviewUpdateRequest
        $data = $request->validated();

        try {
            // Gửi thông báo chung
            $title = 'Review';
            $message = 'edited review!';

            Log::info('Starting update process for review ID: ' . $id); // Log thông tin

            event(new NotificationEvent($title, $message, 'info', Auth::user()->full_name));
            // dispatch(new SendNotificationJob($title, $message, 'info', Auth::user()->full_name)); // Thay thế 'info' và $review nếu cần

            $dataNotification = [
                'user_id' => Auth::user()->id,  // ID của người gửi thông báo
                'title' => $title,
                'message' => $message,
            ];

            Log::info('Preparing notification data: ', $dataNotification); // Log thông tin

            $this->notificationService->createNotification($dataNotification);

            // Update the review
            $this->reviewService->updateReview($id, $data);

            return redirect()->route('admin.review.index')->with('success', 'Review updated successfully');
        } catch (\Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Delete a review.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        try {
            // Delete the review
            $this->reviewService->deleteReview($id);

            return redirect()->back()->with('success', 'Review deleted successfully');
        } catch (\Exception $e) {
            // Return a JSON response if there is an error

            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
