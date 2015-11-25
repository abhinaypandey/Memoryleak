<?php 
	include_once './include/lock_normal.php';
?>
<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<?php
			include_once './include/head.php';
		?>
		<style>
			th{
				text-align:left;
			}
		
		</style>
		<script>
			$(document).ready(function(){
				var count=10;
				$('input').click(function(){
					var data=$.trim($(this).val());
					if(data=='<')
						count=count-10;
					else if(data=='>')
						count=count+10;
					if(count>=10&&count<=total){
						$('.pagecount').text(parseInt(count/10));
						loaddata(count);
					}
					else{
						alert('Can not move further');
						if(data=='<')
							count=10;
						else if(data=='>')
							count=count-10;
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
							$("<tr style='  height: 25px; background-color:#b4d4f4; border-bottom:1px solid grey;'><td>"+obj[i]['id']+"</td><td>"+obj[i]['email']+"</td><td>"+obj[i]['transaction']+"</td><td>$"+obj[i]['order_total']+"</td><td>"+obj[i]['date_time']+"</td></tr>").appendTo('tbody');
						else
							$("<tr style='  height: 25px; background-color:whitesmoke;'><td>"+obj[i]['id']+"</td><td>"+obj[i]['email']+"</td><td>"+obj[i]['transaction']+"</td><td>$"+obj[i]['order_total']+"</td><td>"+obj[i]['date_time']+"</td></tr>").appendTo('tbody');
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
				<div style=" margin-top:10%; margin-left: 10%; width:80%; border-top-left-radius:10px; border-top-right-radius:10px; overflow:hidden;">
					<table  style=" border-collapse:collapse; width:100%;">
						<thead >
							<tr style="background-color:#4695c0; color:white; height: 35px; "><th style="padding-left:20px;">Transaction Id</th><th>Paypal Payer Id</th><th>Paypal Transaction Id</th><th>Order Total</th><th>Date Time</th></tr>
						</thead>
						<tbody id="tbody">
							<?php
								include './include/connection.php';
								$result=mysqli_query($con,'select count(*) as total from temp');
								$row=mysqli_fetch_array($result);
								$total=$row['total'];
								echo "<script> var total=$total;
									loaddata(0);
								</script>";
								
								
							?>
						</tbody>
					</table>
					<div style="width:99.9%; height:35px; background-color:#4695c0">
						<input data="back" type="button" value="<" style="height:100%; width:50px; font-weight:bold; font-size:120%;">
						<span><span class="pagecount">1</span>/ <?php echo (int)($total/10); ?><span>
						<input data="next" type="button" value=">" style="height:100%; width:50px; font-weight:bold; font-size:120%;">
						<span style="float:right; margin-right:20px;	"><a href="" >view all</a></span>
					</div>
				</div>
				
			</div>		
			<div class="mcontent">
				<div style=" margin-top:10%; margin-left: 10%; width:80%; border-top-left-radius:10px; border-top-right-radius:10px; overflow:hidden;">
					<table  style=" border-collapse:collapse; width:100%;">
						<thead >
							<tr style="background-color:#4695c0; color:white; height: 35px; "><th style="padding-left:20px;">Transaction Id</th><th>Order Total</th><th>Date Time</th></tr>
						</thead>
						<tbody id="tbody">
							<?php
								echo '<script>loaddata(0);</script>';								
							?>
						</tbody>
					</table>
					<div style="width:99.9%; height:35px; background-color:#4695c0">
						<input data="back" type="button" value="<" style="height:100%; width:50px; font-weight:bold; font-size:120%;">
						<input data="next" type="button" value=">" style="height:100%; width:50px; font-weight:bold; font-size:120%;">
						<span style="float:right; margin-right:20px;	"><a href="" >view all</a></span>
					</div>
				</div>

			</div>
		</div>	
		<?php
			include_once './include/footer.php';
		?>
	</body>
</html>