<!DOCTYPE html>
<?php
	if(isset($_GET['email'])&&isset($_GET['password_change'])){
		include('./config/connection.php');
		$email=mysqli_real_escape_string($con,$_GET['email']);
		$password_change=mysqli_real_escape_string($con,$_GET['password_change']);
		$sql="SELECT * FROM users WHERE email_id='$email' and password_change='$password_change'";
		$result=  mysqli_query($con, $sql);
		$count=  mysqli_num_rows($result);
		if($count==1){
			echo '<html><head><title>MemoryLeak:Password Change</title>
					<script src="./js/jquery2-min.js"></script>
					</head><body>
					<form method="post" action="password_change.php" name="pform">
						<input type="password" placeholder="New Password" name="new_password">
						<br/>
						<input type="password" placeholder="Confirm Password" name="confirm_password">
						<input type="hidden" value="'.$email.'" name="email">
						<input type="hidden" value="http://memoryleak14.byethost14.com/password_change.php?email='.$email.'&password_change='.$password_change.'" name="backurl">
						<input type="hidden" value="'.$password_change.'" name="password_change">
						<br/>
						<input type="submit" value="Change Password" id="submit">
					</form>
					<script>
						$(document).ready(function(){
							$("form").submit(function(event){
								var np=$("[name=\'new_password\']").val();
								var cp=$("[name=\'confirm_password\']").val();
								var password_reg=/^([a-zA-Z0-9@_\.#]{8,})+$/;
								if(!password_reg.test(np)){
									alert("Password length should be greater then 8 character");
								}
								else{
									if(np!=cp){
										alert("Confirm password not match");
									}
									else{
										return;	
									}
									
								}
								event.preventDefault();
							});
						});
					</script>
					</body></html>';
				
		}
		else{
			echo'<script>alert("Invalid Request");
				window.location.href = "index.php";
			</script>';
		}
	}
	else if(isset($_POST['password_change'])&&isset($_POST['email'])&&isset($_POST['new_password'])&&isset($_POST['confirm_password'])&&isset($_POST['backurl'])){
		$backurl=$_POST['backurl'];
		if(strlen($_POST['new_password'])<8){
			echo'<script>alert("Password length is less then 8 character");
					window.location.href ="'.$backurl.'" ;
				</script>';
		}
		else if($_POST['new_password']!=$_POST['confirm_password']){
			echo'<script>alert("Conform password not match");
					window.location.href ="'.$backurl.'" ;
				</script>';
		}
		else{
			include('./config/connection.php');
			$email=mysqli_real_escape_string($con,$_POST['email']);
			$password=mysqli_real_escape_string($con,$_POST['new_password']);
			$password_change=mysqli_real_escape_string($con,$_POST['password_change']);
			$sql="update users set password=sha1('$password') , password_change=NULL where email_id='$email' and password_change='$password_change'";
			$result=  mysqli_query($con, $sql);
			if($result){
				echo'<script>alert("Password changes sucessfully");	window.location.href ="index.php" ; </script>';
			}
			else{
				echo'<script>alert("Something went wrong please try again later");
						window.location.href ="index.php" ;
					</script>';
			}
			
		}
	
	}
	else{
		echo'<script>alert("Invalid Request");
			window.location.href = "index.php";
		</script>';
	}
?>