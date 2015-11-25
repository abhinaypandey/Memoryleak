<?php 
	include_once './include/lock_normal.php';
?>
<!DOCTYPE html>
<html>
	<head>
        <link rel="shortcut icon" href="./images/logo.png">
		<title>Payment Request</title>
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
				<div style="width:76%; margin:0 10%; padding:2%; margin-top:50px; background-color:white; opacity:0.8;">
					<?php 
						$earning=0;
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
						echo "<h2>Withdrawal Request</h2>";
						echo 'Total Earning: $'.$earning;
						$withdraw=0;
						$result=mysqli_query($con,"select sum(amount) as bounty from withdrawals where user_id=$login_session");
						$row=mysqli_fetch_array($result);
						$withdraw=$withdraw+$row['bounty'];
						echo '<br/>Withdrawal Till Now $'.$withdraw;
						$amount=$earning-$withdraw;
						
						if($amount>=5){
							echo "<br/>You can request for $$amount";
							echo "<br/>Paypal Account ID <input id='email' type='text'><br/><input id='request_payment' type='button' value='submit'>";
							echo "
								<script>
									$(document).ready(function(){
										$('#request_payment').click(function(){
											var email=$('#email').val();
											var email_reg=/^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})+$/;
											if(!email_reg.test(email)){
												alert('Invalid Email ID');
											}
											else{
												var result=confirm('Are you Sure to Transfer your fund to '+email);
												if(result==true){
													$.ajax({
														type:'post',
														url:'query.php',
														data:{
															type:'16',
															email:email
														}
													}).done(function(data){
														
														if($.trim(data)==1){
															alert('Request Submitted Sucessfully');
															window.location.href='index.php';
														}
														else if($.trim(data)==3){
															alert('Invalid Transaction');
														}
														else{
															alert('Something went Wrong....');
														}
													});
												}
											}
										});									
									});
								</script>
							";
						}
						else 
							echo "<br/> Cannot request because $amount is less then $5";
					?>
				</div>				
			</div>		
			<div class="mcontent">
				<div style="width:90%; margin:0 3%; padding:2%; margin-top:50px; background-color:white; opacity:0.8;">
					<?php 
						echo "<h2>Withdrawal Request</h2>";
						echo 'Total Earning: $'.$earning;
						echo '<br/>Withdrawal Till Now $'.$withdraw;
						$amount=$earning-$withdraw;
						
						if($amount>=5){
							echo "<br/>You can request for $$amount";
							echo "<br/>Paypal Account ID <input id='memail' type='text'><br/><input id='mrequest_payment' type='button' value='submit'>";
							echo "
								<script>
									$(document).ready(function(){
										$('#mrequest_payment').click(function(){
											var email=$('#memail').val();
											var email_reg=/^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})+$/;
											if(!email_reg.test(email)){
												alert('Invalid Email ID');
											}
											else{
												var result=confirm('Are you Sure to Transfer your fund to '+email);
												if(result==true){
													$.ajax({
														type:'post',
														url:'query.php',
														data:{
															type:'16',
															email:email
														}
													}).done(function(data){
														
														if($.trim(data)==1){
															alert('Request Submitted Sucessfully');
															window.location.href='index.php';
														}
														else if($.trim(data)==3){
															alert('Invalid Transaction');
														}
														else{
															alert('Something went Wrong....');
														}
													});
												}
											}
										});									
									});
								</script>
							";
						}
						else 
							echo "<br/> Cannot request because $amount is less then $5";
					?>
				</div>
				
				
				
			</div>		
		</div>
		<?php
			include_once './include/footer.php';
		?>
	</body>
</html>