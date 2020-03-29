<?php require_once("../../resources/config.php"); ?>
<?php include(TEMPLATE_FRONT . DS . "header.php") ?>
<?php include(TEMPLATE_FRONT . DS . "top_nav_admin.php") ?>






    <!-- Page Content -->
    <div class="container">

      <header>
            <h2 class="text-center">ADMIN Panel Login</h2>
      </header>



            <div class="row">
        			<div class="col-md-6 col-md-offset-3">
                <h2 class="text-center bg-warning">
                  <?php display_message(); ?></h2>  <!--Display Error Message -->
                </div>
              </div>




     <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-login">
          <div class="panel-body">
            <div class="row">
              <div class="col-lg-12">



<form id="login-form" method="POST" role="form" class="omb_loginForm" autocomplete="off" enctype="multipart/form-data">


                    <!--login Function -->
                    <?php login_admin(); ?>






                    <div class="input-group">
    										<span class="input-group-addon"><i class="fa fa-user"></i></span>
    										<input type="text" name="username" class="form-control" placeholder="username" required>
    								</div>
    								<span class="help-block"></span>


                    <div class="input-group">
    									<span class="input-group-addon"><i class="fa fa-lock"></i></span>
    									<input type="password" name="password" class="form-control" placeholder="Password" required>
    								</div>
    								<span class="help-block"></span>



                    <div class="form-group">
                      <div class="row">
                        <div class="col-sm-6 col-sm-offset-3">
                         <button type="submit" name="submit" id="login-submit"  class="btn btn-lg btn-primary btn-block">Login</button>
                        </div>
                      </div>
                    </div>

            </form>


            <div class="form-group">
              <input type="checkbox" tabindex="3" class="" name="remember" id="remember">
              <label for="remember"> Remember Me</label>
            </div>



            <div class="row">
              <div class="col-lg-12">
                  <a href="recover.php" tabindex="5" class="forgot-password">Forgot Password?</a>
              </div>
            </div>

        </div>







         </div>
       </div>
      </div>
    </div>
  </div>
</div>


   <?php include(TEMPLATE_FRONT . DS . "footer.php") ?>
