<?php
	include "header.php";
	include_once "../homepage/includes/db.inc.php";
 ?>

<style media="screen">
/* The magic */
.col {
overflow: hidden;
position: relative;
}

.slide {
position: absolute;
top: 0;
right: 0;
bottom: 0;
left: 0;
/*
	Visibility delay gives the previously hovered element time to slide out before disappearing.
	Remove the `visibility` transition to slide in current element without sliding out previous element
*/
transition: all 0.275s ease-in-out, visibility 0s 0.275s;
visibility: hidden;
will-change: transform;
-webkit-transform: translateY(100%);
				transform: translateY(100%);
}

.row:hover ~ .row .slide {
-webkit-transform: translateY(-100%);
				transform: translateY(-100%);
}
.row:hover .slide {
-webkit-transform: translateX(100%);
				transform: translateX(100%);
}
.row:hover .col:hover ~ .col .slide {
-webkit-transform: translateX(-100%);
				transform: translateX(-100%);
}
.row:hover .col:hover .slide {
-webkit-transform: none;
				transform: none;
visibility: visible;
transition-delay: 0s;
}

/* Pen styling */

.container {
margin: 0 auto;
/* padding: 2rem; */
max-width: 100%;
}

.row {
display: flex;
}

.col {
color: white;
/* flex: 1 1 auto; */
min-height: 260px;
position: relative;
}
.col h2 {
font-weight: 300;
font-size: 1.33333rem;
line-height: 1.25;
margin: 0;
position: absolute;
bottom: 1.5rem;
right: 1.5rem;
z-index: 0;
}

.col:nth-child(2) {
min-width: 20%;
}

.col:nth-child(4) {
min-width: 20%;
}

.col:nth-child(3) + .col:nth-child(3) {
min-width: 50%;
}

.photo-container {
background: #3EC3C1 50% 50% / cover;
position: absolute;
top: 0;
right: 0;
bottom: 0;
left: 0;
transition: 1s;
-webkit-transform-origin: bottom right;
				transform-origin: bottom right;
}
.photo-container::before {
/* background: linear-gradient(transparent, rgba(0, 17, 51, 0.5), #000320); */
content: '';
position: absolute;
top: 0;
right: 0;
bottom: 0;
left: 0;
}
.col:hover .photo-container {
-webkit-transform: scale(1.25);
				transform: scale(1.25);
}

.slide {
background: rgba(25, 1, 21, 0.8);
/* background: rgba(225,225,225,0.5); */
padding: 0 1.5rem;
}

p{
	margin-top: 20px;
}
body{
	/* background-color: pink; */
}
</style>


 <!-- <h1 style="color:white;font-weight:666;text-align:center;">Picks 4 YOU</h1> -->
 <br>
 <?php
 //for login user, Recommendation priority: 1.fav 2.click 2.general ranking
 //exclude visited, cosider similarity with visited
 //other user with similar fav & visited, their fav&visited I didn't fav or visited
 if(isset($_SESSION['u_id'])){
	 $u_id = $_SESSION['u_id'];
	 $sql_visited = "select sid from user_visited;";

 }

 $index = 0;
 $sql = "SELECT sid,image,name FROM attraction WHERE LENGTH(image)>5 limit 8;";
 $result = mysqli_query($conn,$sql);
 $queryResults = mysqli_num_rows($result);

if($queryResults > 0){
	echo "
	<div class='container'>
	";
	while($row = mysqli_fetch_assoc($result)){
		if($index % 4 == 0){//3 cols a row
			echo "
			<div class='row'>
			";
		}
		// //for blank card
		// if($index %4==2 or $index %4==3){
		// 	echo"
		// 	<div class='col'>
		// 		<div class='photo-container' style='background-color:#3EC3C1;'></div>
		// 		<div class='slide'>
		// 			<p>Quam molestiae ipsa sapiente mollitia, nobis.</p>
		// 		</div>
		// 	</div>
		// 	";
		// }
		// //for blank card

		echo"
		<div class='col'>
			<a href='spot_detail.php?sid=".$row['sid']."' style='text-decoration:none;color:white;'>
			<div class='photo-container' style='background-image:url(".$row['image']."?w=510&h=318&fit=crop&q=50&auto=enhance&crop=entropy);'></div>
			<div class='slide'>
				<h1 style='padding-top:20px;'>".$row['name']."</h1>
			</div>
			</a>
		</div>
		";

		//for blank card
		// if($index %4==0 or $index %4==1){
		// 	echo"
		// 	<div class='col'>
		// 		<div class='photo-container' style='background-color:#3EC3C1;'></div>
		// 		<div class='slide'>
		// 			<p>Quam molestiae ipsa sapiente mollitia, nobis.</p>
		// 		</div>
		// 	</div>
		// 	";
		// }
		//for blank card

		if($index % 4 == 3){//3 cols a row
			echo "
			</div >
			";
		}
		$index ++;
	}
	if(!$index%4==0){//in case for the last row: close the row anyway
		echo"
		</div>
		";
	}
	echo"
	</div >
	";
}

  ?>

 <?php include "footer.php";
  ?>
