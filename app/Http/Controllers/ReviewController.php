<?php

namespace App\Http\Controllers;

use App\Events\NotificationEvent;
use App\Events\ReviewEvent;
use App\Interfaces\Services\NotificationServiceInterface;
use App\Interfaces\Services\ReviewServiceInterface;
use App\Interfaces\Repositories\ReviewRepositoryInterface;
use App\Traits\HandleExceptionTrait;

// Requests
use App\Http\Requests\Frontend\Reviews\StoreRequest as ReviewStoreRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ReviewController extends Controller
{
    use HandleExceptionTrait;

    protected $notificationService;
    protected $reviewService;
    protected $reviewRepository;

    // Base path for views
    const PATH_VIEW = 'frontend.contact';

    public function __construct(
        NotificationServiceInterface $notificationService,
        ReviewServiceInterface $reviewService,
        ReviewRepositoryInterface $reviewRepository,
    ) {
        $this->notificationService = $notificationService;
        $this->reviewService = $reviewService;
        $this->reviewRepository = $reviewRepository;
    }

    /**
     * Display the list of reviews.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view(self::PATH_VIEW,  [
            'dataReviews' => $this->reviewService->getAllReviews([], 4),
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
        $data = $request->validated();

        try {
            // Create a new review
            $this->reviewService->createReview($data);
            
            return redirect()->back()->with('success', 'Đánh giá thành công!!');
        } catch (\Exception $e) {
            // Log when an error occurs
            Log::error('Error in review creation', ['error' => $e->getMessage()]);

            return redirect()->back()->with('error', __('messages.system.alert.error.text'));
        }
    }
}
