<?php
error_reporting(0);
session_start();
include 'config.php';

if(isset($_SESSION['login'])){
  exit("<script>location.href='./home.php'</script>");
}
if(isset($_POST['password'])){
  $password = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `user` WHERE 1"));
  
  if(hash('sha256', $_POST['password']."munsiwoo") === $password['password']){
    $_SESSION['login'] = 'login_ok';
    exit("<script>location.href='./home.php'</script>");
  }
  else {
    $fp = fopen('access_log.txt', 'a+');
    $log = date("Y-m-d H:i:s").' ('.$_SERVER['REMOTE_ADDR'].'), access_password : '.$_POST['password']."\r\n";
    fwrite($fp, $log);
    fclose($fp);
  }
}
?>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="og:title" content="online notepad">
    <meta property="og:description" content="online notepad">
    <script src="http://code.jquery.com/jquery-latest.min.js"></script>
    <link href="./assets/bootstrap.css" rel="stylesheet" type="text/css">
    <title>login</title>
  </head>
  <body>
    <div class="section">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h1 class="text-center">놑패드</h1>
            <hr>
          </div>
        </div>
        <div class="row">
          <div class="col-md-offset-3 col-md-6">
            <form role="form" method="post">
              <div class="form-group">
                <div class="input-group input-group-lg">
                  <input type="password" class="form-control" placeholder="PASSWORD" name="password">
                  <span class="input-group-btn"><input type="submit" value="Login" class="btn btn-success"></span>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
