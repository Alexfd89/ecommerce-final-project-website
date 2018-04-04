<?php 
require_once('../../includes/initialize.php');

$item_to_update = new Item();
    $message = "Please make changes to update";

    $item_to_update->item_id = $_POST['id'];
    $item_to_update->name = $_POST['name'];
    $item_to_update->quantity = $_POST['quantity'];
    $item_to_update->price = $_POST['price'];
    $item_to_update->category = $_POST['category'];
    $item_to_update->filename = $_POST['filename'];
    $item_to_update->type = $_POST['type'];
    $item_to_update->size = $_POST['size'];
    $item_to_update->description = $_POST['description'];
    $item_to_update->brand_name = $_POST['brand'];

    if($item_to_update->update())
    {
        $message = 'Item ' . $item_to_update->item_id . ' Updated Successfully.';
        
    }
    echo $message;
?>
