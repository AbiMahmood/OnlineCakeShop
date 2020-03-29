<?php require_once("../resources/config.php"); ?>
<?php include(TEMPLATE_FRONT . DS . "header.php") ?>
<?php include(TEMPLATE_FRONT . DS . "top_nav.php") ?>






         <!-- Contact Section -->

<div class="container">


        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading">Contact Us</h2>
                <h3 class="section-subheading "> <?php display_message(); ?> </h3>
            </div>
        </div>



      <div class="row">
          <div class="col-lg-12">

              <form name="sentMessage" id="contactForm" method="post" enctype="multipart/form-data" >

                     <!-- function for contact.php for sending customer message to database -->
                      <?php send_message(); ?>


                      <div class="row">
                          <div class="col-md-6">

                              <div class="form-group">
                                <h4>Name:</h4>
                                  <input type="text" name="name" class="form-control" placeholder="Your Name" id="name" required data-validation-required-message="Please enter your name.">
                                  <p class="help-block text-danger"></p>
                              </div>


                              <div class="form-group">
                                <h4>Email:</h4>
                                  <input type="email" name="email" class="form-control" placeholder="Your Email" id="email" required data-validation-required-message="Please enter your email address.">
                                  <p class="help-block text-danger"></p>
                              </div>


                              <div class="form-group">
                                <h4>Subject:</h4>
                                  <input name="subject" type="text" class="form-control" placeholder="Your Subject" id="phone" required data-validation-required-message="Please enter your phone number.">
                                  <p class="help-block text-danger"></p>
                              </div>

                          </div>

                          <div class="col-md-6">
                              <div class="form-group">
                                <h4>Message:</h4>
                                  <textarea name="message" class="form-control" placeholder="Your Message" id="message" required data-validation-required-message="Please enter a message."></textarea>
                                  <p class="help-block text-danger"></p>
                              </div>
                          </div>

                          <div class="clearfix"></div>



                          <div class="col-lg-3">
                            <h4>Attach Your File</h4>
                              <label class="btn btn-warning" for="file">
                                <input type="file" name="file[]" id="file" accept=".doc,docx,.pdf,.zip,.rar,.jpg,.png" multiple='multiple' style="display:none" onchange="javascript:updateList()" />Choose File
                              </label>
                                <h5>Selected files:</h5>
                                <span id="fileList"></span>
                          </div>


                          <div class="col-lg-12 text-center">
                              <div id="success"></div>
                              <button name="submit_mail" type="submit" class="btn btn-info">Send Message</button>
                          </div>

                      </div>
              </form>


          </div>  <!-- /.col-lg-12-->
      </div> <!-- /.row -->
  </div> <!-- /.container -->


<?php include(TEMPLATE_FRONT . DS . "footer.php") ?>
