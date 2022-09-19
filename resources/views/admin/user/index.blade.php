@extends('layouts.admin')
@section('title', 'Quản lý khách hàng')
@section('content')
    <div class="page-header">
        <h3 class="page-title"> Quản lý khách hàng </h3>
        {{Breadcrumbs::render('admin.user')}}
    </div>
    <div class="card">
        <div class="card-body">
            <div class="card-title">Filters</div>
            <div>
                {!! Form::open(['method' => 'get']) !!}

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Nhập tên người dùng hoặc số điện thoại..." value="{{request()->get('search')}}" name="search">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <select name="ls_province" class="form-control"></select>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-fw d-flex align-items-center justify-content-center"> <i class="mdi mdi-account-search" style="font-size: 18px"></i> Tìm kiếm</button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <div class="card mt-4">
       <div class="card-body">
           <div class="d-flex justify-content-between">
               <div class="btn-rounded-default" style="font-weight: 500">
                   {{$countUser}} thành viên
               </div>
               <div>
                   <div class="dropdown">
                       <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Hành động </button>
                       <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1" style="">
                           <button type="button" class="dropdown-item px-3 d-flex align-items-center" data-toggle="modal" data-target=".add-user"><i class="mdi mdi-account-plus mr-2"></i> Thêm khách hàng </button>
                           <button type="button" class="dropdown-item px-3 d-flex align-items-center" onclick="deleteUser()"><i class="mdi mdi-delete mr-2"></i> Xóa thành viên </button>

                       </div>
                   </div>
               </div>
           </div>
           <div class="table-responsive mt-3">
               <table class="table">
                   <thead>
                   <tr>
                       <th>
                           <input type="checkbox" class="" id="checkAll">
                       </th>
                       <th>Tên </th>
                       <th>Số điện thoại</th>
                       <th>Điểm tích lũy</th>
                       <th>Tỉnh/Quận-Huyện/Phường-Xã</th>
                       <th>Địa chỉ</th>
                       <th>Truy cập gần nhất</th>
                       <th>Ngày tạo</th>
                       <th style="width: 10px">Hành động</th>
                   </tr>
                   </thead>
                   <tbody>
                   @foreach($users as $user)
                        <tr>
                            <td>
                                <input type="checkbox" class="item-user" value="{{$user->id}}">
                            </td>
                            <td class="text-nowrap">
                                {{$user->name}}
                            </td>
                            <td class="text-nowrap">{{$user->phone}}</td>
                            <td class="text-nowrap">{{$user->reward_point}}</td>
                            <td class="text-nowrap">{{$user->address}}</td>
                            <td class="text-nowrap">{{$user->detail_address}}</td>
                            <td class="text-nowrap">{{$user->last_access}}</td>
                            <td class="text-nowrap">{{$user->created_at}}</td>
                            <td class="text-center cursor-pointer" onclick="updateUser({{$user->id}})"><i class="mdi mdi-border-color"></i></td>
                        </tr>
                   @endforeach
                   </tbody>
               </table>
           </div>

           <div class="custom-paginate d-flex justify-content-end mt-3">
               {{$users->links()}}
           </div>
       </div>
    </div>


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

    <div id="update-user">

    </div>
@endsection

@section('script')
    {!! Html::script(mix('js/notification.js')) !!}
    {!! Html::script(mix('js/vietnamlocalselector.js')) !!}
    <script>
        $(document).ready(function () {
            $("#checkAll").click(function() {
                $(".item-user").prop("checked", this.checked);
            });

            $('.item-user').click(function() {
                if ($('.item-user:checked').length == $('.item-user').length) {
                    $('#checkAll').prop('checked', true);
                } else {
                    $('#checkAll').prop('checked', false);
                }
            });
        })

        function updateUser(id) {
            $.ajax({
                url: '/admin/user/form-update',
                method: 'get',
                data: {
                    id
                }
            }).done(function (res) {
                $('#update-user').html(res.data)
                $('.update-user').modal('show')
            }).fail(function (xhr) {

            })
        }

        function deleteUser() {
            var listUser = $('.item-user:checked').map(function () {
                return $(this).val()
            }).get()

            $.ajax({
                url: '/admin/user/delete',
                method: 'post',
                data: {
                    listUser: listUser,
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

        var localpicker = new LocalPicker({
            province: "ls_province",
            district: "ls_district",
            ward: "ls_ward"
        });
    </script>
@stop
