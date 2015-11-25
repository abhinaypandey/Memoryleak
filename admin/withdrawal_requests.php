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
					type:'1',
					count:count
					}
				}).done(function(data){

					$('tbody').html('');
					var obj = jQuery.parseJSON(data);
					$.each(obj,function(i){
	
						if(i%2==0)
							$("<tr style='  height: 25px; background-color:#b4d4f4; border-bottom:1px solid grey;'><td><a href='transaction_finalize.php?tid="+obj[i]['transaction_id']+"'>"+obj[i]['transaction_id']+"</a><td>$"+obj[i]['amount']+"</td><td>"+obj[i]['user_id']+"</td></td><td>"+obj[i]['date_time']+"</td></tr>").appendTo('tbody');
						else
							$("<tr style='  height: 25px; background-color:whitesmoke;'><td><a href='transaction_finalize.php?tid="+obj[i]['transaction_id']+"'>"+obj[i]['transaction_id']+"</a></td><td>$"+obj[i]['amount']+"</td><td>"+obj[i]['user_id']+"</td></td><td>"+obj[i]['date_time']+"</td></tr>").appendTo('tbody');

							
					});
				});				
			}
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
					<div style="border-top-left-radius:10px; border-top-right-radius:10px; overflow:hidden;">
						<table  style=" border-collapse:collapse; width:100%;">
							<thead >
								<tr style="background-color:#4695c0; color:white; height: 35px; "><th>Transaction Id</th><th>Amount</th><th>User Id</th><th>Date Time</th></tr>
							</thead>
							<tbody id="tbody">
							<?php
								include './include/connection.php';
								$result=mysqli_query($con,'select count(*) as total from withdrawals where payment_status=\'Requesting\' and notify=1');
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
							<span><span class="pagecount">'.$count.'</span>/ '.ceil($total/10).'<span>
							<input class="nav-button" data="next" type="button" value=">" style="height:100%; width:50px; font-weight:bold; font-size:120%;">
						</div>
					</div>
										';
							?>
				</div>
			</div>		
			<div class="mcontent">
				<div style="width:90%; margin:0 3%; padding:2%; margin-top:50px; background-color:white; opacity:0.8;">
					<h2>Withdrawal Requests</h2>
					<br/>
					<div style="border-top-left-radius:10px; border-top-right-radius:10px; overflow:hidden;">
						<table  style=" border-collapse:collapse; width:100%;">
							<thead >
								<tr style="background-color:#4695c0; color:white; height: 35px; "><th>Transaction Id</th><th>Amount</th><th>User Id</th><th>Date Time</th></tr>
							</thead>
							<tbody id="tbody">
							<script>
								if(total==0)
									$("<tr style='  height: 25px; background-color:#b4d4f4; border-bottom:1px solid grey;'><td colspan=4>No Records Found.....</td></tr>").appendTo('tbody');
								else
									loaddata(0);
							</script>
							</tbody>
						</table>
						<div style="width:100%; height:35px; background-color:#4695c0">
							<input class="nav-button" data="back" type="button" value="<" style="height:100%; width:50px; font-weight:bold; font-size:120%;">
							<span><span class="pagecount"><?php echo $count; ?></span>/ <?php echo ceil($total/10); ?><span>
							<input class="nav-button" data="next" type="button" value=">" style="height:100%; width:50px; font-weight:bold; font-size:120%;">
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