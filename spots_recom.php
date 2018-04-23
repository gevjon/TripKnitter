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
background: #ffffff 50% 50% / cover;
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
	background-color: #fdfdfd;
	/* background-image: url("figures/background5.png"); */
}





.userRanking a {
  color: black;
  text-decoration: none;
}
.userRanking a:hover {
  background-color: #f5f5f5;
}

.dailyUserRanking-title {
  height: 30px;
  margin-bottom: 15px;
}
.dailyUserRanking-title span {
  font-size: 28px;
}
.dailyUserRanking-title .dailyUserRanking-heading {
  display: inline-block;
  line-height: 30px;
  font-size: 16px;
  font-weight: bold;
}

.userRanking-list {
  display: flex;
  flex-direction: column;
  flex-wrap: wrap;
  justify-content: center;
  align-content: space-between;
  width: 730px;
  height: 200px;
}

.userRanking-item a {
  display: flex;
  align-items: center;
  width: 345px;
  height: 40px;
  border-top: solid 1px #ccc;
  border-bottom: solid 1px #ccc;
  box-sizing: border-box;
  margin-bottom: -1px;
}
.userRanking-item:nth-child(-n+3) .userRanking-item-rank {
  background-color: #c00;
}

.userRanking-item-rank {
  width: 30px;
  height: 30px;
  text-align: center;
  line-height: 30px;
  font-size: 13px;
  color: white;
  background-color: black;
}

.userRanking-item-thumb {
  margin-left: 8px;
}
.userRanking-item-thumb img {
  width: 24px;
  height: 24px;
}

.userRanking-item-name {
  margin-left: 8px;
  font-size: 13px;
	width: 200px;
}

.userRanking-item-view {
  margin-left: auto;
}
.userRanking-item-view .userRanking-item-view-title {
  display: inline-block;
  font-size: 10px;
}
.userRanking-item-view .userRanking-item-view-number {
  display: inline-block;
  font-size: 14px;
  font-weight: bold;
}

.dailyUserRanking-more {
  display: flex;
  align-items: center;
  width: 55px;
  height: 22px;
  margin-top: 20px;
  margin-left: auto;
  background-color: black;
}
.dailyUserRanking-more:hover {
  background-color: #333;
}
.dailyUserRanking-more span {
  margin-left: 8px;
  font-size: 2px;
  color: white;
}
.dailyUserRanking-more p {
  margin-left: 6px;
  font-size: 12px;
  color: white;
}

}
</style>

<!-- ranking -->
<?php
$sql_rank_general = "SELECT top10.*,(@rank:=@rank+1) as counter FROM
(SELECT (sum(b.NumClicks)*0.5+count(f.uid)*5) AS general_score,a.sid as sid,a.name as name,a.city as city
FROM BrowseHistory b,FavoriteSpots f,attraction a
WHERE b.uid=f.uid AND b.sid=f.sid AND b.sid=a.sid
GROUP BY a.sid
ORDER BY general_score DESC LIMIT 10)as top10
INNER JOIN (SELECT @rank :=0) b
;";

$result_rank_general = mysqli_query($conn,$sql_rank_general);
$queryResults_rank_general = mysqli_num_rows($result_rank_general);

// $sql_rank_shoping = "";
 ?>

<!-- ranks:float -->
<br><br>
<div class="dailyUserRanking" style="margin-left:10px;float:left;">
  <div class="dailyUserRanking-title"><span class="fa fa-arrow-up"></span>
    <h5 style="left:10px;position:absolute;margin-top:10px;">Spot Ranking</h5>
  </div>
  <div class="dailyUserRanking-content">
    <div class="userRanking">
      <ul class="userRanking-list">
				<?php while($row_rank_general = mysqli_fetch_assoc($result_rank_general)):
					$id = $row_rank_general['counter'];
					;?>
					<li class="userRanking-item"><a href="spot_detail.php?sid=<?php echo $row_rank_general['sid'] ?>"><span class="userRanking-item-rank"><?php echo $row_rank_general['counter'] ?></span>
							<p class="userRanking-item-name"><?php echo $row_rank_general['name'] ?></p>
							<div class="userRanking-item-view">
								<p class="userRanking-item-view-title"><?php echo $row_rank_general['city'] ?></p>
							</div></a></li>
					<?php endwhile ;?>
      </ul>
    </div>
  </div>
</div>

<!-- tags:float -->
<?php
$sql_tags = "SELECT tags.words as words FROM tags;";
$result_tags = mysqli_query($conn,$sql_tags);
$queryResults_tags = mysqli_num_rows($result_tags);
//randomly choose the colour
$tag_class = array("primary", "success","danger","warning","info","dark");
if($queryResults_tags > 0){
	?>
	<div class="" style="max-width:33%;float:left;margin-top:50px;margin-left:5%;">
	<?php
	while( $i = mysqli_fetch_assoc($result_tags)){
		$random = rand() % count($tag_class);
		?>
		<a href='' class='badge badge-pill badge-<?php echo $tag_class[$random] ?>' style="margin-top:3px;"><?php echo $i['words'] ?></a>
	<?php }?>
	</div>
	<?php
	}?>
 <!-- <h1 style="color:white;font-weight:666;text-align:center;">Picks 4 YOU</h1> -->

 <?php
	//general score
	// $sql_general_rank = "SELECT (sum(b.NumClicks)*0.5+sum(f.UID)*5) AS general_score,a.sid as SID FROM BrowseHistory b,FavoriteSpots f,attraction a
	// WHERE b.uid=f.uid AND b.sid=f.sid AND b.sid=a.sid
	// GROUP BY a.sid
	// ORDER BY general_score DESC LIMIT 100;";


 //for login user, Recommendation priority: 1.fav 2.click 2.general ranking
 //exclude visited, cosider similarity with visited
 //other user with similar fav & visited, their fav&visited I didn't fav or visited

 if(isset($_SESSION['u_id'])){
	 $u_id = $_SESSION['u_id'];
	 $sql = "SELECT sid,image,name FROM attraction
	 WHERE sid IN (SELECT rand8.sid FROM
	 (SELECT non_vist30.sid as sid,FLOOR(rand(now())*30)as r FROM
	 (SELECT top100.* FROM
	 (SELECT fav_score.sid as sid,(fav+click+general)as score FROM
	 (SELECT temp2.sid as sid,ifnull(0.5*temp1.NumClicks,0)as click FROM
	 (SELECT * FROM BrowseHistory b WHERE b.uid=$u_id)as temp1
	 RIGHT JOIN (SELECT sid FROM attraction )as temp2 ON temp1.sid=temp2.sid)as click_score

	 LEFT JOIN

	 (SELECT f.sid as sid, 5 as fav FROM FavoriteSpots f
	 WHERE f.uid=$u_id
	 UNION
	 SELECT a.sid as sid,0 as fav FROM attraction a WHERE a.sid
		 NOT IN (SELECT sid FROM FavoriteSpots ff WHERE ff.uid=$u_id))as fav_score

		 ON click_score.sid=fav_score.sid
		 LEFT JOIN

	 (SELECT a.sid,ifnull((10-0.1*G100.counter),0)as general FROM
	 (SELECT top100.*,(@rank:=@rank+1) as counter FROM
	  (SELECT (sum(b.NumClicks)*0.5+count(f.uid)*5) AS general_score,a.sid as sid
	 FROM BrowseHistory b,FavoriteSpots f,attraction a
	 WHERE b.uid=f.uid AND b.sid=f.sid AND b.sid=a.sid
	 GROUP BY a.sid
	 ORDER BY general_score DESC LIMIT 100)as top100 INNER JOIN (SELECT @rank :=0) b)as G100
	 RIGHT JOIN (SELECT sid FROM attraction) a on G100.sid=a.sid)as g_score

	 ON fav_score.sid=g_score.sid

	 ORDER BY score DESC LIMIT 100)as top100

	 LEFT JOIN (SELECT u.sid,'*'as mark FROM user_visited u WHERE u.uid=$u_id)as v ON top100.sid=v.sid
	 WHERE v.mark IS NULL ORDER BY score DESC LIMIT 30)as non_vist30
	 ORDER BY r LIMIT 8)as rand8)
	 ;";

 } else {
	 $sql = "SELECT sid,image,name FROM attraction
	 WHERE sid IN (SELECT rand8.sid FROM
	 (SELECT top30.sid as sid,FLOOR(rand(now())*30)as r FROM
	  (SELECT (sum(b.NumClicks)*0.5+count(f.uid)*5) AS general_score,a.sid as sid
	 FROM BrowseHistory b,FavoriteSpots f,attraction a
	 WHERE b.uid=f.uid AND b.sid=f.sid AND b.sid=a.sid
	 GROUP BY a.sid
	 ORDER BY general_score DESC LIMIT 30)as top30
	 ORDER BY r LIMIT 8)as rand8);";
		 }

//retrieve attraction info
	$result = mysqli_query($conn,$sql);
	$queryResults = mysqli_num_rows($result);
 	$index = 0;
 // $sql = "SELECT sid,image,name FROM attraction LIMIT 8;";
 // $result = mysqli_query($conn,$sql);
 // $queryResults = mysqli_num_rows($result);

if($queryResults > 0){
	echo "
	<br>
	<h5 style='padding:10px;margin-top:-10px;clear:both;'>Daily Picks</h5>
	<div class='container'>
	";
	while($row = mysqli_fetch_assoc($result)){
		//deal with default image
		if(strpos($row['image'],"http")){
			$img_url = $row['image'];
		}
		else{
			$img_url = 'figures/spot_default.jpg';
		}
		//echo the info into cards
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
			<div class='photo-container' style='background-image:url(".$img_url."?w=510&h=318&fit=crop&q=50&auto=enhance&crop=entropy);'></div>
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
