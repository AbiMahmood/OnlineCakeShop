
<!DOCTYPE html>

<form method="post" action="" enctype="multipart/form-data" id="contact">
  	<div id="response"></div>
  	<div class="form-group">
    	<label for="name">Your Name:</label>
      <input type="text" name="name" id="name" class="form-control" placeholder="Jesse James">
    </div>


    <div class="form-group">
    	<label for="email">Email:</label>
      <input type="email" name="email" id="email" class="form-control" placeholder="howCan@weReachYou.com">
    </div>


    <div class="form-group">
    	<label for="phone">Phone:</label>
      <input type="tel" name="phone" id="phone" class="form-control" placeholder="734-968-4509">
    </div>


    <div class="form-group">
    	<label for="message">Message</label>
    	<textarea class="form-control" id="message" name="message" rows="6" placeholder="How can we help...?"></textarea>
    </div>


  	<button type="submit" name="submit" id="submit" class="btn btn-default">Send It</button>
    <input type="hidden" name="honeypot" id="honeypot" value="http://">
    <input type="hidden" name="humancheck" id="humanCheck" class="clear" value="">
  </form>
<script src="js.js"></script>
