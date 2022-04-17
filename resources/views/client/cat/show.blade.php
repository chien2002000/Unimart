@extends('layouts.client')
@section('content')
@if(Cart::count() >0)
<div id="main-content-wp" class="cart-page">
    <div class="section" id="breadcrumb-wp">
        <div class="wp-inner">
            <div class="section-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="?page=home" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">Giỏ hàng</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div id="wrapper" class="wp-inner clearfix">
        <div class="section" id="info-cart-wp">
            <div class="section-detail table-responsive">
            <form action="{{route('cap-nhat-gio-hang')}}" method="POST" id="updateAjax">
                {{ csrf_field() }}
                <table class="table">
                    <thead>
                        <tr>
                            <td>Mã sản phẩm</td>
                            <td>Ảnh sản phẩm</td>
                            <td>
                               Màu
                            </td>
                            <td>Tên sản phẩm</td>
                            <td>Giá sản phẩm</td>
                            <td>Số lượng</td>
                            <td colspan="2">Thành tiền</td>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach(Cart::content() as $item)
                        <tr>
                        <td>{{$item->options->code}}</td>
                            <td>
                            <a href="{{url($item->options->parent_id)}}" title="" class="thumb">
                                <img src="{{url($item->options->thumb)}}" alt="">
                                </a>
                            </td>
                        <td>{{$item->options->color}}</td>
                            <td>
                                <a href="" title="" class="name-product">{{$item->name}}</a>
                            </td>
                            <td>{{number_format($item->price , 0 ,'' , '.')."đ"}}</td>
                            <td>

                            <input data-id="{{$item->rowId}}" type="number" min="1" max="10"  type="text"   name="Cat[{{$item->rowId}}]" value="{{$item->qty}}" class="num-order">
                            </td>
                        <td id="total_{{$item->rowId}}">{{number_format($item->total , 0 ,'' , '.')."đ"}}</td>
                            <td>
                            <a href="{{route('cat/delete' , $item->rowId)}}" title="" class="del-product"><i class="fa fa-trash-o"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="7">
                                <div class="clearfix">
                                    <p id="total-price" class="fl-right">Tổng giá: <span>{{Cart::total()}}đ</span></p>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="7">
                                <div class="clearfix">
                                    <div class="fl-right">
                                        <input type="submit" id="update-cart" value="Cập nhật giỏ hàng">
                                        <a href="?page=checkout" title="" id="checkout-cart">Thanh toán</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </form>
            </div>
        </div>
        <div class="section" id="action-cart-wp">
            <div class="section-detail">
                <p class="title">Click vào <span>“Cập nhật giỏ hàng”</span> để cập nhật số lượng. Nhập vào số lượng <span>0</span> để xóa sản phẩm khỏi giỏ hàng. Nhấn vào thanh toán để hoàn tất mua hàng.</p>
            <a href="{{url('/')}}" title="" id="buy-more">Mua tiếp</a><br/>
            <a href="{{route('xoa-toan-bo')}}" title="" id="delete-cart">Xóa giỏ hàng</a>
            </div>
        </div>
    </div>
</div>
@else
    <div class="imgCat">
    <img class="img" src="{{asset('uploads/Shopping-Cart-Icon.png')}}">
    <p class="tilte">Không có sản phẩm nào trong giỏ hàng của bạn</p>
    <div class="box">
    <a href="{{url('/')}}" class="box-title">Đến Trang chủ Ismart</a>
    </div>
    </div>
@endif
<style>
    .imgCat{
        width: 500px;
        margin: 0px auto;
        padding-top: 40px;
        text-align: center
    }
    .img{
        display: block;
         width: 114px;
        height: 109px;
        margin-left: 190px
    }
    .box{
        border: 1px solid #34a105;
        display: inline-block;
        padding: 11px;
        text-transform: uppercase;
        margin-top: 16px;
        text-align: center;
        margin-bottom: 20px
    }
    .box .box-title{
        color: #34a105
    }
</style>
@endsection
