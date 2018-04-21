<?php 
	session_start();
	include_once "../homepage/includes/db.inc.php";
 ?>


<?php


	if (isset($_SESSION['u_id'])){
		$username = $_SESSION['u_name'];
		$sql_uid = "SELECT UID FROM user WHERE username = '$username';";
		$result = mysqli_query($conn, $sql_uid);
		$resultcheck = mysqli_num_rows($result);
		if ($resultcheck > 0){
			while($row = mysqli_fetch_assoc($result)){
				$uid = $row['UID'];
			}
		}
		
		$spot_name = $_POST['spot_name'];
		$sql_sid = "SELECT SID FROM attraction WHERE name = '$spot_name';";
		$result = mysqli_query($conn, $sql_sid);
		$resultcheck = mysqli_num_rows($result);
		if ($resultcheck > 0){
			while($row = mysqli_fetch_assoc($result)){
				$sid = $row['SID'];
			}
		}
		
		//Check whether the user has favored this spot
		$sql_check = "SELECT * FROM FavoriteSpots WHERE UID = $uid AND SID = $sid;";
		$result_check = mysqli_query($conn,$sql_check);
		$num_record = mysqli_num_rows($result_check);
		if ($num_record > 0){
			$sql_del = "DELETE FROM FavoriteSpots WHERE UID = $uid AND SID = $sid;";
			mysqli_query($conn, $sql_del);
		}else{
			$sql = "INSERT INTO FavoriteSpots(UID,SID) VALUES ($uid, $sid)";
			mysqli_query($conn, $sql);
		}
		
		/*
		$sql = "INSERT INTO FavoriteSpots(UID,SID) VALUES ($uid, $sid)";
		mysqli_query($conn, $sql);
		*/
		// header("Location: collections.php?collect=success");
	}
	else{
		echo '<script>alert("Please Log in first!")</script>';
	}









?>