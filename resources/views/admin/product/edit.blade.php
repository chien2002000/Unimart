@extends('layouts.admin')
@section('content')

<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
           Cập nhật sản phẩm
        </div>
        <div class="card-body">
            {!! Form::open(['url'=>['admin/product/update' ,$product_id->id ],'method' =>'post' , 'files'=>true]) !!}
                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <label for="name">Tên sản phẩm</label>
                            @error('name')
                            <div class="form-text text-danger">{{$message}}</div>
                            @enderror
                        <input class="form-control" type="text" value="{{$product_id->product_title}}" name="name" id="name">
                        </div>
                        <div class="form-group">
                            <label for="name">Mã sản phẩm</label>
                            @error('code')
                            <div class="form-text text-danger">{{$message}}</div>
                            @enderror
                            <input class="form-control" value="{{$product_id->code}}" type="text" name="code" id="name">
                        </div>
                        <div class="form-group">
                            <label for="name">Giá</label>
                            @error('price')
                            <div class="form-text text-danger">{{$message}}</div>
                            @enderror
                            <input class="form-control"  value="{{$product_id->price}}" type="text" name="price" id="name">
                        </div>
                        <label for="intro">Chọn màu</label>
                        <div class="felx position-relative"  style="display: flex">
                            @foreach($checkColor as $value)
                            @if($value->pivot->product_id ==$id)
                            <div class="form-group " style="flex-wrap: nowrap">
                            <label for="" style="font-size: 14px; margin-right: 12px; font-weight: bold;">{{$value->name_color}}</label><br>
                            <input type="checkbox" checked name="listColor[]" id="" value="{{$value->id}}" style="">
                            </div>
                            @else
                            @endif
                            @endforeach

                        </div>
                    </div>
                    <div class="col-8">
                        <div class="form-group">
                            <label for="intro">Mô tả sản phẩm</label>
                            @error('extps')
                            <div class="form-text text-danger">{{$message}}</div>
                            @enderror
                            <textarea name="extps" class="form-control" id="intro" cols="30" rows="10">{{$product_id->excerpts}}</textarea>
                        </div>
                    </div>
                </div>


                <div class="form-group">
                    <label for="intro">Chi tiết sản phẩm</label>
                    @error('content')
                    <div class="form-text text-danger">{{$message}}</div>
                    @enderror
                    <textarea name="content" class="form-control" id="intro" cols="30" rows="15">{{$product_id->content}}</textarea>
                </div>


                <div class="form-group">
                    <label for="">Danh mục</label>
                    <select class="form-control" id="" name="cat">
                        <option value="">Chọn danh mục</option>
                        @foreach($result as $value)
                        @if($value->id == $product_id->categary_id)
                        <option value="{{$value->id}}" selected >{{str_repeat('--',$value->level).$value->name}}</option>
                        @else
                        <option value="{{$value->id}}">{{str_repeat('--',$value->level).$value->name}}</option>
                        @endif
                        @endforeach


                    </select>
                </div>
                <div class="form-group">
                    <label for="">Ảnh sản phẩm</label>
                    <div class="form-group">
                        {!! Form::file('file', ['class'=>'form-control' ,]) !!}
                    </div>
                </div>
                <img width="150px" src="{{url($product_id->product_thumb)}}" alt="">
                <div class="form-group" style="padding-top: 20px">
                    <label for="">Ảnh chi tiết sản phẩm</label>
                    <div class="form-group">
                        <input type="file" name="images[]" id="" class="form-control" multiple>
                    </div>
                </div>
                <div class="img_detaila" id="detail_img2" style="position: relative">
                    @foreach ($thumb_detail as $item)
                    {{-- <input type="file" id="files" class="hidden"/> --}}

                    <img width="150px" src="{{url($item->name_detail)}}" alt="">
                <a href="" data='{{$product_id->id}}' data-id="{{$item->id}}" id="delete_edit" class="delete">Xoá</a>
                    @endforeach
                </div>

                <div class="wp-ligh" style="display:block ; padding-top:20px">
                    <label>Nổi bật</label>
                <label for="" class="switch">
                <input type="checkbox" checked name="fea" value="{{$product_id->product_hightlight}}" id="" class="d-none">
                    @if($product_id->product_hightlight == 1)
                <span class="slider  'active'">
                    </span>
                    @else
                    <span class="slider">
                    </span>
                    @endif
                </label>
                </div>

                <div class="form-group">
                    <label for="">Trạng thái</label>
                    @if($product_id->status_id == 1)
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



                <button type="submit" class="btn btn-primary">Thêm mới</button>
            </form>
        </div>
    </div>
</div>

@endsection
