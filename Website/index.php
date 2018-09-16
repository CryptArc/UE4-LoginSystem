<!DOCTYPE html>
<?php session_start(); ?>
<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
		<title>LoginSystem for UE4</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
	</head>
	<body>
		
		<header>
			<!-- Reserved for ads in the future or something more useful, maybe for pornhub ads. -->
		</header>
		
		<nav>
			<a href="#home">Home</a>
			<div>
				<a>Categories</a>
				<ul>
					<li><a href="#">Link1</a></li>
					<li><a href="#">Link2</a></li>
					<li><a href="#">Link3</a></li>
				</ul>
			</div>
		</nav>
		
		<main>
			<!-- Leave this empty -->
		</main>
		
		<form action="sys/login.sys.php" method="POST" id="login">
			<?php
				if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) {
					echo '<a href="#profile">Profile</a><input type="submit" name="logout" value="Logout">';
					}else{
					echo '<input type="text" name="uid" placeholder="Login name"><input type="password" name="pwd" placeholder="Password"><input type="submit" name="submitLogin" value="Login"><a href="#signup">Sign up</a>';
				}
			?>
		</form>
		
		<footer><span>&copy; Copyrights 2018</span></footer>
		
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script type="text/javascript" src="js/script.js"></script>
	</body>
</html>