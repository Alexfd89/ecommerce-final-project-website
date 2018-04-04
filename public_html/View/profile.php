<?php
require_once('../../includes/initialize.php');

$res = User::find_by_id($_SESSION['user_id']);
$row = mysqli_fetch_array($res);
//user as object
$user = User::instantiate($row);

include_layout_template('header.php');
?>
<h1 class="text-center bg-info text-white p-5">EDIT PROFILE</h1>

<div class="container pb-5">
    <div class="card mt-2">
        <div class="card-header h6 bg-dark text-white">
            Edit Profile
        </div>
        <div class="card-block p-5">
            <form id="profile">
                <div class="form-group row">
                    <label for="email_edit" class="font-weight-bold col-lg-2 col-form-label">Email address:</label>
                    <div class="col-lg-5">
                        <div id="profile_msg"></div>
                        <input type="text" class="form-control" id="email_edit" name="email" value="<?php echo $user->email; ?>"/>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="first_name" class="font-weight-bold col-lg-2 col-form-label">First Name:</label>
                    <div class="col-lg-5">
                        <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $user->first_name; ?>"/>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="last_name" class="font-weight-bold col-lg-2 col-form-label">Last Name:</label>
                    <div class="col-lg-5">
                        <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo $user->last_name; ?>"/>
                    </div>
                </div>
                <input type="hidden" name="profile_id" value="<?php echo $user->user_id; ?>">
                <input type="submit" class="btn btn-primary" value="Update">
            </form>
        </div>
    </div> 
    <div class="card mt-5">
        <div class="card-header h6 bg-dark text-white">
            Edit Shipping Details
        </div>
        <div class="card-block p-5">
            <form id="shipping_address">
                <div class="form-group row">
                    <label for="ship_country" class="font-weight-bold col-lg-2 col-form-label">Country:</label>
                    <div class="col-lg-5">
                        <input type="text" class="form-control" id="ship_country" name="ship_country" value="<?php echo $user->ship_country;?>"/>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="ship_city" class="font-weight-bold col-lg-2 col-form-label">City:</label>
                    <div class="col-lg-5">
                        <input type="text" class="form-control" id="ship_city" name="ship_city" value="<?php echo $user->ship_city;?>"/>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="ship_address" class="font-weight-bold col-lg-2 col-form-label">Address:</label>
                    <div class="col-lg-5">
                        <input type="text" class="form-control" id="ship_address" name="ship_address" value="<?php echo $user->ship_address;?>"/>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="ship_postal_code" class="font-weight-bold col-lg-2 col-form-label">Postal Code:</label>
                    <div class="col-lg-5">
                        <input type="text" class="form-control" id="ship_postal_code" name="ship_postal_code" value="<?php echo $user->ship_postal_code;?>"/>
                    </div>
                </div>
                <input type="submit" class="btn btn-primary" value="Update">
            </form>
        </div>
    </div>
    <div class="card mt-5">
        <div class="card-header h6 bg-dark text-white">
            Change Password
        </div>
        <div class="card-block p-5">
            <form id="change_password">
            <p style="color:grey;">Type your new password twice to change</p>
                <div class="form-group row">
                    <label for="new_pass" class="font-weight-bold col-lg-2 col-form-label">Password:</label>
                    <div class="col-lg-5">
                        <div id="pass_msg"></div>
                        <input type="password" class="form-control" id="new_pass" value="" name="new_pass"/>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="confirm_pass" class="font-weight-bold col-lg-2 col-form-label">Confirm Password:</label>
                    <div class="col-lg-5">
                        <input type="password" class="form-control" id="confirm_pass" value=""  name="confirm_pass"/>
                    </div>
                </div>
                <input type="submit" class="btn btn-primary" value="Update">
            </form>
        </div>
    </div>
</div>



<?php include_layout_template('footer.php'); ?>
