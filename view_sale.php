<?php 
session_start();


if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {

?>
 

<!DOCTYPE html>
<html>
<head>
    <title>Sales Report</title>
	<?php include "includes/links.inc.php"; ?>
	<link rel="stylesheet" href="css/view_sale.css">
</head>
<body>
	<!-- navigation bar -->
	<?php include "includes/navbars.inc.php";?>


	<!-- content -->
	<div class="main-cont">
		<div class="content">
			<a href="fb.com"><div class="box1">Monthly Sales</div></a>
			<a href="fb.com"><div class="box2">Weekly Sales</div></a>
			<a href="fb.com"><div class="box3">Daily Sales</div></a>
		</div>
		<div class="content">
			<a href="fb.com"><div class="box4">Ordering Monthly Sales</div></a>
			<a href="fb.com"><div class="box5">Ordering Weekly Sales</div></a>
			<a href="fb.com"><div class="box6">Ordering Daily Sales</div></a>
		</div>
	</div>
</html>
<?php 
}else{
     header("Location: admin_login.php");
     exit();
}