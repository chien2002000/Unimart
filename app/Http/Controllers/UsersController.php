<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Role;
use Illuminate\Support\Facades\Hash;
class UsersController extends Controller

{
    public function __construct(){
        $this->middleware(function($request , $next){
             session(['Model_active' =>'users']);
            return $next($request);
        });
}
    public function add(Request $request){
        $role = Role::all();
            return \view('admin.user.add' , compact('role'));
    }


     public function list(Request $request){
            $status = $request->input('status');
            if($status =='trash'){
              $list_users=  User::onlyTrashed()->paginate(10);
            }else{
                $keyword='';
                if($request->input('keyword')){
                    $keyword=$request->input('keyword');
                }

            $list_users= User::where('name' , 'LIKE' , "%{$keyword}%")->simplePaginate(10);
            }
            $role = Role::all();
            $count_user_active = User::count();
            $list_user_trash = User::onlyTrashed()->count();
            $count = [ $count_user_active ,  $list_user_trash];

        return \view('admin.user.list', compact('list_users' , 'role' , 'count'));
     }


     public function store(Request $request){
        $request->validate([
            'name' =>'required',
            'email' =>'required|email|regex:/^[A-Za-z0-9_.]{6,32}@([a-zA-Z0-9]{2,12})(.[a-zA-Z]{2,12})+$/',
            'pass' =>'required|regex:/^([A-Z]){1}([\w_\.!@#$%^&*()]+){5,31}$/',
            'role' =>'required',
        ],
        [
            'required'=>'Trường :attribute không được để trống',
        ],
        [
            'name'=> 'Họ và tên',
            'pass'=>'Mật khẩu ',
            'role'=> 'Nhóm quyền'
        ]
    );
        // return $request->input();
        $data = array(
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('pass')),
            'role_id' => $request->input('role')
        );
        User::create($data);
        return \redirect('admin/user/list')->with('status' , 'Bạn đã thêm thành viên thành công');
     }
     #Xử LÝ ACTION XOÁ TẠM THỜI KHÔI PHỤC VÀ XOÁ VĨNH VIỄN

     public function action(Request $request){
            $request->validate([
                'select' =>'required',
                'list' =>'required',
            ]);
            // return $request->input('select');
                $list_check = $request->input('list');
                if($list_check){
                    foreach($list_check as $k=>$id){
                        if(Auth::id() == $id){
                            unset($list_check[$k]);
                        }
                    }
                    // return "Không được xoá chính mình";
                    if(!empty($list_check)){
                        $act = $request->input('select');
                        if($act == 'delete'){
                            User::destroy($list_check);
                            return \redirect('admin/user/list')->with('status' , 'Bạn đã xoá tạm thời');
                        }


                         if($act == 'store'){
                              $a = User::withTrashed()
                               ->whereIn('id', $list_check)->restore();
                               return \redirect('admin/user/list')->with('status' , 'Bạn đã khôi phục dữ liệu đã xoá');
                        }

                        if($act = 'delete_all'){
                                User::withTrashed()->whereIn('id' , $list_check)->forceDelete();
                                return \redirect('admin/user/list')->with('status' , 'Bạn đã xoá dữ liệu vĩnh viên');
                        }

                    }
                    return \redirect('admin/user/list')->with('status' , 'Bạn không thể xoá tài khoản của chính mình');
                }
     }

     public function delete($id){
            User::find($id)->delete();
            return \redirect('admin/user/list')->with('status' , 'Bạn đã xoá thành công');
     }
     public function edit($id){
        $role = Role::all();
        $user_id = User::find($id);
        return \view('admin.user.update' , compact('role' , 'user_id'));
     }
     public function update(Request $request ,$id){
        $request->validate([
            'name' =>'required',
            'password'=>'required|string|min:8|confirmed',
            'role' =>'required',
        ],
        [
            'required'=>'Trường :attribute không được để trống',
            'confirmed' => ':attribute không trung khớp',
            'min' =>':attribute yêu cầu 8 chữ số trở lên'
        ],
        [
                'password'=>'Mật khẩu',
                'role' => 'Nhóm quyền'
        ]
    );
        User::where('id' ,$id)->update([
            'name' => $request->input('name'),
            'password' => Hash::make($request->input('password')),
            'role_id' => $request->input('role'),
        ]);
        return \redirect('admin/user/list')->with('status' , 'Bạn đã sửa người dùng thành công');
     }

}
