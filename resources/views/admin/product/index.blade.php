@extends('layouts.admin')
@section('title', 'Quản lý sản phẩm')
@section('content')
    <div class="page-header">
        <h3 class="page-title"> Quản lý sản phẩm </h3>
        {{Breadcrumbs::render('admin.product')}}
    </div>
    <div class="card">
        <div class="card-body">
            <div class="card-title">Filters</div>
            <div>
                {!! Form::open(['method' => 'get']) !!}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <button class="btn btn-sm btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</button>
                                    <div class="dropdown-menu" style="">
                                        <a class="dropdown-item" href="#">Action</a>
                                        <a class="dropdown-item" href="#">Another action</a>
                                        <a class="dropdown-item" href="#">Something else here</a>
                                        <div role="separator" class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">Separated link</a>
                                    </div>
                                </div>
                                <input type="text" class="form-control" placeholder="Nhập tên sản phẩm..." value="{{request()->get('search')}}" name="search">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::select('category', $categories, null, ['class' => 'form-control', 'placeholder' => '--Chọn danh mục--']) !!}
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-fw">Tìm kiếm</button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <div class="card mt-4">
        <div class="card-body">
            <div class="d-flex justify-content-end mb-3">
                <a  class="btn btn-primary btn-fw d-flex align-items-center" href="{{route('product.create')}}"> <i class="mdi mdi-plus"></i> Thêm sản phẩm</a>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th>
                            <input type="checkbox" class="">
                        </th>
                        <th>Thumbnail</th>
                        <th>Tên sản phẩm </th>
                        <th>Phân loại</th>
                        <th>Số lượng</th>
                        <th>Giá</th>
                        <th>Giá khuyến mại</th>
                        <th>Mã sản phẩm</th>
                        <th>Người tạo</th>
                        <th>Ngày tạo</th>
                        <th style="width: 10px">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td><input type="checkbox" class=""></td>
                                <td class="text-nowrap">
                                    <img src="{{$product->thumbnail}}" alt="{{$product->name}}" style="width: 100px; height: 100px">
                                </td>
                                <td class="text-nowrap">{{$product->name}}</td>
                                <td class="text-nowrap">{{$product->classifyName()}}</td>
                                <td class="text-nowrap">{{$product->classifyAmount()}}</td>
                                <td class="text-nowrap">{{$product->classifyPrice()}} đ</td>
                                <td class="text-nowrap">{{$product->classifySalePrice()}} đ</td>
                                <td class="text-nowrap">{{$product->code}}</td>
                                <td class="text-nowrap">{{$product->createBy()}}</td>
                                <td class="text-nowrap">{{$product->created_at}}</td>
                                <td class="text-center"><i class="mdi mdi-border-color"></i></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="custom-paginate d-flex justify-content-end mt-3">
                {{$products->links()}}
            </div>
        </div>
    </div>

@endsection
