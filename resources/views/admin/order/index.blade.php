@extends('layouts.admin')
@section('title', 'Đơn đặt hàng landing')
@section('content')
    <div class="page-header">
        <h3 class="page-title"> Đơn đặt hàng landing </h3>
        {{Breadcrumbs::render('admin.order')}}
    </div>
    <div class="card mt-4">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Tên</th>
                        <th>Số điện thoại</th>
                        <th>Giá sale</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Màu</th>
                        <th>Size</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td class="text-nowrap">{{$order->username}}</td>
                            <td class="text-nowrap">{{$order->phone}}</td>
                            <td class="text-nowrap">{{number_format($order->sale)}}đ</td>
                            <td class="text-nowrap">{{number_format($order->price)}}đ</td>
                            <td class="text-nowrap">{{$order->amount}}</td>
                            <td class="text-nowrap">{{$order->color}}</td>
                            <td class="text-nowrap">{{$order->size}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
    <div class="custom-paginate d-flex justify-content-end mt-3">
        {{$orders->links()}}
    </div>
@endsection

