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
                <button type="button" class="btn btn-primary btn-fw d-flex align-items-center" data-toggle="modal" data-target=".add-category"> <i class="mdi mdi-plus"></i> Thêm danh mục</button>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th>
                            <input type="checkbox" class="">
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
                                    <input type="checkbox" class="">
                                </td>
                                <td class="text-nowrap">{{$category->title}}</td>
                                <td class="text-nowrap">{{$category->index}}</td>
                                <td class="text-nowrap">{{$category->countProduct()}}</td>
                                <td class="text-nowrap">{{$category->createBy()}}</td>
                                <td class="text-nowrap">{{$category->created_at}}</td>
                                <td class="text-center"><i class="mdi mdi-border-color"></i></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>


    {{--    Modal add user--}}

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
@endsection
