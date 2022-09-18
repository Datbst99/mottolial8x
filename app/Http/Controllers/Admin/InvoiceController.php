<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductClassify;
use App\Models\Promotion;
use App\Models\User;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index()
    {
        return view('admin.invoice.index');
    }

    public function create()
    {

        $users = User::pluck('name', 'id')->toArray();

        return view('admin.invoice.create', compact('users'));
    }

    public function user(Request $request)
    {
        $user = User::findOrFail($request->get('id'));

        $html = view('admin.invoice._info_user', compact('user'))->render();

        return response()->json([
            'success' => true,
            'data' => $html
        ]);
    }

    public function product(Request $request)
    {
        $product = Product::find($request->get('productId'));
        $classify = ProductClassify::find($request->get('classifyId'));

        if(!$product || !$classify) {
            return response()->json([
                'success' => false,
                'message' => 'Vui lòng chọn sản phẩm và phân loại sản phẩm'
            ]);
        }

        $html = view('admin.invoice._info_product', compact('product', 'classify'))->render();

        return response()->json([
            'success' => true,
            'data' => $html
        ]);
    }

    public function listProduct(Request $request)
    {
        $products = Product::get();

        $html = view('admin.invoice._list_product', compact('products'))->render();

        return response()->json([
            'success' => true,
            'data' => $html
        ]);
    }

    public function listClassify(Request $request)
    {
        $classifies = ProductClassify::where('product_id', $request->get('id'))->get();

        $html = view('admin.invoice._classify', compact('classifies'))->render();

        return response()->json([
            'success' => true,
            'data' => $html
        ]);
    }

}
