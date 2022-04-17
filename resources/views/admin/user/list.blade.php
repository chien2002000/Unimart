@extends('layouts.admin')

@section('content')
    @if(session('status'))
        <div class="alert alert-success">
            {{session('status')}}
        </div>
    @endif
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
            <h5 class="m-0 ">Danh sách thành viên</h5>
            <div class="form-search form-inline">
                <form action="">
                    <input type="" name="keyword" class="form-control form-search" value="{{request()->input('keyword')}}" placeholder="Tìm kiếm">
                    <input type="submit" name="btn-search" value="Tìm kiếm" class="btn btn-primary">
                </form>
            </div>
        </div>
    <form class="form-action  form-inline py-3" action="{{url('admin/user/action')}}" >
        <div class="card-body">
            <div class="analytic">
            <a href="{{request()->fullUrlWithQuery(['status'=>'active'])}}" class="text-primary">kích hoạt<span class="text-muted">({{$count[0]}})</span></a>
            <a href="{{request()->fullUrlWithQuery(['status'=>'trash'])}}" class="text-primary">Vô hiệu hoá<span class="text-muted">({{$count[1]}})</span></a>
            </div>
            <form class="form-action form-inline py-3">
                @error('select')
                <small class="form-text text-danger">Mời bạn trọn tác vụ</small>
                @enderror
                <select name="select" class="form-control mr-1" id="">
                    <option value="">Chọn</option>
                    @if(request()->input('status') =='trash')
                    <option value="delete_all">Xoá vĩnh viễn </option>
                    <option value="store">Khôi phục</option>
                    @else
                    <option value="delete">Xoá tạm thời </option>
                    @endif
                </select>

                <input type="submit" name="btn-list" value="Áp dụng" class="btn btn-primary">
            @if($list_users->count() >0)
            <table class="table table-striped table-checkall">
                <thead>
                    <tr>
                        <th>
                            <input type="checkbox" name="checkall">
                        </th>
                        <th scope="col">#</th>
                        <th scope="col">Họ tên</th>

                        <th scope="col">Email</th>
                        <th scope="col">Quyền</th>
                        <th scope="col">Ngày tạo</th>
                        <th scope="col">Tác vụ</th>
                    </tr>
                </thead>
                <tbody>
                    @error('list')
                    <small class="form-text text-danger">Mời bạn trọn checklist</small>
                @enderror
                        @php
                            $t=0;
                        @endphp
                    @foreach($list_users as $user)
                        @php
                            $t++;
                        @endphp
                    <tr>
                        <td>
                        <input type="checkbox" name="list[]" value="{{$user->id}}">
                        </td>
                    <th scope="row">{{$t}}</th>
                    <td>{{$user->name}}</td>

                    <td>{{$user->email}}</td>
                    <td>{{$user->role->name}}</td>
                    <td>{{$user->created_at}}</td>
                        <td>
                        @if(Auth::id() ==  $user->id)
                        <a href="{{route('user/edit' ,$user->id )}}" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                         @else
                        <a href="{{route('user/edit' ,$user->id )}}" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                        <a href="{{route('user/delete' , $user->id)}}" onclick="return confirm('Bạn có muốn xoá thành viên này không?')" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                        </td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
                <span style="font-weight: bold">Không Tìm thấy bản ghi nào</span>
            @endif
            <nav aria-label="Page navigation example">

                   {{$list_users->links()}}

            </nav>
        </div>
    </form>
    </div>
</div>
@endsection
