<?php

session_start();

 ?>

<!ODCTYPE html>
<html>
    <head>
        <title></title>

        <link  rel="stylesheet" type="text/css" href="signup.css">
        <script type="text/javascript">
        	function return_to_homepage(){
        		window.location.href = "index.php";
        	}
        	function go_to_profile(){
        		window.location.href = "profile.php";
        	}
        </script>


    </head>



            <header>
                <nav>
                <div class="main-warpper">
                    <ul>
                        <li><a href="index.php"> TripKnitter</a></li>
                    </ul>
                    <div class="nav-login">

                        <?php
                            if (isset($_SESSION['u_id'])){
                                echo '<form action="../homepage/includes/logout.inc.php" method="POST">
                                	<button type="button" onclick="go_to_profile">aaasss</button>

                        			</form>';
                            } else{
                                echo '<form action="../homepage/includes/login.inc.php" method="POST">
                        <input type="text" name="uid" placeholder="Email">
                        <input type="password" name="pwd" placeholder="Password">
                        <button type="submit" name="submit">Login </button>
                        <button type="button" onclick="javascript:window.location.href=\'/homepage/signup.php\'">Sign up</button>
                    </form>';
                            }
                        ?>
                    </div>
                </div>
            </nav>
            </header>


<body>
	<br>
	<form action="../homepage/includes/signup.inc.php" method="POST" >
		<div class="signup_form">
			<h1 align="center" style="font-size:30px;padding:20px;">Sign up</h1>
			<!-- <p><center>Fill in the form below and make your travel plan right now!</center></p> -->
			<hr>

			<?php
				if (isset($_GET['signup'])){
					$errormessage = $_GET["signup"];
					if ($errormessage == "empty"){
						$email = $_GET["email"];
						$username = $_GET['username'];
						if ($username == '' and $email != ''){
							echo '<label for="email"><b>Email</b></label>
							<br>
							<input type="text" name="email" value='.$email.'>
							<br>
							<label for="username"><b>Username</b></label>
							<br>
							<input type="text" name="username" class="error_input" placeholder="Enter Unique Username">
							<br>
							<label for="pwd"><b>Password</b></label>
							<br>
							<input type="Password" name="pwd" placeholder="Enter Password">
							<br>
							<label for="pwd-repeat"><b>Repeat Password</b></label>
							<br>
							<input type="Password" name="pwd-repeat" placeholder="Enter your Password again">
							<div class="clearfix">
								<button type="button" class="cancelbtn">Cancel</button>
								<button type="submit" class="signupbtn" name="submit">Sign up</button>
							</div>';
						}
						elseif ($email == '' and $username != ''){
							echo '<label for="email"><b>Email</b></label>
							<br>
							<input type="text" name="email" class="error_input" placeholder="Enter Email Address">
							<br>
							<label for="username"><b>Username</b></label>
							<br>
							<input type="text" name="username" value='.$username.'>
							<br>
							<label for="pwd"><b>Password</b></label>
							<br>
							<input type="Password" name="pwd" placeholder="Enter Password">
							<br>
							<label for="pwd-repeat"><b>Repeat Password</b></label>
							<br>
							<input type="Password" name="pwd-repeat" placeholder="Enter your Password again">
							<div class="clearfix">
								<button type="button" class="cancelbtn">Cancel</button>
								<button type="submit" class="signupbtn" name="submit">Sign up</button>
							</div>';
						}
						elseif ($email == '' and $username == ''){
							echo '<label for="email"><b>Email</b></label>
							<br>
							<input type="text" name="email" class="error_input" placeholder="Enter Email Address">
							<br>
							<label for="username"><b>Username</b></label>
							<br>
							<input type="text" name="username" class="error_input" placeholder="Enter Unique Username">
							<br>
							<label for="pwd"><b>Password</b></label>
							<br>
							<input type="Password" name="pwd" placeholder="Enter Password">
							<br>
							<label for="pwd-repeat"><b>Repeat Password</b></label>
							<br>
							<input type="Password" name="pwd-repeat" placeholder="Enter your Password again">
							<div class="clearfix">
								<button type="button" class="cancelbtn">Cancel</button>
								<button type="submit" class="signupbtn" name="submit">Sign up</button>
							</div>';
						}
						else {

							echo '<label for="email"><b>Email</b></label>
							<br>
							<input type="text" name="email" value='.$email.'l>
							<br>
							<label for="username"><b>Username</b></label>
							<br>
							<input type="text" name="username" value='.$username.'>
							<br>
							<label for="pwd"><b>Password</b></label>
							<br>
							<input type="Password" name="pwd" class="error_input" placeholder="Enter Password">
							<br>
							<label for="pwd-repeat"><b>Repeat Password</b></label>
							<br>
							<input type="Password" name="pwd-repeat" class="error_input" placeholder="Enter your Password again">
							<div class="clearfix">
								<button type="button" class="cancelbtn">Cancel</button>
								<button type="submit" class="signupbtn" name="submit">Sign up</button>
							</div>';
						}
					}
					elseif ($errormessage == "invalid"){
						$email = $_GET['email'];
						echo '<label for="email"><b>Email</b></label>
							<br>
							<input type="text" name="email" value='.$email.'>
							<br>
							<label for="username"><b>Username   <font size="2" color="red">*Your Username is invalid</font></b></label>
							<br>
							<input type="text" name="username" class="error_input" placeholder="Enter Unique Username">
							<br>
							<label for="pwd"><b>Password</b></label>
							<br>
							<input type="Password" name="pwd" placeholder="Enter Password">
							<br>
							<label for="pwd-repeat"><b>Repeat Password</b></label>
							<br>
							<input type="Password" name="pwd-repeat" placeholder="Enter your Password again">
							<div class="clearfix">
								<button type="button" class="cancelbtn">Cancel</button>
								<button type="submit" class="signupbtn" name="submit">Sign up</button>
							</div>';
					}
					elseif ($errormessage == "email"){
						$username =$_GET['username'];
						echo '<label for="email"><b>Email   <font size="2" color="red">*Your Email address is invalid</font></b></label>
							<br>
							<input type="text" name="email" class="error_input" placeholder="Enter Email Address">
							<br>
							<label for="username"><b>Username</b></label>
							<br>
							<input type="text" name="username" value='.$username.'>
							<br>
							<label for="pwd"><b>Password</b></label>
							<br>
							<input type="Password" name="pwd" placeholder="Enter Password">
							<br>
							<label for="pwd-repeat"><b>Repeat Password</b></label>
							<br>
							<input type="Password" name="pwd-repeat" placeholder="Enter your Password again">
							<div class="clearfix">
								<button type="button" class="cancelbtn">Cancel</button>
								<button type="submit" class="signupbtn" name="submit">Sign up</button>
							</div>';
					}
					elseif ($errormessage == "usertaken"){
						$email = $_GET['email'];
						echo '<label for="email"><b>Email</font></b></label>
							<br>
							<input type="text" name="email" value='.$email.'>
							<br>
							<label for="username"><b>Username  <font size="2" color="red">*Your username has been taken</font></b></label>
							<br>
							<input type="text" name="username" class="error_input" placeholder="Enter Unique Username">
							<br>
							<label for="pwd"><b>Password</b></label>
							<br>
							<input type="Password" name="pwd" placeholder="Enter Password">
							<br>
							<label for="pwd-repeat"><b>Repeat Password</b></label>
							<br>
							<input type="Password" name="pwd-repeat" placeholder="Enter your Password again">
							<div class="clearfix">
								<button type="button" class="cancelbtn">Cancel</button>
								<button type="submit" class="signupbtn" name="submit">Sign up</button>
							</div>';
					}
					elseif ($errormessage == "pwd"){
						$email = $_GET['email'];
						$username = $_GET['username'];
						echo '<label for="email"><b>Email</b></label>
							<br>
							<input type="text" name="email" value='.$email.'>
							<br>
							<label for="username"><b>Username</b></label>
							<br>
							<input type="text" name="username" value='.$username.'>
							<br>
							<label for="pwd"><b>Password</b></label>
							<br>
							<input type="Password" name="pwd" placeholder="Enter Password">
							<br>
							<label for="pwd-repeat"><b>Repeat Password  <font size="2" color="red">*Inconsistent password</font></b></label>
							<br>
							<input type="Password" name="pwd-repeat" class="error_input placeholder="Enter your Password again">
							<div class="clearfix">
								<button type="button" class="cancelbtn">Cancel</button>
								<button type="submit" class="signupbtn" name="submit">Sign up</button>
							</div>';
					}
					else{
						// $_SESSION['u_email'] = $email;
						// $_SESSION['u_name'] = $username;
						echo '<p class="signup_success"><b>Congratulations! You have successfully registered.</b></p>
							<button type="button" style="margin-top:50px;" class="return_button" onclick="return_to_homepage()">Return</button>';
					}

				}
			else{
				echo '<label for="email"><b>Email</b></label>
				<br>
				<input type="text" name="email" placeholder="Enter Email Address">
				<br>
				<label for="username"><b>Username</b></label>
				<br>
				<input type="text" name="username" placeholder="Enter Unique Username">
				<br>
				<label for="pwd"><b>Password</b></label>
				<br>
				<input type="Password" name="pwd" placeholder="Enter Password">
				<br>
				<label for="pwd-repeat"><b>Repeat Password</b></label>
				<br>
				<input type="Password" name="pwd-repeat" placeholder="Enter your Password again">
				<div class="clearfix">
					<button type="button" class="cancelbtn">Cancel</button>
					<button type="submit" class="signupbtn" name="submit">Sign up</button>
				</div>';
			}

			 ?>


		</div>
<!--
		<div class="clearfix">
			<button type="button" class="cancelbtn">Cancel</button>
			<button type="submit" class="signupbtn" name="submit">Sign up</button>
		</div>
	-->

	</form>

<?php
include "footer.php"

 ?>
