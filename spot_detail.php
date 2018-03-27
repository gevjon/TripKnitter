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
  echo
  "
  <h1 style='text-align:center;padding-top:20px;'>".$row['name']."
    <button type='submit' name='favorite' style='margin-left: 10px;margin-right:10px;background-color:white;font-size:20px;padding:5px;'>Favorite</button>
  </h1>
  <img src='".$row['image']."' alt='spot image' width='350px' height='250px' style='margin-left:200px;margin-bottom: 20px;margin-top:50px;float:left;'>
  <div style='float:left;'>
    <p style='padding-left:30px;padding-top: 90px;text-align:left;'><b>Catogory</b>: " .$row['category']."</p>
    <p style='padding-left:30px;text-align:left;'><b>Address</b>:  " .$row['address']."</p>
    <p style='padding-left:30px;text-align:left;'> <b>Open Hour</b>: " .$row['hour']."</p>
    <p style='padding-left:30px;text-align:left;'> <b>Ticket Price</b>:  ".$row['price']."</p>
  </div>

  <div class='section' style='clear:both;padding: 50px 200px 50px 200px;'>"
    .$row['review_essential']."
    <br><br>"
    .$row['review_extension']."
  </div>
  ";

  //updating the browse table
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



 ?>




 <?php
 	include "footer.php";
  ?>
