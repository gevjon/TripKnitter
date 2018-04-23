
<!-- customed style for homepage -->
<style media="screen">
@import url(https://fonts.googleapis.com/css?family=Arvo);

/* cool text input is from here: https://tympanus.net/Development/TextInputEffects/; */
.input {
  position: relative;
  z-index: 1;
  display: block;
  max-width: 650px;
  width: calc(100% - 2em);
  vertical-align: top;
  width: 100%;
  margin: auto;
}

.input__field {
  position: relative;
  display: block;
  float: right;
  padding: 0.8em;
  width: 60%;
  border: none;
  border-radius: 0;
  background: #f0f0f0;
  color: #aaa;
  font-weight: 400;
  font-family: "Avenir Next", "Helvetica Neue", Helvetica, Arial, sans-serif;
  -webkit-appearance: none; /* for box shadows to show on iOS */
}

.input__field:focus {
  outline: none;
}

.input__label {
  display: inline-block;
  float: right;
  padding: 0 1em;
  width: 40%;
  /* color: #696969; */
  color: #dddddd;
  font-weight: bold;
  font-size: 70.25%;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  -webkit-touch-callout: none;
  -webkit-user-select: none;
  -khtml-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

.input__label-content {
  position: relative;
  display: block;
  padding: 1.6em 0;
  width: 100%;
}

.graphic {
  position: absolute;
  top: 0;
  left: 0;
  fill: none;
}

.icon {
  color: #ddd;
  font-size: 150%;
}
.input--nao {
  overflow: hidden;
  padding-top: 1em;
}

.input__field--nao {
  padding: 0.5em 0em 0.25em;
  width: 100%;
  background: transparent;
  /* color: #9da8b2; */
  color:white;
  font-size: 1.75em;
}

.input__label--nao {
  position: absolute;
  top: 0;
  font-size: 1.5em;
  left: 0;
  display: block;
  width: 100%;
  text-align: left;
  padding: 0em;
  pointer-events: none;
  -webkit-transform-origin: 0 0;
  transform-origin: 0 0;
  -webkit-transition: -webkit-transform 0.2s 0.15s, color 1s;
  transition: transform 0.2s 0.15s, color 1s;
  -webkit-transition-timing-function: ease-out;
  transition-timing-function: ease-out;
}

.graphic--nao {
  stroke: white;
  pointer-events: none;
  -webkit-transition: -webkit-transform 0.7s, stroke 0.7s;
  transition: transform 0.7s, stroke 0.7s;
  -webkit-transition-timing-function: cubic-bezier(0, 0.25, 0.5, 1);
  transition-timing-function: cubic-bezier(0, 0.25, 0.5, 1);
}

.input__field--nao:focus + .input__label--nao,
.input--filled .input__label--nao {
  /* color: #333; */
  color: #dddddd;
  -webkit-transform: translate3d(0, -1.25em, 0) scale3d(0.75, 0.75, 1);
  transform: translate3d(0, -1.25em, 0) scale3d(0.75, 0.75, 1);
}

.input__field--nao:focus ~ .graphic--nao,
.input--filled .graphic--nao {
  stroke: #dddddd;
  -webkit-transform: translate3d(-66.6%, 0, 0);
  transform: translate3d(-66.6%, 0, 0);
}
</style>

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
    if (isset($_GET['sign-in'])){
        echo "<script>alert('Please sign in first!');</script>";
    }



 ?>

        <!-- <section class="main-container">
        	<div class="main-wrapper">

        	</div>
        </section> -->

            <div id="background" style="position:absolute;z-index:-1;width:100%;height:100%;left:0px;margin-top:-50px;">
                <img src="figures/background3.jpg" width="100%" height="100%">
            </div>


            <div class="container">

                <!-- <form name="search-homepage"  action="" method="POST">
                    <div class="input-group input-group-lg" >
                        <input type="text" class="form-control" placeholder="Search for Attractions" name="search-homepage">
                        <span class="input-group-btn">
                        <button type="submit" class="btn btn-lg" name="submit" onclick="return_url();">Search</button>
                        </span>
                    </div>
                </form> -->

              <form name="search2" id="search_keyword" class="" action="" method="POST">
                <span class="input input--nao">
                  <input class="input__field input__field--nao" type="text" id="query" name="search_keyword">
                  <label class="input__label input__label--nao" for="query">
                    <span class="input__label-content input__label-content--nao">Search</span>
                  </label>
                  <svg class="graphic graphic--nao" width="300%" height="100%" viewBox="0 0 1200 60" preserveAspectRatio="none">
                    <path d="M0,56.5c0,0,298.666,0,399.333,0C448.336,56.5,513.994,46,597,46c77.327,0,135,10.5,200.999,10.5c95.996,0,402.001,0,402.001,0"/>
                  </svg>
                </span>
              </form>

            </div>

						<div class="section" id="function" style="margin-top:16%;padding:80px;">
							<a id="icon1" href="spots_map.php" style="padding-left:20%;text-decoration:none;max-width:30%;">
							<img src="figures/spots.png" alt="Spots Map" width="150px" height="150px" style="opacity:0.8"/>
							</a>

              <a id="icon2" href="trip_design.php" style="padding-left:10%;text-decoration:none;">
              <img src="figures/plan.png"  alt="Design Your Trip" width="150px" height="150px" style="opacity:0.8"/>
              </a>

							<a id="icon3" href="spots_recom.php" style="padding-left:10%;text-decoration:none;">
							<img src="figures/recom.png"  alt="Recommendation" width="150px" height="150px" style="opacity:0.8"/>
							</a>

							<br><br>
							<span class="h3" style="padding-left:21%;">Spots Map</span>
							<span class="h3" style="padding-left:9%;">Design Your Trip</span>
              <span class="h3" style="padding-left:8%;">Spots Board</span>
						</div>

            <!-- control the distance of functional circles ??????-->
            <script >
            var prev = $("#background");
            var div = $("#function");
            var space = jQuery(window).width() - (div.offset().top + div.outerHeight());
              div.css("margin-top",space);
            </script>

<script type="text/javascript">
$(document).ready(function() {
// set focus on search box
$('#query').focus();

// call search_wikipedia() on either button click or user hitting 'enter'
$('#search-btn').on('click', return_url);

$(document).keypress(function(e) {
  if(e.which === 13)
    return_url();
  });
});

function return_url() {
  //keyword
  //var query_term = $('#query').val();
  //document.getElementById('query').setAttribute('value')=query_term;
  //verify user logged in or not
  var a = window.location.search;
  var start = a.search("username")+9;
  var b = a.substr(start,);
  var f1 = document.search2;
  if (!b){
      f1.action = "search.php";
      f1.submit();
  }else{
      f1.action = "search.php?username="+b;
      f1.submit();
    }
  }



function user_not_exist(){
    alert("This account does not exsit! \n (hint: You should enter your email not user name)");
}
function wrong_pwd(){
    alert("Incorrect Password!");
}
</script>

<?php include "footer.php";
 ?>
