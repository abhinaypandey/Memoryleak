<?php 
	include_once './include/lock_normal.php';
	include './include/connection.php';
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Support</title>
		<?php
			include_once './include/head.php';
		?>
	<style>
			/*--------------------DESKTOP STYLES--------------------*/
			.input,.button{
				transition: all 0.5s ease;
				-moz-transition: all 0.5s ease;
				-webkit-transition: all 0.5s ease;
				-o-transition: all 0.5s ease;
				-ms-transition: all 0.5s ease;
			}
			.prev-content{
				display:none;
				max-height:800px;
				overflow:auto;
				overflow-style:marquee-line;
				
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
				width:60%;	
				background-color:#222;
				color:#FFF;
				font: 12px "Helvetica Neue", Helvetica, Arial, sans-serif;
				text-shadow:1px 1px 1px #000;
				position:relative;
				margin:auto;
				margin-top:15px;
			}
			.wrapper .header{
				border-bottom: 1px solid  #444;
				padding:10px 0px 30px 0px;
			}
			.description-form{
				width:100%;
				padding:20px 0px 40px 0px;
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
			.prev-records{
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
				background-color:#FFF;
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
			#description{
				max-width:78%;
				min-width:78%;
				height:150px;
			}
			.button{
				position:relative;
				width:20%;
				height:35px;
				margin:auto;
				margin-top:20px;
			}
			.button{
				font-weight:bold;
				background: #FFF;
				border: none;
				padding: 10px 25px 10px 25px;
				color: #ddd;
				border-radius: 4px;
				background: #7f345a;
				height:40px;
				width:30%;
				margin-top:35px;
			}
			.button:hover {
				
				background-color: #652648;
				box-shadow: inset 0 1px 3px rgba(0,0,0,0.5);
				-moz-box-shadow: inset 0 1px 3px rgba(0,0,0,0.5);
				-webkit-box-shadow: inset 0 1px 3px rgba(0,0,0,0.5);
				cursor:pointer;	
			}
			.button:focus {
				position: relative;
				bottom: -1px;
				background: #7f345a;
				box-shadow: inset 0 1px 6px rgba(256,256,256,0.75);
				-moz-box-shadow: inset 0 1px 6px rgba(256,256,256,0.75);
				-webkit-box-shadow: inset 0 1px 6px rgba(256,256,256,0.75);
			}
			.main-content .warning{
				width:85%;
				margin:auto;
				text-align:right;
				font: 12px "Helvetica Neue", Helvetica, Arial, sans-serif;
				display:none;
			}
			#generate-ticket{
			}
			#prev-ticket{
				background:none;
				margin-left:32%;	
				
			}
			td{
				padding-left:3%;
				padding-top:1%;
			}
			table{
				width:100%;
			}
			.ticket-status{
				color:#660000;
			}
			.query-description{
				padding-left: 12%;
				padding-top: 2%;
				padding-bottom: 2%;
			}
			/*--------------------MOBILE STYLES--------------------*/
			#mgenerate-ticket{
			}
			#mprev-ticket{
				background:none;
				margin-left:32%;	
				
			}
			
			#mdescription{
				max-width:78%;
				min-width:78%;
				height:150px;
			}
			#mgenerate-ticket{
				font-weight:bold;
				background: #FFF;
				border: none;
				padding: 10px 25px 10px 25px;
				color: #ddd;
				border-radius: 4px;
				background: #7f345a;
				width:120px;
			}
			#mgenerate-ticket:hover {
				
				background-color: #652648;
				box-shadow: inset 0 1px 3px rgba(0,0,0,0.5);
				-moz-box-shadow: inset 0 1px 3px rgba(0,0,0,0.5);
				-webkit-box-shadow: inset 0 1px 3px rgba(0,0,0,0.5);
				cursor:pointer;	
			}
			#mgenerate-ticket:focus {
				position: relative;
				bottom: -1px;
				background: #7f345a;
				box-shadow: inset 0 1px 6px rgba(256,256,256,0.75);
				-moz-box-shadow: inset 0 1px 6px rgba(256,256,256,0.75);
				-webkit-box-shadow: inset 0 1px 6px rgba(256,256,256,0.75);
			}
			#new-ticket{
				margin-top: 0px;
				margin-bottom:30px;
				margin-left: 35%;
				display:none;
			}
			#mnew-ticket{
				margin-top: 0px;
				margin-bottom:30px;
				margin-left: 35%;
				display:none;
			}
			#mwrapper{
				width:90%;
			}
		</style>
		

		<script>
			/*--------------------DESKTOP SCRIPT--------------------*/
			$(document).ready(function() {				
				$('#prev-ticket').click(function(){
					$('.main-content').slideUp('slow');
					$('.prev-content').delay('slow').slideDown('slow');
					$('#new-ticket').delay('slow').fadeIn('slow');

				});
				$('#new-ticket').click(function(){
					$('#new-ticket').delay('slow').fadeOut('slow');
					$('.prev-content').delay(800).slideUp('slow');					
					$('.main-content').delay(1200).slideDown('slow');
				});
					
				
				
				/*--------------------VALIDATION--------------------*/
				
				var flag_1=true;
				var flag_2=true;
				
				
				$('#subject').change(function(){
					var name=$('#subject').val();
					var name_reg=/^[a-zA-Z\s]+$/;
						if(name==''){
							$('#subject').css('background-color','#fff');
							$('#subject-warning').slideUp('slow');
							$('#subject-warning-2').slideUp('slow');	
							flag_1=false;
						}
						else if(!name_reg.test(name)){
							$('#subject').css('background-color','#ff8b8b');
							$('#subject-warning').slideDown('slow');
							$('#subject-warning-2').slideUp('slow');
							flag_1=false;
						}
						else{
							$('#subject').css('background-color','#FFF');
							flag_1=true;
							$('#subject-warning').slideUp('slow');
							$('#subject-warning-2').slideUp('slow');
						}
				});
				
				
				$('#description').change(function(){
					var description=$('#description').val();
						if(description==''){
							$('#description').css('background-color','#FFF');
							$('#description-warning').slideUp('slow');
							flag_2=false;
						}
						else{
							$('#description').css('background-color','#fff');
							$('#description-warning').slideUp('slow');
							flag_2=true;
						}
				});
				/*--------------------FORM VALIDATION--------------------*/
				$('#generate-ticket').click(function(){
					var description=$('#description').val(); 
					var subject=$('#subject').val();
					
						if(subject==''){
							$('#subject').css('background-color','#ff8b8b');
							$('#subject-warning-2').slideDown('slow');
							flag_1=false;
						}
						else{
							$('#subject').css('background-color','#fff');
							$('#subject-warning-2').slideUp('slow');
						}
					
					if(description==''){
						$('#description').css('background-color','#ff8b8b');
						$('#description-warning').slideDown('slow');
						flag_2=false;
					}
					else{
						$('#description').css('background-color','#fff');
						$('#description-warning').slideUp('slow');
					}
					
					if( (flag_1==true) && (flag_2==true) ){
						$.ajax({
							url:'query.php',
							type:'post',
							data:
								{
									type:'30',
									subject:subject,
									description:description,
								},
							error:function(){
								alert('error');
							}
						}).done(function(data){
							if(data!='failure'){
								$('.prev-content').prepend('<div class="prev-records" id="prev-record-1"><table><tr><td><b>Issue : </b>'+subject+'</td></tr><tr><td class="query-description" >'+description+'</td></tr><tr><td><b>Date : </b>Posted now</td></tr><tr><td><b>Status : <i class="ticket-status">Unresolved</i></b></td></tr></table></div>');								
								$('#prev-record-0').css('display','none');
								$('.main-content').delay('slow').slideUp('slow');
								$('.prev-content').delay('slow').delay('slow').slideDown('slow');
								$('#new-ticket').delay('slow').fadeIn('slow');
								$('#description').val('');
								$('#subject').val('');
							}
							else{
								alert('Query not Submitted');
							}
						});
					}
				});
				
			});
			/*--------------------MOBILE SCRIPT--------------------*/
			$(document).ready(function() {
				$('#mprev-ticket').click(function(){
					$('.main-content').slideUp('slow');
					$('.prev-content').delay('slow').slideDown('slow');
					$('#mnew-ticket').delay('slow').fadeIn('slow');

				});
				$('#mnew-ticket').click(function(){
					$('#mnew-ticket').delay('slow').fadeOut('slow');
					$('.prev-content').delay(800).slideUp('slow');					
					$('.main-content').delay(1200).slideDown('slow');
				});
					
			
				
				/*--------------------VALIDATION--------------------*/
				
				var mflag_1=true;
				var mflag_2=true;
				
				
				$('#msubject').change(function(){
					var name=$('#msubject').val();
					var name_reg=/^[a-zA-Z\s]+$/;
						if(name==''){
							$('#msubject').css('background-color','#fff');
							$('#msubject-warning').slideUp('slow')
							flag_1=false;
						}
						else if(!name_reg.test(name)){
							$('#msubject').css('background-color','#ff8b8b');
							$('#msubject-warning').slideDown('slow');
							flag_1=false;
						}
						else{							$('#msubject').css('background-color','#FFF');
							mflag_1=true;
							$('#msubject-warning').slideUp('slow');
						}
				});
				
				
				$('#mdescription').change(function(){
					var description=$('#mdescription').val();
						if(description==''){
							$('#mdescription').css('background-color','#FFF');
							mflag_2=false;
						}
						else{
							$('#mdescription').css('background-color','#fff');
							mflag_2=true;
						}
				});
				/*--------------------FORM VALIDATION--------------------*/
				$('#mgenerate-ticket').click(function(){
					var description=$('#mdescription').val(); 
					var subject=$('#msubject').val();
					
						if(subject==''){
							$('#msubject').css('background-color','#ff8b8b');
														mflag_1=false;
						}
						else{
							$('#msubject').css('background-color','#fff');
						}
					
					if(description==''){
						$('#mdescription').css('background-color','#ff8b8b');
						mflag_2=false;
					}
					else{
						$('#mdescription').css('background-color','#fff');
					}
					
					if( (mflag_1==true) && (mflag_2==true) ){
						$.ajax({
							url:'query.php',
							type:'post',
							data:
								{
									type:'30',
									subject:subject,
									description:description,
								},
							error:function(){
								alert('error');
							}
						}).done(function(data){
							if(data!='failure'){
								$('.prev-content').prepend('<div class="prev-records" id="mprev-record-1"><table><tr><td><b>Issue : </b>'+subject+'</td></tr><tr><td class="query-description" >'+description+'</td></tr><tr><td><b>Date : </b>Posted now</td></tr><tr><td><b>Status : <i class="ticket-status">Unresolved</i></b></td></tr></table></div>');								$('#mprev-record-0').css('display','none');
								$('.main-content').delay('slow').slideUp('slow');
								$('.prev-content').delay('slow').delay('slow').slideDown('slow');
								$('#mnew-ticket').delay('slow').fadeIn('slow');
								$('#description').val('');
								$('#subject').val('');
							}
							else{
								alert('Query not Submitted');
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
		

			<!----------------------------------------------------DESK TOP CONTENT---------------------------------------------------->
			<div class="content">
							<div class="wrapper">
								
								<!--------------------CUSTOMER SUPPORT FORM-------------------->
								<form class="description-form" name="form1">
									<div class="header">
										<center><h1>Customer Support </h1></center>
										<center><span>share your query with us and generate your support ticket</span></center>
									</div>
									
									<!--------------------PREVIOUS TICKET SECTION-------------------->
									<div class="prev-content">
									<?php
										
										/*--------------------RETRIEVING PREVIOUS TICKETS--------------------*/
										$query='select * from supports where user_id='.$login_session.' order by ticket_id desc';
										if($result=mysqli_query($con,$query)){
											$i=1;
											while($row=mysqli_fetch_array($result)){
												echo '
														<div class="prev-records" id="prev-record-'.$i.'">
															<table>
																<tr>
																	<td><b>Issue : </b>'.$row['subject'].'</td>
																</tr>
																<tr>
																	<td class="query-description" >'.$row['description'].'</td>
																</tr>
																<tr>
																	<td><b>Date : </b>'.date('d.m.Y', strtotime($row['entry_date_time'])).'</td>
																</tr>';
												if($row['reply']==''){
													echo ' <tr>
																<td><b>Status : <i class="ticket-status">Unresolved</i></b></td>
														   </tr>';
												}
												else{
													echo ' <tr>
																<td><b>Admin Reply : </b>'.$row['reply'].'</td>
														   </tr>';
												}
												echo '			
															</table>
														</div>
														';
											$i++;
											}
											if(mysqli_affected_rows($con)==0){
												echo '<div class="prev-records" id="prev-record-0">
													  	No Records found
													  </div>';
											}
										}
										else{
											
										}
									?>
									</div>
									
									<!--------------------NEW TICKET SECTION-------------------->
									<div class="main-content">
										<input type="text" id="subject" class="input" placeholder="Subject :"/>
										<div class="warning" id="subject-warning">*Invalid Subject</div>
										<div class="warning" id="subject-warning-2">*Enter the Subject</div>
										<textarea placeholder="Description :" class="input" id="description"></textarea>
										<div class="warning" id="description-warning">*Enter the description</div>
											<div style="display:inline;">
												<input type="button" class="button" id="prev-ticket" value="Previous Tickets">
												<input type="button" class="button" id="generate-ticket" value="Generate Ticket">
											</div>
									</div>
								</form> 
								<input type="button" value="New Ticket" class="button" id="new-ticket">
							</div>
				</div>
				<div class="mcontent">	
					<div class="wrapper" id="mwrapper"> 
								
								<!--------------------CUSTOMER SUPPORT FORM-------------------->
								<form class="description-form" name="form1">
									<div class="header">
										<center><h1>Customer Support </h1></center>
										<center><span>share your query with us and generate your support ticket</span></center>
									</div>
									
									<!--------------------PREVIOUS TICKET SECTION-------------------->
									<div class="prev-content">
									<?php
										
										/*--------------------RETRIEVING PREVIOUS TICKETS--------------------*/
										$query='select * from supports where user_id='.$login_session.' order by ticket_id desc';
										if($result=mysqli_query($con,$query)){
											$i=1;
											while($row=mysqli_fetch_array($result)){
												echo '
														<div class="prev-records" id="mprev-record-'.$i.'">
															<table>
																<tr>
																	<td><b>Issue : </b>'.$row['subject'].'</td>
																</tr>
																<tr>
																	<td class="query-description" >'.$row['description'].'</td>
																</tr>
																<tr>
																	<td><b>Date : </b>'.date('d.m.Y', strtotime($row['entry_date_time'])).'</td>
																</tr>';
												if($row['reply']==''){
													echo ' <tr>
																<td><b>Status : <i class="ticket-status">Unresolved</i></b></td>
														   </tr>';
												}
												else{
													echo ' <tr>
																<td><b>Admin Reply : </b>'.$row['reply'].'</td>
														   </tr>';
												}
												echo '			
															</table>
														</div>
														';
											$i++;
											}
											if(mysqli_affected_rows($con)==0){
												echo '<div class="prev-records" id="mprev-record-0">
													  	No Records found
													  </div>';
											}
										}
										else{
											
										}
									?>
									</div>
									
									<!--------------------NEW TICKET SECTION-------------------->
									<div class="main-content">
										<input type="text" id="msubject" class="input" placeholder="Subject :"/>
										<div class="warning" id="msubject-warning">*Invalid Subject</div>
										<textarea placeholder="Description :" class="input" id="mdescription"></textarea>
											<div style="display:inline;">
												<input type="button" class="button" id="mprev-ticket" value="Previous Tickets">
												<input type="button" class="button" id="mgenerate-ticket" value="Generate Ticket">
											</div>
									</div>
								</form> 
								<input type="button" value="New Ticket" class="button" id="mnew-ticket">
							</div>		
				</div>		
		</div>		
		<?php
			include_once './include/footer.php';
		?>
		
	</body>
</html>