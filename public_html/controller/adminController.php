<?php
require_once('../../includes/initialize.php');


//=============================Add Item===================================

    $item = new Item();
    
        $item->name       =$_POST['name'];
        $item->quantity   =$_POST['quantity'];
        $item->price      =$_POST['price'];
        $item->category   =$_POST['category'];
        $item->description=$_POST['description'];
        $item->brand_name =$_POST['brand'];
        //uploaded image
        $item->attach_file($_FILES['file_upload']);
    
        if($item->save())
        {
            $message = "<div class='alert alert-success'> Item Added Successfully</div>";
            
        }
        else
        {
            $message ="<div class='alert alert-danger'>".join("<br>",$item->errors)."</div>";
        }
        echo $message;
        

    
?>