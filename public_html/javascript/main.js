
//==================================Registration=================================================
$(function(){

    $("#registration").on("submit",function(e)
    {
        e.preventDefault();
        var data = $('#registration').serialize();
        $.ajax({
            url: "../controller/registerController.php",
            type: "POST",
            data: data
        })
        .done(function(response)
        {        
            $('#message').html(response);
        })
    })
//==================================Customers list delete=================================================

    $("#user_delete").on("submit",function(e){
        e.preventDefault();
        var data = $('tr:hover td input').serialize();
        $.ajax({
            url: "../controller/userController.php",
            type: "POST",
            data: data
        })
        .done(function(response){
            $('tr:hover').remove();
            $("#total_users").html(response);
        })
    })

//==================================Add/Delete Category=================================================
$("#category_add").on("submit",function(e){
    e.preventDefault();
    var data = $('#category_add').serialize();
    $.ajax({
        url: "../controller/categoryController.php",
        type: "POST",
        data: data
    })
    .done(function(response){
        $("#category_table").append(response);
    })

})

$("#category_delete").on("submit",function(e){
    e.preventDefault();
    var data = $('tr:hover td input').serialize();
    $.ajax({
        url: "../controller/categoryController.php",
        type: "POST",
        data: data
    })
    .done(function(response){
        $("tr:hover").remove();
    })

})
//==================================Add/Delete Brand=================================================

$("#brand_add").on("submit",function(e){
    e.preventDefault();
    var data = $("#brand_name").serialize();
    $.ajax({
        url: "../controller/brandController.php",
        type: "POST",
        data: data
    })
    .done(function(response){
        $("#brand_table").append(response);
    })
})

$("#brand_delete").on("submit",function(e){
    e.preventDefault();
    var data = $('tr:hover td input').serialize();
    $.ajax({
        url: "../controller/brandController.php",
        type: "POST",
        data: data
    })
    .done(function(response){
        $("tr:hover").remove();
    })

})

//===============================Item Add============================================
$(".item_add_form").submit(function(e){
    e.preventDefault();
    var data = new FormData(this);
    $.ajax({
        url: "../controller/adminController.php",
        enctype: "multipart/form-data",
        type: "POST",
        data: data,
        cache: false,
        contentType: false,
        processData: false
    })
    .done(function(response){
        $("#item_add_msg").append(response);
    })
})

//===========================Update/Delete Item=====================================
$(".updateBtn").click(function(e){
    e.preventDefault();
    var data = $("table:hover .item_list_form").serialize();
    $.ajax({
        type: "POST",
        url: "../controller/itemUpdate.php",
        data: data
    })
    .done(function(response){
        swal(response,"");

    })
})

$(".deleteBtn").click(function(e){
    e.preventDefault();
    var data = $("table:hover .item_list_form").serialize();
    $.ajax({
        type: "POST",
        url: "../controller/itemDelete.php",
        data: data
    })
    .done(function(response){
        $("table:hover").remove();
    })
})

//===================================Edit Profile============================================

$("#profile").submit(function(e){
    e.preventDefault();
    var data = $(this).serialize();
    $.ajax({
        type: "POST",
        url: "../controller/profileController.php",
        data: data
    })
    .done(function(response){
        if(response == true)
        {
            swal("Your profile updated successfully", "", "success");
        }
        else
        {
            var msg = "<div class='alert alert-danger'>Email already exists</div>";
            $("#profile_msg").html(msg);
            $("#email_edit").addClass("border-danger");
        }
    })
})

$("#email_edit" ).keyup(function(){
    $("#profile_msg div").remove();
    $("#email_edit").removeClass("border-danger");    
  });
//=================================Change Password========================================
  $("#change_password").submit(function(e){
    e.preventDefault();
    var data = $(this).serialize();
    $.ajax({
        type: "POST",
        url: "../controller/profileController.php",
        data: data
    })
    .done(function(response){
        if(response == true)
        {
            swal("Password updated successfully", "", "success");
            $("#pass_msg div").remove();
        }
        else
        {
            $("#pass_msg").html(response);
        }
    })
})
//================================Update Shipping Address================================
$("#shipping_address").submit(function(e){
    e.preventDefault();
    var data = $(this).serialize();
    $.ajax({
        type: "POST",
        url: "../controller/profileController.php",
        data: data
    })
    .done(function(){
        swal("Your address updated successfully", "", "success");
    })
})

//=============================Contact us================================================

$("#contact").submit(function(e){
    e.preventDefault();
    var data = $(this).serialize();
    $.ajax({
        type: "POST",
        url: "../controller/contactUsController.php",
        data: data
    })
    .done(function(){
        swal("Message Sent Successfully","We will be in touch","success");
    })
})
//delete message
$(".message").submit(function(e){
    e.preventDefault();
    var data = $(".card:hover input").serialize();
    $.ajax({
        type: "POST",
        url: "../controller/contactusController.php",
        data: data
    })
    .done(function(){
        $(".card:hover").remove();
    })
})
//=============================Order delete================================================
$(".order").submit(function(e){
    e.preventDefault();
    var data = $(".card:hover input").serialize();
    $.ajax({
        type: "POST",
        url: "../controller/orderController.php",
        data: data
    })
    .done(function(){
        $(".card:hover").remove();
    })
})


$(".admin").click(function(e){
    e.preventDefault();
    $.ajax({
        url: "../controller/ntf_order.php"
    })
    .done(function(response){
        if(response > 0)
        $("#order_count").html(response);
        else
        $("#order_count").remove();

    })
})

$(".admin").click(function(e){
    e.preventDefault();
    $.ajax({
        url: "../controller/ntf_msg.php"
    })
    .done(function(response){
        if(response > 0)
        $("#msg_count").html(response);
        else
        $("#msg_count").remove();

    })
})
//=============================Check quantity limit===============================================
$("#cart_add").on("change",function(){
    var input = $("#cart_add option:selected").val();
    var quantity = $("#qnt_check").val();
    var price = $("#item_price").val();
    if(+input < 0)
    {
        swal("Error!", "illegal input", "error");
        $("input:text").val(1);
    }
    else if(+input > +quantity)
    {
        swal("The quantity is limited to "+quantity+" Pieces", "", "error");
        $("input:text").val(quantity);
        $("h6").html("Price: $"+quantity*price);
    }
    else
    {
        $("h6").html("Price: $"+input*price);
    }
})

//=============================Shopping Cart===============================================

//Add to cart
$("#cart_add").submit(function(e){
    e.preventDefault();
    var data = $(this).serialize();
    $.ajax({
        type: "POST",
        url: "../controller/cartController.php",
        data: data
    })
    .done(function(response){
        console.log(response);
        if(response == 100){
            swal("Item already exists in the cart", "", "warning");
        }
        else{
            swal("Item Added to cart", "", "success");       
            $("#shop_count").html(response); 
            $("#checkout").removeClass('disabled');
        }
    });
})

$("#shop_count").ready(function(){
    var shop_count = '1';
    $.ajax({
        type: 'POST',
        url: '../controller/cartController.php',
        data: {shop_count:shop_count}
    })
    .done(function(response){
        if(response > 0){
            $("#shop_count").html(response);
            $("#checkout").removeClass('disabled');
        }
        else{
            $("#checkout").addClass('disabled');
        }
    })
})

$("#shop_cart").on("click", function(){
    var cart_list = '1';
    $("#cart_table").html("<img style='width:400px;' src='../images/empty.jpg'>");
    $.ajax({
        url:  "../controller/cartController.php",
        data: {cart_list:cart_list},
        type: 'POST'
    })
    .done(function(response){
        console.log(response);
        if(response != ''){
            var total = 0;
            var output = '';
            for(i = 0 ; i < response.length ; i++){
                total += +response[i].item_price * +response[i].item_quantity; 
                var text = 
                "<tr><input type='hidden' value='"+response[i].item_id+"'><td><a href='item_details.php?id="+response[i].item_id+"' ><img src='../images/"+response[i].item_filename+"' style='width:40px; height:65px;'/></a>"+
                "</td><td>"+response[i].item_name+"</td>"+
                "<td>"+response[i].item_quantity+" x $"+response[i].item_price+"</td>"+
                "<td><a href=''><i class='material-icons text-danger'>cancel</i></a></td></tr>";
                output += text;
            }
            $("#cart_table").html(output);
            $("#cart_table").append("<tr><td><span class='h6'>Total: $"+total+"</span></td></tr>"); 
        }
        else{
            $("#cart_table").html("<img style='width:400px;' src='../images/empty.jpg'>");
        }
    })
});

$("#cart_table").on("click", "a",function(){
    var del = $("#cart_table tbody tr input").val();
    $.ajax({
        url: "../controller/cartController.php",
        data: {del:del},
        type: 'POST'
    })
});

//=============================SEARCH STORE================================================
$(document).ready(function()
    {
        load_data();

        function load_data(category,brand,key,range)
        {
            $.ajax({
                url: '../controller/searchController.php',
                method: 'POST',
                data: {category:category,brand:brand,key:key,range:range}
            })
            .done(function(response)
            {
                 $("#result").html(response);
            })
        }

        $("#search_text").keyup(function()
        {
            var search_key = $(this).val();
            if(search_key != null)
                load_data(null,null,search_key,null);
            else
                load_data();
        });

    
        $("#m_price").each(function(){
            var slider = $('.range-slider'),
                range = $('.range-slider__range'),
                value = $('.range-slider__value');
              
                slider.each(function(){
          
                    value.each(function(){
                    var value = $(this).prev().attr('value');
                    $('.range-slider__value').html("Max Price $" + value);
                    
                    });
          
                    range.on('input', function(){
                        $(this).next(value).html( "Max Price $" + this.value);
                     });
                });
          });
        

        $("#filter").on("change",function(){

            var search_category = $("#category_filter option:selected").val();
            var search_brand = $("#brand_filter option:selected").val();
            var range = $(".range-slider input").val();

            load_data(search_category,search_brand,null,range);
        });

        

    });


























   


})

