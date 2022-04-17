<h3 id="count_filter" class="section-title fl-left" style="display: flex ; margin-top: -57px;">{{$cate_Parent->name}}<p  style="color: silver">({{$count[0]}} Sản Phẩm)</p></h3>
     @if($list_filter->count() >0)
      <ul class="list-item clearfix">

        @foreach($list_filter as $item)
        <li>
            <a href="{{url("$cate_Parent->slug/$cate_Parent->id/$item->categary_id/chi-tiet/$item->id")}}" title="" class="thumb">
            <img style="height:200px" src="{{url($item->product_thumb)}}">
            </a>
        <a href="{{url("$cate_Parent->slug/$cate_Parent->id/$item->categary_id/chi-tiet/$item->id")}}" title="" class="product-name">{{$item->product_title}}</a>
            <div class="price">
                <span class="new">{{number_format($item->price , 0 ,'' , '.')."đ"}}</span>
            </div>
        </li>
        @endforeach
    </ul>
    <div class="section" id="paging-wp">
        <nav aria-label="Page navigation example">
            {{$list_filter->links()}}
        </nav>
    </div>
    @else
    <div class="img_count">
    <img src="{{url('public/uploads/noti-search.png')}}">
    </div>
    @endif
<script>
$('#paging-wp a').on('click', function(e){
    e.preventDefault();
    var id = $('form#filter').attr('data-id');
    $('#count_filter').css('display','none');
     var  price_filter = $('[name="r-price"]:radio:checked').val();
     var name = $('[name="r-brand"]:radio:checked').val();
    var page = $(this).attr('href').split('page=')[1];
    var data ={ id:id, price_filter :price_filter , name:name}
    fetch_data(page);
    function fetch_data(page)
 {
  $.ajax({
   url:"http://localhost/BACK-END/LARAVEL%20PRO/unimart/product/filterAjax/fetch_data/"+id+'?page='+page,
   data:data,
   success:function(data)
   {
    $('#wp-detail').css('display','block');
    $('#wp-detail').html(data);
   }
  });
 }

});
// $(document).ready(function(){

//     $('#paging-wp a').on('click', function(e){
//     e.preventDefault();
//  var page = $(this).attr('href').split('page=')[1];
//  fetch_data(page);
//  alert(page);
// });
// })
</script>

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
