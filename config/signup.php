<?php
	include_once('./connection.php');
	$email=mysqli_real_escape_string($con,trim(addslashes($_POST['email'])));
	$password=mysqli_real_escape_string($con,trim(addslashes($_POST['password'])));
	$confirmpassword=mysqli_real_escape_string($con,trim(addslashes($_POST['cpassword'])));
	$sql="select * from users where email_id='$email'";
	$result=  mysqli_query($con, $sql);
	$count=  mysqli_num_rows($result);
	if($count==1){
			$row=mysqli_fetch_array($result);
			if($row['activation']!="activated"){
				$message="Please visit the link to activate the account\n http://memoryleak14.byethost14.com/activate.php?email=$email&activation_code=$activation   \nRegards,\nMemoryLeak";
				$message = wordwrap($message, 70);
				mail($email,"MemoryLeak Account Activation",$message, "From: support@zamsakk.com" );
			}
			echo '2';
	}
	else{
		$activation = md5(uniqid(rand(), true));
		$sql1="INSERT INTO users (email_id,password,user_type,activation,create_date) values('$email',sha1('$password'),'normal','$activation',curdate())";
		$result1=  mysqli_query($con, $sql1);
		if($result1){
			$message="Please visit the link to activate the account \nhttp://memoryleak14.byethost14.com/activate.php?email=$email&activation_code=$activation   \nRegards,\nMemoryLeak";
			$message = wordwrap($message, 70);
			mail($email,"MemoryLeak Account Activation",$message, "From: support@zamsakk.com" );
			echo '1';
		}			
		else{
			echo '3';
		}
	}
	
?>

