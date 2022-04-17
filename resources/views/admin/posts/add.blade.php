@extends('layouts.admin')
@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Thêm bài viết
        </div>
        <div class="card-body">
            {!! Form::open(['url' => 'admin/post/store' , 'method' =>'post' , 'files'=>true]) !!}
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Tiêu đề bài viết</label>
                        @error('name')
                        <div class="form-text text-danger">{{$message}}</div>
                        @enderror
                        <input class="form-control" type="text" name="name" id="name">
                    </div>
                    <div class="form-group">
                        <label for="">Danh mục</label>
                        @error('cat')
                        <div class="form-text text-danger">{{$message}}</div>
                        @enderror
                        <select class="form-control" id="" name="cat">
                          <option value="">Chọn danh mục</option>
                          @foreach($result as $value)
                        <option value="{{$value->id}}">{{str_repeat('--',$value->level).$value->name}}</option>
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
                        <textarea name="extep"  class="form-control" id="content" cols="30" rows="5"></textarea>
                    </div>
                </div>
            </div>
                <div class="form-group">
                    <label for="content">Nội dung bài viết</label>
                    @error('content')
                    <div class="form-text text-danger">{{$message}}</div>
                    @enderror
                    <textarea name="content" class="form-control" id="content" cols="30" rows="5"></textarea>
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

                <div class="col-md-4">
                    @error('file')
                    <div class="form-text text-danger">{{$message}}</div>
                    @enderror
                    <div class="form-group">
                        {!! Form::file('file', ['class'=>'form-control' ,]) !!}
                    </div>

                </div>
                <button type="submit" class="btn btn-primary">Thêm mới</button>
            </form>
        </div>
    </div>
</div>
@endsection
