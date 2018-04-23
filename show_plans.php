<?php 
	include "header.php";
	include_once "../homepage/includes/db.inc.php";


 ?>
<link rel="stylesheet" type="text/css" href="card.css">

<br>

<body >
	<?php 
		$plan1 = $_POST['plan1'];
		$plan2 = $_POST['plan2'];
		$plan3 = $_POST['plan3'];
		$tour_days = $_POST['days'];
		$split_p1 = explode(",",$plan1);  //split the string by ",", the return form is an array
		$split_p2 = explode(",",$plan2);
		$split_p3 = explode(",",$plan3);
		$sites_per_day = $_POST['sites_per_day'];


	?>

<script type="text/javascript">
	var plan1 = <?php echo json_encode($plan1); ?>;
	var plan2 = <?php echo json_encode($plan2); ?>;
	var plan3 = <?php echo json_encode($plan3); ?>;
	console.log(plan1);
	console.log(plan2);
	console.log(plan3);
</script>
		<?php 
			$site_index = 0;
			$actual_plan_id = 1;
			for ($plan_id = 1; $plan_id <= 3; $plan_id++){
				if ($plan_id == 1){
					$current_plan = $split_p1;
				}else if ($plan_id == 2){
					$current_plan = $split_p2;
				}else{
					$current_plan = $split_p3;
				}
				if (count($current_plan) < $tour_days*$sites_per_day){
					continue;
				}
				echo "<h2 style='margin-left:20px; font-family:  Impact, Charcoal, sans-serif; font-size:40px;'>Plan ".$actual_plan_id."</h2>";
				for ($day_count = 1; $day_count <= $tour_days; $day_count++){
					echo "<ul class='cards'>";
					for ($site_count = 1; $site_count <= ($sites_per_day+1); $site_count++){
						if ($site_count == 1){
							$card_id = 5+$site_count-$sites_per_day;
							echo "<li class='card card-".$card_id."' style = 'background-color = pink;'>
									<img src='figures/Day_".$day_count.".png'/ alt='Unloaded image' style='margin:auto; padding:0 10px;width:150px;margin-left:auto;margin-right:auto;height:auto;'>  
							  	</li>";
						}else{
							$site = $current_plan[$site_count+($day_count-1)*$sites_per_day - 2];
							$query_site = mysqli_real_escape_string($conn, $site);
							$sql = "SELECT image,SID FROM attraction WHERE name = '$query_site';";
							$url_query = mysqli_query($conn,$sql);
							$result_check = mysqli_num_rows($url_query);
							if ($result_check > 0){
								$result = mysqli_fetch_assoc($url_query);
								$url = $result['image'];
								$sid = $result['SID'];
							}
							
							if (!strpos($url,"http")){
								$url = "figures/show_plan_default1.jpg";
							}
							$card_id = 5+$site_count-$sites_per_day;
							echo "<li class='card card-".$card_id."' style = 'background-color = pink;'>
									<a href='spot_detail.php?sid=".$sid."' target='_blank'><img src='".$url."'/ alt='Unloaded image'></a>
									<div class='content'>
										<h1 style='font-size:18px;text-align:center;'>".$site."</h1>
										
									</div>
								  </li>";
						}
					}
					echo "</ul>
							<hr/>";
				}
				$actual_plan_id += 1;
			}
			
		 ?>
		

		









	



<script type="text/javascript">
	jQuery(document).ready(function($){
		$('ul.cards').on('click', function(){
			$(this).toggleClass('transition');
		});

		$('ul.card-stacks').on('click', function(){
			$(this).toggleClass('transition');
		});

		$('ul.cards-split').on('click', function(){
			$(this).toggleClass('transition');
		});

		$('ul.cards-split-delay').on('click', function(){
			$(this).toggleClass('transition');
		});
	});
</script>








</body>






























 <?php 
 	include "footer.php";
  ?>