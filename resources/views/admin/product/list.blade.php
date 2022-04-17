@extends('layouts.admin')

@section('content')
@if(session('status'))
<div class="alert alert-success">{{session('status')}}</div>
@endif
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
            <h5 class="m-0 ">Danh sách sản phẩm</h5>
            <div class="form-search form-inline">
                <form action="">
                <input type="" name="search" value="{{request()->input('search')}}" class="form-control form-search" placeholder="Tìm kiếm">
                    <input type="submit" name="btn-search" value="Tìm kiếm" class="btn btn-primary">
                </form>
            </div>
        </div>
        <form action="{{route('product/action')}}">
        <div class="card-body">
            <div class="analytic">
                <a href="{{request()->fullUrlWithQuery(['status'=>'public'])}}" class="text-primary">Công khai<span class="text-muted">({{$count[0]}})</span></a>
                <a href="{{request()->fullUrlWithQuery(['status'=>'pending'])}}" class="text-primary">Chờ duyệt<span class="text-muted">({{$count[1]}})</span></a>
                <a href="{{request()->fullUrlWithQuery(['status'=>'delete'])}}" class="text-primary">Thùng rác<span class="text-muted">({{$count[2]}})</span></a>
            </div>
            <div class="form-action form-inline py-3">
                <select class="form-control mr-1" id="" name="action">
                    <option value="">Chọn</option>
                   @foreach($list as $k=> $v)
                 <option value="{{$k}}">{{$v}}</option>
                    @endforeach
                </select>
                <input type="submit" name="btn-search" value="Áp dụng" class="btn btn-primary">
            </div>
            @if($listPro->count() >0)
            <table class="table table-striped table-checkall">
                <thead>
                    <tr>
                        <th scope="col">
                            <input name="checkall" type="checkbox">
                        </th>
                        <th scope="col">#</th>
                        <th scope="col">Ảnh</th>
                        <th scope="col">Tên sản phẩm</th>
                        <th scope="col">Giá</th>
                        <th scope="col">Danh mục</th>
                        <th scope="col">Ngày tạo</th>
                        <th scope="col">Chi tiết</th>
                        @if(request()->input('status') != 'delete')
                        <th scope="col">Tác vụ</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                        @php
                            $t = 0;
                        @endphp
                    @foreach($listPro as $item)
                         @php
                            $t++;
                         @endphp
                    <tr>
                        <td>
                        <input type="checkbox" name="checkList[]" value="{{$item->id}}">
                        </td>
                        <td>{{$t}}</td>
                         <td><img style="border: 1px solid silver ;" width="90px" src="{{url($item->product_thumb)}}" alt=""></td>
                    <td style="width:300px"><a href="#">{{$item->product_title}}</a></td>
                        <td>{{number_format($item->price , 0 ,'' , '.')."đ"}}</td>
                        <td>{{$item->categary->name}}</td>
                        <td style="  width: 120px;">{{$item->created_at}}</td>
                        <td data-toggle="modal" data-id="{{$item->id}}" data-target="#exampleModal" id="product-detail" style="cursor: pointer">
                            <img width="30" src="{{url('public/uploads/dau-detail.png')}}">
                        </td>
                        @if(request()->input('status') != 'delete')
                        <td>
                        <a href="{{route('product/edit' , $item->id)}}"   class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                        <a href="{{route('product/delete', $item->id)}}" onclick="return confirm('Bạn có muốn xoá sản phẩm không?')" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
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
                {{$listPro->links()}}
            </nav>
        </div>
        </form>
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
          <h5 class="modal-title" id="exampleModalLabel">Chi tiết bài viết</h5>
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
                                <label for="id">Màu sắc</label>
                            </div>
                        </li>
                        <li>
                            <div class="row no-gutters">
                                <label for="id">Tiêu đề</label>
                            </div>
                        </li>
                        <li>
                            <div class="row no-gutters">
                                <label for="id">Nổi bật</label>
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
                                    <div class="color"><p>color</p></div>
                                </div>
                            </li>
                            <li>
                                <div class="row no-gutters">
                                    <div class="title"><p>sadasd</p></div>
                                </div>
                            </li>
                            <li>
                                <div class="row no-gutters">
                                    <div class="hight"><p>sadasd</p></div>
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

