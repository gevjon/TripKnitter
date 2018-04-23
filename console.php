<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

<?php 
	$plan1 = $_POST['plan1'];
	$plan2 = $_POST['plan2'];
	$plan3 = $_POST['plan3'];
	$tour_days = $_POST['days'];
	$split_p1 = explode(",",$plan1);  //split the string by ",", the return form is an array
	$split_p2 = explode(",",$plan2);
	$split_p3 = explode(",",$plan3);
	$sites_per_day = count($split_p1)/$tour_days;
	echo count($split_p1)."<br>";
	echo count($split_p2)."<br>";
	echo count($split_p3)."<br>";
 ?>
<script type="text/javascript">
	

</script>




</body>
</html>