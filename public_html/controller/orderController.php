<?php
require_once('../../includes/initialize.php');

if(isset($_POST['order_delete']))
{

//Delete Order
$row = Order::find_by_id($_POST['order_delete']);
$res = mysqli_fetch_array($row);
$order_to_delete = Order::instantiate($res);
$order_to_delete->delete();

//Delete Cart
$cart_to_delete = new Cart($res['user_id']);
$cart_to_delete->cart_id = $res['cart_id'];
$cart_to_delete->delete();
    
}
?>