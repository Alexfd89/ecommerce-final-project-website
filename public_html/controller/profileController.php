<?php
require_once('../../includes/initialize.php');

//===================================Edit Profile============================================
$res = User::find_by_id($_SESSION['user_id']);
$row = mysqli_fetch_array($res);
$user = User::instantiate($row);

if(isset($_POST['profile_id']))
{
    if(!User::is_email_exist($_POST['email']) && ($_POST['email'] != $_SESSION['email']))
    { 
        echo $message = false;  
    }
    else
    {
        $user->email = $_POST['email'];
        $user->first_name = $_POST['first_name'];
        $user->last_name = $_POST['last_name'];
        $user->update();
        $_SESSION['email'] = $user->email;
        echo $message = true; 
    }
}
//==================================Edit Password=============================================

if(isset($_POST['new_pass']))
{
    $message = '';
    if($_POST['new_pass'] != $_POST['confirm_pass'])
    {
        $message .= "<div class='alert alert-danger'> Passwords does not match </div>";
    }
    else if(strlen($_POST['new_pass']) < 6)
    {
        $message .= "<div class='alert alert-danger'>Password must contain at least 6 characters</div>";
    }
    else
    {
        $hashpass = sha1($_POST['new_pass']);
        $user->password = $hashpass;
        $user->update();
        $message = true;        
    }
    echo $message;
}

//================================Edit Shipping Address======================================

if(isset($_POST['ship_address']))
{
    $user->ship_address = $_POST['ship_address'];
    $user->ship_city = $_POST['ship_city'];
    $user->ship_postal_code = $_POST['ship_postal_code'];
    $user->ship_country = $_POST['ship_country'];
    $user->update();
}

//=================================End=======================================================

?>