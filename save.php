<?php
	session_start();
	error_reporting(0);
	include 'config.php';

	if(!$_SESSION['login']){
		exit("<script>location.href='./index.php';</script>");
	}
	if(isset($_POST['idx'], $_POST['contents'])){
		$idx = (int)$_POST['idx'];
		$contents = addslashes($_POST['contents']);
		$row = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM `data` WHERE idx='$idx';"));
		$date = date("Y-m-d h:i:s A");
		
		if($row){ // contents edit
			$fdate = $row['fdate'];
			$query = "UPDATE `data` SET ldate='$date', contents='$contents' WHERE idx='$idx'";
		}
		else { // new contents
			$fdate = $date;
			$query = "INSERT INTO `data` VALUES ('$idx', '$date', '$date', '$contents')";
		}

		mysqli_query($conn, $query);
		mysqli_close($conn);
		echo $fdate."<br>".$date;
	}
?>