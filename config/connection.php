<?php 
	$mysql_hostname="sql208.byethost14.com";
	$mysql_user="b14_14737220";
	$mysql_password="memoryleak";
	$mysql_database="b14_14737220_mldb";

	$con=  mysqli_connect($mysql_hostname,$mysql_user,$mysql_password,$mysql_database);
	if(mysqli_connect_errno($con)){
		echo 'failed'.  mysqli_connect_error();
	}

?>