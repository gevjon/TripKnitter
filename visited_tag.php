<?php
	session_start();
	include_once "../homepage/includes/db.inc.php";
 ?>

<?php
  $sid = $_POST['sid'];
	$uid = $_POST['uid'];
	//update records for attraction_tag
	foreach($_POST['tid'] as $i) {
		$sql= "INSERT INTO attraction_tag (sid,tid) VALUES ($sid,$i);";
		mysqli_query($conn,$sql);
	}

	//update the records of user_visited
	$sql = "INSERT INTO user_visited (uid,sid) VALUES ($uid,$sid);";
	mysqli_query($conn,$sql);
 ?>
