@extends('layouts.client')

@section('content')
<div id="main-content-wp" class="home-page clearfix">
    <div class="wp-inner">
        <div class="main-content fl-right">
            <div class="section" id="slider-wp">
                <div class="section-detail">
                    <div class="item">
                        <img src="public/images/slider-01.png" alt="">
                    </div>
                    <div class="item">
                        <img src="public/images/slider-02.png" alt="">
                    </div>
                    <div class="item">
                        <img src="public/images/slider-03.png" alt="">
                    </div>
                </div>
            </div>
            <div class="section" id="support-wp">
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-1.png">
                            </div>
                            <h3 class="title">Miễn phí vận chuyển</h3>
                            <p class="desc">Tới tận tay khách hàng</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-2.png">
                            </div>
                            <h3 class="title">Tư vấn 24/7</h3>
                            <p class="desc">1900.9999</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-3.png">
                            </div>
                            <h3 class="title">Tiết kiệm hơn</h3>
                            <p class="desc">Với nhiều ưu đãi cực lớn</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-4.png">
                            </div>
                            <h3 class="title">Thanh toán nhanh</h3>
                            <p class="desc">Hỗ trợ nhiều hình thức</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-5.png">
                            </div>
                            <h3 class="title">Đặt hàng online</h3>
                            <p class="desc">Thao tác đơn giản</p>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="section" id="feature-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Sản phẩm nổi bật</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item">
                        @foreach($list_hight as $item)
                        <li>
                            <a href="{{url("$CateParent_phone->slug/$CateParent_phone->id/$item->categary_id/chi-tiet/$item->id")}}" title="" class="thumb">
                            <img style="height: 193px" src="{{$item->product_thumb}}">
                            </a>
                        <a href="{{url("$CateParent_phone->slug/$CateParent_phone->id/$item->categary_id/chi-tiet/$item->id")}}" title="" class="product-name">{{$item->product_title}}</a>
                            <div class="price">
                                <span class="new">{{number_format($item->price , 0 ,'' , '.')."đ"}}</span>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="section" id="list-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Điện thoại</h3>
                </div>
                <div class="all_phone" style="position: relative">
                <a href="{{url("san-pham/$CateParent_phone->slug/$CateParent_phone->id")}}" style="position: absolute ; right:10px;top:-40px ;font-weight: bold;
                        font-size: 16px;" class="all_phone">Xem tất cả</a>
                </div>
                <div class="section-detail">
                    @if($listPhone->count() >0)
                    <ul class="list-item clearfix">
                        @foreach ($listPhone as $item)
                        <li>
                            <a href="{{url("$CateParent_phone->slug/$CateParent_phone->id/$item->categary_id/chi-tiet/$item->id")}}" title="" class="thumb">
                            <img style="height: 193px" src="{{$item->product_thumb}}">
                            </a>
                            <a href="{{url("$CateParent_phone->slug/$CateParent_phone->id/$item->categary_id/chi-tiet/$item->id")}}" title="" class="product-name">{{$item->product_title}}</a>
                            <div class="price">
                                <span class="new">{{number_format($item->price , 0 ,'' , '.')."đ"}}</span>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                    @endif
                </div>
            </div>
            <div class="section" id="list-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Laptop</h3>
                </div>
                <div class="all_phone" style="position: relative">
                <a href="{{url("san-pham/$CateParent_laptop->slug/$CateParent_laptop->id")}}" style="position: absolute ; right:10px;top:-40px ;font-weight: bold;
                    font-size: 16px;" class="all_phone">Xem tất cả</a>
            </div>
                <div class="section-detail">
                    @if($listLaptop->count() > 0)
                    <ul class="list-item clearfix">
                        @foreach ($listLaptop as $item)
                        <li>
                            <a href="{{url("$CateParent_phone->slug/$CateParent_phone->id/$item->categary_id/chi-tiet/$item->id")}}" title="" class="thumb">
                            <img style="height: 193px" src="{{$item->product_thumb}}">
                            </a>
                            <a href="{{url("$CateParent_phone->slug/$CateParent_phone->id/$item->categary_id/chi-tiet/$item->id")}}" title="" class="product-name">{{$item->product_title}}</a>
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
                        <a href="{{url("san-pham/$cate->slug/$cate->id")}}" title="">{{$cate->name}}</a>
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
            <div class="section" id="selling-wp">
                <div class="section-head">
                    <h3 class="section-title">Sản phẩm bán chạy</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item">
                        @foreach($list_hight as $item)
                        <li class="clearfix">
                            <a href="?page=detail_product" title="" class="thumb fl-left">
                            <img src="{{url($item->product_thumb)}}" alt="">
                            </a>
                            <div class="info fl-right">
                            <a href="?page=detail_product" title="" class="product-name">{{$item->product_title}}</a>
                                <div class="price">
                                    <span class="new">{{number_format($item->price , 0 ,'' , '.')."đ"}}</span>
                                </div>
                                <a href="" title="" class="buy-now">Mua ngay</a>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="section" id="banner-wp">
                <div class="section-detail">
                    <a href="" title="" class="thumb">
                        <img src="public/images/banner.png" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
