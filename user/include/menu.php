<?php 
	include_once './include/lock_normal.php';
?>		

		<script>
			//-----------------------------------------------------tag serach start-----------------------------------------------------------------
			$(document).ready(function(){
				var total_row=0;
				var current_pos=0;
				var del_count=2;
				$('.search_input').bind('keyup input',function(event){
					var input=$.trim($(this).val());
					var keycode = event.which;
					
					if(keycode==37||keycode==39){
						return;
					}
					else if(keycode==40){
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
								alert("Message sent successfully.");
								$('#msgpopup_main').hide();
								$('.msgtrans_bg').hide();
							}
							
						});
					}	
					else{
						alert('Please enter a valid recipient and some message...');
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
			<div class="search"></div>
			<div class="cart"></div>
			<div class="name"><a href="./index.php" style="color:white;"><h2>Memory</h2><h2>Leak</h2></a></div>
			<div class="logo_image" ></div>
			<div class="search_image"></div>

			<div class="cart_image">
			  <span class="cart_count" style="height: 20px;width: 20px;border-radius: 20px;background-color:rgb(247, 207, 0);position: absolute;left: 5px;top: 5px;color: black;font-size: 15px;text-align:center;display:none;">
			  	<?php
			  		include './include/connection.php';
			  		$result=mysqli_query($con,"select count(*) as cart_ans from answer_carts where user_id=".$login_session);
			  		if($result){
			  			$row1=mysqli_fetch_assoc($result);
			  		}
			  		
			  		$result=mysqli_query($con,"select count(*) as cart_proj from project_carts where user_id=".$login_session);
			  		if($result){
			  			$row2=mysqli_fetch_assoc($result);
			  		}
			  		if($row2['cart_proj']==0 && $row1['cart_ans']!=0){
			  			echo $row1['cart_ans'];
			  			echo "<script>$('.cart_count').show();</script>";
			  		}
			  		else if($row1['cart_ans']==0 &&$row2['cart_proj']!=0){
			  			echo $row2['cart_proj'];
			  			echo "<script>$('.cart_count').show();</script>";
			  		}
			  		else if($row1['cart_ans']==0 && $row2['cart_proj']==0){

			  		}
			  		else{
			  			echo $row1['cart_ans']+$row2['cart_proj'];
			  			echo "<script>$('.cart_count').show();</script>";
			  		}
			  
			  	?>
			  </span>

			  <div class="cart_popup">
			  	<span style="position:absolute;top:-10px;left:80%;border-left:10px solid transparent;border-right:10px solid transparent;border-bottom:10px solid whitesmoke;z-index:10;"></span>
			  	<div><h5>Your cart</h5></div>
			  	<div style=" position:absolute; top:19px; width:95%; overflow-y:auto;padding-top: 1px;margin: 5px 1px 6px;border-top: 1px solid #e1e8ed;">
			  			<div style="border-bottom: 1px solid #e1e8ed;padding-top:10px;padding-bottom: 10px;text-align:left;">Answers <span style="float:right;padding-right:5px;"><?php echo $row1['cart_ans']; ?></span></div>
			  			<div style="padding-top:10px;padding-bottom: 10px;text-align:left;">Projects <span style="float:right;padding-right:5px;"><?php echo $row2['cart_proj'];?></span></div>
			  	</div>
			  </div>
			</div>
			<div class="panel">
				<div class="dnav" style="z-index:5;">
					<ul class="main_list" style="z-index:5;">	
						<li><a href="index.php" >Home</a></li>
						<li>
                            
                            <a class="drop_down" style="cursor:pointer;">Post</a>
							<ul class="tooldrop">
								<li>
                                    <span style="position:absolute; top:-10px; border-left:10px solid transparent; border-right:10px solid transparent; border-bottom:10px solid white; z-index:10;"></span>
                                    <a href="post_question.php">Post&nbsp;&nbsp;&nbsp; Question</a></li>
								<li><a href="project_upload.php">Post&nbsp;&nbsp;&nbsp;Project</a></li>
							</ul>
						</li>
						<li><a class="drop_down" style="cursor:pointer;">My Bucket</a>
							<ul class="tooldrop">
								<li><span style="position:absolute; top:-10px; border-left:10px solid transparent; border-right:10px solid transparent; border-bottom:10px solid white; z-index:10;"></span>
                                    <a href="purchase_bucket.php">Purchase</a></li>
								<li><a href="upload_bucket.php">Upload</a></li>
							</ul>
						</li>
						<li><a class="drop_down" style="cursor:pointer;">Withdraw</a>
							<ul class="tooldrop">
								<li>
                                    <span style="position:absolute; top:-10px; border-left:10px solid transparent; border-right:10px solid transparent; border-bottom:10px solid white; z-index:10;"></span><a href="transaction_history.php">History</a></li>
								<li><a href="request_payment.php">Request &nbsp;&nbsp;&nbsp; Payment</a></li>
							</ul>
						</li>
					</ul>				
				</div>
				<div class="tool">
					<div class="ntoolpanel">
						<ul>
							<li id="question"></li>
							<li id="message"></li>
							<li id="dollar"></li>
						</ul>
					</div>
					<div class="atoolpanel">
						<ul>
							<li id="grade"></li>
							<li id="account"><img  style="width:30px; height:30px;" src='image.php?user_id=<?php echo $login_session; ?>'/></li>
						</ul>
					</div>
				</div>	
				<div>
					<div class="notque tooldrop" style="display:none;">
						<div style="z-index: 5;  height: 11px; top: -20px; position: absolute; left: 92px;border-left:10px solid transparent;border-right:10px solid transparent;border-bottom:10px solid whitesmoke;">
						</div>
						<div style="width:300px; height:18px; position: absolute; top: 1px;">
                            <h5>Notification</h5>
                        </div>
						<div style=" position:absolute; top:19px; width:300px; height:232px; overflow-y:auto;  overflow-x:hidden;  padding-top: 1px;margin: 5px 1px 6px;border-top: 1px solid #e1e8ed;">
							<?php
								 include './include/connection.php';
								
								 $user_id=$login_session;
								  if($user_id!="")
								  {	
									$count=0;
									$query="select distinct question_id ,user_id,answer_id from answers where notify=1 and question_id=any(select question_id from questions where user_id =".$user_id.")" ;
									$result= mysqli_query($con, $query);
									while($row=mysqli_fetch_array($result))
									{
									  $count++;  
									  $query2="select user_name from profiles where user_id=".$row[1]."";
									  $result2=mysqli_query($con,$query2);
									  $row2=mysqli_fetch_array($result2); 
									  
									  echo '<div class="q" style="width:300px; height:55px; cursor:pointer;padding-top: 1px;margin: 5px 1px 6px; border-bottom: 1px solid #e1e8ed;">
														<div style="float:left; width:45px; height:45px; margin-top:2px; 
															background-image:url(./image.php?user_id='.$row[1].');
															background-size:45px 45px;
                                                            border-radius:45px;
															background-repeat:no-repeat;
															display: block;
															font-size:12px;
													
															">
														</div> 
														
														<a href="view_question.php?question_id='.$row[0].'&notify=1&answer_id='.$row[2].'"><div id="question_notify" style="margin-top:5px; margin-left:50px;">'.$row2[0].'  Answered on Your Question.... Click here for details</div></a>
														</div>';   

									}
									
									 $query1="select ticket_id from supports where user_id=".$user_id." and flag=2";
									$result1= mysqli_query($con, $query1);
									while($row1=mysqli_fetch_array($result1)){
										$count++;
									  echo' <a href=query_resolved.php?ticket_id='.$row1[0].'><div id="question_notify">Admin resolved your query.. Click here for details</div></a><br> 
										   ';   
									}
								   if($count!=0)
									{
									   echo "<style>
											 #question
											 {
											  background-image:url('./images/question.png');
											 }
											</style>";
									}
									else
									{
									   echo "<style>
											 #question
											 {
											  background-image:url('./images/ques.png');
											 }
											</style>";	
									}
								  }

								?>
						
						</div>
					</div>
					<div class="notmes tooldrop" style="display:none;">
						<div style="z-index: 5;  height: 11px; top: -20px; position: absolute; left: 138px;border-left:10px solid transparent;border-right:10px solid transparent;border-bottom:10px solid whitesmoke;">
						</div>
						
                        <div style="width:300px; height:18px; position: absolute; top: 1px; margin-bottom:2px;">
                            <div style="float:left;">
                                <h5>
                                    <a href="message.php" style="text-decoration:none;color:#3bb898;">Inbox</a>
                                </h5>
                            </div>
                            <div style="float:right;">
                                <h5 class="snm" style="cursor:pointer;color:#3bb898;" >
                                    Send a New message
                                </h5>
                            </div>

                        </div>
                        
                        
                        <!--    changing background on hover    for message     -->
                        <style>
                            .message:hover{
                                background-color:silver;
                                }
                        
                        </style>
                        <div style=" position:absolute; top:19px; width:300px; height:232px; overflow-y:auto;  overflow-x:hidden; padding-top: 1px;margin: 5px 1px 6px;border-top: 1px solid #e1e8ed;">
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
									
									echo "<style>
															#message{
																background-image: url('./images/message.png');
																
															 }
											 </style>";
														
									
									echo '<div class="message" data="'.$message_data['from_user_id'].'" style="width:300px; height:55px; cursor:pointer;padding-top: 1px;margin: 5px 1px 6px;border-bottom: 1px solid #e1e8ed;">
                                                <div style="float:left; width:48px; height:50px; margin-top:2px; 
                                                    background-image:url(./image.php?user_id='.$message_data['from_user_id'].');
                                                    background-size:45px 45px;
                                                    background-repeat:no-repeat;
                                                    display: block;
                                                    font-size:12px;
                                                    ">
                                                </div>
                                                
                                                <div style="float:right; width:243px; height:52px;
                                                    border-radius: 10px;
                                                    -webkit-border-radius: 10px;
                                                    -moz-border-radius: 10px;
                                                  ">
                   
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
                                    
                                }
                            ?>
                        </div>
						
					
					</div>
					<div class="notdol tooldrop" style="display:none;">
						<div style="z-index: 10;  height: 11px; top: -20px; position: absolute; left: 180px;border-left:10px solid transparent;border-right:10px solid transparent;border-bottom:10px solid whitesmoke;">
						</div>
						<div style="width:300px; height:18px; position: absolute; top: 1px;">
                            <h5>Earning Notification</h5>
                        </div>
						<div style=" position:absolute; top:19px; width:300px; height:232px; overflow-y:auto;  overflow-x:hidden; padding-top: 1px;margin: 5px 1px 6px;border-top: 1px solid #e1e8ed;">
						   <?php

							 include './include/connection.php';
							
							 $user_id=$login_session;
							  if($user_id!="")
							  {	
								$count=0;
								$query="select answer_id,transaction_id from answer_accounts where buy_from=".$user_id." and notify=1";
								$result=  mysqli_query($con, $query);
								while($row=mysqli_fetch_array($result))
								{
                                   $transaction_id=$row['transaction_id'];
								   $query2="Select question_id from answers where answer_id=".$row[0]."";
								   $result2= mysqli_query($con, $query2);
								   $row2= mysqli_fetch_array($result2);

								   $query3="Select user_id from questions where question_id=".$row2[0]."";
								   $result3=mysqli_query($con,$query3);
								   $row3=mysqli_fetch_array($result3); 
								  
								   $query4="select user_name from profiles where user_id=".$row3[0]."";
								   $result4=mysqli_query($con,$query4);
								   $row4=mysqli_fetch_array($result4); 
								  
								   echo"";
								   echo '<div class="q" style="width:300px; height:55px; cursor:pointer;padding-top: 1px;margin: 5px 1px 6px;border-bottom: 1px solid #e1e8ed;">
													<div style="float:left; width:45px; height:45px; margin-top:2px; 
														background-image:url(./image.php?user_id='.$row3[0].');
														background-size:45px 45px;
                                                        border-radius:45px;
														background-repeat:no-repeat;
														display: block;
														font-size:12px;
														
														">
													</div> 
													
													<a href="view_question.php?question_id='.$row2[0].'&answer_id='.$row[0].'&notify=1&transaction_id='.$transaction_id.'"><div id="dollar_notify" style="margin-left:50px; margin-top:5px;"><i><b>'.$row4[0].' </b></i>Bought Your Answer... Click here for details</div></a><br>
													</div>';   
								  
							   
								   $count++;
								}

								$query2="select project_id,transaction_id from project_accounts where buy_from=".$user_id." and notify=1";
								$result2=  mysqli_query($con, $query2);
								while($row2=mysqli_fetch_array($result2))
								{
                                    $transaction_id=$row2['transaction_id'];
								   $count++;
								   $query3="Select user_id from projects where project_id=".$row2[0]."";
								   $result3=mysqli_query($con,$query3);
								   $row3=mysqli_fetch_array($result3); 
								  
								   $query4="select user_name from profiles where user_id=".$row3[0]."";
								   $result4=mysqli_query($con,$query4);
								   $row4=mysqli_fetch_array($result4); 
						   
								   echo"";
								   echo '<div class="q" style="width:300px; height:55px; cursor:pointer;padding-top: 1px;margin: 5px 1px 6px;border-bottom: 1px solid #e1e8ed;">
													<div style="float:left; width:48px; height:50px; margin-top:2px; 
														background-image:url(./image.php?user_id='.$row3[0].');
														background-size:45px 45px;
														background-repeat:no-repeat;
														display: block;
														font-size:12px;
													
														">
													</div> 
													
													<a href="view_project.php?project_id='.$row2[0].'&notify=1"&transaction_id='.$transaction_id.'><div id="dollar_notify"><b><i>'.$row4[0].' </i></b>Bought Your Project... Click here for details</div></a><br>
													</div>';   
								  
								}
								if($count!=0)
								 {
								  echo"<style>
								   #dollar
									{
									  background-image:url('./images/dollar2.png');
									}
								   </style>";
								 }
								 else
								 {
									echo"<style>
								   #dollar
									{
									  background-image:url('./images/doller.png');
									}
								   </style>";
								 }
				

							  }  
							?>
					   </div>
					   
					</div>
					<div class="notgra tooldrop" style="display:none;">
						<div style="z-index: 10;  height: 11px; top: -20px;  position:absolute; left:222px;border-left:10px solid transparent;border-right:10px solid transparent;border-bottom:10px solid whitesmoke;">
						</div>
						<div style="width:300px; height:18px; position: absolute; top: 1px;">
                            <div style="float:left;">
                                <h5>
                                    Rating Notification
                                </h5>
                            </div>
                            <div style="float:right;">
                                <h5>
                                    <a href="grade.php" style="text-decoration:none;color:#3bb898;">View All</a>
                                </h5>
                            </div>
                        </div>
						<div style=" position:absolute; top:19px; width:300px; height:232px; overflow-y:auto;  overflow-x:hidden; padding-top: 1px;margin: 5px 1px 6px;border-top: 1px solid #e1e8ed;">
							<?php

	                     include './include/connection.php';
	                     $query= "select profiles.avg_rating as grade from profiles where user_id=$login_session";
                         $result=mysqli_query($con,$query);
                         $row=mysqli_fetch_array($result);
                         if(!isset($row['grade'])){
                             
                             echo"<style>
                                
                                        
                                        #grade{
                                            background:url('./images/grade.png');
                                         }
                                    </style>
                            ";
                         }
                         else{
                                 
                                 
                                 if($row['grade']==5){
                                    echo"<style>
                                            #grade{
                                                background:url('./images/a+.png');
                                             }
                                        </style>
                                    ";
                                 }
                                 else if($row['grade']>=4&& $row['grade']<5){
                                    echo"<style>
                                            #grade{
                                                background:url('./images/a.png');
                                             }
                                        </style>
                                    ";

                                 }
                                 else if($row['grade']>=3&& $row['grade']<4){
                                    echo"<style>
                                            #grade{
                                                background:url('./images/b.png');
                                             }
                                        </style>
                                    ";

                                 }
                                 else if($row['grade']>=2&& $row['grade']<3){
                                    echo"<style>
                                            #grade{
                                                background:url('./images/c.png');
                                             }
                                        </style>
                                    ";

                                 }
                                 else if($row['grade']>=1&& $row['grade']<2){
                                    echo"<style>
                                            #grade{
                                                background:url('./images/d.png');
                                             }
                                        </style>
                                    ";
                                 }
                                 else if($row['grade']>=0&& $row['grade']<1){
                                    echo"<style>
                                            #grade{
                                                background:url('./images/f.png');
                                             }
                                        </style>
                                    ";
                                 }
                                 
                         }
                         echo "<style>
                                    #grade{
                                        background-size:30px 30px;
                                        background-repeat:no-repeat;
                                        padding-left: 5px;
                                        margin-top: 10px;
                                     }
                                 </style>";  
						 
						echo "<div>";
							$result=mysqli_query($con,"select user_name,rating as grade,title,profiles.user_id,project_accounts.project_id,project_accounts.transaction_id  from project_accounts,profiles,transactions,projects where buy_from=$login_session and notify=1 and transactions.transaction_id=project_accounts.transaction_id and transactions.user_id=profiles.user_id and project_accounts.project_id=projects.project_id");
							while($row=mysqli_fetch_array($result)){
								$grade=0;
								if($row['grade']==5){
									$grade="A+";
								}
								else if($row['grade']>=4&& $row['grade']<5){
									$grade="A";
								}
								else if($row['grade']>=3&& $row['grade']<4){
									$grade="B";
								}
								else if($row['grade']>=2&& $row['grade']<3){
									$grade="C";
								}
								else if($row['grade']>=1&& $row['grade']<2){
									$grade="D";
								}
								else if($row['grade']>=0&& $row['grade']<1){
									$grade="F";
								}
								echo '<div class="q" style="width:300px; height:55px; cursor:pointer;padding-top: 1px;margin: 5px 1px 6px;border-bottom: 1px solid #e1e8ed;">
								  			<div style="float:left; width:45px; height:45px; margin-top:2px; 
								  				background-image:url(./image.php?user_id='.$row['user_id'].');
								  				background-size:45px 45px;
                                                border-radius:45px;
								  				background-repeat:no-repeat;
								  				display: block;
								  				font-size:12px;

								  				">
								  			</div> 
								  			
								  			<a href="view_project.php?project_id='.$row['project_id'].'&notify=1&transaction_id='.$row['transaction_id'].'"><div id="grade_notify" style="margin-top:5px; margin-left:50px;"><b>'.$row['user_name'].' </b>Rated <b>'.$grade.'</b> On <br> '.$row['title'].'</div></a><br>
								  			</div><hr>';
											
							}
							$result=mysqli_query($con,"select user_name,rating as grade,abstract,profiles.user_id,answer_accounts.answer_id,answer_accounts.transaction_id  from answer_accounts,profiles,transactions,answers where buy_from=$login_session and answer_accounts.notify=1 and transactions.transaction_id=answer_accounts.transaction_id and transactions.user_id=profiles.user_id and answer_accounts.answer_id=answers.answer_id");
							while($row=mysqli_fetch_array($result)){
								$grade=0;
                                if($row['grade']==''){
                                    $grade="Newbie";
                                }
								else if($row['grade']==5){
									$grade="A+";
								}
								else if($row['grade']>=4&& $row['grade']<5){
									$grade="A";
								}
								else if($row['grade']>=3&& $row['grade']<4){
									$grade="B";
								}
								else if($row['grade']>=2&& $row['grade']<3){
									$grade="C";
								}
								else if($row['grade']>=1&& $row['grade']<2){
									$grade="D";
								}
								else if($row['grade']>=0&& $row['grade']<1){
									$grade="F";
								}
						 
								echo '<div class="q" style="width:300px; height:55px; cursor:pointer;padding-top: 1px;margin: 5px 1px 6px;border-bottom: 1px solid #e1e8ed;">
								  			<div style="float:left; width:45px; height:45px; margin-top:2px; 
								  				background-image:url(./image.php?user_id='.$row['user_id'].');
								  				background-size:45px 45px;
                                                border-radius:45px;
								  				background-repeat:no-repeat;
								  				display: block;
								  				font-size:12px;
								  				">
								  			</div> 
								  			
								  			<a href="view_answer.php?aid='.$row['answer_id'].'&notify=1&transaction_id='.$row['transaction_id'].'"><div id="grade_notify" style="margin-top:5px; margin-left:50px;"><b>'.$row['user_name'].' </b>Rated <b>'.$grade.'</b> On <br> '.$row['abstract'].'</div></a><br>
								  			</div>';
							}
                       
                        echo "</div>";

                         ?>
						</div>						
					</div>
					<div class="notacc tooldrop" style="display:none;">
						<div style="z-index: 10;  height: 11px; top: -20px; position: absolute; left: 111px;border-left:10px solid transparent;border-right:10px solid transparent;border-bottom:10px solid white;">
						</div>
						<div style="margin-top:15px;">
							<a href="cart.php"><div style="width:98%; padding-left:3px;margin-bottom:5px;">My Cart</div></a>
							<div class="divider" style="padding-top: 1px;margin: 5px 1px 6px;border-bottom: 1px solid #e1e8ed;"></div>
							<a href="view_profile.php"><div style="width:98%; padding-left:3px;margin-bottom:5px;">My Profile</div></a>
							<div class="divider" style="padding-top: 1px;margin: 5px 1px 6px;border-bottom: 1px solid #e1e8ed;"></div>
							<a href="password_change.php"><div style="width:98%; padding-left:3px;margin-bottom:5px;">Password Change</div></a>
							<div class="divider" style="padding-top: 1px;margin: 5px 1px 6px;border-bottom: 1px solid #e1e8ed;"></div>
							<a href="logout.php"><div style="width:98%;padding-left:3px;margin-bottom:5px; ">Logout</div></a>
						</div>
					</div>
				</div>
			</div>	

			<div class='searchpanel' style="display:none;" >
				<div class="skewdiv"></div>
				<div style="margin:1%;">
					<div style="float:left;padding:5px;">
							<input type='radio'  name='category' value='question' checked />Question Title
							<input type='radio' name='category' value='project' />Project Title
						</div>
						<div class='search_box_div'><input id='search_box' type='text' name='search' autocomplete='off' placeholder='Enter title for question and project'  data-speech-enabled="" data-search-engine="oracle" x-webkit-speech="x-webkit-speech"/>
						<img id="searchbuttonimg" src="./images/searchbuttonimg.png">
						</div>
				</div>	
			</div>
		</header>
		
		<header class="mobile">
			<div class="mobilepanel">
				
				<div class="menubutton" ></div>
				<div class="searchbutton"></div>
				<div class="cartbutton">
					<span class="mcart_count" style="height: 15px;width: 15px;border-radius: 15px;background-color:rgb(247, 207, 0);position: absolute;left: 5px;top: 5px;color: black;font-size: 10px;text-align:center;display:none;">
				  	<?php
				  		include './include/connection.php';
				  		$result=mysqli_query($con,"select count(*) as cart_ans from answer_carts where user_id=".$login_session);
				  		if($result){
				  			$row1=mysqli_fetch_assoc($result);
				  		}
				  		
				  		$result=mysqli_query($con,"select count(*) as cart_proj from project_carts where user_id=".$login_session);
				  		if($result){
				  			$row2=mysqli_fetch_assoc($result);
				  		}
				  		if($row2['cart_proj']==0 && $row1['cart_ans']!=0){
				  			echo $row1['cart_ans'];
				  			echo "<script>$('.mcart_count').show();</script>";
				  		}
				  		else if($row1['cart_ans']==0 &&$row2['cart_proj']!=0){
				  			echo $row2['cart_proj'];
				  			echo "<script>$('.mcart_count').show();</script>";
				  		}
				  		else if($row1['cart_ans']==0 && $row2['cart_proj']==0){

				  		}
				  		else{
				  			echo $row1['cart_ans']+$row2['cart_proj'];
				  			echo "<script>$('.mcart_count').show();</script>";
				  		}
				  
				  	?>
				  </span>
				</div>

				<div class="authbutton"><img  style="width:40px; height:40px;" src='image.php?user_id=<?php echo $login_session; ?>'/></div>
				
				<div id="mainmenu" class="nav tooldrop" style="display:none;">
					<ul>
						<li><a href="index.php">Home</a></li>
						<li class="divider" style="padding-top: 1px;border-bottom: 1px solid #e1e8ed;"></li>
						<li value="Post">Post</li>
						<li class="divider" style="padding-top: 1px;border-bottom: 1px solid #e1e8ed;"></li>
						<li value="MyBucket">My Bucket</li>
						<li class="divider" style="padding-top: 1px;border-bottom: 1px solid #e1e8ed;"></li>
						<li value="Withdraw">Withdraw</li>
					</ul>
				</div>
				<div id="msearchdiv" class="nav tooldrop" style="display:none;">
						<div style="float:left;padding:5px; font-size:12px;">
							<input name='category' type='radio'  value='question' checked/>Question<br/>
							<input name='category' type='radio' value='project' />Project
						</div>
						<div class='msearch_panel'><input id='msearch_box' type='text' name='search' autocomplete='off' placeholder='Enter title for Ques. or Project'  data-speech-enabled="" data-search-engine="oracle" x-webkit-speech="x-webkit-speech"/>
						<img id="msearchbuttonimg" src="./images/searchbuttonimg.png">
						</div>
	
				</div>

				<div id="mcart_div" class="nav tooldrop" style="display:none;
					color: black;
					font-size: 15px;
					height: 60px;
					width: 100%;
					padding: 3px;
					position: absolute;
					text-align: center;
					right: 10%;	
					background-color: white;
					">
				  	<div style=" position:absolute; width:95%; overflow-y:auto;margin: 5px 1px 6px;">
				  			<div style="border-bottom: 1px solid #e1e8ed;text-align:left;">Answers <span style="float:right;padding-right:5px;"><?php echo $row1['cart_ans']; ?></span></div>
				  			<div style="text-align:left;">Projects <span style="float:right;padding-right:5px;"><?php echo $row2['cart_proj'];?></span></div>
				  	</div>
				</div>

				<div id="authmenu" class="nav tooldrop" style="display:none;">
					<ul>
						<li value="notification">Notification</li>
						<li class="divider" style="padding-top: 1px;border-bottom: 1px solid #e1e8ed;"></li>
						<li value="mmessage">Messages</li>
						<li class="divider" style="padding-top: 1px;;border-bottom: 1px solid #e1e8ed;"></li>
						<li value="earning">Earning</li>
						<li class="divider" style="padding-top: 1px;border-bottom: 1px solid #e1e8ed;"></li>
						<li value="accounts">My Account</li>
						<li class="divider" style="padding-top: 1px;border-bottom: 1px solid #e1e8ed;"></li>
						<li><a href="password_change.php">Password Change</a></li>
						<li class="divider" style="padding-top: 1px;border-bottom: 1px solid #e1e8ed;"></li>
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
                            <div style="width:99.9%; height:210px; overflow-y:auto; overflow-x:hidden;">
                               <?php

                         include './include/connection.php';
						
						 $user_id=$login_session;
						  if($user_id!="")
						  {	
						  	$query="select distinct question_id ,user_id from answers where notify =1 and question_id=any(select question_id from questions where user_id =".$user_id.")" ;
                            $result= mysqli_query($con, $query);
                            while($row=mysqli_fetch_array($result))
                            {
                              $query2="select user_name from profiles where user_id=".$row[1]."";
                              $result2=mysqli_query($con,$query2);
                              $row2=mysqli_fetch_array($result2); 
                              echo '<br>';
                              echo '<div class="q" style="width:260px; height:50px; cursor:pointer;">
                                                <div style="float:left; width:48px; height:50px; 
                                                    background-image:url(./image.php?user_id='.$row[1].');
                                                    background-size:45px 45px;
                                                    background-repeat:no-repeat;
                                                    display: block;
                                                    border-radius: 50px;
                                                    -webkit-border-radius:50px;
                                                    -moz-border-radius: 50px;
                                                    ">
                                                </div> 
                                                
                                                <a href="view_question.php?question_id='.$row[0].'&notify=1"><div id="question_notify">'.$row2[0].'  Answered on Your Question.... Click here for details</div></a><br><hr><br> 
                                                </div>';   

						    }
							$query1="select ticket_id from supports where user_id=".$user_id." and flag=2";
                            $result1= mysqli_query($con, $query1);
                            while($row1=mysqli_fetch_array($result1))
                            {
                            	$count++;
                                echo' <a href=query_resolved.php?ticket_id='.$row1[0].'><div id="question_notify">Admin resolved your query.. Click here for details</div></a><br><hr> 
                                   ';   
                            }
							
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
                            <div style="width:99.9%; height:210px; overflow-y:auto;  overflow-x:hidden;">
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
				<div id="earning" class="nav tooldrop" style="display:none; background-color: black; font-family: none;">
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
                                <h6>Earning Notification</h6>
                            </div>    
                            <div style="width:99.9%; height:210px; overflow-y:auto;  overflow-x:hidden;">
                                <?php

										 include './include/connection.php';
									
										 $user_id=$login_session;
										  if($user_id!="")
										  {	
											$query="select answer_id from answer_accounts where buy_from=".$user_id." and notify=1";
											$result=  mysqli_query($con, $query);
											while($row=mysqli_fetch_array($result))
											{
											   $query2="Select question_id from answers where answer_id=".$row[0]."";
											   $result2= mysqli_query($con, $query2);
											   $row2= mysqli_fetch_array($result2);

											   $query3="Select user_id from questions where question_id=".$row2[0]."";
											   $result3=mysqli_query($con,$query3);
											   $row3=mysqli_fetch_array($result3); 
											  
											   $query4="select user_name from profiles where user_id=".$row3[0]."";
											   $result4=mysqli_query($con,$query4);
											   $row4=mysqli_fetch_array($result4); 
											  
											   echo"<br>";
											   echo '<div class="q" style="width:300px; height:55px; cursor:pointer;">
																<div style="float:left; width:45px; height:45px; margin-top:2px; 
																	background-image:url(./image.php?user_id='.$row3[0].');
																	background-size:45px 45px;
																	background-repeat:no-repeat;
																	display: block;
                                                                    
																	border-radius: 45px;
																	-webkit-border-radius:50px;
																	-moz-border-radius: 50px;
																	">
																</div> 
																
																<a href="view_question.php?question_id='.$row2[0].'&notify=1&answer_id='.$row[0].'"><div id="dollar_notify" style="margin-top:5px; margin-left:50px;" ><i><b>'.$row4[0].' </b></i>Bought Your Answer... Click here for details</div></a><br><hr> 
																</div>';   
											}

											$query2="select project_id from project_accounts where buy_from=".$user_id." and notify=1";
											$result2=  mysqli_query($con, $query2);
											while($row2=mysqli_fetch_array($result2))
											{
											   $count++;
											   $query3="Select user_id from projects where project_id=".$row2[0]."";
											   $result3=mysqli_query($con,$query3);
											   $row3=mysqli_fetch_array($result3); 
											  
											   $query4="select user_name from profiles where user_id=".$row3[0]."";
											   $result4=mysqli_query($con,$query4);
											   $row4=mysqli_fetch_array($result4); 
									   
											   echo"<br>";
											   echo '<div class="q" style="width:300px; height:55px; cursor:pointer;">
																<div style="float:left; width:45px; height:45px; margin-top:2px; 
																	background-image:url(./image.php?user_id='.$row3[0].');
																	background-size:45px 45px;
																	background-repeat:no-repeat;
																	display: block;
																	border-radius: 45px;
																	-webkit-border-radius:50px;
																	-moz-border-radius: 50px;
																	">
																</div> 
																
																<a href="project.php?project_id='.$row2[0].'&notify=1"><div id="dollar_notify" style="margin-top:5px; margin-left:50px;"><b><i>'.$row4[0].'  </i></b>Bought Your Project... Click here for details</div></a><br><hr> 
																</div>';   
											  
											}
									}
									?>
							</div>
                    </div>
				</div>
				<div id="accounts" class="nav tooldrop" style="display:none;">
					<ul>
						<li><a href="view_profile.php">My Profile</a></li>
						<li><a href="cart.php">My Cart</a></li>
					</ul>
				</div>
				
				<div id="Post" class="nav tooldrop" style="display:none;">
					<ul>
						<li><a href="post_question.php">Post Question</a></li>
						<li><a href="project_upload.php">Post Project</a></li>
					</ul>
				</div>
				<div id="MyBucket" class="nav tooldrop" style="display:none;">
					<ul>
						<li><a href="purchase_bucket.php">Purchase</a></li>
						<li><a href="upload_bucket.php">Upload</a></li>
					</ul>
				</div>
				<div id="Withdraw" class="nav tooldrop" style="display:none;">
					<ul>
						<li><a href="transaction_history.php">History</a></li>
						<li><a href="request_payment.php">Request Payment</a></li>
					</ul>n
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
							<input class="search_input" type="text" placeholder="To:( Enter username )" autocomplete="off" spellcheck="false" autocorrect="off">
							<div class="results"></div>
						</span>
					</div>	
				</div>
				<textarea id="message_text" placeholder="Type your message" style="resize:none; width:97.8%; height:150px; margin-top:5px; padding:5px;"></textarea>
				<input value="Send"  type="button" id="send_button">
			</div>
				
				
			</div>
			