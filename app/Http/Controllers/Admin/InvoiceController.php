<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductClassify;
use App\Models\Promotion;
use App\Models\User;
use Illuminate\Http\Request;
use function Doctrine\Common\Cache\Psr6\get;

class InvoiceController extends Controller
{
    public function index(Request $request)
    {
        $invoices = Invoice::query();
        $search = $request->get('search');
        $status = $request->get('status');
        if($search) {
            $invoices = $invoices->where('code', $search)
                ->orWhereHas('user', function ($query) use ($search){
                    $query->where('phone', 'LIKE', '%'. $search . '%')
                        ->orWhere('name', 'LIKE', '%'. $search . '%');
            });
        }

        if($status) {
            $invoices = $invoices->where('status', $status);
        }

        $invoices = $invoices->orderByDesc('created_at')->paginate(15)->appends($request->all());

        return view('admin.invoice.index', compact('invoices'));
    }

    public function create()
    {

        $users = User::pluck('name', 'id')->toArray();

        return view('admin.invoice.create', compact('users'));
    }

    public function detail($id)
    {
        $invoice = Invoice::findOrFail($id);

        $html = view('admin.invoice._detail', compact('invoice'))->render();

        return response()->json([
            'success' => true,
            'data' => $html
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user' => 'required',
            'classify' => 'required',
        ], [
           'user.required' => 'Vui lòng chọn khách hàng',
           'classify.required' => 'Vui lòng chọn sản phẩm',
        ]);

        $products = $request->get('classify');
        $amount = $request->get('amount');
        $price = $request->get('price');
        $sale = $request->get('sale_price');

        $invoice = new Invoice();
        $invoice->user_id = $request->get('user');
        $invoice->code = Invoice::createCode();
        $invoice->save();
        $total = 0;
        foreach ($products as $key => $product) {
            $order = new Order();
            $order->user_id = $request->get('user');
            $order->invoice_id = $invoice->id;
            $order->product_id = $key;
            $order->classify_id = $product;
            $order->amount = $amount[$key];
            $order->price = $sale[$key] ?? $price[$key];
            $p = $amount[$key] * ($sale[$key] ?? $price[$key]);
            $total += $p;
            $order->total = $p;
            $order->point = rewardPoint($p);
            $order->save();
        }

        $invoice->total = $total;
        $invoice->update();

        return redirect()->route('invoice.index')->with('success', 'Tạo đơn hàng mới thành công');
    }

    public function change($id, $status)
    {
        $invoice = Invoice::findOrFail($id);

        if($status == Invoice::STATUS_TRANSPORT) {
            $invoice->status = Invoice::STATUS_TRANSPORT;
        }

        if($status ==  Invoice::STATUS_PAID) {
            $user = User::find($invoice->user_id);
            $user->reward_point =  $user->reward_point + rewardPoint($invoice->total);
            $user->save();
            $invoice->status = Invoice::STATUS_PAID;
        }
        $invoice->save();
        return redirect()->back()->with('success', 'Cập nhật trạng thái đơn hàng thành công');
    }

    public function delete(Request $request)
    {
        if(!$request->get('listInvoice')) {
            return response()->json([
                'success' => false,
                'message' => 'Vui lòng chọn đơn hàng cần xóa'
            ]);
        }

        Invoice::whereIn('id', $request->get('listInvoice'))->where('status', Invoice::STATUS_PENDING)->delete();
        return response()->json([
            'success' => true,
            'message' => 'Xóa đơn hàng thành công'
        ]);
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
        $product = Product::findOrFail( $request->get('id'));
        $classifies = ProductClassify::where('product_id', $product->id)->get();

        $html = view('admin.invoice._classify', compact('classifies', 'product'))->render();

        return response()->json([
            'success' => true,
            'data' => $html
        ]);
    }

    public function searchUser(Request $request)
    {
        $search = $request->get('search');
        $users = User::where('name', 'LIKE', '%'. $search . '%')
                    ->orWhere('email', 'LIKE', '%'. $search . '%')
                    ->orWhere('phone', 'LIKE', '%'. $search . '%')
                    ->get();

        $html = view('admin.invoice._list_user', compact('users'))->render();

        return response()->json([
            'success' => true,
            'data' => $html
        ]);
    }

    public function searchProduct(Request $request)
    {
        $search = $request->get('search');

        $products = Product::where('name', 'LIKE', '%'. $search . '%')
            ->orWhere('code', 'LIKE', '%'. $search . '%')
            ->get();

        $html = view('admin.invoice._search_product', compact('products'))->render();

        return response()->json([
            'success' => true,
            'data' => $html
        ]);
    }
}
