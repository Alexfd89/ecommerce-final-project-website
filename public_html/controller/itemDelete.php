<?php 
require_once('../../includes/initialize.php');

if(isset($_POST['id']))
{
    $rows = Item::find_by_id($_POST['id']);
    $row = mysqli_fetch_array($rows);
    //$item object
    $item_delete=Item::instantiate($row);
    $item_delete->destroy();
}

?>
