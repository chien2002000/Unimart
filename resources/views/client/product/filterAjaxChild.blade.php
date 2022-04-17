
<h3 id="count_filter" class="section-title fl-left" style="display: flex ; margin-top: -57px;">{{$categaryChild->name}}<p  style="color: silver">({{$count}} Sản Phẩm)</p></h3>
@if($listPro_id->count() >0)
 <ul class="list-item clearfix">

   @foreach($listPro_id as $item)
   <li>
       <a href="{{url("$CategaryParent->slug/$CategaryParent->id/$item->categary_id/chi-tiet/$item->id")}}" title="" class="thumb">
       <img style="height:200px" src="{{url($item->product_thumb)}}">
       </a>
   <a href="{{url("$CategaryParent->slug/$CategaryParent->id/$item->categary_id/chi-tiet/$item->id")}}" title="" class="product-name">{{$item->product_title}}</a>
       <div class="price">
           <span class="new">{{number_format($item->price , 0 ,'' , '.')."đ"}}</span>
       </div>
   </li>
   @endforeach
</ul>
<div class="section" id="paging-wp">
   <nav aria-label="Page navigation example">
       {{$listPro_id->links()}}
   </nav>
</div>
@else
<div class="img_count">
<img src="{{url('public/uploads/noti-search.png')}}">
</div>
@endif
<script>
    $(document).ready(function(){
        $('#paging-wp a').on('click', function(e){
            e.preventDefault();
            var id  = $('#filterChild').attr('data-id');
            $('#count_filter').css('display','none');
            var idParent = $('tbody tr td input').attr('data-id');
            var  price_filter = $('[name="r-priceChild"]:radio:checked').val();
            var page = $(this).attr('href').split('page=')[1];
            var data = {idParent:idParent ,id:id , price_filter: price_filter}
            fetch_data1(page);
        function fetch_data1(page){
            $.ajax({
                url:"http://localhost/BACK-END/LARAVEL%20PRO/unimart/paginate?page="+page,
                data:data,
                success:function(data)
                {
                 $('#wp-detail').html(data);
                }
            });
        }

        })
    })
</script>
