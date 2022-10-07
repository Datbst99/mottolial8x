<div class="row">
    <div class="col-md-6">
        <div class="information-user">
            <div class="text-show">
                Điện thoại:
            </div>
            <div class="text-user">
                {{ isset($user) ? $user->phone : ''}}
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="information-user">
            <div class="text-show">
                Tên:
            </div>
            <div class="text-user">
                {{ isset($user) ? $user->name : ''}}
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="information-user">
            <div class="text-show">
                Tỉnh/Quận-Huyện/Phường-Xã:
            </div>
            <div class="text-user">
                {{ isset($user) ? $user->address : ''}}
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="information-user">
            <div class="text-show">
                Địa chỉ:
            </div>
            <div class="text-user">
                {{ isset($user) ? $user->detail_address : ''}}
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="information-user">
            <div class="text-show">
                Điểm tích lũy:
            </div>
            <div class="text-user">
                {{ isset($user) ? $user->reward_point : ''}}
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="information-user">
            <div class="text-show">
                Khuyến mại:
            </div>
            <div class="text-user">
                {!! isset($user) ? $user->promotionUser() : '' !!}
            </div>
        </div>
    </div>
    <input type="text" name="user" value="{{ isset($user) ? $user->id : '' }}" class="d-none">
</div>
