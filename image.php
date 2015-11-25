<?php	
		include './config/connection.php';
        $user_id=mysqli_real_escape_string($con,trim(addslashes($_GET['user_id'])));
        $result=mysqli_query($con,"select image from profiles where user_id=$user_id");
        
        while($row=mysqli_fetch_array($result)){
            $image=$row['image'];
			
			$img=file_get_contents('./uploads/user_images/'.$image);
			echo $img;
        }
?>