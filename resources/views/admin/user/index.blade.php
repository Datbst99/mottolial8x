@extends('layouts.admin')
@section('title', 'Quản lý user')
@section('content')
    <div class="page-header">
        <h3 class="page-title"> Quản lý user </h3>
        {{Breadcrumbs::render('admin.user')}}
    </div>
    <div class="card">
        <div class="card-body">
            <div class="card-title">Filters</div>
            <div>
                {!! Form::open(['method' => 'get']) !!}
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
                        <input type="text" class="form-control" placeholder="Nhập tên người dùng..." value="{{request()->get('search')}}" name="search">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-fw">Tìm kiếm</button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <div class="card mt-4">
       <div class="card-body">
           <div class="d-flex justify-content-between">
               <div class="btn-rounded-default">
                   {{$countUser}} thành viên
               </div>
               <div>
                   <div class="dropdown">
                       <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Action </button>
                       <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1" style="">
                           <button type="button" class="dropdown-item px-3 d-flex align-items-center" data-toggle="modal" data-target=".add-user"><i class="mdi mdi-account-plus mr-2"></i> Thêm user </button>
                           <a class="dropdown-item px-3 d-flex align-items-center" href="#"> <i class="mdi mdi-delete mr-2"></i> Xóa thành viên </a>
                           <a class="dropdown-item" href="#">Something else here</a>
                       </div>
                   </div>
               </div>
           </div>
           <div class="table-responsive mt-3">
               <table class="table">
                   <thead>
                   <tr>
                       <th>
                           <input type="checkbox" class="">
                       </th>
                       <th>Tên </th>
                       <th>Số điện thoại</th>
                       <th>Điểm tích lũy</th>
                       <th>Địa chỉ</th>
                       <th>Đăng nhập gần nhất</th>
                       <th>Ngày tạo</th>
                       <th style="width: 10px">Action</th>
                   </tr>
                   </thead>
                   <tbody>
                   @foreach($users as $user)
                        <tr>
                            <td>
                                <input type="checkbox" class="">
                            </td>
                            <td class="text-nowrap">
                                {{$user->name}}
                            </td>
                            <td class="text-nowrap">{{$user->phone}}</td>
                            <td class="text-nowrap">{{$user->reward_point}}</td>
                            <td class="text-nowrap">{{$user->detail_address}}</td>
                            <td class="text-nowrap">{{$user->last_login}}</td>
                            <td class="text-nowrap">{{$user->created_at}}</td>
                            <td class="text-center"><i class="mdi mdi-border-color"></i></td>
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
        <div class="modal-dialog">
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
                            <label for="password">Mật khẩu</label>
                            <input type="text" class="form-control" id="password" placeholder="Nhập mật khẩu" name="password">
                        </div>
                        <div class="form-group">
                            <label for="address">Địa chỉ</label>
                            <textarea name="address" id="address" class="form-control" rows="10" placeholder="Nhập địa chỉ"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="role">Chọn vai trò</label>
                            <div class="d-flex justify-content-between">
                                @foreach(config('core.roles') as $key => $role)
                                    <div class="form-check my-0 mr-5">
                                        <label class="form-check-label">
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
@endsection
