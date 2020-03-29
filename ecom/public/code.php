<?php require_once("../resources/config.php"); ?>
<?php include(TEMPLATE_FRONT . DS . "header.php") ?>
<?php include(TEMPLATE_FRONT . DS . "top_nav.php") ?>




<div class="container">


	<div class="row">
		<div class="col-lg-6 col-lg-offset-3">

             <?php validation_code(); ?>  <!-- checking the validation code function -->
		</div>
	</div>


    <div class="row">
				<div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2">
					<div class="alert-placeholder"></div>


					<div class="panel panel-success">
						<div class="panel-body">
							<div class="row">
								<div class="col-lg-12">
									<div class="text-center"><h2><b> Enter Code</b></h2></div>


									<form id="register-form"  method="post" role="form" autocomplete="off">

												<div class="form-group">
													<input type="text" name="code" id="code" tabindex="1" class="form-control" placeholder="######  ENTER CODE HERE  ######" value="" autocomplete="off" required/>
												</div>

												<div class="form-group">
													<div class="row">
														<div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3 col-xs-6">
															<input type="submit" name="code-submit" id="recover-submit" tabindex="2" class="form-control btn btn-success" value="Continue" />
														</div>
													</div>
												</div>


												<input type="hidden" class="hide" name="token" id="token" value="">

									</form>



								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php include(TEMPLATE_FRONT . DS . "footer.php") ?>
