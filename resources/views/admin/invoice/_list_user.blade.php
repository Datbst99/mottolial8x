<div class="border mt-3 p-3">
    @if(count($users) > 0)
        @foreach($users as $user)

            <div class="d-flex justify-content-between mb-2 align-items-center">
                <div class="user-name" style="width: 40%">
                    {{$user->name}}
                </div>
                <div class="phone" style="width: 20%">{{$user->phone}}</div>
                <div class="address" style="width: 35%">{{$user->address}}</div>
                <div>
                    <button class="btn btn-primary " onclick="getUser(this, {{$user->id}})">Chọn</button>
                </div>
            </div>
        @endforeach
    @else
        <div class="alert alert-warning m-0" role="alert">
            Không tìm thấy khách hàng. Vui lòng tạo mới khách hàng nếu không tìm thấy
        </div>
    @endif
</div>
