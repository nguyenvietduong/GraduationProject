<?php

namespace App\Http\Controllers;

use App\Events\NotificationEvent;
use App\Interfaces\Services\NotificationServiceInterface;
use App\Interfaces\Services\ReviewServiceInterface;
use App\Interfaces\Repositories\ReviewRepositoryInterface;
use App\Traits\HandleExceptionTrait;

// Requests
use App\Http\Requests\Frontend\Reviews\StoreRequest as ReviewStoreRequest;
use App\Jobs\SendNotificationJob;
use App\Models\Notification;
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
        return view(self::PATH_VIEW);
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
            $data['user_id'] = Auth::id();

            // Create a new review
            $review = $this->reviewService->createReview($data);

            // Log information about the created review
            Log::info('New review created', ['review_id' => $review->id]);

            // Send general notification
            $title = 'Review';
            $message = 'A new review has been added!';

            event(new NotificationEvent($title, $message, 'info', Auth::user()->full_name));
            // dispatch(new SendNotificationJob($title, $message, 'info', Auth::user()->full_name)); // Replace 'info' and $review if needed

            $data = [
                'user_id'   => $data['user_id'],  // ID of the user sending the notification
                'title'     => $title,
                'message'   => $message,
            ];

            $this->notificationService->createNotification($data);

            Log::info('SendNotificationJob dispatched', ['review_id' => $review->id]);

            return redirect()->back()->with('success', __('messages.system.alert.success'));
        } catch (\Exception $e) {
            // Log when an error occurs
            Log::error('Error in review creation', ['error' => $e->getMessage()]);

            return redirect()->back()->with('error', __('messages.system.alert.error.text'));
        }
    }
}
