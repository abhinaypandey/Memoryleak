<?php 
	include_once './include/lock_normal.php';
	
	$_SESSION['check']='';
	
	/*****************************database insertion script****************************/
		if($_SERVER['REQUEST_METHOD']=='POST')
		{	
				include './include/connection.php';
				$p_title=mysqli_real_escape_string($con,$_POST['p-title']);
				if(isset($_POST['p_majors'])){
					$p_majors=$_POST['p_majors'];
				}
				
				if(isset($_POST['p_skills'])){
					$p_skills=$_POST['p_skills'];
				}
				$p_desc=mysqli_real_escape_string($con,$_POST['p-desc']);
				$p_bounty=mysqli_real_escape_string($con,$_POST['p-bounty']);
				$deadline=mysqli_real_escape_string($con,$_POST['deadline']);
				list($d,$m,$y)=split('/',$deadline);
				$deadline="$y-$m-$d";
				$p_user=$login_session;
				$p_major='';
				$p_skill='';
				$query_1="insert into questions(user_id,title,description,due_date_time,bounty,date_time) values('$p_user','$p_title','$p_desc','$deadline','$p_bounty',now())";
				if(mysqli_query($con,$query_1)){
					if($result=mysqli_query($con,"select MAX(question_id) as question_id from questions")){
							$row=mysqli_fetch_array($result);
					}
					if(!($_FILES["p-file"]["error"] > 0))
					{
						$temp = explode(".", $_FILES["p-file"]["name"]);
						$extension = end($temp);
						$p_file=$row['question_id'].'.'.$extension;
					}
					else
					{
						$p_file='';
					}
					mysqli_query($con,'update questions set file="'.$p_file.'" where question_id="'.$row['question_id'].'";');	
					if(isset($_POST['p_skills']) && !empty($_POST['p_skills'])){
						foreach($p_skills as $p_skill){
							if(!(mysqli_query($con,'insert into question_skills values("'.$row['question_id'].'","'.$p_skill.'");'))){
								
							}
						}
					}
					if(isset($_POST['p_majors']) && !empty($_POST['p_majors'])){
						foreach($p_majors as $p_major){
							if(!(mysqli_query($con,'insert into question_majors values("'.$row['question_id'].'","'.$p_major.'");'))){
								
							}
						}
					}
					$_SESSION['check']='true';
					move_uploaded_file($_FILES["p-file"]["tmp_name"],"../uploads/projects_files/" .$p_file);

					$result=mysqli_query($con,"select question_id from questions where user_id=$login_session and date_time=(select MAX(date_time) from questions where user_id=$login_session);");
					$row=mysqli_fetch_array($result);
					$currentQuestion=$row['question_id'];
					echo "<script>var currentQuestion=".$currentQuestion."</script>";
				 }
				else{
					echo "<script>$('#toast-container').css('background', 'none repeat scroll 0 0 #f85959').fadeIn(2000);
					$('.toast-message').html('Error Occured..please try again');
					$('#toast-container').fadeOut(3000);</script>";
					$_SESSION['check']='false';
				}
		}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Post Question</title>
                <link rel="shortcut icon" href="./images/logo.png">
		<?php
			include_once './include/head.php';
		?>
		<style>
		
				/*****************************Common Styles****************************/
		@import url(http://fonts.googleapis.com/css?family=Bree+Serif);
		::selection {
			color: #fff;
			background: #f676b2; /* Safari */
		}
		
		::-moz-selection {
			color: #fff;
			background: #f676b2; /* Firefox */
		}
		
		.main-wrapper {
			position: relative;
			width: 80%;
			z-index: 0;
			margin: auto;
			margin-top: 60px;
			background: #f3f3f3;
			border: 1px solid #fff;
			border-radius: 5px;
			box-shadow: 0 1px 3px #fff;
			-moz-box-shadow: 0 1px 3px #fff;
			-webkit-box-shadow: 0 1px 3px #fff;
		}
		
		.main-wrapper .header{
			padding: 2%;
		}
		
		.upload-form .header span {
			font-size: 18px;
			line-height: 16px;
			color: #678889;
			text-shadow: 1px 1px 0 rgba(256,256,256,1.0);
		}
		
		.span{
			position:relative;
			font-size: 12px;
			line-height: 14px;
			color: #678889;
			text-shadow: 1px 1px 0 rgba(256,256,256,1.0);
		}
		
		.upload-form {
			width: 100%;
			margin: 0 auto;
			position: relative;
		}
	
		.header h1{
			font-family: 'Bree Serif', serif;
			font-weight: 300;
			font-size: 28px;
			line-height:34px;
			color: #414848;
			text-shadow: 1px 1px 0 rgba(256,256,256,1.0);
			margin-bottom: 10px;
		}
		
		.upload-form .main-content {
			padding: 2%;
		}
		
		.upload-form .main-content  .input{
			width:100%;
			padding: 1% 1%;
			font-family: "HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;
			font-weight: 400;
			font-size: 14px;
			color: #9d9e9e;
			text-shadow: 1px 1px 0 rgba(256,256,256,1.0);
			background: #fff;
			border: 1px solid #fff;
			border-radius: 5px;
			display:block;
			box-shadow: inset 0 1px 3px rgba(0,0,0,0.50);
			-moz-box-shadow: inset 0 1px 3px rgba(0,0,0,0.50);
			-webkit-box-shadow: inset 0 1px 3px rgba(0,0,0,0.50);
		}
		
		.upload-form .main-content .input{
			margin-top: 5px;
		}
		
		.upload-form .main-content .input:hover {
			background: #dfe9ec;
			color: #414848;
		}
		
		.upload-form .main-content .input:focus {
			background: #dfe9ec;
			color: #414848;
			box-shadow: inset 0 1px 2px rgba(0,0,0,0.25);
			-moz-box-shadow: inset 0 1px 2px rgba(0,0,0,0.25);
			-webkit-box-shadow: inset 0 1px 2px rgba(0,0,0,0.25);
		}
		
		.upload-form .footer {
			position:relative;
			padding: 25px 30px 40px 30px;
			overflow: auto;
			
			background: #d4dedf;
			border-top: 1px solid #fff;
			
			box-shadow: inset 0 1px 0 rgba(0,0,0,0.15);
			-moz-box-shadow: inset 0 1px 0 rgba(0,0,0,0.15);
			-webkit-box-shadow: inset 0 1px 0 rgba(0,0,0,0.15);
		}
		
		 .button {
			float:right;
			padding: 11px 65px;
			font-family: 'Bree Serif', serif;
			font-weight: 300;
			font-size: 18px;
			color: #fff;
			text-shadow: 0px 1px 0 rgba(0,0,0,0.25);
			background: #56c2e1;
			border: 1px solid #46b3d3;
			border-radius: 5px;
			cursor: pointer;
			box-shadow: inset 0 0 2px rgba(256,256,256,0.75);
			-moz-box-shadow: inset 0 0 2px rgba(256,256,256,0.75);
			-webkit-box-shadow: inset 0 0 2px rgba(256,256,256,0.75);
		}
		
		.file-name{
			display:none;
			position: absolute;
			margin-top: -40px;
			background-color:  #F3E9EA;
			left: 32%;
			height: 25px;
			width: auto;
			padding-right: 10px;
			padding-left: 10px;
			border-radius: 5px;
			border: 1px solid #DFC6C9;
			box-shadow: inset 0 0 2px rgba(256,256,256,0.75);
			-moz-box-shadow: inset 0 0 2px rgba(256,256,256,0.75);
			-webkit-box-shadow: inset 0 0 2px rgba(256,256,256,0.75);
		}
		
		.new-file{
			color:#000000;
			max-width:100px;
			overflow:hidden;
			float:left;
			text-overflow:
			ellipsis;
			max-height:20px;
			padding-right:10px; 
		}
		
		.cross-file{
			cursor:pointer;
			font-weight:bold;
			color:#600;
			float:left; 	
		}
		
		.button:hover {
			background: #3f9db8;
			border: 1px solid rgba(256,256,256,0.75);
			box-shadow: inset 0 1px 3px rgba(0,0,0,0.5);
			-moz-box-shadow: inset 0 1px 3px rgba(0,0,0,0.5);
			-webkit-box-shadow: inset 0 1px 3px rgba(0,0,0,0.5);
		}
		
		.button:focus {
			position: relative;
			bottom: -1px;
			background: #56c2e1;
			box-shadow: inset 0 1px 6px rgba(256,256,256,0.75);
			-moz-box-shadow: inset 0 1px 6px rgba(256,256,256,0.75);
			-webkit-box-shadow: inset 0 1px 6px rgba(256,256,256,0.75);
		}
		
		.register{
			margin-right: 20px;
			background:#BBB;
			border: 1px solid #AAA;
			border-radius: 5px;
			cursor: pointer;
			z-index:-1;
			font-family: 'Bree Serif', serif;
			font-weight: 300;
			font-size: 18px;
			color: #FFF;
			text-shadow: 0px 1px 0 rgba(256,256,256,0.5);
			position:absolute;
			margin-top: -51px;
			width: 24%;
			height: 47px;
			box-shadow: inset 0 0 2px rgba(256,256,256,0.75);
			-moz-box-shadow: inset 0 0 2px rgba(256,256,256,0.75);
			-webkit-box-shadow: inset 0 0 2px rgba(256,256,256,0.75);
			text-shadow: 0px 1px 0 rgba(0,0,0,0.25);
		}
		
		.input,.button, .register {
			transition: all 0.5s ease;
			-moz-transition: all 0.5s ease;
			-webkit-transition: all 0.5s ease;
			-o-transition: all 0.5s ease;
			-ms-transition: all 0.5s ease;
		}
		
		/*****************************Styles for desktop****************************/
		
		#p-title{
			width:70%;
		}
		
		#p-majors{
			width:20%;
		}
		
		#p-skills{
			width:20%;
		}
		
		#p-desc{
			max-width:100%;
			min-width:100%;
			height:300px;
			position:relative;
			z-index:2;
		}
		
		#p-bounty{
			width:20%;
		}
		
		#p-file{
			height: 48px;
			padding: 0;
			width: 26%;
			z-index:1;
			opacity:0;
			cursor:pointer;
		}

		#date{
			width:20%;	
		}
				
				/*****************************tabs****************************/
				
		.sitem{
		
		  background-color: #66aee5;
		  background-image: -webkit-gradient(linear, left top, left bottom, from(#9ecaed), to(#66aee5));
		  background-image: -webkit-linear-gradient(top, #9ecaed, #66aee5);
		  background-image: -moz-linear-gradient(top, #9ecaed, #66aee5);
		  background-image: -ms-linear-gradient(top, #9ecaed, #66aee5);
		  background-image: -o-linear-gradient(top, #9ecaed, #66aee5);
		  background-image: linear-gradient(top, #9ecaed, #66aee5);
		  margin-right: 5px;
		  -moz-border-radius: 3px;
		  -webkit-border-radius: 3px;
		  border-radius: 3px;
		  -moz-box-shadow: 0 0 1px rgba(0, 0, 0, 0.3), 0 1px 0 rgba(255, 255, 255, 0.3) inset;
		  -webkit-box-shadow: 0 0 1px rgba(0, 0, 0, 0.3), 0 1px 0 rgba(255, 255, 255, 0.3) inset;
		  box-shadow: 0 0 1px rgba(0, 0, 0, 0.3), 0 1px 0 rgba(255, 255, 255, 0.3) inset;    
		  color: #fff;
		  padding:2px;
		  cursor: pointer;
		  white-space: nowrap;

		}

		.sitem:after{
			text-decoration: bold;
			padding-left:4px; 
		}

		.sitem:hover:after{
			content:'x';
			color:red;
			font-weight: 20px;
		}

		.sitem:hover{
			background-color: #fd7d7d;
		}

		.search_list1{
			position: absolute;
			width:auto;
			opacity: 0.9;
			display: block;
			background-color:black;
			color:white;
			list-style:none;
			display:none;
			z-index:10;
		}

		.search_list1 div{
			background-color: grey;
			border-color: #3b5998;
			width:100%;
			padding:4px; 
			font-size:12px;
			cursor:pointer;
			height: 20px;
		}


		.search_list1 div:hover{
			background-color:#2ecbed; 

		}

		.selected:hover{
			background-color:#2ecbed;
		}

	
		.search_list2{
			position: absolute;
			width:auto;
			opacity: 0.9;
			display: block;
			background-color:black;
			color:white;
			list-style:none;
			display:none;
			z-index:10;

		}

		.search_list2 div{
			background-color: grey;
			border-color: #3b5998;
			width:100%;
			padding:4px; 
			font-size:12px;
			cursor:pointer;
			height: 20px;
		}


		.search_list2 div:hover{
			background-color:#2ecbed; 

		}

		#tagcontainer{
			width:100%;
			float:left;
		
		}

		#tagsdiv{
			width:70%;
			position: relative;
			margin:auto;
			border:1px white;
			overflow: auto;
			white-space: nowrap;
			float: right;
			height: 40px;
			top:-40px;

		}

		#tagcontainer2{
			width:100%;
			float:left;
			
		}

		#tagsdiv2{
			width:70%;
			position: relative;
			margin:auto;
			border:1px white;
			overflow: auto;
			white-space: nowrap;
			float: right;
			height: 40px;
			top:-40px;	

		}

		.msitem{
		
		  background-color: #66aee5;
		  background-image: -webkit-gradient(linear, left top, left bottom, from(#9ecaed), to(#66aee5));
		  background-image: -webkit-linear-gradient(top, #9ecaed, #66aee5);
		  background-image: -moz-linear-gradient(top, #9ecaed, #66aee5);
		  background-image: -ms-linear-gradient(top, #9ecaed, #66aee5);
		  background-image: -o-linear-gradient(top, #9ecaed, #66aee5);
		  background-image: linear-gradient(top, #9ecaed, #66aee5);
		  margin-right: 5px;
		  margin-bottom: 5px;
		  -moz-border-radius: 1px;
		  -webkit-border-radius: 1px;
		  border-radius: 3px;
		  -moz-box-shadow: 0 0 1px rgba(0, 0, 0, 0.3), 0 1px 0 rgba(255, 255, 255, 0.3) inset;
		  -webkit-box-shadow: 0 0 1px rgba(0, 0, 0, 0.3), 0 1px 0 rgba(255, 255, 255, 0.3) inset;
		  box-shadow: 0 0 1px rgba(0, 0, 0, 0.3), 0 1px 0 rgba(255, 255, 255, 0.3) inset;    
		  height: auto;
		  width: auto;
		  color: #fff;
		  padding:2px;
		  cursor: pointer;
		  position: relative;
		  font-size: 11px;
		  white-space: nowrap;

		}

		.msitem:after{
			content:'';
			padding-left:4px; 
			font-size: 11px;
		}

		.msitem:hover:after{
			color:red;
			font-size: 11px;
			text-decoration: bold;
		}

		.msitem:hover{
			background-color: #fd7d7d;
		}

		
		.msearch_list1{
			position: absolute;
			width:auto;
			opacity: 0.9;
			display: block;
			background-color:black;
			color:white;
			list-style:none;
			z-index:10;
			display:none;

		}

		.msearch_list1 div{
			background-color: grey;
			border-color: #3b5998;
			width:100%;
			padding:4px; 
			font-size:12px;
			cursor:pointer;
			height: 20px;
		}


		.msearch_list1 div:hover{
			background-color:#2ecbed; 

		}

		.mselected:hover{
			background-color:#2ecbed;
		}

	
		.msearch_list2{
			position: absolute;
			width:auto;
			opacity: 0.9;
			display: block;
			background-color:black;
			color:white;
			list-style:none;
			z-index:10;
			display:none;
			word-wrap:none;

		}

		.msearch_list2 div{
			background-color: grey;
			border-color: #3b5998;
			width:100%;
			font-size:12px;
			cursor:pointer;
			height: 20px;

		}


		.msearch_list2 div:hover{
			background-color:#2ecbed; 

		}

		#mtagcontainer{
			width:100%;
			float:left;
		}

		#mtagsdiv{
			width:60%;
			position: relative;
			margin:auto;
			border:1px white;
			overflow: auto;
			white-space: nowrap;
			float: right;
			height: 32px;
			top:-25px;	

		}

		#mtagcontainer2{
			width:100%;
			float:left;
		}

		#mtagsdiv2{
			width:60%;
			position: relative;
			margin:auto;
			border:1px white;
			overflow: auto;
			white-space: nowrap;
			float: right;
			height: 32px;
			top:-25px;	

		}	
				
		#mmain-wrapper{
			width:90%;
		}
		
		#mfile{
			height: 48px;
			padding: 0;
			width: 34%;
			z-index:1;
			opacity:0;
			cursor:pointer;
		}
		
		#mtitle{
			width:70%;
		}
		
		#mfile-button{
			width:30%;
		}
		
		#mbounty{
			width:20%;			
		}

		#mdate{
			width:20%;	
		}
            
		</style>
		
		<script src="./js/tinymce/js/tinymce/tinymce.min.js"></script>
		<script>
			
			//Checking whether form submitted or not	

				$(function(){
					var check="<?php echo $_SESSION['check'];?>";
					if(check=='true'){
						$('.main-content').slideUp('ease-in-out').delay(3000);
						$('#p-submit').remove();
						$('#m-submit').remove();
						$('#head-span').text('Your question has been posted successfully...');
						$('#mhead-span').text('Your question has been posted successfully...');
						window.location.href='view_question.php?question_id='+currentQuestion;
					}
				});

			$(document).ready(function(){
			
			/*****************************Script for mobile****************************/
           		
				//-------------------------------------validation--------------------------------------
				var mflag_1=true;
				var mflag_2=true;
				var mflag_3=true;
				var mflag_4=true;
				var mflag_5=true;
				var mflag_6=true;
						
				$('#mtitle').change(function(){
					$('#mtitle').css('background-color','#FFF');
					$('#mtitle-span').css('color','#678889');
					var title=$('#mtitle').val();
					var tit_len=$('#mtitle').val().length;
					if(title==0){
						$('#mtitle-span').text('Enter the title of the question');
						$('#mtitle-span').css('color','#900');
						$('#mtitle').css('background-color','#ffe6e6');
						mflag_1=false;
					}
					else if(tit_len>120 || tit_len <10){
						$('#mtitle-span').text('Title should be 10-120 characters');
						$('#mtitle-span').css('color','#900');
						$('#mtitle').css('background-color','#ffe6e6');
						mflag_1=false;
					}
					else{
						$('#mtitle-span').text('...');
						 mflag_1=true;
					}
						
				});
				$('#mbounty').change(function(){
					$('#mbounty').css('background-color','#FFF');
					$('#mbounty-span').css('color','#678889');
					var bounty=$('#mbounty').val();
					if(bounty==''){
						$('#mbounty').css('background-color','#ffe6e6');
						$('#mbounty-span').text('Please enter the bounty of your question');
						$('#mbounty-span').css('color','#900');
						mflag_3=false;		
					}
					else if(!$.isNumeric(bounty)){
						$('#mbounty').css('background-color','#ffe6e6');
						$('#mbounty-span').text('Invalid Bounty');
						$('#mbounty-span').css('color','#900');
						mflag_3=false;
					}
					else if(bounty>200 ||bounty<1){
						$('#mbounty').css('background-color','#ffe6e6');
						$('#mbounty-span').text('Bounty Should be in between $1-$200');
						$('#mbounty-span').css('color','#900');
						mflag_3=false;
					}
					else{
						$('#mbounty-span').text('...');
						mflag_3=true;
					}
				});

				$('#mtagsearchbox').on('blur',function(){
					if($('#mtagsdiv .msitem').text().length==0){
						$('#skill-span').text('Please enter one sub-category atleast ');
						$('#skill-span').css('color','#900');
						mflag_5=false;
					}
					else{
						$('#skill-span').text('...');
						mflag_5=true;
					}
					
					
				});

				$('#mtagsearchbox2').on('blur',function(){
					if($('#mtagsdiv2 .msitem').text().length==0){
						$('#major-span').text('Please enter one major category atleast ');
						$('#major-span').css('color','#900');
						mflag_6=false;
					}
					else{
						$('#major-span').text('...');
						mflag_6=true;
					}
					
					
				});	
				
				//-------------------------------------Form validation--------------------------------------
				$('#m-submit').click(function(e1) {
					var flag=0;		
					$('#mtagsdiv .msitem').each(function(index){
						skill=$(this).attr('data');
						$('<input type="hidden" name="p_skills[]" value="'+skill+'" >').appendTo('form');
					});

					$('#mtagsdiv2 .msitem').each(function(index){
						major=$(this).attr('data');
						$('<input type="hidden" name="p_majors[]" value="'+major+'" >').appendTo('form');
					});
					var title=$('#mtitle').val();
					var tit_len=$('#mtitle').val().length;
					var date=$('#mdate').val();
					var desc_len=tinymce.get('mdesc').getContent().length;
					var bounty=$('#mbounty').val();
					var file=$('#mfile').val();
					$('.input').css('background-color','#FFF');
					$('span').css('color','#678889');
					
					if(tit_len==0){
						$('#mtitle-span').text('Enter the title of the question');
						$('#mtitle-span').css('color','#900');
						$('#mtitle').css('background-color','#ffe6e6');
						 mflag_1=false;
					}

					else if(tit_len>120 || tit_len<10){
						$('#mtitle-span').text('Title should be 10-120 characters');
						$('#mtitle-span').css('color','#900');
						$('#mtitle').css('background-color','#ffe6e6');
						mflag_1=false;
					}
					else{
						$('#mtitle-span').text('...');
						mflag_1=true;
					}
					if(desc_len<5){
						$('#mdesc-span').text('Enter the description of your question');
						$('#mdesc-span').css('color','#900');
						$('#mdesc-container').css('background-color','#ffe6e6');
						mflag_2=false;
					}
					else{
						$('#mdesc-span').text('...');
						 mflag_2=true;
					}
					if(bounty==''){
						$('#mbounty').css('background-color','#ffe6e6');
						$('#mbounty-span').text('Please enter the price of your question');
						$('#mbounty-span').css('color','#900');
						mflag_3=false;		
					}
					else if(!$.isNumeric(bounty)){
						$('#mbounty').css('background-color','#ffe6e6');
						$('#mbounty-span').text('Invalid Bounty');
						$('#mbounty-span').css('color','#900');
						mflag_3=false;
					}
					else if(bounty>200 ||bounty<1){
						$('#mbounty').css('background-color','#ffe6e6');
						$('#mbounty-span').text('Bounty Should be in between $1-$200');
						$('#mbounty-span').css('color','#900');
						 mflag_3=false;
					}
					else{
						$('#mbounty-span').text('...');
						 mflag_3=true;
					}
						
					if(date==''){
						$('#mdate').css('background-color','#ffe6e6');
						$('#mdate-span').text('Provide some due date');
						$('#mdate-span').css('color','#900');
						mflag_4=false;
					}
					else if(!validateDate(date)){
						$('#mdate').css('background-color','#ffe6e6');
						$('#mdate-span').text('Enter a valid date,due date should be of after current date');
						$('#mdate-span').css('color','#900');
						mflag_4=false;
					}
					else{
						$('#mdate-span').text('...');
						mflag_4=true;
					}
						
					if($('#mtagsdiv .msitem').text().length==0){
						$('#skill-span').text('Please enter one sub-category atleast ');
						$('#skill-span').css('color','#900');
						mflag_5=false;	
					}
					
					if($('#mtagsdiv2 .msitem').text().length==0){
						$('#major-span').text('Please enter one major category atleast ');
						$('#major-span').css('color','#900');
						mflag_6=false;
					}


					/*...........*/
					if((mflag_1==true && mflag_2==true && mflag_3==true && mflag_4==true && mflag_5==true && mflag_6==true)){
						$('#mupload-form').submit();
					}
					else{
						e1.preventDefault();

					}

                });

				$('#mback_btn').on('click',function(){
					parent.history.back();
					return false;
				});
				
				//-------------------------------------Tabs search--------------------------------------
			
					
					//-------------------------------------Text editor--------------------------------------
					tinymce.init(
						{
							selector:'textarea#mdesc',
							resize:false,
							statusbar:false,	
							height:'400px',
							menubar: "edit view",
							plugins: "textcolor link image print preview visualblocks visualchars",
							toolbar: "undo redo | forecolor backcolor | styleselect | bold italic |  alignleft aligncenter alignright alignjustify | bullist numlist outdent indent |  		link image emoticons print",
							style_formats:
							[
								{
									title: "Headers",
									items: 
									[
										{title: "Header 1",format: "h1"},
										{title: "Header 2",format: "h2"},
										{title: "Header 3",format: "h3"},
										{title: "Header 4",format: "h4"},
										{title: "Header 5",format: "h5"},
										{title: "Header 6",format: "h6"}
									]
								},
								{
									title: "Inline",
									items: 
									[
										{title: "_Underline",icon: "underline",format: "underline"}, 
										{title: "Strikethrough",icon: "strikethrough",format: "strikethrough"}, 
										{title: "Superscript",icon: "superscript",format: "superscript"}, 
										{title: "Subscript",icon: "subscript",format: "subscript"}, 
										{title: "Code",icon: "code",format: "code"}
									]
								}, 
								{
									title: "Blocks",
									items: 
									[
										{title: "Paragraph",format: "p"}, 
										{title: "Blockquote",format: "blockquote"}, 
										{title: "Div",format: "div"}, 
										{title: "Pre",format: "pre"}
									]
								}, 
								{
									title: "Font Family",
									items: 
									[
										{title: 'Arial', inline: 'span', styles: { 'font-family':'arial'}},
										{title: 'Book Antiqua', inline: 'span', styles: { 'font-family':'book antiqua'}},
										{title: 'Comic Sans MS', inline: 'span', styles: { 'font-family':'comic sans ms,sans-serif'}},
										{title: 'Courier New', inline: 'span', styles: { 'font-family':'courier new,courier'}},
										{title: 'Georgia', inline: 'span', styles: { 'font-family':'georgia,palatino'}},
										{title: 'Helvetica', inline: 'span', styles: { 'font-family':'helvetica'}},
										{title: 'Impact', inline: 'span', styles: { 'font-family':'impact,chicago'}},
										{title: 'Open Sans', inline: 'span', styles: { 'font-family':'Open Sans'}},
										{title: 'Symbol', inline: 'span', styles: { 'font-family':'symbol'}},
										{title: 'Tahoma', inline: 'span', styles: { 'font-family':'tahoma'}},
										{title: 'Terminal', inline: 'span', styles: { 'font-family':'terminal,monaco'}},
										{title: 'Times New Roman', inline: 'span', styles: { 'font-family':'times new roman,times'}},
										{title: 'Verdana', inline: 'span', styles: { 'font-family':'Verdana'}}
									]
								},
								{
									title: "Font Size", items: 
									[
										{title: '8pt', inline:'span', styles: { fontSize: '12px', 'font-size': '8px' } },
										{title: '10pt', inline:'span', styles: { fontSize: '12px', 'font-size': '10px' } },
										{title: '12pt', inline:'span', styles: { fontSize: '12px', 'font-size': '12px' } },
										{title: '14pt', inline:'span', styles: { fontSize: '12px', 'font-size': '14px' } },
										{title: '16pt', inline:'span', styles: { fontSize: '12px', 'font-size': '16px' } }
									]
								}
							]
						});
				});
				
				$(document).ready(function(){
					total_row3=0;
					$('#mtagsearchbox').bind('keyup input',function(e){
							var s= $.trim($('#mtagsearchbox').val());
							if(s!=''){
								$.ajax({
									url:'./query.php',
									type:'POST',
									data:{skill:s,type:'9'}						
								}).done(function(tags){
									$('.msearch_list1').html('').hide();
									if($.trim(tags)!=''){
										total_row3=0;
										var obj = jQuery.parseJSON(tags);
										$.each(obj,function(i){
											if($("#mtagsdiv > [data='"+obj[i]+"']").length==0){
												total_row3=total_row3+1;							
												$('.msearch_list1').append('<div class="tag_click" title="click here to remove" onclick="madd1(\''+obj[i]+'\');" data="'+obj[i]+'">'+obj[i]+'</div>').show();
											}
										});			
									}
								});
							}
						});

					total_row4=0;
					$('#mtagsearchbox2').bind('keyup input',function(){
							var s= $.trim($('#mtagsearchbox2').val());
							if(s!=''){
								$.ajax({
									url:'./query.php',
									type:'POST',
									data:{major:s,type:'10'}						
								}).done(function(tags){
									$('.msearch_list2').html('').hide();
									if($.trim(tags)!=''){
										total_row4=0;
										var obj = jQuery.parseJSON(tags);
										$.each(obj,function(i){
											if($("#mtagsdiv2 > [data='"+obj[i]+"']").length==0){
												total_row4=total_row4+1;							
												$('.msearch_list2').append('<div class="tag_click" title="click here to remove" onclick="madd2(\''+obj[i]+'\');" data="'+obj[i]+'">'+obj[i]+'</div>').show();
											}
										});			
									}
								});
							}
						});

					$('.msearch_list2').on('focusout',function(){
						$('#mtagsearchbox2').val('');
					
					});

					$('.msearch_list1').on('focusout',function(){
						$('#mtagsearchbox').val('');
						
					});

					$('.mcontent').click(function(){
						$('.msearch_list2').slideUp();
						$('.msearch_list1').slideUp();
					});
					
				});

				function madd1(data){
					var item=$.trim(data);
						$('<span data="'+item+'" onclick="remove();" title="click to remove "></span>').addClass('msitem').appendTo('#mtagsdiv').text(item);
						$('#mtagsearchbox').val('').focus();
						$('.msearch_list1').slideUp();

				}
				function madd2(data){
					var item=$.trim(data);
						$('<span data="'+item+'" onclick="remove();" title="click to remove "></span>').addClass('msitem').appendTo('#mtagsdiv2').text(item);
						$('#mtagsearchbox2').val('').focus();
						$('.msearch_list2').slideUp();

				}
		
			$(document).ready(function() {
            	
				/*****************************Script for desktop*****************************/	
				
				//-------------------------------------Text editor--------------------------------------
				tinymce.init(
						{
							selector:'textarea#p-desc',
							resize:false,
							statusbar:false,	
							height:'400px',
							menubar: "edit view",
							plugins: "textcolor link image print preview visualblocks visualchars",
							toolbar: "undo redo | forecolor backcolor | styleselect | bold italic |  alignleft aligncenter alignright alignjustify | bullist numlist outdent indent |  		link image emoticons print",
							style_formats:
							[
								{
									title: "Headers",
									items: 
									[
										{title: "Header 1",format: "h1"},
										{title: "Header 2",format: "h2"},
										{title: "Header 3",format: "h3"},
										{title: "Header 4",format: "h4"},
										{title: "Header 5",format: "h5"},
										{title: "Header 6",format: "h6"}
									]
								},
								{
									title: "Inline",
									items: 
									[
										{title: "_Underline",icon: "underline",format: "underline"}, 
										{title: "Strikethrough",icon: "strikethrough",format: "strikethrough"}, 
										{title: "Superscript",icon: "superscript",format: "superscript"}, 
										{title: "Subscript",icon: "subscript",format: "subscript"}, 
										{title: "Code",icon: "code",format: "code"}
									]
								}, 
								{
									title: "Blocks",
									items: 
									[
										{title: "Paragraph",format: "p"}, 
										{title: "Blockquote",format: "blockquote"}, 
										{title: "Div",format: "div"}, 
										{title: "Pre",format: "pre"}
									]
								}, 
								{
									title: "Font Family",
									items: 
									[
										{title: 'Arial', inline: 'span', styles: { 'font-family':'arial'}},
										{title: 'Book Antiqua', inline: 'span', styles: { 'font-family':'book antiqua'}},
										{title: 'Comic Sans MS', inline: 'span', styles: { 'font-family':'comic sans ms,sans-serif'}},
										{title: 'Courier New', inline: 'span', styles: { 'font-family':'courier new,courier'}},
										{title: 'Georgia', inline: 'span', styles: { 'font-family':'georgia,palatino'}},
										{title: 'Helvetica', inline: 'span', styles: { 'font-family':'helvetica'}},
										{title: 'Impact', inline: 'span', styles: { 'font-family':'impact,chicago'}},
										{title: 'Open Sans', inline: 'span', styles: { 'font-family':'Open Sans'}},
										{title: 'Symbol', inline: 'span', styles: { 'font-family':'symbol'}},
										{title: 'Tahoma', inline: 'span', styles: { 'font-family':'tahoma'}},
										{title: 'Terminal', inline: 'span', styles: { 'font-family':'terminal,monaco'}},
										{title: 'Times New Roman', inline: 'span', styles: { 'font-family':'times new roman,times'}},
										{title: 'Verdana', inline: 'span', styles: { 'font-family':'Verdana'}}
									]
								},
								{
									title: "Font Size", items: 
									[
										{title: '8pt', inline:'span', styles: { fontSize: '12px', 'font-size': '8px' } },
										{title: '10pt', inline:'span', styles: { fontSize: '12px', 'font-size': '10px' } },
										{title: '12pt', inline:'span', styles: { fontSize: '12px', 'font-size': '12px' } },
										{title: '14pt', inline:'span', styles: { fontSize: '12px', 'font-size': '14px' } },
										{title: '16pt', inline:'span', styles: { fontSize: '12px', 'font-size': '16px' } }
									]
								}
							]
						});
						
						
						//-------------------------------------File browse output--------------------------------------
						var flag_1=true;
						var flag_2=true;
						var flag_3=true;
						var flag_4=true;
						var flag_5=true;
						var flag_6=true;
						
						$('#p-file').change(function(){
							var file_name=$('#p-file').val();
							var size=(this.files[0].size)/(1024*1024);
							var re = /(\.doc|\.jpg|\.jpeg|\.bmp|\.gif|\.png|\.docx|\.pdf|\.rar|\.zip|\.css|\.html|\.js|\.xls|\.txt)$/i;
							$('#file-span').css('color','#678889');
							if(!re.exec(file_name))	
							{
								$('#file-span').text('Please Upload doc , docx , pdf , png , jpeg , txt , zip files only');
								$('#file-span').css('color','#900');								
								$('.upload').val('');
								flag_4=false;
							}					
							else if(size > 25){
								$('#file-span').text('File size should be less than 25 MB!!!');
								$('#file-span').css('color','#900');
								$('#p-file').val('');
								flag_4=false;
							}
							else{
								$('.file-name').fadeIn('slow');
								$('.new-file').text(file_name);
								flag_4=true;
							}
						});
						$('.cross-file').click(function(){
							$('.file-name').fadeOut('slow');
							$('#p-file').val('');
						});
						$('#mfile').change(function(){
							var file_name=$('#mfile').val();
							var size=(this.files[0].size)/(1024*1024);
							var re = /(\.doc|\.jpg|\.jpeg|\.bmp|\.gif|\.png|\.docx|\.pdf|\.rar|\.zip|\.css|\.html|\.js|\.xls|\.txt)$/i;
							$('#mfile-span').css('color','#678889');
							if(!re.exec(file_name))	
							{
								$('#mfile-span').text('Please Upload doc , docx , pdf , png , jpeg , txt , zip files only');
								$('#mfile-span').css('color','#900');
								$('.upload').val('');
								mflag_4=false;
							}
							else if(size > 25){
								$('#mfile-span').text('File size should be less than 25 MB!!!');
								$('#mfile-span').css('color','#900');
								$('#mfile').val('');
								flag_4=false;
							}
							else{
								$('.file-name').fadeIn('slow');
								$('.new-file').text(file_name);
							}
						});
						$('.cross-file').click(function(){
							$('.file-name').fadeOut('slow');
							$('#mfile').val('');
							flag_4=false;
						});
						
						//-------------------------------------validation--------------------------------------
							
							$('#p-title').blur(function(){
								$('#p-title').css('background-color','#FFF');
								$('#title-span').css('color','#678889');
								var title=$('#p-title').val();
								var tit_len=$('#p-title').val().length;
								var title_reg=/^[a-zA-Z0-9\s]+$/;
								var tit_len=$('#p-title').val().length;
								if(tit_len==''){
									$('#title-span').text('*Enter the title of the project');
									$('#title-span').css('color','#900');
									$('#p-title').css('background-color','#ffe6e6');
									flag_1=false;
								}
								
								else if(tit_len>120 || tit_len<10){
									$('#title-span').text('Title should be 10-120 characters');
									$('#title-span').css('color','#900');
									$('#ptitle').css('background-color','#ffe6e6');
									flag_1=false;
								}
								else{
									$('#title-span').text('...');
									flag_1=true;
								}
									
							});
							$('#p-bounty').change(function(){
								$('#p-bounty').css('background-color','#FFF');
								$('#bounty-span').css('color','#678889');
								var bounty=$('#p-bounty').val();
								var desc_len=tinymce.get('p-desc').getContent().length;
								if(bounty==''){
									$('#p-bounty').css('background-color','#ffe6e6');
									$('#bounty-span').text('Please enter the price of your Question');
									$('#bounty-span').css('color','#900');
									flag_3=false;		
								}
								else if(!$.isNumeric(bounty)){
									$('#p-bounty').css('background-color','#ffe6e6');
									$('#bounty-span').text('Invalid Bounty');
									$('#bounty-span').css('color','#900');
									flag_3=false;
								}
								else if(bounty>200 ||bounty<1){
									$('#p-bounty').css('background-color','#ffe6e6');
									$('#bounty-span').text('Bounty Should be in between $1-$200');
									$('#bounty-span').css('color','#900');
									flag_3=false;
								}
								else{
									$('#bounty-span').text('...');
									flag_3=true;
								}
								if(desc_len<5){
									$('#desc-span').text('Enter the description of your Question');
									$('#desc-span').css('color','#900');
									$('#p-desc-container').css('background-color','#ffe6e6');
									flag_2=false;
								}
								else if(desc_len<50){
									$('#desc-span').text('Description should be in minimum 50 chars');
									$('#desc-span').css('color','#900');
									$('#p-desc-container').css('background-color','#ffe6e6');
									flag_2=false;
								}
								else{
									$('#desc-span').text('...');
									flag_2=true;
								}


							});
							
							$('#tagsearchbox').on('blur',function(){
								if($('#tagsdiv .sitem').text().length==0){
									$('#skill-span').text('Please enter one sub-category atleast ');
									$('#skill-span').css('color','#900');
									flag_5=false;
								
								}
								else{
									$('#skill-span').text('...');
									flag_5=true;
								}
					
								
							});

							$('#tagsearchbox2').on('blur',function(){
								if($('#tagsdiv2 .sitem').text().length==0){
									$('#major-span').text('Please enter one major category atleast ');
									$('#major-span').css('color','#900');
									flag_6=false;
								}
								else{
									$('#major-span').text('...');
									flag_6=true;
								}
					
								
							});						
						//-------------------------------------Form validation--------------------------------------
						$('#p-submit').on('click',function(e2){

							$('#tagsdiv .sitem').each(function(index){
								skill=$(this).attr('data');
								$('<input type="hidden" name="p_skills[]" value="'+skill+'" >').appendTo('form');
							});

							$('#tagsdiv2 .sitem').each(function(index){
									major=$(this).attr('data');
									$('<input type="hidden" name="p_majors[]" value="'+major+'" >').appendTo('form');
							});
							var title=$('#p-title').val();
							var tit_len=$('#p-title').val().length;
							var date=$('#date').val();
							var desc_len=tinymce.get('p-desc').getContent().length;
							var bounty=$('#p-bounty').val();
							var file=$('#p-file').val();
							$('.input').css('background-color','#FFF');
							$('span').css('color','#678889');
							var tit_len=$('#p-title').val().length;
							
							if(tit_len==0){
								$('#title-span').text('Enter the title of the Question');
								$('#title-span').css('color','#900');
								$('#p-title').css('background-color','#ffe6e6');
								flag_1=false;
							}
							else if(tit_len>120 || tit_len<10){
									$('#title-span').text('Title should be  10-120 characters');
									$('#title-span').css('color','#900');
									$('#ptitle').css('background-color','#ffe6e6');
									flag_1=false;
							}
							else{
								$('#title-span').text('...');
								flag_1=true;
							}

							
								
							if(desc_len<5){
								$('#desc-span').text('Enter the description of your Question');
								$('#desc-span').css('color','#900');
								$('#p-desc-container').css('background-color','#ffe6e6');
								flag_2=false;
							}
							else if(desc_len<50){
								$('#desc-span').text('*description should be in minimum 50 chars');
								$('#desc-span').css('color','#900');
								$('#p-desc-container').css('background-color','#ffe6e6');
								flag_2=false;
							}
							else{
								$('#desc-span').text('...');
								flag_2=true;
							}
								
							if(bounty==''){
								$('#p-bounty').css('background-color','#ffe6e6');
								$('#bounty-span').text('Please enter the price of your Question');
								$('#bounty-span').css('color','#900');
								flag_3=false;		
							}
							else if(!$.isNumeric(bounty)){
								$('#p-bounty').css('background-color','#ffe6e6');
								$('#bounty-span').text('Invalid Bounty');
								$('#bounty-span').css('color','#900');
								flag_3=false;
							}
							else if(bounty>200 ||bounty<1){
								$('#p-bounty').css('background-color','#ffe6e6');
								$('#bounty-span').text('Bounty Should be in between $1-$200');
								$('#bounty-span').css('color','#900');
								flag_3=false;							
							}

							else{
								$('#bounty-span').text('...');
								flag_3=true;
							}
								
							if(date==''){
								$('#date').css('background-color','#ffe6e6');
								$('#date-span').text('Provide some due date');
								$('#date-span').css('color','#900');
								flag_4=false;
							}
							else if(!validateDate(date)){
								flag_4=false;
							}
							else{
								$('#date-span').text('...');
								flag_4=true;
							}
							
							if($('#tagsdiv .sitem').text().length==0){
								$('#skill-span').text('Please enter one sub-category atleast ');
								$('#skill-span').css('color','#900');
								flag_5=false;
								
							}
							
							if($('#tagsdiv2 .sitem').text().length==0){
								$('#major-span').text('Please enter one major category atleast ');
								$('#major-span').css('color','#900');
								flag_6=false;
							}
								
					
							/*...........*/
							if((flag_1==true && flag_2==true && flag_3==true && flag_4==true && flag_5==true && flag_6==true)){
								$('#upload-form').submit();
								
							}
							else{
								e2.preventDefault();

							}
							
						
					});

					$('#back_btn').on('click',function(){
						parent.history.back();
						return false;
					});
					 
					//-------------------------------------Tabs search--------------------------------------
				var total_row1=0;
				var current_pos1=0;
				$('#tagsearchbox').bind('keyup input',function(event){
					var input=$.trim($(this).val());
					var keycode = event.which;
						
					if(keycode==40){
						if(current_pos1<total_row1){
							$('.search_list1 div:nth-child('+current_pos1+')').removeClass('selected').css('background','grey');
							current_pos1=current_pos1+1;
							$('.search_list1 div:nth-child('+current_pos1+')').addClass('selected').css('background','#2ecbed');
						}	
					}
					else if(keycode==38){
						if(current_pos1>1){
							$('.search_list1 div:nth-child('+current_pos1+')').removeClass('selected').css('background','grey');
							current_pos1=current_pos1-1;
							$('.search_list1 div:nth-child('+current_pos1+')').addClass('selected').css('background','#2ecbed');			
						}
					}
					
					else if(keycode==13&&input!=''){
						var tag=$('.selected').attr('data');
						if(tag&&$("#tagsdiv > [data='"+tag+"']").length==0){
							$('<span data="'+tag+'" onclick="remove();" title="click to remove "></span>').addClass('sitem').appendTo('#tagsdiv').text(tag);
							$('.search_list1').html('').hide();
							$(this).val('');
						}						
					}
					else if(input!=''){
						current_pos1=0;
						$.ajax({
							url:'./query.php',
							type:'POST',
							data:{skill:input,type:'9'}						
						}).done(function(tags){
							$('.search_list1').html('').hide();
							if($.trim(tags)!=''){
								total_row1=0;
								var obj = jQuery.parseJSON(tags);
								$.each(obj,function(i){
									if($("#tagsdiv > [data='"+obj[i]+"']").length==0){
										$('.search_list1').append('<div onclick="add1(\''+obj[i]+'\');" data="'+obj[i]+'">'+obj[i]+'</div>').show();
										total_row1++;
									}
								});			
							}
						});
					}
				});

				var total_row2=0;
				var current_pos2=0;
				$('#tagsearchbox2').bind('keyup input',function(event){
					var input=$.trim($(this).val());
					var keycode = event.which;
						
					if(keycode==40){
						if(current_pos2<total_row2){
							$('.search_list2 div:nth-child('+current_pos2+')').removeClass('selected').css('background','grey');
							current_pos2=current_pos2+1;
							$('.search_list2 div:nth-child('+current_pos2+')').addClass('selected').css('background','#2ecbed');
						}	
					}
					else if(keycode==38){
						if(current_pos2>1){
							$('.search_list2 div:nth-child('+current_pos2+')').removeClass('selected').css('background','grey');
							current_pos2=current_pos2-1;
							$('.search_list2 div:nth-child('+current_pos2+')').addClass('selected').css('background','#2ecbed');			
						}
					}
					
					else if(keycode==13&&input!=''){
						var tag=$('.selected').attr('data');
						if(tag&&$("#tagsdiv2 > [data='"+tag+"']").length==0){
							$('<span data="'+tag+'" onclick="remove();" title="click to remove "></span>').addClass('sitem').appendTo('#tagsdiv2').text(tag);
							$('.search_list2').html('').hide();
							$(this).val('');
						}						
					}
					else if(input!=''){
						current_pos2=0;
						$.ajax({
							url:'./query.php',
							type:'POST',
							data:{major:input,type:'10'}						
						}).done(function(tags){
							$('.search_list2').html('').hide();
							if($.trim(tags)!=''){
								total_row2=0;
								var obj = jQuery.parseJSON(tags);
								$.each(obj,function(i){
									if($("#tagsdiv2 > [data='"+obj[i]+"']").length==0){
										$('.search_list2').append('<div  onclick="add2(\''+obj[i]+'\');" data="'+obj[i]+'">'+obj[i]+'</div>').show();
										total_row2++;
									}
								});			
							}
						});
					}
				});

				$('.search_list2').on('focusout',function(){
					$('#tagsearchbox2').val('');
					
				});

				$('.search_list1').on('focusout',function(){
					$('#tagsearchbox').val('');
					
				});

				$('.content').click(function(){
					$('.search_list2').slideUp();
					$('.search_list1').slideUp();
				});

				
			});	

				function validateDate(date){
					//var date=split('/',date);
					var date_reg=/^(?:(?:31(\/|-|\.)(?:0?[13578]|1[02]))\1|(?:(?:29|30)(\/|-|\.)(?:0?[1,3-9]|1[0-2])\2))(?:(?:1[6-9]|[2-9]\d)?\d{2})$|^(?:29(\/|-|\.)0?2\3(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00))))$|^(?:0?[1-9]|1\d|2[0-8])(\/|-|\.)(?:(?:0?[1-9])|(?:1[0-2]))\4(?:(?:1[6-9]|[2-9]\d)?\d{2})$/;
		      
	                if(!(date_reg).test(date)){
	                	$('#date-span').text('Insert a valid date in dd/mm/yyyy format only..!!');
	                	$('#date-span').css('color','#900');
		            
		             return false;
	           	    }

		            else{
		              //=======================================

		              var d1=date;
		              var res1=d1.split("/");
		   
		              var day=res1[0];
		              var mon=res1[1];
		              var year=res1[2];
		           
		              var fullDate = new Date();

		              //convert month to 2 digits
		              var twoDigitMonth = ((fullDate.getMonth().length+1) === 1)? (fullDate.getMonth()+1) : '0' + (fullDate.getMonth()+1);
		              var currentDate =  fullDate.getFullYear()+ "-" + twoDigitMonth + "-" + fullDate.getDate();
		   
		              var res2=currentDate.split("-");
		              var currDay=res2[2];
		              var currMon=res2[1];
		              var currYear=res2[0];

		     
		              if(currYear>year){
		                $('#date').css('background-color','#ffe6e6');
						$('#date-span').text('Due year must be after current year');
						$('#date-span').css('color','#900');
		                return false;
		              }
		              else if(currYear==year){
		                if(currMon>mon){
		                        $('#date').css('background-color','#ffe6e6');
								$('#date-span').text('Due month must be after current month');
								$('#date-span').css('color','#900');
		                        return false;
		                }
		                else if(currMon==mon){
		                        if(currDay>day){
		                            $('#date').css('background-color','#ffe6e6');
									$('#date-span').text('Due day must be after current day');
									$('#date-span').css('color','#900');
		                          return false;
		                        }
		                        else{
		                        	return true;
		                        }
		                        
		                }
		                else{
		                	return true;
		                }
		              }
		              else{
		              	return true;
		              }
		            }
				}

				function add1(data){
					var item=$.trim(data);
						$('<span data="'+data+'" onclick="remove();" title="click to remove "></span>').addClass('sitem').appendTo('#tagsdiv').text(data);
						$('#tagsearchbox').val('').focus();
						$('.search_list1').slideUp();

				}

				function add2(data){
					var item=$.trim(data);
						$('<span data="'+data+'" onclick="remove();" title="click to remove "></span>').addClass('sitem').appendTo('#tagsdiv2').text(data);
						$('#tagsearchbox2').val('').focus();
						$('.search_list2').slideUp();

				}

				
		</script>
	</head>
	
	<body>
		<?php
			include_once './include/menu.php';
		?>
		
		<!-----------------------------------------------------------Desktop section-------------------------------------------------------------->
		<div class="body">
			<div class="content">
				<div class="main-wrapper">
                	<form class="upload-form" action="post_question.php" enctype="multipart/form-data" method="post" id="upload-form">	
                    	<div class="header">
                        	<h1>Post Question</h1>
                            <span id="head-span">Post your Question </span>
                        </div>
                       
					   <div class="main-content">
                            <input type="text" name="p-title" class="input title" id="p-title" placeholder="Title" style="width:98%;">
                            <span  id="title-span" class="span">10 - 12 characters</span>
                                    
                            <!--MAJOR TAGS SECTION-->
                            <div id='tagcontainer2'>
								<input id='tagsearchbox2' class='textinput input' type='text' name='major' autocomplete='off' placeholder='Category' style="width:20%;"/>
										<div class='search_list2'></div>
								<div id='tagsdiv2' style="display:block;"></div>
							<span id="major-span" class="span">The main catagory of this Project eg:Programming and IT experts,Doctors,Marketers</span>
							</div>
							
							<!--SKILLS TAGS SECTION-->
                            <div id='tagcontainer' >
									<input id='tagsearchbox' class='textinput input' type='text' name='skill' autocomplete='off' placeholder='Sub-Category' style="width:20%;"/>
											<div class='search_list1'></div>
									<div id='tagsdiv' style="display:block;"></div>
							<span id="skill-span" class="span">Sub-Category you applied in this Project . Eg: C++ , JAVA , PHP,Neurology etc.</span>
							</div>
							
                           
                           <input type="text" name="deadline" class="textinput input" id="date" placeholder=" dd/mm/yyyy" />
                           <span id="date-span" class="span">Enter Due date</span>

						   <div class="input" id="p-desc-container" style="padding:0.5%;">
                                <textarea name="p-desc"  id="p-desc" placeholder="Description"></textarea>
                            </div>
                            <span id="desc-span" class="span">Description about your question.You can include screen shot of your works as it will enhance the presentation</span>
                                    
							<input type="text" name="p-bounty"  class="input"  id="p-bounty" placeholder="Bounty">
                            <span style="color:#F3F3F3;" id="bounty-span" class="span">...</span>
                                   
							<input type="file" name="p-file" class="input" id="p-file">
                            <input type="button" class="register" id="p-file-button" value="Upload File">
                            <div class="file-name">
                                <div class="new-file">Filename</div>
                                <div class="cross-file" >X</div>
                            </div>
								<span style="max-width:100px;" id="file-span" class="span">Upload the Question file. Only pdf , doc , png , jpg , bmp , zip files are supported.</span>
                        </div>
                           
                        <div class="footer">
							<input type="button" id="p-submit" class="button" value="Submit">
							<input type="button" id="back_btn" class="button" value="Go Back" style="float:left;">
                        </div>
                    </form>
            	
				</div>
			</div>		
			
          <!--------------------------------------------------------------Mobile section-------------------------------------------------------------->
			<div class="mcontent">
				<div class="main-wrapper" id="mmain-wrapper">
                	<form class="upload-form" action="post_question.php" enctype="multipart/form-data" method="post" id="mupload-form">	
                    	<div class="header">
                        	<h1>Post Question</h1>
                            <span id="mhead-span">Post your Question</span>
                         </div>
						<div class="main-content">
							<input type="text" name="p-title" class="input" id="mtitle" placeholder="Title" style="width:98%;">
							<span id="mtitle-span" class="span">10 - 120 characters</span>
										
							<!-- tag search and tag listing -->
							<div id='mtagcontainer2' >
								<input id='mtagsearchbox2' class='mtextinput input' type='text' name='skill' autocomplete='off' placeholder='Category' style="width:30%;" />
											<div class='msearch_list2'></div>
								<div id='mtagsdiv2' style="display:block;"></div>
                                <span id="major-span" class="span">The main catagory of this Project eg:Programming and IT experts,Doctors,Marketers</span>
							</div>
							
							
							<div id='mtagcontainer' >
									<input id='mtagsearchbox' class='mtextinput input' type='text' name='skill' autocomplete='off' placeholder='Sub-Category' style="width:30%;"/>
											<div class='msearch_list1'></div>
								<div id='mtagsdiv' style="display:block;"></div>
								<span id="skill-span" class="span">Sub-Category you applied in this Project . Eg: C++ , JAVA , PHP,Neurology etc.</span>
                            </div>
							
							<input type="text" name="deadline" class="textinput input" id="mdate" placeholder=" dd/mm/yyyy"  style="width:30%;"/>
							<span id="mdate-span" class="span">Enter Due date</span>

										
							<div class="input" id="mdesc-container" style="padding:0.5%;">
								<textarea name="p-desc"  id="mdesc" placeholder="Description"></textarea>
							</div>
							<span id="mdesc-span" class="span">Description about your Question.You can include screen shot of your works as it will enhance the presentation</span>
									   
							<input type="text" name="p-bounty"  class="input"  id="mbounty" placeholder="Bounty">
							<span style="color:#F3F3F3;" id="mbounty-span" class="span">...</span>
							<input type="file" name="p-file" class="input file" id="mfile">
							<input type="button" class="register" id="mfile-button" value="Upload File">
						   
						   <div class="file-name" style='left:43%;'>
						   <div class="new-file">Filename</div>
								<div class="cross-file" >X</div>
							</div>
							<span style="max-width:100px;" id="mfile-span" class="span">Upload the Question file. Only pdf , doc , png , jpg , bmp , zip files are supported.</span>
                        </div>
                           
                        <div class="footer">
							<input type="button" class="button" id="m-submit"  value="Submit"/>
							<input type="button" id="mback_btn" class="button" value="Go Back" style="float:left;">
                        </div>
                    </form>
            	</div>
			</div>

			<style>
				#toast-container {
					position: fixed;
					z-index: 1;
					width:100%;
					height: 50px;
					box-shadow: 0 0 12px #000;
				}
				.toast-top-center {
					top: 50px;
					margin: 0 auto;
				}

				.toast-message {
					text-align: center;
					-ms-word-wrap: break-word;
					word-wrap: break-word;
					margin-top:10px;
				}
			</style>
			<div id="toast-container" class="toast-top-center" style="display:none;">
				<div class="toast toast-error">
					<div class="toast-message">The email or password you entered is not correct, please try again.</div>
				</div>
			</div>		
		</div>
		
		<?php
			include_once './include/footer.php';
		?>
	</body>
</html>