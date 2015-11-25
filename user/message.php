<?php 
include_once './include/lock_normal.php';
?>
<!DOCTYPE html>
<html>
	<head>
        <link rel="shortcut icon" href="./images/logo.png">
		<title>Message</title>
		<?php
			include_once './include/head.php';
		?>
		<style>
			.main_msg:hover{
				background-color:silver;
            }
		</style>
		<script>
			$(document).ready(function(){
			    var sender_id=-1;
				$('.main_msg').click(function(){
				   sender_id=$.trim($(this).attr('data')); 
				   $.ajax({
						url:"./query.php",
						type:"POST",
						data:{
							type:2,
							sender_id:sender_id
						}
					}).done(function(data){
					  
						$('#msgdiv').text('').append(data);    
						var target=0;

						$('.msg').each(function(){
							var height=$(this).height();
							target=target+height;
						});
						$('#msgdiv').animate({ scrollTop: target }, 1000);
						
					});
					
				});
				
				
				$('#send').click(function(){
					var messagepage_text=$.trim($('#messagepage_text').val());
					if(messagepage_text!=''){
						if(sender_id==-1){
							alert('please select the conversation to send message..');
						}
						else{
							$.ajax({
								url:"./query.php",
								type:"POST",
								data:{
									type:2,
									sender_id:sender_id,
									message_text:messagepage_text
								}  
							}).done(function(data){
								$('#msgdiv').text('').append(data);    
								var target=0;

								$('.msg').each(function(){
									var height=$(this).height();
									target=target+height;
								});
								$('#msgdiv').animate({ scrollTop: target }, 1000);
								$('#messagepage_text').val('');

							});
						  }
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
			<div class="content">
				<div>
                    <br/>
					<div style="margin-left:2%; margin-right:10%; width:80%; height:600px; background-color:whitesmoke">
						<div style="width:30%; height:100%; float:left; overflow-y:auto; ">
						<?php
							 include './include/connection.php';
							$result=mysqli_query($con,'select distinct(from_user_id) as from_user_id, user_name from messages,profiles where user_id=from_user_id and to_user_id='.$login_session.' order by date_time desc ');
							if(mysqli_num_rows($result)==0){
									echo 'no new message....';
							}
							while($row=mysqli_fetch_array($result)){
								$message_result=mysqli_query($con,'select * from messages where to_user_id='.$login_session.' and from_user_id='.$row['from_user_id'].' order by date_time desc');
								$message_data=mysqli_fetch_array($message_result);
								//getting date,time,day when msg has been sent by sender
								$parenttime = $message_data['date_time'];
								$timestamp=strtotime($parenttime);
								$get_date = date('j-n-Y',$timestamp);
								$get_time = date('H:i',$timestamp);
								$date_present=date('j-n-Y');
								//$get_day = date('D', $timestamp);
								if($date_present==$get_date){
									$show_date=$get_time;                
								}
								else{
									$show_date=$get_date;                
								}
								if(strlen($message_data['message_text'])>28){
									$message_data['message_text']=substr($message_data['message_text'],0,27).' ...';
								}
								echo '<div class="main_msg" data= "'.$message_data['from_user_id'].'" style="width:100%; height:12%; 
											cursor:pointer; border-bottom:1px solid black;">

												<div style="float:left; width:20%; height:12%; margin-left:1%;margin-top:1%;">
                                                   <img src="image.php?user_id='.$message_data['from_user_id'].'" width=50px height=50px style="float:left;border-radius:50px;">
												</div>
                                                <div style=" width:77%; height:12%; border-radius:10px; margin-top:1%; margin-left:23%;">
                                                    <h3 style="color:#3bb;">'.$row['user_name'].'</h3>
                                                    <p>'.$message_data['message_text'].'</p>
                                                    <p style="color:blue;">'.$show_date.'</p>
												</div>  
										</div>
									  ';
								}
						?>     
						
						</div>
						<div style="width:69.7%; height:100%; float:right; border-left:1px solid black;">
							<div  id="msgdiv" style="width:100%; height:80%; border-bottom:1px solid black; overflow-y:auto;">
								
								 
								
								
							</div>
							
							
							<div style="width:100%; height:19.70%; padding:10px; ">
								<textarea id="messagepage_text" name="text_submit" placeholder="Type your message here" 
										  style=" width:80%; height:60%; resize:none;"></textarea>
								<input type="button" value="Send" id="send">
							</div>
						
						</div>
					</div>
            
				</div>
				
				
			</div>		
			<div class="mcontent">
				<div style=" margin-top:50px; width:90%; max-height:200px; background-color:whitesmoke; margin-left:auto; margin-right:auto; overflow-y:auto; border:1px solid black;">
                    
                        <?php
                        /*
						if(isset($_GET['sender_id'])){
                            $user_id=$_GET['sender_id'];
                            $result=mysqli_query($con,"update messages set view_flag=0 where from_user_id=$user_id and to_user_id=$login_session ");
                        }
						*/
                        $result=mysqli_query($con,'select distinct(from_user_id) as from_user_id, user_name from messages,profiles where user_id=from_user_id and to_user_id='.$login_session.' order by date_time desc ');
						if(mysqli_num_rows($result)==0){
								echo 'no new message....';
						}
						while($row=mysqli_fetch_array($result)){
							$message_result=mysqli_query($con,'select * from messages where to_user_id='.$login_session.' and from_user_id='.$row['from_user_id'].'');
							$message_data=mysqli_fetch_array($message_result);
							//getting date,time,day when msg has been sent by sender
							$parenttime = $message_data['date_time'];
							$timestamp=strtotime($parenttime);
							$get_date = date('j-n-Y',$timestamp);
							$get_time = date('H:i',$timestamp);
							$date_present=date('j-n-Y');
							//$get_day = date('D', $timestamp);
							if($date_present==$get_date){
								$show_date=$get_time;                
							}
							else{
								$show_date=$get_date;                
							}
							if(strlen($message_data['message_text'])>25){
								$message_data['message_text']=substr($message_data['message_text'],0,24).' ...';
							}
                                
							echo '<div class="m_main_msg" data= "'.$message_data['from_user_id'].'" style="width:100%; height:60px; 
											cursor:pointer; border-bottom:1px solid black;">

												<div style="float:left; width:15%; height:90%;">
                                                   <img src="image.php?user_id='.$message_data['from_user_id'].'" width=50px height=50px style="float:left;border-radius:50px;">
												</div>

												   <div style="float:left; width:55%; height:15%;">
														<h4>'.$row['user_name'].'</h4>
													</div>

													<div style="float:right; width:25%; height:15%; color:blue;">
															<p>'.$show_date.'</p>
													</div>

													<div style="width:83%; height:35px; padding-top:6%;">
														<h6>'.$message_data['message_text'].'</h6>
													</div>
									</div>
									
								  ';
						}
                    ?>
                    
                </div>
               
                <div id="m_main_msgdiv" style="width:90%; height:300px; 
                                          margin-left:auto; 
                                          margin-right:auto; 
                                          margin-top:5px; 
                                          background-color:whitesmoke;
                                          border:1px solid black; display:none;">
                    <!--<div class="m_image_close" ></div>-->
                    <div id="m_msgdiv" style="width:100%; height:200px; overflow-y:auto; border-bottom:1px solid black; ">
                    </div>
                    
                    <!--to write message                    -->
                    <div style="width:100%; height:100px;">
                        <textarea id="m_messagepage_text" name="m_text_submit" placeholder="Type your message here " 
                                      style=" width:90%; height:60%; margin-top:5px; margin-left:5px; resize:none; border:1px solid #d98e00;"></textarea>
                        <input type="button" value="Send" id="m_send" style="margin-left:5px;">
                    </div>
                    
                </div>
            
            <script>
                $(document).ready(function(){
                    var msender_id=-1;
					$(".m_main_msg").click(function(){
                        
						$("#m_main_msgdiv").show();
							msender_id=$.trim($(this).attr('data')); 
							$.ajax({
                                url:"query.php",
                                type:"POST",
                                data:{
									type:'7',
									sender_id:msender_id
								}  
                            }).done(function(data){
                                
                                $('#m_msgdiv').text('').append(data);    
                                var target=0;
                                $('.m_msg').each(function(){
                                    var height=$(this).height();
                                    target=target+height;
                                });
                                $('#m_msgdiv').animate({ scrollTop: target+135 }, 2000);

                            });
                    });
             
                
                
                
                
                $('#m_send').click(function(){
					var m_message_text=$.trim($('#m_messagepage_text').val());
					if(m_message_text!=''){
						if(msender_id==-1){
							alert('please select the conversation to send message..');
							
						}
                    else{
                        $.ajax({
                            url:"query.php",
                            type:"POST",
                            data:{
								type:'7',
								sender_id:msender_id,
								message_text:m_message_text
							}  
					}).done(function(data){
                            $('#m_msgdiv').text('').append(data);    
                            var target=0;

                            $('.m_msg').each(function(){
                                var height=$(this).height();
                                target=target+height;
                            });
                            $('#m_msgdiv').animate({ scrollTop: target+135 }, 2000);
                            $('#m_messagepage_text').val('');

                        });
                      }
                }
                
            });
               });
                
                
            </script>
            
				
				
			</div>		
		</div>
		<?php
			include_once './include/footer.php';
		?>
	</body>
</html>