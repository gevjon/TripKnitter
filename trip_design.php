<?php
	include "header.php";
	include "includes/db.inc.php"
 ?>

 <div id="background2" style="position:absolute;z-index:-1;width:100%;height:100%;left:0px;margin-top:-250px;margin-bottom:-50px;">
		 <img src="figures/background2.jpg" width="100%" height="100%">
 </div>

<form  action="plans.php" method="post" style="padding:100px;padding-top:500px;">
	Target City:
	<select class="" name="city" style="width:100px;margin-right:5%;">
		<option value=0>--choose a city to visit--</option>
	</select>
	Trip Duration:
	<select class="" name="duration" style="width:100px;margin-right:5%;">
		<option value="1"> 1 day </option>
		<option value="2"> 2 day </option>
		<option value="3"> 3 day </option>
	</select>

	Budget:
	<select class="" name="budget" style="width:100px;margin-right:5%;">
		<option value="low"> low </option>
		<option value="median"> median </option>
		<option value="high"> high </option>
	</select>

	Num of Sites/Day:
	<select class="" name="num_sites" style="width:100px;margin-right:5%;">
		<option value="1"> 1 </option>
		<option value="2"> 2 </option>
		<option value="3"> 3 </option>
		<option value="more"> more than 3 </option>
	</select>

	<input type="submit" value="Plan My Trip" style="border-radius: 12px;font-size: 20px;color:white;width: 300px;margin-left: 35%;margin-top: 50px;padding: 5px;background-color:#3EC3C1;border:none;">

</form>


<?php
$sql= "SELECT distinct city from attraction";//sql语句
$result = mysql_query($sql, $conn);//执行sql语句
while($row = mysql_fetch_array($result))
	{
		;//循环，拼凑下拉框选项
	}
?>
<script type="text/javascript">
		var unitObj=document.getElementByName("city"); //页面上的<html:select>元素
		if(userList!=null){ //后台传回来的select选项
				for(var i=0;i<userList.length;i++){
						//遍历后台传回的结果，一项项往select中添加option
						unitObj.options.add(new Option(userList[i].name,userList[i].name));
				}
		}
</script>



 <?php include "footer.php";
  ?>
