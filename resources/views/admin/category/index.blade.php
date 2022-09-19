@extends('layouts.admin')
@section('title', 'Quản lý danh mục')
@section('content')
    <div class="page-header">
        <h3 class="page-title"> Quản lý danh mục </h3>
        {{Breadcrumbs::render('admin.category')}}
    </div>

    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-end mb-3">
                <div>
                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Hành động </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1" style="">
                            <button type="button" class="dropdown-item px-3 d-flex align-items-center" data-toggle="modal" data-target=".add-category"> <i class="mdi mdi-plus mr-2"></i> Thêm danh mục</button>
                            <button type="button" class="dropdown-item px-3 d-flex align-items-center" onclick="deleteCategory()"><i class="mdi mdi-delete mr-2"></i> Xóa danh mục</button>

                        </div>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th>
                            <input type="checkbox" class=""  id="checkAll">
                        </th>
                        <th>Tên </th>
                        <th>Thứ tự</th>
                        <th>Số lượng sản phẩm</th>
                        <th>Người tạo</th>
                        <th>Ngày tạo</th>
                        <th style="width: 10px">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td>
                                    <input type="checkbox" class="{{ $category->countProduct() > 0 ? '' :'item-cate' }}" value="{{$category->id}}" @if($category->countProduct() > 0) disabled @endif>
                                </td>
                                <td class="text-nowrap">{{$category->title}}</td>
                                <td class="text-nowrap">{{$category->index}}</td>
                                <td class="text-nowrap">{{$category->countProduct()}}</td>
                                <td class="text-nowrap">{{$category->createBy()}}</td>
                                <td class="text-nowrap">{{$category->created_at}}</td>
                                <td class="text-center cursor-pointer" onclick="updateCate({{$category->id}})"><i class="mdi mdi-border-color"></i></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>


    <div class="modal fade add-category" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Thêm danh mục</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('category.store')}}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="title">Tên danh mục</label>
                            <input type="text" class="form-control" id="title" placeholder="Nhập tên danh mục" name="title">
                        </div>
                        <div class="form-group">
                            <label for="index">Số thứ tự</label>
                            <input type="text" class="form-control" id="index" placeholder="Nhập số thứ tự" name="index">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Lưu</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div id="update-category">

    </div>
@endsection


@section('script')
    {!! Html::script(mix('js/notification.js')) !!}
    <script>
        $(document).ready(function () {
            $("#checkAll").click(function() {
                $(".item-cate").prop("checked", this.checked);
            });

            $('.item-cate').click(function() {
                if ($('.item-cate:checked').length == $('.item-cate').length) {
                    $('#checkAll').prop('checked', true);
                } else {
                    $('#checkAll').prop('checked', false);
                }
            });
        })

        function updateCate(id) {
            $.ajax({
                url: '/admin/category/form/update',
                method: 'get',
                data: {
                    id
                }
            }).done(function (res) {
                $('#update-category').html(res.data)
                $('.update-category').modal('show')
            }).fail(function (xhr) {

            })
        }

        function deleteCategory() {
            var listCategory = $('.item-cate:checked').map(function () {
                return $(this).val()
            }).get()

            $.ajax({
                url: '/admin/category/delete',
                method: 'post',
                data: {
                    listCategory: listCategory,
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

