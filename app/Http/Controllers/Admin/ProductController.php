<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductClassify;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index()
    {
        $categories = Category::orderBy('index')
            ->pluck('title', 'id')
            ->toArray();

        return view('admin.product.index', compact('categories'));
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
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
