<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Log In</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <p> <b>Backoffice Login</b></p>
  </div>
  <!-- /.login-logo -->
  <?php
  //session_start();
  use Google\Authenticator\GoogleAuthenticator;
  use Google\Authenticator\GoogleQrUrl;
  require_once "vendor/autoload.php";
  $googleAuthenticator = new GoogleAuthenticator();
  $secret = $googleAuthenticator->generateSecret();

  if(!isset($_SESSION['storedSecrect']))
  {
  $_SESSION["storedSecrect"]=$secret;
  print_r("".$secret);
  
  }
  else
  {
    die('not empty');
  }
  print_r("---".$_SESSION['storedSecrect']);
  
  
  $qrCodeUrl = GoogleQrUrl::generate('Backend', $secret, 'bundaii.com/ama-bundai/index.php');

 
 print_r($qrCodeUrl);
 //die("..");
 ?>
  
  <div class="card">
    <div class="card-body login-card-body">
      

      <form method="post" action="controllers/api.php?flag=qrscan">
       
       
        <div class="input-group mb-3" style="text-align:center">
   <scan style="margin-bottom:10px"> Scan QR code using Google authenticator</scan> 
         
          
          
         

            <img src="<?php echo $qrCodeUrl; ?>" alt="Scan this QR code with your Google Authenticator app"
              style="width: 200px; height=200px;margin-left:20%">

           
         

        
        </div>
      
          
          
         
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="2fa" id="2fa" required placeholder="Enter 2FA Code">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
      
          <!-- /.col -->
          <div class="col-4 ">
        <button type="submit" class="btn btn-primary">Sign In</button>
              <!-- <a class="btn btn-primary" href="dashboard.php" role="button">Sign In</a> -->
          </div>
          <!-- /.col -->
        </div>
      </form>

     
</div>

</body>
</html>
