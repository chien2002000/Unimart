@extends('layouts.admin')
@section('content')
<div id="content" class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header font-weight-bold">
                    Sửa Danh mục
                </div>
                <div class="card-body">
                <form action="{{route('product/cat/update' ,$catProduct1->id)}}">
                        <div class="form-group">
                            @error('name')
                            <div class="form-text text-danger">{{$message}}</div>
                                @enderror
                            <label for="name">Tên danh mục</label>
                        <input class="form-control" type="text" value="{{$catProduct1->name}}" name="name" id="name">
                        </div>
                        <div class="form-group">
                            <label for="name">Slug</label>
                            @error('slug')
                            <div class="form-text text-danger">{{$message}}</div>
                                @enderror
                            <input class="form-control" value="{{$catProduct1->slug}}" type="text" name="slug" id="name">
                        </div>



                        <div class="form-group">
                            <label for="">Trạng thái</label>
                            @if($catProduct1->status_id == 1)
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
                        <button type="submit" class="btn btn-primary">Sửa</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
