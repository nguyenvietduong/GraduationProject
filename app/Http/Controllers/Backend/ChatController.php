<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Traits\HandleExceptionTrait;
use App\Models\Message;
use App\Events\MessageSent;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    use HandleExceptionTrait;

    const PATH_VIEW = 'backend.chat.';

    public function __construct(
    ) {
    }

    public function index()
    {
        return view(self::PATH_VIEW . __FUNCTION__, []);
    }

    public function sendMessage(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'content' => 'required|string',
        ]);

        $message = Message::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $request->receiver_id,
            'content' => $request->content,
        ]);

        return response()->json($message, 201);
    }

    public function getMessages($userId)
    {
        // Lấy tất cả tin nhắn giữa người dùng hiện tại và người dùng đã chỉ định
        $messages = Message::where(function ($query) use ($userId) {
            $query->where('sender_id', auth()->id())
                  ->where('receiver_id', $userId);
        })->orWhere(function ($query) use ($userId) {
            $query->where('sender_id', $userId)
                  ->where('receiver_id', auth()->id());
        })->get();

        return response()->json($messages);
    }

    public function getUsersWithMessages()
    {
        // Lấy ID của người dùng hiện tại
        $currentUserId = Auth::id();

        // Lấy danh sách người dùng đã nhắn tin
        $userIds = Message::where('sender_id', $currentUserId)
            ->distinct()
            ->pluck('receiver_id') // Lấy ID của người nhận
            ->merge(
                Message::where('receiver_id', $currentUserId)
                ->distinct()
                ->pluck('sender_id') // Lấy ID của người gửi
            )
            ->unique()
            ->toArray();

        // Lấy thông tin người dùng từ bảng users
        $users = User::whereIn('id', $userIds)->get();

        return response()->json($users);
    }
}
