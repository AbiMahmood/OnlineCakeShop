<?php //require_once("config.php"); ?>
<?php require_once("../vendor/GoogleAPI/vendor/autoload.php") ; ?>

<?php


	$gClient = new Google_Client();
	$gClient->setClientId("144487248352-ik34ss9ufo13ph5bsbuo5h1afmattq5a.apps.googleusercontent.com");
	$gClient->setClientSecret("OqOUPI19kPvJe4ssskXAwJy2");
	$gClient->setApplicationName("Login");
	$gClient->setRedirectUri("http://localhost/ecom/resources/g-callback.php");
	$gClient->addScope("https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/userinfo.email");
?>
