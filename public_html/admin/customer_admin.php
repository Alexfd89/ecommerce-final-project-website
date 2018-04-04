<?php 
require_once('../../includes/initialize.php');

if(!$session->is_logged_in())
redirect_to('login.php');

$user = User::find_all();
include_layout_template('header.php');

?>

<div class="container pb-5">

<h1>Customers</h1>
<h6>Total Users: <span id="total_users"><?php echo User::count() - 1;  ?></span></h6>
<table class="table table-striped">
    <thead>
        <tr>
            <th>id</th>
            <th>Email</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Date Registered</th>
        </tr>
    </thead>
    <tbody>
    
    <form id="user_delete">
        <?php while($row=mysqli_fetch_array($user)){ if($row['user_id'] != 1){?>
        <tr>
                <td><?php echo $row['user_id'];?></td>
                <td><?php echo $row['email'];?></td>
                <td><?php echo $row['first_name'];?></td>
                <td><?php echo $row['last_name'];?></td>
                <td><?php echo $row['reg_date'];?></td>
                <td><input type="hidden" name="user_delete" value="<?php echo $row['user_id'];?>"></td>
                <td><input type="hidden" name="total_users" value="<?php echo User::count() - 1;  ?>"></td>
                <td><input type="submit" class="btn btn-danger" value="Delete"></td>
               
        </tr>
        
        <?php } } ?>
        </form> 
        
    </tbody>


</table>

</div>

<?php include_layout_template('footer.php'); ?>
