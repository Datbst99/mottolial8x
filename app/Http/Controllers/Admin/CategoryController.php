<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $categories = Category::orderBy('index')->get();


        return view('admin.category.index', compact('categories'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'index' => 'nullable|numeric'
        ], [
            'title.required' => 'Vui lòng nhập tên danh mục',
            'index.numeric' => 'Sai định dạng số',
        ]);

        $category = new Category();
        $category->title = $request->get('title');
        $category->index = $request->get('index');
        $category->create_by = auth()->user()->id;
        $category->save();

        return redirect()->back()->with('success', 'Thêm danh mục thành công');
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'index' => 'nullable|numeric'
        ], [
            'title.required' => 'Vui lòng nhập tên danh mục',
            'index.numeric' => 'Sai định dạng số',
        ]);

        $category = Category::findOrFail($id);
        $category->title = $request->get('title');
        $category->index = $request->get('index');
        $category->update();

        return redirect()->back()->with('success', 'Cập nhật danh mục thành công');

    }

    public function delete(Request $request)
    {
        if(!$request->get('listCategory')) {
            return response()->json([
                'success' => false,
                'message' => 'Vui lòng chọn danh mục cần xóa'
            ]);
        }

        Category::whereIn('id', $request->get('listCategory'))
            ->delete();
        return response()->json([
            'success' => true,
            'message' => 'Xóa danh mục thành công'
        ]);
   }

    public function formUpdate(Request $request)
    {
        $category = Category::find($request->get('id'));

        $html = view('admin.category._update', compact('category'))->render();

        return response()->json([
            'success' => true,
            'data' => $html
        ]);
    }
}
