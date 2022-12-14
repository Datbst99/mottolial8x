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
        $search = $request->get('search');
        if($search) {
            $users = $users->where('name', 'LIKE', '%'.$search.'%')
                            ->orWhere('phone', 'LIKE', '%'.$search.'%');
        }
        $users = $users->orderByDesc('last_access')->paginate(15);

        $countUser = User::count();
        return view('admin.user.index', compact('users', 'countUser'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'username' => 'required',
            'phone' => 'required|numeric|unique:users|min:10',
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
        $user->email = $request->get('email');
        $user->phone = $request->get('phone');
        $user->address = $request->get('province'). ', ' . $request->get('district') . ', '. $request->get('ward');
        $user->detail_address = $request->get('address');
        $user->reward_point = $request->get('reward_point');
        $user->password = Hash::make($request->get('password'));
        $user->save();

        $user->assignRole($request->get('role'));


        return redirect()->back()->with('success', 'Thêm user thành công');
    }

    public function update($id, Request $request)
    {
        $user = User::findOrFail($id);

        if($request->isMethod('post')) {
            $request->validate([
                'username' => 'required',
                'phone' => 'required|numeric|min:10',
                'password' => 'nullable|min:6',
                'address' => 'required',
                'role' => 'required',
            ],[
                'username.required' => 'Vui lòng nhập tên user',
                'phone.required' => 'Vui lòng nhập số điện thoại',
                'phone.numeric' => 'Sai định dạng chữ số',
                'password.min' => 'Số ký tự nhập phải lớn hơn 6',
                'address.required' => 'Vui lòng nhập địa chỉ',
                'role.required' => 'Vui lòng chọn vai trò',
            ]);

            $user->name = $request->get('username');
            $user->email = $request->get('email');
            $user->phone = $request->get('phone');
            $user->reward_point = $request->get('reward_point');
            if($request->get('province')) {
                $user->address = $request->get('province'). ', ' . $request->get('district') . ', '. $request->get('ward');
            }
            $user->detail_address = $request->get('address');
            if($request->get('password')){
                $user->password = Hash::make($request->get('password'));
            }
            $user->save();

            $user->assignRole($request->get('role'));
            return redirect()->route('admin.user')->with('success', 'Cập nhật thông tin khách hàng thành công');
        }

        return view('admin.user.update', compact('user'));
    }

    public function delete(Request $request)
    {

        if(!$request->get('listUser')) {
            return response()->json([
                'success' => false,
                'message' => 'Vui lòng chọn khách hàng cần xóa'
            ]);
        }

        User::whereIn('id', $request->get('listUser'))->delete();

        return response()->json([
            'success' => true,
            'message' => 'Xóa user thành công'
        ]);
    }

    public function formUpdate(Request $request)
    {
        $user = User::find($request->get('id'));

        $html = view('admin.user._update', compact('user'))->render();

        return response()->json([
            'success' => true,
            'data' => $html
        ]);
    }

}
