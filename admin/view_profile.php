<?php 
	include_once './include/lock_admin.php';
?>
<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<?php
			include_once './include/head.php';
		?>
		<style>
		
		
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
					}
					else{
						$user_id=$login_session;
					}
					$result=mysqli_query($con,"select user_name,name,gender,date_of_birth,country,mobile,country,description from profiles where user_id=$user_id");
					$row=mysqli_fetch_array($result);
					$user_name=$row['user_name'];
					$name=$row['name'];
					$gender=$row['gender'];
					$dob=$row['date_of_birth'];
					$country=$row['country'];
					$mobile=$row['mobile'];
					$country=$row['country'];
					$desc=$row['description'];
					$result=mysqli_query($con,"select sum(answer_accounts.bounty) as bounty ,count(answer_accounts.answer_id) as count, sum(rating) as rating from answers,answer_accounts where answers.answer_id=answer_accounts.answer_id and user_id=$user_id");
					$row=mysqli_fetch_array($result);
					$count=$row['count'];
					$rating=$row['rating'];
					$bounty=$row['bounty'];
					$result=mysqli_query($con,"select sum(project_accounts.bounty) as bounty,count(project_accounts.project_id) as count, sum(rating) as rating from projects,project_accounts where projects.project_id=project_accounts.project_id and user_id=$user_id");
					$row=mysqli_fetch_array($result);
					$count=$count+$row['count'];
					$rating=$rating+$row['rating'];
					if($count!=0)
						$rating=($rating*10)/$count;
					else 
						$rating='Fresher';
					$bounty=$bounty+$row['bounty'];
					if($bounty==NULL)
						$bounty=0;
						
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
				<div style="width:76%; margin:0 10%; padding:2%; margin-top:50px; background-color:white; opacity:0.8;">
				
					<div style="width:100%; height:150px;">
						<div style="width:150px; float:left;">
							<img style=" border:1px solid black; width:100px; height:120px;" src="image.php?user_id=<?php echo $user_id; ?>">
						</div>
						<div style="width:400px; float:left;">
							<span><h3><?php echo $user_name; ?></h3></span>
							<div><?php echo $name; ?></div>
							<div><?php echo $dob; ?></div>
							<div><?php echo $gender; ?></div>
							<div><?php echo $country; ?></div>
							<div><?php 
								if($user_id==$login_session)
									echo $mobile;
							?></div>
						</div>
					</div>
					<style>
						.profile div{
							border-bottom:1px solid black; 
							padding-left:10px;
						}
					</style>
					<div class="profile" style="width:100%; border: 1px solid black;">
						<div style="background-color:#4695c0; color:white;">Description</div>
						<div style="word-wrap:break-word;"><?php echo $desc; ?></div>
						<div style="background-color:#4695c0; color:white;">Majors</div>
						<div>
							<?php 
								$result=mysqli_query($con,"select GROUP_CONCAT(user_major) as majors from majors where user_id=$user_id");
								while($row=mysqli_fetch_array($result)){
									echo $row['majors'];	
								}
								echo ' &nbsp;';
							?>
						</div>
						<div style="background-color:#4695c0; color:white;">Skills</div>
						<div>
							<?php 
								$result=mysqli_query($con,"select GROUP_CONCAT(user_skill) as skills from skills where user_id=$user_id");
								while($row=mysqli_fetch_array($result)){
									echo $row['skills'];
								}
								echo ' &nbsp;';
							?>
						</div><div style="background-color:#4695c0; color:white;">Rating</div>
						<div><?php echo $rating; ?></div>
						<div style="background-color:#4695c0; color:white;">Earning</div>
						<div>$<?php echo $bounty; ?></div>
						<div style="background-color:#4695c0; color:white;">Question Posted</div>
						<div><?php echo $question_count; ?></div>
						<div style="background-color:#4695c0; color:white;">Answer Posted</div>
						<div><?php echo $answer_count; ?></div>
						<div style="background-color:#4695c0; color:white;">Project Posted</div>
						<div><?php echo $project_count; ?></div>
						<div style="background-color:#4695c0; color:white;">Answer Accepted</div>
						<div><?php echo $answer_buy_count; ?></div>
						<div style="background-color:#4695c0; color:white;">Project Accepted</div>
						<div> <?php echo $project_buy_count; ?></div>
					</div>
				
				</div>
				
				
			</div>		
			<div class="mcontent">
				<div style="width:86%; margin:0 5%; padding:2%; margin-top:50px; background-color:white; opacity:0.8; ">	
							<img style=" border:1px solid black; width:100px; height:120px;" src="image.php?user_id=<?php echo $user_id; ?>">
							<span><h3><?php echo $user_name; ?></h3></span>
							<div><?php echo $name; ?></div>
							<div><?php echo $dob; ?></div>
							<div><?php echo $gender; ?></div>
							<div><?php echo $country; ?></div>
							<div><?php 
								if($user_id==$login_session)
									echo $mobile;
							?></div>
					<br/>
					<div class="profile" style="width:100%; border: 1px solid black;">
						<div style="background-color:#4695c0; color:white;">Description</div>
						<div style="word-wrap:break-word;"><?php echo $desc; ?></div>
						<div style="background-color:#4695c0; color:white;">Majors</div>
						<div>
							<?php 
								$result=mysqli_query($con,"select GROUP_CONCAT(user_major) as majors from majors where user_id=$user_id");
								while($row=mysqli_fetch_array($result)){
									echo $row['majors'];	
								}
								echo ' &nbsp;';
							?>
						</div>
						<div style="background-color:#4695c0; color:white;">Skills</div>
						<div>
							<?php 
								$result=mysqli_query($con,"select GROUP_CONCAT(user_skill) as skills from skills where user_id=$user_id");
								while($row=mysqli_fetch_array($result)){
									echo $row['skills'];
								}
								echo ' &nbsp;';
							?>
						</div><div style="background-color:#4695c0; color:white;">Rating</div>
						<div><?php echo $rating; ?></div>
						<div style="background-color:#4695c0; color:white;">Earning</div>
						<div>$<?php echo $bounty; ?></div>
						<div style="background-color:#4695c0; color:white;">Question Posted</div>
						<div><?php echo $question_count; ?></div>
						<div style="background-color:#4695c0; color:white;">Answer Posted</div>
						<div><?php echo $answer_count; ?></div>
						<div style="background-color:#4695c0; color:white;">Project Posted</div>
						<div><?php echo $project_count; ?></div>
						<div style="background-color:#4695c0; color:white;">Answer Accepted</div>
						<div><?php echo $answer_buy_count; ?></div>
						<div style="background-color:#4695c0; color:white;">Project Accepted</div>
						<div> <?php echo $project_buy_count; ?></div>
					</div>
				
				
				
			</div>		
		</div>
		<?php
			include_once './include/footer.php';
		?>
	</body>
</html>