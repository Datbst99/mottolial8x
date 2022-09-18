<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Promotion;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    public function index()
    {
        $promotions = Promotion::orderBy('reward_point')
            ->get();

        return view('admin.promotion.index', compact('promotions'));
    }

    public function store(Request $request)
    {
        $request->validate([
           'title' => 'required',
           'point' => 'required|numeric',
        ], [
            'title.required' => 'Vui lòng nhập tên chương trình',
            'point.required' => 'Vui lòng nhập điểm tích lũy',
            'point.numeric' => 'Sai định dạng số'
        ]);

        $promotion = new Promotion();
        $promotion->title = $request->get('title');
        $promotion->reward_point = $request->get('point');
        $promotion->save();

        return redirect()->back()->with('success', 'Thêm chương trình khuyễn mãi thành công');
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'title' => 'required',
            'point' => 'required|numeric',
        ], [
            'title.required' => 'Vui lòng nhập tên chương trình',
            'point.required' => 'Vui lòng nhập điểm tích lũy',
            'point.numeric' => 'Sai định dạng số'
        ]);

        $promotion = Promotion::findOrFail($id);
        $promotion->title = $request->get('title');
        $promotion->reward_point = $request->get('point');
        $promotion->update();

        return redirect()->back()->with('success', 'Cập nhật chương trình khuyễn mãi thành công');
    }

    public function delete(Request $request)
    {
        if(!$request->get('listPromotion')) {
            return response()->json([
                'success' => false,
                'message' => 'Vui lòng chọn chương trình khuyến mại cần xóa'
            ]);
        }

        Promotion::whereIn('id', $request->get('listPromotion'))->delete();

        return response()->json([
            'success' => true,
            'message' => 'Xóa chương trình khuyến mãi thành công'
        ]);
    }

    public function formUpdate(Request $request)
    {
        $promotion = Promotion::findOrFail($request->get('id'));

        $html = view('admin.promotion._update', compact('promotion'))->render();

        return response()->json([
            'success' => true,
            'data' => $html
        ]);
    }
}
