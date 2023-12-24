<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public function show($id)
    {
        return User::findOrFail($id);
    }

    public function index()
    {
        $users = User::join('departments', 'users.department_id', '=', 'departments.id')
            ->join('users_status', 'users.status_id', '=', 'users_status.id')
            ->select('users.*', 'departments.name as department', 'users_status.name as status')
            ->paginate();

        return response()->json($users);
    }

    public function create()
    {
        $users_status = DB::table("users_status")->get();
        $departments = DB::table("departments")->get();

        return response()->json([
            "users_status" => $users_status,
            "departments" => $departments
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            "username" => "required|unique:users,username",
            "name" => "required",
            "email" => "required|email",
            "password" => "required|confirmed",
            "department_id" => "required",
            "status_id" => "required",
        ], [
            "username.required" => "Tên tài khoản không được để trống!",
            "username.unique" => "Tên tài khoản đã tồn tại!",

            "name.required" => "Họ tên không được để trống!",

            "email.required" => "Email không được để trống!",
            "email.email" => "Email không hợp lệ!",

            "password.required" => "Mật khẩu không được để trống!",
            "password.confirmed" => "Mật khẩu và xác nhận mật khẩu không khớp!",

            "department_id.required" => "Vui lòng chọn phòng ban!",
            "status_id.required" => "Vui lòng chọn tình trạng!",
        ]);

        // Eloquent ORM
        $user = User::create([
            "status_id" => $request["status_id"],
            "username" => $request["username"],
            "name" => $request["name"],
            "email" => $request["email"],
            "department_id" => $request["department_id"],
            "password" => Hash::make($request["password"])
        ]);
    }
}
