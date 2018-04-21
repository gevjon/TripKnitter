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
  echo
  "
  <h1 style='text-align:center;padding-top:20px;'>".$row['name']."
	<button type='button' class='btn btn-outline-dark'data-toggle='modal' data-target='#myModal' >Visted</button> </h1>

  <img src='".$img_url."' alt='spot image' width='350px' height='250px' style='margin-left:200px;margin-bottom: 20px;margin-top:50px;float:left;'>
  <div style='float:left;'>
    <p style='padding-left:30px;padding-top: 90px;text-align:left;'><b>Catogory</b>: " .$row['category']."</p>
    <p style='padding-left:30px;text-align:left;'><b>Address</b>:  " .$row['address']."</p>
    <p style='padding-left:30px;text-align:left;'> <b>Open Hour</b>: " .$hour."</p>
    <p style='padding-left:30px;text-align:left;'> <b>Ticket Price</b>:  ".$row['price']."</p>
  </div>


  <div class='section' style='clear:both;padding: 50px 200px 50px 200px;'>"
    .$row['review_essential']."
    <br><br>"
    .$row['review_extension']."
  </div>
  ";

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
				 <br>
				 <!-- <input  id="input_tag" type="checkbox"  value="test">
				 <label for="input_tag" > click me! </label> -->
				 <?php
				 	$tag_sql = "SELECT * FROM tags;";
		 			$tag_res = mysqli_query($conn,$tag_sql);
		 			$tag_num = mysqli_num_rows($tag_res);
					while($tag_row = mysqli_fetch_assoc($tag_res)):;
					 $tid = $tag_row['tid'];
				  ?>
					<input  id="<?php echo $tid?>" type="checkbox"  value="">
 				  <label for="<?php echo $tid ?>" > <?php echo $tag_row['words'] ?> </label>
					<?php
					endwhile;?>

       </div>

       <!-- Modal footer -->
       <div class="modal-footer">
				 <button type="button" class="btn btn-info">Submit</button>
         <!-- <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button> -->
       </div>

     </div>
   </div>
 </div>


 <?php
 	include "footer.php";
  ?>
