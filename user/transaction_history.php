<?php 
	include_once './include/lock_normal.php';
?>
<!DOCTYPE html>
<html>
	<head>
        <link rel="shortcut icon" href="./images/logo.png">
		<title>Transaction History</title>
		<?php
			include_once './include/head.php';
		?>
		<style>
		
		
		</style>
		<script>
			$(document).ready(function(){
				$('form').submit(function(event){
					console.log($(this).children('.transaction_type'));
					if($(this).children('.transaction_type').val()=='Transaction Type'){
						alert('Please select the transaction type');
						$(this).children('.transaction_type').focus();
						event.preventDefault();
					}
					else{
						if($(this).children('.item_type').val()=='Item Type'&&$(this).children('.transaction_type').val()!='Withdrawal'){
							alert('Please select the item type');
							$(this).children('.item_type').focus();
							event.preventDefault();
						}				
					}					
				});
				$('.transaction_type').on('change keyup',function(){
					if($(this).val()=='Withdrawal'){
						$('.item_type').hide();
					}				
					else{
						$('.item_type').show();
					}
				});
			});
		</script>
	</head>
	<body>
		<?php
			include_once './include/menu.php';
		?>
		<div class="body">
			<div class="content">
				<div style="width:76%; margin:0 10%; padding:2%; margin-top:50px; background-color:white; opacity:0.8;">
					<div style="margin:0px auto; width:100%;">
						<h2>Transaction History</h2>
						<div style="width:300px; margin:30px auto;">
							<form id="form" method="post" action="transaction_history.php">
								<select name="transaction_type" class="transaction_type">
									<option>Transaction Type</option>
									<option>Withdrawal</option>
									<option>Purchase</option>
									<option>Sold</option>
								</select>
								<select name="item_type" class="item_type">
									<option>Item Type</option>
									<option>Projects</option>
									<option>Answers</option>
								</select>
								<input type="submit" id="submit" value="Submit">							
							</form>
						</div>
						<div>
							<?php
								if(isset($_POST['transaction_type'])){
									if($_POST['transaction_type']=='Withdrawal'){
										echo "
											<script>
												$(document).ready(function(){
													$('.nav-button').click(function(){
														var data=$.trim($(this).val());
														if(data=='<')
															count--;
														else if(data=='>')
															count++;					
														if(count==0||total==0){
															alert('Cannot move further');
															count=1;
														}
														else if(count==parseInt(total/10)+1){
															alert('Cannot move further');
															count=parseInt(total/10);
														}
														else{
															loaddata(count*10-10)
															$('.pagecount').text(parseInt(count));
														}
													});
												});
												function loaddata(count){
													$.ajax({
														type:'POST',
														url:'query.php',
														data:{ 
														type:11,
														count:count
														}
													}).done(function(data){
														$('tbody').html('');
														var obj = jQuery.parseJSON(data);
														$.each(obj,function(i){
															if(i%2==0)
																$(\"<tr style='  height: 25px; background-color:#b4d4f4; border-bottom:1px solid grey;'><td><a href='transaction_details.php?tid=\"+obj[i]['transaction_id']+\"&type=withdraw'>\"+obj[i]['transaction_id']+\"</a><td>$\"+obj[i]['amount']+\"</td><td>\"+obj[i]['payment_status']+\"</td></td><td>\"+obj[i]['date_time']+\"</td></tr>\").appendTo('tbody');
															else
																$(\"<tr style='  height: 25px; background-color:whitesmoke;'><td><a href='transaction_details.php?tid=\"+obj[i]['transaction_id']+\"&type=withdraw'>\"+obj[i]['transaction_id']+\"</a></td><td>$\"+obj[i]['amount']+\"</td><td>\"+obj[i]['payment_status']+\"</td></td><td>\"+obj[i]['date_time']+\"</td></tr>\").appendTo('tbody');
														});
														
										
													});				
												}
											</script>
										";
										echo '
											<div style="border-top-left-radius:10px; border-top-right-radius:10px; overflow:hidden;">
												<table  style=" border-collapse:collapse; width:100%;">
													<thead >
														<tr style="background-color:#4695c0; color:white; height: 35px; "><th>Transaction Id</th><th>Amount</th><th>Payment Status</th><th>Date Time</th></tr>
													</thead>
													<tbody id="tbody">
												';
										include './include/connection.php';
										$result=mysqli_query($con,'select count(*) as total from withdrawals where user_id='.$login_session);
										$row=mysqli_fetch_array($result);
										$total=ceil($row['total']/10)*10;
										if($total==0)
											$count=0;
										else
											$count=1;
										echo "<script> var total=$total;
																	 var count=1;
										</script>";
										mysqli_close($con);
										echo '
													</tbody>
												</table>
												<div style="width:100%; height:35px; background-color:#4695c0">
													<input class="nav-button" data="back" type="button" value="<" style="height:100%; width:50px; font-weight:bold; font-size:120%;">
													<span><span class="pagecount">'.$count.'</span>/ '.ceil($total/10).'</span>
													<input class="nav-button" data="next" type="button" value=">" style="height:100%; width:50px; font-weight:bold; font-size:120%;">
												</div>
											</div>
										';
										
									}
									else if(isset($_POST['item_type'])){
											$item_type=trim($_POST['item_type']);
											$transaction_type=trim($_POST['transaction_type']);
											if($item_type=='Projects'&&$transaction_type=='Purchase'){
												echo "
													<script>
														$(document).ready(function(){
															$('.nav-button').click(function(){
																var data=$.trim($(this).val());
																if(data=='<')
																	count--;
																else if(data=='>')
																	count++;					
																if(count==0||total==0){
																	alert('Cannot move further');
																	count=1;
																}
																else if(count==parseInt(total/10)+1){
																	alert('Cannot move further');
																	count=parseInt(total/10);
																}
																else{
																	loaddata(count*10-10)
																	$('.pagecount').text(parseInt(count));
																}
															});
														});
														function loaddata(count){
															$.ajax({
																type:'POST',
																url:'query.php',
																data:{ 
																type:14,
																count:count
																}
															}).done(function(data){
																$('tbody').html('');
																var obj = jQuery.parseJSON(data);
																$.each(obj,function(i){
																	if(i%2==0)
																		$(\"<tr style='  height: 25px; background-color:#b4d4f4; border-bottom:1px solid grey;'><td><a href='transaction_details.php?tid=\"+obj[i]['transaction_id']+\"&type=project'>\"+obj[i]['transaction_id']+\"</a></td><td>\"+obj[i]['title']+\"</td><td>$\"+obj[i]['bounty']+\"</td><td>\"+obj[i]['date_time']+\"</td></tr>\").appendTo('tbody');
																	else
																		$(\"<tr style='  height: 25px; background-color:whitesmoke;'><td><a href='transaction_details.php?tid=\"+obj[i]['transaction_id']+\"&type=project'>\"+obj[i]['transaction_id']+\"</a></td><td>\"+obj[i]['title']+\"</td><td>$\"+obj[i]['bounty']+\"</td><td>\"+obj[i]['date_time']+\"</td></tr>\").appendTo('tbody');
																});
																
												
															});				
														}
													</script>
												";
												echo '
													<div style="border-top-left-radius:10px; border-top-right-radius:10px; overflow:hidden;">
														<table  style=" border-collapse:collapse; width:100%;">
															<thead >
																<tr style="background-color:#4695c0; color:white; height: 35px; "><th>Transaction Id</th><th style="width:65%">Project Title</th><th>Bounty</th><th>Date Time</th></tr>
															</thead>
															<tbody id="tbody">
														';
												include './include/connection.php';
												$result=mysqli_query($con,'select count(project_accounts.transaction_id) as total from project_accounts,transactions where transactions.transaction_id=project_accounts.transaction_id and transactions.user_id='.$login_session);
												$row=mysqli_fetch_array($result);
												$total=ceil($row['total']/10)*10;
												if($total==0)
													$count=0;
												else
													$count=1;
												echo "<script> var total=$total;
																			 var count=1;
												</script>";
												mysqli_close($con);
												echo '
															</tbody>
														</table>
														<div style="width:100%; height:35px; background-color:#4695c0">
															<input class="nav-button" data="back" type="button" value="<" style="height:100%; width:50px; font-weight:bold; font-size:120%;">
															<span><span class="pagecount">'.$count.'</span>/ '.ceil($total/10).'</span>
															<input class="nav-button" data="next" type="button" value=">" style="height:100%; width:50px; font-weight:bold; font-size:120%;">
														</div>
													</div>
												';
												
												
											}
											else if($item_type=='Projects'&&$transaction_type=='Sold'){
												echo "
													<script>
														$(document).ready(function(){
															$('.nav-button').click(function(){
																var data=$.trim($(this).val());
																if(data=='<')
																	count--;
																else if(data=='>')
																	count++;					
																if(count==0||total==0){
																	alert('Cannot move further');
																	count=1;
																}
																else if(count==parseInt(total/10)+1){
																	alert('Cannot move further');
																	count=parseInt(total/10);
																}
																else{
																	loaddata(count*10-10)
																	$('.pagecount').text(parseInt(count));
																}
															});
														});
														function loaddata(count){
															$.ajax({
																type:'POST',
																url:'query.php',
																data:{ 
																type:15,
																count:count
																}
															}).done(function(data){
																$('tbody').html('');
																var obj = jQuery.parseJSON(data);
																$.each(obj,function(i){
																	if(i%2==0)
																		$(\"<tr style='  height: 25px; background-color:#b4d4f4; border-bottom:1px solid grey;'><td><a href='transaction_details.php?tid=\"+obj[i]['transaction_id']+\"&type=project'>\"+obj[i]['transaction_id']+\"</a></td><td>\"+obj[i]['title']+\"</td><td>$\"+obj[i]['bounty']+\"</td><td>\"+obj[i]['date_time']+\"</td></tr>\").appendTo('tbody');
																	else
																		$(\"<tr style='  height: 25px; background-color:whitesmoke;'><td><a href='transaction_details.php?tid=\"+obj[i]['transaction_id']+\"&type=project'>\"+obj[i]['transaction_id']+\"</a></td><td>\"+obj[i]['title']+\"</td><td>$\"+obj[i]['bounty']+\"</td><td>\"+obj[i]['date_time']+\"</td></tr>\").appendTo('tbody');
																});
												
															});				
														}
													</script>
												";
												echo '
													<div style="border-top-left-radius:10px; border-top-right-radius:10px; overflow:hidden;">
														<table  style=" border-collapse:collapse; width:100%;">
															<thead >
																<tr style="background-color:#4695c0; color:white; height: 35px; "><th>Transaction Id</th><th style="width:65%">Project Title</th><th>Bounty</th><th>Date Time</th></tr>
															</thead>
															<tbody id="tbody">
														';
												include './include/connection.php';
												$result=mysqli_query($con,'select count(project_accounts.transaction_id) as total from project_accounts,transactions where transactions.transaction_id=project_accounts.transaction_id and buy_from='.$login_session);
												$row=mysqli_fetch_array($result);
												$total=ceil($row['total']/10)*10;
												if($total==0)
													$count=0;
												else
													$count=1;
												echo "<script> var total=$total;
																			 var count=1;
												</script>";
												mysqli_close($con);
												echo '
															</tbody>
														</table>
														<div style="width:100%; height:35px; background-color:#4695c0">
															<input class="nav-button" data="back" type="button" value="<" style="height:100%; width:50px; font-weight:bold; font-size:120%;">
															<span><span class="pagecount">'.$count.'</span>/ '.ceil($total/10).'</span>
															<input class="nav-button" data="next" type="button" value=">" style="height:100%; width:50px; font-weight:bold; font-size:120%;">
														</div>
													</div>
												';
												
												
											}
											else if($item_type=='Answers'&&$transaction_type=='Purchase'){
												echo "
													<script>
														$(document).ready(function(){
															$('.nav-button').click(function(){
																var data=$.trim($(this).val());
																if(data=='<')
																	count--;
																else if(data=='>')
																	count++;					
																if(count==0||total==0){
																	alert('Cannot move further');
																	count=1;
																}
																else if(count==parseInt(total/10)+1){
																	alert('Cannot move further');
																	count=parseInt(total/10);
																}
																else{
																	loaddata(count*10-10)
																	$('.pagecount').text(parseInt(count));
																}
															});
														});
														function loaddata(count){
															$.ajax({
																type:'POST',
																url:'query.php',
																data:{ 
																type:12,
																count:count
																}
															}).done(function(data){
																$('tbody').html('');
																var obj = jQuery.parseJSON(data);
																$.each(obj,function(i){
																	if(i%2==0)
																		$(\"<tr style='  height: 25px; background-color:#b4d4f4; border-bottom:1px solid grey;'><td><a href='transaction_details.php?tid=\"+obj[i]['transaction_id']+\"&type=answer'>\"+obj[i]['transaction_id']+\"</a></td><td>\"+obj[i]['abstract']+\"</td><td>$\"+obj[i]['bounty']+\"</td><td>\"+obj[i]['date_time']+\"</td></tr>\").appendTo('tbody');
																	else
																		$(\"<tr style='  height: 25px; background-color:whitesmoke;'><td><a href='transaction_details.php?tid=\"+obj[i]['transaction_id']+\"&type=answer'>\"+obj[i]['transaction_id']+\"</a></td><td>\"+obj[i]['abstract']+\"</td><td>$\"+obj[i]['bounty']+\"</td><td>\"+obj[i]['date_time']+\"</td></tr>\").appendTo('tbody');
																});
												
															});				
														}
													</script>
												";
												echo '
													<div style="border-top-left-radius:10px; border-top-right-radius:10px; overflow:hidden;">
														<table  style=" border-collapse:collapse; width:100%;">
															<thead >
																<tr style="background-color:#4695c0; color:white; height: 35px; "><th>Transaction Id</th><th style="width:65%">Answer Abstract</th><th>Bounty</th><th>Date Time</th></tr>
															</thead>
															<tbody id="tbody">
														';
												include './include/connection.php';
												$result=mysqli_query($con,'select count(answer_accounts.transaction_id) as total from answer_accounts,transactions where transactions.transaction_id=answer_accounts.transaction_id and user_id='.$login_session);
												$row=mysqli_fetch_array($result);
												$total=ceil($row['total']/10)*10;
												if($total==0)
													$count=0;
												else
													$count=1;
												echo "<script> var total=$total;
																			 var count=1;
												</script>";
												mysqli_close($con);
												echo '
															</tbody>
														</table>
														<div style="width:100%; height:35px; background-color:#4695c0">
															<input class="nav-button" data="back" type="button" value="<" style="height:100%; width:50px; font-weight:bold; font-size:120%;">
															<span><span class="pagecount">'.$count.'</span>/ '.ceil($total/10).'</span>
															<input class="nav-button" data="next" type="button" value=">" style="height:100%; width:50px; font-weight:bold; font-size:120%;">
														</div>
													</div>
												';
												
												
											}
											else if($item_type=='Answers'&&$transaction_type=='Sold'){
												echo "
													<script>
														$(document).ready(function(){
															$('.nav-button').click(function(){
																var data=$.trim($(this).val());
																if(data=='<')
																	count--;
																else if(data=='>')
																	count++;					
																if(count==0||total==0){
																	alert('Cannot move further');
																	count=1;
																}
																else if(count==parseInt(total/10)+1){
																	alert('Cannot move further');
																	count=parseInt(total/10);
																}
																else{
																	loaddata(count*10-10)
																	$('.pagecount').text(parseInt(count));
																}
															});
														});
														function loaddata(count){
															$.ajax({
																type:'POST',
																url:'query.php',
																data:{ 
																type:13,
																count:count
																}
															}).done(function(data){
																$('tbody').html('');
																var obj = jQuery.parseJSON(data);
																$.each(obj,function(i){
																	if(i%2==0)
																		$(\"<tr style='  height: 25px; background-color:#b4d4f4; border-bottom:1px solid grey;'><td><a href='transaction_details.php?tid=\"+obj[i]['transaction_id']+\"&type=answer'>\"+obj[i]['transaction_id']+\"</a></td><td>\"+obj[i]['abstract']+\"</td><td>$\"+obj[i]['bounty']+\"</td><td>\"+obj[i]['date_time']+\"</td></tr>\").appendTo('tbody');
																	else
																		$(\"<tr style='  height: 25px; background-color:whitesmoke;'><td><a href='transaction_details.php?tid=\"+obj[i]['transaction_id']+\"&type=answer'>\"+obj[i]['transaction_id']+\"</a></td><td>\"+obj[i]['abstract']+\"</td><td>$\"+obj[i]['bounty']+\"</td><td>\"+obj[i]['date_time']+\"</td></tr>\").appendTo('tbody');
																});
																
												
															});				
														}
													</script>
												";
												echo '
													<div style="border-top-left-radius:10px; border-top-right-radius:10px; overflow:hidden;">
														<table  style=" border-collapse:collapse; width:100%;">
															<thead >
																<tr style="background-color:#4695c0; color:white; height: 35px; "><th>Transaction Id</th><th style="width:65%">Answer Abstract</th><th>Bounty</th><th>Date Time</th></tr>
															</thead>
															<tbody id="tbody">
														';
												include './include/connection.php';
												$result=mysqli_query($con,'select count(answer_accounts.transaction_id) as total from answer_accounts,transactions where transactions.transaction_id=answer_accounts.transaction_id and buy_from='.$login_session);
												$row=mysqli_fetch_array($result);
												$total=ceil($row['total']/10)*10;
												if($total==0)
													$count=0;
												else
													$count=1;
												echo "<script> var total=$total;
																			 var count=1;
												</script>";
												mysqli_close($con);
												echo '
															</tbody>
														</table>
														<div style="width:100%; height:35px; background-color:#4695c0">
															<input class="nav-button" data="back" type="button" value="<" style="height:100%; width:50px; font-weight:bold; font-size:120%;">
															<span><span class="pagecount">'.$count.'</span>/ '.ceil($total/10).'</span>
															<input class="nav-button" data="next" type="button" value=">" style="height:100%; width:50px; font-weight:bold; font-size:120%;">
														</div>
													</div>
												';
												
												
											}
									}
								}
							?>
						</div>
					</div>
				</div>			
			</div>		
			<div class="mcontent">
				<div style="width:90%; margin:0 3%; padding:2%; margin-top:50px; background-color:white; opacity:0.8;">
					<div style="margin:0px auto; width:100%;">
						<h2>Transaction History</h2>
						<div style="width:250px; margin:30px auto;">
							<form id="form" method="post" action="transaction_history.php">
								<select name="transaction_type" class="transaction_type">
									<option>Transaction Type</option>
									<option>Withdrawal</option>
									<option>Purchase</option>
									<option>Sold</option>
								</select>
								<select name="item_type" class="item_type">
									<option>Item Type</option>
									<option>Projects</option>
									<option>Answers</option>
								</select>
								<input type="submit" id="submit" value="Submit">							
							</form>
						</div>
						<div>
							<?php
								if(isset($_POST['transaction_type'])){
									if($_POST['transaction_type']=='Withdrawal'){
										echo '
											<div style="border-top-left-radius:10px; border-top-right-radius:10px; overflow:hidden;">
												<table  style=" border-collapse:collapse; width:100%;">
													<thead >
														<tr style="background-color:#4695c0; color:white; height: 35px; "><th>Transaction Id</th><th>Amount</th><th>Payment Status</th><th>Date Time</th></tr>
													</thead>
													<tbody id="tbody">
												';
										echo "<script>
												if(total==0)
													$(\"<tr style='  height: 25px; background-color:#b4d4f4; border-bottom:1px solid grey;'><td colspan=4>No Records Found.....</td></tr>\").appendTo('tbody');
												else
													loaddata(0);
										</script>";
										echo '
													</tbody>
												</table>
												<div style="width:100%; height:35px; background-color:#4695c0">
													<input class="nav-button" data="back" type="button" value="<" style="height:100%; width:50px; font-weight:bold; font-size:120%;">
													<span><span class="pagecount">'.$count.'</span>/ '.ceil($total/10).'</span>
													<input class="nav-button" data="next" type="button" value=">" style="height:100%; width:50px; font-weight:bold; font-size:120%;">
												</div>
											</div>
										';
										
									}
									else if(isset($_POST['item_type'])){
											$item_type=trim($_POST['item_type']);
											$transaction_type=trim($_POST['transaction_type']);
											if($item_type=='Projects'&&$transaction_type=='Purchase'){
												echo '
													<div style="border-top-left-radius:10px; border-top-right-radius:10px; overflow:hidden;">
														<table  style=" border-collapse:collapse; width:100%;">
															<thead >
																<tr style="background-color:#4695c0; color:white; height: 35px; "><th>Transaction Id</th><th style="width:65%">Answer Abstract</th><th>Bounty</th><th>Date Time</th></tr>
															</thead>
															<tbody id="tbody">
														';
												echo "<script>
														if(total==0)
															$(\"<tr style='  height: 25px; background-color:#b4d4f4; border-bottom:1px solid grey;'><td colspan=4>No Records Found.....</td></tr>\").appendTo('tbody');
														else
															loaddata(0);
												</script>";
												echo '
															</tbody>
														</table>
														<div style="width:100%; height:35px; background-color:#4695c0">
															<input class="nav-button" data="back" type="button" value="<" style="height:100%; width:50px; font-weight:bold; font-size:120%;">
															<span><span class="pagecount">'.$count.'</span>/ '.ceil($total/10).'</span>
															<input class="nav-button" data="next" type="button" value=">" style="height:100%; width:50px; font-weight:bold; font-size:120%;">
														</div>
													</div>
												';
												
												
											}
											else if($item_type=='Projects'&&$transaction_type=='Sold'){
												echo '
													<div style="border-top-left-radius:10px; border-top-right-radius:10px; overflow:hidden;">
														<table  style=" border-collapse:collapse; width:100%;">
															<thead >
																<tr style="background-color:#4695c0; color:white; height: 35px; "><th>Transaction Id</th><th style="width:65%">Answer Abstract</th><th>Bounty</th><th>Date Time</th></tr>
															</thead>
															<tbody id="tbody">
														';
												echo "<script>
														if(total==0)
															$(\"<tr style='  height: 25px; background-color:#b4d4f4; border-bottom:1px solid grey;'><td colspan=4>No Records Found.....</td></tr>\").appendTo('tbody');
														else
															loaddata(0);
												</script>";
												echo '
															</tbody>
														</table>
														<div style="width:100%; height:35px; background-color:#4695c0">
															<input class="nav-button" data="back" type="button" value="<" style="height:100%; width:50px; font-weight:bold; font-size:120%;">
															<span><span class="pagecount">'.$count.'</span>/ '.ceil($total/10).'</span>
															<input class="nav-button" data="next" type="button" value=">" style="height:100%; width:50px; font-weight:bold; font-size:120%;">
														</div>
													</div>
												';
												
												
											}
											else if($item_type=='Answers'&&$transaction_type=='Purchase'){
												echo '
													<div style="border-top-left-radius:10px; border-top-right-radius:10px; overflow:hidden;">
														<table  style=" border-collapse:collapse; width:100%;">
															<thead >
																<tr style="background-color:#4695c0; color:white; height: 35px; "><th>Transaction Id</th><th style="width:65%">Answer Abstract</th><th>Bounty</th><th>Date Time</th></tr>
															</thead>
															<tbody id="tbody">
														';
												echo "<script>
														if(total==0)
															$(\"<tr style='  height: 25px; background-color:#b4d4f4; border-bottom:1px solid grey;'><td colspan=4>No Records Found.....</td></tr>\").appendTo('tbody');
														else
															loaddata(0);
												</script>";
												echo '
															</tbody>
														</table>
														<div style="width:100%; height:35px; background-color:#4695c0">
															<input class="nav-button" data="back" type="button" value="<" style="height:100%; width:50px; font-weight:bold; font-size:120%;">
															<span><span class="pagecount">'.$count.'</span>/ '.ceil($total/10).'</span>
															<input class="nav-button" data="next" type="button" value=">" style="height:100%; width:50px; font-weight:bold; font-size:120%;">
														</div>
													</div>
												';
												
											}
											else if($item_type=='Answers'&&$transaction_type=='Sold'){
												echo '
													<div style="border-top-left-radius:10px; border-top-right-radius:10px; overflow:hidden;">
														<table  style=" border-collapse:collapse; width:100%;">
															<thead >
																<tr style="background-color:#4695c0; color:white; height: 35px; "><th>Transaction Id</th><th style="width:65%">Answer Abstract</th><th>Bounty</th><th>Date Time</th></tr>
															</thead>
															<tbody id="tbody">
														';
												echo "<script>
														if(total==0)
															$(\"<tr style='  height: 25px; background-color:#b4d4f4; border-bottom:1px solid grey;'><td colspan=4>No Records Found.....</td></tr>\").appendTo('tbody');
														else
															loaddata(0);
												</script>";
												echo '
															</tbody>
														</table>
														<div style="width:100%; height:35px; background-color:#4695c0">
															<input class="nav-button" data="back" type="button" value="<" style="height:100%; width:50px; font-weight:bold; font-size:120%;">
															<span><span class="pagecount">'.$count.'</span>/ '.ceil($total/10).'</span>
															<input class="nav-button" data="next" type="button" value=">" style="height:100%; width:50px; font-weight:bold; font-size:120%;">
														</div>
													</div>
												';
												
												
											}
									}
								}
							?>
						</div>
					</div>
				</div>			
			</div>		
		</div>
		<?php
			include_once './include/footer.php';
		?>
	</body>
</html>