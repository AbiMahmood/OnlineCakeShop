<?php
require_once("config.php");






/****************************HELPER FUNCTIONS for login and registration************************/

//displaying validation_errors for forms using bootstrap alert component
function validation_errors($error_message){

$error_message = <<<DELIMETER

	        <div class="alert alert-danger alert-dismissible" role="alert">
	            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	            <strong>Warning!</strong> $error_message
	        </div>

DELIMETER;
return $error_message;


}








//email exists
function email_exists($email){

	$sql = "SELECT id FROM login_users WHERE email = '$email' ";

	$result = query($sql);

	if (row_count($result) == 1){

		return true;

	} else {

		return false;
	}

}





//username exists
function username_exists($username){

	$sql = "SELECT id FROM login_users WHERE username = '$username' ";

	$result = query($sql);

	if (row_count($result) == 1){

		return true;

	} else {

		return false;
	}

}





//integer number checking for phone and zipCode
function int_check($result){

  if(is_numeric($result)){

		return true;

	}else {

		return false;

	}

}





//function for keeping the value if user makes a mistake in validating form. used in register.php
function keep_value($result){

			if(isset($_POST[$result])){

				echo $_POST[$result];

			}
}





//function for encrypting id
//placed in recover.php
//we want to make sure the data is being submitted in the the token given page alone
//whatever the data getting comes from the form
//this is not going to be available for us unless we submit the form
function token_generator(){
																//creates encrypted, UniqueID, Random token, gives everytime a new value
			$token = $_SESSION['token'] = md5(uniqid(mt_rand(), true));

			return $token;

}






/******************************************************************************************/













/****************************VALIDATION USER REGISTRATION FUNCTION************************/

//placed in register.php
// checking for all the registration fields are OK
function validate_user_registration(){

      if (isset($_POST['register-submit'])){

            $errors = []; //set up of an array for displaying the errors
            $character_min = 3;     //set up of minimum character
            $character_max = 25;    //set up of maximum character
						$address_max = 255;
						$zipcode_max = 6;
						$zipcode_min = 3;
						$phone_max = 14;
						$phone_min = 7;


//CLEAN: function for cleaning The htmlentities() function converts characters to HTML entities.
            $first_name         = clean($_POST['first_name']);
            $last_name          = clean($_POST['last_name']);
            $username           = clean($_POST['username']);
						$address            = clean($_POST['address']);
						$zip_code           = clean($_POST['zipcode']);
						$phone              = clean($_POST['phone']);
            $email              = clean($_POST['email']);
            $password           = clean($_POST['password']);
            $confirm_password   = clean($_POST['confirm_password']);



//limiting the minimum and maximum characters of first name
        if(strlen($first_name) < $character_min ){
          $errors[] = "Your first name can not be less than {$character_min} characters";
				}

        if(strlen($first_name) > $character_max ){
          $errors[] = "Your first name can not be more than {$character_max} characters";
        }


//limiting the minimum and maximum characters of last name
        if(strlen($last_name) < $character_min ){
          $errors[] = "Your last name can not be less than {$character_min} characters";
        }

        if(strlen($last_name) > $character_max ){
          $errors[] = "Your last name can not be more than {$character_max} characters";
        }


//limiting the minimum and maximum characters of username
        if(strlen($username ) < $character_min ){
          $errors[] = "Your username name can not be less than {$character_min} characters";
        }

        if(strlen($username ) > $character_max ){
          $errors[] = "Your username name can not be more than {$character_max} characters";
        }


//limiting the maximum characters of Home Address
        if(strlen($address ) > $address_max ){
          $errors[] = "Your address can not be more than {$address_max} characters";
        }


//limiting the minimum and maximum characters of ZIP CODE
        if(strlen($zip_code) < $zipcode_min ){
          $errors[] = "Your Zip-Code can not be less than {$zipcode_min} characters";
        }

        if(strlen($zip_code) > $zipcode_max ){
          $errors[] = "Your Zip-Code can not be more than {$zipcode_max} characters";
        }

//checking if the zipcode is integer value of not
				if (int_check($zip_code)){

				}else{
					$errors[] = "Your Zip-Code is in invalid character. Please give Numeric Digit Number Only";
				}


//limiting the minimum and maximum characters of first name
        if(strlen($phone) < $phone_min ){
          $errors[] = "Your phone number can not be less than {$phone_min} characters";
        }

        if(strlen($phone) > $phone_max ){
          $errors[] = "Your phone number can not be more than {$phone_max} characters";
        }

//checking if the phone number is integer value of not
				if (int_check($phone)){

				}else{
					$errors[] = "Your phone number is in invalid character. Please give Numeric Digit Number Only";
				}




//checking if email already exists or not
        if(email_exists($email)){
          $errors[] = "Sorry! that email is already registered";
        }

//checking if username already exists or not
        if(username_exists($username)){
          $errors[] = "Sorry! that username is already taken";
        }

//checking if password fields matches
        if($password !== $confirm_password ){
          $errors[] = "Your passwords fields do not match";
        }



//error display, all the fields are NOT OK
        if(!empty($errors)){

          foreach ($errors as $error) {           //for each single error display its error

    					echo validation_errors($error);     //bootstrap alert echo in DELIMETER
  }
      	}	else {																	//if all the reg fields are OK, then register the infos into the database

		        if(register_user($first_name, $last_name, $username,  $address , $zip_code, $phone, $email, $password)){

									set_message("<p class='bg-success text-center'> Please check your Email inbox/Spam folder for an activation link </p>");
									redirect("register.php");

        		}else{

									set_message("<p class='bg-danger text-center'> Sorry! We could not register the user </p>");
									redirect("register.php");
						}
      }

  }

}

/******************************************************************************************/






























/****************************REGISTER USER FUNCTION************************/

function register_user($first_name, $last_name, $username,  $address , $zip_code, $phone, $email, $password){

// escape_string: function escapes special characters in a string for use in an SQL statement.
          $first_name   = escape_string($first_name);
          $last_name    = escape_string($last_name);
          $username     = escape_string($username);
					$address      = escape_string($address);
					$zip_code     = escape_string($zip_code);
					$phone        = escape_string($phone);
          $email        = escape_string($email);
          $password     = escape_string($password);


          if(email_exists($email)){               //if email exists

            	return false;

          }else if(username_exists($username)){  //if username exists

	            return false;

          }else {                                //if all good

            $password = md5($password); 		  	 //encrypting the password
            $validation_code = md5($username . microtime() );  //encrypting the username. The microtime() function returns the current Unix timestamp with microseconds.

//insert into database
            $sql = "INSERT INTO login_users(first_name, last_name, username, address, zipcode, phone, email, password, validation_code, active)";
            $sql.= " VALUES('$first_name' , '$last_name' , '$username' , '$address' , '$zip_code' , '$phone' , '$email' , '$password' , '$validation_code' , 0)";
            $result = query($sql);
            confirm($result);


//Activation Email for newly registered User
									$subject = "Activate Account";

$msg = <<<DELIMETER

					   Please click the link below or paste it in the browser to activate your Account <br/><br/>
						<b> http://localhost/ecom/public/activate.php?email=$email&code=$validation_code </b> <br/>

DELIMETER;
echo $msg;
//go to activate.php there send the EMAIL and validation code

									//sms_code($phone);
									send_email($email, $subject, $msg);



            return true;
          }

}

/******************************************************************************************/
























/****************************ACTIVATE USER FUCNTIONS************************/

//placed in activate.php
//function for activate the user by a link given in email after the registration
function activate_user(){

	if($_SERVER['REQUEST_METHOD'] == 'GET'){				//check server variables

			if(isset($_GET['email'])) {							  	//in GET request, pulling out EMAIL

						$email             = escape_string(clean($_GET['email']));
						$validation_code   = escape_string(clean($_GET['code']));



						$sql = "SELECT id FROM login_users WHERE email = '{$email}' AND validation_code = '{$validation_code}' ";
						$result = query($sql);
						confirm($result);


//if the user was found in the database, The row_count function returns the number of rows in a result set.
								if(row_count($result) == 1){

//update the user, active the state, users is active so validation code make it zero
											$sql2 = "UPDATE login_users SET active = 1, validation_code = 0 WHERE email = '{$email}' AND validation_code = '{$validation_code}' ";
											$result2 = query($sql2);
											confirm($result2);

											set_message("<p class='bg-success text-center'> Your account has been activated Please login</p>") ;
											redirect("loginUser.php");

								} else {

											set_message("<p class='bg-danger text-center'> Sorry! Your account could not be activated </p>") ;
											redirect("loginUser.php");


					      }

       }

  	}

}
/******************************************************************************************/





















//****************************VALIDATION USER LOGIN FUNCTION************************/

//placed in loginUser.php
// checking for all the login fields are OK
function validate_user_login(){

      if (isset($_POST['login-submit'])) {



            $errors = []; //set up of an array for displaying the errors
            $min = 3;     //set up of minimum character
            $max = 25;    //set up of maximum character

//CLEAN: function for cleaning The htmlentities() function converts characters to HTML entities.
            $email    = clean($_POST['email']);
            $password = clean($_POST['password']);





//checkin if email pass fields are blank
						if(empty($email)){
							$error[] = "Email field can not be empty";
						}

						if(empty($password)){
							$error[] = "password field can not be empty";
						}




//error display, all the fields are NOT OK
        if(!empty($errors)){

          foreach ($errors as $error) {											//for each single error display its error

    					echo validation_errors($error);								//bootstrap alert echo in DELIMETER
  }
      	}	else {

							if (login_user($email, $password, $remember)){

										redirect("index.php");

							}else{

									echo validation_errors("Your Credentials are not correct/Your Account is not Active");
							}

      }

	}
}



/******************************************************************************************/













/****************************LOGIN USER FUNCTION************************/

function login_user($email, $password, $remember){

					$email = escape_string($email);

					$sql = "SELECT password, id FROM login_users WHERE email = '{$email}' AND active = 1"; //user need to activate the email from his email activation link
					$result = query($sql);
					confirm($result);


if(row_count($result) == 1){

		$row = fetch_array($result);
		$db_password = $row['password'];

																														//decrypting the password from the database
					if(md5($password) === $db_password){

							if(isset( $_POST['remember'])){  //if remember me is ticked, then set it to ON and set cookie

								if($_POST['remember']=='yes'){

									setcookie('email' , $email, time() + 3600 );				//the cookie will expire in 10 secoonds

									}
								}

							$_SESSION['email'] = $email;									//if pass matched then save that in a session

									return true;

							}else{

									return false;
								}

			return true;

	} else{ // if row count finds 0 means false or soemhting

			return false;
	}

} //function ends here


/******************************************************************************************/








/****************************LOGED_IN  LOGGED_OUT  FUNCTION************************/



// placed in checkout.php
function logged_in(){

		if(isset($_SESSION['email']) || isset($_COOKIE['email']) ){  //make suring the session is set or the cookie remember me, either of this will log in

				return true;

		}else{

				return false;
		}

}



//logging out from the cookie used in logout.php
function logged_out(){

	if(isset($_SESSION['email'])){

				unset($_SESSION['email']);
				session_destroy();
				redirect("../public/loginUser.php");

	}

	elseif (isset($_COOKIE['email'])) {

				unset($_COOKIE['email']);
				setcookie('email' , $email , time() - 3600, '/' ); //after 5 sec the cookie will expire
				session_destroy();
				redirect("../public/loginUser.php");
	}


}


/******************************************************************************************/










/**********************RECOVER Password FUNCTION*********************/

//placed in recover.php
//function for recovering users password, by Forget Password
function recover_password_email(){

			if($_SERVER['REQUEST_METHOD'] == "POST"){			//Ensuring the form works

				if(isset($_POST['recover_submit'])){


						if(  isset($_SESSION['token']) && $_POST['token']  === $_SESSION['token']  ){  //session set to token, also sending a POST token and also if that equals to session token, // Makes it much more secure



									$email            =  escape_string(clean($_POST['email'])) ;  //coming from recover.php email form
									$validation_code  =  escape_string(md5($email . microtime())) ;  //creates encrypted validation code. The microtime() function returns the current Unix timestamp with microseconds.


											if(email_exists($email)){

														setcookie('temp_access_code', $validation_code, time() + 300 );			//setting a cookie for 5min for the code.php page

														$sql = "UPDATE login_users SET validation_code = '{$validation_code}' WHERE email = '{$email}' ";  //setting validation code in DB
														$result = query($sql);
														confirm($result);


//Recover password activation link email
														$subject = "Reset Your Password";

$msg = <<<DELIMETER
										   Here is your password reset code: <b> <h2> "{$validation_code}" </h2> </b>  <br/><br/>
										   Please click the link below or paste it in the browser to reset you account's password <br/><br/>
											<b> http://localhost/ecom/public/code.php?email=$email&code=$validation_code </b> <br/>
DELIMETER;
echo $msg;



																send_email($email, $subject, $msg);

																		set_message("<p class='bg-success text-center'> Please check your email/Spam Folder for password reset code </p>") ;
																		redirect("recover.php");





									}else{

											echo validation_errors("This Email does not exists"); //if the user gives a email that doesn't exist, show error

									} /*email check*/

					}else{

							echo validation_errors("Token is not same, Wrong Token"); //if the user gives a wrong token, show error and redirect
							redirect("index.php");

						} /*tokens checks*/

					}

						if(isset($_POST['cancel_submit'])){
							redirect("loginUser.php");
						}

				} //POST request

		}// function



//***************************************************************************************************//


















//*********************************Pass reset activation CODE VALIDATION******************************************//

//placed in code.php
//fuction for validating the code that is given to user in email, forget password
function validation_code(){

		if(isset($_COOKIE['temp_access_code'])){  					//if the cookie from recover_password() is set only then execute this function

				if(!isset($_GET['email']) && !isset($_GET['code']) ) {				//email or code is not set in session

											redirect("index.php");

									}else if(empty($_GET['email']) || empty($_GET['code']) ){			//if email or code is empty //GETcode oming from reset link

											redirect("index.php");


									}else{ 	// if all good then--

										if(isset($_POST['code'])){

													$email           = escape_string(clean($_GET['email']));
													$validation_code = escape_string(clean($_POST['code']));

// Fetch the vali code from db and if the code matches with the user input then go to reset.php
													$sql = "SELECT id FROM login_users WHERE validation_code = '{$validation_code}' AND email = '{$email}'    ";
													$result = query($sql);
													confirm($result);


															if(row_count($result) == 1){				//if we get the matched code from user and DB

																		setcookie('temp_access_code', $validation_code, time() + 300 ); //5 mins for reset.php

																		redirect("reset.php?email=$email&code=$validation_code"); // to make sure user has came from the email link

																	}else{

																			echo validation_errors("Sorry Wrong Validation Code");
															}

														}//code


									}// if all good then

								}else{																							//else go to recover page again

										set_message("<p class='bg-danger text-center'> Sorry! Your Validation Code was expired</p>") ;
										redirect("recover.php");


									} //cookie check

}//function

//************************************************************************************//













//***************************** Password reset function************************//

//function for reseting the password
function password_reset(){

			if(isset($_COOKIE['temp_access_code'])){    														//if the cookie time is there

						if(isset($_GET['email']) && isset($_GET['code']) ){  							//fetch the email and code from link for the reset.php url

								if(isset($_SESSION['token']) && isset($_POST['token'])){   		//session token and post session token

										if($_POST['token'] === $_SESSION['token']){								//post token equal session token


												$password 				= escape_string(clean($_POST['password']));						//clean and escaping data fields coming from reset.php
												$confirm_password = escape_string(clean($_POST['confirm_password']));		//clean and escaping data fields coming from reset.php
												$email    				= escape_string(clean($_GET['email']));							//clean and escaping data fields coming from reset.php


												if($password === $confirm_password){			// pass fields checking

															$updated_password = md5($password);		//encrypting the new password

															$sql = "UPDATE login_users SET password = '{$updated_password}' , validation_code = 0, active = 1 WHERE email = '{$email}' ";			//update new pass in DB
															$result = query($sql);
															confirm($result);

															set_message("<p class='bg-success text-center'> Your Password has been updated. please login</p>") ;  //success message

															redirect("loginUser.php");


														}else{		// pass fields checking

																echo validation_errors("Your Password fields did not match. Please try again");

														}

												}//post token equal session token

											}//session token

									}//email & Code

					}else{//temp_access_code

							set_message("<p class='bg-danger text-center'> Sorry! Your time has Expired</p>") ;  //cookie expired
							redirect("recover.php");

				}//temp_access_code

}//function












































//Sending Email function for register_user(), recover_password()
function send_email($email, $subject, $msg) {

    require '.././public/classes/EmailConfigClass.php';				//necessary information fetching from EmailConfigClass.php
    //require '././vendor/autoload.php';					  						//include phpmailer class
		require '.././vendor/PHPMailer-master/PHPMailerAutoload.php';						//include phpmailer class



		$mail = new PHPMailer(); 												// Instantiate Class

		// Set up SMTP
		$mail ->IsSmtp();																// Sets up a SMTP connection
		$mail ->SMTPDebug = 0; 													// Enable verbose debug output
		$mail ->SMTPAuth = true; 												// Connection with the SMTP does require authorization
		$mail ->SMTPSecure = 'ssl';											// Enable TLS encryption, `ssl` also accepted
		$mail ->Host = LoginClass::SMTP_HOST;						// Specify main and backup SMTP servers
		$mail ->Port = LoginClass::SMTP_PORT; 					// Gmail SMTP port, TCP port to connect to
		$mail ->Username = LoginClass::SMTP_USER;   		// SMTP username
		$mail ->Password = LoginClass::SMTP_PASSWORD;		// SMTP password
		$mail->Encoding = '7bit';												//Encoding criteria
		$mail ->IsHTML(true);

	  $mail ->SetFrom(LoginClass::MAIL_FROM);					// Add an address of the person who will send the email, Name
		$mail ->AddAddress($email);											// Add a recipient who will get the Email

		$mail ->Subject = $subject;											//Subject of the Email
		$mail->MsgHTML($msg);										  	//Full message


		if(!$mail->Send())
		{
				echo "not sent";
				echo "error:" . $mail ->ErrorInfo;

		} else {

					echo "sent";
		}



}








/*
function sms_code($phone){

	require ('.././vendor/autoload.php');
  require '.././public/classes/smsConfigClass.php';				//necessary information fetching from EmailConfigClass.php

  use Twilio\Rest\Client;
	//use Twilio\Rest\Client;


			$account_sid    = smsClass::ACCOUNT_SID;
			$auth_token     = smsClass::AUTH_TOKEN;
			$twilio_number  = smsClass::TWILIO_NUMBER;
			$sender_number  = $phone;
			$sender_message = "Welcome to Cakeshop. Your Account has been Registered. ";


					if(isset($sender_number) && isset($sender_message)){

							$client = new Client($account_sid, $auth_token);

							$client->account->messages->create( $sender_number, array('from' => $twilio_number, 'body' => $sender_message));

						//	echo "<h3 class='text-center bg-success'>Message has been sent</h3>";


				 }



}

*/























 ?>
