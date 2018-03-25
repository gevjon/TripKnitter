<?php
    if (isset($_POST['submit'])){
        include_once '../includes/db.inc.php';

        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);
        $pwd_repeat = mysqli_real_escape_string($conn, $_POST['pwd-repeat']);
        $username = mysqli_real_escape_string($conn, $_POST['username']);

        //Error handler
        //Check for empty fields
        if (empty($email) || empty($pwd) || empty($username) || empty($pwd_repeat)){
            header("Location: ../signup.php?signup=empty&email=$email&username=$username"); //问号后面的是内容是错误信息，以便你之后使用CSS对出错后的页面做一些格式处理
            exit();
        } else{
            //Check if input characters are valid
            if (!preg_match("/^[A-Za-z0-9]*$/", $username)){
                header("Location: ../signup.php?signup=invalid&email=$email");
                exit();
            } else{
                //Check if email is vali
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
                    header("Location: ../signup.php?signup=email&username=$username");
                    exit();
                } else{
                    //Check whether the username and email has been taken
                    $sql = "SELECT * FROM user WHERE username = '$username';";
                    $result = mysqli_query($conn, $sql);
                    $resultCheck = mysqli_num_rows($result);

                    if ($resultCheck > 0){
                        header("Location: ../signup.php?signup=usertaken&email=$email");
                        exit();
                    } else{
                        //Check if the length of the password is the same as the second input
                        if ($pwd != $pwd_repeat){
                            header("Location: ../signup.php?signup=pwd&email=$email&username=$username");
                            exit();
                        } else{
                            //Hash the password
                            $hashedPwd = password_hash($pwd,PASSWORD_DEFAULT);
                            //Insert the user into database
                            $sql = "INSERT INTO user(email,username,password) VALUES ('$email', '$username', '$hashedPwd');";
                            mysqli_query($conn, $sql);
                            header("Location: ../signup.php?signup=success");
                            exit();
                        }
                        
                    }
                }
            }
        }
    } else{
        header("Location: ../homepage/signup.html");
        exit();
    }
?>