<?php 
	include 'header.php';
	include_once '../homepage/includes/db.inc.php';
 ?>
<style type="text/css">
	.plan_block{
		margin-right: 20px;
		margin-left: 20px;
		margin-bottom: 20px;
		padding: 10px;
		border: solid;
		height: 200px;
		/*background-color: green;*/
		color: black;
	}




</style>


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

	 <script type="text/javascript">
	 	





	 </script>






	 <div class="plan_block">
	 	<h3>Plan 1</h3>

	 </div>

	 <div class="plan_block">
	 	<h3>Plan 2</h3>
	 </div>

	 <div class="plan_block">
	 	<h3>Plan 3</h3>
	 </div>


</body>








<?php 
	include 'footer.php';
 ?>