<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderLanding;
use Illuminate\Http\Request;

class OrderLandingController extends Controller
{
    public function index()
    {
        $orders = OrderLanding::paginate(15);
        return view('admin.order.index', compact('orders'));
    }
}
