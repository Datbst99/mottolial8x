@extends('layouts.admin')
@section('title', 'Tạo đơn hàng')
@section('style')
    <link rel="stylesheet" href="/assets/vendors/select2/select2.min.css">
    <link rel="stylesheet" href="/assets/vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
@endsection
@section('content')
    <div class="page-header">
        <h3 class="page-title"> Tạo đơn hàng </h3>
        {{Breadcrumbs::render('admin.invoice.create')}}
    </div>
    <div class="card mb-3">
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <div class="card-title mb-3">Lựa chọn khách hàng</div>
                <button class="btn btn-primary ml-3 text-nowrap d-flex align-items-center"  data-toggle="modal" data-target=".add-user"><i class="mdi mdi-account-plus mr-2"></i> Tạo mới user</button>
            </div>
            <div>
                <div style="width: 100%">
                    <input type="text" name="search" class="form-control search" placeholder="Nhập tên, email hoặc số điện thoại...">
                </div>
            </div>
            <div id="show-user">

            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
        <div class="border-bottom mb-4">
            <div class="card-title">Thông tin khách hàng</div>
            <div id="info-user">
                @include('admin.invoice._info_user')
            </div>
        </div>
        <form action="{{route('product.store')}}" method="post">
            @csrf
            <div id="classify">

            </div>

            <div class="add-classify" onclick="addProduct()">
                <i class="mdi mdi-plus-circle-outline mr-2"></i> <span style="font-size: 18px"> Thêm sản phẩm cho đơn hàng</span>
            </div>
            <div class="border-top mt-5 pt-3">

                <div class="d-flex justify-content-between">
                    <span>Tổng cộng:</span>
                    <span class="mr-5">55</span>
                </div>
            </div>
        </form>

    </div>
    </div>
    <a href="{{route('product.index')}}" class="btn btn-secondary">Hủy</a>
    <button type="submit" class="btn btn-success">Hoàn thành</button>
    {{--    Modal add user--}}

    <div class="modal fade add-user" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" >
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Thêm user</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('admin.user.store')}}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="username">Tên user</label>
                            <input type="text" class="form-control" id="username" placeholder="Nhập tên user" name="username">
                        </div>
                        <div class="form-group">
                            <label for="phone">Số điện thoại</label>
                            <input type="text" class="form-control" id="phone" placeholder="Nhập số điện thoại" name="phone">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" id="email" placeholder="Nhập email" name="email">
                        </div>
                        <div class="form-group">
                            <label for="password">Mật khẩu</label>
                            <input type="text" class="form-control" id="password" placeholder="Nhập mật khẩu" name="password">
                        </div>
                        <div class="form-group">
                            <label for="address">Tỉnh/Quận-Huyện/Phường-Xã</label>
                            <div class="row">
                                <div class="col-md-4">
                                    <select class="form-control" name="ls_province"></select>
                                </div>
                                <div class="col-md-4">
                                    <select class="form-control" name="ls_district"></select>
                                </div>
                                <div class="col-md-4">
                                    <select class="form-control" name="ls_ward"></select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="address">Địa chỉ</label>
                            <textarea name="address" id="address" class="form-control" rows="10" placeholder="Nhập địa chỉ"></textarea>
                        </div>
                        <div></div>
                        <div class="form-group">
                            <label for="role">Chọn vai trò</label>
                            <div class="d-flex justify-content-between">
                                @foreach(config('core.roles') as $key => $role)
                                    <div class="form-check my-0">
                                        <label class="form-check-label text-nowrap">
                                            <input type="radio" class="form-check-input" name="role" id="" value="{{$key}}" @if($key == 'user') checked @endif> {{$role}} <i class="input-helper"></i></label>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Lưu</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="modal-add-product">

    </div>
@endsection

@section('script')
    {!! Html::script('/assets/vendors/ckfinder/ckfinder.js') !!}
    {!! Html::script(mix('js/vietnamlocalselector.js')) !!}
    <script src="/assets/vendors/select2/select2.min.js"></script>
    {!! Html::script(mix('js/notification.js')) !!}
    <script>
        $(document).ready(function () {
            $('.search').change(function () {
                $.ajax({
                    url: '/admin/invoice/search/user',
                    method: 'get',
                    data: {
                        search: $(this).val()
                    }
                }).done(function (res) {
                    $('#show-user').html(res.data)
                })
            })


        })

        function getUser(obj, id) {
            $.ajax({
                url: '/admin/invoice/user',
                method: 'get',
                data: {
                    id
                }
            }).done(function (res) {
                $('#info-user').html(res.data)
                $('#show-user').html('')
                $('.search').val('')
            })
        }
        function searchProduct(obj) {
            let search = $(obj).val()
            $.ajax({
                url: '/admin/invoice/search/product',
                method: 'get',
                data: {
                    search
                }
            }).done(function (res) {
                $('#show-search-product').html(res.data)
            })
        }



        function addProduct() {
            $.ajax({
                url: '/admin/invoice/list/product',
                method: 'post',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                }
            }).done(function (res) {
                $('#modal-add-product').html(res.data)
                $('.select-product').select2();
                $('.list-product').modal('show')
            }).fail(function (xhr) {
                console.log(xhr)
            })
        }
        function renderClassify(id) {
            $.ajax({
                url: '/admin/invoice/list/classify',
                method: 'post',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    id: id
                }
            }).done(function (res) {
                $('#selectClassify').html(res.data)
            }).fail(function (xhr) {
                console.log(xhr)
            })
        }
        function loadProduct() {
            let productId = $(".select-product").val()
            let classifyId = $(".select-classify").val()
            $.ajax({
                url: '/admin/invoice/product',
                method: 'post',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    productId: productId,
                    classifyId: classifyId,
                }
            }).done(function (res) {
                if(res.success) {
                    $('#classify').append(res.data)
                    $('.list-product').modal('hide')
                }else {
                    notification(res.message, 'error')
                }
            }).fail(function (xhr) {
                console.log(xhr)
            })
        }

        function deleteItem(obj){
            var count = $('.delete-item').parent('.wp-classify').length
            if(count > 1) {
                $(obj).parent().remove()
            }
        }

        function configPrice(obj, type) {
            var amount = 1;
            var sale = 1;
            if(type === 'amount'){
                amount = $(obj).val()
            } else {
                amount = $(obj).parents('.wp-classify').find('.amount-product').val()
            }

            if(type === 'sale'){
                sale = $(obj).val()
            } else {
                sale = $(obj).parents('.wp-classify').find('.sale-price').val()
            }
            var total = new Intl.NumberFormat('en-US').format(amount * sale)
            $(obj).parents('.wp-classify').find('#total-price').html(total + ' đ')

        }

        var localpicker = new LocalPicker({
            province: "ls_province",
            district: "ls_district",
            ward: "ls_ward"
        });

    </script>
@stop
