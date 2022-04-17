@extends('layouts.admin')
@section('content')
@if(session('status'))
<div class="alert alert-success">{{session('status')}}</div>
@endif
<div id="content" class="container-fluid">
    <div class="row">
        <div class="col-4">
            <div class="card">
                <div class="card-header font-weight-bold">
                    Thêm danh mục
                </div>
                <div class="card-body">
                <form action="{{route('post/cat/add')}}">
                        <div class="form-group">
                            <label for="name">Tên danh mục</label>
                            @error('name')
                        <div class="form-text text-danger">{{$message}}</div>
                            @enderror
                            <input class="form-control" type="text" name="name" id="name">
                        </div>
                        <div class="form-group">
                            <label for="name">Slug</label>
                            @error('slug')
                            <div class="form-text text-danger">{{$message}}</div>
                                @enderror
                            <input class="form-control" type="text" name="slug" id="name">
                        </div>
                        <div class="form-group">
                            <label for="">Danh mục cha</label>
                            @error('cat')
                            <div class="form-text text-danger">{{$message}}</div>
                                @enderror
                            <select class="form-control" id="" name="cat">
                                <option value="">Chọn danh mục</option>
                                @foreach($result as $cat)
                            <option value="{{$cat->id}}">{{str_repeat('--',$cat['level']).$cat->name}}</option>
                                @endforeach
                            </select>
                        </div>

                <div class="form-group">
                    <label for="">Trạng thái</label>
                    @error('status')
                    <div class="form-text text-danger">{{$message}}</div>
                    @enderror
                    @foreach($status as $value)
                    <div class="form-check">
                    <input class="form-check-input" type="radio" name="status" id="exampleRadios1" value="{{$value->id}}" >
                        <label class="form-check-label" for="exampleRadios1">
                          {{$value->name}}
                        </label>
                    </div>
                    @endforeach
                </div>



                        <button type="submit" class="btn btn-primary">Thêm mới</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-8">
            <div class="card">
                <div class="card-header font-weight-bold">
                    Danh mục
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên Danh mục</th>
                                <th scope="col">slug</th>
                                <th scope="col">Trạng thái</th>
                                <th scope="col">Tác vụ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $t=0;
                            @endphp
                            @foreach($result as $value)
                            @php
                                $t++;
                            @endphp
                            <tr>
                            <th scope="row">{{$t}}</th>
                            <td {{$value->parent_id == 0?"style =font-weight:bold":''}}>{{str_repeat('--',$value['level']).$value->name}}</td>
                            <td>{{$value->slug}}</td>
                            <td>{{$value->status->name}}</td>
                            <td>
                            <a href="{{route('cat/edit' ,$value->id)}}" class="btn btn-success btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                            <a href="{{route('cat/delete',$value->id)}}" onclick="return confirm('Bạn có muốn xoá danh mục này không?')" class="btn btn-danger btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
