<?php
	include_once './include/lock_admin.php';
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		
		if($_REQUEST['type']==1){
			include './include/connection.php';
			$count=mysqli_real_escape_string($con,trim($_POST['count']));
			$result=mysqli_query($con,"select * from withdrawals where payment_status='Requesting' and notify=1 order by date_time limit $count, 10");
			$arr = array();
			$i=0;
			while($row=mysqli_fetch_array($result)){
				$arr[$i]=$row;
				$i++;
			}
			if($i>0){
				echo json_encode($arr); 
			}
			mysqli_close($con);
		}
		else if($_REQUEST['type']==2){
			include './include/connection.php';
			$tid=mysqli_real_escape_string($con,trim($_POST['tid']));
			$paypal_transaction_id=mysqli_real_escape_string($con,trim($_POST['ptid']));
			$result=mysqli_query($con,"update withdrawals set paypal_transaction_id='$paypal_transaction_id' , payment_date=now() , payment_status='Completed' , notify=0 where transaction_id=$tid");
			if($result){
				echo "1";
			}
		}
		else if($_POST['type']==3){
			if($_POST['mastertype']=="Majors"){
				include './include/connection.php';
	            $majors=trim(mysqli_real_escape_string($con,$_POST['masters']));
	            $majors=explode(",",$majors);
	            $majors=array_unique($majors);
	            $inserted=array();
	            $notinserted=array();
	            $i=0;
	            $j=0;
	            foreach($majors as $major){
	                $query="INSERT INTO master_majors(major) values('$major')";
	                $result=mysqli_query($con,$query);
	                	
	                if(mysqli_affected_rows($con)>0){
		               $inserted[$i]=$major;
		               $i++;
			        }
		            else{
			           $notinserted[$j]=$major;
		               $j++;
		            }

	            }
	           $affected=array("inserted"=>$inserted,"notinserted"=>$notinserted);
	           echo json_encode($affected);
	            
	            mysqli_close($con); 
			}

			else if($_POST['mastertype']=="Skills"){
				include './include/connection.php';
	            $skills=trim(mysqli_real_escape_string($con,$_POST['masters']));
	            $skills=explode(",",$skills);
	            $skills=array_unique($skills);
	            $inserted=array();
	            $notinserted=array();
	            $i=0;
	            $j=0;
	            foreach($skills as $skill){
	                $query="INSERT INTO master_skills(skill) values('$skill')";
	                $result=mysqli_query($con,$query);
	                	
	                if(mysqli_affected_rows($con)>0){
		               $inserted[$i]=$skill;
		               $i++;
			        }
		            else{
			           $notinserted[$j]=$skill;
		               $j++;
		            }

	            }
	           $affected=array("inserted"=>$inserted,"notinserted"=>$notinserted);
	           echo json_encode($affected);
	            
	            mysqli_close($con); 
			}

			else if($_POST['mastertype']=="Countries"){
				include './include/connection.php';
	            $country=trim(mysqli_real_escape_string($con,$_POST['masters']));
	            $code=trim(mysqli_real_escape_string($con,$_POST['code']));
	            $inserted='';
				$notinserted='';		
	                $query="INSERT INTO master_countries(country,phone_code) values('$country','$code')";
	                $result=mysqli_query($con,$query);
	                	
	                if(mysqli_affected_rows($con)>0){
		               $inserted=$country.'-'.$code;
		              
			        }
		            else{
			           $notinserted=$country.'-'.$code;
		             
		            }
	           $affected=array("inserted"=>$inserted,"notinserted"=>$notinserted);
	           echo json_encode($affected);
	            
	            mysqli_close($con); 
			}

			
        }
		
	}
	else{
		echo 'error';
	}
	
	
?>