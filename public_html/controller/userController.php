<?php
require_once('../../includes/initialize.php');

//==================================Delete Users=================================================

if(isset($_POST['user_delete']))
{
    $row = User::find_by_id($_POST['user_delete']);
    $res = mysqli_fetch_array($row);
    $user_to_delete = User::instantiate($res);
    $user_to_delete->delete();
    echo $_POST['total_users'] - 1;
}


?>