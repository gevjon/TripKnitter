<?php

session_start();

 ?>
<!ODCTYPE html>
<html>
    <head>
        <title>TripKnitter</title>

    <link  rel="stylesheet" type="text/css" href="style.css" charset="utf-8">
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!-- <script type="text/javascript" src="user_profile.js"></script> -->

    </head>


        <body>
          <script src="http://cdn.jsdelivr.net/mojs/latest/mo.min.js"></script>
            <header>
                <nav>
                <div class="main-warpper">
                    <ul>
                      <br>
                        <li><a href="index.php" > TripKnitter</a></li>
                    </ul>
                    <div class="nav-login">

                        <?php
                            if (isset($_SESSION['u_id'])){
                                echo '<form action="../homepage/includes/logout.inc.php" method="POST">
                                <a href="profile.php?username='.$_SESSION["u_name"].'">'.$_SESSION["u_name"].'</a>
                                <button type="submit" name="submit">Logout</button>

                        </form>';
                            } else{
                                echo '<form action="../homepage/includes/login.inc.php" method="POST">
                                    <input type="text" name="uid" placeholder="Email">
                                     <input type="password" name="pwd" placeholder="Password">
                                    <button type="submit" name="submit">Login </button>
                                    <button type="button" name="submit" onclick="javascript:window.location.href=\'/homepage/signup.php\'">Sign up</button>
                                </form>';
                            }
                        ?>


                    </div>
                </div>
            </nav>
            </header>
