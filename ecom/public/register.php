<?php require_once("../resources/config.php"); ?>
<?php include(TEMPLATE_FRONT . DS . "header.php") ?>
<?php include(TEMPLATE_FRONT . DS . "top_nav.php") ?>




<div class="container">
	<h1 class="text-center"> <?php display_message(); ?>  </h1>


			<div class="row" >
				<div class="col-lg-6 col-lg-offset-3">
					<?php validate_user_registration(); ?>
				</div>
			</div>



    	<div class="row" >
				<div class="col-md-6 col-md-offset-3">
					<h2 class="text-center">User Registration Form</h2>
						<div class="panel panel-login" >
							<div class="panel-body">
								<div class="row">
									<div class="col-lg-12">



											<form id="register-form" method="post" role="form" >

														<!--keep_value() function is used for keeping the value if user do any error -->
														<div class="form-group">
															<input type="text" name="first_name" id="first_name" tabindex="1" class="form-control" placeholder="First Name" value="<?php keep_value('first_name') ?>" required >
														</div>

														<div class="form-group">
															<input type="text" name="last_name" id="flast_name" tabindex="1" class="form-control" placeholder="Last Name" value="<?php keep_value('last_name') ?>" required >
														</div>

														<div class="form-group">
															<input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Username" value="<?php keep_value('username') ?>" required >
														</div>


														<div class="form-group">
															<input type="text" name="address" id="address" tabindex="1" class="form-control" placeholder="Full Address" value="<?php keep_value('address') ?>" required >
														</div>


														<div class="form-group">
															<input type="text" name="zipcode" id="zipcode" tabindex="1" class="form-control" placeholder="Zip-Code" value="<?php keep_value('zipcode') ?>" required >
														</div>

														<div class="form-group">
															<input type="text" name="phone" id="phone" tabindex="1" class="form-control" placeholder="Phone Number" value="<?php keep_value('phone') ?>" required >
														</div>

														<div class="form-group">
															<input type="email" name="email" id="register_email" tabindex="1" class="form-control" placeholder="Email Address" value="<?php keep_value('email') ?>" required >
														</div>

														<div class="form-group">
															<input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password" required>
														</div>

														<div class="form-group">
															<input type="password" name="confirm_password" id="confirm-password" tabindex="2" class="form-control" placeholder="Confirm Password" onkeyup="checkpass()"; required><span id="checkpass"></span>

														</div>


														<div class="form-group">
															<div class="row">
																<div class="col-sm-6 col-sm-offset-3">
																	<input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Register Now">
																</div>
															</div>
														</div>
										</form>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="js/regscript.js"></script>
<?php include(TEMPLATE_FRONT . DS . "footer.php") ?>
