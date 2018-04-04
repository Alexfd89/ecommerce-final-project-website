     <!-- *******************************The Modal************************************** -->
<div class="modal fade" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Login</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
      
        <form action="login.php" method="POST">
            <div class="input-group form-group">
                <span class="input-group-addon"><i class="material-icons">email</i></span>
                <input type="text" class="form-control" id="email" placeholder="Enter email" name="email" value="<?php if(isset($_COOKIE['email'])){echo $_COOKIE['email'];} ?>">
            </div>
            <div class="input-group form-group">
                <span class="input-group-addon"><i class="material-icons">vpn_key</i></span>
                <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="password" value="<?php if(isset($_COOKIE['password'])){echo $_COOKIE['password'];} ?>">
            </div>
            <div class="form-check">
                <label class="form-check-label">
                  <input class="form-check-input" type="checkbox" name="remember" <?php if(isset($_COOKIE['email'])){ ?> checked <?php }?>> Remember me
                </label>
            </div>
                <label for="su">New Here?</label>
                <a href="../View/register.php" id="su" style="text-decoration:none">Sign Up Now</a>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
      <button type="submit"  class="btn btn-primary btn-block" name="submit">Login</button>
      </form>
      </div>

    </div>
  </div>
</div>