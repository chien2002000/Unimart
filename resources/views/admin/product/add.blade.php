@extends('layouts.admin')
@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Thêm sản phẩm
        </div>
        <div class="card-body">
            {!! Form::open(['url' => 'admin/product/store' , 'method' =>'post' , 'files'=>true]) !!}
                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <label for="name">Tên sản phẩm</label>
                            @error('name')
                            <div class="form-text text-danger">{{$message}}</div>
                            @enderror
                            <input class="form-control" type="text" name="name" id="name">
                        </div>
                        <div class="form-group">
                            <label for="name">Giá</label>
                            @error('price')
                            <div class="form-text text-danger">{{$message}}</div>
                            @enderror
                            <input class="form-control" type="text" name="price" id="name">
                        </div>
                        <div class="form-group">
                            <label for="name">Mã sản phẩm</label>
                            @error('code')
                            <div class="form-text text-danger">{{$message}}</div>
                            @enderror
                            <input class="form-control" type="text" name="code" id="name">
                        </div>
                        <label for="intro">Chọn màu</label>
                        @error('listColor')
                        <div class="form-text text-danger">{{$message}}</div>
                        @enderror
                        <div class="felx position-relative"  style="display: flex ;flex-wrap: wrap">
                            @foreach($colorList as $value)
                            <div class="form-group " style="flex-wrap: nowrap">
                            <label for="" style="font-size: 14px; margin-right: 12px; font-weight: bold;">{{$value->name_color}}</label><br>
                            <input type="checkbox" name="listColor[]" id="" value="{{$value->id}}" style="">
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="form-group">
                            <label for="intro">Mô tả sản phẩm</label>
                            @error('extps')
                            <div class="form-text text-danger">{{$message}}</div>
                            @enderror
                            <textarea name="extps" class="form-control" id="intro" cols="30" rows="15"></textarea>
                        </div>
                    </div>
                </div>


                <div class="form-group">
                    <label for="intro">Chi tiết sản phẩm</label>
                    @error('content')
                    <div class="form-text text-danger">{{$message}}</div>
                    @enderror
                    <textarea name="content" class="form-control" id="intro" cols="30" rows="15"></textarea>
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
                <div class="form-group">
                    <label for="">Ảnh sản phẩm</label>
                    @error('file')
                    <div class="form-text text-danger">{{$message}}</div>
                    @enderror
                    <div class="form-group">
                        {!! Form::file('file', ['class'=>'form-control' ,]) !!}
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Ảnh chi tiết sản phẩm</label>
                    @error('images')
                    <div class="form-text text-danger">{{$message}}</div>
                    @enderror
                    <div class="form-group">
                      <input type="file" name="images[]" id="" class="form-control" multiple>
                    </div>
                </div>
                <label>Nổi bật</label>
                <label for="" class="switch">
                    <input type="checkbox" checked name="fea" value="0" id="" class="d-none">
                    <span class="slider">
                    </span>
                </label>
                <div class="form-group">
                    <label for="">Trạng thái</label>
                    @error('status')
                    <div class="form-text text-danger">{{$message}}</div>
                    @enderror
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="exampleRadios1" value="1" checked>
                        <label class="form-check-label" for="exampleRadios1">
                            Chờ duyệt
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="exampleRadios2" value="2">
                        <label class="form-check-label" for="exampleRadios2">
                            Công khai
                        </label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Thêm mới</button>
            </form>
        </div>
    </div>
</div>

@endsection
