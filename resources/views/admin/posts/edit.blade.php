@extends('layouts.admin')

@section('content')

<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
           Cập nhật bài viết
        </div>
        <div class="card-body">
            {!! Form::open(['url' => ['admin/post/update',$post_id->id] , 'method' =>'post' , 'files'=>true]) !!}
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Tiêu đề bài viết</label>
                        @error('name')
                        <div class="form-text text-danger">{{$message}}</div>
                        @enderror
                    <input value="{{$post_id->post_title}}" class="form-control" type="text" name="name" id="name">
                    </div>
                    <div class="form-group">
                        <label for="">Danh mục</label>
                        @error('cat')
                        <div class="form-text text-danger">{{$message}}</div>
                        @enderror
                        <select class="form-control" id="" name="cat">
                          @foreach($result as $value)
                          @if($value->id == $post_id->categary_id)
                          <option value="{{$value->id}}" selected >{{str_repeat('--',$value->level).$value->name}}</option>
                          @else
                          <option value="{{$value->id}}">{{str_repeat('--',$value->level).$value->name}}</option>
                          @endif
                          @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">

                        <label for="extep">Mô tả ngắn</label>
                        @error('extep')
                        <div class="form-text text-danger">{{$message}}</div>
                        @enderror
                    <textarea name="extep"  class="form-control" id="content" cols="30" rows="5">{{$post_id->excerpts}}</textarea>
                    </div>
                </div>
            </div>
                <div class="form-group">
                    <label for="content">Nội dung bài viết</label>
                    @error('content')
                    <div class="form-text text-danger">{{$message}}</div>
                    @enderror
                    <textarea name="content" class="form-control" id="content" cols="30" rows="20">{{$post_id->content}}</textarea>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    {!! Form::file('file', ['class'=>'form-control' ,]) !!}
                </div>
            <img width="150px" src="{{url($post_id->thumbnail)}}" alt="">
            </div>
            <div class="form-group">
                <label for="">Trạng thái</label>
                @if($post_id->status_id == 1)
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
                    <input class="form-check-input" type="radio" name="status" id="exampleRadios2" value="1" checked>
                    <label class="form-check-label" for="exampleRadios2">
                      Công khai
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="status" id="exampleRadios1" value="2" checked >
                    <label class="form-check-label" for="exampleRadios1">
                      Chờ duyệt
                    </label>
                </div>
                @endif

            </div>
                <button type="submit" class="btn btn-primary">Sửa bài viết</button>
            </form>
        </div>
    </div>
</div>
@endsection
