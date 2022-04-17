@extends('layouts.admin')

@section('content')
@php
@endphp
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Cập nhật trang
        </div>
        <div class="card-body">
            {!! Form::open(['url' =>['admin/page/update' , $page_id->id] , 'method'=>'post']) !!}
                <div class="form-group">
                    @error('name')
                    <div class="form-text text-danger">{{$message}}</div>
                    @enderror
                    <label for="name">Tên Trang</label>
                <input class="form-control" type="text" value="{{$page_id->page_title}}" name="name" id="name">
                </div>
                <div class="form-group">
                    @error('slug')
                    <div class="form-text text-danger">{{$message}}</div>
                    @enderror
                    <label for="slug">Slug</label>
                <input class="form-control" type="text" value="{{$page_id->slug}}" name="slug" id="slug">
                </div>
                <div class="form-group">
                    <label for="content">Nội dung bài viết</label>
                    @error('content')
                    <div class="form-text text-danger">{{$message}}</div>
                    @enderror
                    <textarea name="content" class="form-control" id="content" cols="30" rows="20">{{$page_id->content}}</textarea>
            </div>
                        @if($page_id->status_id == 1)
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="exampleRadios2" value="1" checked>
                                <label  class="form-check-label" for="exampleRadios2">
                                  Công khai
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="exampleRadios1" value="2" >
                                <label class="form-check-label" for="exampleRadios1">
                                  Chờ duyệt
                                </label>
                            </div>
                        @else
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" id="exampleRadios2" value="1" >
                            <label  class="form-check-label" for="exampleRadios2">
                              Công khai
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" id="exampleRadios1" value="2" checked>
                            <label class="form-check-label" for="exampleRadios1">
                              Chờ duyệt
                            </label>
                        </div>
                        @endif
                <button type="submit" class="btn btn-primary">Sửa</button>
            </form>
        </div>
    </div>
</div>
@endsection
