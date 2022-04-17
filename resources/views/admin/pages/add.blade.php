@extends('layouts.admin')
@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Thêm Trang
        </div>
        <div class="card-body">
                {!! Form::open(['url' =>'admin/page/store' , 'method' => 'post']) !!}
                <div class="form-group">
                    <label for="name">Tên Trang</label>
                    @error('name')
                <div class="form-text text-danger">{{$message}}</div>
                    @enderror
                    <input class="form-control" type="text" name="name" id="name">
                </div>
                <div class="form-group">
                    <label for="content">Link slug</label>
                    @error('slug')
                    <div class="form-text text-danger">{{$message}}</div>
                        @enderror
                    <input class="form-control" type="text" name="slug" id="name">
                </div>
                <div class="form-group">
                    <label for="content">Nội dung bài viết</label>
                    @error('content')
                    <div class="form-text text-danger">{{$message}}</div>
                    @enderror
                    <textarea name="content" class="form-control" id="content" cols="30" rows="20"></textarea>
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

@endsection
