<?php

namespace App\Http\Controllers;

use App\Models\OrderLanding;
use App\Models\Product;
use App\Models\ProductClassify;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        abort(404);
//        return view('home');
    }


    public function detail($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();


        return view('client.detail', compact('product'));
    }

    public function order(Request $request)
    {
        $classify = ProductClassify::find($request->get('classify'));
        $newOrder = new OrderLanding();
        $newOrder->username = $request->get('name');
        $newOrder->product_id = $classify->product_id;
        $newOrder->price = $classify->price;
        $newOrder->sale = $classify->sale_price;
        $newOrder->phone = $request->get('phone');
        $newOrder->amount = $request->get('amount');
        $newOrder->size = $request->get('size');
        $newOrder->color = $request->get('color');
        $newOrder->color = $request->get('color');
        $newOrder->save();

        return redirect()->back()->with('success', 'Đặt hàng thành công');
    }
}
