<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function render($request, Throwable $exception) // Thay đổi từ Exception sang Throwable
    {
        // Kiểm tra nếu là lỗi 404
        if ($exception instanceof NotFoundHttpException) {
            return response()->view('errors.404', [], 404); // Hiển thị view lỗi 404
        }

        // Xử lý các loại ngoại lệ khác
        return parent::render($request, $exception);
    }

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            // Bạn có thể báo cáo lỗi hoặc ghi log tại đây
        });
    }
}
