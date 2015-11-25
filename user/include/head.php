		<?php 
			include 'connection.php';
			$result=mysqli_query($con,"select user_name from profiles where user_id=".$login_session);
			$row=mysqli_fetch_array($result);
			if(isset($row['user_name'])&&($_SERVER['PHP_SELF']=='/user/profile.php')){
				mysqli_close($con);
				header("Location: index.php");
				exit;
			}
			else if(!isset($row['user_name'])&&($_SERVER['PHP_SELF']!='/user/profile.php')){
				mysqli_close($con);
				header("Location: profile.php");
				exit;
			}
			mysqli_close($con);	
		?>
		
		<meta charset="UTF8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/> <!--320-->
		<script src="./js/jquery2-min.js"></script>
		<script src="./js/waypoints-min.js"></script>
		<script src="./js/jquery-easing-min.js"></script>
		<script src="./js/stellar-min.js"></script>
		<script src="./js/nprogress.js"></script>
		<script src="./js/index.js"></script>
		<link rel="stylesheet"  href="./css/nprogress.css" />
		<link rel="stylesheet"  href="./css/style.css" />
		