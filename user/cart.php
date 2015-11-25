<?php 
	include_once './include/lock_normal.php';
?>
<!DOCTYPE html>
<html>
	<head>
        <link rel="shortcut icon" href="./images/logo.png">
       	<title>Checkout</title>
		<?php
			include_once './include/head.php';
		?>
		<style>
			th{
				text-align:left;
				border-bottom:1px solid;
			}
			.remove{
				cursor:pointer;
				color:red;
			}
			.item_id:hover{
				color:red;
			}
			
		</style>
		<script>
			$(document).ready(function(){
				$('.remove').click(function(){
					var item_id=$.trim($(this).attr('id'));
					var item_type=$.trim($(this).attr('data'));
					
					$.ajax({
						type:'POST',
						url:'query.php',
						data:{ 
						type:1,
						item_id:item_id,
						item_type:item_type
						}
					}).done(function(data){
							if($.trim(data)=='1'){
								window.location.href = './cart.php';
							}
					});
				});
				
				$('.checkout').click(function(){
					window.location.href = './payment/checkout.php';
				});
				
			});
			function show(type,id){	
				if(type=='A'){
					alert('Answer: '+id);
				}
				else if(type='P'){
					alert('Project: '+id);
				}
			}
		</script>
	</head>
	<body>
		<?php
			include_once './include/menu.php';
		?>
		<div class="body">
			<div class="content">
				<div style="width:76%; height:200px; margin:0 10%; padding:2%; margin-top:50px; background-color:white;">
					<div style=" width:100%; font-family: Roboto Slab, 'Lucida Grande', Helvetica, Arial, sans-serif;"><h1>Your Cart</h1>
						<div>
							<table width=100%>
								<tr><th>Item ID</th><th>Item Description</th><th style="color:green;">Bounty</th><th></th></tr>
								<?php
									include './include/connection.php';
									$sum=0;
									$result=mysqli_query($con,"select * from answer_carts where user_id=$login_session");
									while($row=mysqli_fetch_array($result)){
										$answer_id=$row['answer_id'];
										$answer=mysqli_query($con,"select * from answers where answer_id=$answer_id");
										$answer_details=mysqli_fetch_array($answer);
										$abstract=$answer_details['abstract'];
                                        if(strlen($abstract)>60){
                                            $abstract=substr($abstract,0,55).' ...';
                                        }
										$bounty=$answer_details['bounty'];
										$sum=$sum+$bounty;
										echo "<tr><td class=\"item_id\" onclick=\"show('A','$answer_id');\" style=\"cursor:pointer;\">A_$answer_id</td><td>$abstract</td><td style=\"color:green;\">$$bounty</td><td class=\"remove\" id=\"$answer_id\" data=\"a\"><img style=\"width:20px; height:20px;\" src=\"./images/trash.png\"/></td></tr>";
									}
									$result=mysqli_query($con,"select * from project_carts where user_id=$login_session");
									while($row=mysqli_fetch_array($result)){
										$project_id=$row['project_id'];
										$project=mysqli_query($con,"select * from projects where project_id=$project_id");
										$project_details=mysqli_fetch_array($project);
										$title=$project_details['title'];
                                        if(strlen($title)>60){
                                            $title=substr($title,0,55).' ...';
                                        }
										$bounty=$project_details['bounty'];
										$sum=$sum+$bounty;
										echo "<tr><td class=\"item_id\" onclick=\"show('P','$project_id');\" style=\"cursor:pointer;\">P_$project_id</td><td>$title</td><td style=\"color:green;\">$$bounty</td><td class=\"remove\" id=\"$project_id\" data=\"p\"><img style=\"width:20px; height:20px;\" src=\"./images/trash.png\"/></td></tr>";
									}
									if($sum==0){
										echo "<tr><td>Cart is empty</td><td></td><td></td><td></td></tr></table>";
									
									}
									else{
										echo "<tr><td></td><td style=\"text-align:right;color:green;\">Total:</td><td style=\"color:green;\">$$sum</td><td></td></tr></table>";
										echo '<div style="font-size:30px;color:green;">Total: $'.$sum.'</div>
											<div style="font-size:25px; cursor:pointer; color:white; border-radius:3px; margin-top:1%;" class="checkout"><img src="https://www.paypal.com/en_US/i/btn/btn_xpressCheckout.gif" align="left" style="margin-right:7px;"></div>
										';
										
									}
									mysqli_close($con);
								?>
							
						</div>
					
					</div>
					
				</div>
			</div>		
			<div class="mcontent">
				<div style="width:86%; height:200px; margin:0 5%; padding:2%; margin-top:50px; background-color:white;">
					<div style=" font-family: Roboto Slab, 'Lucida Grande', Helvetica, Arial, sans-serif;"><h1>Your Cart</h1>
						<div>
							<table  width=100%>
								<tr><th>Item ID</th><th style="color:green;">Bounty</th><th></th></tr>
							
							<?php
								include './include/connection.php';
								$sum=0;
								$result=mysqli_query($con,"select * from answer_carts where user_id=$login_session");
								while($row=mysqli_fetch_array($result)){
									$answer_id=$row['answer_id'];
									$answer=mysqli_query($con,"select * from answers where answer_id=$answer_id");
									$answer_details=mysqli_fetch_array($answer);
									$abstract=$answer_details['abstract'];
                                    
									$bounty=$answer_details['bounty'];
									$sum=$sum+$bounty;
									echo "<tr><td class=\"item_id\" onclick=\"show('A','$answer_id');\" style=\"cursor:pointer;\">A_$answer_id</td><td style=\"color:green;\">$$bounty</td><td class=\"remove\" id=\"$answer_id\" data=\"a\"><img style=\"width:20px; height:20px;\" src=\"./images/trash.png\"/></td></tr>";
								}
								$result=mysqli_query($con,"select * from project_carts where user_id=$login_session");
								while($row=mysqli_fetch_array($result)){
									$project_id=$row['project_id'];
									$project=mysqli_query($con,"select * from projects where project_id=$project_id");
									$project_details=mysqli_fetch_array($project);
									$title=$project_details['title'];
                                    
									$bounty=$project_details['bounty'];
									$sum=$sum+$bounty;
									echo "<tr><td class=\"item_id\" onclick=\"show('P','$project_id');\" style=\"cursor:pointer;\">P_$project_id</td><td style=\"color:green;\">$$bounty</td><td class=\"remove\" id=\"$project_id\" data=\"p\"><img style=\"width:20px; height:20px;\" src=\"./images/trash.png\"/></td></tr>";
								}
								if($sum==0){
									echo "<tr><td>Cart is empty</td><td></td><td></td></tr></table>";
								
								}
								else{
									echo "<tr><td style=\"text-align:right;color:green;\">Total:</td><td style=\"color:green;\">$$sum</td><td></td></tr></table>";
									echo '<div style="font-size:30px; color:green;">Total: $'.$sum.'</div>
										<div style="font-size:25px; cursor:pointer; color:white; border-radius:3px; margin-top:1%;" class="checkout"><img src="https://www.paypal.com/en_US/i/btn/btn_xpressCheckout.gif" align="left" style="margin-right:7px;"></div>
									';
									
								}
								mysqli_close($con);
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