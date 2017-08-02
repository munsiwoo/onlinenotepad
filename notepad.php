<?php
  session_start();
  error_reporting(0);
  include 'config.php';

  if(!isset($_SESSION['login'])){
    exit("<script>location.href='./index.php'</script>");
  }

  if(isset($_GET['type'])){
    if($_GET['type'] === "new"){ // new contents
      $fdate = "new file";
      $ldate = "new file";
    }
    else if(isset($_GET['idx']) && $_GET['type'] === "edit"){ // contents edit
      $idx = (int)$_GET['idx'];
      $query = "SELECT * FROM `data` WHERE idx=".$idx;
      $row = mysqli_fetch_array(mysqli_query($conn, $query));

      if($row){
        $fdate = $row['fdate'];
        $ldate = $row['ldate'];
        $contents = $row['contents'];
        $delete = "./delete.php?idx=".$idx;
      }
      else {
        exit("<script>location.href='./home.php'</script>");
      }
    }
    else {
      exit("<script>location.href='./home.php'</script>");
    }
  }
?>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="http://code.jquery.com/jquery-latest.min.js"></script>
    <link href="./assets/bootstrap.css" rel="stylesheet" type="text/css">
    <title>online notepad</title>
    <script type="text/javascript" language="javascript">
      $(document).ready(function(){
        $("#send").click(function(){
          $.post("save.php",{
            idx : <?="\"$idx\""?>,
            contents : $("#contents").val()
          },
          function(data,status){
            $("#result").html(data);
          });
        });
      });
    </script>
  </head>
  <body>
    <div class="section">
    <center><h1>online notepad</h1></center><br>
      <div class="container">
        <div class="row">
          <div class="col-md-4">
            <a class="btn btn-block btn-default btn-lg" href="./home.php">home</a>
            <input type="button" id="send" value="save" class="btn btn-block btn-default btn-lg">
            <?php if($_GET['type'] === "edit"){ ?>
              <a class="btn btn-block btn-default btn-lg" href=<?="\"$delete\""?>>delete</a>
            <?php } ?>
            <br><br>
            <div class="jumbotron"><center>
              <img src="./assets/logo.png">
                <div id='result'>
                  <?php
                    echo $fdate."<br>".$ldate;
                  ?>
                </div>
              </center>
            </div>
          </div>
          <div class="col-md-8">
            <textarea placeholder="contents" id="contents" style="height:50%;" class="form-control"><?=$contents?></textarea>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>