@extends('layouts.admin')
@section('content')
    @if(session('status'))
    <div class="alert alert-success">{{session('status')}}</div>
    @endif
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
            <h5 class="m-0 ">Danh sách bài viết</h5>
            <div class="form-search form-inline">
                <form action="#">
                <input type="" class="form-control form-search" name="keyword" value="{{request()->input('keyword')}}" placeholder="Tìm kiếm">
                    <input type="submit" name="btn-search" value="Tìm kiếm" class="btn btn-primary">
                </form>
            </div>
        </div>
        <div class="card-body">
            <div class="analytic">
                <a href="{{request()->fullUrlWithQuery(['status'=>'active'])}}" class="text-primary">Công khai<span class="text-muted">({{$count[0]}})</span></a>
                <a href="{{request()->fullUrlWithQuery(['status'=>'trard'])}}" class="text-primary">Chờ duyệt<span class="text-muted">({{$count[1]}})</span></a>
                <a href="{{request()->fullUrlWithQuery(['status'=>'delete'])}}" class="text-primary">Thùng rác<span class="text-muted">({{$count[2]}})</span></a>
            </div>
        <form action="{{route('page/action')}}">
            @error('select')
            <div class="form-text text-danger">{{$message}}</div>
                @enderror
            <div class="form-action form-inline py-3" >
                <select class="form-control mr-1" id="" name="select">
                    <option value="">Chọn</option>
                    @if(request()->input('status') =='active')
                    <option value="2">Chờ duyệt</option>
                    <option value="delete">Xoá tạm thời</option>
                    @elseif((request()->input('status') =='trard'))
                    <option value="1">Công khai</option>
                    <option value="delete">Xoá tạm thời</option>
                    @elseif((request()->input('status') =='delete'))
                    <option value="store">Khôi phục</option>
                    <option value="delete_all">Xoá vĩnh viễn</option>
                    @else
                    <option value="2">Chờ duyệt</option>
                    <option value="1">Công khai</option>
                    <option value="delete">Xoá tạm thời</option>
                    @endif

                </select>
                <input type="submit" name="btn-search" value="Áp dụng" class="btn btn-primary">
            </div>
            @if($list_page->count()>0)
            <table class="table table-striped table-checkall">
                <thead>
                    <tr>
                        <th scope="col">
                            <input name="checkall" type="checkbox">
                        </th>
                        <th scope="col">#</th>
                        <th scope="col">Ảnh</th>
                        <th scope="col">Tiêu đề</th>
                        <th scope="col">slug</th>
                        <th scope="col">Ngày tạo</th>
                        <th scope="col">Trạng thái</th>
                        <th scope="col">Chi tiết</th>
                        @if(request()->input('status') != 'delete')
                        <th scope="col">Tác vụ</th>
                        @endif
                    </tr>
                </thead>

                <tbody>
                    @error('list')
                    <div class="form-text text-danger">{{$message}}</div>
                   @enderror
                        @php
                                $t=0;
                        @endphp
                    @foreach($list_page as $list)
                         @php
                                $t++;
                        @endphp
                    <tr>
                        <td>
                        <input type="checkbox" name="list[]" value="{{$list->id}}">
                        </td>
                    <td scope="row">{{$t++}}</td>
                        <td><img src="http://via.placeholder.com/80X80" alt=""></td>
                    <td><div>{{$list->page_title}}</div></td>
                    <td>{{$list->slug}}</td>
                    <td>{{$list->created_at}}</td>
                    <td>{{$list->status->name}}</td>
                    <td  data-toggle="modal" data-id="{{$list->id}}" data-target="#exampleModal" id="page-detail" style="cursor: pointer">
                        <img width="30" src="{{url('public/uploads/dau-detail.png')}}">
                    </td>
                    @if(request()->input('status') != 'delete')
                        <td>
                        <a href="{{route('page/edit' , $list->id)}}" class="btn btn-success btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                        <a href="{{route('page/delete' , $list->id)}}" onclick="return confirm('Bạn có muốn xoá trang này không?')" class="btn btn-danger btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                        </td>
                    @endif
                    </tr>

                    @endforeach
                </tbody>

            </table>
            @else
            <span style="font-weight: bold">Không Tìm thấy bản ghi nào</span>
            @endif
            </form>
            <nav aria-label="Page navigation example">
                {{$list_page->links()}}
            </nav>
        </div>
    </div>
</div>
<style>
    .modal-body ul li label {
    width: 100%;
    color: #fff;
    background: #0a73e2;
    margin-bottom: 20px;
    padding: 6px 15px;
    font-weight: 600;
    border-radius: 5px;
    text-overflow: ellipsis;
    white-space: nowrap;
    overflow: hidden;
}
li{
    list-style: none
}
.modal-body ul li  p{
    width :  300px;
    color: #fff;
    margin-bottom: 20px;
    padding: 6px 15px;
    font-weight: 600;
    border-radius: 5px;
    text-overflow: ellipsis;
    white-space: nowrap;
    overflow: hidden;
    background: #5196de;
}
</style>
<div   class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Chi tiết trang</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="img" style="margin-left: 76px; padding-bottom: 15px; }">
                        <img width="300px" id="img" src="">
                    </div>
                </div>
                <div class="col-md-4">
                    <ul class="p-2 mb-0 shadow-lg">
                        <li>
                            <div class="row no-gutters">
                                <label for="id">Người tạo</label>
                            </div>
                        </li>
                        <li>
                            <div class="row no-gutters">
                                <label for="id">ID</label>
                            </div>
                        </li>
                        <li>
                            <div class="row no-gutters">
                                <label for="id">Tiêu đề</label>
                            </div>
                        </li>
                        <li>
                            <div class="row no-gutters">
                                <label for="id">Trạng thái</label>
                            </div>
                        </li>
                        <li>
                            <div class="row no-gutters">
                                <label for="id">Ngày Tạo</label>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="col-md-8" style="padding-left: 0px">

                        <ul class=" p-2 mb-0 shadow-lg">
                            <li>
                                <div class="row no-gutters">

                             <div class="user"><p>sadasd</p></div>

                                </div>
                            </li>
                            <li>
                                <div class="row no-gutters">
                                    <div class="id"><p>sadasd</p></div>
                                </div>
                            </li>
                            <li>
                                <div class="row no-gutters">
                                    <div class="title"><p>sadasd</p></div>
                                </div>
                            </li>
                            <li>
                                <div class="row no-gutters">
                                    <div class="status"><p>sadasd</p></div>
                                </div>
                            </li>
                            <li>
                                <div class="row no-gutters">
                                    <div class="create"><p>sadasd</p></div>
                                </div>
                            </li>
                        </ul>
                </div>
            </div>
        </div>
        <div class="modal-footer">
        </div>
      </div>
    </div>
  </div>
@endsection
