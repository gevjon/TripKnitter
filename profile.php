<?php
	include "header.php";
 ?>

<div id="user_pic">
	<img src="figures/user_stamp/user1.jpeg" alt="user_pic" height="200px" width="200px">
</div>

<div class="section" id="username">
	username
</div>

<script>
function getUserName(){  
        var username = document.getElementById("search_site").value;
        var str = localStorage.getItem(search_site);
        var find_result = document.getElementById("find_result");
        var site = JSON.parse(str);
        find_result.innerHTML = search_site + "的网站名是：" + site.sitename + "，网址是：" + site.siteurl;
    }
</script>


 <?php include "footer.php";
  ?>
