<?php 
	include_once './include/lock_normal.php';
?>
<!DOCTYPE html>
<html>
	<head>
        <link rel="shortcut icon" href="./images/logo.png">
		<title>Transaction Details</title>
		<?php
			include_once './include/head.php';
			if(!isset($_GET['tid'])||!isset($_GET['type'])){
				header('Location: index.php');		
			}
		?>
		<style>
			.details div{
				padding-left:10px;
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
				<div style="width:76%; margin:0 10%; padding:2%; margin-top:50px; background-color:white; opacity:0.8;">
					<?php 
						include './include/connection.php';
						$tid=mysqli_real_escape_string($con,trim($_GET['tid']));
						$type=mysqli_real_escape_string($con,trim($_GET['type']));
						if($type!='withdraw'&&$type=='project'){
//							$result=mysqli_query($con,"select * from transactions,answer_accounts,project_accounts where transactions.transaction_id=$tid and (user_id=$login_session or answer_accounts.buy_from=$login_session or project_accounts.buy_from=$login_session)");
//                            $result=mysqli_query($con,"select answer_accounts.answer_id,transactions.user_id, transactions.paypal_transaction_id, transactions.date_time, transactions.paypal_email_id, transactions.gross_amount,transactions.fee_amount, transactions.payment_status, answers.solution, answer_accounts.bounty from transactions, answer_accounts, answers where transactions.transaction_id=$tid and (transactions.user_id=$login_session or answer_accounts.buy_from=$login_session) and answer_accounts.answer_id=answers.answer_id and transactions.transaction_id=answer_accounts.transaction_id");
                            $result=mysqli_query($con,"select project_accounts.project_id,transactions.user_id, transactions.paypal_transaction_id, transactions.date_time, transactions.paypal_email_id, transactions.gross_amount,transactions.fee_amount, transactions.payment_status, projects.title, project_accounts.bounty from transactions, project_accounts , projects where transactions.transaction_id=$tid and (transactions.user_id=$login_session or project_accounts.buy_from=$login_session)  and project_accounts.project_id=projects.project_id and  transactions.transaction_id=project_accounts.transaction_id");
							if(!mysqli_num_rows($result)){
								echo '<script>alert("Invalid transaction selected");
									window.location.href=""./index.php;
								</script>';
							}
							else{
								$row=mysqli_fetch_array($result);
								$paypal_transaction_id=$row['paypal_transaction_id'];
								$date_time=$row['date_time'];
								$paypal_payer_id=$row['paypal_email_id'];
								$gross_amount=$row['gross_amount'];
								$fee_amount=$row['fee_amount'];
								$payment_status=$row['payment_status'];
								
								if($row['user_id']==$login_session){
									echo "
                                                
												<h1>Transaction Detail</h1>
												
												<div class=\"details\" style='border:1px solid black;'>
													<div style='border-bottom:1px solid black; background-color: #4695C0; color: #FFF;'>Transaction Id</div>
													<div>$tid</div>
													<div style='border-bottom:1px solid black; background-color: #4695C0; color: #FFF;'>Paypal Transaction Id</div>
													<div>$paypal_transaction_id</div>
													<div style='border-bottom:1px solid black; background-color: #4695C0; color: #FFF;'>Transaction Date Time</div>
													<div>$date_time</div>
													<div style='border-bottom:1px solid black; background-color: #4695C0; color: #FFF;'>PayPal Payer Id</div>
													<div>$paypal_payer_id</div>
													<div style='border-bottom:1px solid black; background-color: #4695C0; color: #FFF;'>Transaction Total</div>
													<div>$".($gross_amount+$fee_amount)."</div>
													<div style='border-bottom:1px solid black; background-color: #4695C0; color: #FFF;'>Gross Amount</div>
													<div>$$gross_amount</div>
													<div style='border-bottom:1px solid black; background-color: #4695C0; color: #FFF;'>Fee Amount</div>
													<div>$$fee_amount</div>
												</div>
													
												<br/>
												<h2>Transaction Contains</h2>
												<br/>
												<table width=100% style='border:1px solid black;' >
												<tr style='border-bottom:1px solid black; color:#FFF; background-color:#4695C0;'><th>Item Id</th><th>Item Description</th><th>Bounty</th></tr>
												";
                                    
                                    
//									$content_result=mysqli_query($con,"select answer_accounts.answer_id,answer_accounts.bounty, answers.abstract from answer_accounts,answers where transaction_id=$tid");
                                    $content_result=mysqli_query($con,"select answer_accounts.answer_id,answers.bounty, answers.abstract from answer_accounts,answers where transaction_id=$tid and answer_accounts.answer_id=answers.answer_id");
									while($content=mysqli_fetch_array($content_result)){
                                        if(strlen($content['abstract'])>80){
                                            $content['abstract']=substr($content['abstract'],0,79).' ...';
                                        }
                                        
										echo '<tr><td>A_'.$content['answer_id'].'</td><td>'.$content['abstract'].'</td><td>$'.$content['bounty'].'</td></tr>';
									}
//									$content_result=mysqli_query($con,"select project_accounts.project_id,project_accounts.bounty,projects.title from project_accounts,projects where transaction_id=$tid");
                                    $content_result=mysqli_query($con,"select project_accounts.project_id,projects.bounty,projects.title from project_accounts,projects where transaction_id=$tid and project_accounts.project_id=projects.project_id");
									while($content=mysqli_fetch_array($content_result)){
                                        if(strlen($content['title'])>80){
                                            $content['title']=substr($content['title'],0,79).' ...';
                                        }
										echo '<tr><td>P_'.$content['project_id'].'</td><td>'.$content['title'].'</td><td>$'.$content['bounty'].'</td></tr>';
									}			
									echo"
												</table>
									";
									
								}
								else{
								    
									echo "
												<h1>Transaction Detail</h1>
												<div class=\"details\" style='border:1px solid black;'>
													<div style='border-bottom:1px solid black; background-color: #4695C0; color: #FFF;'>Transaction Id</div>
													<div>$tid</div>
													<div style='border-bottom:1px solid black; background-color: #4695C0; color: #FFF;'>Paypal Transaction Id</div>
													<div>$paypal_transaction_id</div>
													<div style='border-bottom:1px solid black; background-color: #4695C0; color: #FFF;'>Transaction Date Time</div>
													<div>$date_time</div>
												</div>
												
												<br/>
												<h2>Transaction Contains</h2>
												<br/>
												<table width=100% style='border:1px solid black;' >
												<tr style='border-bottom:1px solid black; color:#FFF; background-color:#4695C0;'><th>Item Id</th><th>Item Description</th><th>Bounty</th></tr>
												";
                                    
                                    
									if(isset($_GET['type'])&&$_GET['type']=='answer'){
										$content_result=mysqli_query($con,"select answer_accounts.answer_id,answers.bounty, answers.abstract from answer_accounts,answers where transaction_id=$tid and answer_accounts.buy_from=$login_session and answers.answer_id=answer_accounts.answer_id");
										while($content=mysqli_fetch_array($content_result)){
                                            if(strlen($content['abstract'])>80){
                                                $content['abstract']=substr($content['abstract'],0,79).' ...';
                                            }
                                            
											echo '<tr><td>A_'.$content['answer_id'].'</td><td>'.$content['abstract'].'</td><td>$'.$content['bounty'].'</td></tr>';
										}									
									}
									else if(isset($_GET['type'])&&$_GET['type']=='project'){
										$content_result=mysqli_query($con,"select project_accounts.project_id,projects.bounty,projects.title from project_accounts,projects where transaction_id=$tid and project_accounts.buy_from=$login_session and projects.project_id=project_accounts.project_id ");
										while($content=mysqli_fetch_array($content_result)){
                                            if(strlen($content['title'])>80){
                                                $content['title']=substr($content['title'],0,79).' ...';
                                            }
											echo '<tr><td>P_'.$content['project_id'].'</td><td>'.$content['title'].'</td><td>$'.$content['bounty'].'</td></tr>';
										}			
									}
									else if(isset($_GET['type'])&&$_GET['type']=='new'){
										$content_result=mysqli_query($con,"select project_accounts.project_id,projects.bounty,projects.title from project_accounts,projects where transaction_id=$tid and project_accounts.buy_from=$login_session and projects.project_id=project_accounts.project_id");
										while($content=mysqli_fetch_array($content_result)){
                                            if(strlen($content['title'])>80){
                                                $content['title']=substr($content['title'],0,79).' ...';
                                            }
											echo '<tr><td>P_'.$content['project_id'].'</td><td>'.$content['title'].'</td><td>$'.$content['bounty'].'</td></tr>';
										}		
										$content_result=mysqli_query($con,"select answer_accounts.answer_id,answers.bounty, answers.abstract from answer_accounts,answers where transaction_id=$tid and answer_accounts.buy_from=$login_session and answers.answer_id=answer_accounts.answer_id");
										while($content=mysqli_fetch_array($content_result)){
                                            if(strlen($content['abstract'])>80){
                                                $content['abstract']=substr($content['abstract'],0,79).' ...';
                                            }
											echo '<tr><td>A_'.$content['answer_id'].'</td><td>'.$content['abstract'].'</td><td>$'.$content['bounty'].'</td></tr>';
										}											
									}
									echo"
												</table>
									";
								}
							}
						}
                        else if($type!='withdraw'&&$type=='answer'){
                            $result=mysqli_query($con,"select answer_accounts.answer_id,transactions.user_id, transactions.paypal_transaction_id, transactions.date_time, transactions.paypal_email_id, transactions.gross_amount,transactions.fee_amount, transactions.payment_status, answers.abstract, answer_accounts.bounty from transactions, answer_accounts , answers where transactions.transaction_id=$tid and (transactions.user_id=$login_session or answer_accounts.buy_from=$login_session) and answer_accounts.answer_id=answers.answer_id and transactions.transaction_id=answer_accounts.transaction_id");
							if(!mysqli_num_rows($result)){
								echo '<script>alert("Invalid transaction selected");
									window.location.href=""./index.php;
								</script>';
							}
							else{
								$row=mysqli_fetch_array($result);
								$paypal_transaction_id=$row['paypal_transaction_id'];
								$date_time=$row['date_time'];
								$paypal_payer_id=$row['paypal_email_id'];
								$gross_amount=$row['gross_amount'];
								$fee_amount=$row['fee_amount'];
								$payment_status=$row['payment_status'];
								
								if($row['user_id']==$login_session){
									echo "
                                                
												<h1>Transaction Detail</h1>
												
												<div class=\"details\" style='border:1px solid black;'>
													<div style='border-bottom:1px solid black; background-color: #4695C0; color: #FFF;'>Transaction Id</div>
													<div>$tid</div>
													<div style='border-bottom:1px solid black; background-color: #4695C0; color: #FFF;'>Paypal Transaction Id</div>
													<div>$paypal_transaction_id</div>
													<div style='border-bottom:1px solid black; background-color: #4695C0; color: #FFF;'>Transaction Date Time</div>
													<div>$date_time</div>
													<div style='border-bottom:1px solid black; background-color: #4695C0; color: #FFF;'>PayPal Payer Id</div>
													<div>$paypal_payer_id</div>
													<div style='border-bottom:1px solid black; background-color: #4695C0; color: #FFF;'>Transaction Total</div>
													<div>$".($gross_amount+$fee_amount)."</div>
													<div style='border-bottom:1px solid black; background-color: #4695C0; color: #FFF;'>Gross Amount</div>
													<div>$$gross_amount</div>
													<div style='border-bottom:1px solid black; background-color: #4695C0; color: #FFF;'>Fee Amount</div>
													<div>$$fee_amount</div>
												</div>
													
												<br/>
												<h2>Transaction Contains</h2>
												<br/>
												<table width=100% style='border:1px solid black;' >
												<tr style='border-bottom:1px solid black; color:#FFF; background-color:#4695C0;'><th>Item Id</th><th>Item Description</th><th>Bounty</th></tr>
												";
                                    
                                    
//									$content_result=mysqli_query($con,"select answer_accounts.answer_id,answer_accounts.bounty, answers.abstract from answer_accounts,answers where transaction_id=$tid");
                                    $content_result=mysqli_query($con,"select answer_accounts.answer_id,answers.bounty, answers.abstract from answer_accounts,answers where transaction_id=$tid and answer_accounts.answer_id=answers.answer_id");
									while($content=mysqli_fetch_array($content_result)){
                                        if(strlen($content['abstract'])>80){
                                            $content['abstract']=substr($content['abstract'],0,79).' ...';
                                        }
                                        
										echo '<tr><td>A_'.$content['answer_id'].'</td><td>'.$content['abstract'].'</td><td>$'.$content['bounty'].'</td></tr>';
									}
//									$content_result=mysqli_query($con,"select project_accounts.project_id,project_accounts.bounty,projects.title from project_accounts,projects where transaction_id=$tid");
                                    $content_result=mysqli_query($con,"select project_accounts.project_id,projects.bounty,projects.title from project_accounts,projects where transaction_id=$tid and project_accounts.project_id=projects.project_id");
									while($content=mysqli_fetch_array($content_result)){
                                        if(strlen($content['title'])>80){
                                            $content['title']=substr($content['title'],0,79).' ...';
                                        }
										echo '<tr><td>P_'.$content['project_id'].'</td><td>'.$content['title'].'</td><td>$'.$content['bounty'].'</td></tr>';
									}			
									echo"
												</table>
									";
									
								}
								else{
								    
									echo "
												<h1>Transaction Detail</h1>
												<div class=\"details\" style='border:1px solid black;'>
													<div style='border-bottom:1px solid black; background-color: #4695C0; color: #FFF;'>Transaction Id</div>
													<div>$tid</div>
													<div style='border-bottom:1px solid black; background-color: #4695C0; color: #FFF;'>Paypal Transaction Id</div>
													<div>$paypal_transaction_id</div>
													<div style='border-bottom:1px solid black; background-color: #4695C0; color: #FFF;'>Transaction Date Time</div>
													<div>$date_time</div>
												</div>
												
												<br/>
												<h2>Transaction Contains</h2>
												<br/>
												<table width=100% style='border:1px solid black;' >
												<tr style='border-bottom:1px solid black; color:#FFF; background-color:#4695C0;'><th>Item Id</th><th>Item Description</th><th>Bounty</th></tr>
												";
                                    
                                    
									if(isset($_GET['type'])&&$_GET['type']=='answer'){
										$content_result=mysqli_query($con,"select answer_accounts.answer_id,answers.bounty, answers.abstract from answer_accounts,answers where transaction_id=$tid and answer_accounts.answer_id=answers.answer_id");
										while($content=mysqli_fetch_array($content_result)){
                                            if(strlen($content['abstract'])>80){
                                                $content['abstract']=substr($content['abstract'],0,79).' ...';
                                            }
                                            
											echo '<tr><td>A_'.$content['answer_id'].'</td><td>'.$content['abstract'].'</td><td>$'.$content['bounty'].'</td></tr>';
										}									
									}
									else if(isset($_GET['type'])&&$_GET['type']=='project'){
										$content_result=mysqli_query($con,"select project_accounts.project_id,projects.bounty,projects.title from project_accounts,projects where transaction_id=$tid and project_accounts.project_id=projects.project_id");
										while($content=mysqli_fetch_array($content_result)){
                                            if(strlen($content['title'])>80){
                                                $content['title']=substr($content['title'],0,79).' ...';
                                            }
											echo '<tr><td>P_'.$content['project_id'].'</td><td>'.$content['title'].'</td><td>$'.$content['bounty'].'</td></tr>';
										}			
									}
									else if(isset($_GET['type'])&&$_GET['type']=='new'){
										$content_result=mysqli_query($con,"select project_accounts.project_id,projects.bounty,projects.title from project_accounts,projects where transaction_id=$tid and project_accounts.project_id=projects.project_id");
										while($content=mysqli_fetch_array($content_result)){
                                            if(strlen($content['title'])>80){
                                                $content['title']=substr($content['title'],0,79).' ...';
                                            }
											echo '<tr><td>P_'.$content['project_id'].'</td><td>'.$content['title'].'</td><td>$'.$content['bounty'].'</td></tr>';
										}		
										$content_result=mysqli_query($con,"select answer_accounts.answer_id,answers.bounty, answers.abstract from answer_accounts,answers where transaction_id=$tid and answer_accounts.answer_id=answers.answer_id");
										while($content=mysqli_fetch_array($content_result)){
                                            if(strlen($content['abstract'])>80){
                                                $content['abstract']=substr($content['abstract'],0,79).' ...';
                                            }
											echo '<tr><td>A_'.$content['answer_id'].'</td><td>'.$content['abstract'].'</td><td>$'.$content['bounty'].'</td></tr>';
										}											
									}
									echo"
												</table>
									";
								}
							}
						}
						else if($type=='withdraw'){
							$result=mysqli_query($con,"select * from withdrawals where transaction_id=$tid and user_id=$login_session");
							if(!mysqli_num_rows($result)){
								echo '<script>alert("Invalid transaction selected");
									window.location.href="index.php";
								</script>';
							}
							else{
								$row=mysqli_fetch_array($result);
								$paypal_transaction_id=$row['paypal_transaction_id'];
								$date_time=$row['date_time'];
								$paypal_payer_id=$row['paypal_email_id'];
								$amount=$row['amount'];
								$payment_status=$row['payment_status'];
								$payment_date=$row['payment_date'];
								echo "
									<h1>Transaction Detail</h1>												
									<div class=\"details\" style='border:1px solid black;'>
										<div style='border-bottom:1px solid black; background-color: #4695C0; color: #FFF;'>Transaction Id</div>
										<div>$tid</div>
										<div style='border-bottom:1px solid black; background-color: #4695C0; color: #FFF;'>Paypal Transaction Id</div>
										<div>$paypal_transaction_id</div>
										<div style='border-bottom:1px solid black; background-color: #4695C0; color: #FFF;'>Transfered to Payer Id</div>
										<div>$paypal_payer_id</div>
										<div style='border-bottom:1px solid black; background-color: #4695C0; color: #FFF;'>Transaction Status</div>
										<div>$payment_status</div>
										<div style='border-bottom:1px solid black; background-color: #4695C0; color: #FFF;'>Transaction Amount</div>
										<div>$$amount</div>
										<div style='border-bottom:1px solid black; background-color: #4695C0; color: #FFF;'>Transaction Date Time</div>
										<div>$payment_date</div>
										<div style='border-bottom:1px solid black; background-color: #4695C0; color: #FFF;'>Request Date Time</div>
										<div>$date_time</div>
									</div>
								";
						
							}
						}
						mysqli_close($con);
					?>
				</div>			
			</div>		
			<div class="mcontent">
				<div style="width:90%; margin:0 3%; padding:2%; margin-top:50px; background-color:white; opacity:0.8;">
					<?php 
						include './include/connection.php';
						$tid=mysqli_real_escape_string($con,trim($_GET['tid']));
						$type=mysqli_real_escape_string($con,trim($_GET['type']));
						if($type!='withdraw'&&$type=='project'){
//							$result=mysqli_query($con,"select * from transactions,answer_accounts,project_accounts where transactions.transaction_id=$tid and (user_id=$login_session or answer_accounts.buy_from=$login_session or project_accounts.buy_from=$login_session)");
                            $result=mysqli_query($con,"select project_accounts.project_id,transactions.user_id, transactions.paypal_transaction_id, transactions.date_time, transactions.paypal_email_id, transactions.gross_amount,transactions.fee_amount, transactions.payment_status, projects.title, project_accounts.bounty from transactions, project_accounts , projects where transactions.transaction_id=$tid and (transactions.user_id=$login_session or project_accounts.buy_from=$login_session)  and project_accounts.project_id=projects.project_id and  transactions.transaction_id=project_accounts.transaction_id");
							if(!mysqli_num_rows($result)){
								echo '<script>alert("Invalid transaction selected");
									window.location.href="index.php";
								</script>';
							}
							else{
								$row=mysqli_fetch_array($result);
								$paypal_transaction_id=$row['paypal_transaction_id'];
								$date_time=$row['date_time'];
								$paypal_payer_id=$row['paypal_email_id'];
								$gross_amount=$row['gross_amount'];
								$fee_amount=$row['fee_amount'];
								$payment_status=$row['payment_status'];
								
								if($row['user_id']==$login_session){
									echo "
                                        <h1>Transaction Detail</h1>

                                        <div class=\"details\" style='border:1px solid black;'>
                                            <div style='border-bottom:1px solid black; background-color: #4695C0; color: #FFF;'>Transaction Id</div>
                                            <div>$tid</div>
                                            <div style='border-bottom:1px solid black; background-color: #4695C0; color: #FFF;'>Paypal Transaction Id</div>
                                            <div>$paypal_transaction_id</div>
                                            <div style='border-bottom:1px solid black; background-color: #4695C0; color: #FFF;'>Transaction Date Time</div>
                                            <div>$date_time</div>
                                            <div style='border-bottom:1px solid black; background-color: #4695C0; color: #FFF;'>PayPal Payer Id</div>
                                            <div>$paypal_payer_id</div>
                                            <div style='border-bottom:1px solid black; background-color: #4695C0; color: #FFF;'>Transaction Total</div>
                                            <div>$".($gross_amount+$fee_amount)."</div>
                                            <div style='border-bottom:1px solid black; background-color: #4695C0; color: #FFF;'>Gross Amount</div>
                                            <div>$$gross_amount</div>
                                            <div style='border-bottom:1px solid black; background-color: #4695C0; color: #FFF;'>Fee Amount</div>
                                            <div>$$fee_amount</div>
                                        </div>

                                        <br/>
                                        <h2>Transaction Contains</h2>
                                        <br/>
                                        <table width=100% style='border:1px solid black;' >
                                        <tr style='border-bottom:1px solid black; color:#FFF; background-color:#4695C0;'><th>Item Id</th><th>Item Description</th><th>Bounty</th></tr>
                                        ";
                                    
//									$content_result=mysqli_query($con,"select answer_accounts.answer_id,answer_accounts.bounty, answers.abstract from answer_accounts,answers where transaction_id=$tid");
                                    $content_result=mysqli_query($con,"select answer_accounts.answer_id,answers.bounty, answers.abstract from answer_accounts,answers where transaction_id=$tid and answer_accounts.answer_id=answers.answer_id");
									while($content=mysqli_fetch_array($content_result)){
                                        if(strlen($content['abstract'])>35){
                                            $content['abstract']=substr($content['abstract'],0,34).' ...';
                                        }
                                        
										echo '<tr><td>A_'.$content['answer_id'].'</td><td>'.$content['abstract'].'</td><td>$'.$content['bounty'].'</td></tr>';
									}
//									$content_result=mysqli_query($con,"select project_accounts.project_id,project_accounts.bounty,projects.title from project_accounts,projects where transaction_id=$tid");
                                    $content_result=mysqli_query($con,"select project_accounts.project_id,projects.bounty,projects.title from project_accounts,projects where transaction_id=$tid and project_accounts.project_id=projects.project_id");
									while($content=mysqli_fetch_array($content_result)){
                                        if(strlen($content['title'])>35){
                                            $content['title']=substr($content['title'],0,34).' ...';
                                        }
										echo '<tr><td>P_'.$content['project_id'].'</td><td>'.$content['title'].'</td><td>$'.$content['bounty'].'</td></tr>';
									}			
									echo"
												</table>
									";
									
								}
								else{
								
									echo "
												<h1>Transaction Detail</h1>
												<div class=\"details\" style='border:1px solid black;'>
													<div style='border-bottom:1px solid black; background-color: #4695C0; color: #FFF;'>Transaction Id</div>
													<div>$tid</div>
													<div style='border-bottom:1px solid black; background-color: #4695C0; color: #FFF;'>Paypal Transaction Id</div>
													<div>$paypal_transaction_id</div>
													<div style='border-bottom:1px solid black; background-color: #4695C0; color: #FFF;'>Transaction Date Time</div>
													<div>$date_time</div>
												</div>
												
												<br/>
												<h2>Transaction Contains</h2>
												<br/>
												<table width=100% style='border:1px solid black;' >
												<tr style='border-bottom:1px solid black; color:#FFF; background-color:#4695C0;'><th>Item Id</th><th>Item Description</th><th>Bounty</th></tr>
												";
                                    
									if(isset($_GET['type'])&&$_GET['type']=='answer'){
										$content_result=mysqli_query($con,"select answer_accounts.answer_id,answers.bounty, answers.abstract from answer_accounts,answers where transaction_id=$tid and answer_accounts.buy_from=$login_session and answers.answer_id=answer_accounts.answer_id");
										while($content=mysqli_fetch_array($content_result)){
                                            if(strlen($content['abstract'])>35){
                                                $content['abstract']=substr($content['abstract'],0,34).' ...';
                                            }
                                            
											echo '<tr><td>A_'.$content['answer_id'].'</td><td>'.$content['abstract'].'</td><td>$'.$content['bounty'].'</td></tr>';
										}									
									}
									else if(isset($_GET['type'])&&$_GET['type']=='project'){
										$content_result=mysqli_query($con,"select project_accounts.project_id,projects.bounty,projects.title from project_accounts,projects where transaction_id=$tid and project_accounts.buy_from=$login_session and projects.project_id=project_accounts.project_id ");
										while($content=mysqli_fetch_array($content_result)){
                                            if(strlen($content['title'])>35){
                                                $content['title']=substr($content['title'],0,34).' ...';
                                            }
											echo '<tr><td>P_'.$content['project_id'].'</td><td>'.$content['title'].'</td><td>$'.$content['bounty'].'</td></tr>';
										}			
									}
									else if(isset($_GET['type'])&&$_GET['type']=='new'){
										$content_result=mysqli_query($con,"select project_accounts.project_id,projects.bounty,projects.title from project_accounts,projects where transaction_id=$tid and project_accounts.buy_from=$login_session and projects.project_id=project_accounts.project_id");
										while($content=mysqli_fetch_array($content_result)){
                                            if(strlen($content['title'])>35){
                                                $content['title']=substr($content['title'],0,34).' ...';
                                            }
											echo '<tr><td>P_'.$content['project_id'].'</td><td>'.$content['title'].'</td><td>$'.$content['bounty'].'</td></tr>';
										}		
										$content_result=mysqli_query($con,"select answer_accounts.answer_id,answers.bounty, answers.abstract from answer_accounts,answers where transaction_id=$tid and answer_accounts.buy_from=$login_session and answers.answer_id=answer_accounts.answer_id");
										while($content=mysqli_fetch_array($content_result)){
                                            if(strlen($content['abstract'])>35){
                                                $content['abstract']=substr($content['abstract'],0,34).' ...';
                                            }
											echo '<tr><td>A_'.$content['answer_id'].'</td><td>'.$content['abstract'].'</td><td>$'.$content['bounty'].'</td></tr>';
										}											
									}
									echo"
												</table>
									";
								}
							}
						}
                        if($type!='withdraw'&&$type=='answer'){
//							$result=mysqli_query($con,"select * from transactions,answer_accounts,project_accounts where transactions.transaction_id=$tid and (user_id=$login_session or answer_accounts.buy_from=$login_session or project_accounts.buy_from=$login_session)");
                            $result=mysqli_query($con,"select answer_accounts.answer_id,transactions.user_id, transactions.paypal_transaction_id, transactions.date_time, transactions.paypal_email_id, transactions.gross_amount,transactions.fee_amount, transactions.payment_status, answers.abstract, answer_accounts.bounty from transactions, answer_accounts , answers where transactions.transaction_id=$tid and (transactions.user_id=$login_session or answer_accounts.buy_from=$login_session) and answer_accounts.answer_id=answers.answer_id and transactions.transaction_id=answer_accounts.transaction_id");
							if(!mysqli_num_rows($result)){
								echo '<script>alert("Invalid transaction selected");
									window.location.href="index.php";
								</script>';
							}
							else{
								$row=mysqli_fetch_array($result);
								$paypal_transaction_id=$row['paypal_transaction_id'];
								$date_time=$row['date_time'];
								$paypal_payer_id=$row['paypal_email_id'];
								$gross_amount=$row['gross_amount'];
								$fee_amount=$row['fee_amount'];
								$payment_status=$row['payment_status'];
								
								if($row['user_id']==$login_session){
									echo "
                                        <h1>Transaction Detail</h1>

                                        <div class=\"details\" style='border:1px solid black;'>
                                            <div style='border-bottom:1px solid black; background-color: #4695C0; color: #FFF;'>Transaction Id</div>
                                            <div>$tid</div>
                                            <div style='border-bottom:1px solid black; background-color: #4695C0; color: #FFF;'>Paypal Transaction Id</div>
                                            <div>$paypal_transaction_id</div>
                                            <div style='border-bottom:1px solid black; background-color: #4695C0; color: #FFF;'>Transaction Date Time</div>
                                            <div>$date_time</div>
                                            <div style='border-bottom:1px solid black; background-color: #4695C0; color: #FFF;'>PayPal Payer Id</div>
                                            <div>$paypal_payer_id</div>
                                            <div style='border-bottom:1px solid black; background-color: #4695C0; color: #FFF;'>Transaction Total</div>
                                            <div>$".($gross_amount+$fee_amount)."</div>
                                            <div style='border-bottom:1px solid black; background-color: #4695C0; color: #FFF;'>Gross Amount</div>
                                            <div>$$gross_amount</div>
                                            <div style='border-bottom:1px solid black; background-color: #4695C0; color: #FFF;'>Fee Amount</div>
                                            <div>$$fee_amount</div>
                                        </div>

                                        <br/>
                                        <h2>Transaction Contains</h2>
                                        <br/>
                                        <table width=100% style='border:1px solid black;' >
                                        <tr style='border-bottom:1px solid black; color:#FFF; background-color:#4695C0;'><th>Item Id</th><th>Item Description</th><th>Bounty</th></tr>
                                        ";
                                    
//									$content_result=mysqli_query($con,"select answer_accounts.answer_id,answer_accounts.bounty, answers.abstract from answer_accounts,answers where transaction_id=$tid");
                                    $content_result=mysqli_query($con,"select answer_accounts.answer_id,answers.bounty, answers.abstract from answer_accounts,answers where transaction_id=$tid and answer_accounts.answer_id=answers.answer_id");
									while($content=mysqli_fetch_array($content_result)){
                                        if(strlen($content['abstract'])>35){
                                            $content['abstract']=substr($content['abstract'],0,34).' ...';
                                        }
                                        
										echo '<tr><td>A_'.$content['answer_id'].'</td><td>'.$content['abstract'].'</td><td>$'.$content['bounty'].'</td></tr>';
									}
//									$content_result=mysqli_query($con,"select project_accounts.project_id,project_accounts.bounty,projects.title from project_accounts,projects where transaction_id=$tid");
                                    $content_result=mysqli_query($con,"select project_accounts.project_id,project_accounts.bounty,projects.title from project_accounts,projects where transaction_id=$tid and project_accounts.project_id=projects.project_id");
									while($content=mysqli_fetch_array($content_result)){
                                        if(strlen($content['title'])>35){
                                            $content['title']=substr($content['title'],0,34).' ...';
                                        }
										echo '<tr><td>P_'.$content['project_id'].'</td><td>'.$content['title'].'</td><td>$'.$content['bounty'].'</td></tr>';
									}			
									echo"
												</table>
									";
									
								}
								else{
								
									echo "
												<h1>Transaction Detail</h1>
												<div class=\"details\" style='border:1px solid black;'>
													<div style='border-bottom:1px solid black; background-color: #4695C0; color: #FFF;'>Transaction Id</div>
													<div>$tid</div>
													<div style='border-bottom:1px solid black; background-color: #4695C0; color: #FFF;'>Paypal Transaction Id</div>
													<div>$paypal_transaction_id</div>
													<div style='border-bottom:1px solid black; background-color: #4695C0; color: #FFF;'>Transaction Date Time</div>
													<div>$date_time</div>
												</div>
												
												<br/>
												<h2>Transaction Contains</h2>
												<br/>
												<table width=100% style='border:1px solid black;' >
												<tr style='border-bottom:1px solid black; color:#FFF; background-color:#4695C0;'><th>Item Id</th><th>Item Description</th><th>Bounty</th></tr>
												";
                                    
									if(isset($_GET['type'])&&$_GET['type']=='answer'){
										$content_result=mysqli_query($con,"select answer_accounts.answer_id,answers.bounty, answers.abstract from answer_accounts,answers where transaction_id=$tid and answer_accounts.answer_id=answers.answer_id");
										while($content=mysqli_fetch_array($content_result)){
                                            if(strlen($content['abstract'])>35){
                                                $content['abstract']=substr($content['abstract'],0,).' ...';
                                            }
                                            
											echo '<tr><td>A_'.$content['answer_id'].'</td><td>'.$content['abstract'].'</td><td>$'.$content['bounty'].'</td></tr>';
										}									
									}
									else if(isset($_GET['type'])&&$_GET['type']=='project'){
										$content_result=mysqli_query($con,"select project_accounts.project_id,projects.bounty,projects.title from project_accounts,projects where transaction_id=$tid and project_accounts.project_id=projects.project_id");
										while($content=mysqli_fetch_array($content_result)){
                                            if(strlen($content['title'])>35){
                                                $content['title']=substr($content['title'],0,34).' ...';
                                            }
											echo '<tr><td>P_'.$content['project_id'].'</td><td>'.$content['title'].'</td><td>$'.$content['bounty'].'</td></tr>';
										}			
									}
									else if(isset($_GET['type'])&&$_GET['type']=='new'){
										$content_result=mysqli_query($con,"select project_accounts.project_id,projects.bounty,projects.title from project_accounts,projects where transaction_id=$tid and project_accounts.project_id=projects.project_id");
										while($content=mysqli_fetch_array($content_result)){
                                            if(strlen($content['title'])>35){
                                                $content['title']=substr($content['title'],0,34).' ...';
                                            }
											echo '<tr><td>P_'.$content['project_id'].'</td><td>'.$content['title'].'</td><td>$'.$content['bounty'].'</td></tr>';
										}		
										$content_result=mysqli_query($con,"select answer_accounts.answer_id,answers.bounty, answers.abstract from answer_accounts,answers where transaction_id=$tid and answer_accounts.answer_id=answers.answer_id");
										while($content=mysqli_fetch_array($content_result)){
                                            if(strlen($content['abstract'])>35){
                                                $content['abstract']=substr($content['abstract'],0,34).' ...';
                                            }
											echo '<tr><td>A_'.$content['answer_id'].'</td><td>'.$content['abstract'].'</td><td>$'.$content['bounty'].'</td></tr>';
										}											
									}
									echo"
												</table>
									";
								}
							}
						}
						else if($type=='withdraw'){
							$result=mysqli_query($con,"select * from withdrawals where transaction_id=$tid and user_id=$login_session");
							if(!mysqli_num_rows($result)){
								echo '<script>alert("Invalid transaction selected");
									window.location.href="index.php";
								</script>';
							}
							else{
								$row=mysqli_fetch_array($result);
								$paypal_transaction_id=$row['paypal_transaction_id'];
								$date_time=$row['date_time'];
								$paypal_payer_id=$row['paypal_email_id'];
								$amount=$row['amount'];
								$payment_status=$row['payment_status'];
								$payment_date=$row['payment_date'];
								echo "
									<h1>Transaction Detail</h1>												
									<div class=\"details\" style='border:1px solid black;'>
										<div style='border-bottom:1px solid black; background-color: #4695C0; color: #FFF;'>Transaction Id</div>
										<div>$tid</div>
										<div style='border-bottom:1px solid black; background-color: #4695C0; color: #FFF;'>Paypal Transaction Id</div>
										<div>$paypal_transaction_id</div>
										<div style='border-bottom:1px solid black; background-color: #4695C0; color: #FFF;'>Transfered to Payer Id</div>
										<div>$paypal_payer_id</div>
										<div style='border-bottom:1px solid black; background-color: #4695C0; color: #FFF;'>Transaction Status</div>
										<div>$payment_status</div>
										<div style='border-bottom:1px solid black; background-color: #4695C0; color: #FFF;'>Transaction Amount</div>
										<div>$$amount</div>
										<div style='border-bottom:1px solid black; background-color: #4695C0; color: #FFF;'>Transaction Date Time</div>
										<div>$payment_date</div>
										<div style='border-bottom:1px solid black; background-color: #4695C0; color: #FFF;'>Request Date Time</div>
										<div>$date_time</div>
									</div>
								";
						
							}
						}
						mysqli_close($con);
					?>
				</div>
			</div>		
		</div>
		<?php
			include_once './include/footer.php';
		?>
	</body>
</html>