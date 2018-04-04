<?php
require_once('../../includes/initialize.php');

if(isset($_SESSION['shopping_cart']))
{
    $cart = count($_SESSION['shopping_cart']);
}

$new_messages = Contact::new_messages_count();

?>

<!doctype html>
<html lang="en">
  <head>
    <title>FitShop</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Google Icons CSS -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Assistant" rel="stylesheet">
    <!--jQuery-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!--SweetAlerts-->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!--Ajax-->
    <script src="../javascript/main.js"></script>
    <!--CSS-->
    <link type="text/css" href="/PowerMass/public_html/stylesheet/style.css" rel="stylesheet" >
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
  </head>
<body>

<!---NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="/PowerMass/public_html/view/index.php">FitShop</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span></button>            
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="/PowerMass/public_html/view/index.php">HOME <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">ABOUT</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/PowerMass/public_html/view/contact_us.php">CONTACT US</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/PowerMass/public_html/view/store.php">STORE</a>
                </li>
                
                
                <?php if(isset($_SESSION['user_id']))
                { 
                    if($_SESSION['user_id'] == 1){?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-info admin" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Admin
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="/PowerMass/public_html/admin/item_admin.php">Items</a>
                        <a class="dropdown-item" href="/PowerMass/public_html/admin/customer_admin.php">Customers</a>
                        <a class="dropdown-item" href="/PowerMass/public_html/admin/order_admin.php">Orders
                        <span id="order_count" class="badge badge-danger badge-pill"></span>
                        </a>
                        <a class="dropdown-item" href="/PowerMass/public_html/admin/contactus_admin.php">Messages
                        <span id="msg_count" class="badge badge-danger badge-pill"></span>
                        </a>
                    </div>
                </li>
                <?php }} ?>
            </ul>
            
            <ul class="navbar-nav">
            
                <?php if(!isset($_SESSION['user_id'])){?>
                        <a href="/PowerMass/public_html/view/register.php" class="text-white btn btn-outline-secondary mr-1" style="text-decoration: none;" >Register</a>
                        <button type="button" class="btn btn-info mr-lg-5 log-in" data-toggle="modal" data-target="#myModal">Sign In</button>
                    <?php }else{?>
                        <a href="/PowerMass/public_html/view/logout.php" class="text-white btn btn-info mr-5" style="text-decoration: none;">Logout</a>
                        <li class="nav-item">
                            <div class="dropdown show nav-btn mr-2">
                                <a class="dropdown-toggle" href="#" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="material-icons text-white" style="font-size:40px;">person_outline</span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="/PowerMass/public_html/view/customer_orders.php">My Orders</a>
                                    <a class="dropdown-item" href="/PowerMass/public_html/view/profile.php">Edit Profile</a>
                                </div>
                            </div>
                        </li>
                    <?php }?>
                    <?php require_once('loginModal.php');?>

                
                <li class="nav-item">
                    <div class="dropdown nav-btn">
                        <a class="dropdown-toggle"  id="shop_cart" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="material-icons text-white position-absolute" style="font-size:40px;">shopping_cart</span><span class="badge badge-danger badge-pill position-absolute ml-4" id="shop_count" style="vertical-align: top;"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right p-0 mt-lg-4 s-cart" style="width: 400px;">
                                <div class="dropdown-header text-white bg-dark text-center">
                                    <i class="material-icons text-white">shopping_cart</i> 
                                    <span class="h6">Shopping Cart</span>
                                </div>
                                <table id="cart_table" class="table">
                                </table>
                         <div>
                                    <a href="/PowerMass/public_html/view/order_add.php" id="checkout" class="btn btn-info btn-block">Check Out</a>
                    </div>
                                
                        </div>
                    </div>
                </li>

            </ul>
        </div>

    </div>
</nav>



<style>
    .nav-btn .dropdown-toggle::after {
    display:none !important;
}
</style>

