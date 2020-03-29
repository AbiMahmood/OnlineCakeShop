<?php require_once("../resources/config.php"); ?>
<?php include(TEMPLATE_FRONT . DS . "header.php") ?>
<?php include(TEMPLATE_FRONT . DS . "top_nav.php") ?>


    <!-- Page Content -->
<div class="container">

       <!-- Side Navigation -->

              <?php //include(TEMPLATE_FRONT . DS . "side_nav.php") ?>


              <?php
                  $query = query(" SELECT * FROM products WHERE product_id = " . escape_string($_GET['id']) . " ");
                  confirm($query);
                  while($row = fetch_array($query)):
               ?>




    <div class="col-md-9">

        <!--Row For Image and Short Description-->

        <div class="row">

                <div class="col-md-7">
                   <img class="img-responsive" src="../resources/<?php  echo display_image($row['product_image']); ?>" alt="">
                </div>


                <div class="col-md-5">

                      <div class="thumbnail">

                              <div class="caption-full">

                                    <h4><?php echo $row['product_title']; ?> </h4>
                                    <hr>
                                    <h4><?php echo "&#36;" . $row['product_price']; ?></h4>

                                    <!-- Short Description -->
                                    <p><?php echo $row['short_desc']; ?></p>



                                    <div class="form-group">
                                       <a href="../resources/cart.php?add=<?php echo $row['product_id']; ?>" class="btn btn-primary">ADD TO CART</a>
                                    </div>


                              </div> <!--caption-full ends here -->

                      </div> <!--thumbnail ends here-->

                </div> <!--col-md-5 ends here -->

        </div><!--Row For Image and Short Description-->


        <hr>


        <!--Row for Tab Panel-->

        <div class="row">

            <div role="tabpanel">

                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                  <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Description</a></li>
                </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                      <div role="tabpanel" class="tab-pane active" id="home">
                          <p></p>
                          <p><?php echo $row['product_description']; ?></p>

                      </div>

                   </div>

            </div>

        </div><!--Row for Tab Panel-->



    </div><!-- col-md-9 ends here -->


  <?php endwhile; ?> <!-- end the while loop line 17 -->

</div> <!-- /.container -->






<?php include(TEMPLATE_FRONT . DS . "footer.php") ?>
