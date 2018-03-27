<?php
	include "header.php";
	include_once "../homepage/includes/db.inc.php";
 ?>

<div class="section" id="user_info">
	<img src="figures/user_stamp/user1.jpeg" alt="user_pic" height="200px" width="200px" style="float:left;margin:50px;">

	<span></span>
	<p class="h1" id="username" style="padding-top:100px;">Username</p>
	<p>Email Address:<php $_SESSION?></p>

</div>

<script>
function getUserName(){
	var url = location.search;
	if (url.indexOf("?") != -1) {
		var str = url.substr(1);
		strs = str.split("=");
		document.getElementById("username").innerHTML=strs[1];
	}
}
		getUserName();

</script>







<div class="section" id="my_fav_spots" style="Clear:both;margin:30px;">
	<p class="h4"> My Fav Spots</p>
	<?php 
	//Get uid
	$username = $_SESSION['u_name'];
	$sql = "SELECT UID FROM user WHERE username='$username';";
	$result = mysqli_query($conn, $sql);
	while ($row=mysqli_fetch_assoc($result)){
		$u_id= $row['UID'];
	}
	// Get the info of user's favorite spots from database
	$sql = "SELECT * FROM attraction WHERE SID in (select SID from FavoriteSpots where UID=$u_id);";
	$result = mysqli_query($conn, $sql);
	$resultcheck = mysqli_num_rows($result);
	$search_result = array();
	if ($resultcheck > 0){
		while ($row=mysqli_fetch_assoc($result)){
			$search_result[] = $row;
		}
	}
	foreach ($search_result as $i){
		$spot_img = $i['image'];
		$spot_name = $i['name'];
		$review_essential = $i['review_essential'];
		echo '<div name="profile_fav">
			<img src="'.$spot_img.'" alt="spot_image" width:200px height:150px style="float: left; margin: 50px;">
			<p style="float:left;">
			<input type="hidden" name="spot_name" value="'.$spot_name.'">
			<h2 name="spot_name" value="'.$spot_name.'" style="padding-top:40px;"> '.$spot_name.'</h2>
			<p style="padding-right:150px;padding-top:10px;">'.$review_essential.'</p>
			</p>

		</div>
		<br style="clear: both;">
		<hr>';
	}



	?>
</div>

 <?php include "footer.php";
  ?>
