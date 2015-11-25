<?php
		include_once './include/lock_admin.php';	
		include './include/connection.php';
        $user_id=mysqli_real_escape_string($con,trim(addslashes($_GET['user_id'])));
        $result=mysqli_query($con,"select image from profiles where user_id=$user_id");
        while($row=mysqli_fetch_array($result)){
            $image=$row['image'];
			header("Content-type: image/jpg"); 
			echo $image;
        }
?>