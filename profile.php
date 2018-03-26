<?php
	include "header.php";
 ?>

<div class="section" id="user_info">
	<img src="figures/user_stamp/user1.jpeg" alt="user_pic" height="200px" width="200px" style="float:left;margin:50px;">

	<span></span>
	<p class="h1" id="username" style="padding-top:100px;">Username</p>
	<p>Email Address:</p>

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
	
</div>

 <?php include "footer.php";
  ?>
