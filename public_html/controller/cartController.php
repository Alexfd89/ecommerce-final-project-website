<?php
require_once('../../includes/initialize.php');


if(isset($_POST['hidden_name']))
{
    
    if(!empty($_SESSION['shopping_cart']))
    {
        $item_array_id = array_column($_SESSION['shopping_cart'],"item_id");
        if(!in_array($_POST['item_id'], $item_array_id))
        {
            $count = count($_SESSION['shopping_cart']);            
            $item_array = array(
                'item_id' => $_POST['item_id'],
                'item_name' => $_POST['hidden_name'],
                'item_price' => $_POST['hidden_price'],
                'item_quantity' => $_POST['quantity'],
                'item_filename' => $_POST['hidden_filename']
            );
            $_SESSION['shopping_cart'][$count] = $item_array;
            echo $count + 1;
        }
        else
        {
            echo 100;
        }
    }
    else
    {
        $item_array = array(
            'item_id' => $_POST['item_id'],
            'item_name' => $_POST['hidden_name'],
            'item_price' => $_POST['hidden_price'],
            'item_quantity' => $_POST['quantity'],
            'item_filename' => $_POST['hidden_filename']
        );
        $_SESSION['shopping_cart'][0] = $item_array;
        echo 1;
    }
}

if(isset($_POST["del"]))
{     
    foreach($_SESSION['shopping_cart'] as $keys => $values)
    {
        if($values['item_id'] == $_POST['del'])
        {
            unset($_SESSION['shopping_cart'][$keys]);
            $_SESSION['shopping_cart'] = array_values($_SESSION['shopping_cart']);
        }
    }
}

if(isset($_POST['cart_list']))
{
    header('Content-Type: application/json');
    echo json_encode($_SESSION['shopping_cart']);
}

if(isset($_POST['shop_count']))
{
    if(count($_SESSION['shopping_cart']) > 0)
    echo count($_SESSION['shopping_cart']);
}



?>