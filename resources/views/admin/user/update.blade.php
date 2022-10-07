@extends('layouts.admin')
@section('title', 'Cập nhật thông tin khách hàng')
@section('content')
    <div class="container">
        <div class="page-header">
            <h3 class="page-title"> Cập nhật thông tin khách hàng </h3>
            {{Breadcrumbs::render('admin.user.update')}}
        </div>
        <div class="card">
            <div class="card-body">
                <form action="{{route('admin.user.update', ['id' => $user->id])}}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="username">Tên khách hàng<span class="text-danger">(*)</span></label>
                            <input type="text" class="form-control" id="username" placeholder="Nhập tên user" name="username" value="{{$user->name}}">
                        </div>
                        <div class="form-group">
                            <label for="phone">Số điện thoại<span class="text-danger">(*)</span></label>
                            <input type="text" class="form-control" id="phone" placeholder="Nhập số điện thoại" name="phone" value="{{$user->phone}}">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" id="email" placeholder="Nhập email" name="email" value="{{$user->email}}">
                        </div>
                        <div class="form-group">
                            <label for="password">Mật khẩu<span class="text-danger">(*)</span></label>
                            <input type="text" class="form-control" id="password" placeholder="Nhập mật khẩu" name="password" >
                        </div>
                        <div class="form-group">
                            <label for="address">Tỉnh/Quận-Huyện/Phường-Xã</label>
                            <div class="row">
                                <div class="col-md-4">
                                    <select class="form-control ls_province" name="province"></select>
                                </div>
                                <div class="col-md-4">
                                    <select class="form-control ls_district" name="district"></select>
                                </div>
                                <div class="col-md-4">
                                    <select class="form-control ls_ward" name="ward"></select>
                                </div>
                            </div>

                        </div>
                        <div class="form-group">
                            <label for="address">Địa chỉ<span class="text-danger">(*)</span></label>
                            <textarea name="address" id="address" class="form-control" rows="10" placeholder="Nhập địa chỉ" >{{$user->detail_address}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="reward_point">Điểm tích lũy</label>
                            <input type="number" name="reward_point" id="reward_point" class="form-control" placeholder="Nhập điểm tích lũy" value="{{$user->reward_point}}" />
                        </div>
                        <div class="form-group">
                            <label for="role">Chọn vai trò<span class="text-danger">(*)</span></label>
                            <div class="d-flex justify-content-between">
                                @foreach(config('core.roles') as $key => $role)
                                    <div class="form-check my-0 mr-5">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="role" id="" value="{{$key}}" @if($user->hasRole($key)) checked @endif> {{$role}} <i class="input-helper"></i></label>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Cập nhật</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@stop
@section('script')
    {!! Html::script(mix('js/vietnamlocalselector.js')) !!}
    <script>
        LocalPicker()
    </script>
@stop
