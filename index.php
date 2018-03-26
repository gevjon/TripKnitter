
<script type="text/javascript">
    function user_not_exist(){
        alert("This account does not exsit! \n (hint: You should enter your email not user name)");
    }
    function wrong_pwd(){
        alert("Incorrect Password!");
    }
    function return_url(){
        var a = window.location.search;
        var start = a.search("username")+9;
        var b = a.substr(start,);       
        var f1 = document.search;
        if (!b){
            f1.action = "search.php";
            f1.submit();
        }else{
            f1.action = "search.php?username="+b
        }
       

    }


</script>

<?php
	include "header.php";
    if (isset($_GET['login'])){
        if ($_GET['login'] == "nothisuser"){
            echo '<script>user_not_exist()</script>';
        }
        elseif ($_GET['login'] == "wrong_pwd"){
            echo '<script>wrong_pwd()</script>';
        }
    }
    


 ?>

        <!-- <section class="main-container">
        	<div class="main-wrapper">

        	</div>
        </section> -->

            <div id="background" style="position:absolute;z-index:-1;width:100%;height:100%;left:0px;margin-top:-50px;">
                <img src="figures/1.1.png" width="100%" height="100%">
            </div>


            <div class="container">
<<<<<<< HEAD
                <form id="search-homepage" action="" target="_blank">
=======
                <form name="search" id="search-homepage" action="" method="POST">
>>>>>>> 8adaab1544d8fcb0a2663be3d408d93aacee105e
                    <div class="input-group input-group-lg" >
                        <input type="text" class="form-control" placeholder="Search for Attractions" name="search-homepage">
                        <span class="input-group-btn">
                        <button type="submit" class="btn btn-lg" name="submit" onclick="return_url();">Search</button>
                        </span>
                    </div>
                </form>
            </div>

						<div class="section" style="margin-top:20%;padding:80px;">
							<a href="spots_list.php" style="padding-left:23%;text-decoration:none;">
							<img src="figures/spots.png" alt="List of Spots" width="150px" height="150px" style="opacity:0.8"/>
							</a>

							<a href="trip_design.php" style="padding-left:200px;text-decoration:none;">
							<img src="figures/plan.png"  alt="Desgin Your Trip" width="150px" height="150px" style="opacity:0.8"/>
							</a>

							<br><br>
							<span class="h3" style="padding-left:23%;">List of Spots</span>
							<span class="h3" style="padding-left:180px;">Desgin Your Trip</span>
						</div>

<?php include "footer.php";
 ?>
