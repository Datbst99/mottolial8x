<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users  = User::query();
        if($request->get('search')) {
            $users = $users->where('name', 'LIKE', '%'.$request->get('search').'%');
        }

        $users = $users->orderByDesc('last_access')->paginate(15);

        $countUser = User::count();
        return view('admin.user.index', compact('users', 'countUser'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'username' => 'required',
            'phone' => 'required|numeric|unique:users',
            'password' => 'required|min:6',
            'address' => 'required',
            'role' => 'required',
        ],[
            'username.required' => 'Vui lòng nhập tên user',
            'phone.required' => 'Vui lòng nhập số điện thoại',
            'phone.numeric' => 'Sai định dạng chữ số',
            'phone.unique' => 'Số điện thoại đã tồn tại',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'password.min' => 'Số ký tự nhập phải lớn hơn 6',
            'address.required' => 'Vui lòng nhập địa chỉ',
            'role.required' => 'Vui lòng chọn vai trò',
        ]);


        $user = new User();
        $user->name = $request->get('username');
        $user->phone = $request->get('phone');
        $user->detail_address = $request->get('detail_address');
        $user->password = Hash::make($request->get('password'));
        $user->save();

        $user->assignRole($request->get('role'));


        return redirect()->back()->with('success', 'Thêm user thành công');
    }
}
