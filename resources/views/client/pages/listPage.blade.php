@extends('layouts.client')
@section('content')
<div id="main-content-wp" class="clearfix blog-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">Blog</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            <div class="section" id="list-blog-wp">
                <div class="section-head clearfix">
                    <h3 class="section-title">Blog</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item">
                        @foreach($post_list as $post)
                        <li class="clearfix">

                        <a href="{{url($post->categary->slug,$post->id)}}" title="" class="thumb fl-left">
                            <img src="{{url($post->thumbnail)}}" alt="">
                            </a>
                            <div class="info fl-right">
                                <a href="">{{$post->categary->name}}</a>
                            <a href="{{url($post->categary->slug,$post->id)}}" title="" class="title">{{$post->post_title}}</a>
                            <span class="create-date">{{$post->created_at}}</span>
                            <div class="desc">{!!$post->excerpts!!}</div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="section" id="paging-wp">
                <nav aria-label="Page navigation example">
                    {{$post_list->links()}}
                </nav>
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
                    <a href="?page=detail_blog_product" title="" class="thumb">
                        <img src="public/images/banner.png" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    #paging-wp{
        width: 200px;

    margin: 0px auto;
    }
    .pagination {
    display: -ms-flexbox;
    display: flex;
    padding-left: 0;
    list-style: none;
    margin-top: 55px;
}
    .page-link {
    position: relative;
    display: block;
    padding: .5rem .75rem;
    margin-left: -1px;
    line-height: 1.25;
    color: #e4e8ede6;
    background-color: #13040452;
    border: 1px solid #dee2e6;
    width: 40px;
}
.page-item.active .page-link {
    z-index: 1;
    color: #fff;
    background-color: #040c15b3;
    border-color: #007bff;
}
li.page-item{
    padding-right: 5px;

}
.pagination {
    display: -ms-flexbox;
    display: flex;
    padding-left: 0;
    list-style: none;

}
</style>

@endsection
