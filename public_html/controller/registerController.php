<?php 
require_once('../../includes/initialize.php');

    $email = $_POST['email'];
    $pass = $_POST['password'];
    $c_pass = $_POST['c_pass'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $message = '';
    $flag = 1;

    if(empty($email))
    {
        $message .= "<div class='alert alert-danger'>Plsease enter your Email</div>";
        $flag = 0;
    }
    if(empty($pass))
    {
        $message .= "<div class='alert alert-danger'>Plsease enter Passwords</div>";
        $flag = 0;
    }
    if($pass != $c_pass)
    {
        $message .= "<div class='alert alert-danger'> Passwords does not match </div>";
        $flag = 0;
    }
    if(!User::is_email_exist($_POST['email']))
    {
        $message .= "<div class='alert alert-danger'>Account with this email already exists </div>";
        $flag = 0;
    }
    if(strlen($pass) < 6)
    {
        $message .= "<div class='alert alert-danger'>Password must contain at least 6 characters</div>";
        $flag = 0;
    }
    if(empty($first_name))
    {
        $message .= "<div class='alert alert-danger'>Plsease enter your First Name</div>";
        $flag = 0;
    }
    if(empty($last_name))
    {
        $message .= "<div class='alert alert-danger'>Plsease enter your Last Name</div>";
        $flag = 0;
    }
    if($flag != 0)
    {
        $message .= "<div class='alert alert-success'> Account Created Successfully</div>";

        $hashpass = sha1($pass);
        $newUser = new User();
        $newUser->email = $email;
        $newUser->password = $hashpass;
        $newUser->first_name = $first_name;
        $newUser->last_name = $last_name;
        $newUser->reg_date = date('d/m/Y');
        $newUser->create();
    }

echo $message;
?>
