@extends('layouts.admin')
@section('title', 'Quản lý sản phẩm')
@section('content')
    <div class="page-header">
        <h3 class="page-title"> Quản lý sản phẩm </h3>
        {{Breadcrumbs::render('admin.product')}}
    </div>
    <div class="card">
        <div class="card-body">
            <div>
                {!! Form::open(['method' => 'get']) !!}
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Nhập tên sản phẩm..." value="{{request()->get('search')}}" name="search">
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            {!! Form::select('category', $categories, null, ['class' => 'form-control', 'placeholder' => '--Chọn danh mục--']) !!}
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary btn-fw d-flex align-items-center justify-content-center"> <i class="mdi mdi-magnify" style="font-size: 18px"></i> Tìm kiếm</button>

                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <div class="card mt-4">
        <div class="card-body">
            <div class="d-flex justify-content-end mb-3">


                <div class="d-flex justify-content-end mb-3">
                    <div>
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Hành động </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1" style="">
                                <a  class="dropdown-item px-3 d-flex align-items-center" href="{{route('product.create')}}"> <i class="mdi mdi-plus mr-2"></i> Thêm sản phẩm</a>
                                <button type="button" class="dropdown-item px-3 d-flex align-items-center" onclick="deleteProduct()"><i class="mdi mdi-delete mr-2"></i> Xóa sản phẩm</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th>
                            <input type="checkbox" class="" id="checkAll">
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
                                <td><input type="checkbox" class="item-product" value="{{$product->id}}"></td>
                                <td class="text-nowrap">
                                    <img src="{{$product->thumbnail}}" alt="{{$product->name}}" style="width: 60px; height: 60px">
                                </td>
                                <td class="text-nowrap">{{$product->name}}</td>
                                <td class="text-nowrap">{{$product->classifyName()}}</td>
                                <td class="text-nowrap">{{$product->classifyAmount()}}</td>
                                <td class="text-nowrap">{{$product->classifyPrice()}} đ</td>
                                <td class="text-nowrap">{{$product->classifySalePrice()}} đ</td>
                                <td class="text-nowrap">{{$product->code}}</td>
                                <td class="text-nowrap">{{$product->createBy()}}</td>
                                <td class="text-nowrap">{{$product->created_at}}</td>
                                <td class="text-center">
                                    <span style="font-size: 22px; cursor: pointer" onclick="copyLink('{{route('detail', ['slug' => $product->slug])}}')"><i class="mdi mdi-link"></i></span>
                                    <a style="font-size: 18px" href="{{route('product.edit', ['id' => $product->id])}}"><i class="mdi mdi-border-color"></i></a>

                                </td>
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

@section('script')
    {!! Html::script(mix('js/notification.js')) !!}
    <script>
        $(document).ready(function () {
            $("#checkAll").click(function() {
                $(".item-product").prop("checked", this.checked);
            });

            $('.item-product').click(function() {
                if ($('.item-product:checked').length == $('.item-product').length) {
                    $('#checkAll').prop('checked', true);
                } else {
                    $('#checkAll').prop('checked', false);
                }
            });
        })


        function deleteProduct() {
            var listProduct = $('.item-product:checked').map(function () {
                return $(this).val()
            }).get()

            $.ajax({
                url: '/admin/product/delete',
                method: 'post',
                data: {
                    listProduct: listProduct,
                    _token: $('meta[name="csrf-token"]').attr('content')
                }
            }).done(function (res) {
                if(res.success) {
                    notification(res.message, 'success')
                    setTimeout(function () {
                        location.reload()
                    }, 1000)
                }else {
                    notification(res.message, 'error')
                }
            }).fail(function (xhr) {

            })
        }

        function copyLink(text) {

            // Copy the text inside the text field
            navigator.clipboard.writeText(text);
            notification('Sao chép link thành công', 'success')
        }
    </script>
@stop

