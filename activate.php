<!DOCTYPE html>
<?php
	if(isset($_GET['email'])&&isset($_GET['activation_code'])){
		$email=$_GET['email'];
		include('./config/connection.php');
		$sql="SELECT * FROM users WHERE email_id='$email'";
		$result=  mysqli_query($con, $sql);
		$count=  mysqli_num_rows($result);
		if($count==1){
				$row=mysqli_fetch_array($result);
				if($row['activation']=="activated"){
					echo'<script>alert("Account already activated");
							window.location.href = "index.php";
						</script>';
				
				}
				else if($row['activation']==$_GET['activation_code']){
					$return=mysqli_query($con, "update users set activation='activated' where email_id='$email'");
					if($return){
						echo'<script>alert("Account activated sucessfully now you can login");
								window.location.href = "index.php";
							</script>';
					}
					else{
						echo'<script>alert("Something went wrong please try again later");
								window.location.href = "index.php";
							</script>';
					}
				}
				
		}
		else{
		
			echo'<script>alert("Invalid Request");
				window.location.href = "index.php";
			</script>';
		}
	
	
	
	}
?>