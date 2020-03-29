<?php require_once("gconfig.php"); ?>
<?php require_once("login_functions_users.php"); ?>


<?php

	if (isset($_SESSION['access_token'])){

		$gClient->setAccessToken($_SESSION['access_token']);



	}else if (isset($_GET['code'])) {

		$token = $gClient->fetchAccessTokenWithAuthCode($_GET['code']);

		$_SESSION['access_token'] = $token;



	}else {

		header("location:../public/loginUser.php");
		exit();

	}


	$oAuth = new Google_Service_Oauth2($gClient);
	$userData = $oAuth->userinfo_v2_me->get();

	$_SESSION['email'] = $userData['email'];

	header("location:../public/index.php");
	exit();

?>
