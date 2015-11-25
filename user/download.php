<?php 
	include_once './include/lock_normal.php';
	include './include/connection.php';

	if(isset($login_session)){
		if(isset($_GET['file_id'])){
			$file="./memoryleak/uploads/project_files/".$_GET['file_id'];

			header('Content-Description: File Transfer');
		    header('Content-Type: application/octet-stream');
		    header('Content-Disposition: attachment; filename=' . basename($file));
		    header('Content-Transfer-Encoding: binary');
		    header('Expires: 0');
		    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		    header('Pragma: public');
		    header('Content-Length: ' . filesize($file));
		    ob_clean();
		    flush();
		    readfile($file);
		    exit;
		}
		else{
			echo "<script>alert('invalid file');</script>";
		}

	}
	else{
			echo "<script>alert('unauthorised access');</script>";
	}
?>