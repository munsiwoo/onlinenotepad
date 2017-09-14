<?php
	error_reporting(0);
	session_start();
	include 'config.php';

	if(!$_SESSION['login']){
		exit("<script>location.href='./index.php';</script>");
	}

	if(isset($_POST['idx'], $_POST['contents'])){
		$idx = (int)$_POST['idx'];
		$contents = addslashes($_POST['contents']);
		$chk_query = "SELECT * FROM `data` WHERE idx='$idx'";
		$date = date("Y-m-d h:i:s A");
		
		if($row = mysqli_fetch_assoc(mysqli_query($conn, $chk_query))){ // edit
			$fdate = $row['fdate'];
			$query = "UPDATE `data` SET ldate='$date', contents='$contents' WHERE idx='$idx'";
		}
		else { // new file
			$fdate = $date;
			$query = "INSERT INTO `data` VALUES ('$idx', '$date', '$date', '$contents')";
		}

		mysqli_query($conn, $query) or die('save error');
		echo $fdate."<br>".$date;
	}
?>
