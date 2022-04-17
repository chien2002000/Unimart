
@extends('layouts.admin')
@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Thêm người dùng
        </div>
        <div class="card-body">
        <form action="{{url('admin/user/store')}}">
                <div class="form-group">
                    <label for="name">Họ và tên</label>
                    @error('name')
                    <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    <input class="form-control " type="text" name="name" id="name">
                </div>

                <div class="form-group">
                    <label for="email">Email</label><br>
                    @error('email')
                    <small class="form text text-danger">{{$message}}</small>
                    @enderror
                    <input class="form-control" type="text" name="email" id="email">
                </div>

                <div class="form-group">
                    <label for="pass">Mật khẩu</label><br>
                    @error('pass')
                    <small class="form text text-danger">{{$message}}</small>
                    @enderror
                    <input class="form-control" type="password" name="pass" id="pass">
                </div>

                <div class="form-group">
                    <label for="">Nhóm quyền</label><br>
                    @error('role')
                <small class="form text text-danger">{{$message}}</small>
                 @enderror
                    <select class="form-control" id="" name="role">
                        <option value="">Chọn quyền</option>
                        @foreach($role as $value)
                        <option value="{{$value->id}}">{{$value->name}}</option>
                            @endforeach
                    </select>
                </div>

                <button name="btn_add" type="submit" class="btn btn-primary">Thêm mới</button>
            </form>
        </div>
    </div>
</div>
@endsection
