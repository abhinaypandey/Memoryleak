<?php 
	include_once './include/lock_admin.php';
	if(!isset($_GET['tid'])){
		header("location: withdrawal_requests.php");
	}
	else{
		include './include/connection.php';
		$tid=mysqli_real_escape_string($con,trim($_GET['tid']));
		$result=mysqli_query($con,"select * from withdrawals where transaction_id=$tid");
		if(!mysqli_num_rows($result)){
			echo "<script>alert('Invalid Transaction');
			window.location.href = 'withdrawal_requests.php';
			</script>			
			";			
		}
		else{
			$row=mysqli_fetch_array($result);
			if($row['payment_status']=="Completed"){
				echo "<script>alert('Transaction already Completed');
				window.location.href = 'withdrawal_requests.php';
				</script>			
				";					
			}
			else{
				echo "<script>var tid=$tid;</script>";
			}
		}
			
	}
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
			$(document).ready(function(){

				$("#save").click(function(){
					if($("#ptid").val()==""){
						alert("Please enter the Paypal Transaction ID");
						$("#ptid").focus();
						return false;
					}
					else{
						var ptid=$("#ptid").val();
						$.ajax({
							type:'POST',
							url:'query.php',
							data:{ 
							type:2,
							tid:tid,
							ptid:ptid
							}
						}).done(function(data){
								if($.trim(data)=='1'){
									alert("Transaction Updated Sucessfully");
									window.location.href = 'withdrawal_requests.php';
								}
								else{
									alert("Somthing went wrong please try again later");
									window.location.href = 'withdrawal_requests.php';
								}
						});
					}
				});
				
				$("#msave").click(function(){
					if($("#mptid").val()==""){
						alert("Please enter the Paypal Transaction ID");
						$("#mptid").focus();
						return false;
					}
					else{
						var mptid=$("#mptid").val();
						$.ajax({
							type:'POST',
							url:'query.php',
							data:{ 
							type:2,
							tid:tid,
							ptid:mptid
							}
						}).done(function(data){
							if($.trim(data)=='1'){
								alert("Transaction Updated Sucessfully");
								window.location.href = 'withdrawal_requests.php';
							}
							else{
								alert("Somthing went wrong please try again later");
								window.location.href = 'withdrawal_requests.php';
							}
						});
					
					
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
					<h2>Withdrawal Requests</h2>
					<br/>
					<div>
						<table>
							<tr><td>Paypal Transaction Id </td><td><input type="text" id="ptid"></td></tr>
							
							<tr><td></td><td><input type="button" value="Submit" id="save"></td></tr>
						</table>
						
						<br/>
						
					</div>
				</div>
				
				
			</div>		
			<div class="mcontent">
				<div style="width:90%; margin:0 3%; padding:2%; margin-top:50px; background-color:white; opacity:0.8;">
					<h2>Withdrawal Requests</h2>
					<br/>
					<div>
						<table>
							<tr><td>Paypal Transaction Id </td><td><input type="text" id="mptid"></td></tr>
							
							<tr><td></td><td><input type="button" value="Submit" id="msave"></td></tr>
						</table>
						
						<br/>
						
					</div>
				</div>
			
				
				
			</div>		
		</div>
		<?php
			include_once './include/footer.php';
		?>
	</body>
</html>