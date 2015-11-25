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
				<h1>Web</h1>
				<?php 
					for($i=1;$i<=100;$i++)
						echo $i.'<br/>';
				?>
				
				
				
			</div>		
			<div class="mcontent">
				<h1>Mobile</h1>
				<?php 
					for($i=1;$i<=100;$i++)
						echo $i.'<br/>';
				?>
				
				
				
			</div>		
		</div>
		<?php
			include_once './include/footer.php';
		?>
	</body>
</html>