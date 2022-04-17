@extends('layouts.admin')

@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Chỉnh sửa người dùng
        </div>
        <div class="card-body">
        <form action="{{route('user/update' , $user_id->id)}}">
                <div class="form-group">
                    <label for="name">Họ và tên</label>
                    @error('name')
                    <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                <input class="form-control" type="text" name="name" value="{{$user_id->name}}" id="name">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    @error('email')
                    <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                <input class="form-control" type="text" value="{{$user_id->email}}" name="email" id="email" readonly ='readonly'>
                </div>
                <div class="form-group">
                    <label for="pass">Mật khẩu</label>
                    @error('password')
                    <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    <input class="form-control" type="password" name="password" id="pass">
                </div>
                <div class="form-group">
                    <label for="pass_old">Xác Nhận Mật khẩu</label>
                    {{-- @error('pass_old')
                    <small class="form-text text-danger">{{$message}}</small>
                        @enderror --}}
                    <input class="form-control" type="password" name="password_confirmation" id="pass_old">
                </div>
                <div class="form-group">
                    <label for="">Nhóm quyền</label>
                    @error('role')
                    <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    <select class="form-control" id="" name="role">
                        <option value="">Chọn quyền</option>

                        @if($user_id->role_id =='1')
                        <option selected value="1">Admintrator</option>
                        <option  value="2">Editor</option>
                        <option  value="3">Author</option>
                        <option  value="4">Subcriber</option>
                        @elseif($user_id->role_id =='2')
                        <option  value="1">Admintrator</option>
                        <option selected value="2">Editor</option>
                        <option  value="3">Author</option>
                        <option  value="4">Subcriber</option>
                        @elseif($user_id->role_id =='3')
                        <option  value="1">Admintrator</option>
                        <option  value="2">Editor</option>
                        <option selected value="3">Author</option>
                        <option  value="4">Subcriber</option>
                        @elseif($user_id->role_id =='4')
                        <option  value="1">Admintrator</option>
                        <option  value="2">Editor</option>
                        <option  value="3">Author</option>
                        <option selected value="4">Subcriber</option>
                        @endif
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Thêm mới</button>
            </form>
        </div>
    </div>
</div>

@endsection
