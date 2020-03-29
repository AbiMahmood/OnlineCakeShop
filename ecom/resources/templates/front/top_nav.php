<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              <a class="navbar-brand navbar-link" href="index.php" id="BrandName"><img src="assets/img/logo.png" id="logo">Friends Cake Shop</a>
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Home</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="shop.php">Shop</a></li>

                     <li><a href="checkout.php">Checkout</a></li>

                    <li ><a href="contact.php">Contact Us</a></li>

                </ul>





                <ul class="nav navbar-nav navbar-right">

                  <li><a class="link" href="register.php"><span class="glyphicon glyphicon-envelope"></span> Sign Up</a></li>


<!--login and logout button change with the session-->
                  <?php  if(isset($_SESSION['email'])){ ?>

                      <li><a class="link" href="userprofile.php"><span class="glyphicon glyphicon-user"></span> Profile</a></li>
                      <li><a class="link" href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>


                  <?php }else{ ?>

                      <li><a class="link" href="loginUser.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>

                  <?php } ?>




                </ul>







                <form class="navbar-form navbar-right" method="POST">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search" name="search">
                    <div class="input-group-btn">
                      <button class="btn btn-default" type="submit" name='submit_cake'>
                        <i class="glyphicon glyphicon-search"></i>
                      </button>
                    </div>
                  </div>
                </form>




            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
        </nav>
