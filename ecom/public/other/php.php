<?php
sleep(.5);
//Sanitize incoming data and store in variable
$name = trim(stripslashes(htmlspecialchars($_POST['name'])));
$email = trim(stripslashes(htmlspecialchars($_POST['email'])));
$phone = trim(stripslashes(htmlspecialchars($_POST['phone'])));
$phoneLink = preg_replace('/\D+/', '', $phone);
$message = trim(stripslashes(htmlspecialchars($_POST['message'])));
$humancheck = $_POST['humancheck'];
$honeypot = $_POST['honeypot'];

if ($honeypot == 'http://' && empty($humancheck)) {

		//Validate data and return success or error message
		$error_message = '';
		$reg_exp = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9-]+\.[a-zA-Z.]{2,4}$/";

		if (!preg_match($reg_exp, $email)) {

					$error_message .= "<p>A valid email address is required.</p>";
		}
		if (empty($name)) {

				    $error_message .= "<p>Please provide your name.</p>";
		}
		if (empty($message)) {

					$error_message .= "<p>A message is required.</p>";
		}
		if (!empty($error_message)) {
					$return['error'] = true;
					$return['msg'] = '<div class="alert alert-danger">'."<h3>Oops! The request was successful but your form is not filled out correctly.</h3>".$error_message;
					echo json_encode($return);
					exit();
		}

		else {
			//mail variables
			#$to =				'Mainstwebguy@gmail.com';
			$to =			'Jason@mainstreetcomp.com';
			$from = $_POST['email'];
			$headers =	'From: '.$from."\r\n";
			$headers .=	'MIME-Version: 1.0' . "\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			$subject = 	"Contact Form Submission\n";


			$body =			'<p>Name:   '.$name."</p>";
			$body	.=		'<p>Email:  '."<a href=\"mailto:".$email.'"'.">".$email."</a>"."</p>";
			if(isset ($phone) && $phone != '') {
				$body .=	'<p>Phone: '.'<a href="tel:+1'.$phoneLink.'"'.$phone.'>'.$phone."</a>";
			}

			$body .=		'<p>Message:   '.$message."</p>";

			//send email and return a message to user
			if(mail($to, $subject, $body, $headers)) {
				$return['error'] = false;
				$return['msg'] =
					'<div class="alert alert-success">'.
						"<h3>Thanks for your feedback " .$name ."</h3>".
						"<p>We'll reply to you at ".$email." as soon as we can.</p>";

						echo json_encode($return);
			}
			else {

				$return['error'] = true;
				$return['msg'] = "<h3>Oops! There was a problem sending the email. Please try again.</h3>";
				echo json_encode($return);
			}

		}

}
else {

	$return['error'] = true;
	$return['msg'] = "<h3>Oops! There was a problem with your submission. Please try again.</h3>";
	echo json_encode($return);
}

?>
