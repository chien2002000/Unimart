$(document).ready(function(){
    $('form#filter').change(function(){
        $('#wp-detail').css('display','none');
        $('#count_filter').css('display','none')
        var id = $('form#filter').attr('data-id');
        var  price_filter = $('[name="r-price"]:radio:checked').val();
        var name = $('[name="r-brand"]:radio:checked').val();
        var data ={ id:id, price_filter :price_filter , name:name}
        $.ajax({
            // headers: {
            //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //   },
            url: "http://localhost:8888/unimart/product/filterAjax/"+id,
            method: 'get',
            data: data,
            dataType: 'text',
            success: function (data) {
                // alert(data);
                // $('#count_filter').text(data);
                // console.log(data);
                $('#wp-detail').css('display','block');
                $('#wp-detail').html(data);
            }
        })
    })
})

$(document).ready(function(){
    $('#filterChild').change(function(){
        $('#wp-detail').css('display','none');
        $('#count_filter').css('display','none');
       var id =  $(this).attr('data-id');
       var idParent = $('tbody tr td input').attr('data-id');
       var  price_filter = $('[name="r-priceChild"]:radio:checked').val();
        var data = {idParent:idParent, id:id , price_filter:price_filter};
        $.ajax({

            url: "http://localhost:8888/unimart/firtChildAjax",
            method: 'get',
            data: data,
            dataType: 'text',
            success: function (data) {
                $('#wp-detail').css('display','block');
                $('#wp-detail').html(data);
            }
        })
})
})

$(document).ready(function(){
    $(".color ul li:first-child").addClass('active');
        var active = $(".color ul li").hasClass('active');
        if (active) {
            $(".color ul li.active input").attr('checked','checked');
        }

    $(".color ul li").click(function(){
        $(".color ul li.active input").removeAttr('checked','checked');
        $(".color ul li").removeClass('active');
        $(this).addClass('active');
        $(".color ul li.active input").attr('checked','checked');
    });

})

// $(document).ready(function(){
//     $('form#form-detail').click(function(){
//        var value = $(".color ul li.active input.d-none").val();
//        var num_oder = $('input#num-order').val();
//     })
// })
 function addCat(id){
    var id = id;
    var value = $(".color ul li.active input.d-none").val();
      var num_oder = $('input#num-order').val();
      var parent = $('button.add-cart').attr('data-id');
      var child = $('button.add-cart').attr('style_id');
      var data = { value:value , num_oder:num_oder ,parent:parent ,child:child };
      $.ajax({
        url: "http://localhost:8888/unimart/cat/add/"+id,
        method: 'get',
        data: data,
        dataType: 'text',
        success: function (data) {
            window.location.href = "http://localhost:8888/unimart/gio-hang";
        }
    })
}
$(document).ready(function(){
    $(".num-order").change(function(){
       var qty =  $(this).val();
       var RowId = $(this).attr('data-id');
       var data = {qty:qty , RowId:RowId}
       $.ajax({
        url: "update/ajax",
        method: 'get',
        data: data,
        dataType: 'json',
        success: function (data) {
            console.log(data);
           $('td#total_'+RowId).text(data.total);
           $('#total-price span').text(data.sub_total);
           $('span#num').text(data.count);
           $('.desc span#count_sp').text(data.count);
           $('p.qty span').text(data.qty);
        }
    })
    })

})

// $(".thumbnails li").click(function(){
//     src_img_click = $(this).find('img').attr('src');
//     $('#show img').attr('src',src_img_click);
//     $(".thumbnails li").removeClass('active');
//     $(this).addClass('active');
// });
//     $(".color ul li:first-child").addClass('active');
//     var active = $(".color ul li").hasClass('active');
//     if (active) {
//         $(".color ul li.active input").attr('checked','checked');
//     }

// $(".color ul li").click(function(){
//     $(".color ul li.active input").removeAttr('checked','checked');
//     $(".color ul li").removeClass('active');
//     $(this).addClass('active');
//     $(".color ul li.active input").attr('checked','checked');
// });

// });


