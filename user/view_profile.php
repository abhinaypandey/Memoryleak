<?php 
	include_once './include/lock_normal.php';
?>
<!DOCTYPE html>
<html>
	<head>
        
	   <link rel="shortcut icon" href="./images/logo.png">
		<?php
			include_once './include/head.php';
		?>
		<style>
            img{
                box-shadow: #000 0 0px 10px -1px;
            }
			.link_button mg{
                box-shadow: #000 0 0px 10px -1px;
            }
            .link_button{
                margin-top:28%;
            	float:left; padding:5px; 
            	background-color:#4695c0; 
                margin-bottom:5px;
            	color:white;background-color: #ac1f39;
				-moz-border-radius: 0.5em;
				-webkit-border-radius: 0.5em;
				border-radius: 0.5em;
				border: 1px solid #ac1f39;
		
				cursor: pointer;
				font: bold 11px Arial, Helvetica;
				color: #fff; 
            }
            .link_button:hover{
            	background-color: #e97171;
            	box-shadow: inset 0 1px 3px  #e97171;
                -moz-box-shadow: inset 0 1px 3px  #e97171;
                -webkit-box-shadow: inset 0 1px 3px  #e97171;
            }
            .link_button{
	        	 transition: all 0.5s ease;
	            -moz-transition: all 0.5s ease;
	            -webkit-transition: all 0.5s ease;
	            -o-transition: all 0.5s ease;
	            -ms-transition: all 0.5s ease;
            }
		    .mlink_button mg{
                box-shadow: #000 0 0px 10px -1px;
            }
            .mlink_button{
            	float:right; padding:5px; 
            	background-color:#4695c0; 
                margin-bottom:5px;
            	color:white;background-color: #ac1f39;
				-moz-border-radius: 0.5em;
				-webkit-border-radius: 0.5em;
				border-radius: 0.5em;
				border: 1px solid #ac1f39;
		
				cursor: pointer;
				font: bold 11px Arial, Helvetica;
				color: #fff; 
            }
            .mlink_button:hover{
            	background-color: #e97171;
            	box-shadow: inset 0 1px 3px  #e97171;
                -moz-box-shadow: inset 0 1px 3px  #e97171;
                -webkit-box-shadow: inset 0 1px 3px  #e97171;
            }
            .mlink_button{
	        	 transition: all 0.5s ease;
	            -moz-transition: all 0.5s ease;
	            -webkit-transition: all 0.5s ease;
	            -o-transition: all 0.5s ease;
	            -ms-transition: all 0.5s ease;
            }
		</style>
		<script>
		
		</script>
	</head>
	<body>
		<?php
			include_once './include/menu.php';
		?>
		<div class="body">
			<div class="content">
				<?php 
					include './include/connection.php';
					$user_id=0;
					if(isset($_GET['user_id'])){
						$user_id=$_GET['user_id'];
						$result=mysqli_query($con,"select user_id from profiles where user_id=$user_id");
						if(!mysqli_num_rows($result)){
							echo "<script>
							alert('Invalid Profile');
							window.location.href='index.php';
							</script>";
							exit;
						}
					}
					else{
						$user_id=$login_session;
					}
					$result=mysqli_query($con,"select user_name,name,gender,date_format(date_of_birth,'%d-%m-%Y') date_of_birth,country,mobile,country,description,avg_rating,rating_count,earning from profiles where user_id=$user_id");
					$row=mysqli_fetch_array($result);
					$user_name=$row['user_name'];
					$name=$row['name'];
					$gender=$row['gender'];
					$dob=$row['date_of_birth'];
					$country=$row['country'];
					$mobile=$row['mobile'];
					$country=$row['country'];
					$desc=nl2br($row['description']);
					$bounty=0;
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
                    if($row['avg_rating']==''){
                        $count=0;
                    }
                    else{
                        $count=$row['rating_count'];
                    }
					
                    
					
					$bounty=$row['earning'];	
					$result=mysqli_query($con,"select count(*) question_count from questions where user_id=$user_id");
					$row=mysqli_fetch_array($result);
					$question_count=$row['question_count'];
					
					$result=mysqli_query($con,"select count(*) answer_count from answers where user_id=$user_id");
					$row=mysqli_fetch_array($result);
					$answer_count=$row['answer_count'];
					
					$result=mysqli_query($con,"select count(*) project_count from projects where user_id=$user_id");
					$row=mysqli_fetch_array($result);
					$project_count=$row['project_count'];
					
					$result=mysqli_query($con,"select count(*) answer_buy_count from answer_accounts where buy_from=$user_id");
					$row=mysqli_fetch_array($result);
					$answer_buy_count=$row['answer_buy_count'];
					
					$result=mysqli_query($con,"select count(*) project_buy_count from project_accounts where buy_from=$user_id");
					$row=mysqli_fetch_array($result);
					$project_buy_count=$row['project_buy_count'];
					
				?>
                <div style="width:80%; min-height:500px;margin: 50px auto auto; background-color:white; padding:10px;">
                    <div style="width:17.9%;  float:left; ">
                        <div style="margin:3%;">
                            <img style="width:100%; height:100%;" src="image.php?user_id=<?php echo $user_id; ?>">
                            <span><h3 style="color:#3bb998;font-weight:bold;"><?php echo $user_name; echo'<title>'.$user_name.'</title>';?></h3></span>
                            <div>
                                <?php echo $name; ?>
                            </div>
                            <div>
                                <?php echo $dob; ?>
                            </div>
                            <div>
                                <?php echo $gender; ?>
                            </div>
                            <div>
                                <?php echo $country; ?>
                            </div>
                            <div>
                                <?php 
                                    if($user_id==$login_session)
                                        echo $mobile;?>
                            </div>
                            <div>
                                <?php 
                                    if($user_id==$login_session)
                                        echo '<a href="profile_update.php"><div class="link_button">Edit Profile</div></a>';
                                ?>
                            </div>

                        </div>
                    </div>
                    <div style="width:80%;  float:right; border-left:solid 1px rgba(100, 100, 100, .22);">
                        <div style="margin-left:3%;margin-top:2%; word-wrap:break-word;">
                            <div>
                                <span style="color:#0084B4; font-weight:bold;">Majors&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</span><?php 
                                    $result=mysqli_query($con,"select GROUP_CONCAT(user_major) as majors from majors where user_id=$user_id");
                                    while($row=mysqli_fetch_array($result)){
                                        echo $row['majors'];	
                                    }
                                    echo ' &nbsp;';
                                ?>
                            </div>
                            <div style="margin-top:1%;">
                                <span style="color:#0084B4; font-weight:bold;">Interests&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</span> 
                                <?php 
                                    $result=mysqli_query($con,"select GROUP_CONCAT(user_skill) as skills from skills where user_id=$user_id");
                                    while($row=mysqli_fetch_array($result)){
                                        echo $row['skills'];
                                    }
                                    echo ' &nbsp;';
                                ?>
                            </div>
                            <div style="margin-top:1%;">
                                <span style="color:#0084B4; font-weight:bold;">Rating&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</span>
                                <?php echo $rating; ?>
                                ( <?php echo $count; ?>)
                            </div>
                            
                            <div style="margin-top:1%;">
                                <span style="color:#0084B4; font-weight:bold;">Earning&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</span>
                                $<?php echo $bounty; ?>
                            </div>
                            
                            <div style="margin-top:1%;">
                                <span style="color:#0084B4; font-weight:bold;">Question Posted&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</span>    <?php echo $question_count; ?>
                            </div>
                            
                            <div style="margin-top:1%;">
                                <span style="color:#0084B4; font-weight:bold;">Answer Posted&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</span>    <?php echo $answer_count; ?>
                            </div>
                            
                            <div style="margin-top:1%;">
                                <span style="color:#0084B4; font-weight:bold;">Project Posted&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</span>    <?php echo $project_count; ?>
                            </div>
                            
                            <div style="margin-top:1%;">
                                <span style="color:#0084B4; font-weight:bold;">Answer Accepted&nbsp;&nbsp;&nbsp;:</span> <?php echo $answer_buy_count; ?>
                            </div>
                            
                            <div style="margin-top:1%;">
                                <span style="color:#0084B4; font-weight:bold;">Project Accepted&nbsp;&nbsp;&nbsp;:</span>    <?php echo $project_buy_count; ?>
                            </div>
                            <div style="word-wrap:break-word; margin-top:1%;overflow:auto;height:150px;">
                                <span style="color:#0084B4; font-weight:bold;">About Me</br></span><div style="min-height:150px;"><?php echo $desc; ?></div>
                                
                            </div>
                        </div>
                    </div>
                    
                </div>

			</div>		
			<div class="mcontent">
				<div style="width:86%; margin:0 5%; padding:2%; margin-top:50px; color:white;">
				
				
							<img style="width:100px; height:120px;" src="image.php?user_id=<?php echo $user_id; ?>">
							<?php 
								if($user_id==$login_session)
									echo '<a href="profile_update.php"><div class="mlink_button"  >Edit Profile</div></a>';
							?>
							<span><h3 style="color:#3bb998;"><?php echo $user_name; echo'<title>'.$user_name.'</title>';?></h3></span>
							<div><?php echo $name; ?></div>
							<div><?php echo $dob; ?></div>
							<div><?php echo $gender; ?></div>
							<div><?php echo $country; ?></div>
							<div><?php 
								if($user_id==$login_session)
									echo $mobile;
							?></div>
                            
					<br/>
					<div class="profile" style="width:100%;">
						<div style="color:#4695c0;  margin-top:5%;">Description</div>
						<div style="word-wrap:break-word;"><?php echo $desc; ?></div>
						<div style="color:#4695c0; margin-top:5%;">Majors</div>
						<div>
							<?php 
								$result=mysqli_query($con,"select GROUP_CONCAT(user_major) as majors from majors where user_id=$user_id");
								while($row=mysqli_fetch_array($result)){
									echo $row['majors'];	
								}
								echo ' &nbsp;';
							?>
						</div>
						<div style="color:#4695c0;  margin-top:5%;">Skills</div>
						<div>
							<?php 
								$result=mysqli_query($con,"select GROUP_CONCAT(user_skill) as skills from skills where user_id=$user_id");
								while($row=mysqli_fetch_array($result)){
									echo $row['skills'];
								}
								echo ' &nbsp;';
							?>
						</div>
								<div style="color:#4695c0;  margin-top:5%;">Rating</div>
								<div><?php echo $rating; ?></div>
								<div style="color:#4695c0;  margin-top:5%;">Earning</div>
								<div>$<?php echo $bounty; ?></div>
								<div style="color:#4695c0;  margin-top:5%;">Question Posted</div>
								<div><?php echo $question_count; ?></div>
								<div style="color:#4695c0;  margin-top:5%;">Answer Posted</div>
								<div><?php echo $answer_count; ?></div>
								<div style="color:#4695c0;  margin-top:5%;">Project Posted</div>
								<div><?php echo $project_count; ?></div>
								<div style="color:#4695c0;  margin-top:5%;">Answer Accepted</div>
								<div><?php echo $answer_buy_count; ?></div>
								<div style="color:#4695c0;  margin-top:5%;">Project Accepted</div>
								<div> <?php echo $project_buy_count; ?></div>
					</div>
				
				
				
			</div>		
		</div>
		<?php
			include_once './include/footer.php';
		?>
	</body>
</html>