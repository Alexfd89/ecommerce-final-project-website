<?php
require_once('../../includes/initialize.php');

if(isset($_POST['email_contact']))
{
    $message = new Contact();

    $message->contact_email = $_POST['email_contact'];
    $message->subject = $_POST['subject'];
    $message->message = $_POST['message'];
    date_default_timezone_set('Asia/Tel-Aviv');
    $message->time = date('d/m/y h:i', time());
    $message->create();
}

    if(isset($_POST['message_delete']))
    {
        $res = Contact::find_by_id($_POST['message_delete']);
        $row = mysqli_fetch_array($res);
        $msg_to_delete = Contact::instantiate($row);
        $msg_to_delete->delete();
    }
    



?>