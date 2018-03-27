<?php
	include "header.php";
	include_once "../homepage/includes/db.inc.php";
?>
<script type="text/javascript">
	function goto_url(){
		f1 = document.f1;
		f1.action = "collections.php";
		f1.submit();
	}

	function like_button(button){
		if (button.name == "unlike"){
			document.getElementById(button.id).innerHTML='<button type="submit"  name="like" id=button.id onclick="like_button(this)" style="float:right;outline:none;border:none;background-color:Transparent;margin-right:30px;margin-top:-30px;height:35px;width:35px;"><img src="../homepage/figures/collection_star.png" style="width:30px;height:30px;"></button>';
		}
		else{
			document.getElementById(button.id).innerHTML='<button type="submit"  name="unlike" id=button.id onclick="like_button(this)" style="float:right;outline:none;border:none;background-color:Transparent;margin-right:30px;margin-top:-30px;height:35px;width:35px;"><img src="../homepage/figures/collection_unstar.png" style="width:30px;height:30px;"></button>';
		}

		
	}

	function unlike_button(index){
		document.getElementById(index).innerHTML='<button type="submit"  name="favorite" id=index.toString() onclick="like_button(this.id)" style="float:right;outline:none;border:none;background-color:Transparent;margin-right:30px;margin-top:-30px;height:35px;width:35px;"><img src="../homepage/figures/collection_unstar.png" style="width:30px;height:30px;"></button>';
	}

</script>
<br>
<?php
	


	if (isset($_POST['submit'])){

		$keyword = mysqli_real_escape_string($conn, $_POST['search-homepage']);
		$sql = "SELECT * FROM attraction WHERE name LIKE '% $keyword %' OR name LIKE '% $keyword' OR name LIKE '$keyword %';";
		$result = mysqli_query($conn, $sql);
		$resultcheck = mysqli_num_rows($result);
		$search_result = array();
		if ($resultcheck > 0){
			while ($row = mysqli_fetch_assoc($result)){
				$search_result[] = $row;
			}
		}else {
			echo "<p style='text-align: center; height: 80%'>There are no relevant results matching your search!</p>";
		}


		//Check whether the user has already favorited some spots
		// $username = $_SESSION['u_name'];
		// $sql_user = "SELECT SID FROM FavoriteSpots WHERE UID='$username';";
		// $result = mysqli_query($conn, $sql_user);
		// $resultcheck = mysqli_num_rows($result);
		// if ($resultcheck > 0){
		// 	while ($row=mysqli_fetch_assoc($result))
		// 		$saved_fav[] = $row;
		// }
		

		
		$index = 0;
		foreach ($search_result as $i){
		  $img_url = $i['image'];
		  $spot_name = $i['name'];
		  $review_essential = $i['review_essential'];
		  $sql_sid = $i['SID'];
		  echo '<a href="spot_detail.php?sid='.$sql_sid.'"style="text-decoration:none;">
		      <form name="f1" class="spot-box" action="collections.php" method="POST" target="hide">
		       <img src="'.$img_url.'" alt="spots image" width="200px" height="150px" style="margin:50px;float:left;">
		       <p style="float:left;">
		       <input type="hidden" name="spot_name" value="'.$spot_name.'">
		       <h2 name="spot_name" value="'.$spot_name.'" style="padding-top:40px;"> '.$spot_name.'<div id="'.$index.'"><button type="submit" value="'.$index.'" name="favorite" id="'.$index.'" onclick="change_button(this.id);" style="float:right;margin-right:10px;background-color:white;font-size:20px;padding:5px;">Favorite</button></div></h2>
		       <p style="padding-right:150px;padding-top:10px;">'.$review_essential.'</p>
		       </p>

		        </form>
		        <iframe id="hide" name="hide" style="display:none;"></iframe>
		        <br style="clear:both;">
		        <hr>
		        </a>';
		  $index += 1;
		}







		// $index = 0;
		// foreach ($search_result as $i){
		// 	$img_url = $i['image'];
		// 	$spot_name = $i['name'];
		// 	$review_essential = $i['review_essential'];
		// 	echo '<form name="f1" class="spot-box" action="collections.php" method="POST" target="hide">
		// 			 <img src="'.$img_url.'" alt="spots image" width="200px" height="150px" style="margin:50px;float:left;">
		// 			 <p style="float:left;">
		// 			 <input type="hidden" name="spot_name" value="'.$spot_name.'">
		// 			 <h2 name="spot_name" value="'.$spot_name.'" style="padding-top:40px;"> '.$spot_name.'<div id="'.$index.'"><button type="submit" name="unlike" id="'.$index.'"  onclick="like_button(this)" style="float:right;outline:none;border:none;background-color:Transparent;margin-right:30px;margin-top:-30px;height:35px;width:35px;"><img src="../homepage/figures/collection_unstar.png" style="width:30px;height:30px;"></button></div></h2>
		// 			 <p style="padding-right:150px;padding-top:10px;">'.$review_essential.'</p>
		// 			 </p>

		// 		</form>
		// 		<iframe id="hide" name="hide" style="display:none;"></iframe>
		// 		<br style="clear:both;">
		// 		<hr>';
		// 	$index += 1;
		// }

	}
	// else{
	// 	header("Location: index.php");
	// 	exit();
	// }



	include "footer.php";


 ?>
