<?php require_once("../resources/config.php"); ?>
<?php require_once("../resources/gconfig.php"); ?>
<?php require_once("../resources/fconfig.php"); ?>
<?php include(TEMPLATE_FRONT . DS . "header.php") ?>
<?php include(TEMPLATE_FRONT . DS . "top_nav.php") ?>



<!-- if user is already logged in, Don't show the loginUser.php page-->
<?php

	if(logged_in()){

		redirect("index.php");
	}

?>

<!--for google login -->
<?php

	$loginURL  = $gClient->createAuthUrl();

?>

<!--for facebook login -->
<?php
		$redirectURL = "http://localhost/ecom/resources/fb-callback.php";
		$permissions = ['email'];
		$loginURL2 = $helper->getLoginUrl($redirectURL, $permissions);
?>


















<div class="container">
		<div class="row">
			<div class="col-lg-6 col-lg-offset-3">

					<!--if the user is logged in or not -->
					<h2 class="text-center"> <?php display_message(); ?>  </h2>
								<?php validate_user_login(); ?>

			</div>
		</div>



		<div class="omb_login">
					<h3 class="omb_authTitle">Login or <a href="register.php">Sign up</a></h3>


					<div class="form-group">
								<div class="row">
										<div class="col-lg-6 col-sm-offset-3">
												<div class="col-sm-6 col-sm-offset-3">
												 		<input type="button" onclick="window.location = '<?php echo $loginURL ?>';" value="Log In With Google" class="btn btn-lg btn-danger btn-block">
												</div>
									</div>
							</div>
					</div>

					<div class="form-group">
								<div class="row">
										<div class="col-lg-6 col-sm-offset-3">
												<div class="col-sm-6 col-sm-offset-3">
														<input type="button" onclick="window.location = '<?php echo $loginURL2 ?>';" value="Log In With Facebook" class="btn btn-lg btn-primary btn-block">
												</div>
									</div>
							</div>
					</div>




				<div class="row omb_row-sm-offset-3 omb_loginOr">
					<div class="col-xs-12 col-sm-6">
						<hr class="omb_hrOr">
						<span class="omb_spanOr">or</span>
					</div>
				</div>




		    <div class="row">
					<div class="col-md-6 col-md-offset-3">
						<div class="panel panel-login">

								<div class="panel-heading">
									<div class="row">
										<div class="col-xs-6">
											<a href="login.php" class="active" id="login-form-link">Login</a>
										</div>
										<div class="col-xs-6">
											<a href="register.php" id="">Sign Up</a>
										</div>
									</div>
									<hr>
								</div>




						<div class="panel-body">
							<div class="row">
								<div class="col-lg-12">

										<form id="login-form" method="POST" role="form" class="omb_loginForm" autocomplete="off">
												<div class="input-group">
														<span class="input-group-addon"><i class="fa fa-user"></i></span>
														<input type="text" name="email" id="email" tabindex="1" class="form-control" placeholder="Email" required>
												</div>
												<span class="help-block"></span>

												<div class="input-group">
													<span class="input-group-addon"><i class="fa fa-lock"></i></span>
													<input type="password" name="password" id="login-password" tabindex="2" class="form-control" placeholder="Password" required>
												</div>
												<span class="help-block"></span>

												<div class="form-group">
													<div class="row">
														<div class="col-sm-6 col-sm-offset-3">
														 <button type="submit" name="login-submit" id="login-submit" tabindex="4" class="btn btn-lg btn-primary btn-block">Login</button>
														</div>
													</div>
												</div>
										</form>

										<div class="form-group">
											<input type="checkbox" tabindex="3" class="" name="remember" id="remember" value="yes">
											<label for="remember"> Remember Me</label>
										</div>

										<div class="row">
											<div class="col-lg-12">
													<a href="recover.php" tabindex="5" class="forgot-password">Forgot Password?</a>
											</div>
										</div>



									</div> <!--col-lg-12-->
								</div> <!--row-->
							</div> <!--panel-body-->
						</div> <!--panel panel-login-->
					</div> <!--col-md-6 col-md-offset-3-->
				</div><!--row-->
			</div> <!--omb_login-->
</div> <!--container-->
   <?php include(TEMPLATE_FRONT . DS . "footer.php") ?>
