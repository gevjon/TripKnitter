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
function unlike(button){
	document.getElementById(button.value).innerHTML="<p style='color:green; font-size:20px; font-family:Helvetica-Bold; float:right; margin-top:-40px; margin-right:55px;'>Deleted!</p>"
	var f = document.getElementById('f'+button.value);

	f.submit();
}
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
	$index=0;
	foreach ($search_result as $i){
		$spot_img = $i['image'];
		$spot_name = $i['name'];
		$spot_id = $i['SID'];
		$review_essential = $i['review_essential'];
		echo '<form id="f'.$index.'" name="profile_fav" action="del_fav.php" method="POST" target="hide">
			<img src="'.$spot_img.'" alt="spot_image" width:200px height:150px style="float: left; margin: 50px;">
			<p style="float:left;">
			<input type="hidden" name="spot_id" value="'.$spot_id.'">
			<h2 name="spot_name" value="'.$spot_name.'" style="padding-top:40px;"> '.$spot_name.'</h2>
			<div id="'.$index.'"><button type="submit" value="'.$index.'" onclick="unlike(this)" style="float:right;background-color:#4CAF50;color:white;border:none;margin-right:50px;margin-top:-40px;height:35px;width:100px;">Unlike</button></div>
			<p style="padding-right:150px;padding-top:10px;">'.$review_essential.'</p>
			</p>

		</form>
		<iframe id="hide" name="hide" style="display:none;"></iframe>
		<br style="clear: both;">
		<hr>';
		$index += 1;
	}



	?>
</div>

 <?php include "footer.php";
  ?>
