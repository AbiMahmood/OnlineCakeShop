<?php
require_once("config.php");

?>


<?php

// function for adding a product in the cart
  if(isset($_GET['add'])) {

    $query = query("SELECT * FROM products WHERE product_id=" . escape_string($_GET['add']). " ");
    confirm($query);

    while($row = fetch_array($query)) {

        // will proceed if product quantity is more or equal than wanted
        if($row['product_quantity'] != $_SESSION['product_' . $_GET['add']]) {

          $_SESSION['product_' . $_GET['add']] += 1;
          redirect("../public/checkout.php");

        } else {

          // show error if product quantity is less than wanted
          set_message("We only have " . $row['product_quantity'] . " " . "{$row['product_title']}" . " available");
          redirect("../public/checkout.php");

        }

    }
}







// function for decrementing a product from the cart
  if(isset($_GET['remove'])) {

    // decrementing the product from the cart
    $_SESSION['product_' . $_GET['remove']]--;

    // if there is no product in the cart then unset
    if($_SESSION['product_' . $_GET['remove']] < 1) {

      //if all the products are gone then unset the session , clear the page
      unset($_SESSION['item_total']);
      unset($_SESSION['item_quantity']);
      redirect("../public/checkout.php");

    } else {

      redirect("../public/checkout.php");

     }
  }












// function for deleting a product from the cart
 if(isset($_GET['delete'])) {

// if there is no product in the cart then unset
  $_SESSION['product_' . $_GET['delete']] = '0';
  unset($_SESSION['item_total']);
  unset($_SESSION['item_quantity']);

  redirect("../public/checkout.php");


 }




















//everytimt with adding, a product id comes to it

function cart() {

//these are for the cartTotal box
$total = 0;
$item_quantity = 0;
$item_name = 1;
$item_number =1;
$amount = 1;
$quantity =1;

//taking the name of the product
//example product_1 from session is now name
foreach ($_SESSION as $name => $value) {

    //product amount
    if($value > 0 ) {

        //start at 0 and finish to 8, name is the key, if the name is product_
        if(substr($name, 0, 8 ) == "product_") {

            //pull the id from the session
            $length = strlen($name);

            $id = substr($name, 8 , $length);            //start at 8 and finish to length of the name
                                                        //starts number 8 means 'product_' now start
                                                        //getting the id of the session

            $query = query("SELECT * FROM products WHERE product_id = " . escape_string($id). " ");  //show only the product which are on the carts
            confirm($query);

//fetch the query from DB
            while($row = fetch_array($query)) {

                //the subtotal price
                $sub = $row['product_price'] * $value;    //subtotal
                $item_quantity = $item_quantity + $value; //quantity

//show image in cart
                $product_image = display_image($row['product_image']);





$product = <<<DELIMETER

<tr>
        <td>{$row['product_title']}<br>
        <img style="height:100px; width:100px" src='../resources/{$product_image}'>
        </td>

        <td>{$row['product_price']} BDT</td>
        <td>{$value}</td>
        <td>{$sub} BDT </td>

        <td>
            <a class='btn btn-warning' href="../resources/cart.php?    remove={$row['product_id']}">    <span class='glyphicon glyphicon-minus'></span></a>
            <a class='btn btn-success' href="../resources/cart.php?    add={$row['product_id']}">       <span class='glyphicon glyphicon-plus'></span></a>
            <a class='btn btn-danger'  href="../resources/cart.php?    delete={$row['product_id']}">    <span class='glyphicon glyphicon-remove'></span></a>
        </td>
  </tr>

<input type="hidden" name="product_title[]"    value="{$row['product_title']}">
<input type="hidden" name="product_id[]"       value="{$row['product_id']}">
<input type="hidden" name="product_price[]"    value="{$row['product_price']}">
<input type="hidden" name="product_quantity[]" value="$value">


DELIMETER;

echo $product;







        $item_name++;
        $item_number++;
        $amount++;
        $quantity++;

        $_SESSION['item_total']    = $total = $total + $sub;   //displaying  the total charge
        $_SESSION['item_quantity'] = $item_quantity;           //displaying  the total quantity



        } // while fetch array ends here

      } //start at 0 and finish to 8, name is the key ends here

    } //product ammount if condition ends here

  } //foreach loop ends here

} //cart function ends here













// used in checkout.php
function show_paypal() {

//if the session is set and thers item in cart only then show the buynow paypal button
if(isset($_SESSION['item_quantity']) && $_SESSION['item_quantity'] >= 1) {


$paypal_button = <<<DELIMETER

    <input type="image" name="upload" border="0"
src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif"
alt="PayPal - The safer, easier way to pay online">


DELIMETER;

return $paypal_button;

  }


}








function process_transaction() {



    if(isset($_GET['tx'])) {

        $amount = $_GET['amt'];
        $currency = $_GET['cc'];
        $transaction = $_GET['tx'];
        $status = $_GET['st'];
        $total = 0;
        $item_quantity = 0;

        foreach ($_SESSION as $name => $value) {

            if($value > 0 ) {

                if(substr($name, 0, 8 ) == "product_") {

                    $length = strlen($name - 8);
                    $id = substr($name, 8 , $length);


                    $send_order = query("INSERT INTO orders (order_amount, order_transaction, order_currency, order_status ) VALUES('{$amount}', '{$transaction}','{$currency}','{$status}')");
                    $last_id =last_id();
                    confirm($send_order);



                    $query = query("SELECT * FROM products WHERE product_id = " . escape_string($id). " ");
                    confirm($query);

                    while($row = fetch_array($query)) {
                        $product_price = $row['product_price'];
                        $product_title = $row['product_title'];
                        $sub = $row['product_price']*$value;
                        $item_quantity +=$value;


                        $insert_report = query("INSERT INTO reports (product_id, order_id, product_title, product_price, product_quantity) VALUES('{$id}','{$last_id}','{$product_title}','{$product_price}','{$value}')");
                        confirm($insert_report);





                    }


                    $total += $sub;
                    echo $item_quantity;


                }

            }

        }

        session_destroy();
    } else {


        redirect("index.php");


    }



}




















 ?>
