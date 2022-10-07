@extends('layouts.admin')
@section('title', 'Chương trình khuyến mại')
@section('content')
    <div class="page-header">
        <h3 class="page-title"> Chương trình khuyến mại </h3>
        {{Breadcrumbs::render('admin.promotion')}}
    </div>


    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between mb-3">
                <div>
                    Công thức quy đổi: <span>1.000 đồng</span> thành <span>1 điểm</span>
                </div>
                <div>
                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Hành động </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1" style="">
                            <button type="button" class="dropdown-item px-3 d-flex align-items-center" data-toggle="modal" data-target=".add-promotion"> <i class="mdi mdi-plus mr-2"></i> Thêm chương trình</button>
                            <button type="button" class="dropdown-item px-3 d-flex align-items-center" onclick="deletePromotion()"><i class="mdi mdi-delete mr-2"></i> Xóa chương trình</button>

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
                        <th>Điểm tích luỹ </th>
                        <th>Tên chương trình khuyến mãi</th>
                        <th>Nội dung khuyến mãi</th>
                        <th>Ngày tạo</th>
                        <th style="width: 10px">Hành động</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($promotions as $promotion)
                        <tr>
                            <td>
                                <input type="checkbox" class="item-promotion" value="{{$promotion->id}}">
                            </td>
                            <td class="text-nowrap">{{$promotion->reward_point}}</td>
                            <td class="text-nowrap">{{$promotion->title}}</td>
                            <td class="text-nowrap">{{$promotion->description}}</td>
                            <td class="text-nowrap">{{$promotion->created_at}}</td>
                            <td class="text-center cursor-pointer" onclick="updatePromotion({{$promotion->id}})"><i class="mdi mdi-border-color"></i></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <div class="modal fade add-promotion" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Thêm chương trình khuyễn mãi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('promotion.store')}}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="title">Tên chương trình khuyến mãi(*)</label>
                            <input type="text" class="form-control" id="title" placeholder="Nhập tên chương trình" name="title" value="{{old('title')}}">
                        </div>
                        <div class="form-group">
                            <label for="index">Điểm tích lũy(*)</label>
                            <input type="text" class="form-control" id="index" placeholder="Nhập điểm tích lũy" name="point" value="{{old('point')}}">
                        </div>
                        <div class="form-group">
                            <label for="description">Nội dung khuyến mãi(*)</label>
                            <input type="text" class="form-control" id="description" placeholder="Nhập nội dung khuyến mãi" name="description" value="{{old('description')}}">
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
    <div id="update-promotion">

    </div>
@endsection

@section('script')
    {!! Html::script(mix('js/notification.js')) !!}
    <script>
        $(document).ready(function () {
            $("#checkAll").click(function() {
                $(".item-promotion").prop("checked", this.checked);
            });

            $('.item-promotion').click(function() {
                if ($('.item-promotion:checked').length == $('.item-promotion').length) {
                    $('#checkAll').prop('checked', true);
                } else {
                    $('#checkAll').prop('checked', false);
                }
            });
        })

        function updatePromotion(id) {
            $.ajax({
                url: '/admin/promotion/form/update',
                method: 'get',
                data: {
                    id
                }
            }).done(function (res) {
                $('#update-promotion').html(res.data)
                $('.update-promotion').modal('show')
            }).fail(function (xhr) {

            })
        }

        function deletePromotion() {
            var listPromotion = $('.item-promotion:checked').map(function () {
                return $(this).val()
            }).get()

            $.ajax({
                url: '/admin/promotion/delete',
                method: 'post',
                data: {
                    listPromotion: listPromotion,
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
