<?php
	include "header.php";
  include_once "../homepage/includes/db.inc.php";
 ?>
<br>

<?php
  $detail_sid = mysqli_real_escape_string($conn,$_GET['sid']);

  $sql = "SELECT * FROM attraction WHERE SID=$detail_sid;";
  $result = mysqli_query($conn,$sql);
  $queryResults = mysqli_num_rows($result);

  $row = mysqli_fetch_assoc($result);

	if(strpos($row['image'],"http")){
		$img_url = $row['image'];
	}
	else{
		$img_url = 'figures/spot_default.jpg';
	}
	//incase of empty string
	$hour = $row['hour'];
	if(!$row['hour']){
		$hour = 'not specified.';
	}

	//query the eixisting tags
	$sql = "SELECT tags.words as words FROM attraction_tag ,tags WHERE $detail_sid = attraction_tag.sid AND attraction_tag.tid = tags.tid;";
	$detail_tag = mysqli_query($conn,$sql);
	$detail_tag_num = mysqli_num_rows($detail_tag);
  ?>
  <h1 style="text-align:left;padding-top:20px;padding-left:200px;"><?php echo $row['name'] ?>

	<?php
	if(isset($_SESSION['u_id'])){
		$u_id = $_SESSION['u_id'];
		echo "
		<button type='button' style='margin-left:20px;' class='btn btn-outline-dark'data-toggle='modal' data-target='#myModal' >Visted</button></h1>
		";
	} else {
		echo "</h1>";
	}?>

  <img src="<?php echo $img_url ?>" alt='spot image' width='350px' height='250px' style='margin-left:200px;margin-bottom: 20px;margin-top:50px;float:left;'>
  <div style='float:left;width:500px;'>
    <p style='padding-left:30px;padding-top: 80px;text-align:left;'><b>Catogory</b>: <?php echo $row['category'] ?> </p>
    <p style='padding-left:30px;text-align:left;'><b>Address</b>:   <?php echo $row['address'] ?></p>
    <p style='padding-left:30px;text-align:left; word-wrap:break-word;'> <b>Open Hour</b>:  <?php echo $row['hour'] ?></p>
    <p style='padding-left:30px;text-align:left;'> <b>Ticket Price</b>:  <?php $row['price'] ?></p>
		<p style='padding-left:30px;text-align:left;'>

		<?php
		//randomly choose the colour
		$tag_class = array("primary", "success","danger","warning","info","dark");
		if($detail_tag_num > 0){
			while( $i = mysqli_fetch_assoc($detail_tag)){
				$random = rand() % count($tag_class);
				?>
				<a href='' class='badge badge-<?php echo $tag_class[$random] ?>' style="margin-top:3px;"><?php echo $i['words'] ?></a>
			<?php }}?>
		</p>
  </div>

  <div class='section' style='clear:both;padding: 50px 200px 50px 200px;'>
    <?php echo $row['review_essential'] ?>
    <br><br>"
		<?php echo $row['review_extension'] ?>
  </div>

<?php
  //updating the browse table
	//tracking user's click action
	if (isset($_SESSION['u_id'])){
		$u_id = $_SESSION['u_id'];
		$sql = "SELECT * from BrowseHistory WHERE UID = $u_id  AND SID=$detail_sid;";
		$result = mysqli_query($conn,$sql);
		$queryResults = mysqli_num_rows($result);

		$row = mysqli_fetch_assoc($result);
		if($queryResults == 0){
			$sql_update = "INSERT INTO BrowseHistory (UID,SID,NumClicks) VALUES ($u_id,$detail_sid,1);";
		}
		else{
			$count = $row['NumClicks'];
			// $sql_update = "UPDATE BrowseHistory
			//   SET NumClicks=((SELECT NumClicks from BrowseHistory WHERE UID = $u_id AND SID=$detail_sid)+1)
			//   WHERE UID = $u_id AND SID=$detail_sid;";

				$sql_update = "UPDATE BrowseHistory
					SET NumClicks= $count+1
					WHERE UID = $u_id AND SID=$detail_sid;";

				// $sql_update = "UPDATE BrowseHistory
				//   SET NumClicks=2
				//   WHERE UID = $u_id AND SID=$detail_sid;";
		}
		mysqli_query($conn,$sql_update);
	}

	//visted marking button(only for logined user)

 ?>

 <!-- to close the modal -->
<script type="text/javascript">
function tag_submit(btn){
	var f = document.getElementById('visited_tag');
	f.submit();
	//after submit, refresh the queried data
	$('#myModal').modal('toggle');
	// document.getElementById('myButton').innerHTML="Visited!";
}
</script>

<style media="screen">
input{
    position: absolute;
    left: -9999px;
}
label {
  display: block;
  position: relative;
  margin: 5px;
	padding: 5px;
  float: left;
  border: 1px solid grey;
	/*use solid key word to have border */
  border-radius: 3px;
	border-color: grey;
	font-size: 13px;
  color: grey;
  background-color: white;
  white-space: nowrap;
  cursor: pointer;
  user-select: none;
}

/* label ::before{
	position: absolute;
	color: grey;
	border-color: grey;
	transition: background-color .2s;
}
label ::after{
	color: #3EC3C1;
	border-color: #3EC3C1;
} */
/*
label:hover, input:focus + label {
  box-shadow: 0 0 5px rgba(0, 0, 0, .4);
} */

input:checked+label {
	color: #3EC3C1;
	border-color: #3EC3C1;
}

</style>

 <!-- The Modal -->
 <div class="modal fade" id="myModal">
   <div class="modal-dialog">
     <div class="modal-content">

       <!-- Modal Header -->
       <div class="modal-header">
         <h4 class="modal-title"> Mark as Visted </h4>
         <button type="button" class="close" data-dismiss="modal">&times;</button>
       </div>

       <!-- Modal body -->
       <div class="modal-body">
         Choose the words that best describe this place:
				 <br><br>
				 <!-- <input  id="input_tag" type="checkbox"  value="test">
				 <label for="input_tag" > click me! </label> -->
				 <form id="visited_tag" action="visited_tag.php" method="post" target="hide">
					 <input type="hidden" name="uid" value="<?php echo $u_id ?>" >
					 <input type="hidden" name="sid" value="<?php echo $detail_sid ?>" >
				 <?php
				 	$tag_sql = "SELECT * FROM tags WHERE tid NOT IN (SELECT tid from attraction_tag WHERE sid=$detail_sid);";
		 			$tag_res = mysqli_query($conn,$tag_sql);
		 			$tag_num = mysqli_num_rows($tag_res);
					if($tag_num>0){
						while($tag_row = mysqli_fetch_assoc($tag_res)):;
						 $tid = $tag_row['tid'];
				  ?>
					<input  id="<?php echo $tid?>" name="tid[]" type="checkbox"  value="<?php echo $tid ?>">
 				  <label for="<?php echo $tid ?>" > <?php echo $tag_row['words'] ?> </label>
					<?php endwhile;}?>

       </div>

       <!-- Modal footer -->
       <div class="modal-footer">
				 <button id="myButton" type="submit" class="btn btn-info" onclick="tag_submit(this)">Submit</button>
         <!-- <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button> -->
			 </form>
			 <iframe id="hide" name="hide" style="display:none;"></iframe>
       </div>

     </div>
   </div>
 </div>


 <?php
 	include "footer.php";
  ?>
