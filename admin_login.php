<!DOCTYPE html>
<html>
<head>
	<title>admin login</title>
	<link rel=stylesheet href="css/admin_login.css"> 
	<link rel="shortcut icon" type="image/x-icon" href="icon.jpg"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<div id=mar1><marquee direction=right behavior=loop scrollamount=20>N E N G ' S&nbsp&nbsp&nbsp M E A T&nbsp&nbsp&nbsp A N D&nbsp&nbsp&nbsp F I S H</marquee></div>

	<div class="cont">
		 <form action="login2.php" method="post">
			<h1>ADMIN LOGIN</h1>
			<br>
			<?php if (isset($_GET['error'])) { ?>
				<p class="error"><?php echo $_GET['error']; ?></p>
			<?php } ?>
			
			<label class="lbluser">Username</label>
			<input type="text" name="uname" placeholder="Username" class="txtuser"><br>

			<label class="lblpass">Password</label>
			<input type="password" name="password" placeholder="Password" class="txtpass"><br>

			<button type="submit" class="sub">Login</button>
		 </form>
	</div>
</body>
</html>