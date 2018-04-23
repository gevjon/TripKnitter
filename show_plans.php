<?php 
	include "header.php";
	include_once "../homepage/includes/db.inc.php";


 ?>
<link rel="stylesheet" type="text/css" href="card.css">

<br>

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

		// echo $sites_per_day;
	?>


		<?php 
			$site_index = 0;
			for ($day_count = 1; $day_count <= $tour_days; $day_count++){
				echo "<ul class='cards'>";
				for ($site_count = 1; $site_count <= ($sites_per_day+1); $site_count++){
					if ($site_count == 1){
						$card_id = 4+$site_count-$sites_per_day;
						echo "<li class='card card-".$card_id."' style = 'background-color = pink;'>
								<img src='figures/Day_".$day_count.".png'/ alt='Unloaded image' style='margin:auto; padding:0 10px;width:150px;margin-left:auto;margin-right:auto;'>  
						  	</li>";
					}else{
						$site = $split_p1[$site_count+($day_count-1)*$sites_per_day - 2];
						$sql = "SELECT image FROM attraction WHERE name = '$site';";
						$url_query = mysqli_query($conn,$sql);
						$url = mysqli_fetch_assoc($url_query)['image'];
						if (!strpos($url,"http")){
							$url = "figures/show_plan_default1.jpg";
						}
						$card_id = 4+$site_count-$sites_per_day;
						echo "<li class='card card-".$card_id."' style = 'background-color = pink;'>
								<img src='".$url."'/ alt='Unloaded image'>  
								<div class='content'>
									<h1 style='font-size:18px;text-align:center;'>".$site."</h1>
									
								</div>
							  </li>";
					}
				}
				echo "</ul>
						<hr/>";
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