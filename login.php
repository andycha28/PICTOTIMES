<?php
require_once('Clases/Archivo.php');
require_once('Clases/Global.php');
$global = new G();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
  <title>Pictotime</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
   <link href="css/stylesheet.css" rel="stylesheet">
  <script>
    function statusChangeCallback(response) {
      console.log('statusChangeCallback');
      console.log(response);
      if (response.status === 'connected') {
        // Logged into your app and Facebook.
        testAPI();
      } else if (response.status === 'not_authorized') {
       
      } else {
        // The person is not logged into Facebook, so we're not sure if
       
      }
    }

    // This function is called when someone finishes with the Login
    // Button.  See the onlogin handler attached to it in the sample
    // code below.
    function checkLoginState() {
      FB.getLoginStatus(function(response) {
        statusChangeCallback(response);
      });
    }

    window.fbAsyncInit = function() {
    FB.init({
      appId      : '801856749915043',
      cookie     : true,  // enable cookies to allow the server to access 
        // the session
      xfbml      : true,  // parse social plugins on this page
      version    : 'v2.8' // use graph api version 2.5
    });

    // Now that we've initialized the JavaScript SDK, we call 
    // FB.getLoginStatus().  This function gets the state of the
    // person visiting this page and can return one of three states to
    // the callback you provide.  They can be:
    //
    // 1. Logged into your app ('connected')
    // 2. Logged into Facebook, but not your app ('not_authorized')
    // 3. Not logged into Facebook and can't tell if they are logged into
    //    your app or not.
    //
    // These three cases are handled in the callback function.

    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });

    };

    // Load the SDK asynchronously
    (function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/en_US/sdk.js";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));

    // Here we run a very simple test of the Graph API after login is
    // successful.  See statusChangeCallback() for when this call is made.
    function testAPI() {
      console.log('Welcome!  Fetching your information.... ');
      FB.api('/me', function(response) {
    //document.getElementById('status').innerHTML = 'Thanks for logging in, ' + response.name + '!';
    document.cookie = "nombre="+response.name;
    document.cookie="id_fb="+response.id;
    location.href = "index.php";  
      });
    }
  </script>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <style type="text/css">
    body {
      padding-top: 70px;
      background: #1C1C1C;
      
    }


    #space {
      background-image: url('images/loguito.png');
      font-family: "schoolbully";
      font-size: 89px;
      color:#FE894F;
      text-shadow: #000 -1px 1px, #000 -2px 2px, #000 -3px 3px, #000 -4px 4px, #000 -5px 5px;
    }
  </style>
<head>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Menu</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        </button>

        <a  class="navbar-brand" href="index.php">PICTOTIME</a>
      </div>

      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-right">
          <li>
            <fb:login-button scope="public_profile,email" onlogin="checkLoginState();">
            </fb:login-button>
          </li>
        </ul>
      </div>
    </div>
  </nav>

<div class="container">
    <div class="jumbotron" id="space">
      <h1>Welcome to</h1>
      <p>
        
      </p>
    </div>
    <div class="row">
    <?php
      $archivos = new Archivo();
      $cursor = $archivos->getArchivos(12);
      foreach($cursor as $fila){
    ?>
    <div class="col-sm-12 col-md-4 col-lg-4">
      <div class="thumbnail">
        <?php echo '<img style=height:150px;width:200px; src="ftp://'.$global->getFtpServer().'/files/'.$fila['url'].'">'; ?>
        <div class="caption">
          <h3><?php echo implode(' ', $fila["nombreImagen"]); ?></h3>
        </div>
      </div>
    </div>
    <?php
      }
    ?>
    </div>
</div>
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<?php
  foot();
?>
