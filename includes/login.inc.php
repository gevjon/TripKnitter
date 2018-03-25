<?php 

session_start(); //记得在header.php的最开始也加上


if (isset($_POST['submit'])){

	include_once '../includes/db.inc.php';

	$uid = mysqli_real_escape_string($conn, $_POST['uid']);
	$pwd = mysqli_real_escape_string($conn, $_POST['pwd']);

	//Error Handlers
	//Check if inputs are empty
	if (empty($uid) || empty($pwd)){
		header("Location: ../index.php?login=empty");
		exit();
	} else{
		$sql = "SELECT * FROM user WHERE email = '$uid';";
		$result = mysqli_query($conn, $sql);
		$resultCheck = mysqli_num_rows($result);

		if ($resultCheck < 1){
			header("Location: ../index.php?login=nothisuser");
			exit();
		} else{
			if ($row = mysqli_fetch_assoc($result)){
				//Dehashing the pwd
				$hashedPwdCheck = password_verify($pwd,$row['password']);
				if ($hashedPwdCheck == false){
					header("Location: ../index.php?login=wrong_pwd");
					exit();
				}elseif($hashedPwdCheck == true){   //为什么不直接同else？因为可以避免$hashedPwdCheck没有返回一些奇奇怪怪的值
					//Log in the user
					$_SESSION['u_id'] = $row['UID'];
					$_SESSION['u_email'] = $row['email'];
					$_SESSION['u_name'] = $row['username'];
					header('Location: ../index.php?login=success&username='.$row["username"].'');
					exit();
					}
				}
			}
		}
	} else{
		header("Location: ../index.php?login=error");
		exit();
	}

 ?>
