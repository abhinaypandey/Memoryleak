<?php

	if($_SERVER["REQUEST_METHOD"] == "POST"){
		 if($_POST['type']==1){
			include './config/connection.php';
			$count=trim(mysqli_real_escape_string($con,$_POST['count']));
			$query="select distinct(questions.question_id) as question_id,status,due_date_time,title,bounty from questions,question_majors,majors order by date_time desc limit $count, 10";	
			$result=mysqli_query($con,$query);
			$arr = array();
			$i=0;
			while($row=mysqli_fetch_array($result)){
				$timestamp=strtotime($row['due_date_time']);
				$row['due_date_time'] = date('j-n-Y',$timestamp);
				$category_result=mysqli_query($con,"select group_concat(question_major) as category from question_majors where question_id=".$row['question_id']);
				$category=mysqli_fetch_array($category_result);
				if(!$category['category'])
					$category['category']="No Category";
				$row['category']=$category['category'];
				$arr[$i]=$row;
				$i++;
			}
			if($i>0){
				echo json_encode($arr); 
			}
			mysqli_close($con);
		}
		else if($_POST['type']==2){
        	$name= addslashes($_POST['name']);
		    $email= addslashes($_POST['email']);
		    $subject= addslashes($_POST['subject']);
		    $message= addslashes($_POST['message']);

		    $result=mail("support@memoryleak14.byethost14.com",$subject,'Name:'.$name.'From :'.$email.''.'\n Message : '.$message, "From: support@memoryleak14.byethost14.comm" );
		    if($result){
		    	echo '1';
		    }
		    else{
		    	echo '0';
		    }
		}
	}
	else{
		echo 'error';
	}
	
	
?>