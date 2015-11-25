<?php 
	include_once './include/lock_normal.php';
	include './include/connection.php';
	if(isset($_GET['notify'])&&isset($_GET['question_id'])&&isset($_GET['answer_id'])&&isset($_GET['transaction_id'])){
		if(trim($_GET['notify'])=="1"){
			mysqli_query($con,"update answer_accounts set notify=0 where answer_id=".$_GET['answer_id']);
           
		
		}
	}
    else if(isset($_GET['notify'])&&isset($_GET['question_id'])&&isset($_GET['answer_id'])){
		if(trim($_GET['notify'])=="1"){
			mysqli_query($con,"update answers set notify=0 where question_id=".$_GET['question_id']);
            
		
		}
	}
    
    
    
	if(isset($_GET['question_id']) ||isset($_SESSION['question_id']))
			{
				//fetching the question id into a variable by escaping the special characters
				if(isset($_GET['question_id']))
				{
					$question_id=(htmlspecialchars($_GET['question_id']));				
				    $_SESSION['question_id']=$question_id;
				}
				else
				{
					$question_id=(htmlspecialchars($_SESSION['question_id']));
				}
				//checking the existence of question_id
				$query="select question_id from questions where question_id='$question_id'";
				if($result=mysqli_query($con,$query))
				{
					if(!mysqli_fetch_array($result))
					{
						die('Invalid Question ID passed please go back and !!!');
					}
				}
				
				/*fetching the user_id,title,bounty,description and due_date
				 *from questions table, question_skill from question_skills table,question_major from question_majors 					 
				 */
				$query_1="select user_id,title,bounty,due_date_time,file,description from questions where question_id='$question_id'";
				$query_2="select GROUP_CONCAT(question_skill) as question_skills from question_skills where question_id='$question_id'";
				$query_3="select GROUP_CONCAT(question_major) as question_majors from question_majors where question_id='$question_id'";
				
				//executing query_1 to questions table
				if($result_1=mysqli_query($con,$query_1))
				{
					//executing query_2 to question skills table
					if($result_2=mysqli_query($con,$query_2))
					{
						//executing query_3 to question_majors 
						if($result_3=mysqli_query($con,$query_3))
						{
							//fetching result first result set
							if($result_array_1=mysqli_fetch_array($result_1))
							{							
								$user_id=$result_array_1['user_id'];
								$_SESSION['q_user_id']=$user_id;
								$title=$result_array_1['title'];
								$init_bounty=$result_array_1['bounty'];
								$_SESSION['init_bounty']=$init_bounty;
                                //getting date,time,day when msg has been sent by sender
                                $parenttime = $result_array_1['due_date_time'];
                                $timestamp=strtotime($parenttime);
                                $deadline = date('j-n-Y',$timestamp);
                                
								
								$file=$result_array_1['file'];
								$description=$result_array_1['description'];
								$query_4="select user_name from profiles where user_id='$user_id'";
								mysqli_free_result($result_1);
								if($result_4=mysqli_query($con,$query_4))
								{
									$result_array_4=mysqli_fetch_array($result_4);
									$user_name=$result_array_4['user_name'];
									mysqli_free_result($result_4);
								}
							}	
							//fetching second result set
							if($result_array_2=mysqli_fetch_array($result_2))
							{
								$skills=$result_array_2['question_skills'];
								mysqli_free_result($result_2);
							}
							else
							{
								$skills='';
							}
							//fetching third result set
							if($result_array_3=mysqli_fetch_array($result_3))
							{
								$major=$result_array_3['question_majors'];
								mysqli_free_result($result_3);
							}
							else
							{
								$major='';
							}
						}		
					}
				}
				else
				{
					die('Fetching error:'.mysqli_error($con));
				}
			
			}
			else
			{
				die('Question not selected properly !!!');
			}
			
			//download script for the attachment
			if(isset($_REQUEST['d_file']))
			{				
				$filename=$_REQUEST['d_file'];
				$file_parts = pathinfo($filename);
				$file="$filename";
				$len = filesize($file);						// Calculate File Size
				ob_clean();
				switch($file_parts['extension'])
				{
					case "jpg":
								$type='image/jpg';			//image file
					break;
				
					case "pdf":
								$type='application/pdf';	//pdf
					break;
					
					case "html":
								$type='text/html';			//html files
					break;
					case "zip" :
								$type='application/zip';	//zip file
					break;
					case txt:
								$type='text/plain';			//text file
					break;
					case "": 								#Handle file extension for files ending in '.'
					case NULL: 								#Handle no file extension
					break;									 
					
					default:
								$type='application/pdf';	//default pdf format
					break;
				}		
				header("Pragma: public");
				header("Expires: 0");
				header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
				header("Cache-Control: public"); 
				header("Content-Type:'$type'");
				header("Content-Description: File Transfer");
				$header="Content-Disposition: attachment; filename=$filename;"; // Send File Name
				header($header );
				header("Content-Transfer-Encoding: binary");
				header("Content-Length: ".$len); 								// Send File Size
				@readfile($file);		
			}
			
			//database insertion script
			if((isset($_POST['submit']))||(isset($_POST['m_submit'])))
			{		
				$abstract=mysqli_real_escape_string($con,$_POST['abstract_content']);	
				$solution=mysqli_real_escape_string($con,$_POST['solution_content']);
				$_SESSION['abstract']=$abstract;
				$_SESSION['solution']=$solution;				
				/*if the bounty is not set by the user, then the
				 *the script assign the bounty set by the questioner 
				 *as final bounty
				 */	
				if($_POST['bounty']=='')
				{
					$bounty=mysqli_real_escape_string($con,$_SESSION['init_bounty']);
				}
				else
				{
					$bounty=mysqli_real_escape_string($con,$_POST['bounty']);
				}		
				$SESSION['bounty']=$bounty;
				$question_id=$_SESSION['question_id'];
				$user_id=$login_session;		
				if(!($_FILES["file"]["error"] > 0))
				{
					$temp = explode(".", $_FILES["file"]["name"]);
					$extension = end($temp);
					$query="select max(answer_id)+1 as max_id from answers";								
					if($result=mysqli_query($con,$query))
					{
						$result_array=mysqli_fetch_array($result);
						$answer_id=$result_array['max_id'];
						$file_upload=$answer_id.'.'.$extension;
					}
					else
					{
						echo "file name fetching error :".mysqli_error($con);
					}
				}
				else
				{
					$file_upload='';
				}					
				$query="insert into answers(user_id,question_id,answer_id,bounty,abstract,solution,date_time,file)values('$user_id','$question_id','','$bounty','$abstract','$solution',now(),'$file_upload')";
				if(!mysqli_query($con,$query))
				{
					echo "<script>alert('Error occured.Please try again');</script>";			
				}
				else
				{
                    $query="update questions set questions.status='Answered' where questions.question_id=$question_id";
                    if(!mysqli_query($con,$query))
                    {
                        echo "<script>alert('Error occured.Please try again');</script>";			
                    }
                    else
                    {
                        echo "<script>alert('Your answer has been saved successfully ');</script>";
                        move_uploaded_file($_FILES["file"]["tmp_name"],"../uploads/answers_files/" .$file_upload);
                        echo "<script>window.location.href='./view_question.php?question_id=$question_id';</script>";
                    }
					
				}
			}
?>
<!DOCTYPE html>
<html>
	<head>
        <link rel="shortcut icon" href="./images/logo.png">
		<title>View Question</title>
		<?php
			include_once './include/head.php';
		?>
		<style>
			.popper
			{
				cursor:pointer;	
			}
			.popbox 
			{		
				dislpay:none;
				font-size:13px;			
				text-align:center;
				position: absolute;
				z-index: 99999;
				width: 160px;
				height:60px;
				padding-top:20px;
				background-color:#EEE;
				color: #000;
				border: 1px solid #999;
				margin: 0px;
				-webkit-box-shadow: 0px 0px 5px 0px rgba(164, 164, 164, 1);
				box-shadow: 0px 0px 5px 0px rgba(164, 164, 164, 1);
				font-family: Century Gothic, sans-serif;
			}
			.wrapper 
			{			
				position:relative;
				margin-bottom:40px;
				margin-top:10px;
				left:0;
				right:0;
				margin:auto;
				background-image:url(images/form-bg.png);
				width:85%;
				padding-top:40px;
				padding-bottom:40px;
				height:auto;
				margin-top:2%;
			}
			#question_box 
			{		
				position:relative;
				width:90%;
				min-height:100px;
				margin:auto;
				background-color:#FFFFFF;
				padding-bottom:20px;
				box-shadow: #000 0 0px 10px -1px;
				-webkit-box-shadow: #000 0 0px 10px -1px;	
			}
			.answer_box 
			{				
				display:none;
				background-color:#FFFFFF;
				position:relative;
				width:90%;
				height:880px;
				margin:auto;
				margin-top:2%;
				box-shadow: #000 0 0px 10px -1px;
				padding-top:2%;
				-webkit-box-shadow: #000 0 0px 10px -1px;
			}
			#qsSection_1 
			{
				position:absolute;
				width:135px;
				height:248px;
				overflow:auto;
				text-align:left;
				left: 5px;
				top: 69px;
				padding-left:38px;
			}
			#qsSection_middle 
			{
				position:absolute;
				left: 169px;
				top: 69px;
				width:391px;
				height:247px;
				padding-right:10px;
			}
			#qsSection_2 
			{
				background-color:#030303;
				position:absolute;
				width:754px;
				min-height:150px;
				height:auto;
				left: 23px;
				top: 316px;
				overflow:auto;
			}
			#desc_col
			{		
				height:200px;
				padding-top: 2%;
			}
			.sp1,.sp2,#sp3
			{
				padding-top:1%;
				padding-bottom:1%;
			}
			.sp1,.sp2
			{	   
				max-width:400px;
				font-weight:bold;
				font-family: Century Gothic, sans-serif;;
				word-wrap: break-word;
			}
			.sp2
			{
				max-width:350px;
				padding-left:4px;
				font-weight:bold;
				color: #444;
						
			}
			.sp1
			{   	
				color: #222;	
				padding-right:4px;		
			}
			#sp3
			{	
				display:block;
				text-align:justify;
				word-wrap:break-word;
                word-break:break-all;
				width: 96%;
				min-height:100px;
				max-height:500px;
				line-height:25px;	
				padding-right:5px;
				overflow:auto;
			}
			.heading 
			{
				position:relative;
				left:0px;
				top:20px;
				margin:auto;
				width:800px;
				height:90px;
			}
			#inner_wrapper
			{	
				position:relative;
				width:100%;
			}
			p
			{
				min-height:100px;
				max-height:400px;
				overflow:auto;
			}
			.button
			{
				font-family: Century Gothic, sans-serif;
				font-size:15px;
				width:30%;
				height:80%;	
				background-color: #E9E9E9;
				color:#888;
				border:solid 2px #999;
				font-weight:bold;
				cursor:pointer;
				left:0;
				right:0;
				margin:auto;
			}
			.button:active
			{
				background-color:#A5A5A5;
				color:#FFFFFF;
				border-color:#ABABAB;
			}
			.button:focus,.button:hover
			{
				border:solid 3px #555;
				color:#555;
				text-shadow: 0px 2px 3px rgba(255,255,255,0.3);
			}
			.upload
			{
				position:absolute;
				left: 4%;
				bottom: 12%;
				height: 69%;
				width: 19%;
				z-index:2;
				-moz-opacity:0;
				filter:alpha(opacity: 0);
				opacity: 0;
				cursor:pointer;
			}
			.custom_button
			{
				position:absolute;
				left: 4%;
				bottom: 12%;
				height: 69%;
				width: 19%;z-index:1;
				background-color: #E9E9E9;
				color:#888;
				border:solid 2px #999;
				font-weight:bold;
				font-size:15px;
				z-index:0;
			}
			textarea::-webkit-input-placeholder 
			{
				padding:20px;
				color: #999;
				font-size:16px;
				font-weight:bold;
				font-family: Century Gothic, sans-serif;
			}
			input::-webkit-input-placeholder 
			{
				padding-top:4px;
				color: #999;
				font-size:12px;
				font-weight:bold;
			}
			/* Firefox 18- */
			textarea:-moz-placeholder 
			{ 
				padding:20px;
				color: #999;
				font-family: Century Gothic, sans-serif;
				font-size:16px;
				font-weight:bold;
			}
			input:-moz-placeholder  
			{
				text-align:center;
				color: #999;
				font-family: Century Gothic, sans-serif;
				font-size:12px;
				font-weight:bold;
			}
			/* Firefox 19+ */
			textarea::-moz-placeholder 
			{  
				padding:20px;
				color: #777;
				font-family: Century Gothic, sans-serif;
				font-size:16px;
				font-weight:bold;
			}
			input::-moz-placeholder  
			{
				text-align:center;
				color: #777;
				font-family: Century Gothic, sans-serif;
				font-size:12px;
				font-weight:bold;
			}
			textarea:-ms-input-placeholder 
			{  
				color: #999;
				font-family: Century Gothic, sans-serif;
				font-size:16px;
				font-weight:bold;
			}
			input:-ms-input-placeholder   
			{
				padding-left:10px;
				color: #999;
				font-family: Century Gothic, sans-serif;
				font-size:12px;
				font-weight:bold;
			}
			#abstract
			{
				position:absolute;
				left:0;
				right:0;
				margin:auto;
				width:95%;
				height:10%;
				top:23px;
			}
			#solution 
			{
				position: absolute;
				width: 93.3%;
				height: 70%;
				left: 0;
				top: 161px;
				border-color: #200;
				right: 0;
				margin: auto;
			}
			#solution_inner 
			{
				position:absolute;
				width:99.8%;
				height:9%;
				left:0;
				right:0;
				margin:auto;				
				top: 86%;
				border:solid 1px #AAA;
				white-space:normal;
				-moz-box-shadow:0 1px 0 #fff inset;
				-webkit-box-shadow:0 1px 0 #fff inset;
				box-shadow:0 1px 0 #fff inset;
				background:#cfd1cf;
				background-image:-webkit-gradient(linear,left top,left bottom,from(#f5f5f5),to(#cfd1cf));
				background-image:-moz-linear-gradient(top,#f5f5f5,#cfd1cf);
				background-image:-webkit-linear-gradient(top,#f5f5f5,#cfd1cf);
				background-image:-o-linear-gradient(top,#f5f5f5,#cfd1cf);
				background-image:-ms-linear-gradient(top,#f5f5f5,#cfd1cf);
				background-image:linear-gradient(top,#f5f5f5,#cfd1cf);
				filter:progid:DXImageTransform.Microsoft.gradient(gradientType=0,startColorstr='#f5f5f5',endColorstr='#cfd1cf');
			}
			#solution_submit 
			{		
				position:absolute;
				width:94%;
				height:55px;
				left: 0;
				right:0;
				margin:auto;
				top: 89%;
			}
			.bounty
			{
				position:absolute;
				left: 76%;
				bottom: 12%;
				height: 69%;
				width: 19%;
				z-index:1;
				text-align:center;
				color: #000;
				font-family: Century Gothic, sans-serif;
				font-size:18px;
				font-weight:bold;
			}
			#solution_content
			{
				height: 88%;
				width: 99.8%;
				
			}
			.abstract_content
			{
				height: 85px;
				width:97%;
				max-width:97%;
				max-height:85px;
				position:absolute;
				left:0;
				right:0;
				margin:auto;
				padding:10px;
				color: #222;
				font-family: Century Gothic, sans-serif;
				font-size:14px;
				font-weight:bold;
			
			}
			#answer_pop1
			{
				position:absolute;
				left: 19%;
				top:37%;
				color: #999;
				z-index:3;
				border-radius:2px;
				font-weight:bold;
			}
			#answer_pop2
			{
				position:absolute;
				top:22px;
				color: #999;
				border-radius:2px;
				left: 810px;
				font-weight:bold;
			}
			.popper1 
			{	cursor:pointer;
				color: white;	
				background-color:#CCC;
				border-radius:3px;
				margin-left:10px;	
			}
			#file_name 
			{
				display:none;
				z-index:3;
				position:absolute;
				width:auto;
				height:auto;
				left: 25%;
				top: 35%;
				border-radius:3px;
				background-color:#FFF;	
				padding:2px;
			}
			.one
			{
				color:#000;
				height: auto;
				width: 30px;
				font-size:10px;
				padding-right:5px;
				padding-left:4px;
				font-weight:bold;
				text-align:center;
				float:left;
				overflow:hidden;
				text-overflow:ellipsis;
				max-height:25px;
			}
			
			.two
			{
				cursor:pointer;
				color:#BB0000;
				width: auto;
				padding-top:1px;
				padding-right:6px;
				height: auto;
				font-size:10px;
				font-weight:bold;
				text-align:left;
				float:left;
				padding-left:6px;
			}
			.link
			{
				cursor:pointer;
				background-color:#EEE;
				border-radius:5px;
				font-weight:bold;
			}
			.warning 
			{
				position:absolute;
				width:442px;
				height:19px;
				font-size:14px;
				font-weight:bold;
				text-align:center;
				color:#550000;
				left: 0;
				right: 0;
				margin: auto;
				top: 11%;
			}
			.warning_2 
			{
				position:absolute;
				width:400px;
				height:22px;
				font-size:18px;
				font-weight:bold;
				text-align:center;
				color:#550000;
				left: 0;
				top: -62%;
				right: 0;
				margin: auto;
			}
			.warning_3 
			{
				position:absolute;
				position: absolute;
				width: 20%;
				height: 2%;
				z-index: 1;
				left: 75.9%;
				top: 92%;
				font-size:9px;
				font-stretch:extra-expanded;
				font-weight:bold;
				text-align:center;
				color:#550000;
			}
			#title_bar 
			{
				background-image:url(images/bg_form.jpg);
				position:absolute;
				width:100%;
				height:49px;
				left: 0px;
				top: 0px;
				color: #181818;
				font-family: Century Gothic, sans-serif;;
				font-weight:bold;
				text-align:center;
			}
			#title_bar h2
			{
				position:relative;
				top:8px;
				
			}
			.question_container
			{
				padding-left:40px;
				padding-right:30px;
				padding-top:10px;
			}
			.user_link
			{
				text-decoration:none;
			}
			
			/*styles for mobile mode*/
			#mwrapper
			{
				top:10px;
				border-radius:3px;
				padding-top:10px;
				padding-bottom:10px;
				font-family: Century Gothic, sans-serif;;
				width:94%;				
			}
			#mprev_answer
			{
				top:10px;
				border-radius:3px;
				padding-top:10px;
				padding-bottom:10px;
				font-family: Century Gothic, sans-serif;;
				width:94%;
			}
			#mquestion_box
			{
				position:relative;
				width:96%;
				min-height:100px;
				margin:auto;
				background-color:#FFFFFF;
				padding-bottom:46px;
				box-shadow: #000 0 0px 10px -1px;
				-webkit-box-shadow: #000 0 0px 10px -1px;	
			}
			#mquestion_title
			{	position: relative;
				background-image:url(images/bg_form.jpg);
				width: 100%;
				height: 39px;
				border-bottom-color:#000000;
				text-align:center;
				padding-top:2%;
			}
			#mquestion_content
			{
				position:relative;
				font-size:12px;
			}
			#mquestion_section_1
			{
				width: 150px;
				padding-left: 5%;
				padding-top: 2%;
			}
			.msection_1
			{
				color:#222;
				font-weight:bold;
				padding:1% 0% 1% 0%;
			}
			.msection_2
			{
				color:#444;
				font-weight:bold;
				max-width:335px;
				padding:1% 0% 1% 2%;
				word-wrap:break-word;
			}
			#mquestion_description
			{
				padding-top:3%;
				position:relative;
				left:0;
				right:0;
				margin:auto;
				width:90%;
			}
			#mdesc_title
			{
				padding-bottom:10px;
			}
			#mbutton_div
			{
				width:90%;
				left:0;
				right:0;
				margin:auto;
				margin-top: 5px;
				height: 32px;
				position:relative;
			}
			#mpost_button
			{
				position: absolute;
				right: 0px;
				margin: auto;
				left: 0px;
				height: 32px;
				top:6px;
			}
			#manswer_box
			{
				display:none;
				position:relative;
				width:96%;
				margin:auto;			
				min-height:300px;
				background-color:#FFFFFF;
				box-shadow: #000 0 0px 10px -1px;
				-webkit-box-shadow: #000 0 0px 10px -1px;
				padding:10px 0px;
				margin-top:2%;
			}
			#m_abstract
			{
				position: relative;
				margin: auto;
				width: 91%;
				min-height: 70px;
			}
			#m_abstract_content
			{
				left:0;
				right:0;
				margin:auto;
				width:100%;
				height:70px;
				max-height:70px;
				max-width:100%;
				min-height:70px;
				min-width:100%;
				padding:0px;
			}
			#m_solution
			{
				position: relative;
				width: 91%;
				min-height: 250px;
				margin: 21px auto 0px auto;	
				min-height:250px;		
			}
			#m_solution_content
			{
				left:0;
				right:0;
				margin:auto;
				width:100%;
				height:100%;
				max-height:100%;
				max-width:100%;
				min-height:100%;
				min-width:100%;
			}
			#m_inner_solution
			{
				width:91%;
				height:40px;
				position:relative;
				margin:auto;
				border:solid 1px #AAA;
				white-space:normal;
				-moz-box-shadow:0 1px 0 #fff inset;
				-webkit-box-shadow:0 1px 0 #fff inset;
				box-shadow:0 1px 0 #fff inset;
				background:#cfd1cf;
				background-image:-webkit-gradient(linear,left top,left bottom,from(#f5f5f5),to(#cfd1cf));
				background-image:-moz-linear-gradient(top,#f5f5f5,#cfd1cf);
				background-image:-webkit-linear-gradient(top,#f5f5f5,#cfd1cf);
				background-image:-o-linear-gradient(top,#f5f5f5,#cfd1cf);
				background-image:-ms-linear-gradient(top,#f5f5f5,#cfd1cf);
				background-image:linear-gradient(top,#f5f5f5,#cfd1cf);
				filter:progid:DXImageTransform.Microsoft.gradient(gradientType=0,startColorstr='#f5f5f5',endColorstr='#cfd1cf');
			}
			#m_editor
			{
				height:100%;
				width:100%;
			}
			#m_upload
			{
				position: absolute;
				left: 5%;
				width: 30%;
				z-index: 2;
				opacity: 0;
				cursor: pointer;
				height: 80%;
				top: 6px;
				bottom: 0;
				margin: auto;
			}
			#m_custom_button
			{
				position: absolute;
				left: 5%;
				width: 30%;
				z-index: 0;
				cursor: pointer;
				height: 80%;
				top: 0;
				bottom: 0;
				margin: auto;
			}
			#m_bounty
			{
				height: 67%;
				width: 30%;
				position: absolute;
				right: 5%;
				top: 0;
				bottom: 0;
				margin: auto;
				text-align:center;
				font-size:12px;
			}
			#m_submit
			{
				left:0;
				right:0;
				top:0;
				bottom:0;
				margin:auto;
				position:absolute;
				height:37px;
			}
			#m_bounty::-webkit-input-placeholder 
			{
				color: #999;
				font-size:12px;
				font-weight:bold;
				text-align:center;
				padding:0px;
			}
			#m_question_table
			{
				left: 4.9%;
				position: relative;
				text-align:left;
				top:10px;
			}
			#m_file_name
			{
				position:absolute;
				display:none;
				width:auto;
				height:auto;
				border-radius:3px;
				background-color:#FFF;	
				padding:2px;
			}
			#m_two
			{
				cursor:pointer;
				color:#BB0000;
				width: auto;
				padding-top:1px;
				padding-right:6px;
				height: auto;
				font-size:10px;
				font-weight:bold;
				text-align:left;
				float:left;
				padding-left:6px;
			}
			.prev_answers
			{
				position:relative;
				margin:auto;
				width:90%;
				padding:5px 12px;
				border: solid 2px #AAA;
				margin-bottom:15px;
				margin-top:15px;
				font-size:15pxl
			}
			#ans_image
			{
				padding: 6px 44px 0px 8px;
			}
			#ans_image img
			{
				width:70px;
				height:70px;
				box-shadow: #000 0 0px 10px -1px;
				-webkit-box-shadow: #000 0 0px 10px -1px;
				border-radius:50%;
				
			}
			.cart
			{
				 padding:1px 8px 1px 8px;
				 height: 24px;
				-moz-box-shadow:inset 0px 1px 0px 0px #ffffff;
				-webkit-box-shadow:inset 0px 1px 0px 0px #ffffff;
				box-shadow:inset 0px 1px 0px 0px #ffffff;
				background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #ededed), color-stop(1, #dfdfdf));
				background:-moz-linear-gradient(top, #ededed 5%, #dfdfdf 100%);
				background:-webkit-linear-gradient(top, #ededed 5%, #dfdfdf 100%);
				background:-o-linear-gradient(top, #ededed 5%, #dfdfdf 100%);
				background:-ms-linear-gradient(top, #ededed 5%, #dfdfdf 100%);
				background:linear-gradient(to bottom, #ededed 5%, #dfdfdf 100%);
				filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#ededed', endColorstr='#dfdfdf',GradientType=0);
				background-color:#ededed;
				-moz-border-radius:6px;
				-webkit-border-radius:6px;
				border-radius:3px;
				border:1px solid #CCC;
				display:inline-block;
				cursor:pointer;
				color:#777777;
				font-family:arial;
				text-decoration:none;
				text-shadow:0px 1px 0px #ffffff;
				font-weight:bold;
			}
			.cart:hover 
			{
				background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #6c7c7c), color-stop(1, #768d87));
				background:-moz-linear-gradient(top, #6c7c7c 5%, #768d87 100%);
				background:-webkit-linear-gradient(top, #6c7c7c 5%, #768d87 100%);
				background:-o-linear-gradient(top, #6c7c7c 5%, #768d87 100%);
				background:-ms-linear-gradient(top, #6c7c7c 5%, #768d87 100%);
				background:linear-gradient(to bottom, #6c7c7c 5%, #768d87 100%);
				filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#6c7c7c', endColorstr='#768d87',GradientType=0);
				background-color:#6c7c7c;
				border:1px solid #CCC;
				color:#FFF;
			}
			.cart-added{
				background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #6c7c7c), color-stop(1, #768d87));
				background:-moz-linear-gradient(top, #6c7c7c 5%, #768d87 100%);
				background:-webkit-linear-gradient(top, #6c7c7c 5%, #768d87 100%);
				background:-o-linear-gradient(top, #6c7c7c 5%, #768d87 100%);
				background:-ms-linear-gradient(top, #6c7c7c 5%, #768d87 100%);
				background:linear-gradient(to bottom, #6c7c7c 5%, #768d87 100%);
				filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#6c7c7c', endColorstr='#768d87',GradientType=0);
				background-color:#6c7c7c;
				border:1px solid #CCC;
				color:#FFF;
			}
			.cart:active 
			{
				position:relative;
				top:1px;
			}
			.warning,.warning_2,.warning_3{
				font-family:Century Gothic, sans-serif;
			}
		</style>
		<script src="./js/tinymce/js/tinymce/tinymce.min.js"></script>
		<script>
			$(document).ready(function()
			{
				$('.user_link').click(function()
				{
					var link_id="<?php echo $_SESSION['q_user_id'];?>"
					window.location.href='view_profile.php?user_id='+link_id;			
				});
				$(function()
				{
					var chk_user="<?php $temp=1;if($_SESSION['q_user_id']==$login_session)echo $temp;?>";
					if(chk_user==1)
					{
						$('#post_answer').remove();
						$('#mpost_button').remove();
						$('#mprev_answer').remove();
					}
				});

				//text editor function for desk top mode			
				tinymce.init(
				{
					selector:'textarea#solution_content',
					resize:false,
					statusbar:false,	
					height:'500px',
					menubar: "edit view",
					plugins: "textcolor link image print preview visualblocks visualchars fullscreen",
					Toolbar: "undo redo | forecolor backcolor | styleselect | bold italic |  alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image emoticons print",
					style_formats:
					[
						{
							title: "Headers",
							items: 
							[
								{title: "Header 1",format: "h1"},
								{title: "Header 2",format: "h2"},
								{title: "Header 3",format: "h3"},
								{title: "Header 4",format: "h4"},
								{title: "Header 5",format: "h5"},
								{title: "Header 6",format: "h6"}
							]
						},
						{
							title: "Inline",
							items: 
							[
								{title: "_Underline",icon: "underline",format: "underline"}, 
								{title: "Strikethrough",icon: "strikethrough",format: "strikethrough"}, 
								{title: "Superscript",icon: "superscript",format: "superscript"}, 
								{title: "Subscript",icon: "subscript",format: "subscript"}, 
								{title: "Code",icon: "code",format: "code"}
							]
						}, 
						{
							title: "Blocks",
							items: 
							[
								{title: "Paragraph",format: "p"}, 
								{title: "Blockquote",format: "blockquote"}, 
								{title: "Div",format: "div"}, 
								{title: "Pre",format: "pre"}
							]
						}, 
						{
							title: "Font Family",
							items: 
							[
								{title: 'Arial', inline: 'span', styles: { 'font-family':'arial'}},
								{title: 'Book Antiqua', inline: 'span', styles: { 'font-family':'book antiqua'}},
								{title: 'Comic Sans MS', inline: 'span', styles: { 'font-family':'comic sans ms,sans-serif'}},
								{title: 'Courier New', inline: 'span', styles: { 'font-family':'courier new,courier'}},
								{title: 'Georgia', inline: 'span', styles: { 'font-family':'georgia,palatino'}},
								{title: 'Helvetica', inline: 'span', styles: { 'font-family':'helvetica'}},
								{title: 'Impact', inline: 'span', styles: { 'font-family':'impact,chicago'}},
								{title: 'Open Sans', inline: 'span', styles: { 'font-family':'Open Sans'}},
								{title: 'Symbol', inline: 'span', styles: { 'font-family':'symbol'}},
								{title: 'Tahoma', inline: 'span', styles: { 'font-family':'tahoma'}},
								{title: 'Terminal', inline: 'span', styles: { 'font-family':'terminal,monaco'}},
								{title: 'Times New Roman', inline: 'span', styles: { 'font-family':'times new roman,times'}},
								{title: 'Verdana', inline: 'span', styles: { 'font-family':'Verdana'}}
							]
						},
						{
							title: "Font Size", items: 
							[
								{title: '8pt', inline:'span', styles: { fontSize: '12px', 'font-size': '8px' } },
								{title: '10pt', inline:'span', styles: { fontSize: '12px', 'font-size': '10px' } },
								{title: '12pt', inline:'span', styles: { fontSize: '12px', 'font-size': '12px' } },
								{title: '14pt', inline:'span', styles: { fontSize: '12px', 'font-size': '14px' } },
								{title: '16pt', inline:'span', styles: { fontSize: '12px', 'font-size': '16px' } }
							]
						}
					]
				});
				
				//text editor for mobile mode
				tinymce.init(
				{
					selector:'textarea#m_solution_content',
					resize:false,
					statusbar:false,
					height:'200px',
					menubar: "edit view",
					plugins: "textcolor link image print emoticons preview visualblocks visualchars fullscreen",
					Toolbar: "undo redo | forecolor backcolor | styleselect | bold italic |  alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image emoticons print",
					style_formats:
					[
						{
							title: "Headers",
							items: 
							[
								{title: "Header 1",format: "h1"},
								{title: "Header 2",format: "h2"},
								{title: "Header 3",format: "h3"},
								{title: "Header 4",format: "h4"},
								{title: "Header 5",format: "h5"},
								{title: "Header 6",format: "h6"}
							]
						},
						{
							title: "Inline",
							items: 
							[
								{title: "_Underline",icon: "underline",format: "underline"}, 
								{title: "Strikethrough",icon: "strikethrough",format: "strikethrough"}, 
								{title: "Superscript",icon: "superscript",format: "superscript"}, 
								{title: "Subscript",icon: "subscript",format: "subscript"}, 
								{title: "Code",icon: "code",format: "code"}
							]
						}, 
						{
							title: "Blocks",
							items: 
							[
								{title: "Paragraph",format: "p"}, 
								{title: "Blockquote",format: "blockquote"}, 
								{title: "Div",format: "div"}, 
								{title: "Pre",format: "pre"}
							]
						}, 
						{
							title: "Font Family",
							items: 
							[
								{title: 'Arial', inline: 'span', styles: { 'font-family':'arial'}},
								{title: 'Book Antiqua', inline: 'span', styles: { 'font-family':'book antiqua'}},
								{title: 'Comic Sans MS', inline: 'span', styles: { 'font-family':'comic sans ms,sans-serif'}},
								{title: 'Courier New', inline: 'span', styles: { 'font-family':'courier new,courier'}},
								{title: 'Georgia', inline: 'span', styles: { 'font-family':'georgia,palatino'}},
								{title: 'Helvetica', inline: 'span', styles: { 'font-family':'helvetica'}},
								{title: 'Impact', inline: 'span', styles: { 'font-family':'impact,chicago'}},
								{title: 'Open Sans', inline: 'span', styles: { 'font-family':'Open Sans'}},
								{title: 'Symbol', inline: 'span', styles: { 'font-family':'symbol'}},
								{title: 'Tahoma', inline: 'span', styles: { 'font-family':'tahoma'}},
								{title: 'Terminal', inline: 'span', styles: { 'font-family':'terminal,monaco'}},
								{title: 'Times New Roman', inline: 'span', styles: { 'font-family':'times new roman,times'}},
								{title: 'Verdana', inline: 'span', styles: { 'font-family':'Verdana'}}
							]
						},
						{
							title: "Font Size", items: 
							[
								{title: '8pt', inline:'span', styles: { fontSize: '12px', 'font-size': '8px' } },
								{title: '10pt', inline:'span', styles: { fontSize: '12px', 'font-size': '10px' } },
								{title: '12pt', inline:'span', styles: { fontSize: '12px', 'font-size': '12px' } },
								{title: '14pt', inline:'span', styles: { fontSize: '12px', 'font-size': '14px' } },
								{title: '16pt', inline:'span', styles: { fontSize: '12px', 'font-size': '16px' } }
							]
						}
					]
				});	
				
				//answer section slide for desktop
				$("#post_answer,#mpost_button").click(function()
				{
					$(".answer_box").slideToggle("slow");
                    $(".abstract_content").focus();

                    
				});
				
				//answer section slide for mobile
				$("#mpost_button").click(function()
				{
					$("#manswer_box").slideToggle("slow");
                    $(".abstract_content").focus();
                    
                    
//                    $('#mquestion_box').animate({
//                        'marginTop' : "-500px" //moves up
//                    });
				});	
				
				//custom upload button events
				$(".upload").mousedown(function()
				{
					$(".custom_button").css("border-style","inset");
					$(".custom_button").css("background-color","#A5A5A5");  
					$(".custom_button").css("border","solid 2px #000");  
					$(".custom_button").css("color","#FFF");         
				});		
				$(".upload").mouseup(function()
				{
					$(".custom_button").css("border-style","outset");
					$(".custom_button").css("background-color","#E9E9E9");
					$(".custom_button").css("border","solid 2px #999");
					$(".custom_button").css("color","#888");     
				});	
					
				//pop up message events
				$(function() 
				{
					var moveLeft = 0;
					var moveDown = 0;	
					$('a.popper').hover(function(e) 
					{
						var target = '#' + ($(this).attr('data-popbox'));
						$(target).show();
						moveLeft = $(this).outerWidth();
						moveDown = ($(target).outerHeight() / 2);
					}, 
					function() 
					{
						var target = '#' + ($(this).attr('data-popbox'));
						$(target).hide();
					});
					$('a.popper').mousemove(function(e) 
					{
						var target = '#' + ($(this).attr('data-popbox'));      
						leftD = e.pageX + parseInt(moveLeft);
						maxRight = leftD + $(target).outerWidth();
						windowLeft = $(window).width() - 40;
						windowRight = 0;
						maxLeft = e.pageX - (parseInt(moveLeft) + $(target).outerWidth() + 20);         
						if(maxRight > windowLeft && maxLeft > windowRight)
						{
							leftD = maxLeft;
						}
						topD = e.pageY - parseInt(moveDown);
						maxBottom = parseInt(e.pageY + parseInt(moveDown) + 20);
						windowBottom = parseInt(parseInt($(document).scrollTop()) + parseInt($(window).height()));
						maxTop = topD;
						windowTop = parseInt($(document).scrollTop());
						if(maxBottom > windowBottom)
						{
							topD = windowBottom - $(target).outerHeight() - 20;
						} 
						else if(maxTop < windowTop)
						{
							topD = windowTop + 20;
						} 
						$(target).css('top', topD).css('left', leftD);     
					});	 
				});
				
				/*file name visibility events*/
				var flag_4=true;
				
				//desktop mode
				$(".upload").change(function()
				{
					var file_name=$(".upload").val();
					var size=(this.files[0].size)/(1024*1024);
					//var type=this.files[0].type;
					var re = /(\.doc|\.jpg|\.jpeg|\.bmp|\.gif|\.png|\.docx|\.pdf|\.rar|\.zip|\.css|\.html|\.js|\.xls|\.txt)$/i;
					
					if(!re.exec(file_name))	
					{
						
						$('#toast-container').css('background', 'none repeat scroll 0 0 #f85959').fadeIn(2000);
						$('.toast-message').html('Please Upload doc,docx,pdf,png,jpeg,txt,zip files only');
						$('#toast-container').fadeOut(3000);
			         	$('.upload').val('');
						flag_4=false;
					}
					else if(size > 25){
						$('#toast-container').css('background', 'none repeat scroll 0 0 #f85959').fadeIn(2000);
						$('.toast-message').html('Please Upload file with less than 25 MB');
						$('#toast-container').fadeOut(3000);
						$('.upload').val('');
					}
					else
					{	
						$("#file_name").fadeIn("fast");
						$(".one").text(file_name);
						flag_4=true;		
					}
				});
				$(".two").click(function()
				{
					$("#file_name").fadeOut("fast");
					$(".upload").val('');
					
				});
				
				//mobile mode
				$("#m_upload").change(function()
				{
					var file_name=$("#m_upload").val();
					var size=(this.files[0].size)/(1024*1024);
					var re = /(\.doc|\.jpg|\.jpeg|\.bmp|\.gif|\.png|\.docx|\.pdf|\.rar|\.zip|\.css|\.html|\.js|\.xls|\.txt)$/i;
					
					if(!re.exec(file_name))	
					{
						
						$('#toast-container').css('background', 'none repeat scroll 0 0 #f85959').fadeIn(2000);
						$('.toast-message').html('Please Upload doc,docx,pdf,png,jpeg,txt,zip files only');
						$('#toast-container').fadeOut(3000);
			         	$('#m_upload').val('');
						flag_4=false;
					}
					else if(size > 25){
						$('#toast-container').css('background', 'none repeat scroll 0 0 #f85959').fadeIn(2000);
						$('.toast-message').html('File size should be less than 25 MB');
						$('#toast-container').fadeOut(3000);
						$('#m_upload').val('');
					}
					else
					{
						$("#m_file_name").fadeIn("fast");
						$(".one").text(file_name);
						flag_4=true;
					}	
				});
				$("#m_two").click(function()
				{
					$("#m_file_name").fadeOut("fast");
					$("#m_upload").val('');
				});
				
				//file download script
				$(".link").click(function()
				{
					var file=$(this).text();
					window.location="view_question.php?d_file="+file;
				});
					
				var bounty=$(".bounty").val();
				var abstract=$(".abstract_content").val();
				var ab_len=ab_len=$(".abstract_content").val().length;
				var file=$('#upload').val();
				
				/**validation section **/
				
				/*desktop mode*/
				
				//abstratct
				$(".abstract_content").blur(function()
				{
					abstract=$(".abstract_content").val();
					ab_len=$(".abstract_content").val().length;				
					if((ab_len<25)&& ab_len!='')
					{
						if(ab_len<25)
						{
							$(".warning").text("Too small abstract (minimum 25 charactors) !!!");
							flag_1=false;
						}
					}
					else
					{
						$(".warning").text('');
						flag_1=true;
					}
				});
					
				//bounty 	
				$(".bounty").blur(function()
				{			
					bounty=$(".bounty").val();
					if(!$.isNumeric(bounty) && bounty!='')
					{
						$(".bounty").css("border","solid 2px #AA0000");
						$(".warning_3").text("Invalid bounty");
						flag_2=false;
					}
					else if(bounty>200  && bounty!='')
					{
						$(".bounty").css("border","solid 2px #AA0000");
						$(".warning_3").text("Bounty exceeds the maximum(200$)");
						flag_2=false;
					}
					else if(bounty<1  && bounty!='')
					{
						$(".bounty").css("border","solid 2px #AA0000");
						$(".warning_3").text("Bounty below the minimum(1$)");
						flag_2=false;
					}
					else
					{
						$(".bounty").css("border","solid 1px #BBB");
						$(".warning_3").text("");
						flag_2=true;
					}	
				});
					
				//form validation
				$('#answer_form').submit(function(e)
				{	
					var solution=tinymce.get('solution_content').getContent();
					$('<input type="hidden" name="solution_content" value="'+solution+'" >').appendTo('#answer_form');	
						
					//abstract
					if(ab_len=='' || ab_len<25)
					{
						if(ab_len=='')
						{
							$(".warning").text("abstract should not be empty !!!");
							flag_1=false;
						}
						else(ab_len<25)
						{
							$(".warning").text("Too small abstract (minimum 25 charactors) !!!");
							flag_1=false;
						}
						
					}
					else
					{
						$(".warning").text('');
						flag_1=true;
					}		
						
					//bounty
					if(!$.isNumeric(bounty) && bounty!='')
					{
						$(".bounty").css("border","solid 2px #AA0000");
						$(".warning_3").text("Invalid bounty");
						flag_2=false;
					}
					else if(bounty>200  && bounty!='')
					{
						$(".bounty").css("border","solid 2px #AA0000");
						$(".warning_3").text("Bounty exceeds the maximum(200$)");
						flag_2=false;
					}
					else if(bounty<1  && bounty!='')
					{
						$("#bounty").css("border","solid 2px #AA0000");
						$(".warning_3").text("Bounty below the minimum(1$)");
						flag_2=false;
					}
					else
					{
						$(".bounty").css("border","solid 1px #BBB");
						$(".warning_3").text("");
						flag_2=true;
					}	
						
					//solution content
					if(solution.length<3)
					{
						$(".warning_2").text("Enter your solution !!!");
						flag_3=false;
					}
					else if(solution.length<55)
					{
						$(".warning_2").text("Too small solution (minimum 50characters) !!!");
						flag_3=false;
					}			
	
					else
					{
						$(".warning_2").text("");
						flag_3=true;						
					}
						
					//re-direct blocking in case of validation fails
					if(!(flag_1==true && flag_2==true && flag_3==true && flag_4==true))
					{
						e.preventDefault();						
						$('#toast-container').css('background', 'none repeat scroll 0 0 #f85959').fadeIn(2000);
						$('.toast-message').html('Something went wrong');
						$('#toast-container').fadeOut(3000);
					}
				});
				
				/*mobile mode*/
				var bounty=$("#m_bounty").val();
				var abstract=$("#m_abstract_content").val();
				var ab_len=ab_len=$("#m_abstract_content").val().length;
				var file=$('#m_upload').val();		
					
				//abstract validation
				$("#m_abstract_content").blur(function()
				{
					abstract=$("#m_abstract_content").val();
					ab_len=$("#m_abstract_content").val().length;				
					if((ab_len<25 || ab_len>300)&& ab_len!='')
					{
						if(ab_len<25)
						{
							$(".warning").text("Too small abstract (minimum 25 charactors) !!!");
							flag_1=false;
						}
						else
						{
							$(".warning").text("Too large abstract (maximum 300 charactors) !!!");
							flag_1=false;	
						}
					}
					else
					{
						$(".warning").text('');
						flag_1=true;
					}
				});
					
				//bounty validation	
				$("#m_bounty").blur(function()
				{			
					bounty=$("#m_bounty").val();
					if(!$.isNumeric(bounty) && bounty!='')
					{
						$("#m_bounty").css("border","solid 2px #AA0000");
						$(".warning_3").text("Invalid bounty");
						flag_2=false;
					}
					else if(bounty>200  && bounty!='')
					{
						$("#m_bounty").css("border","solid 2px #AA0000");
						$(".warning_3").text("Bounty exceeds the maximum(200$)");
						flag_2=false;
					}
					else if(bounty<1  && bounty!='')
					{
						$("#m_bounty").css("border","solid 2px #AA0000");
						$(".warning_3").text("Bounty below the minimum(1$)");
						flag_2=false;
					}
					else
					{
						$("#m_bounty").css("border","solid 1px #BBB");
						$(".warning_3").text("");
						flag_2=true;
					}	
				});
					
				//form validation
				$('#m_answer_form').submit(function(e)
				{	
					solution=tinymce.get('m_solution_content').getContent();	
					$('<input type="hidden" name="solution_content" value="'+solution+'" >').appendTo('#m_answer_form');	
						
					//abstract
					if(ab_len=='' || ab_len<25 || ab_len>300)
					{
						$("#m_abstract_content").css("border","solid 2px #AA0000");
						if(ab_len=='')
						{
							$(".warning").text("abstract should not be empty !!!");
							flag_1=false;
						}
						else if(ab_len<25)
						{
							$(".warning").text("Too small abstract (minimum 25 charactors) !!!");
							flag_1=false;
						}
						else
						{
							$(".warning").text("Too large abstract (maximum 300 charactors) !!!");
							flag_1=false;	
						}
					}
					else
					{
						$("#m_abstract_content").css("border","solid 1px #BBB");
						$(".warning").text('');
						flag_1=true;
					}		
						
					//bounty
					if(!$.isNumeric(bounty) && bounty!='')
					{
						$("#m_bounty").css("border","solid 2px #AA0000");
						$(".warning_3").text("Invalid bounty");
						flag_2=false;
					}
					else if(bounty>200  && bounty!='')
					{
						$("#m_bounty").css("border","solid 2px #AA0000");
						$(".warning_3").text("Bounty exceeds the maximum(200$)");
						flag_2=false;
					}
					else if(bounty<1  && bounty!='')
					{
						$("#m_bounty").css("border","solid 2px #AA0000");
						$(".warning_3").text("Bounty below the minimum(1$)");
						flag_2=false;
					}
					else
					{
						$("#m_bounty").css("border","solid 1px #BBB");
						$(".warning_3").text("");
						flag_2=true;
					}	
						
					//solution content
					if(solution.length<3)
					{
						$(".warning_2").text("Enter your solution !!!");
						flag_3=false;
					}
					else if(solution.length<55)
					{
						$(".warning_2").text("Too small solution (minimum 50characters) !!!");
						flag_3=false;
					}			
					else
					{
						$(".warning_2").text("");
						flag_3=true;						
					}
						
					//re-direct blocking in case of validation fails
					if(!(flag_1==true && flag_2==true && flag_3==true && flag_4==true))
					{
						e.preventDefault();
						if(flag_4==false)
						{
							
						}
					}
					});
					
					// cart function checking
					$('.cart').click(function()
					{
						if($(this).text()=='View cart'){
							var check=confirm('Do you want to check out with your selected answers ?');
							if(check==true){
								window.location='cart.php';
							}
						}
						else if($(this).text()=='View answer & Rating'){
							answer_id=$(this).attr('data');
							window.location='view_answer.php?aid='+answer_id;							
						}
						else if($(this).text()=='Modify Answer'){
							answer_id=$(this).attr('data');
							window.location='update_answer.php?answer_id='+answer_id;							
						}
						else{
							var answer_id=$(this).attr('data');	
							var id=$(this).attr('id');
							$.ajax({
										url:'query.php',
										type:'post',
										data:
										{
											type:'17',
											answer_id:answer_id,
										},
										success:function(data){
											if(data=='success'){
												$('#'+id+'').text('View cart');
												$('#'+id+'').addClass('cart-added');
										}
											else{
												alert(data);
											}
											
										},
										error:function(){
											alert('error');
										}
							});
						}
					});
			});
		
		</script>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>
	<body>
		<?php
			include_once './include/menu.php';
		?>
		<div class="body">
			<div class="content">
				<div class="wrapper">
				<!--question box title -->
				<div id="question_box">
					<div id="title_bar">
						<h2>VIEW QUESTION</h2>
					</div>
					
					<!--question box contents -->
					<table   id="inner_wrapper" >
						<tr>
							<td width="748" height="45"></td>
						</tr>
						<tr>
							<td height="254" class="question_container">
									
								<!--question box inner layout table -->
								<table id="question_table" style="">
									<tr>
										<td class="sp1">Question By</td>
										<td class="sp1">:</td>
										<td class="sp2 user_link" style="cursor:pointer;"><?php if(isset($user_name))echo $user_name; ?></td>
									</tr>
									<tr>
										<td class="sp1">Title</td>
										<td class="sp1">:</td>
										<td class="sp2"><?php if(isset($title))echo $title; ?></td>
									</tr>
									<tr>
										<td class="sp1"><a class="popper" data-popbox="pop3">Major</a></td> 
										<td class="sp1">:</td>
										<td class="sp2"><?php if(isset($major))echo $major; ?></td>
									</tr>
									<tr>
										<td class="sp1"><a class="popper" data-popbox="pop4">Deadline</a></td> 
										<td class="sp1">:</td>
										<td class="sp2"><?php if(isset($deadline))echo $deadline; ?></td>
									</tr>
									<tr>
										<td class="sp1"><a class="popper" data-popbox="pop5">Bounty</a></td> 
										<td class="sp1">:</td>
										<td class="sp2"><?php if(isset($init_bounty))echo '$ '.$init_bounty; ?></td>
									</tr>
									<tr>
										<td class="sp1"><a class="popper" data-popbox="pop2">Skills</a></td> 
										<td class="sp1">:</td>
										<td class="sp2"><?php if(isset($skills))echo $skills; ?></td>
									</tr>                           
									<tr>
										<td class="sp1">Attachments</td> 
										<td class="sp1">:</td>
										<td class="sp2">
											<a class="popper" data-popbox="pop1">
												<?php 
													if( isset($file) && $file!='' ){
															echo "<a href='download.php?file_id='".$file."'><img src=\"./images/download.png\" style=\"width:19px; height:18px;\"/>".$file."</a>";
													}
												?>
											</a>	
										</td>
									</tr>
								</table>
								<!--question box inner layout table ends here -->			
										  
							</td>
						</tr>			
						
						<!--question description section -->
						<tr>
							<td  id="desc_col" class="question_container">
								<span class="sp1" style="display:block;"> Description :</span> 
								<span id="sp3" style="word-wrap:break-word;"><?php if(isset($description))echo $description; ?></span>
							</td>
						</tr>
						<!--question description ends here -->
						
						<tr>
							<td height="60" align="center">
								<button id="post_answer" class="button">ANSWER IT</button>	
							</td>
						</tr>
						<tr>
							<td></td>
						</tr>
					</table>
				</div>
				<!--question box ends here -->		
				
				<!--answer box contents -->
				<div class="answer_box" >
					<form action="view_question.php" method="post" enctype="multipart/form-data" id='answer_form'>
						<div id="abstract">							
							<textarea name="abstract_content" class="abstract_content" placeholder="Abstract...(Minimum 25 characters)" name="abstract"></textarea>
						</div>
						<div class="warning"></div>
						<span class="sp1" style="position:absolute; left:3%;top:125px;">Give Your Solution below :</span>						
						<div id="solution">
							<textarea id="solution_content" placeholder="Give the complete Solution here" ></textarea>			                      	                                    
							<div id="solution_inner">
								<div class="warning_2"></div>
								<input type="button" class="custom_button" value="Add file">
								<input type="file" class="upload" name="file"><a id="answer_pop1" class="popper" data-popbox="attach">? </a>
								<div id="file_name">
									<div class="one" style="width:130px;"></div>
									<div class="two">X</div>
								</div>
								<input type="text" class="bounty" placeholder=" set your Bounty $" name="bounty" value="">
							</div>
									<div class="warning_3"></div>
						</div>
						<div id="solution_submit" align="center">
							<input type="submit" id="submit_answer" class="button" value="SUBMIT" name="submit">
						</div>
					</form>               
				</div>             
				<!--answer box ends here -->
                
                
                <!--previous answer sestion -->
                
                	<?php 
						$result=mysqli_query($con,"select bounty,answer_id,abstract,answers.user_id,user_name,avg_rating from answers,profiles where profiles.user_id=answers.user_id and question_id=$question_id ORDER BY date_time DESC");
						if($row=mysqli_fetch_array($result))
						{
							$i=1;
							
							echo '<div id="question_box" style="margin-top:2%;padding: 10px 0 10px 0;">';
							do
							{
								
											if($row['avg_rating']==''){
                                                $rating="Newbie";
                                            }
											else if($row['avg_rating']==5){
												$rating="A+";
											}
											else if($row['avg_rating']>=4&& $row['avg_rating']<5){
												$rating="A";
											}
											else if($row['avg_rating']>=3&& $row['avg_rating']<4){
												$rating="B";
											}
											else if($row['avg_rating']>=2&& $row['avg_rating']<3){
												$rating="C";
											}
											else if($row['avg_rating']>=1&& $row['avg_rating']<2){
												$rating="D";
											}
											else if($row['avg_rating']>=0&& $row['avg_rating']<1){
												$rating="F";
											}
								if($result2=mysqli_query($con,"select answer_id from answer_carts where answer_id=".$row['answer_id'].";")){
								if(mysqli_fetch_array($result2)){
									$cart='';
									$tag='View answer & Rating';
								}
								else if($login_session==$row['user_id']){
									$cart='';
									$tag='View answer & Rating';
								}
								else{
									$cart='';
									$tag='View answer & Rating';
								}
							}
							else{
								die(mysqli_error($con));	
							}
							echo '<div class="prev_answers">
												<table style="width:100%;" >
													<tr>
														<td id="ans_image" width="50" ><img src="image.php?user_id='.$row['user_id'].'"></td>
														<td class="sp1" >
															'.$row['user_name'].'
															<br/><section style="font-size:13px;color:#555;">User Rating: '.$rating.'</section>
														</td>
														<td class="sp1" align="right" style="padding-right:10px">Bounty:$'.$row['bounty'].'</td>
													</tr>
													<tr>
														<td colspan="3" class="sp2" style="padding:5px;font-weight:normal;color:#000;line-height:25px;">'.$row['abstract'].'</td
													</tr>
													<tr>
														<td align="center" colspan="3" style="padding-bottom:10px;">
															<button class="cart '.$cart.'" id="cart'.$i.'" data="'.$row['answer_id'].'">'.$tag.'</button>  ';
															 if($login_session==$row['user_id']){
																echo '  <button class="cart '.$cart.'" id="cart'.$i.'" data="'.$row['answer_id'].'">Modify Answer</button>';
															 }
														echo'	 
														</td>
													</tr>
												</table>
											</div>
										';
								$i++;
							}while($row=mysqli_fetch_array($result));
							echo '</div>';
						}						
						?>	
               
            	<!--previous answer sestion -->
            	
            </div>	
						
			
           	    			
			<!--pop up contents -->			
			<div id="pop1" class="popbox" style="display:none;">
				<p>Click to download the file of questioner</p>
			</div>
						
			<div id="pop2" class="popbox" style="display:none;">
				<p>The Skills required to answer the Question</p>
			</div>
						
			<div id="pop3" class="popbox" style="display:none;">
				<p>The Main catagory of the Question</p>
			</div>
						
			<div id="pop4" class="popbox" style="display:none;">
				<p>Last date given by Questioner to answer </p>
			</div>
						
			<div id="pop5" class="popbox" style="display:none;">
				<p>The affordable price given by the Questioner</p>
			</div>
						
			<div id="attach" class="popbox" style="display:none;">
				<p>Upload multiple files as zipped format</p>
			</div>
									
			<div id="bounty_set" class="popbox" style="display:none;">
				<p>Set the price of your answer</p>
			</div>
				
				
				
			</div>		
			<div class="mcontent">
				<div class="wrapper" id="mwrapper">
				
					<!--question box-->
					<div id="mquestion_box">
						<div id="mquestion_title"><h2>View Question</h2></div>
						<div id="mquestion_content">
							
							<!--question box lay out table-->
							<table id="m_question_table">
								<tr>
									<td class="msection_1">Question By</td>
									<td class="msection_1">:</td>
									<td class="msection_2"><a href="" class="user_link"><?php if(isset($user_name))echo $user_name; ?></a></td>
								</tr>
								<tr>
									<td class="msection_1">Title</td>
									<td class="msection_1">:</td>
									<td class="msection_2"><?php if(isset($title))echo $title; ?></td>
								</tr>
								<tr>
									<td class="msection_1">Major</td> 
									<td class="msection_1">:</td>
									<td class="msection_2"><?php if(isset($major))echo $major; ?></td>
								</tr>
								<tr>
									<td class="msection_1">Deadline</td> 
									<td class="msection_1">:</td>
									<td class="msection_2"><?php if(isset($deadline))echo $deadline; ?></td>
								</tr>
								<tr>
									<td class="msection_1">Bounty</td> 
									<td class="msection_1">:</td>
									<td class="msection_2"><?php if(isset($init_bounty))echo ' $'.$init_bounty ?></td>
								</tr>
								<tr>
									<td class="msection_1">Skills</td> 
									<td class="msection_1">:</td>
									<td class="msection_2"><?php if(isset($skills))echo $skills; ?></td>
								</tr>                           
								<tr>
									<td class="msection_1">Attachments</td> 
									<td class="msection_1">:</td>
									<td class="msection_2"><?php if( isset($file) && $file!='' ){echo "<button class='link' style='font-size:7px;'><a href='download.php?file_id='".$file.">".$file."</a></button>";}?></td>
								</tr>
							</table>
							<!--lay out table ends here -->	
							
							<!--description section start here-->
							<div id="mquestion_description">
								<span class="msection_1" id="mdesc_title" style="display:block;">Description:</span>
								<span id="mquestion_description" style="word-break:break-word;"><?php if(isset($description))echo $description; ?></span>
							</div>
							<!--description section ends here -->	
							
							<div style="position:relative;" >
								<button id="mpost_button" class="button">ANSWER</button>
							</div>																	
						</div>											
					</div>
					<!--question box ends here -->
					
                    <!--answer box -->
					<div id="manswer_box">
						<div class="" id="m_abstract">
							<form action="" method="post" enctype="multipart/form-data" id="m_answer_form">
								<textarea class="abstract_content" id="m_abstract_content" placeholder="Abstract...(Minimum 25 characters)" name="abstract_content"></textarea>
								<div class="warning" style="position:absolute;width:101%;left:0;right:0;margin:auto;top:75%;font-size:10px;"></div>					
						</div>
						
                        <div class="" id="m_solution">
								<textarea id="m_solution_content"></textarea>  
								<div class="warning_2" style="position:absolute;top:90%;left:3px;"></div>                          
						</div>
						<div id="m_inner_solution">
								<input type="button" id="m_custom_button" class="custom_button" value="Add file">
								<input type="file" id="m_upload" class="upload" name="file">
								<div id="m_file_name" style="left:38.5%;top: 33%;">
									<div class="one" style="font-size:6px;"></div>
									<div id='m_two' style="font-size:6px;">X</div>
								</div>
								<input type="text" id="m_bounty"  classs='bounty' placeholder=" Bounty $ " name="bounty" value="">
								<div class="warning_3" style="position:absolute;top:61%;height:21%;font-size:5px;width:23%;left:69%;z-index:3;"></div>
						</div>		
						<div id="mbutton_div"> 
								<input type="submit" value="SUBMIT" class="button" id="m_submit" name="submit">
						</div>
                         </form> 
					</div>
					<!-- answer ends here-->	
					
                    <!--previous answer section -->				
					<?php 
						$result=mysqli_query($con,"select bounty,answer_id,abstract,answers.user_id,user_name,avg_rating from answers,profiles where profiles.user_id=answers.user_id and question_id=$question_id ORDER BY date_time DESC");
						if($row=mysqli_fetch_array($result))
						{
							$i=20;
							echo '<div id="question_box" style="margin-top:2%;padding: 10px 0 10px 0;width:96%;">';
							do
							{
								
											if($row['avg_rating']==5){
												$rating="A+";
											}
											else if($row['avg_rating']>=4&& $row['avg_rating']<5){
												$rating="A";
											}
											else if($row['avg_rating']>=3&& $row['avg_rating']<4){
												$rating="B";
											}
											else if($row['avg_rating']>=2&& $row['avg_rating']<3){
												$rating="C";
											}
											else if($row['avg_rating']>=1&& $row['avg_rating']<2){
												$rating="D";
											}
											else if($row['avg_rating']>=0&& $row['avg_rating']<1){
												$rating="F";
											}
											else{
												$rating="Newbie";
											}

								if($result2=mysqli_query($con,"select answer_id from answer_carts where answer_id=".$row['answer_id'].";")){
								if(mysqli_fetch_array($result2)){
									$cart='';
									$tag='View answer & Rating';
								}
								else if($login_session==$row['user_id']){
									$cart='';
									$tag='View answer & Rating';
								}
								else{
									$cart='';
									$tag='View answer & Rating';
								}
							}
							else{
								die(mysqli_error($con));	
							}
							echo '<div class="prev_answers" style="font-size:12px;">
												<table style="width:100%;">
													<tr>
														<td id="ans_image" width="50" ><img src="image.php?user_id='.$row['user_id'].'" ></td>
														<td class="msection_1">
															'.$row['user_name'].'
															<br/><section style="font-size:13px;color:#555;">User Rating: '.$rating.'</section>
														</td>
														<td class="msection_1" align="right" style="padding-right:5px;">Bounty:$'.$row['bounty'].'</td>
													</tr>
													<tr>
														<td colspan="3" class="msection_2" style="padding-left:5px;color:#000;font-weight:normal;">'.$row['abstract'].'</td
													</tr>
													<tr>
														<td align="center" colspan="3" style="padding-bottom:10px;">
															<button class="cart '.$cart.'" id="cart'.$i.'" data="'.$row['answer_id'].'">'.$tag.'</button>  ';
															 if($login_session==$row['user_id']){
																echo '  <button class="cart '.$cart.'" id="cart'.$i.'" data="'.$row['answer_id'].'">Modify Answer</button>';
															 }
														echo'	 
														</td>
													</tr>
												</table>
											</div>
										';
								$i++;
							}while($row=mysqli_fetch_array($result));
							echo '</div>';
						}						
						?>	   
						<!--previous answer section -->
                </div>          
			</div>
			<style>
				#toast-container {
					position: fixed;
					z-index: 1;
					width:100%;
					height: 50px;
					box-shadow: 0 0 12px #000;
				}
				.toast-top-center {
					top: 50px;
					margin: 0 auto;
				}

				.toast-message {
					text-align: center;
					-ms-word-wrap: break-word;
					word-wrap: break-word;
					margin-top:10px;
				}
			</style>
			<div id="toast-container" class="toast-top-center" style="display:none;">
				<div class="toast toast-error">
					<div class="toast-message"></div>
				</div>
			</div>		
		</div>
		<?php
			include_once './include/footer.php';
		?>
	</body>
</html>