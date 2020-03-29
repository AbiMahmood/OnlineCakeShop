<?php
require_once("config.php");





/****************************HELPER FUNCTIONS************************/



function last_id(){

		global $connection;

		return mysqli_insert_id($connection);

}







//function for redirecting page
function redirect($location){

		return header("Location: {$location} ");

}








//2 function for database query connection
function query($sql) {

		global $connection;

		return mysqli_query($connection, $sql);

}







//3 function for confirming database connection
function confirm($result){

		global $connection;

		if(!$result) {

				die("QUERY FAILED " . mysqli_error($connection));

	}

}







//4 function escapes special characters in a string for use in an SQL statement.
function escape_string($string){

		global $connection;

		return mysqli_real_escape_string($connection, $string);

}







//5 function for fetching
function fetch_array($result){

		return mysqli_fetch_array($result);

}








//function The mysqli_num_rows() function returns the number of rows in a result set.
function row_count($result){

	return mysqli_num_rows($result);

}






//function for cleaning The htmlentities() function converts characters to HTML entities.
function clean($string){

	return htmlentities($string);
}





//09 function for setting up custom messages in sessions
function set_message($msg){

    if(!empty($msg)) {

          $_SESSION['message'] = $msg;

    } else {

          $msg = "";

        }
}









//10 function for displaying messages in sessions
function display_message() {

    if(isset($_SESSION['message'])) {

        echo  $_SESSION['message'] ;
        unset($_SESSION['message']) ;

    }
}







 ?>
