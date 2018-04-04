<?php
require_once('../../includes/initialize.php');

$message = "";

if(isset($_POST['submit']))
{
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $hashpass = sha1($pass);

    $user = User::authenticate($email,$hashpass);
    if($user != null)
    {
        $session->login($user);
        $_SESSION['email'] = $email;

        if(!empty($_POST['remember']))
        {
            setcookie ("email",$_POST['email'],time() + (10 * 365 * 24 * 60 * 60));
            setcookie ("password",$_POST['password'],time() + (10 * 365 * 24 * 60 * 60));
        }
        else
        {
            if(isset($_COOKIE['email']))
            setcookie('email','');
            if(isset($_COOKIE['password']))
            setcookie('password','');
        }

        redirect_to('index.php');
    }
    else
    {
        $message = "Invalid Email or Password";
    }
}



include_layout_template('header.php');
?>


<div class="container col-md-3 mt-5 card pb-5 p-3">
<?php if(!empty($message)){?>
<div class="alert alert-danger">
<?php echo $message;?>
  </div>
<?php }?>
  
  <div class="h1 mb-5">Log in</div>
    <form action="login.php" method="POST">
        <div class="input-group form-group">
            <span class="input-group-addon"><i class="material-icons">email</i></span>
            <input type="text" class="form-control" placeholder="Enter email" name="email" value="<?php if(isset($_COOKIE['email'])){echo $_COOKIE['email'];} ?>">
        </div>
        <div class="input-group form-group">
            <span class="input-group-addon"><i class="material-icons">vpn_key</i></span>
            <input type="password" class="form-control" placeholder="Enter password" name="password" value="<?php if(isset($_COOKIE['password'])){echo $_COOKIE['password'];} ?>">
        </div>
        <div class="form-check">
            <label class="form-check-label">
            <input class="form-check-input" type="checkbox" name="remember" <?php if(isset($_COOKIE['email'])){ ?> checked <?php }?>> Remember me
        </label>
        </div>
        <label for="su">New Here?</label>
        <a href="register.php" id="su" style="text-decoration:none">Register Now</a>

        <button type="submit" class="btn btn-primary btn-block" name="submit">Login</button>
    </form>
</div>

<?php include_layout_template('footer.php'); ?>
