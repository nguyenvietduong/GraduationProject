<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Favorite;
use App\Models\Menu;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
   // public function favorite($menu_id)
   // {
   //    $data = [
   //       'menu_id' => $menu_id,
   //       'user_id' => auth('')->id()
   //    ];

   //    $favorited = Favorite::where(['menu_id' => $menu_id,  'user_id' => auth()->id()])->first();
   //    if ($favorited) {
   //       $favorited->delete();
   //       return redirect()->back()->with('success', 'Bạn đã bỏ yêu thích sản phẩm');
   //    } else {
   //       Favorite::create($data);
   //       return redirect()->back()->with('success', 'Bạn đã yêu thích sản phẩm');
   //    }
   // }

   public function toggleFavorite(Request $request)
   {
       if (!Auth::check()) {
           return response()->json(['success' => 'Bạn cần đăng nhập để yêu thích menu.'], 401);
       }
       $menuId = $request->menu_id;
       $user = Auth::user();
   
       // Kiểm tra xem menu đã được yêu thích hay chưa
       if ($user->favorites()->where('menu_id', $menuId)->exists()) {
           $user->favorites()->detach($menuId);
           return response()->json(['success' => 'Đã hủy yêu thích menu.', 'status' => 'removed']);
       } else {
           $user->favorites()->attach($menuId);
           return response()->json(['success' => 'Đã yêu thích menu thành công.', 'status' => 'added']);
       }
   }


   public function favorite_list(Request $request)
{
    // Lấy người dùng đang đăng nhập
    $user = auth()->user();

    // Kiểm tra nếu người dùng chưa đăng nhập
    if (!$user) {
        return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để xem danh sách yêu thích.');
    }

    // Kiểm tra nếu có yêu cầu hủy yêu thích
    if ($request->has('remove_favorite')) {
        $menuId = $request->input('remove_favorite');

        // Xóa sản phẩm khỏi danh sách yêu thích
        $user->favorites()->detach($menuId);

        // Thông báo thành công
        return redirect()->route('favorite.list')->with('success', 'Đã xóa khỏi danh sách yêu thích.');
    }

    // Lấy danh sách sản phẩm yêu thích
    $favorites = $user->favorites()->get();

    // Trả về view với dữ liệu
    return view('frontend.faverite', compact('favorites'));
}




   
}
