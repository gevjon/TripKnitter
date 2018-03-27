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
  <h1 style='text-align:center;'>".$row['name']."
    <button type='submit' name='favorite' style='margin-left: 10px;margin-right:10px;background-color:white;font-size:20px;padding:5px;'>Favorite</button>
  </h1>
  <img src='figures/spot_default.jpg' alt='spot image' width='350px' height='250px' style='margin-left:50px;margin-bottom: 50px;float:left;'>
  <div style='float:left;'>
    <p style='padding-left:30px;padding-top: 40px;text-align:left;'>Catogory: " .$row['category']."</p>
    <p style='padding-left:30px;text-align:left;'>Address: " .$row['address']."</p>
    <p style='padding-left:30px;text-align:left;'> Open Hour: " .$row['hour']."</p>
    <p style='padding-left:30px;text-align:left;'> Ticket Price: ".$row['price']."</p>
  </div>

  <div class='section' style='clear:both;padding: 50px 200px 50px 200px;'>"
    .$row['review_essential']."
    <br><br>"
    .$row['review_extension']."
  </div>
  ";



 ?>




 <?php
 	include "footer.php";
  ?>
