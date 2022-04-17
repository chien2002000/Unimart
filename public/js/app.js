$(document).ready(function() {
    $('.nav-link.active .sub-menu').slideDown();
    // $("p").slideUp();

    $('#sidebar-menu .arrow').click(function() {
        $(this).parents('li').children('.sub-menu').slideToggle();
        $(this).toggleClass('fa-angle-right fa-angle-down');
    });

    $("input[name='checkall']").click(function() {
        var checked = $(this).is(':checked');
        $('.table-checkall tbody tr td input:checkbox').prop('checked', checked);
    });
});

$(document).ready(function(){
    $("table").on('click','td#post-detail',function(){
        var data_id = $(this).attr('data-id');
        var data = {data_id:data_id}
        $.ajax({
            url: "detail/"+data_id,
            method: 'GET',
            data: data,
            dataType: 'json',
            success: function (data) {
                console.log(data);
                $('.modal .modal-body .user p').html(data.user);
                $('.modal .modal-body .title p').html(data.title);
                $('.modal .modal-body .status p').html(data.status);
                $('.modal .modal-body .create p').html(data.create);
                $('.modal .modal-body .id p').html(data.id);
                $('.modal .modal-body .img img').attr('src' ,data.img);
            }
        })
    })
})

$(document).ready(function(){
    $("table").on('click','td#page-detail',function(){
        var data_id = $(this).attr('data-id');
        var data = {data_id:data_id}
        $.ajax({
            url: "detail/"+data_id,
            method: 'GET',
            data: data,
            dataType: 'json',
            success: function (data) {
                console.log(data);
                $('.modal .modal-body .user p').html(data.user);
                $('.modal .modal-body .title p').html(data.title);
                $('.modal .modal-body .status p').html(data.status);
                $('.modal .modal-body .id p').html(data.id);
                $('.modal .modal-body .create p').html(data.create);
            }
        })
    })
})
$(document).ready(function(){
    $('.choose-color').click(function(){
        $('ul.add_css').slideToggle();
    })
})
$(document).ready(function(){
    $('form input#code_color').change(function(){
            var color = $(this).val();
            var data = {color:color}
            $.ajax({
                url: "code",
                method: 'GET',
                data: data,
                dataType: 'text',
                success: function (data) {

                    // alert(data);
                    $('.color').html(data);
                }
            })
    })
})
$(document).ready(function(){
    $('.list-color li').click(function(){
    var code_name = $(this).find('span').attr('code');
        var data = {code_name:code_name};
        $.ajax({
            url: "color",
            method: 'GET',
            data: data,
            dataType: 'text',
            success: function (data) {
                // alert(data);
                $('.list-selected-color').html(data);
            }
        })
    })
})

$(document).ready(function(){
    var val = $(".switch input[name='fea']").val();
    if (val == 1) {
        $(".switch .slider").toggleClass('active');
    }
    $(".switch").click(function(){
        $(".switch input[name='fea']").attr('value',function(index, attr){
                return attr == 1 ? 0 : 1;
            });
            $(".switch .slider").toggleClass('active');
    });
})
$(document).ready(function(){
    $('a#delete_edit').click(function(event){
        event.preventDefault();
        var id = $(this).attr('data-id');
        var id2 = $(this).attr('data');
        var data ={
            id:id , id2:id2
        };
        $.ajax({
            url: "http://localhost/BACK-END/LARAVEL%20PRO/unimart/admin/product/delete_edit",
            method: 'get',
            data: data,
            dataType: 'text',
            success: function (data) {
                $.get("http://localhost/BACK-END/LARAVEL%20PRO/unimart/admin/product/delete_edit?id="+id+"&id2="+id2, function(loadAjaxHTML){
                    $('#detail_img2').html(loadAjaxHTML)
                });
                // $.get('http://localhost/BACK-END/LARAVEL%20PRO/unimart/admin/product/delete_edit' , function(loadAjaxHTML){
                //     $('#detail_img2').html(loadAjaxHTML),
                // })
            }
        })
    })
})
$(document).ready(function(){
    $("table").on('click','td#product-detail',function(){
        var id = $(this).attr('data-id');
        var data ={id:id}
        $.ajax({
            url: "http://localhost/BACK-END/LARAVEL%20PRO/unimart/admin/product/detail_ajax",
            method: 'GET',
            data: data,
            dataType: 'json',
            success: function (data) {
                $('.modal .modal-body .user p').html(data.name);
                $('.modal .modal-body .title p').html(data.title);
                $('.modal .modal-body .status p').html(data.status);
                $('.modal .modal-body .create p').html(data.create);
                $('.modal .modal-body .color p ').html(data.color);
                $('.modal .modal-body .hight p ').html(data.hightlight);
                $('.modal .modal-body .id p').html(data.id);
                $('.modal .modal-body .img img').attr('src' ,data.img);
            }
        })
        // $.ajax({
        //     url: "http://localhost/BACK-END/LARAVEL%20PRO/unimart/admin/product/listColorAjax",
        //     method: 'GET',
        //     data: data,
        //     dataType: 'text',
        //     success: function (data) {
        //         console.log(data);
        //         $('.modal .modal-body .color p ').html(data);
        //     }
        // })
    })
});
