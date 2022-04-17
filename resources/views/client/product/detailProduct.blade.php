@extends('layouts.client')
@section('content')
<div id="main-content-wp" class="clearfix detail-product-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="" title="">Trang chủ</a>
                    </li>
                    <li>
                    <a href="" title="">{{$cate_Parent->name}}</a>
                    </li>
                    <li>
                        <a href="" title="">{{$cate_Child->name}}</a>
                    </li>
                    <li>
                        <a href="" title="">{{$product_by_id->product_title}}</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            <div class="section" id="detail-product-wp">
                <div class="section-detail clearfix">
                    <div class="thumb-wp fl-left">
                        <div class="" style="position: relative">
                        <a href="" title="" id="main-thumb">
                            <img id="zoom" style="width:350px ; height:350px" src="{{url($product_by_id->product_thumb)}}" data-zoom-image=""/>
                        </a>
                        @if($img_detail->count()>0)
                        <div id="list-thumb">
                        @foreach($img_detail as $img)
                        <a href="" data-image="{{url($img->name_detail)}}" data-zoom-image="">
                                <img   width="350" height="350" id="zoom" src="{{url($img->name_detail)}}" />
                            </a>
                        @endforeach
                        </div>
                        @endif
                    </div>
                    </div>
                    <div class="thumb-respon-wp fl-left">
                        <img src="public/images/img-pro-01.png" alt="">
                    </div>
                <form action="{{route('cat/add',$product_by_id->id)}}" id="form-detail">
                    <div class="info fl-right">
                    <h3 class="product-name">{{$product_by_id->product_title}}</h3>
                        <div class="desc">
                            {!!$product_by_id->excerpts!!}
                        </div>
                        <span class="title d-block mb-1">Màu sản phẩm:</span>
                        <div class="color">
                            @if($color_detail->count() >0)
                            <ul style="display: flex;">
                                @foreach($color_detail as $color)
                                <li  class="d-inline-block text-center py-1" style="margin-right: 19px;cursor: pointer; padding-top: 5px; margin-bottom: 20px;">
                                <input  id="value-color" type="radio" name="color" style="display:none" class="d-none" value="{{$color->id}}">
                                    <b class="rounded d-inline-block p-3"  style="background:{{$color->code_color}};"></b>
                                </li>
                                @endforeach
                                 </ul>
                               @endif
                        </div>

                        <div class="num-product">
                            <span class="title">Sản phẩm: </span>
                            <span class="status">Còn hàng</span>
                        </div>
                        <p class="price">{{number_format($product_by_id->price , 0 ,'' , '.')."đ"}}</p>
                        <div id="num-order-wp">
                            <a title="" id="minus"><i class="fa fa-minus"></i></a>
                            <input type="text" name="num-order" value="1" id="num-order">
                            <a title="" id="plus"><i class="fa fa-plus"></i></a>
                        </div>
                    </div>
                    {!! Form::close() !!}
                    <button class="add-cart" style_id ={{$cate_Child->id}}  data-id="{{$cate_Parent->id}}" onclick="addCat({{$product_by_id->id}})"  title="Thêm giỏ hàng" >Thêm giỏ hàng</button>
                </div>
            </div>
            <div class="section" id="post-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Mô tả sản phẩm</h3>
                </div>
                <div class="section-detail" >
                    {!!$product_by_id->content!!}
                    <div class="athour" >
                        <p >{{$product_by_id->user->name}}</p>
                    </div>

                </div>
            </div>
            <div class="section" id="same-category-wp">
                <div class="section-head">
                    <h3 class="section-title">Cùng chuyên mục</h3>
                </div>
                <div class="section-detail">
                    @if($Product_same_item->count()>0)
                    <ul class="list-item">
                        @foreach($Product_same_item as $item)
                        <li>
                            <a href="" title="" class="thumb">
                            <img src="{{url($item->product_thumb)}}">
                            </a>
                        <a href="" title="" class="product-name">{{$item->product_title}}</a>
                            <div class="price">
                                <span class="new">{{number_format($item->price , 0 ,'' , '.')."đ"}}</span>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                    @endif
                </div>
            </div>
        </div>
        <div class="sidebar fl-left">
            <div class="section" id="category-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Danh mục sản phẩm</h3>
                </div>
                <div class="secion-detail">
                    <ul class="list-item">
                    @foreach($categary as $cate)
                        <li>
                        @if($cate->parent_id == 0)
                        <a href="{{url("$cate->slug/$cate->id")}}" title="">{{$cate->name}}</a>
                        @if($cate->categaryChild->count() > 0)
                        <ul class="sub-menu">
                            @foreach($cate->categaryChild as $value)
                            @if($value->status_id == 1)
                            <li>
                            <a href="{{url("$cate->slug/{$cate->id}/$value->slug/$value->id")}}" title="">{{$value->name}}</a>
                            </li>
                            @endif
                            @endforeach
                        </ul>
                        @endif
                        @endif
                        </li>
                     @endforeach
                    </ul>
                </div>
            </div>
            <div class="section" id="banner-wp">
                <div class="section-detail">
                    <a href="" title="" class="thumb">
                        <img src="{{url("public/images/banner.png")}}" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    li b.rounded{
        background: #181815;
        padding: 8px 17px;
        border-radius: 5px;
    }
    i.font_fw{
        display: block;
        font-family: 'Roboto Regular';
        font-style: normal;
        color: #4f4848c4;
        padding: 7px 5px;
    }
    .color ul li.active b {
    border: 1px solid #05f701;
}
</style>
@endsection
