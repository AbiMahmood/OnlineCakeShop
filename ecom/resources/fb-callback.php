<?php require_once("fconfig.php"); ?>

<?php

   try {

      $accessToken = $helper->getAccessToken();

    } catch (\Facebook\Exceptions\FacebookResponseException $e) {

          echo "Response Exception: ". $e->getMessage();
          exit();

    } catch(\Facebook\Exceptions\FacebookSDKException $e){

          echo "SDK Exception: " . $e->getMessage();
          exit();
    }



    if(!$accessToken){
      header('location:../public/loginUser.php');
      exit();
    }



    $oAuth2Client = $FB->getOAuth2Client();

    if(!$accessToken->isLongLived()){
      $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
    }

    $response = $FB->get("me?fields=id,name");
    $userData = $response->getGraphNode()->asArray();

    $_SESSION['userdata'] = $userdata;
    $_SESSION['email'] = $userData['email'];
    $_SESSION['access_token'] =(string) $accessToken;
    header('location:../public/index.php');







 ?>
