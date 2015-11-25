<?php
	session_start();
	include('connection.php');
	$email=mysqli_real_escape_string($con,trim(addslashes($_POST['email'])));
	$password=mysqli_real_escape_string($con,trim(addslashes($_POST['password'])));
	$sql="SELECT user_id,user_type FROM users WHERE email_id='$email' and password=sha1('$password')";
	$result=  mysqli_query($con, $sql);
	$count=  mysqli_num_rows($result);
	
	if($count==1){
			$row=mysqli_fetch_array($result);
			$_SESSION['login_user_id']=$row['user_id'];		
			if($row['user_type']=='normal')
				echo 'normal';
			else if($row['user_type']=='admin')
				echo 'admin';
	}	
	else{
			echo '2';
	}
	mysqli_close($con);
	
?>
