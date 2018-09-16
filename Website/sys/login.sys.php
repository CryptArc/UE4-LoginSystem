<?php
$redirect = 'https://g1k777.com';
session_start();
if(isset($_POST['logout'])){
	session_destroy();
	header("Location: $redirect");
	exit();
}else if(isset($_POST['submitLogin']) && !isset($_SESSION['loggedIn'])){
	include 'dbc.php';

	$uid = mysqli_real_escape_string($conn, $_POST['uid']);
	$pwd = mysqli_real_escape_string($conn, $_POST['pwd']);

	//Error handlers
	// Check if inputs are empty
	if(empty($uid) || empty($pwd)){
		echo 'Type your login data into the text fields.';
		exit();
	} else {
		
		$sql = "SELECT * FROM users WHERE username='$uid'";
		$result = mysqli_query($conn, $sql);
		$resultCheck = mysqli_num_rows($result);
		if($resultCheck < 1){
			echo 'Username doesn\'t exist.';
			exit();
		} else {
			if($row = mysqli_fetch_assoc($result)){
				//De-hashing the password
				$hashedPwdCheck = password_verify($pwd, $row['password']);
				if($hashedPwdCheck == false){
					echo 'Wrong password.';
					exit();
				}elseif ($hashedPwdCheck == true){
					//Log in the user here
					$_SESSION['loggedIn'] = true;
					$_SESSION['username'] = $uid;
					$_SESSION['avatar'] = $row['avatar'];
					header("Location: $redirect/#profile");
					exit();
				}
			}
		}
	}
} else {
	echo 'How to login? Type your Username, Password and click on the login button or press enter :)';
	exit();
}
