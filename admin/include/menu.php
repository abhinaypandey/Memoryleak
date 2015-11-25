		<script>
			//-----------------------------------------------------tag serach start-----------------------------------------------------------------
			$(document).ready(function(){
				var total_row=0;
				var current_pos=0;
				var del_count=2;
				$('.search_input').bind('keyup input',function(event){
					var input=$.trim($(this).val());
					var keycode = event.which;
						
					if(keycode==40){
						if(current_pos<total_row){
							$('.results div:nth-child('+current_pos+')').removeClass('selected').css('background','white');
							current_pos=current_pos+1;
							$('.results div:nth-child('+current_pos+')').addClass('selected').css('background','#3bb998');
						}	
					}
					else if(keycode==38){
						if(current_pos>1){
							$('.results div:nth-child('+current_pos+')').removeClass('selected').css('background','white');
							current_pos=current_pos-1;
							$('.results div:nth-child('+current_pos+')').addClass('selected').css('background','#3bb998');			
						}
					}
					else if(keycode==8&&input==''){			
						//alert(del_count);
						del_count=del_count-1;
						if(del_count==0){
							$('.results').html('').hide();
							$('.tags_container div:last-child').remove();
							del_count=2;
						}
						
					
					}
					else if(keycode==13&&input!=''){
						var tag=$('.selected').attr('data');
						if(tag&&$(".tags_container > [data='"+tag+"']").length==0){
							$('.tags_container').append('<div class="tags" title="clcik here to remove" onclick="remove();" data="'+tag+'">'+tag+'</div>');
							$('.results').html('').hide();
							$(this).val('');
						}						
					}
					else if(input!=''){
						current_pos=0;
						$.ajax({
							url:'query.php',
							type:'POST',
							data:{
								type:'5',
								searchword:input
							}						
						}).done(function(tags){
							$('.results').html('').hide();
							if($.trim(tags)!=''){
								total_row=0;
								var obj = jQuery.parseJSON(tags);
								$.each(obj,function(i){
									if($(".tags_container > [data='"+obj[i]['user_name']+"']").length==0&&obj[i]['user_id']!='<?php echo $login_session; ?>'){
										total_row=total_row+1;							
										$('.results').append('<div class="tag_click" onclick="add(\''+obj[i]['user_name']+'\');" title="clcik here to remove" data="'+obj[i]['user_name']+'" align="left"><img  style="width:50px; height:50px; float:left; margin-right:6px; -webkit-user-select: none;  width:50px; height:50px;" src="image.php?user_id='+obj[i]['user_id']+'" /><span class="name_from_list">'+obj[i]['user_name']+'</span>&nbsp;</div>').show();
									}
								});			
							}
						});
					}
					else{
						$('.results').html('').hide();
					}
				});
				$('.auto_complete_container').click(function(){
					$('.search_input').val('').focus();
				});
				$('#send_button').click(function(){
					var list=new Array();
					var message_text=$('#message_text').val();
					$('.tags').each(function(i){
						list[i]=$(this).attr('data');					
					});
					
					if(list!=''&&message_text!=''){
						$.ajax({
							url:'query.php',
							type:'POST',
							data:{
								type:'6',
								message_text:message_text,
								list:list
							}
						}).done(function(data){
							if($.trim(data)=='1'){
								alert("message send successfully.");
								$('#msgpopup_main').hide();
								$('.msgtrans_bg').hide();
							}
							
						});
					}	
					else{
						alert('you left somefields in the form');
					}
					
				
				});
			});
			function add(tag){
				if($(".tags_container > [data='"+tag+"']").length==0){
					$('.tags_container').append('<div class="tags" onclick="remove();" data="'+tag+'">'+tag+'</div>');
					$('.results').html('').hide();
					$('.search_input').val('').focus();
				}						
			}
			//------------------------------------------------------------------------end--------------------------------------------------------
		</script>
		<style>
			
			.auto_complete_container{
				padding:5px;
				min-height:25px;
				border:1px solid green;
				cursor:text;
				width:97.8%;
			}
			.tags_container{
				word-wrap:break-word;
			}
			.search_panel{
				display:inline-block;
			}
			.tags{
				background: #e2e6f0;
				border: 1px solid #9daccc;
				-webkit-border-radius: 2px;
				color: #1c2a47;
				cursor: pointer;
				display: block;
				float: left;
				margin: 0 4px 4px 0;
				padding: 0 3px;
				position: relative;
				white-space: nowrap;
				
			}
			.results{
				position: absolute;
				min-width:150px;
				opacity: 0.9;
				display: block;
				
			}
			.results{
				list-style:none;
				border:1px solid grey;
				display:none;
			}
			.results div{
				background-color: white;
				border-color: #3b5998;
				min-width:100px;
				padding:4px;
				border-top:solid 1px #dedede; 
				font-size:12px; height:50px;
				cursor:pointer;
				z-index:10;
			}
			.results div:hover{
				border-color: #3b5998;
				min-width:100px;
				background-color:#3bb998;
				color:#FFFFFF;
				cursor:pointer;				
			}
			.search_input{
				border:none;
				min-width:20px;
				height:25px;
				background-color:transparent;
			}
			.search_input:focus{
				outline:none;
				border:none;
			}
			.tags-content{
				display:block;
				width:100%;
			}
        		
		</style>
		
		<header class="desktop">
			<div class="logo"></div>
			<div class="name"><h2>Memory</h2><h2>Leak</h2></div>
			<div class="logo_image" ></div>
			<div class="panel">
				<div class="dnav" style="z-index:5;">
					<ul class="main_list" style="z-index:5;">	
						<li><a href="index.php" >Home</a></li>
						<li><a class="drop_down" style="cursor:pointer;">Transactions</a>
							<ul class="tooldrop">
								<li><a href="withdrawal_requests.php">Withdrawal&nbsp;&nbsp;&nbsp;  Requests</a></li>
								<li><a href="#">Rollback &nbsp;&nbsp;&nbsp; Requests</a></li>
							</ul>
						</li>
						<li><a class="drop_down" style="cursor:pointer;">Miscellaneous</a>
							<ul class="tooldrop">
								<li><a href="master_update.php">Master Updations</a></li>
								<li><a href="#">Transactions History</a></li>
								<li><a href="#">Feedbacks</a></li>
							</ul>
						</li>
					</ul>				
				</div>
				<div class="tool">
					<div class="ntoolpanel">
						<ul>
							<li id="question"></li>
							<li id="message">
								<?php 
									include './include/connection.php';
								?>
							</li>
							<li id="dollar"></li>
						</ul>
					</div>
					<div class="atoolpanel">
						<ul>
							<li id="account" style="background-image:url('image.php?user_id=<?php echo $login_session; ?>');"></li>
						</ul>
					</div>
				</div>	
				<div>
					<div class="notque tooldrop" style="display:none;">
						<div style="z-index: 10; background-image: url(&quot;./images/beeper.png&quot;); height: 11px; top: -10px; width: 23px; position: relative; left: 92px;">
						</div>
						<div style="width:300px; height:18px; position: absolute; top: 1px;">
                            <h4>Notification</h4>
                        </div>
						<div style=" position:absolute; top:19px; width:300px; height:232px; overflow-y:auto;border-top:1px solid black;padding-top:1px">
							<?php
								include './include/connection.php';
							 $query="select count(*) from supports where flag=1";
							 $result=mysqli_query($con,$query);
							 $count=mysqli_fetch_array($result);
							 if($count[0]>0)
							 {
							  echo'<a href="./support.php"><div id="support_notif">You have '.$count[0].' Unresolved Queries</div></a><br><hr> 
													</div>';
							  echo "<style>
										 #question
										 {
										  background-image:url('./images/question.png');
										 }
										</style>";
							 }
							?>
						
						</div>
					</div>
					<div class="notmes tooldrop" style="display:none;">
						<div style="z-index: 10; background-image: url(&quot;./images/beeper.png&quot;); height: 11px; top: -10px; width: 23px; position: relative; left: 138px;">
						</div>
						
                        <div style="width:300px; height:18px; position: absolute; top: 1px;">
                            <div style="float:left;">
                                <h4>
                                    <a href="message.php" style="text-decoration:none">Inbox</a>
                                </h4>
                            </div>
                            <div style="float:right;">
                                <h4 class="snm" style="cursor:pointer;" >
                                    Send a New message
                                </h4>
                            </div>
                        </div>
                        
                        
                        <!--    changing background on hover    for message     -->
                        <style>
                            .message:hover{
                                background-color:silver;
                                }
                        
                        </style>
                        <div style=" position:absolute; top:19px; width:300px; height:232px; overflow-y:auto;border-top:1px solid black;padding-top:1px">
                            <script>
                                $(document).ready(function(){
                                   $(".message").click(function(){  
                                       var sender_id=$.trim($(this).attr('data'));
                                       window.location.href='message.php?sender_id='+sender_id;
                                       
                                   })             
                                });
                            
                            </script> 
                            <?php
                                include './include/connection.php';
								$result=mysqli_query($con,'select distinct(from_user_id) as from_user_id, user_name from messages,profiles where user_id=from_user_id and to_user_id='.$login_session.' and view_flag=1 order by date_time desc ');
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
									if(strlen($message_data['message_text'])>28){
										$message_data['message_text']=substr($message_data['message_text'],0,27).' ...';
									}
									
									
									
									
									echo '<div class="message" data="'.$message_data['from_user_id'].'" style="width:300px; height:55px; cursor:pointer;">
                                                <div style="float:left; width:48px; height:50px; margin-top:2px; 
                                                    background-image:url(./image.php?user_id='.$message_data['from_user_id'].');
                                                    background-size:45px 45px;
                                                    background-repeat:no-repeat;
                                                    display: block;
                                                    border-radius: 50px;
                                                    -webkit-border-radius:50px;
                                                    -moz-border-radius: 50px;
                                                    ">
                                                </div>
                                                
                                                <div style="float:right; width:243px; height:52px;
                                                    border-radius: 10px;
                                                    -webkit-border-radius: 10px;
                                                    -moz-border-radius: 10px;">
                   
                                                    <div style="float:left; width:170px; height:18px;">
                                                        <h4>'.$row['user_name'].'</h4>
                                                    </div>
                                                   
                                                   
													<div style="float:right; width:73px; height:18px;">
														<p>'.$show_date.'</p>
													</div>
                                                  
                                                   
													 <div style="width=243px; height:30px">
														<p>'.$message_data['message_text'].'</p>
													</div>
                                                </div>  
                                                
                                          </div>
                                          
                                          ';
                                echo '<hr/>';
                                    
                                }
                            ?>
                        </div>
						
					
					</div>
					<div class="notdol tooldrop" style="display:none;">
						<div style="z-index: 10; background-image: url(&quot;./images/beeper.png&quot;); height: 11px; top: -10px; width: 23px; position: relative; left: 180px;">
						</div>
					
					</div>
					<div class="notacc tooldrop" style="display:none;">
						<div style="z-index: 10; background-image: url(&quot;./images/beeper.png&quot;); height: 11px; top: -10px; width: 23px; position: relative; left: 111px;">
						</div>
						<div>
							<a href="view_profile.php"><div style="width:100%; padding-left:3px;  border-top:1px solid #333;">My Profile</div></a>
							<a href="logout.php"><div style="width:100%;padding-left:3px; border-bottom:1px solid #333; border-top:1px solid #333;">Logout</div></a>
						</div>
					</div>
				</div>
			</div>			
		</header>
		
		<header class="mobile">
			<div class="mobilepanel">
				
				<div class="menubutton" ></div>
				<div class="authbutton" style="background-image:url(./image.php?user_id=<?php echo $login_session; ?>); background-size:48px 47px; background-repeat:no-repeat; background-origin: 2px;" ></div>
				
				<div id="mainmenu" class="nav tooldrop" style="display:none;">
					<ul>
						<li><a href="index.php">Home</a></li>
						<li value="transactions">Transactions</li>
						<li value="miscellaneous">Miscellaneous</li>
					</ul>
				</div>
				
				<div id="authmenu" class="nav tooldrop" style="display:none;">
					<ul>
						<li value="notification">Notification</li>
						<li value="mmessage">Messages</li>
						<li value="earning">Earning</li>
						<li value="accounts">My Account</li>
						<li><a href="logout.php">Logout</a></li>
					</ul>
				</div>
				
				
				<div id="notification" class="nav tooldrop" style="display:none; background-color: black; font-family: none;">
					<div style="width:280px; height:240px; 
                                          background-color:whitesmoke; 
                                          margin-left:auto; 
                                          margin-right:auto;
										  margin-top:5px;
                                          margin-bottom:5px;
                                          ">
                            <div style="width:100%; 
                                        height:6%; 
                                        padding-top:1%;
                                        border-bottom:1px solid black;">
                                <h6>Notification</h6>
                            </div>    
                            <div style="width:99.9%; height:210px; overflow-y:auto;">
                               <?php
								 include './include/connection.php';
								 $query="select count(*) from supports where flag=1";
								 $result=mysqli_query($con,$query);
								 $count=mysqli_fetch_array($result);
								 if($count[0]>0)
								 {
								  echo'<a href="./support.php"><div id="support_notif">You have '.$count[0].' Unresolved Queries</div></a><br><hr> 
														</div>';
								 
								 }
								?>
							</div>
                    </div>
				</div>
				<div id="mmessage" class="nav tooldrop" style="display:none; background-color:black; font-family:none;">
					<div style="width:280px; height:240px; 
                                          background-color:whitesmoke; 
                                          margin-left:auto; 
                                          margin-right:auto;
										  margin-top:5px;
                                          margin-bottom:5px;
                                          ">
                            <div style="width:100%; 
                                        height:6%; 
                                        padding-top:1%;
                                        border-bottom:1px solid black;">
                                <a href="message.php" style="float:left; text-decoration:none; margin-left:1%;"><h6>Inbox</h6></a>
                                <div class="snm" style="float:right; text-decoration:none; margin-right:1%; cursor:pointer;"><h6>Send a message</h6></div>
                            </div>    
                            <div style="width:99.9%; height:210px; overflow-y:auto;">
                                <?php
                                        $result=mysqli_query($con,'select distinct(from_user_id) as from_user_id, user_name from messages,profiles where user_id=from_user_id and to_user_id='.$login_session.' and view_flag=1 order by date_time desc ');
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
											
											
											echo '<div class="message" data="'.$message_data['from_user_id'].'" style="width:99.9%; height:57px; cursor:pointer; border-bottom:1px solid black;">
														<div style="float:left; width:20%; height:50px; margin-top:2px; 
														   background-image:url(./image.php?user_id='.$message_data['from_user_id'].');
															background-size:45px 45px;
															background-repeat:no-repeat;
															display: block;
															border-radius: 50px;
															border-radius: 50px;
															-webkit-border-radius:50px;
															-moz-border-radius: 50px;
															">
														</div>
														<div style="float:left; width:55%; height:10%; padding-top:2px;">
															<h6>'.$row['user_name'].'</h6>
														</div>

														<div style="float:right; width:25%; height:10%;">
															<h6>'.$show_date.'</h6>
														</div>

														<div style="width:80%; height:55%; padding-top:6%;">
															<h6>'.$message_data['message_text'].'</h6>
														</div>
													</div>

											';

                                        }
								?>


                         </div>
                    </div>
				</div>
				<div id="earning" class="nav tooldrop" style="display:none;">
					<div>
					earning notification
					</div>
				</div>
				<div id="accounts" class="nav tooldrop" style="display:none;">
					<ul>
						<li><a href="view_profile.php">My Profile</a></li>
					</ul>
				</div>
				
				<div id="transactions" class="nav tooldrop" style="display:none;">
					<ul>
						<li><a href="withdrawal_requests.php">Withdrawal Requests</a></li>
						<li><a href="#">Rollback Requests</a></li>
					</ul>
				</div>
				<div id="miscellaneous" class="nav tooldrop" style="display:none;">
					<ul>
						<li><a href="master_update.php">Master Updations</a></li>
						<li><a href="#">Transactions History</a></li>
						<li><a href="#">Feedbacks</a></li>
					</ul>
				</div>
			</div>			
		</header>
		
		
		<div class="msgtrans_bg" style="display:none;"></div>
		<div id='msgpopup_main' style="display:none;" >
			<div class="img_close"></div>
			<div id='msgpopup_content'>
				<div class="auto_complete_container">
					<div class="tags-content">
						<span class="tags_container"></span>
						<span class="search_panel">
							<input class="search_input" type="text" placeholder="To" autocomplete="off" spellcheck="false" autocorrect="off">
							<div class="results"></div>
						</span>
					</div>	
				</div>
				<textarea id="message_text" placeholder="Message" style="resize:none; width:97.8%; height:150px; margin-top:5px; padding:5px;"></textarea>
				<input value="Send"  type="button" id="send_button">
			</div>
				
				
			</div>
			