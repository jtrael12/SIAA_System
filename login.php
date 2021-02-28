<?php 
session_start(); 
include "includes/autoloader.inc.php";

$login = new Login();
$try = $login->login();

if (isset($_POST['uname']) && isset($_POST['password'])) {

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	$uname = validate($_POST['uname']);
	$pass = validate($_POST['password']);

	if (empty($uname)) {
		header("Location: admin_login.php?error=Username is required");
	    exit();
	}else if(empty($pass)){
        header("Location: admin_login.php?error=Password is required");
	    exit();
	}else{
		//$sql = "SELECT * FROM admin WHERE user_name='$uname' AND password='$pass'";

		//$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($try) === 1) {
			$row = mysqli_fetch_assoc($try);
            if ($row['user_name'] === $uname && $row['password'] === $pass) {
            	$_SESSION['user_name'] = $row['user_name'];
            	$_SESSION['name'] = $row['name'];
            	$_SESSION['id'] = $row['id'];
            	header("Location: home.php");
		        exit();
            }else{
				header("Location: admin_login.php?error=login failed");
		        exit();
			}
		}else{
			header("Location: admin_login.php?error=Incorect Username or password");
	        exit();
		}
	}
	
}else{
	header("Location: studlogin.php");
	exit();
}