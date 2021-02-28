<?php 
	include "db_conn.php";
	session_start();
	if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {

		if(isset($_POST['sub'])){
			$old = $_POST["old"];
			$new = $_POST["new"];
			
			$sql = "SELECT password FROM admin";
			$result = $conn->query($sql);
			$row = $result->fetch_assoc();
			if($row['password']==$old){
				$sql = "UPDATE admin SET password='$new'";
				if($result = $conn->query($sql) == true){
					
					header("Location:home.php?success=1");
				}
			}
			else{
				header("Location:home.php?error=1");
			}
		}
	}else{
		header("Location: admin_login.php");
		exit();
	}
?>