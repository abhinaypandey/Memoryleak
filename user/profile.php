<?php 
	include './include/lock_normal.php';
?>
<!DOCTYPE html>
<?php 
		

		if($_SERVER['REQUEST_METHOD']=='POST'){
			if(isset($_POST['username'])&&isset($_POST['fullname'])&&isset($_POST['month'])&&isset($_POST['day'])&&isset($_POST['year'])&&isset($_POST['sex'])&&isset($_POST['country'])&&isset($_POST['code'])&&isset($_POST['phone'])&&isset($_POST['skills'])&&isset($_POST['majors'])){
				include './include/connection.php';

				$username=strtolower(mysqli_real_escape_string($con,$_POST['username']));
				$fullname=mysqli_real_escape_string($con,$_POST['fullname']);
				$month=mysqli_real_escape_string($con,$_POST['month']);
				$day=mysqli_real_escape_string($con,$_POST['day']);
				$year=mysqli_real_escape_string($con,$_POST['year']);
				$gender=mysqli_real_escape_string($con,$_POST['sex']);
				$country=mysqli_real_escape_string($con,$_POST['country']);
				$ccode=mysqli_real_escape_string($con,$_POST['code']);
				$phone=mysqli_real_escape_string($con,$_POST['phone']);
				$descri=mysqli_real_escape_string($con,$_POST['description']);
				$mobile=$ccode.'-'.$phone;
				if(!checkdate($month,$day,$year)){
					echo "<script>$('#toast-container').css('background', 'none repeat scroll 0 0 #f85959').fadeIn('slow');
					$('.toast-message').html('Please enter a valid date');
					$('#toast-container').fadeOut(2000);
					<script>";
				}
				else{
					$dob="$year-$month-$day";
				}
				
				$userid=$login_session;

				if($_FILES["user_image"]["error"] ==4){
					if($gender==='male'){
						$image_name='male.jpg';
						
					}	
					else{
						$image_name='female.jpg';
						
					}		
				}

				else{

					 $image_name=$_FILES["user_image"]["name"];
					 $ext=strrchr($image_name,".");
					 $image_name=$username.$ext;
					 move_uploaded_file($_FILES['user_image']['tmp_name'],'../uploads/user_images/'.$image_name);
				}		

			    $maxsize = 100000;
				if($_FILES['user_image']['size'] < $maxsize ){
					$rst=mysqli_query($con,"INSERT INTO profiles (user_id,user_name,name,date_of_birth,gender,country,mobile,description,image) VALUES ($userid ,'$username', '$fullname', '$dob', '$gender', '$country', '$mobile', '$descri', '$image_name')");
				
        		     if($rst){
        		     	$skills=$_POST['skills'];
						if(isset($skills) &&  !empty($skills)){
							foreach($skills as $skill){
								mysqli_query($con,"INSERT INTO  skills (user_id,user_skill) VALUES ('$userid' ,'$skill')");
								
							}

						}
						
						$majors=$_POST['majors'];
						if(isset($majors) && !empty($majors)){
							foreach($majors as $major){
								mysqli_query($con,"INSERT INTO  majors (user_id,user_major) VALUES ('$userid' ,'$major')");
							}
						}
						
						echo "<script>$('#toast-container').css('background', 'none repeat scroll 0 0 #f85959').fadeIn('slow');
						$('.toast-message').html('profile data updated successfully');
						$('#toast-container').fadeOut(2000);
						<script>";
			   			
        		     }

        		     else{
        		     	echo "<script>$('#toast-container').css('background', 'none repeat scroll 0 0 #f85959').fadeIn('slow');
						$('.toast-message').html('Error in updating profile data');
						$('#toast-container').fadeOut(2000);
						<script>";
			   		}

        		}

			    else{
			    	echo "<script>$('#toast-container').css('background', 'none repeat scroll 0 0 #f85959').fadeIn('slow');
					$('.toast-message').html('Please choose image of size less than 100K ".$image_name."');
					$('#toast-container').fadeOut(2000);
					<script>";
			   
			   }

	}

	else{
		echo "<script>$('#toast-container').css('background', 'none repeat scroll 0 0 #f85959').fadeIn('slow');
		$('.toast-message').html('Oops!! you missed some fields');
		$('#toast-container').fadeOut(2000);
		<script>";
	}
	
}
	
?>

<html>
	<head>
		<title></title>
		<?php
			include_once './include/head.php';
		?>
		<style>
		
		#trans_bg{
			position: fixed;
			display: none;
			background: #000000;
			opacity: 0.6;
			z-index: 5;
			width: 100%;
			height: 100%;
			top: 0px;
			left: 0px;

		}

		#popup_main{
		    display: none;
		    font-size: 14px;
		    margin: auto auto; 
		    top:5%;
		    width: 70%;
		    z-index:10;
		    min-height: 700px;

		}


		div#popup_content {
			position: absolute;
			background-color: white;
			padding: 3%;
			width:94%;
			min-height:750px;
			position: relative;
		    border-color: #9ecaed;
		    box-shadow: 0px 0px 20px #9ecaed;
		    z-index: 10;
			    
		}


		#userprofile{
			width:100%;
			height: 100%;
		}



		select{
		  	border: 1px solid #cccccc;
		    background-color: #ffffff;
		}

		select:focus{
			border:1px solid #9ecaed ;
		   	box-shadow: 0 0 20px #9ecaed;
		    transition: all 0.25s ease-in-out;
		    -webkit-transition: all 0.25s ease-in-out;
		    -moz-transition: all 0.25s ease-in-out;
		}
		.textinput{
			width:100%;
			display: inline-block;
			height: 25px;
			padding: 4px 0px;
			font-size: 14px;
			line-height: 20px;
			color: rgb(85, 85, 85);
			background-color: #ffffff;
		    border: 1px solid #cccccc;
		    -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
		    -moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
		    box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
		    border-radius: 3px;
		 
		}

		.textinput:focus{
			outline: none;
		    border-color: #9ecaed;
		    box-shadow: 0 0 20px #9ecaed;
		   

		}
		

		.textinputarea{
			width:100%;
			height: 150px;
			border-color: #bdc7d8;
			border: 1px solid #cccccc;
			font-size: 11px;
			margin-top: 10px;
			border-radius: 3px;
			resize:none;
		}
		.textinputarea:focus{
			outline: none;
		    border-color: #9ecaed;
		    box-shadow: 0 0 10px #9ecaed;
		}


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
			list-style:none;('');

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
			margin-top:2%;
			margin-bottom:2%;
		}

		#tagsdiv{
			width:70%;
			position: relative;
			margin:auto;
			border:1px white;
			overflow: auto;
			white-space: nowrap;
			float: right;
			background-color: white;
			height: 25px;

		}

		#tagcontainer2{
			width:100%;
			float:left;
			margin-top:2%;
			margin-bottom:2%;
		}

		#tagsdiv2{
			width:70%;
			position: relative;
			margin:auto;
			border:1px white;
			overflow: auto;
			white-space: nowrap;
			float: right;
			background-color: white;
			height: 25px;	

		}


		span.error_popup,span.error_popup2{
			
		    border-radius: 2px 2px 2px 2px;
		    color: #FFFFFF;
		    display: none;
		    font-size: 12px;
		    font-weight: bold;
		    height: 25px;
		    width: 200px;
		    opacity: 0.9;
		    padding: 3px;
		    position: absolute;
		    text-align: center;
		    margin-left: 71%;
			    

			   	
		}
				
		.button{
			background-color: #ac1f39;
			-moz-border-radius: 0.5em;
			-webkit-border-radius: 0.5em;
			border-radius: 0.5em;
			border: 1px solid #ac1f39;
			float: right;
			margin-top:2px;
			margin-bottom:5px;
			width: 100px;
			height: 30px;
			cursor: pointer;
			font: bold 11px Arial, Helvetica;
			color: #fff;    
			margin-right: 1%;                                             
	
		}
		.button:hover,.button:focus {		
				background-color: #e97171;
		}	

		#mtrans_bg{
			position: fixed;
			display: none;
			background: #000000;
			opacity: 0.6;
			z-index: 5;
			width: 100%;
			height: 100%;
			top: 0px;
			left: 0px;

		}

		.mpopup_content{
			background-color: white;
			padding:5%;
			width:80%;
			min-height:650px;
			position:relative;
		    border-color: #9ecaed;
		    box-shadow: 0px 0px 20px #9ecaed;
			z-index:7;
			margin:auto auto;
			margin-top: 50px;
		}

		select{
		  	border: 1px solid #cccccc;
		    background-color: #ffffff;
		}

		select:focus{
			border:1px solid #9ecaed ;
		   	box-shadow: 0 0 20px #9ecaed;
		    transition: all 0.25s ease-in-out;
		    -webkit-transition: all 0.25s ease-in-out;
		    -moz-transition: all 0.25s ease-in-out;
		}

		.mtextinput{
			width:100%;
			display: inline-block;
			height: 15px;
			padding: 2px 0px;
			font-size: 11px;
			text-align: left;
			color: rgb(85, 85, 85);
			border: 1px solid rgb(204, 204, 204);
			background-color: #ffffff;
		    border: 1px solid #cccccc;
		    border-radius: 3px;
		    -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
		    -moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
		    box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
		    -webkit-transition: border linear .2s, box-shadow linear .2s;
		    -moz-transition: border linear .2s, box-shadow linear .2s;
		    -o-transition: border linear .2s, box-shadow linear .2s;
		    transition: border linear .2s, box-shadow linear .2s;
		 
		}

		.mtextinput:focus{
			outline: none;
		    border-color: #9ecaed;
		    box-shadow: 0 0 10px #9ecaed;
		    transition: all 0.25s ease-in-out;
		    -webkit-transition: all 0.25s ease-in-out;
		    -moz-transition: all 0.25s ease-in-out;
			  

		}
		
		.mtextinputarea{
			width:100%;
			height: 150px;
			border-color: #bdc7d8;
			border: 1px solid #cccccc;
			font-size: 11px;
			border-radius: 3px;
			resize:none;
		}
		.mtextinputarea:focus{
			outline: none;
		    border-color: #9ecaed;
		    box-shadow: 0 0 10px #9ecaed;
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
			display:none;
			z-index:10;

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
			display:none;
			z-index:10;

		}

		.msearch_list2 div{
			background-color: grey;
			border-color: #3b5998;
			width:100%;
			padding:4px; 
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
			margin-top:2%;
			margin-bottom:2%;
		}

		#mtagsdiv{
			width:70%;
			position: relative;
			margin:auto;
			border:1px white;
			overflow: auto;
			white-space: nowrap;
			float: right;
			background-color: white;
			height: 25px;

		}

		#mtagcontainer2{
			width:100%;
			float:left;
			margin-top:2%;
			margin-bottom:2%;
		}

		#mtagsdiv2{
			width:70%;
			position: relative;
			margin:auto;
			border:1px white;
			overflow: auto;
			white-space: nowrap;
			float: right;
			background-color: white;
			height: 25px;	

		}

		.merror{
			border-radius: 2px 2px 2px 2px;
		    color: #FFFFFF;
		    font-size: 12px;
		    height: 20px;
		    width: 100%;
		    opacity: 0.8;
		    padding: 2px 2px 2px 2px;
		    position: fixed;
		    text-align: center;
			top:0px;
		    z-index: 10;
		}

				
	</style>

		<script>
/* .......................................................................script for desktop starts................................................*/


		var formfields = false;
		$(document).ready(function(){
			
			      
			$('#popup_main').fadeIn();
			$('#trans_bg').css('opacity','0.8');
			$('#trans_bg').fadeIn();

				
			$('#username').on('blur',function(e){
				var name=$('#username').val();
				if(name==''){
						$('.error_popup').fadeOut('normal');
						$('#username').css('box-shadow','0px 0px 5px #f85959').fadeIn(2000);
						$('.error_popup').html('<span style="position:absolute;top:-10px;left:80%;border-left:10px solid transparent;border-right:10px solid transparent;border-bottom:10px solid #f85959;z-index:10;"></span> You can\'t leave it blank').css('background', 'none repeat scroll 0 0 #f85959').fadeIn('normal').delay(2000).fadeOut(3000);
						
				}
				else{
					var username_reg=/^([a-zA-Z0-9]){6,20}$/;
						if(!username_reg.test(name)){
							$('.error_popup').fadeOut('normal');
							$('#username').css('box-shadow','0px 0px 5px #f85959').fadeIn(2000);
							$('.error_popup').html('<span style="position:absolute;top:-10px;left:80%;border-left:10px solid transparent;border-right:10px solid transparent;border-bottom:10px solid #f85959;z-index:10;"></span>Enter alphaneumeric username of  6-20 chars').css('background', 'none repeat scroll 0 0 #f85959').fadeIn('normal').delay(2000).fadeOut(3000);
						}

						else{
							
							$.ajax({
							url:"query.php",
							data:{
								username:name,type:'8'
							},
							type:"POST",
							datatype:"text"
							
							}).done(function(msg) {
							if(msg[0]=='0'){
								$('.error_popup').fadeOut('normal');
								$('#username').css('box-shadow','0px 0px 5px #f85959').fadeIn(2000);
								$('.error_popup').html('<span style="position:absolute;top:-10px;left:80%;border-left:10px solid transparent;border-right:10px solid transparent;border-bottom:10px solid #f85959;z-index:10;"></span>Username already taken !!').css('background', 'none repeat scroll 0 0 #f85959').fadeIn('normal').delay(2000).fadeOut(3000);
								
							}
							else if(msg[0]=='1'){
								$('.error_popup').fadeOut('normal');
								$('#username').css('box-shadow','0px 0px 5px #1e7909').fadeIn(2000);
								$('.error_popup').html('<span style="position:absolute;top:-10px;left:80%;border-left:10px solid transparent;border-right:10px solid transparent;border-bottom:10px solid #1e7909;z-index:10;"></span>Looks good !').css('background', 'none repeat scroll 0 0 #1e7909').fadeIn('normal').delay(2000).fadeOut(3000);
							}
						});

						}

				}

			});	

			$('#fullname').on('blur',function(e){
				var fname=$('#fullname').val();
				if(fname==''){
					$('.error_popup2').fadeOut('normal');
					$('#fullname').css('box-shadow','0px 0px 5px #f85959').fadeIn(2000);
					$('.error_popup2').html('<span style="position:absolute;top:-10px;left:80%;border-left:10px solid transparent;border-right:10px solid transparent;border-bottom:10px solid #f85959;z-index:10;"></span>You can\'t leave it blank').css('background', 'none repeat scroll 0 0 #f85959').fadeIn('normal').delay(2000).fadeOut(3000);
				}
				else{
					var fullname_reg=/^[a-zA-Z\s]+$/;
					if(!fullname_reg.test(fname)){
						$('.error_popup2').fadeOut('normal');
						$('#fullname').css('box-shadow','0px 0px 5px #f85959').fadeIn(2000);
						$('.error_popup2').html('<span style="position:absolute;top:-10px;left:80%;border-left:10px solid transparent;border-right:10px solid transparent;border-bottom:10px solid #f85959;z-index:10;"></span>Digits and Special chars are not allowed').css('background', 'none repeat scroll 0 0 #f85959').fadeIn('normal').delay(2000).fadeOut(3000);
						
					}
					else{
						$('.error_popup2').fadeOut('normal');
						$('#fullname').css('box-shadow','0px 0px 5px #1e7909').fadeIn(2000);
						$('.error_popup2').html('<span style="position:absolute;top:-10px;left:80%;border-left:10px solid transparent;border-right:10px solid transparent;border-bottom:10px solid #1e7909;z-index:10;"></span>Nice name ! ').css('background', 'none repeat scroll 0 0 #1e7909').fadeIn('normal').delay(2000).fadeOut(3000);
							
					}
				}

			});

			$('.dobcontainer select').on('change',function(){
				var month=$('select[name="month"]').val();
				var day=$('select[name="day"]').val();
				var year=$('select[name="year"]').val();
				if(month!='Month' && day!='Day'&&year!='Year'){
			
				}
				
			});

			$('input[name="sex"]').on('change',function (){
		        var value =$('input[name="sex"]:radio:checked').val();
		        if(value=='male'|| value=='female'){
		    
		        }
		     
		    });
			

			$('.select').change(function(){
				var code=$("[class='"+$(this).val()+"']").attr('data');
				$('#c_code').val('+'+code);
				
			});

			$('#phoneno').on('blur',function(){
				var phone=$('#phoneno').val();
				var phone_reg=/^[0-9]{10,}$/;
				if(!phone_reg.test(phone)){
					$(this).css('box-shadow','0px 0px 5px #f85959');
			
				}
				else{
					$(this).css('box-shadow','0px 0px 5px #1e7909');
				
				}
			});

			$('#tagsearchbox').on('blur',function(){
				if($('#tagsdiv .sitem').text().length!=0){
					$('#tagsearchbox').css('box-shadow','0px 0px 5px #1e7909');
				}
				else{
					$('#tagsearchbox').css('box-shadow','0px 0px 5px #f85959');
				}
			});

			$('#tagsearchbox2').on('blur',function(){
				if($('#tagsdiv2 .sitem').text().length!=0){
					$('#tagsearchbox2').css('box-shadow','0px 0px 5px #1e7909');
				}
				else{
					$('#tagsearchbox2').css('box-shadow','0px 0px 5px #f85959');
				}
			});

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
				

			$('#file').change(function(e){
	        var files = e.originalEvent.target.files;
	                s = files[0].size;
	                t=files[0].type;

				if(!(t=='image/jpeg' || t=='image/png' || t=='image/bmp')){
					$('#toast-container').css('background', 'none repeat scroll 0 0 #f85959').fadeIn(2000);
					$('.toast-message').html('Please select image files only');
					$('#toast-container').fadeOut(3000);
	                $('#file').val('');
	         	}
	         	else if (s > 100000) {
	         		$('#toast-container').css('background', 'none repeat scroll 0 0 #f85959').fadeIn(2000);
					$('.toast-message').html('Please select file less than 100kb in size');
					
					$('#toast-container').fadeOut(3000);
	                $('#file').val('');
	         	}
   			 });

		
			$('#reset_btn').on('click',function(){
				$('.textinput').val('');
				$('.textinput').css('box-shadow','0 0 0 0');
			});

			$('#mreset_btn').on('click',function(){
				$('.mtextinput').val('');
			});
			
			$('#form_btn').on('click',function(e){
				if(validate()==1){	
					$('#userprofile').submit();
				}
				else if(validate()==0){
					e.preventDefault();
					
					$('#toast-container').css('background', 'none repeat scroll 0 0 #f85959').fadeIn(2000).delay(2000).fadeOut(3000);
					$('.toast-message').html('Please enter all required fields');
				}
				else{
					$('#toast-container').css('background', 'none repeat scroll 0 0 #f85959').fadeIn(2000).delay(2000).fadeOut(3000);
					$('.toast-message').html('Invalid date of birth');
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

			function validate(){
				var count=0;
					if(($('#username').val()).length>0){
						count++;
					}
					else{
						$('#username').css('box-shadow','0px 0px 5px #f85959');
					}


					if(($('#fullname').val()).length>0){
						count++;
					}
					else{
						$('#fullname').css('box-shadow','0px 0px 5px #f85959');
					}
					

					var month=$('select[name="month"]').val();
					var day=$('select[name="day"]').val();
					var year=$('select[name="year"]').val();
					if(month!='Month' && day!='Day'&&year!='Year'){
						
						count++;
					}
					

					var value =$('input[name="sex"]:radio:checked').val();
			        if(value=='male'|| value=='female'){
			        	
			        	count++;
			        }
			        
			        var code=$("[class='"+$('.select').val()+"']").attr('data');
					$('#c_code').val('+'+code);
					if(($('#c_code').val().length)>0){
						count++;
					}
					else{
						$('#c_code').css('box-shadow','0px 0px 5px #f85959');
					}
					
					
					if(($('#phoneno').val()).length>=10){
						count++;
					}
					else{
						$('#phoneno').css('box-shadow','0px 0px 5px #f85959');
					}
					

					var skills=new Array();
					var majors=new Array();
					$('#tagsdiv .sitem').each(function(index){
						skill=$(this).attr('data');
						$('<input type="hidden" name="skills[]" value="'+skill+'" >').appendTo('form');
					});

					$('#tagsdiv2 .sitem').each(function(index){
						major=$(this).attr('data');
						$('<input type="hidden" name="majors[]" value="'+major+'" >').appendTo('form');
					});

					if($('#tagsdiv .sitem').text().length!=0){
						count++;
						$('#tagsearchbox').css('box-shadow','0px 0px 5px #1e7909');
					}
					else{
						$('#tagsearchbox').css('box-shadow','0px 0px 5px #f85959');
					}
					
					if($('#tagsdiv2 .sitem').text().length!=0){
						count++;
						$('#tagsearchbox2').css('box-shadow','0px 0px 5px #1e7909');
					}
					else{
						$('#tagsearchbox2').css('box-shadow','0px 0px 5px #f85959');
					}

					if(count==8){
						if(!validateDate(parseInt(day),parseInt(month),parseInt(year))){
							
							return 2;
						}
						else{
							return 1;
						}
					}
					else{

						return 0;
						
					}	
				}



/* .......................................................................script for desktop ends................................................*/ 
/* .......................................................................script for mobile starts................................................*/
		$(document).ready(function(){
					
				$('#mpopup_main').fadeIn();
				$('#mtrans_bg').css('opacity','0.8');
				$('#mtrans_bg').fadeIn();

				
			$('#musername').on('blur',function(e){
				var name=$('#musername').val();
				
				if(name==''){
						$('.merror').fadeOut('slow');
						$('.merror').text('You can\'t leave it blank').css('background', 'none repeat scroll 0 0 #f85959').fadeIn(2000).delay(2000).fadeOut(3000);
						$('#musername').css('box-shadow','0px 0px 5px #f85959').fadeIn('slow');
				}
				else{
					var username_reg=/^([a-zA-Z0-9]){6,15}$/;
							if(!username_reg.test(name)){
								$('.merror').fadeOut('slow');
								$('.merror').text('Enter alphaneumeric username of altleast 6 chars').css('background', 'none repeat scroll 0 0 #f85959').fadeIn(2000).delay(2000).fadeOut(3000);
								$('#musername').css('box-shadow','0px 0px 5px #f85959').fadeIn('slow');
							}

							else{
								$.ajax({
								url:"query.php",
								data:{username:name,type:'8'},
								type:"POST",
								datatype:"text"
								
								}).done(function(msg) {
									if(msg[0]=='0'){
										$('.merror').fadeOut('slow');
										$('.merror').text('Username already exists').css('background', 'none repeat scroll 0 0 #f85959').fadeIn(2000).delay(2000).fadeOut(3000);
										$('#musername').css('box-shadow','0px 0px 5px #f85959').fadeIn('slow');
											
									}
										
									else{
										$('.merror').fadeOut('slow');
										$('.merror').text('Looks good !').css('background', 'none repeat scroll 0 0 #1e7909').fadeIn(2000).delay(2000).fadeOut(3000);
										$('#musername').css('box-shadow','0px 0px 10px green').fadeIn('slow');
										
									}
									
							});

						}

				}

			});	

			$('#mfullname').on('blur',function(e){
				var fname=$('#mfullname').val();
				if(fname==''){
					$('.merror').fadeOut('slow');
					$('.merror').text('You can\'t leave it blank').css('background', 'none repeat scroll 0 0 #f85959').fadeIn(2000).delay(2000).fadeOut(3000);
					$('#mfullname').css('box-shadow','0px 0px 5px #f85959').fadeIn('slow');
				
				}
				else{
					var fullname_reg=/^[a-zA-Z\s]+$/;
					if(!fullname_reg.test(fname)){
						$('.merror').fadeOut('slow');
						$('.merror').text('').css('background', 'none repeat scroll 0 0 #f85959').fadeIn(2000).delay(2000).fadeOut(3000);
						$('#mfullname').css('box-shadow','0px 0px 5px #f85959').fadeIn('slow');
					}
					else{
						$('.merror').fadeOut('slow');
						$('.merror').text('Nice name').css('background', 'none repeat scroll 0 0 #1e7909').fadeIn(2000).delay(2000).fadeOut(3000);
						$('#mfullname').css('box-shadow','0px 0px 10px green').fadeIn('slow');
					
				}
				}

			});

			$('.mdobcontainer select').on('change',function(){
				var month=$('select[name="month"]').val();
				var day=$('select[name="day"]').val();
				var year=$('select[name="year"]').val();
				if(month!='Month' && day!='Day'&&year!='Year'){
					
				}
				
			});

			$('input[name="sex"]').on('change',function (){
		        var value =$('input[name="sex"]:radio:checked').val();
		        if(value=='male'|| value=='female'){
		        
		        }
		       
		    });
			

			$('.mselect').on('change',function(){
					var code=$("[class='"+$(this).val()+"']").attr('data');
					$('#mc_code').val('+'+code);	
					
			});
			
			$('#mphoneno').on('blur',function(){
				var phone=$('#mphoneno').val();
				var phone_reg=/^[0-9]{10,}$/;
				if(!phone_reg.test(phone)){
					$(this).css('box-shadow','0px 0px 5px #f85959');
					
				}
				else{
					$(this).css('box-shadow','0px 0px 5px #1e7909');
					
				}
			});

			$('#mtagsearchbox').on('blur',function(){
				if($('#mtagsdiv .msitem').text().length!=0){
					$('#mtagsearchbox').css('box-shadow','0px 0px 5px #1e7909');
				}
				else{
					$('#mtagsearchbox').css('box-shadow','0px 0px 5px #f85959');
				}
			});

			$('#mtagsearchbox2').on('blur',function(){
				if($('#mtagsdiv2 .msitem').text().length!=0){
					$('#mtagsearchbox2').css('box-shadow','0px 0px 5px #1e7909');
				}
				else{
					$('#mtagsearchbox2').css('box-shadow','0px 0px 5px #f85959');
				}
			});

			total_row3=0;
			$('#mtagsearchbox').bind('keyup input',function(e){
					var s= $('#mtagsearchbox').val();
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
										$('.msearch_list1').append('<div  onclick="madd1(\''+obj[i]+'\');" data="'+obj[i]+'">'+obj[i]+'</div>').show();
										total_row3++;
									}
								});			
							}
						});
					}
				});
				 

			total_row4=0;
			$('#mtagsearchbox2').bind('keyup input',function(e){
					var s= $('#mtagsearchbox2').val();
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
										$('.msearch_list2').append('<div onclick="madd2(\''+obj[i]+'\');" data="'+obj[i]+'">'+obj[i]+'</div>').show();
										total_row4++;
									}
								});			
							}
						});
					}
				});

			$('#mfile').change(function(e) {
		         var files = e.originalEvent.target.files;
		                s = files[0].size;
		                t=files[0].type;
		            
		            if(!(t=='image/jpeg' || t=='image/png' || t=='image/bmp')){
		         		$('.merror').text('Please select image files only').css('background', 'none repeat scroll 0 0 #f85959').fadeIn(2000);
							$('.merror').fadeOut(3000);
		                $('#mfile').val('');
		         	}
		            else if (s > 100000) {
		                $('.merror').text('Please select file less than 100Kb').css('background', 'none repeat scroll 0 0 #f85959').fadeIn(2000);
							$('.merror').fadeOut(3000);
						$('#mfile').val('');
		            }

			         	
   			 });
			

			$('#mform_btn').on('click',function(e2){
				if(mvalidate()==1){
					$('#muserprofile').trigger('submit');
					
				}
				else if(mvalidate()==0){
					e2.preventDefault();
					$('.merror').text('Please fill all the fields').css('background', 'none repeat scroll 0 0 #f85959').fadeIn(2000).delay(2000).fadeOut(3000);
				}
				else{
					$('.merror').text('Please enter a valid date').css('background', 'none repeat scroll 0 0 #f85959').fadeIn(2000).delay(2000).fadeOut(3000);
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

			function mvalidate(){
				var mcount=0;
					if(($('#musername').val()).length>0){
						
						mcount++;
					}
					
					if(($('#mfullname').val()).length>0){
						
						mcount++;
					}
					

					var month=$('.mdobcontainer select[name="month"]').val();
					var day=$('.mdobcontainer select[name="day"]').val();
					var year=$('.mdobcontainer select[name="year"]').val();
					if(month!='Month' && day!='Day'&&year!='Year'){
						
						mcount++;
					}
					

					var value =$('.mgenderdiv input[name="sex"]:radio:checked').val();
			        if(value=='male'|| value=='female'){
			        	
			        	mcount++;
			        }
			       

			        var code=$("[class='"+$('.mselect').val()+"']").attr('data');
					$('#mc_code').val('+'+code);
					if(($('#mc_code').val().length)>0){
						
						mcount++;
					}
					
					
					if(($('#mphoneno').val()).length>=10){
					
						mcount++;
					}
					

					var skills=new Array();
					var majors=new Array();
					$('#mtagsdiv .msitem').each(function(index){
						skill=$(this).attr('data');
						$('<input type="hidden" name="skills[]" value="'+skill+'" >').appendTo('form');
					});

					$('#mtagsdiv2 .msitem').each(function(index){
						major=$(this).attr('data');
						$('<input type="hidden" name="majors[]" value="'+major+'" >').appendTo('form');
					});

					if($('#mtagsdiv .msitem').text().length!=0){
						mcount++;
						$('#mtagsearchbox').css('box-shadow','0px 0px 5px #1e7909');
					}
					else{
						$('#mtagsearchbox').css('box-shadow','0px 0px 5px #f85959');
					}
					
					if($('#mtagsdiv2 .msitem').text().length!=0){
						mcount++;
						$('#mtagsearchbox2').css('box-shadow','0px 0px 5px #1e7909');
					}
					else{
						$('#mtagsearchbox2').css('box-shadow','0px 0px 5px #f85959');
					}
					

					if(mcount==8){
						if(!validateDate(parseInt(day),parseInt(month),parseInt(year))){
							return 2;
						}
						else{
							return 1;
						}
					}
					else{
						return 0;
						
					}	

					
				}


			function validateDate(day,month,year){
					 
				     if (day < 1 || day> 31) 
				        return false;
				     else if ((month==4 || month==6 || month==9 || month==11) && day ==31) 
						        return false;
			         else if (month == 2){
							var isleap = (year % 4 == 0 && (year % 100 != 0 || year % 400 == 0));
						        if (day> 29 || (day ==29 && !isleap)) 
						                return false;
						            else{
					 				return true;
					 			}
					 }
					 else{
					 	return true;
					 }
			}

/*........................................................................script for mobile ends  .................................................*/
		
		</script>
	</head>
	<body>
		<?php
			include_once './include/menu.php';
		?>
	<div class="body" style="background:url('../images/top_bg.png');">
		<div class="content">
			<div id='popup_main'>
				<div id='popup_content'>
					<h1 >Complete your profile</h1><br/>
					<form id='userprofile' action='profile.php' method='post' enctype="multipart/form-data">
						<input class='textinput' id='username' type='text'  name='username' placeholder='User Name' style="margin-bottom:10px;"><span class='error_popup'></span>
						<input class='textinput' id='fullname' type='text'  name='fullname' placeholder='Full Name' style="margin-bottom:10px;"><span class='error_popup2'></span>
						<div class='dobcontainer'>
							<label class='textlabel'>Birthday</label>
							<br/>
							<select class='month' name='month'  style="margin-bottom:5px;">
								<option> Month</option>
								<?php 
									$months=array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
									for($var=0;$var<12;$var++)
										echo '<option value='.($var+1).'>'.$months[$var].'</option>';
								?>
							</select>
							<select class='day' name='day' style="margin-bottom:5px;" >
								<option> Day</option>
								<?php
									for($var=1;$var<32;$var++)
										echo '<option>'.$var.'</option>';
								?>
							</select>
							<select class='year' name='year' style="margin-bottom:5px;">
								<option>Year</option>
								<?php
									for($var=Date("Y")-5;$var>=Date("Y")-100;$var-- )
									 	echo '<option>'.$var.'</option>';
								?>	
							</select>
							
						</div>

						<div class='genderdiv' style="margin-bottom:10px;margin-top:10px;" >				
							<span class='span1'><input name='sex' type='radio' value='female' id='female'><label for='female' >Female</label></span>
							<span class='span1'><input name='sex' type='radio' value='male' id='male'><label for='male' >Male</label></span>
						</div>
						<div class='countrydiv'  style="margin-bottom:10px;margin-top:10px;">
							<select class='select' id='country' name="country"  >
								<option value=''>Select Country</option>
								<?php
									include './include/connection.php';
									$rst=mysqli_query($con,'select * from master_countries');
									while($row=mysqli_fetch_assoc($rst)){
											$country=$row['country'];
											$phone_code=$row['phone_code'];
											echo "<option class=\"$country\" data=\"$phone_code\">$country</option>";
									}
								?>
							</select>
						</div>

						<div class='mobilediv' style="margin-bottom:10px;">
							<input id='c_code' class='textinput' name='code' readonly style="width:9%;margin-right:7px">
							<input id="phoneno" class='textinput' type='text' name='phone' placeholder='mobile number' style="width:88%">
						</div>

						<div id='tagcontainer2'>
							<input id='tagsearchbox2' class='textinput' type='text' name='major' autocomplete='off' placeholder='Majors' style="width:25%;"/>
										<div class='search_list2'></div>
									
							<div id='tagsdiv2' style="display:block;"></div><br/>
							<span class="major_span">Select your domain like Programming & IT experts, Marketing, Writer, Doctor etc.</span>
						</div>


						<div id='tagcontainer' >
							<input id='tagsearchbox' class='textinput' type='text' name='skill' autocomplete='off' placeholder='Skills' style="width:25%;" />
									<div class='search_list1'></div>
								
							<div id='tagsdiv' style="display:block;"></div><br/>
							<span class="major_span">Select your area of interest like Android, Neurology, Ghost writer etc.</span>
						</div>

						<input id="file" type="file"  name="user_image" style="margin-bottom:5px;"/><br/>
						<span>Choose your profile image (<100kb) </span><br/>

							<br/><label class='textlabel' style="margin-bottom:10px;" >Description</label><br/>
							<textarea class='textinputarea' name='description' placeholder="Write something about yourself.." ></textarea>
					
						<input type='button' value='Submit' class='button' id="form_btn" >
						<input type='button' value='Reset'  class='button' id="reset_btn" >
					</form>

				</div>

			</div>
		
			<div id='trans_bg'></div>		
			
		</div>
				
				
				
		<div class="mcontent">
			<div class='merror' style="display:none;"></div>
			<div class="mpopup_content" style="font-size:11px;">
				<h1>Complete your profile</h1><br/>
				<form id='muserprofile' action='profile.php' method='post' enctype="multipart/form-data">
					<input class='mtextinput' id='musername' type='text'  name='username' placeholder='User Name' style="margin-bottom:10px;">
					<input class='mtextinput' id='mfullname' type='text'  name='fullname' placeholder='Full Name' style="margin-bottom:10px;">
					<div class='mdobcontainer'>
						<label class='textlabel'>Birthday</label>
						<br/>
						<select class='month' name='month'  style="margin-bottom:5px;">
							<option> Month</option>
							<?php 
								$months=array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
								for($var=0;$var<12;$var++)
									echo '<option value='.($var+1).'>'.$months[$var].'</option>';
							?>
						</select>
						<select class='day' name='day' style="margin-bottom:5px;" >
							<option> Day</option>
							<?php
								for($var=1;$var<32;$var++)
									echo '<option>'.$var.'</option>';
							?>
						</select>
						<select class='year' name='year' style="margin-bottom:5px;">
							<option>Year</option>
							<?php
								for($var=Date("Y")-5;$var>=Date("Y")-100;$var-- )
								 	echo '<option>'.$var.'</option>';
							?>	
						</select>
					</div>

					<div class='mgenderdiv' style="margin-bottom:5px;margin-top:5px;" >				
						<span class='span1'><input name='sex' type='radio' value='female' id='female'><label for='female' >Female</label></span>
						<span class='span1'><input name='sex' type='radio' value='male' id='male'><label for='male' >Male</label></span>
					</div>
					<div class='mcountrydiv'  style="margin-bottom:5px;">
						<select class='mselect'  name="country" id='mcountry' style="width:100%;"  >
							<?php
								include './include/connection.php';
								$rst=mysqli_query($con,'select * from master_countries');
								while($row=mysqli_fetch_assoc($rst)){
										$country=$row['country'];
										$phone_code=$row['phone_code'];
										echo "<option class=\"$country\" data=\"$phone_code\">$country</option>";
								}
							?>
						</select>
					</div>
					

					<div class='mmobilediv' style="margin-bottom:5px;">
					<input id='mc_code' class='mtextinput' name='code' readonly style="width:18%;margin-right:7px">
					<input id='mphoneno' class='mtextinput' type='text' name='phone' placeholder='mobile number' style="width:80%">
					</div>

					<!-- tag search and tag listing -->
					<div id='mtagcontainer2' >
						<input id='mtagsearchbox2' class='mtextinput' type='text' name='skill' autocomplete='off' placeholder='Category' style="width:25%;"/>
									<div class='msearch_list2'></div>
								
						<div id='mtagsdiv2' style="display:block;"></div>
						<span class="major_span">Select your domain like Programming & IT experts, Marketing, Writer, Doctor etc.</span>
					</div>


					<div id='mtagcontainer' >
							<input id='mtagsearchbox' class='mtextinput' type='text' name='skill' autocomplete='off' placeholder='Interests' style="width:25%;" />
									<div class='msearch_list1'></div>
								
						<div id='mtagsdiv' style="display:block;"></div>
						<span class="major_span">Select your area of interest like Android, Neurology, Ghost writer etc.</span>
					</div>

					
		
				
					<!-- tag search and tag listing end-->
				
					
					<input id="mfile" type="file"  name="user_image" style="margin-bottom:5px;"/><br/>
					<span>Choose your profile image (<100kb) </span><br/>

					<br/><label class='textlabel' style="margin-bottom:10px;" >Description</label><br/>
					<textarea class='mtextinputarea' name='description' placeholder="Write something about yourself..." ></textarea>

					<input type='button' value='Submit' class='button' id="mform_btn" style="margin-bottom:5px;">
					<input type='button' value='Reset' class='button' id="mreset_btn" style="margin-bottom:5px;float:left;">
				</form>
			</div>		
			<div id='mtrans_bg'></div>
		</div>

		<style>
			#toast-container {
				position: fixed;
				z-index: 99999;
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