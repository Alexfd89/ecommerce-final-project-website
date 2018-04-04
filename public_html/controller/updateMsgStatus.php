<?php
require_once('../../includes/initialize.php');

Contact::find_by_sql("UPDATE contact_us SET is_read = 1 WHERE contact_id = ".$_POST['id']);
echo Contact::new_messages_count();
?>