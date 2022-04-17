
@extends('layouts.client')
@section('content')
@if(!empty($page_by_id))
<div id="main-content-wp" class="clearfix detail-blog-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="" title="">Trang chủ</a>
                    </li>
                    <li>
                    <a href="" title="">{{$page_by_id->page_title}}</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            <div class="section" id="detail-blog-wp">
                <div class="section-head clearfix">
                    <h3 class="section-title">{{$page_by_id->page_title}}</h3>
                </div>
                <div class="section-detail">
                <span class="create-date">{{$page_by_id->created_at}}</span>
                    <div class="detail">
                        {!!$page_by_id->content!!}
                    </div>
                </div>
            </div>
            <div class="section" id="social-wp">
                <div class="section-detail">
                    <div class="fb-like" data-href="" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
                    <div class="g-plusone-wp">
                        <div class="g-plusone" data-size="medium"></div>
                    </div>
                    <div class="fb-comments" id="fb-comment" data-href="" data-numposts="5"></div>
                </div>
            </div>
        </div>
        <div class="sidebar fl-left">
            <div class="section" id="selling-wp">
                <div class="section-head">
                    <h3 class="section-title">Sản phẩm bán chạy</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item">
                        @foreach($Pro_hightlight as $item)
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
                    <a href="?page=detail_product" title="" class="thumb">
                        <img src="public/images/banner.png" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@else
    <div class="error_404">
         <img src="{{url('public/uploads/404.png')}}">
         <div class="redict">
            <a href="{{url('/')}}" style="color: #32ba43;" >Quay Lại Trang Chủ</a>
         </div>

    </div>

@endif
<style>
    .error_404{
        width: 400px;
    display: block;
    margin: auto;
    padding-top: 17px;

    }

    .redict{
        width: 176px;
    margin: 0px auto;
    display: block;
    border: 1px solid #32ba43;
    text-align: center;
    height: 50px;
    font-weight: bold;
    padding-top: 12px;
    margin-top: 20px;

    }

</style>
@endsection
