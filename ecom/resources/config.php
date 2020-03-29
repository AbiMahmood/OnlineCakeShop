<?php ob_start(); // Make sure you put this in line 1 with no space

session_start();

defined("DS") ? null : define("DS", DIRECTORY_SEPARATOR);

defined("TEMPLATE_FRONT") ? null : define("TEMPLATE_FRONT", __DIR__ . DS . "templates/front");

defined("TEMPLATE_BACK") ? null : define("TEMPLATE_BACK", __DIR__ . DS . "templates/back");

defined("UPLOAD_DIRECTORY") ? null : define("UPLOAD_DIRECTORY", __DIR__ . DS . "uploads");

defined("DB_HOST") ? null : define("DB_HOST", "localhost");

defined("DB_USER") ? null : define("DB_USER","root");

defined("DB_PASS") ? null : define("DB_PASS", "");

defined("DB_NAME") ? null : define("DB_NAME",  "ecom_db");



$connection = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);



require_once("helper_functions.php");
require_once("frontend_functions.php");
require_once("functions.php");
require_once("cart.php");
//require_once("gconfig.php");
//require_once("fconfig.php");
//require_once("login_ajax_functions.php");
require_once("login_functions_users.php");
//require_once("login_functions_admin.php");


 ?>
