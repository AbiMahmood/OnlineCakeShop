<?php
require_once("config.php");







/****************************FRONT END FUNCTIONS************************/


// get products
//5 index.php
function get_products() {

$query = query(" SELECT * FROM products");
confirm($query);

$rows = row_count($query); // Get total of mumber of rows from the database

if(isset($_GET['page'])){ //get page from URL if its there

    $page = preg_replace('#[^0-9]#', '', $_GET['page']);  //filter everything but numbers


} else {// If the page url variable is not present force it to be number 1

    $page = 1;

}


$perPage = 6; // Items per page here

$lastPage = ceil($rows / $perPage); // Get the value of the last page //ceiling function in mathematical problems to round up a decimal number to next greater integral value


// Be sure URL variable $page(page number) is no lower than page 1 and no higher than $lastpage

if($page < 1){ // If it is less than 1

    $page = 1; // force if to be 1

}elseif($page > $lastPage){ // if it is greater than $lastpage

    $page = $lastPage; // force it to be $lastpage's value

}

$middleNumbers = ''; // Initialize this variable

// This creates the numbers to click in between the next and back buttons


$sub1 = $page - 1;
$sub2 = $page - 2;
$add1 = $page + 1;
$add2 = $page + 2;



if($page == 1){

      $middleNumbers .= '<li class="page-item active"><a>' .$page. '</a></li>';

      $middleNumbers .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$add1.'">' .$add1. '</a></li>';

} elseif ($page == $lastPage) {

      $middleNumbers .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$sub1.'">' .$sub1. '</a></li>';
      $middleNumbers .= '<li class="page-item active"><a>' .$page. '</a></li>';

}elseif ($page > 2 && $page < ($lastPage -1)) {

      $middleNumbers .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$sub2.'">' .$sub2. '</a></li>';

      $middleNumbers .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$sub1.'">' .$sub1. '</a></li>';

      $middleNumbers .= '<li class="page-item active"><a>' .$page. '</a></li>';

         $middleNumbers .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$add1.'">' .$add1. '</a></li>';

      $middleNumbers .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$add2.'">' .$add2. '</a></li>';




} elseif($page > 1 && $page < $lastPage){

     $middleNumbers .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page= '.$sub1.'">' .$sub1. '</a></li>';

     $middleNumbers .= '<li class="page-item active"><a>' .$page. '</a></li>';

     $middleNumbers .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$add1.'">' .$add1. '</a></li>';





}


// This line sets the "LIMIT" range... the 2 values we place to choose a range of rows from database in our query


$limit = 'LIMIT ' . ($page-1) * $perPage . ',' . $perPage;




// $query2 is what we will use to to display products with out $limit variable

$query2 = query(" SELECT * FROM products $limit");
confirm($query2);


$outputPagination = ""; // Initialize the pagination output variable


// if($lastPage != 1){

//    echo "Page $page of $lastPage";


// }


  // If we are not on page one we place the back link

if($page != 1){


    $prev  = $page - 1;

    $outputPagination .='<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$prev.'">Back</a></li>';
}

 // Lets append all our links to this variable that we can use this output pagination

$outputPagination .= $middleNumbers;


// If we are not on the very last page we the place the next link

if($page != $lastPage){


    $next = $page + 1;

    $outputPagination .='<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$next.'">Next</a></li>';

}


// Doen with pagination



// Remember to use query 2 below :)

while($row = fetch_array($query2)) {

$product_image = display_image($row['product_image']);

$product = <<<DELIMETER

<div class="col-sm-4 col-lg-4 col-md-4">
    <div class="thumbnail">
        <a href="item.php?id={$row['product_id']}"> <img style="height:220px; width:250px" src="../resources/{$product_image}" alt=""></a>
        <div class="caption">
            <h4 class="pull-right">&#36;{$row['product_price']}</h4>
            <h4><a href="item.php?id={$row['product_id']}">{$row['product_title']}</a>
            </h4>
            <p>Click The Button "Add to Cart" bellow to Add into your cart </p>
             <a class="btn btn-primary"  href="../resources/cart.php?add={$row['product_id']}">Add to cart</a>
        </div>
    </div>
</div>

DELIMETER;

echo $product;


        }


       echo "<div style='clear:both' class='text-center'><ul class='pagination'>{$outputPagination}</ul></div>";


}



















//side_nav.php
//6 resources/templates/front/side_nav.php
function get_categories(){

$query = query("SELECT * FROM categories");
confirm($query);

while($row = fetch_array($query)) {

$categories_links = <<<DELIMETER

<a href='category.php?id={$row['cat_id']}' class='list-group-item'>{$row['cat_title']}</a>

DELIMETER;

echo $categories_links;

     }

}

















//7 category.php
function get_products_in_cat_page() {


    $id = escape_string($_GET['id']);


    $sql = "SELECT * FROM products WHERE product_category_id = '{$id}' ";
    $result = query($sql);
    confirm($result);

while($row = fetch_array($result)) {

    $product_image = display_image($row['product_image']);

$product = <<<DELIMETER


            <div class="col-md-3 col-sm-6 hero-feature">
                <div class="thumbnail">
                    <img style="height:220px; width:250px" src="../resources/{$product_image}" alt="">
                    <div class="caption" id="caption">
                        <h3>{$row['product_title']}</h3>
                        <p>Click the Buy Now button to purchase</p>
                        <p>Click the More Info button for details</p>
                        <p>
                            <a href="../resources/cart.php?add={$row['product_id']}" class="btn btn-primary">Buy Now!</a> <a href="item.php?id={$row['product_id']}" class="btn btn-info">More Info</a>
                        </p>
                    </div>
                </div>
            </div>

DELIMETER;

echo $product;


		}


}




















//shop.php
function get_products_in_shop_page() {


    $sql = "SELECT * FROM products";
    $result = query($sql);
    confirm($result);

while($row = fetch_array($result)) {

    $product_image = display_image($row['product_image']);

$product = <<<DELIMETER


            <div class="col-md-3 col-sm-6 hero-feature">
                <div class="thumbnail">
                    <img style="height:220px; width:250px" src="../resources/{$product_image}" alt="">
                    <div class="caption">
                        <h3>{$row['product_title']}</h3>
                        <p>Click the Buy Now to add in the cart.</p>
                        <p>Click the More info to view in details.</p>
                        <p>
                            <a href="../resources/cart.php?add={$row['product_id']}" class="btn btn-primary">Buy Now!</a> <a href="item.php?id={$row['product_id']}" class="btn btn-default">More Info</a>
                        </p>
                    </div>
                </div>
            </div>

DELIMETER;

echo $product;


        }


}





















// public/admin/ loginAdmin.php
function login_admin(){

if(isset($_POST['submit'])){

      $username = escape_string($_POST['username']);
      $password = escape_string($_POST['password']);

      $sql = "SELECT * FROM users WHERE username = '{$username}' AND password = '{$password }' ";
      $result = query($sql);
      confirm($result);


if(row_count($result) == 0) {

      set_message("Password or Username are wrong");
      redirect("loginAdmin.php");


} else {

      $_SESSION['username'] = $username;
      set_message("Welcome to the Admin Panel {$username} ");
      redirect("index.php"); //./admin/index.php

       }
    }
}

















function search_cake(){

        if (isset($_POST['submit_cake'])) {

            $data = escape_string(escape_string($_POST['search']));
            //$data = preg_replace("#['^0-9a-z']#i","",$data_search);
            //print($data);

            $sql= "SELECT * FROM products WHERE product_title like '%{$data}%' ";
            $result = query($sql);

            $output = '' ;

            if(row_count($result) == 0){

                  $output = "No Search Result Found";

                  set_message($output);

                  redirect("index.php");


            }elseif(row_count($result) > 0){

                  while( $row = fetch_array($result) ){

                        $content  = $row['product_title'];
                        $content1 = $row['product_price'];
                        $content2 = $row['product_quantity'];
                        //$content3 = $row['product_id'];

                        $blank = nl2br(" \n ");

                        $output .= '<div> 1. Cake name: '.$content.'<br>   2. Cake Price: '.$content1.'<br>   3. Available Cakes: '.$content2.' <br> '.$blank.'</div>';

                        set_message("<b>*Search Results*</b><br> $output ");

                        redirect("index.php");

                }

              }else {
                set_message("ERROR");
              }

        }

}














//contact.php
//Sending Email function
function send_message() {


    if(isset($_POST['submit_mail'])){

      require '.././public/classes/EmailConfigClass.php';                     //necessary information fetching from EmailConfigClass.php
      require '.././vendor/PHPMailer-master/PHPMailerAutoload.php';						//include phpmailer class


                  $from       =   $_POST['email'];
                  $name       =   $_POST['name'];
                  $body       =   $_POST['message'];
                  $subject    =   $_POST['subject'];
									$file_name  =   $_FILES['file']['name'];
					        $temp_name  =   $_FILES['file']['tmp_name'];


$message = <<<DELIMETER
										  <b> Email From: </b>   	$from    <br/><br/>
										  <b> Full Name: </b>			$name    <br/><br/>
											<b> Subject: </b>    	  $subject <br/><br/>
											<b> Message: </b><br/>  $body
DELIMETER;
echo $message;

                  $mail = new PHPMailer(); 												// Instantiate Class

									// Set up SMTP
                  $mail ->IsSmtp();																// Sets up a SMTP connection
                  $mail ->SMTPDebug = 0; 													// Enable verbose debug output
                  $mail ->SMTPAuth = true; 												// Connection with the SMTP does require authorization
                  $mail ->SMTPSecure = 'ssl';											// Enable TLS encryption, `ssl` also accepted
                  $mail ->Host = ContactUs::SMTP_HOST;						//Fetching data from public\classes\EmailConfigClass.php
                  $mail ->Port = ContactUs::SMTP_PORT;						//Fetching data from public\classes\EmailConfigClass.php
									$mail->Encoding = '7bit';												//Encoding criteria


									// Authentication
                  $mail ->Username = ContactUs::SMTP_USER;   	     //Fetching data from public\classes\EmailConfigClass.php
                  $mail ->Password = ContactUs::SMTP_PASSWORD;	 	//Fetching data from public\classes\EmailConfigClass.php


									// Compose
                  $mail ->SetFrom($from, $name);									// Add an address of the person who will send the email, Name
								  //$mail->addReplyTo($email);
									//$mail->addCC('cc@example.com');
									//$mail->addBCC('bcc@example.com');


									$mail ->Subject = $subject;											//Subject of the Email
									$mail ->Body = $body;														//Body of the Email
						    	$mail->MsgHTML($message);										  	//Full message


                  // Send To
									$mail ->IsHTML(true);													// Set email format to HTML
								  $mail ->AddAddress(ContactUs::MAIL_TO);			  //Fetching data from public\classes\EmailConfigClass.php


									for ($i=0; $i < count($temp_name) ; $i++) {									// Add attachments
										$mail ->addAttachment($temp_name[$i], $file_name[$i] );
									}


                      if(!$mail->Send())
                      {
                            set_message("<p class='bg-danger text-center'> Sorry we could not send your message </p>");
                            redirect("contact.php");

                      } else {

                            set_message("<p class='bg-success text-center'> Your Message has been sent </p>");
                            redirect("contact.php");
                      }





    }
}












 ?>
