<?php
	include "header.php";
	include_once "../homepage/includes/db.inc.php";

	$sql= "SELECT distinct city FROM attraction;";
	$result = mysqli_query($conn,$sql);
 ?>

 <div id="background2" style="position:absolute;z-index:-1;width:100%;height:100%;left:0px;margin-top:-250px;margin-bottom:-50px;">
		 <img src="figures/background2.jpg" width="100%" height="100%">
 </div>

<form  action="plans.php" method="post" style="padding:100px;padding-top:500px;">
	Target City:
	<select class="" name="city" style="width:100px;margin-right:5%;">
		<?php while($row = mysqli_fetch_assoc($result)):;?>
        <option><?php echo $row['city'];?></option>
    <?php endwhile;?>
	</select>

	Trip Duration:
	<select class="" name="duration" style="width:100px;margin-right:5%;">
		<option value="1"> 1 day </option>
		<option value="2"> 2 day </option>
		<option value="3"> 3 day </option>
	</select>

	Budget:
	<select class="" name="budget" style="width:120px;margin-right:5%;">
		<option value="None"> --None-- </option>
		<option value="Free"> Free </option>
		<option value="Charge"> Charge </option>
	</select>

	Num of Sites/Day:
	<select class="" name="num_sites" style="width:100px;margin-right:5%;">
		<option value="1"> 1 </option>
		<option value="2"> 2 </option>
		<option value="3"> 3 </option>
		<option value="4"> 4 </option>
		<option value="more"> 5 </option>
	</select>

	<input type="submit" value="Plan My Trip" style="border-radius: 12px;font-size: 20px;color:white;width: 300px;margin-left: 35%;margin-top: 50px;padding: 5px;background-color:#3EC3C1;border:none;">

</form>



 <?php include "footer.php";
  ?>
