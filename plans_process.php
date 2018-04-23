<?php 
	include 'header.php';
	include_once '../homepage/includes/db.inc.php';
 ?>



<br>

<body>
	<?php 
		$city = mysqli_real_escape_string($conn, $_POST['city']);
		$budget = mysqli_real_escape_string($conn, $_POST['budget']);
		//query all the attractions in that city
		if ($budget == 'None'){
			$sql = "SELECT SID,name,coordinate_longitude,coordinate_latitude FROM attraction WHERE city LIKE '%$city%';";
		}else if ($budget == 'Free'){
			$sql = "SELECT SID,name,coordinate_longitude,coordinate_latitude FROM attraction WHERE city LIKE '%$city%' AND price LIKE '%None%';";
		}else{
			$sql = "SELECT SID,name,coordinate_longitude,coordinate_latitude FROM attraction WHERE city LIKE '%$city%' AND price NOT LIKE '%None%';";
		}
		$result = mysqli_query($conn, $sql);
		$check = mysqli_num_rows($result);
		$candidates = array();
		if ($check > 0){
			while ($row = mysqli_fetch_assoc($result)){
				$candidates[] = $row;
			}
		}else{
			echo "<script>alert('Error!');</script>";
		}
	 ?>


	 <script type="text/javascript" src="k_means.js"></script>

	 <script type="text/javascript">
	 	function random_pick_init_centroids(f_loc){
	 		var rand_index;
	 		var l = Object.keys(f_loc).length;
	 		var init_c = [];
	 		for (var i = 0; i < 3; i++){
	 			rand_index = Math.floor(Math.random()*l);
	 			init_c.push(f_loc[Object.keys(f_loc)[rand_index]]);
	 		}
	 		return init_c;
	 	}

	 	function pick_spots(spot_list,days,sites_per_day, fav, brow){
	 		/*Explain:
	 		each site in the spot_list has a score, if the user has favored a spot, then that spot will 
	 		get 5 points, if the user clicked the spot for one time, then that spot earn 0.5 point, click twice, earn 
	 		1 points... and so on. Finally, we output the highest [days * sites_per_day] spots

	 		Args: 
	 		spot_list(array list): all sites in one cluster
	 		fav(array list): this user's favorite spots
	 		brow(object): the sites that this user has browsed, {spot_name: # of clicks}

	 		Return:
	 		return_spot: the recommended trip plan
	 		*/
	 		var return_spot = [];
	 		var spot_score = {};
	 		//initialize the score dictionary
	 		for (var key in spot_list){
	 			spot_score[spot_list[key]] = 0;
	 		}
	 		var total = days * sites_per_day;
	 		if (total >= spot_list.length){
	 			return_spot = spot_list;
	 		}else{
	 			for (var key in spot_list){
	 				if (fav.includes(spot_list[key])){
	 					spot_score[spot_list[key]] += 5;
	 				}
	 				if (Object.keys(brow).includes(spot_list[key])){
	 					spot_score[spot_list[key]] += 0.5 * brow[spot_list[key]];
	 				}
	 			}
	 			//sort the score dictionary by value
	 			var sorted = [];
				for (var spot in spot_score) {
				    sorted.push([spot, spot_score[spot]]);
				}
				sorted.sort(function(a, b) {
				    return b[1] - a[1];
				});
				//return the first [total] spots in sorted spot list
				for (var i = 0; i < total; i++){
	 				return_spot.push(sorted[i][0]);
	 			}
	 		}

	 		return return_spot;
	 	}

	 	function make_plan(){
	 		var candidates = [];
		 	<?php 
			$city = mysqli_real_escape_string($conn, $_POST['city']);
			$budget = mysqli_real_escape_string($conn, $_POST['budget']);
			$days = $_POST['duration'];
			$sites_per_day = $_POST['num_sites'];
			//query all the attractions in that city
			if ($budget == 'None'){
				$sql = "SELECT SID,name,coordinate_longitude,coordinate_latitude FROM attraction WHERE city LIKE '%$city%';";
			}else if ($budget == 'Free'){
				$sql = "SELECT SID,name,coordinate_longitude,coordinate_latitude FROM attraction WHERE city LIKE '%$city%' AND price LIKE '%None%';";
			}else{
				$sql = "SELECT SID,name,coordinate_longitude,coordinate_latitude FROM attraction WHERE city LIKE '%$city%' AND price NOT LIKE '%None%';";
			}
			$result = mysqli_query($conn, $sql);
			$check = mysqli_num_rows($result);
			if ($check > 0){
				while ($row = mysqli_fetch_assoc($result)){
			?>
					candidates.push(<?php echo json_encode($row); ?>);
			<?php
				}
			}else{
				echo "<script>alert('Error!');</script>";
			}
		 	?>
		 	var loc = {};
		 	var c = [];
		 	for (var i in candidates){
		 		loc[candidates[i].name] = [candidates[i].coordinate_longitude, candidates[i].coordinate_latitude];
		 	}
		 	c = random_pick_init_centroids(loc);

		 	//transfer the value of objects loc and c into float
		 	for (var i in loc){
		 		for (var j in loc[i]){
		 			loc[i][j] = parseFloat(loc[i][j]);
		 		}
		 		
		 	}
		 	console.log(loc);
		 	console.log(c);
		 	var new_c = k_means(loc,c);
		 	var final_cluster = assign_cluster(loc,new_c);
		 	var cluster_to_spots = [];
		 	for (var i = 1; i <= 3; i++){
		 		var temp = [];
		 		for (var spot in final_cluster){
		 			if (final_cluster[spot] == (i-1)){
		 				temp.push(spot);
		 			}
		 		}
		 		cluster_to_spots.push(temp);
		 	}
		 	console.log(cluster_to_spots);
		 	var user_fav = [];
		 	var user_brow = {};
		 	var days = <?php echo $days; ?>;
		 	var sites_per_day = <?php echo $sites_per_day; ?>;
		 	<?php 
		 		/* need to fetch the user's favorites spots and browse history
		 		these information is used to generate design plans
		 		*/
		 		$uid = $_SESSION['u_id'];
		 		$sql_f = "SELECT attraction.name AS name FROM FavoriteSpots INNER JOIN attraction ON FavoriteSpots.SID = attraction.SID WHERE FavoriteSpots.UID = $uid;";
		 		$result_f = mysqli_query($conn, $sql_f);
		 		$sql_b = "SELECT a.name AS name, b.NumClicks AS clicks FROM BrowseHistory b INNER JOIN attraction a ON b.SID = a.SID WHERE b.UID = $uid;";
		 		$result_b = mysqli_query($conn, $sql_b);
		 		while($row = mysqli_fetch_assoc($result_f)){
		 	?>
		 			user_fav.push(<?php echo json_encode($row['name']); ?>)
		 	<?php
		 		}
		 		while ($row = mysqli_fetch_assoc($result_b)){
		 	?>
		 			user_brow[<?php echo json_encode($row['name']); ?>] = <?php echo $row['clicks']; ?>;
		 	<?php
		 		}
		 	 ?>
		 	 var plans = [];
		 	 for (var i = 0; i < 3; i++){
		 	 	plans.push(pick_spots(cluster_to_spots[i],days,sites_per_day,user_fav,user_brow));
		 	 }
		 	 console.log(plans);

		 	 return plans;
	 	}
	 	


	 </script>

<form action="show_plans.php" method="POST" id="submit">
	<input type="hidden" id="plan1" name="plan1" value=""> 
	<input type="hidden" id="plan2" name="plan2" value=""> 
	<input type="hidden" id="plan3" name="plan3" value=""> 
	<input type="hidden" id="days" name="days" value="">
	<input type="hidden" name="sites_per_day" id="sites_per_day" value="">
</form>


<script type="text/javascript">
	var final_plan = make_plan();
	var days = <?php echo $_POST['duration']; ?>;
	var sites_per_day = <?php echo $_POST['num_sites'] ?>;
	document.getElementById("plan1").value = final_plan[0];
	document.getElementById("plan2").value = final_plan[1];
	document.getElementById("plan3").value = final_plan[2];
	document.getElementById("days").value = days;
	document.getElementById("sites_per_day").value = sites_per_day;
	var form = document.getElementById("submit");
	form.submit();
</script>
</body>








<?php 
	include 'footer.php';
 ?>