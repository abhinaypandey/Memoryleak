<?php
	include_once './include/lock_normal.php';
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		if($_REQUEST['type']==1){
			include './include/connection.php';
			$item_id=mysqli_real_escape_string($con,addslashes($_POST['item_id']));
			$item_type=mysqli_real_escape_string($con,addslashes($_POST['item_type']));
			if($item_type=="a"){
				$results=mysqli_query($con,"delete from answer_carts where answer_id=$item_id and user_id=$login_session ;");
				if($results){
					echo  '1';
				}
			}
			else if($item_type=="p"){
				$results=mysqli_query($con,"delete from project_carts where project_id=$item_id and user_id=$login_session ;");
				if($results){
					echo  '1';
				}
			}	
			mysqli_close($con);
		}
		else if($_REQUEST['type']==2){
			
			include './include/connection.php';
			$sender_id=$_POST['sender_id'];			
			if(isset($_POST['message_text'])){
				$message_text=$_POST['message_text'];
				mysqli_query($con,"insert into messages (`to_user_id`, `from_user_id`, `message_text`, `view_flag`, `date_time`) values('$sender_id','$login_session','$message_text',1,now())");
			}
			mysqli_query($con,"update messages set view_flag=0 where to_user_id=$login_session and from_user_id=$sender_id");
			$result=mysqli_query($con,"select * from messages where (to_user_id=$login_session or to_user_id=$sender_id) and (from_user_id=$login_session or from_user_id=$sender_id) order by date_time");
			while($row=mysqli_fetch_assoc($result)){
				// getting msg using sender id
				$sender_id=$row['from_user_id'];
				$message=nl2br($row['message_text']);

				//getting date,time,day when msg has been sent by sender
				$parenttime = $row['date_time'];
				$timestamp=strtotime($parenttime);
				$get_date = date('j-n-Y',$timestamp);
				$get_time = date('H:i',$timestamp);
				$get_day = date('D', $timestamp);
				//gettin guser name
				$username_result=mysqli_query($con,'select * from profiles where user_id='.$sender_id.'');
				$username_row=mysqli_fetch_assoc($username_result);
				$username_sender=$username_row['user_name'];
				 //getting present date
				$date_present=date('j-n-Y');
				// calculating about sender dat and time to show date or time
				if($date_present==$get_date){
					$show_date=$get_time;                
				}
				else{
					$show_date=$get_date;                
				}
				echo '<div class="msg" data="'.$sender_id.'"" style="width:99.7%; 
						padding-top:5px; 
						min-height:100px; 
						max-width:100%; 
						word-wrap:break-word; 
						background-image:url(./image.php?user_id='.$sender_id.'); 
						background-size:45px 45px; 
						background-position:1px 8px; 
						background-repeat:no-repeat;
						">
							<div style=" width:90%; padding-left:50px;">
								<span><b>'.$username_sender.'</b></span><span style="float:right;">'.$show_date.'</span>
								<br/>'.$message.'

							</div>


					</div>
					<hr/>';
			}
		
			mysqli_close($con);
			
		}
		else if($_REQUEST['type']==3){
			include './include/connection.php';
			$search=mysqli_real_escape_string($con,$_GET['search']);
			if($search!=''){
				$result=mysqli_query($con,"select * from master_skills where skill like '$search%' order by skill limit 5");
				$arr = array();
				$i=0;
				while($row=mysqli_fetch_array($result)){
					$arr[$i]=$row['skill'];
					$i++;
				}
				if($i>0){
					echo json_encode($arr); 
				}
			}			
			mysqli_close($con);
		}
		else if($_REQUEST['type']==4){
			include './include/connection.php';
			$search=mysqli_real_escape_string($con,$_GET['search']);
			
			if($search!=''){
				$result=mysqli_query($con,"select * from master_majors where major like '$search%' order by major limit 5");
				$arr = array();
				$i=0;
				while($row=mysqli_fetch_array($result)){
					$arr[$i]=$row['major'];
					$i++;
				}
				if($i>0){
					echo json_encode($arr); 
				}
			}
			mysqli_close($con);
		}
		else if($_REQUEST['type']==5){
			include './include/connection.php';
			$q=$_REQUEST['searchword'];
			$result=mysqli_query($con,"select user_name,profiles.user_id,user_type from profiles,users where profiles.user_id=users.user_id and user_type='normal' and user_name like '%$q%' order by user_name LIMIT 5");
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
		else if($_REQUEST['type']==6){
			include './include/connection.php';
			$message_text=$_REQUEST['message_text'];
			$list=$_REQUEST['list'];
			
			foreach($list as $to){
				$result=mysqli_query($con,"select user_id from profiles where user_name='$to'");
				$row=mysqli_fetch_array($result);
				$to_user=$row['user_id'];
				mysqli_query($con,"insert into messages (`to_user_id`, `from_user_id`, `message_text`, `view_flag`, `date_time`) values($to_user,$login_session,'$message_text',1,now())");
			}
			echo '1';
			mysqli_close($con);
			
		
		}
		else if($_REQUEST['type']==7){
			include './include/connection.php';
			$sender_id=$_POST['sender_id'];    	
			if(isset($_POST['message_text'])){
				$message_text=$_POST['message_text'];	
				mysqli_query($con,"insert into messages (`to_user_id`, `from_user_id`, `message_text`, `view_flag`, `date_time`) values('$sender_id','$login_session','$message_text',1,now())");
			}
			mysqli_query($con,"update messages set view_flag=0 where from_user_id=$sender_id and to_user_id=$login_session");
			$result=mysqli_query($con,"select * from messages where (to_user_id=$login_session or to_user_id=$sender_id) and (from_user_id=$login_session or from_user_id=$sender_id) order by date_time limit 10");
			while($row=mysqli_fetch_assoc($result)){
				// getting msg using sender id
				$sender_id=$row['from_user_id'];
				$message=nl2br($row['message_text']);

				//getting date,time,day when msg has been sent by sender
				$parenttime = $row['date_time'];
				$timestamp=strtotime($parenttime);
				$get_date = date('j-n-Y',$timestamp);
				$get_time = date('H:i',$timestamp);
				$get_day = date('D', $timestamp);
				//gettin guser name
				$username_result=mysqli_query($con,'select * from profiles where user_id='.$sender_id.'');
				$username_row=mysqli_fetch_assoc($username_result);
				$username_sender=$username_row['user_name'];
				 //getting present date
				$date_present=date('j-n-Y');
				// calculating about sender dat and time to show date or time
				if($date_present==$get_date){
					$show_date=$get_time;                
				}
				else{
					$show_date=$get_date;                
				}
				echo '<div class="m_msg" data="'.$sender_id.'"" style="width:99.7%; 
						padding-top:5px; 
						min-height:100px; 
						max-width:100%; 
						word-wrap:break-word; 
						background-image:url(image.php?user_id='.$sender_id.'); 
						background-size:45px 45px; 
						background-position:1px 8px; 
						background-repeat:no-repeat;
						">
							<div style="width:80%; padding-left:50px;">
								<span ><b>'.$username_sender.'</b></span><span style="float:right;">'.$show_date.'</span>
								<br/>'.$message.'

							</div>


					</div>
					<hr/>';
			}
			
			mysqli_close($con);
			
		}
		else if($_POST['type']==8){
			include './include/connection.php';
			$user=trim($_POST['username']);
			if(strlen($user)!=0){
				$rst=mysqli_query($con,'select user_name from profiles where user_name ="'.$user.'"');
				$row=mysqli_num_rows($rst);

				if($row==1)
					echo '0';
				elseif($row==0)
					echo '1';
			}	
		}
		else if($_POST['type']==9){
			include './include/connection.php';
			$search=trim($_POST['skill']);
			if(strlen($search)!=0){
				if(strlen($search)>1){
					$rows= mysqli_query($con,'select skill from master_skills where skill like "%'.mysqli_real_escape_string($con,$search).'%" order by skill asc limit 0,5');
			 	}

				else{
					$rows= mysqli_query($con,'select skill from master_skills where skill like "'.mysqli_real_escape_string($con,$search).'%" order by skill asc limit 0,5');
			 	}

			}

			$data=array();
			$i=0;
			if($con&& mysqli_num_rows($rows)){
				while($row=mysqli_fetch_assoc($rows)){
					$data[$i]=$row['skill'];
					$i++;
				}
			}
			if($i>0){
				echo json_encode($data);
			}
			flush();
		}
		else if($_POST['type']==10){
			include './include/connection.php';
			$search=strtolower(trim($_POST['major']));
			if(strlen($search)!=0){
				if(strlen($search)>1){
					$rows= mysqli_query($con,'select major from master_majors where major like "%'.mysqli_real_escape_string($con,$search).'%" order by major asc limit 0,10');
			 	}

				else{
					$rows= mysqli_query($con,'select major from master_majors where major like "'.mysqli_real_escape_string($con,$search).'%" order by major asc limit 0,5');
			 	}

			}

			$data=array();
			$i=0;
			if($con && mysqli_num_rows($rows)){
				while($row=mysqli_fetch_assoc($rows)){
					$data[$i]=$row['major'];
					$i++;
				}
			}
			if($i>0){
				echo json_encode($data);
			}
			flush();
		}
		else if($_POST['type']==11){
			include './include/connection.php';
			$count=trim(mysqli_real_escape_string($con,$_POST['count']));
			$result=mysqli_query($con,"select * from withdrawals where user_id=$login_session order by date_time desc limit $count, 10");
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
		else if($_POST['type']==12){
			include './include/connection.php';
			$count=trim(mysqli_real_escape_string($con,$_POST['count']));
			$result=mysqli_query($con,"select answer_accounts.transaction_id,answer_accounts.bounty,transactions.date_time,abstract from answer_accounts,answers,transactions where transactions.transaction_id=answer_accounts.transaction_id and answer_accounts.answer_id=answers.answer_id and transactions.user_id=$login_session order by date_time desc limit  $count, 10");
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
		else if($_POST['type']==13){
			include './include/connection.php';
			$count=trim(mysqli_real_escape_string($con,$_POST['count']));
			$result=mysqli_query($con,"select answer_accounts.transaction_id,answer_accounts.bounty,transactions.date_time,abstract from answer_accounts,answers,transactions where transactions.transaction_id=answer_accounts.transaction_id and answer_accounts.answer_id=answers.answer_id and buy_from=$login_session order by date_time desc limit  $count, 10");
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
		else if($_POST['type']==14){
			include './include/connection.php';
			$count=trim(mysqli_real_escape_string($con,$_POST['count']));
			$result=mysqli_query($con,"select transactions.transaction_id, projects.bounty, projects.title, transactions.date_time from transactions, projects, project_accounts where transactions.transaction_id=project_accounts.transaction_id and transactions.user_id=$login_session and projects.user_id=project_accounts.buy_from order by transactions.transaction_id desc limit $count , 10");
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
		else if($_POST['type']==15){
			include './include/connection.php';
			$count=trim(mysqli_real_escape_string($con,$_POST['count']));
			$result=mysqli_query($con,"select project_accounts.transaction_id,project_accounts.bounty,transactions.date_time,title from project_accounts,projects,transactions where transactions.transaction_id=project_accounts.transaction_id and project_accounts.project_id=projects.project_id and buy_from=$login_session order by date_time desc limit $count, 10");
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
		else if($_POST['type']==16){
			include './include/connection.php';
			$email=trim(mysqli_real_escape_string($con,$_POST['email']));
			$earning=0;
			$withdraw=0;
			$result=mysqli_query($con,"select answer_accounts.bounty,transactions.user_id as t_uid,questions.user_id as q_uid,answer_accounts.buy_from from questions,transactions,answers,answer_accounts where questions.question_id=answers.question_id and transactions.transaction_id=answer_accounts.transaction_id and answer_accounts.buy_from=$login_session");
			while($row=mysqli_fetch_array($result)){
				if($row['t_uid']==$row['q_uid'])
					$earning=$earning+$row['bounty']*80/100;
				else
					$earning=$earning+$row['bounty']*70/100;
			}
			$result=mysqli_query($con,"select sum(project_accounts.bounty) as bounty from projects,project_accounts where projects.project_id=project_accounts.project_id and user_id=$login_session");
			$row=mysqli_fetch_array($result);
			$earning=$earning+$row['bounty']*80/100;
			$result=mysqli_query($con,"select sum(amount) as bounty from withdrawals where user_id=$login_session");
			$row=mysqli_fetch_array($result);
			$withdraw=$withdraw+$row['bounty'];
			$amount=$earning-$withdraw;
			if($amount>=5){
				$result=mysqli_query($con,"insert into withdrawals (user_id,paypal_email_id,amount) values($login_session,'$email',$amount)");
				if($result){
					echo '1';
				}
				else{
					echo '2';
				}
			}
			else{
				echo '3';
			}
			
			mysqli_close($con);
		}
		else if($_POST['type']==17){
			include './include/connection.php';
			$answer_id=htmlspecialchars($_POST['answer_id']);
			$user_id=$login_session;
			$query='insert into answer_carts (user_id,answer_id) values('.$user_id.','.$answer_id.')';
			if(mysqli_query($con,$query)){
				echo 'success';
			}
			else{
				echo 'Question allready in CART !!!';
			}
		}
		
		//purchased projects
        else if($_POST['type']==19){
            include './include/connection.php';
            $count=trim(mysqli_real_escape_string($con,$_POST['count']));
            $result=mysqli_query($con,"select project_accounts.project_id,projects.title from projects,project_accounts,transactions where transactions.transaction_id=project_accounts.transaction_id and projects.project_id=project_accounts.project_id and transactions.user_id=$login_session limit $count , 10 ;");
            $arr=array();
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
		//purchased answers
        else if($_POST['type']==20){
            include './include/connection.php';
            $count=trim(mysqli_real_escape_string($con,$_POST['count']));
            $result=mysqli_query($con,"select answer_accounts.answer_id,answers.abstract from answers,answer_accounts,transactions where transactions.transaction_id=answer_accounts.transaction_id and answers.answer_id=answer_accounts.answer_id and transactions.user_id=$login_session limit $count , 10 ;");
            $arr=array();
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
        
		//upload projects
        else if($_POST['type']==21){
            include './include/connection.php';
            $count=trim(mysqli_real_escape_string($con,$_POST['count']));
            $result=mysqli_query($con,"select * from projects where user_id=$login_session limit $count,10;");
            $arr=array();
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
		//upload answers
        else if($_POST['type']==22){
            include './include/connection.php';
            $count=trim(mysqli_real_escape_string($con,$_POST['count']));
            $result=mysqli_query($con,"select * from answers where user_id=$login_session limit $count,10; ");
            $arr=array();
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
//        upload questions
        else if($_POST['type']==23){
            include './include/connection.php';
            $count=trim(mysqli_real_escape_string($con,$_POST['count']));
            $result=mysqli_query($con,"select question_id,title from questions where user_id=$login_session limit $count , 10 ");
            $arr=array();
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
		
		else if($_POST['type']==24){
			if($_POST['category']=='question'){
				include './include/connection.php';
				$search=trim(mysqli_real_escape_string($con,$_POST['search']));
				$count=trim(mysqli_real_escape_string($con,$_POST['count']));
				$query1="SELECT q.user_id,q.question_id,q.title,q.description,q.bounty,q.status,p.user_name FROM questions AS q,profiles AS p WHERE  q.user_id=p.user_id AND MATCH(title) AGAINST('$search' IN NATURAL LANGUAGE MODE) ORDER BY q.date_time limit $count,10";
				$result1=mysqli_query($con,$query1);

				
				$titles=array();
				$i=0;
				while($row=mysqli_fetch_array($result1)){
					$titles[$i]=$row;
					$i++;
				}

				if($i>0){
					echo json_encode($titles);
				}

				mysqli_close($con);
			}

			else if($_POST['category']=='project'){
				include './include/connection.php';
				$search=trim(mysqli_real_escape_string($con,$_POST['search']));
				$count=trim(mysqli_real_escape_string($con,$_POST['count']));
				$query1="SELECT pr.user_id,pr.project_id,pr.title,pr.description,pr.bounty,p.user_name FROM projects AS pr,profiles AS p WHERE  pr.user_id=p.user_id AND MATCH(title) AGAINST('$search' IN NATURAL LANGUAGE MODE) ORDER BY pr.date_time limit $count, 10 ";
				$result1=mysqli_query($con,$query1);

				
				$titles=array();
				$i=0;
				while($row=mysqli_fetch_array($result1)){
					$titles[$i]=$row;
					$i++;
				}

				if($i>0){
					echo json_encode($titles);
				}

				mysqli_close($con);
			}
			
		}
		else if($_POST['type']==25){
            include './include/connection.php';
            $project_id=trim(mysqli_real_escape_string($con,$_POST['pid']));
            $query="SELECT profiles.user_id,profiles.user_name,project_accounts.rating,project_accounts.review,project_accounts.rating_date_time FROM project_accounts,profiles,transactions WHERE project_id=$project_id AND transactions.transaction_id=project_accounts.transaction_id AND profiles.user_id=transactions.user_id ORDER BY rating_date_time DESC";
            $result=mysqli_query($con,$query);
     
            $rate_review=array();
            $i=0;
            while($row=mysqli_fetch_array($result)){
            	$parenttime=$row['rating_date_time'];
            	$timestamp=strtotime($parenttime);
            	$row['rating_date_time']=date('d/m/Y',$timestamp);
                $rate_review[$i]=$row;
                $i++;
            }

            if($i>0){
                echo json_encode($rate_review);
            }

            mysqli_close($con);
        }
		 else if($_POST['type']==26){
            include './include/connection.php';
            $rating=trim(mysqli_real_escape_string($con,$_POST['rate']));
            $review=trim(mysqli_real_escape_string($con,$_POST['review']));
            $project_id=trim(mysqli_real_escape_string($con,$_POST['pid']));
            $user=trim(mysqli_real_escape_string($con,$_POST['uid']));
            $buy_from=trim(mysqli_real_escape_string($con,$_POST['buy_from']));

             //fetching avg_rating and rating_count
            $rating_result=mysqli_query($con,"SELECT profiles.avg_rating,profiles.rating_count FROM profiles WHERE profiles.user_id=$user");
            $rating_row=mysqli_fetch_assoc($rating_result);

            //calculating average

            $rating_count=$rating_row['rating_count'];
            $avg_rating=(($rating_row['avg_rating']*$rating_count)+$rating)/($rating_count+1);
            $rating_count+=1;
            $profile_result=mysqli_query($con,"UPDATE profiles SET profiles.avg_rating=$avg_rating , profiles.rating_count=$rating_count WHERE profiles.user_id=$user");

            $query="UPDATE  project_accounts,transactions SET rating=$rating, review='$review',rating_date_time=now() WHERE project_id=$project_id and project_accounts.transaction_id=transactions.transaction_id and transactions.user_id=$user";
            $result=mysqli_query($con,$query);
            if(($row=mysqli_affected_rows($con))>0){
                echo '1';
            }
            else{
                echo '0';
            }

            mysqli_close($con);
        }
		else if($_POST['type']==27){
            include './include/connection.php';
            $count=trim(mysqli_real_escape_string($con,$_POST['count']));
            $answer_id=trim(mysqli_real_escape_string($con,$_POST['answer_id']));
            $result=mysqli_query($con,"select transactions.user_id,profiles.user_name,answer_accounts.rating_date_time,answer_accounts.rating,answer_accounts.review from answer_accounts, profiles,transactions where answer_accounts.answer_id=$answer_id and transactions.transaction_id=answer_accounts.transaction_id and profiles.user_id=transactions.user_id order by date_time desc limit $count,10 ");
            $arr=array();
            $i=0;
            while($row=mysqli_fetch_array($result)){
                                $parenttime = $row['rating_date_time'];
								$timestamp=strtotime($parenttime);
								$row['rating_date_time'] = date('d/m/Y',$timestamp);                
                $arr[$i]=$row;
                $i++;
            }
            if($i>0){
                echo json_encode($arr);
            }
            mysqli_close($con);
        }
		else if($_POST['type']==28){
            include './include/connection.php';
            $rating=trim(mysqli_real_escape_string($con,$_POST['rate']));
            $review=trim(mysqli_real_escape_string($con,$_POST['review']));
            $answer_id=trim(mysqli_real_escape_string($con,$_POST['aid']));
            $user=trim(mysqli_real_escape_string($con,$_POST['uid']));
            $buy_from_user=trim(mysqli_real_escape_string($con,$_POST['buy_from']));
            
            // fetching avg_rating and rating_count
            $rating_result=mysqli_query($con,"SELECT profiles.avg_rating, profiles.rating_count from profiles where profiles.user_id=$buy_from_user");
            $rating_row=mysqli_fetch_assoc($rating_result);
            
           
            //calculting average
            $rating_count=$rating_row['rating_count'];
            
            $avg_rating=(($rating_row['avg_rating']*$rating_count)+$rating)/($rating_count+1);
            $rating_count=$rating_count+1;
            $profile_result=mysqli_query($con,"UPDATE profiles SET profiles.avg_rating=$avg_rating , profiles.rating_count=$rating_count where profiles.user_id=$buy_from_user");
            $result=mysqli_query($con,"UPDATE  answer_accounts,transactions SET rating=$rating, review='$review',rating_date_time=now() WHERE answer_id=$answer_id and answer_accounts.transaction_id=transactions.transaction_id and transactions.user_id=$user");
            
            if(($row=mysqli_affected_rows($con))>0){
                echo '1';
            }
            else{
                echo '0';
            }

            mysqli_close($con);
        }
		else if($_POST['type']==30){
			include './include/connection.php';
			$description=htmlspecialchars($_POST['description']);
			$subject=htmlspecialchars($_POST['subject']);
			$query='INSERT INTO supports ( user_id,subject,description,entry_date_time ) VALUES (\''.$login_session.'\',\''.$subject.'\',\''.$description.'\',now())';
			if(!mysqli_query($con,$query)){
				echo 'failure';
			}
		}
		else if($_POST['type']==31){
			include './include/connection.php';
			$count=trim(mysqli_real_escape_string($con,$_POST['count']));
			$result=mysqli_query($con,"select distinct(questions.question_id) as question_id,status,due_date_time,title,bounty from questions,question_majors,majors,profiles where question_majors.question_major=majors.user_major and questions.question_id=question_majors.question_id and profiles.user_id=majors.user_id and profiles.user_id=$login_session order by date_time desc limit $count, 8");
			$arr = array();
			$i=0;
			while($row=mysqli_fetch_array($result)){
				$timestamp=strtotime($row['due_date_time']);
				$row['due_date_time'] = date('j-n-Y',$timestamp);
				$category_result=mysqli_query($con,"select group_concat(question_major) as category from question_majors where question_id=".$row['question_id']);
				$category=mysqli_fetch_array($category_result);
				
				if(!$category['category'])
					$category="No Category";
				$row['category']=$category['category'];
				$arr[$i]=$row;
				$i++;
			}
			if($i>0){
				echo json_encode($arr); 
			}
			mysqli_close($con);
		}
		else if($_POST['type']==32){
			include './include/connection.php';
			$count=trim(mysqli_real_escape_string($con,$_POST['count']));
			if(isset($_POST['filter'])){
				$filter=$_POST['filter'];
				$query="select distinct(questions.question_id) as question_id,status,due_date_time,title,bounty from questions,question_majors,majors where question_majors.question_major='$filter' and question_majors.question_id=questions.question_id order by date_time desc limit $count, 10";
			}
			else{
				$query="select distinct(questions.question_id) as question_id,status,due_date_time,title,bounty from questions,question_majors,majors order by date_time desc limit $count, 10";
			}
				
			
			
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
		
		else if($_POST['type']==33){
            include './include/connection.php';
            $project_id=trim(mysqli_real_escape_string($con,$_POST['project_id']));
            $query="INSERT INTO project_carts (user_id,project_id)  VALUES ($login_session,$project_id)";
            $result=mysqli_query($con,$query);
            if(($row=mysqli_affected_rows($con))>0){
                echo '1';
            }
            else{
                echo '0';
            }

            mysqli_close($con);
        }
            else if($_POST['type']==34){
            include './include/connection.php';
            $flag=trim(mysqli_real_escape_string($con,$_POST['flag']));
            $query= "UPDATE profiles SET nav_flag=".$flag." where user_id=".$login_session;
            mysqli_query($con,$query);
            mysqli_close($con);
        }
	}
	else{
		echo 'error';
	}
	
	
?>	