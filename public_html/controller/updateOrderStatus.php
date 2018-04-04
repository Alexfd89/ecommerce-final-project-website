<?php
require_once('../../includes/initialize.php');
Order::find_by_sql("UPDATE orders SET is_watched = 1 WHERE order_id = ".$_POST['id']);
?>