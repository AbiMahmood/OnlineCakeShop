<?php require_once("../vendor/Facebook/autoload.php") ; ?>


<?php

$FB = new Facebook\Facebook([
  'app_id' => '700891116944860',
  'app_secret' => 'd9d6c8261e9082c916c031d73340d37b',
  'default_graph_version' => 'v3.10'
]);

$helper = $FB->getRedirectLoginHelper();



 ?>
