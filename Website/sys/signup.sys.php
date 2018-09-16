<?php
$redirect = 'https://g1k777.com';
$ip = $_SERVER['REMOTE_ADDR'];
if(!isset($_POST['submit']) && empty($_SESSION['loggedIn'])){
	echo '(͠≖ ͜ʖ͠≖) '.$ip;
	exit();
}else{
	include_once 'dbc.php';

	$firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
	$lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$uid = mysqli_real_escape_string($conn, $_POST['uid']);
	$pwd = mysqli_real_escape_string($conn, $_POST['pwd']);
	$type = 'user';
	
	//Check for banned words and names
	$uidcheck = strtolower($uid);
	$bannedWords =[
		'admin','bitch','hoe','fuck','hitler','nigga','nigger','nazi','motherfucker'
	];
	$bannedNames = [
	];
	$var1 = ['/a/','/c/','/e/','/g/','/i/','/j/','/k/','/l/','/o/','/r/','/s/','/t/','/u/','/v/','/w/','/z/'];
	$var2 = ['(a|4)','(c|k)','(e|3)','(g|6|9)','(i|l|1)','(j|i)','(c|k)','(l|1|i)','(o|0)','(r|2)','(s|5)','(t|7)','(u|v)','(v|u)','(w|vv|v)','(z|2)'];
	foreach($bannedWords as $a){
		array_push($bannedNames,preg_replace($var1,$var2,$a));
		
	}
	//Error handlers
	//Check for empty fields
	if(empty($uid) || empty($pwd)){
		echo "user or password is empty";
		exit();
	} else {
		//Check if input characters are valid
		if(preg_match('(' . implode('|', $bannedNames) . ')', $uidcheck) || !preg_match('/[a-zA-Z0-9]+/i', $uid)){
			echo "Username is invalid";
			exit();
		} else {
			$sql = "SELECT * FROM users WHERE username='$uid'";
			$result = mysqli_query($conn, $sql);
			$resultCheck = mysqli_num_rows($result);

			if($resultCheck > 0){
				echo "Username is taken";
				exit();
			} else {
				//Hashing;
				$hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
				$getdate = getdate();
				$date = $getdate['year'] . '-' . $getdate['mon'] . '-' . $getdate['mday'];
				//Get IP
				$ipv4 = '';
				$ipv6 = '';
				if($ip > 14){
					$ipv6 = $ip;
				}else{
					$ipv4 = $ip;
				}
				
				//Insert the user into the database
				$sql = "INSERT INTO users (username,password,type,email,ipv4,ipv6,reg_date,firstname,lastname) VALUES ('$uid','$hashedPwd','$type','$email','$ipv4','$ipv6','$date','$firstname','$lastname');";
				mysqli_query($conn, $sql);
				header("Location: $redirect/#signup_success");
				exit();
			}
		}
	}
}