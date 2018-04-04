<?php 
require_once('../../includes/initialize.php');

include_layout_template('header.php');
?>
    <h1 class="text-center bg-info text-white p-5">CREATE ACCOUNT</h1>

    <div class="container col-md-4 mt-5 mb-5">
        <div id="message"></div>
        <form id="registration" method="POST">
            <div class="form-group">
                <label for="email" class="font-weight-bold">Email</label>
                <input type="text" class="form-control" name="email">
            </div>
            <div class="form-group">
                <label for="pwd" class="font-weight-bold">Password</label>
                <input type="password" placeholder="(Min 6 characters)" class="form-control" name="password">
            </div>
            <div class="form-group">
                <label for="cpwd" class="font-weight-bold" >Confirm Password</label>
                <input type="password" placeholder="(Min 6 characters)" class="form-control"  name="c_pass">
            </div>
            <div class="form-group">
                <label for="fname" class="font-weight-bold">First Name</label>
                <input type="text" class="form-control"  name="first_name">
            </div>
            <div class="form-group">
                <label for="lname" class="font-weight-bold">Last Name</label>
                <input type="text" class="form-control" name="last_name">
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Register</button>
        </form>
    </div>
    <?php include_layout_template('footer.php'); ?>
