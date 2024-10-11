<?php

namespace App\Http\Controllers;

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

            // Tạo review mới
            $review = $this->reviewService->createReview($data);

            // Log thông tin về review đã tạo
            Log::info('New review created', ['review_id' => $review->id]);

            // Gửi thông báo chung
            $title = 'Review';
            $message = 'A new review has been added!';

            dispatch(new SendNotificationJob($title, $message, 'info', Auth::user()->full_name)); // Thay thế 'info' và $review nếu cần

            $data = [
                'user_id'   => $data['user_id'],  // ID của người gui thông báo
                'title'     => $title,
                'message'   => $message,
            ];

            $this->notificationService->createNotification($data);

            Log::info('SendNotificationJob dispatched', ['review_id' => $review->id]);

            return redirect()->back()->with('success', __('messages.system.alert.success'));
        } catch (\Exception $e) {
            // Log khi có lỗi xảy ra
            Log::error('Error in review creation', ['error' => $e->getMessage()]);

            return redirect()->back()->with('error', __('messages.system.alert.error.text'));
        }
    }
}
