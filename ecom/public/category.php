<?php require_once("../resources/config.php"); ?>
<?php include(TEMPLATE_FRONT . DS . "header.php") ?>
<?php include(TEMPLATE_FRONT . DS . "top_nav.php") ?>


<!-- Page Content -->
<div class="container">


        <!-- category_header -->
        <!-- Jumbotron Header -->
        <header class="jumbotron hero-spacer">
            <h1>A Warm Welcome!</h1>
            <p>See our wonderful cakes here :)</p>
        </header>

        <hr>



          <!-- Title -->
          <div class="row">
              <div class="col-lg-12">
                  <h3>Latest Product</h3>
              </div>
          </div><!-- /.row -->


          <!-- Page Features -->
          <div class="row text-center">
               <?php get_products_in_cat_page(); ?> <!-- Products in Category Page -->
          </div>



</div><!-- /.container -->


<?php include(TEMPLATE_FRONT . DS . "footer.php") ?>
