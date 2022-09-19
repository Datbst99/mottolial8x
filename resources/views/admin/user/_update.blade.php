<div class="modal fade update-user" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cập nhật user</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('admin.user.update', ['id' => $user->id])}}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="username">Tên user</label>
                        <input type="text" class="form-control" id="username" placeholder="Nhập tên user" name="username" value="{{$user->name}}">
                    </div>
                    <div class="form-group">
                        <label for="phone">Số điện thoại</label>
                        <input type="text" class="form-control" id="phone" placeholder="Nhập số điện thoại" name="phone" value="{{$user->phone}}">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" id="email" placeholder="Nhập email" name="email" value="{{$user->email}}">
                    </div>
                    <div class="form-group">
                        <label for="password">Mật khẩu</label>
                        <input type="text" class="form-control" id="password" placeholder="Nhập mật khẩu" name="password" >
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
                        <textarea name="address" id="address" class="form-control" rows="10" placeholder="Nhập địa chỉ" >{{$user->detail_address}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="role">Chọn vai trò</label>
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
