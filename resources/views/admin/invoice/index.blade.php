@extends('layouts.admin')
@section('title', 'Quản lý đặt hàng')
@section('content')
    <div class="page-header">
        <h3 class="page-title"> Quản lý đặt hàng </h3>
        {{Breadcrumbs::render('admin.invoice')}}
    </div>
    <div class="card">
        <div class="card-body">
            <div class="card-title">Filters</div>
            <div>
                {!! Form::open(['method' => 'get']) !!}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Nhập tên khách hàng, số điện thoại hoặc mã đơn hàng..." value="{{request()->get('search')}}" name="search">
                        </div>
                    </div>
                    <div class="col-md-6">
{{--                        <div class="form-group">--}}
{{--                            {!! Form::select('category', $categories, null, ['class' => 'form-control', 'placeholder' => '--Chọn danh mục--']) !!}--}}
{{--                        </div>--}}
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-fw d-flex align-items-center justify-content-center"> <i class="mdi mdi-magnify" style="font-size: 18px"></i> Tìm kiếm</button>
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
                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Action </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1" style="">
                                <a  class="dropdown-item px-3 d-flex align-items-center" href="{{route('invoice.create')}}"> <i class="mdi mdi-plus mr-2"></i> Tạo đơn mới</a>
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
                        <th>Mã đơn hàng</th>
                        <th>Hình ảnh</th>
                        <th>Tên khách hàng</th>
                        <th>Tổng đơn hàng</th>
                        <th>Trạng thái</th>
                        <th>Người tạo đơn hàng</th>
                        <th>Ngày đặt</th>
                        <th style="width: 10px">Action</th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
            <div class="custom-paginate d-flex justify-content-end mt-3">
{{--                {{$products->links()}}--}}
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
    </script>
@stop

