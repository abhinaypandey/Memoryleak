<?php
	session_start();
	include 'connection.php';
	$login_user_id=$_SESSION['login_user_id'];
	$result=mysqli_query($con,"select user_type,user_id from users where user_id='$login_user_id'");
	$count=  mysqli_num_rows($result);
	if($count==1){
		$row=mysqli_fetch_array($result);
		if($row['user_type']=='normal'){
			$login_session=$row['user_id'];
		}
	}
	mysqli_close($con);
	if(!isset($login_session)){
		session_destroy();
		header("Location: ../index.php");
		exit();
	}

	
?>