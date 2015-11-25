<?php
	include_once('./connection.php');
	$email=mysqli_real_escape_string($con,trim(addslashes($_POST['email'])));
	$sql="SELECT * FROM users WHERE email_id='$email'";
	$result=  mysqli_query($con, $sql);
	$count=  mysqli_num_rows($result);
	if($count==0){
			echo '2';
	}
	else{
		$password_change = md5(uniqid(rand(), true));
		$sql1="update users set password_change='$password_change' where email_id='$email'";
		$result1=  mysqli_query($con, $sql1);
		if($result1){
			$message="Please visit the link to change the password \nhttp://memoryleak14.byethost14.com/password_change.php?email=$email&password_change=$password_change   \nRegards,\nMemoryLeak";
			$message = wordwrap($message, 70);
			mail($email,"MemoryLeak Password Change",$message, "From:support@memoryleak14.byethost14.com" );
			echo '1';
		}			
		else{
			echo '3';
		}
	}

?>