<?php 
include_once "../homepage/includes/db.inc.php";
session_start();

$uid=$_SESSION['u_id'];
$spot_id = $_POST['spot_id'];


$sql="DELETE FROM FavoriteSpots WHERE UID=$uid AND SID=$spot_id;";
mysqli_query($conn,$sql);


 ?>