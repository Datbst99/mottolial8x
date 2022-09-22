<div class="border mt-3 p-3">
    @foreach($users as $user)

        <div class="d-flex justify-content-between mb-2">
            <div >
                <input type="radio" name="user">
            </div>
            <div class="user-name" style="width: 40%">
                {{$user->name}}
            </div>
            <div class="phone" style="width: 20%">{{$user->phone}}</div>
            <div class="address" style="width: 35%">{{$user->address}}</div>
        </div>
    @endforeach
</div>
