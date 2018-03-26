<?php 
	echo '<script type="text/javascript">
	function goto_url(){
		f1 = document.f1;
		f1.action = "collections.php";
		f1.submit();
	}
	</script>';
	include_once "../homepage/includes/db.inc.php";
	include "header.php";
	echo '<br>';
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
		foreach ($search_result as $i){
			$img_url = $i['image'];
			$spot_name = $i['name'];
			$review_essential = $i['review_essential'];
			echo '<form name="f1" class="spot-box" action="collections.php" method="POST" target="hide">
					 <img src="'.$img_url.'" alt="spots image" width="200px" height="150px" style="margin:50px;float:left;">
					 <p style="float:left;">
					 <input type="hidden" name="spot_name" value="'.$spot_name.'">
					 <h2 name="spot_name" value="'.$spot_name.'" style="padding-top:50px;"> '.$spot_name.'<button type="submit" name="favorite" style="float:right;margin-right:10px;">Favorite</button></h2>
					 <p style="">'.$review_essential.'</p>
					 </p>

				</form>
				<iframe id="hide" name="hide" style="display:none;"></iframe>
				<br style="clear:both;">
				<hr>';
		}
		

	}
	// else{
	// 	header("Location: index.php");
	// 	exit();
	// }



	include "footer.php";


 ?>
