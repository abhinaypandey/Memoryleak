<?php
	if(isset($_POST['type'])){
		include './config/connection.php';
		$full_name=htmlspecialchars($_POST['name']);
		$email_id=htmlspecialchars($_POST['email']);
		$phone_number=htmlspecialchars($_POST['phone']);
		$feedback=htmlspecialchars($_POST['feedback']);
		$query='INSERT INTO customer_feedback (full_name,email_id,phone_number,feedback,date_time) VALUES (\''.$full_name.'\',\''.$email_id.'\',\''.$phone_number.'\',\''.$feedback.'\',now())';
		if(mysqli_query($con,$query)){
			echo 'success';
		}
		else{
			echo 'failure';
		}
		exit;
	}

?>
<!DOCTYPE html>
<html>
	<head>
		<script src="js/jquery.js"></script>
		<link rel="stylesheet"  href="user/css/style.css" />
		<title>Feedback</title>
		
		<style>
			/*--------------------DESKTOP STYLES--------------------*/
			.input,.button{
				transition: all 0.5s ease;
				-moz-transition: all 0.5s ease;
				-webkit-transition: all 0.5s ease;
				-o-transition: all 0.5s ease;
				-ms-transition: all 0.5s ease;
			}
			table{
				position:relative;
				margin: -30px auto auto;
				width: 80%;
			}
			.form-wrapper{
				width: 70%;
			}
			.image-wrapper{
				padding-top: 47px;
			}
			.wrapper{
				-webkit-box-shadow: 0 1px 0 rgba(255,255,255,.2), inset 0 4px 5px rgba(0,0,0,.6), inset 0 1px 0 rgba(0,0,0,.6);
				-moz-box-shadow: 0 1px 0 rgba(255,255,255,.2), inset 0 4px 5px rgba(0,0,0,.6), inset 0 1px 0 rgba(0,0,0,.6);
				box-shadow: 0 1px 0 rgba(255,255,255,.2), inset 0 4px 5px rgba(0,0,0,.6), inset 0 1px 0 rgba(0,0,0,.6);
				-webkit-border-radius: 20px;
				-moz-border-radius: 20px;
				border-radius: 20px;
				width:90%;	
				background-color:#222;
				color:#FFF;
				font: 12px "Helvetica Neue", Helvetica, Arial, sans-serif;
				text-shadow:1px 1px 1px #000;
			}
			.wrapper .header{
				border-bottom: 1px solid  #444;
				padding:0px 0px 17px 6%;
			}
			.wrapper .header h1{
				position:relative;
				margin:auto;
				text-align:left;
			}
			.feedback-form{
				width:100%;
				padding:20px 0px 20px 0px;
			}
			.input{
				margin:auto;
				color: #3e3e3e;
				font-weight: 400;
				font-size: 14px;
				position:relative;
				display:block;
				width:78%;
				padding:10px 4%;
				margin-top:20px;
				border: 1px solid #999;
				border-radius:5px;
				font-family: "HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;
				text-shadow: 1px 1px 0 rgba(256,256,256,1.0);
				box-shadow: inset 0 1px 3px rgba(0,0,0,0.50);
				-moz-box-shadow: inset 0 1px 3px rgba(0,0,0,0.50);
				-webkit-box-shadow: inset 0 1px 3px rgba(0,0,0,0.50);
			}
			.input:hover {
				background: #c8d1d4;
				color: #000;
			}
			.input:focus {
				font-weight:bold;
				background: #dfe9ec;
				color: #414848;
				box-shadow: inset 0 1px 2px rgba(0,0,0,0.25);
				-moz-box-shadow: inset 0 1px 2px rgba(0,0,0,0.25);
				-webkit-box-shadow: inset 0 1px 2px rgba(0,0,0,0.25);
			}
			#feedback{
				max-width:78%;
				min-width:78%;
				height:150px;
			}
			.button{
				display:block;
				position:relative;
				width:20%;
				height:35px;
				margin:auto;
				margin-top:20px;
			}
			#feed-submit{
				font-weight:bold;
				background: #FFF;
				border: none;
				padding: 10px 25px 10px 25px;
				color: #ddd;
				border-radius: 4px;
				background: #7f345a;
			}
			#feed-submit:hover {
				
				background-color: #652648;
				box-shadow: inset 0 1px 3px rgba(0,0,0,0.5);
				-moz-box-shadow: inset 0 1px 3px rgba(0,0,0,0.5);
				-webkit-box-shadow: inset 0 1px 3px rgba(0,0,0,0.5);
				cursor:pointer;	
			}
			#feed-submit:focus {
				position: relative;
				bottom: -1px;
				background: #7f345a;
				box-shadow: inset 0 1px 6px rgba(256,256,256,0.75);
				-moz-box-shadow: inset 0 1px 6px rgba(256,256,256,0.75);
				-webkit-box-shadow: inset 0 1px 6px rgba(256,256,256,0.75);
			}
			.image{
				-webkit-box-shadow: 0 1px 0 rgba(255,255,255,.2), inset 0 4px 5px rgba(0,0,0,.6), inset 0 1px 0 rgba(0,0,0,.6);
				-moz-box-shadow: 0 1px 0 rgba(255,255,255,.2), inset 0 4px 5px rgba(0,0,0,.6), inset 0 1px 0 rgba(0,0,0,.6);
				box-shadow: 0 1px 0 rgba(255,255,255,.2), inset 0 4px 5px rgba(0,0,0,.6), inset 0 1px 0 rgba(0,0,0,.6);
				-webkit-border-radius: 20px;
				-moz-border-radius: 20px;
				border-radius: 20px;
				background-color:#222;
				padding:20px;
				width:240px;
				position: relative;
				margin:auto;
			}
			#logo{
				position:relative;
				margin: auto;
				margin-left:7%;
			}
			#image-footer{
				text-align: center;
				color: #fff;
				font-family:Arial, Helvetica, sans-serif;
				font-weight: bold;
				font-size: 26px;
				position:relative;
				margin: auto;
				position:relative;
				margin-left:7%;
			}
			.image-head{
				-webkit-box-shadow: 0 1px 0 rgba(255,255,255,.2), inset 0 4px 5px rgba(0,0,0,.6), inset 0 1px 0 rgba(0,0,0,.6);
				-moz-box-shadow: 0 1px 0 rgba(255,255,255,.2), inset 0 4px 5px rgba(0,0,0,.6), inset 0 1px 0 rgba(0,0,0,.6);
				box-shadow: 0 1px 0 rgba(255,255,255,.2), inset 0 4px 5px rgba(0,0,0,.6), inset 0 1px 0 rgba(0,0,0,.6);
				-webkit-border-radius: 20px;
				-moz-border-radius: 20px;
				border-radius: 20px;
				background-color:#222;	
				height: 64px;
				color:#fff;
				padding:20px;
				width:240px;
				position: relative;
				margin: auto;
			}
			.image-head p{
				text-align:center;
			}
			.main-content .warning{
				width:85%;
				margin:auto;
				text-align:right;
				font: 12px "Helvetica Neue", Helvetica, Arial, sans-serif;
				display:none;
			}
			
			/*--------------------MOBILE STYLES--------------------*/
			#mfeedback{
				max-width:78%;
				min-width:78%;
				height:150px;
			}
			#mfeed-submit{
				font-weight:bold;
				background: #FFF;
				border: none;
				padding: 10px 25px 10px 25px;
				color: #ddd;
				border-radius: 4px;
				background: #7f345a;
				width:120px;
			}
			#mfeed-submit:hover {
				
				background-color: #652648;
				box-shadow: inset 0 1px 3px rgba(0,0,0,0.5);
				-moz-box-shadow: inset 0 1px 3px rgba(0,0,0,0.5);
				-webkit-box-shadow: inset 0 1px 3px rgba(0,0,0,0.5);
				cursor:pointer;	
			}
			#mfeed-submit:focus {
				position: relative;
				bottom: -1px;
				background: #7f345a;
				box-shadow: inset 0 1px 6px rgba(256,256,256,0.75);
				-moz-box-shadow: inset 0 1px 6px rgba(256,256,256,0.75);
				-webkit-box-shadow: inset 0 1px 6px rgba(256,256,256,0.75);
			}
		</style>
		

		<script>
			/*--------------------DESKTOP SCRIPT--------------------*/
			$(document).ready(function() {
				
			
				
				/*--------------------VALIDATION--------------------*/
				
				var flag_1=true;
				var flag_2=true;
				var flag_3=true;
				var flag_4=true;
				
				//-----------Email validation funtion------------//
				function validateEmail(email){
					var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
					if(filter.test(email)){
						return true;
							
					}
					else{
						return false;
					}
				}
				
				//-----------Phone Number funtion------------//
				function validatePhone(pNumber){
					var filter = /^[0-9-+]+$/;
					if(filter.test(pNumber)){
						return true;
							
					}
					else{
						return false;
					}
				}
				
				$('#fullname').change(function(){
					var name=$('#fullname').val();
					var name_reg=/^[a-zA-Z\s]+$/;
						if(name==''){
							$('#fullname').css('background-color','#fff');
							$('#name-warning').slideUp('slow');
							$('#name-warning-2').slideUp('slow');
							flag_1=false;
						}
						else if(!name_reg.test(name)){
							$('#fullname').css('background-color','#ff8b8b');
							$('#name-warning').slideDown('slow');
							$('#name-warning-2').slideUp('slow');
							flag_1=false;
						}
						else{
							$('#fullname').css('background-color','#FFF');
							flag_1=true;
							$('#name-warning').slideUp('slow');
							$('#name-warning-2').slideUp('slow');
						}
				});
				
				$('#email').change(function(){
					var email=$('#email').val();
						if(email==''){
							$('#email').css('background-color','#fff');
							$('#email-warning').slideUp('slow');
							$('#email-warning-2').slideUp('slow');
							flag_2=false;
						}
						else if(!(validateEmail(email))) {
							$('#email').css('background-color','#ff8b8b');
							$('#email-warning').slideDown('slow');
							$('#email-warning-2').slideUp('slow');
							flag_2=false;
						}
						else{
							$('#email').css('background-color','#fff');
							$('#email-warning').slideUp('slow');
							$('#email-warning-2').slideUp('slow');
							flag_2=true;
						}
				});
				
				$('#phone').change(function(){
					var pNumber=$('#phone').val();
						if(pNumber==''){
							$('#phone').css('background-color','#fff');
							$('#phone-warning').slideUp('slow');
							$('#phone-warning-2').slideUp('slow')
							flag_3=false;
						}
						else if(!(validatePhone(pNumber))){
							$('#phone').css('background-color','#ff8b8b');
							$('#phone-warning').slideDown('slow');
							$('#phone-warning-2').slideUp('slow');
							flag_3=false;
						}
						else if(($('#phone').val().length) < 10 || ($('#phone').val().length)>20 ){
							$('#phone').css('background-color','#ff8b8b');
							$('#phone-warning').slideDown('slow');
							$('#phone-warning-2').slideUp('slow');
							flag_3=false;
						}
						else{
							$('#phone').css('background-color','#fff');
							$('#phone-warning').slideUp('slow');
							$('#phone-warning-2').slideUp('slow');
							flag_3=true;
						}
				});
				
				$('#feedback').change(function(){
					var feedback=$('#feedback').val();
						if(feedback==''){
							$('#feedback').css('background-color','#ff8b8b');
							$('#feed-warning').slideUp('slow');
							flag_4=false;
						}
						else{
							$('#feedback').css('background-color','#fff');
							$('#feed-warning').slideUp('slow');
							flag_4=true;
						}
				});
				/*--------------------FORM VALIDATION--------------------*/
				$('#feed-submit').click(function(){
					var feedback=$('#feedback').val(); 
					var phone=$('#phone').val();
					var name=$('#fullname').val();
					var email=$('#email').val();
					
						if(name==''){
							$('#fullname').css('background-color','#ff8b8b');
							$('#name-warning-2').slideDown('slow');
							flag_1=false;
						}
						else{
							$('#fullname').css('background-color','#fff');
							$('#name-warning-2').slideUp('slow');
						}
					
						if(email==''){
							$('#email').css('background-color','#ff8b8b');
							$('#email-warning-2').slideDown('slow');
							flag_2=false;
						}
						else{
							$('#email').css('background-color','#fff');
							$('#email-warning-2').slideUp('slow');
						}
					
						if(phone==''){
							$('#phone').css('background-color','#ff8b8b');
							$('#phone-warning-2').slideDown('slow');
							flag_3=false;
						}
						else{
							$('#phone').css('background-color','#fff');
							$('#phone-warning-2').slideUp('slow');
						}
					
					
					if(feedback==''){
						$('#feedback').css('background-color','#ff8b8b');
						$('#feed-warning').slideDown('slow');
						flag_4=false;
					}
					else{
						$('#feedback').css('background-color','#fff');
						$('#feed-warning').slideUp('slow');
					}
					
					if( (flag_1==true) && (flag_2==true) && (flag_3==true) && (flag_4==true) ){
						$.ajax({
							url:'customer_feedback.php',
							type:'post',
							data:
								{
									type:'17',
									name:name,
									email:email,
									phone:phone,
									feedback:feedback,
								},
							error:function(){
								alert('error');
							}
						}).done(function(data){
							if(data=='success'){
								alert('Feedback Saved');
								window.location='index.php';
							}
							else{
								alert('Feedback not saved');
							}
						});
					}
					
					else{
		
					}
				});
				
			});
			
			/*--------------------MOBILE SCRIPT--------------------*/
			$(document).ready(function() {
				
			
				
				/*--------------------VALIDATION--------------------*/
				
				var mflag_1=true;
				var mflag_2=true;
				var mflag_3=true;
				var mflag_4=true;
				
				//-----------Email validation funtion------------//
				function validateEmail(email){
					var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
					if(filter.test(email)){
						return true;
							
					}
					else{
						return false;
					}
				}
				
				//-----------Phone Number funtion------------//
				function validatePhone(pNumber){
					var filter = /^[0-9-+]+$/;
					if(filter.test(pNumber)){
						return true;
							
					}
					else{
						return false;
					}
				}
				
				$('#mfullname').change(function(){
					var name=$('#mfullname').val();
					var name_reg=/^[a-zA-Z\s]+$/;
						if(name==''){
							$('#mfullname').css('background-color','#fff');
							$('#mname-warning').slideUp('slow')
							flag_1=false;
						}
						else if(!name_reg.test(name)){
							$('#mfullname').css('background-color','#ff8b8b');
							$('#mname-warning').slideDown('slow');
							mflag_1=false;
						}
						else{
							$('#mfullname').css('background-color','#FFF');
							mflag_1=true;
							$('#mname-warning').slideUp('slow');
						}
				});
				
				$('#memail').change(function(){
					var email=$('#memail').val();
						if(email==''){
							$('#memail').css('background-color','#fff');
							$('#memail-warning').slideUp('slow')
							flag_2=false;
						}
						else if(!(validateEmail(email))) {
							$('#memail').css('background-color','#ff8b8b');
							$('#memail-warning').slideDown('slow')
							mflag_2=false;
						}
						else{
							$('#memail').css('background-color','#fff');
							$('#memail-warning').slideUp('slow');
							mflag_2=true;
						}
				});
				
				$('#mphone').change(function(){
					var pNumber=$('#mphone').val();
						if(pNumber==''){
							$('#mphone').css('background-color','#fff');
							$('#mphone-warning').slideUp('slow')
							flag_3=false;
						}
						else if(!(validatePhone(pNumber))){
							$('#mphone').css('background-color','#ff8b8b');
							$('#mphone-warning').slideDown('slow');
							mflag_3=false;
						}
						else if(($('#phone').val().length) < 10 || ($('#phone').val().length)>20 ){
							$('#mphone').css('background-color','#ff8b8b');
							$('#mphone-warning').slideDown('slow');
							flag_3=false;
						}
	
						else{
							$('#mphone').css('background-color','#fff');
							$('#mphone-warning').slideUp('slow');
							mflag_3=true;
						}
				});
				
				$('#mfeedback').change(function(){
					var feedback=$('#mfeedback').val();
						if(feedback==''){
							$('#mfeedback').css('background-color','#ff8b8b');
							mflag_4=false;
						}
						else{
							$('#mfeedback').css('background-color','#fff');
							mflag_4=true;
						}
				});
				
				/*--------------------FORM VALIDATION--------------------*/
				$('#mfeed-submit').click(function(){
					var feedback=$('#mfeedback').val(); 
					var phone=$('#mphone').val();
					var name=$('#mfullname').val();
					var email=$('#memail').val();
					
						if(name==''){
							$('#mfullname').css('background-color','#ff8b8b');
							mflag_1=false;
						}
						else{
							$('#mfullname').css('background-color','#fff');
						}
					
						if(email==''){
							$('#memail').css('background-color','#ff8b8b');
							mflag_2=false;
						}
						else{
							$('#memail').css('background-color','#fff');
						}
					
						if(phone==''){
							$('#mphone').css('background-color','#ff8b8b');
							mflag_3=false;
						}
						else{
							$('#mphone').css('background-color','#fff');
						}
					
					
					if(feedback==''){
						$('#mfeedback').css('background-color','#ff8b8b');
						mflag_4=false;
					}
					else{
						$('#mfeedback').css('background-color','#fff');
					}
					
					if( (mflag_1==true) && (mflag_2==true) && (mflag_3==true) && (mflag_4==true) ){
						$.ajax({
							url:'customer_feedback.php',
							type:'post',
							data:
								{
									type:'17',
									name:name,
									email:email,
									phone:phone,
									feedback:feedback,
								},
							error:function(){
								alert('error');
							}
						}).done(function(data){
							if(data=='success'){
								alert('Feedback Saved');
								window.location='index.php';
							}
							else{
								alert('Feedback not saved');
							}
						});
					}
					
					else{
		
					}
				});
				
			});
		</script>
	</head>
	<body>
		<div class="body">
			<!----------------------------------------------------DESK TOP CONTENT---------------------------------------------------->
			<div class="content">
				<table >
					<tr>
						<td rowspan="2" class="form-wrapper">
							<div class="wrapper">
								<!--------------------FEED BACK FORM-------------------->
								<form class="feedback-form" name="form1">
									<div class="header">
										<h1>Feedback</h1>
										<span> share your response with us</span>
									</div>
									<div class="main-content">
										<input type="text" id="fullname" class="input" placeholder="Fullname :"/>
										<div class="warning" id="name-warning">*Invalid Name</div>
										<div class="warning" id="name-warning-2">*Enter the full name</div>
										<input type="text" id="email" class="input" placeholder="Email ID :"/>
										<div class="warning" id="email-warning">*Invalid Email</div>
										<div class="warning" id="email-warning-2">*Enter the email</div>
										<input type="text" id="phone" class="input" placeholder="Phone number :"/>			
										<div class="warning" id="phone-warning">*Invalid Phone Number</div>
										<div class="warning" id="phone-warning-2">*Enter the phone number</div>
										<textarea placeholder="Give your feed back here..." class="input" id="feedback"></textarea>
										<div class="warning" id="feed-warning">*Enter the feed back</div>
										<input type="button" class="button" id="feed-submit" value="Submit">
									</div>
								</form> 
							</div>
						</td>
							<td>
								<div class="image-head">
									<p id="image-header"><i>" We always welcome your response . We can't put our next step unless you tell what we are ... "</i></p>
								</div>
							</td>
						</tr>
						<tr>
							<td class="image-wrapper">	 
								<div class="image">
									<img src="images/logo.png" id="logo">
									<p id="image-footer">MEMORY<br/>LEAK</p>
								</div>
							</td>
						</tr>
					</table>
				</div>
				<div class="mcontent">				
					<table>
					<tr>
						<td class="form-wrapper">
							<div class="wrapper" style="width:100%;">
								<!--------------------FEED BACK FORM-------------------->
								<form class="feedback-form" name="form1">
									<div class="header">
										<h1>Feedback</h1>
										<span> share your response with us</span>
									</div>
									<div class="main-content">
										<input type="text" id="mfullname" class="input" placeholder="Fullname :"/>
										<div class="warning" id="mname-warning">*Invalid Name</div>
										<input type="text" id="memail" class="input" placeholder="Email ID :"/>
										<div class="warning" id="memail-warning">*Invalid Email</div>
										<input type="text" id="mphone" class="input" placeholder="Phone number :"/>			
										<div class="warning" id="mphone-warning">*Invalid Phone Number</div>
										<textarea placeholder="Give your feed back here..." class="input" id="mfeedback"></textarea>
										<input type="button" class="button" id="mfeed-submit" value="Submit" >
									</div>
								</form> 
							</div>
						</td>
					</tr>
				</table>
				</div>		
		</div>		
		<?php
			include_once 'user/include/footer.php';
		?>
	</body>
</html>