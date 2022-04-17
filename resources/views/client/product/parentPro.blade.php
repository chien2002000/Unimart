@extends('layouts.client')
@section('content')
<div id="main-content-wp" class="clearfix category-product-page">
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
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            <div class="section" id="list-product-wp">
                <div class="section-head clearfix">
                    <h3  id="count_filter" class="section-title fl-left" style="display: flex;">{{$cate_Parent->name}}<p  style="color: silver">({{$count}} Sản Phẩm)</p></h3>
                    <div class="filter-wp fl-right">
                        <div class="form-filter">
                        <form method="get" action="">
                                <select name="select">
                                    <option value="">Sắp xếp</option>
                                    <option value="1">Nổi bật</option>
                                    <option value="3">Giá cao xuống thấp</option>
                                    <option value="4">Giá thấp lên cao</option>
                                </select>
                                <button type="submit">Lọc</button>
                            </form>
                        </div>
                    </div>
                </div>
                @if(!empty($list_Pro->count() >0))
                <div class="section-detail" id="wp-detail">
                    <ul class="list-item clearfix">
                        @foreach($list_Pro as $item)
                        <li>
                        <a href="{{url("$cate_Parent->slug/$cate_Parent->id/$item->categary_id/chi-tiet/$item->id")}}" title="" class="thumb">
                            <img style="height:200px" src="{{url($item->product_thumb)}}">
                            </a>
                            <a href="?page=detail_product" title="" class="product-name">{{$item->product_title}}</a>
                            <div class="price">
                                <span class="new">{{number_format($item->price , 0 ,'' , '.')."đ"}}</span>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                    <div class="section" id="paging-wp">
                        <nav aria-label="Page navigation example">
                            {{$list_Pro->links()}}
                        </nav>
                    </div>
                </div>
                @else
                <div class="img_count">
                        <img src="{{url('public/uploads/noti-search.png')}}">
                </div>
                @endif
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
            <div class="section" id="filter-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Bộ lọc</h3>
                </div>
                <div class="section-detail">
                    <form method="get" action="" id="filter"  data-id="{{$id}}">
                        <table>
                            <thead>
                                <tr>
                                    <td colspan="2">Giá</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input   type="radio" name="r-price" value="< 1000000" ></td>
                                    <td>Dưới 1 triệu</td>
                                </tr>
                                <tr>
                                    <td><input   type="radio" name="r-price" value="1000000 5000000"></td>
                                    <td>Từ 1 triệu - 5 triệu</td>
                                </tr>
                                <tr>
                                    <td><input  type="radio" name="r-price" value="5000000-10000000"></td>
                                    <td>Từ 5 triệu - 10 triệu</td>
                                </tr>
                                <tr>
                                    <td><input    type="radio" name="r-price" value="10000000-15000000"></td>
                                    <td>Từ 10 triệu - 15 triệu</td>
                                </tr>
                                <tr>
                                    <td><input   type="radio" name="r-price" value="> 15000000"></td>
                                    <td>Trên 15 triệu</td>
                                </tr>
                            </tbody>
                        </table>
                        <table>
                            <thead>
                                <tr>
                                    <td colspan="2">Hãng</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type="radio" name="r-brand" value="all"></td>
                                    <td>Tất cả</td>
                                </tr>
                                @foreach ($cate_child as $item)
                                @if($item->status_id ==1)
                                <tr>
                                <td><input type="radio" name="r-brand" value="{{$item->name}}"></td>
                                    <td>{{$item->name}}</td>
                                </tr>
                                @endif
                                @endforeach

                            </tbody>
                        </table>

                    </form>
                </div>
            </div>
            <div class="section" id="banner-wp">
                <div class="section-detail">
                    <a href="?page=detail_product" title="" class="thumb">
                    <img src="{{url('public/images/banner.png')}}" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
     .img_count{
            margin: 0px auto;
            display: block;
            width: 325px;
            padding-top: 48px;
        }
    #paging-wp{
        width: 294px;

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
