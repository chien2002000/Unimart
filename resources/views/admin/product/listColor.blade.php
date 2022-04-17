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
                   Thêm màu sắc
                </div>
                <div class="card-body">
                <form action="{{route('product/add/color')}}">
                        <div class="form-group">
                            <label for="name">Tên màu sắc</label>
                            @error('name')
                        <div class="text-form text-danger">{{$message}}</div>
                            @enderror
                            <input class="form-control" type="text" name="name" id="name">
                        </div>
                        <div class="form-group">
                            <label for="name">Tên danh mục</label>
                            <input class="form-control" type="color" id="code_color" name="color" id="name">
                        </div>
                        <div>
                            <label for="">Mã màu</label>
                            <p class="color" style="padding: 5px 0px;margin-top: 8px; text-align: center;border: 1px solid #ced4da;line-height: 23px;font-weight: 600;">#000</p>
                        </div>
                        <button type="submit" class="btn btn-primary">Thêm mới</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-8">
            <div class="card">
                <div class="card-header font-weight-bold">
                    Danh sách
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên màu</th>
                                <th scope="col">Mã màu</th>
                                <th scope="col">Tác vụ</th>
                            </tr>
                        </thead>
                        <tbody>
                                @php
                                    $t=0;
                                @endphp
                                @foreach($colorList as $color)
                                @php
                                         $t++;
                                 @endphp
                            <tr>
                            <th scope="row">{{$t}}</th>
                            <td>{{$color->name_color}}</td>
                            <td>{{$color->code_color}}</td>
                            <td><a href="{{route('product/delete/color' , $color->id)}}" onclick="return confirm('Bạn có muốn xoá màu này không?')" class="btn btn-danger btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a></td>
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
