<?php
	include "header.php";
 ?>

        <section class="main-container">
        	<div class="main-wrapper">

        	</div>
        </section>
            <div id="background" style="position:absolute;z-index:-1;width:100%;height:100%;left:0px;">
                <img src="figures/1.1.png" width="100%" height="100%">
            </div>


            <div class="container">
                <form id="search-homepage" action="" target="_blank">
                    <div class="input-group input-group-lg" >
                        <input type="text" class="form-control" placeholder="Search for Attractions" name="search-homepage">
                        <span class="input-group-btn">
                        <button type="submit" class="btn btn-lg" value="submit">
                        Search</button>
                        </span>
                    </div>
                </form>
            </div>

						<div class="section" style="margin-top:20%;padding:80px;">
							<a href="index.php" style="padding-left:23%;text-decoration:none;">
							<img src="figures/spots.png" alt="List of Spots" width="150px" height="150px" style="opacity:0.8"/>
							</a>

							<a href="index.php" style="padding-left:200px;text-decoration:none;">
							<img src="figures/plan.png"  alt="Desgin Your Trip" width="150px" height="150px" style="opacity:0.8"/>
							</a>

							<br><br>
							<span class="h3" style="padding-left:23%;">List of Spots</span>
							<span class="h3" style="padding-left:180px;">Desgin Your Trip</span>
						</div>

<?php include "footer.php";
 ?>
