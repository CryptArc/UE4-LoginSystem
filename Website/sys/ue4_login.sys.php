<?php
session_start();

$redirect = 'https://g1k777.com';

if(isset($_REQUEST['logout'])){
	session_destroy();
	header("Location: $redirect");
	exit();
}else if(isset($_REQUEST['username'])){

	$uid = $_REQUEST['username'];
	$pwd = $_REQUEST['password'];
	//Error handlers
	// Check if inputs are empty
	if(empty($uid) || empty($pwd)){
		echo 'Type your login data into the text fields.';
		exit();
	}else {
		include 'dbc.php';
		
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
					echo $uid;
					//$_SESSION['online'] = true;
					exit();
				}
			}
		}
	}
} else {
	exit();
}
