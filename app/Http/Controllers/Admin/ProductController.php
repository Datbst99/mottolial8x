<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductClassify;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index(Request $request)
    {
        $categories = Category::orderBy('index')
            ->pluck('title', 'id')
            ->toArray();

        $model = Product::query();

        $search = $request->get('search');
        $category = $request->get('category');
        if($search) {
            $model = $model->where('name', 'LIKE', '%'.$search.'%');
        }

        if($category) {
            $model = $model->where('category_id', $category);
        }

        $products = $model->orderByDesc('created_at')
            ->paginate(15);

        return view('admin.product.index', compact('categories', 'products'));
    }

    public function create()
    {
        $categories = Category::orderBy('index')
            ->pluck('title', 'id')
            ->toArray();
        return view('admin.product.create', compact('categories'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'code' => 'required',
            'thumbnail' => 'required',
            'category' => 'required',
            'classifyName.*' => 'required'
        ], [
            'name.required' => 'Vui lòng nhập tên sản phẩm',
            'code.required' => 'Vui lòng nhập mã sản phẩm',
            'thumbnail.required' => 'Vui lòng thêm hình ảnh',
            'category.required' => 'Chọn hình ảnh',
            'classifyName.*.required' => 'Vui lòng nhập tên phân loại',
        ]);

        $product = new Product();
        $product->name = $request->get('name');
        $product->code = $request->get('code');
        $product->thumbnail = $request->get('thumbnail');
        $product->category_id = $request->get('category');
        $product->description = $request->get('description');
        $product->create_by = auth()->user()->id;
        $product->status = 1;
        $product->save();

        $classifyName = $request->get('classifyName');
        $classifyPrice = $request->get('price');
        $classifySale = $request->get('sale_price');
        $classifyAmount = $request->get('amount');

        foreach ($classifyName as $key => $val) {
            $classify = new ProductClassify();
            $classify->product_id = $product->id;
            $classify->name = $val;
            $classify->price = $classifyPrice[$key];
            $classify->sale_price = $classifySale[$key];
            $classify->amount = $classifyAmount[$key];
            $classify->status = 1;
            $classify->save();
        }


        return redirect()->back()->with('success', 'Thêm sản phẩm thành công');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::orderBy('index')
            ->pluck('title', 'id')
            ->toArray();
        return view('admin.product.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'code' => 'required',
            'thumbnail' => 'required',
            'category' => 'required',
            'classifyName.*' => 'required',
            'price.*' => 'required|numeric',
            'sale_price.*' => 'nullable|numeric',
            'amount.*' => 'required|numeric',
        ], [
            'name.required' => 'Vui lòng nhập tên sản phẩm',
            'code.required' => 'Vui lòng nhập mã sản phẩm',
            'thumbnail.required' => 'Vui lòng thêm hình ảnh',
            'category.required' => 'Chọn hình ảnh',
            'classifyName.*.required' => 'Vui lòng nhập tên phân loại',
            'price.*.required' => 'Vui lòng nhập giá sản phẩm',
            'price.*.numeric' => 'Sai định dạng số',
            'sale_price.*.numeric' => 'Sai định dạng số',
            'amount.*.numeric' => 'Sai định dạng số',
            'amount.*.required' => 'Vui lòng nhập số lượng sản phẩm',
        ]);

        $product = Product::findOrFail($id);
        $product->name = $request->get('name');
        $product->code = $request->get('code');
        $product->thumbnail = $request->get('thumbnail');
        $product->category_id = $request->get('category');
        $product->description = $request->get('description');
        $product->status = 1;
        $product->update();

        $classifyName = $request->get('classifyName');
        $classifyPrice = $request->get('price');
        $classifySale = $request->get('sale_price');
        $classifyAmount = $request->get('amount');

        ProductClassify::where('product_id', $id)->delete();

        foreach ($classifyName as $key => $val) {
            $classify = new ProductClassify();
            $classify->product_id = $product->id;
            $classify->name = $val;
            $classify->price = $classifyPrice[$key];
            $classify->sale_price = $classifySale[$key];
            $classify->amount = $classifyAmount[$key];
            $classify->status = 1;
            $classify->save();
        }


        return redirect()->route('product.index')->with('success', 'Cập nhật sản phẩm thành công');
    }

    public function delete(Request $request)
    {
        if(!$request->get('listProduct')) {
            return response()->json([
                'success' => false,
                'message' => 'Vui lòng chọn sản phẩm cần xóa'
            ]);
        }

        Product::whereIn('id', $request->get('listProduct'))->delete();

        return response()->json([
            'success' => true,
            'message' => 'Xóa sản phẩm thành công'
        ]);
    }

    public function classify()
    {
        $html = view('admin.product._classify')->render();

        return response()->json([
            'success' => true,
            'data' => $html
        ]);
    }
}
