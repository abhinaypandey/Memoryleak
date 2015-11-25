<?php 
	include_once './include/lock_normal.php';
	
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Memoryleak</title>
		<link rel="shortcut icon" href="./images/logo.png">
		<?php
			include_once './include/head.php';
		?>
		<style>
			marquee{
				height:100%;
			}
			.questdiv{
				background-color: white;
				width: 100%;
				min-height: 63px;
				margin: 2px;
			}
			.questdiv{
				 transition: all 0.5s ease;
	            -moz-transition: all 0.5s ease;
	            -webkit-transition: all 0.5s ease;
	            -o-transition: all 0.5s ease;
	            -ms-transition: all 0.5s ease;
			}
			.questdiv:hover{
				background-color: #3bb998;
				box-shadow: inset 0 1px 3px #3bb998;
                -moz-box-shadow: inset 0 1px 3px #3bb998;
                -webkit-box-shadow: inset 0 1px 3px #3bb998;

			}
			.questdiv img {
				float: left;
				border: 2px solid whitesmoke outset;
				box-shadow: #000 0 0px 10px -1px;
				margin: 5px;
				width: 50px;
				height: 50px;
				border-radius:50px;
			}
			.quest {
				width: 68%;
				min-height: 55px;
				float: left;
				padding-top:3px;
			}
			.quest a{
				color:green;
			}

			.line{
				margin: auto auto;
				margin-bottom: 1px;
				width:70%;
				height:1px;
				background-color: #9ecaed;
				box-shadow:5px 5px 5px #9ecaed;
			}
			tbody tr td{
				padding-left:1%;
			}
			thead tr th{
				padding-left:1%;
			}
			tbody tr{
				cursor:pointer;
			}
            .nav-button,{
                border: medium none;
                border-radius:5px;
                font-family: "HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;
                background:none;
                color:#fff;
                margin-top:12px;
            }
            .nav-button:hover {
                box-shadow: inset 0 1px 3px rgba(0,0,0,0.5);
                -moz-box-shadow: inset 0 1px 3px rgba(0,0,0,0.5);
                -webkit-box-shadow: inset 0 1px 3px rgba(0,0,0,0.5);
                cursor:pointer;
                color:#000000;	
            }
            .nav-button:focus {
                position: relative;
                bottom: -1px;
                box-shadow: inset 0 1px 6px rgba(256,256,256,0.75);
                -moz-box-shadow: inset 0 1px 6px rgba(256,256,256,0.75);
                -webkit-box-shadow: inset 0 1px 6px rgba(256,256,256,0.75);
            }
            .nav-button,tr{
                 transition: all 0.5s ease;
                -moz-transition: all 0.5s ease;
                -webkit-transition: all 0.5s ease;
                -o-transition: all 0.5s ease;
                -ms-transition: all 0.5s ease;
            }

            .trans_bg{
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
		</style>
		<script>
			function gotopage(id){
				window.location.href="view_question.php?question_id="+id;
			}
			$(document).ready(function(){
				$('.nav-button').click(function(){
					var data=$.trim($(this).val());
					if(data=='<')
						count--;
					else if(data=='>')
						count++;					
					if(count==0||total==0){
						count=1;
					}
					else if(count==parseInt(total/8)+1){
						count=parseInt(total/8);
					}
					else{
						loaddata(count*8-8);
						$('.pagecount').text(parseInt(count));
					}
				});
			});
			function loaddata(count){
				
				$.ajax({
					type:'POST',
					url:'query.php',
					data:{ 
					type:31,
					count:count
					}
				}).done(function(data){
					$('#tbody').html('');
					$('#mtbody').html('');
					var obj = jQuery.parseJSON(data);
					
					$.each(obj,function(i){
						
						var title=obj[i]['title'];
						if((obj[i]['title']).length>40){
							obj[i]['title']=obj[i]['title'].substring(0,40)+'...';
						}
						var category=obj[i]['category'];
						if((obj[i]['category']).length>10){
							obj[i]['category']=obj[i]['category'].substring(0,10)+'...';
						}
						if(i%2==0){
							$("<tr onclick=\"gotopage("+obj[i]['question_id']+");\" style='  height: 25px; border-bottom:1px solid #e1e8ed; '><td>$"+obj[i]['bounty']+"</td><td title='"+category+"'>"+obj[i]['category']+"</td><td title='"+title+"'>"+obj[i]['title']+"</td><td>"+obj[i]['status']+"</td><td>"+obj[i]['due_date_time']+"</td></tr>").appendTo('#tbody');
							$("<tr onclick=\"gotopage("+obj[i]['question_id']+");\" style='  height: 25px;border-bottom:1px solid #e1e8ed;'><td>$"+obj[i]['bounty']+"</td><td> Category:"+obj[i]['category']+"<br>Title: "+obj[i]['title']+"<br>Status: "+obj[i]['status']+"<br>DOS: "+obj[i]['due_date_time']+"</td></tr>").appendTo('#mtbody');
						}
						else{
							$("<tr onclick=\"gotopage("+obj[i]['question_id']+");\" style='  height: 25px; border-bottom:1px solid #e1e8ed;'><td>$"+obj[i]['bounty']+"</td><td title='"+category+"'>"+obj[i]['category']+"</td><td title='"+title+"'>"+obj[i]['title']+"</td></td><td>"+obj[i]['status']+"</td><td>"+obj[i]['due_date_time']+"</td></tr>").appendTo('#tbody');
							$("<tr onclick=\"gotopage("+obj[i]['question_id']+");\" style='  height: 25px;border-bottom:1px solid #e1e8ed; '><td>$"+obj[i]['bounty']+"</td><td> Category:"+obj[i]['category']+"<br>Title: "+obj[i]['title']+"<br>Status: "+obj[i]['status']+"<br>DOS: "+obj[i]['due_date_time']+"</td></tr>").appendTo('#mtbody');
						}
							
					});
					
	
				});				
			}
		</script>
		<script>
			$(document).ready(function(){
				$('.rnav-button').click(function(){
					var data=$.trim($(this).val());
					if(data=='<')
						rcount--;
					else if(data=='>')
						rcount++;					
					if(rcount==0||rtotal==0){
						count=1;
					}
					else if(rcount==parseInt(rtotal/10)+1){
						rcount=parseInt(rtotal/10);
					}
					else{
						rloaddata(rcount*10-10)
						$('.rpagecount').text(parseInt(rcount));
					}
				});
			});
			function rloaddata(count){
				if(!(typeof filter_data==="undefined"))
					var filter=filter_data;
				$.ajax({
					type:'POST',
					url:'query.php',
					data:{ 
					type:32,
					count:count,
					filter:filter
					}
				}).done(function(data){
					$('#rtbody').html('');
					$('#rmtbody').html('');
					var obj = jQuery.parseJSON(data);
					$.each(obj,function(i){
						var title=obj[i]['title'];
						if((obj[i]['title']).length>40){
							obj[i]['title']=obj[i]['title'].substring(0,40)+'...';
						}
						var category=obj[i]['category'];
						if((obj[i]['category']).length>10){
							obj[i]['category']=obj[i]['category'].substring(0,10)+'...';
						}
						if(i%2==0){
							$("<tr onclick=\"gotopage("+obj[i]['question_id']+");\" style='  height: 25px; border-bottom:1px solid #e1e8ed;'><td>$"+obj[i]['bounty']+"</td><td title=\""+category+"\">"+obj[i]['category']+"</td><td title=\""+title+"\">"+obj[i]['title']+"</td><td>"+obj[i]['status']+"</td><td>"+obj[i]['due_date_time']+"</td></tr>").appendTo('#rtbody');
							$("<tr onclick=\"gotopage("+obj[i]['question_id']+");\" style='  height: 25px;  border-bottom:1px solid #e1e8ed;'><td>$"+obj[i]['bounty']+"</td><td> Category:"+obj[i]['category']+"<br>Title: "+obj[i]['title']+"<br>Status: "+obj[i]['status']+"<br>DOS: "+obj[i]['due_date_time']+"</td></tr>").appendTo('#rmtbody');
						}
						else{
							$("<tr onclick=\"gotopage("+obj[i]['question_id']+");\" style='  height: 25px; border-bottom:1px solid #e1e8ed;'><td>$"+obj[i]['bounty']+"</td><td title=\""+category+"\">"+obj[i]['category']+"</td><td title=\""+title+"\">"+obj[i]['title']+"</td></td><td>"+obj[i]['status']+"</td><td>"+obj[i]['due_date_time']+"</td></tr>").appendTo('#rtbody');
							$("<tr onclick=\"gotopage("+obj[i]['question_id']+");\" style='  height: 25px; border-bottom:1px solid #e1e8ed; '><td>$"+obj[i]['bounty']+"</td><td> Category:"+obj[i]['category']+"<br>Title: "+obj[i]['title']+"<br>Status: "+obj[i]['status']+"<br>DOS: "+obj[i]['due_date_time']+"</td></tr>").appendTo('#rmtbody');
						}
							
					});
					
	
				});				
			}
		</script>
		
		
	</head>
	<body>
		<?php
			include_once './include/menu.php';
		?>
		<div class="body">
			<div class="content">
				<div style="width:76%; margin:0 10%; padding:2%; margin-top:50px;  background-color:white; opacity:0.95;">
					<div style="min-height:350px;">
						<div style="float:left; width:70%;">
							<h1>Your Category Wise Question</h1>
							<div style="border-top-left-radius:10px; border-top-right-radius:10px; overflow:hidden;">
								<table  style=" border-collapse:collapse; width:100%;">
									<thead >
										<tr style="background-color:#B16F2C; color:white; height: 35px;"><th>Bounty</th><th>Category</th><th style="width:50%;">Title</th><th>Status</th><th>DOS</th></tr>
									</thead>
									<tbody id="tbody">
										<?php
									include './include/connection.php';
									$result=mysqli_query($con,'select count(distinct(questions.question_id)) as total from questions,question_majors,majors,profiles where question_majors.question_major=majors.user_major and questions.question_id=question_majors.question_id and profiles.user_id=majors.user_id and profiles.user_id='.$login_session);
									$row=mysqli_fetch_array($result);
									$total=ceil($row['total']/8)*8;
									if($total==0)
										$count=0;
									else
										$count=1;
									echo "<script> 
															var total=$total;
															var count=1;
																 
									</script>";
									mysqli_close($con);
									?>
								</tbody>
								</table>
								<div style="width:100%; height:35px; background-color:#B16F2C">
									<input class="nav-button" data="back" type="button" value="<" style="margin-left:4px;height:80%; width:40px; font-weight:bold; font-size:120%;">
									<span><span class="pagecount"><?php echo $count; ?></span>/<?php echo ceil($total/10); ?></span>
									<input class="nav-button" data="next" type="button" value=">" style="height:80%; width:40px; font-weight:bold; font-size:120%;">
								</div>
							</div>
						
						</div>
						<div style="float:right; width:28%; margin-left:2%;">
							<h1>Top Earners</h1>
							<div style="width:100%; background-color:white; height:300px; border:none;">
							
								<marquee direction="up"  scrollamount="2" behavior="alternate" onmouseover="this.setAttribute('scrollamount', 0, 0);" onmouseout="this.setAttribute('scrollamount', 2, 0);">
									<?php 
										include './include/connection.php';
										$result=mysqli_query($con,"select profiles.user_id,user_name,avg_rating,rating_count,earning,user_type from profiles,users where profiles.user_id=users.user_id and user_type='normal' order by earning desc limit 10");
										while($row=mysqli_fetch_array($result)){
                                            
                                            if($row['avg_rating']==''){
                                                $rating="Newbie";
                                            }
											else if($row['avg_rating']==5){
												$rating="A+";
											}
											else if($row['avg_rating']>=4&& $row['avg_rating']<5){
												$rating="A";
											}
											else if($row['avg_rating']>=3&& $row['avg_rating']<4){
												$rating="B";
											}
											else if($row['avg_rating']>=2&& $row['avg_rating']<3){
												$rating="C";
											}
											else if($row['avg_rating']>=1&& $row['avg_rating']<2){
												$rating="D";
											}
											else if($row['avg_rating']>=0&& $row['avg_rating']<1){
												$rating="F";
											}
											echo '

													<div class="questdiv">
														<img src="image.php?user_id='.$row['user_id'].'">
														<div class="quest">
															<a href="view_profile.php?user_id='.$row['user_id'].'"><h5>'.$row['user_name'].'</h5></a>
															<span class="qtitle">
															Earning: $'.$row['earning'].' <br>
															Rating : '.$rating.'
															</span>
														</div>
													</div>
													<div class="line"></div>
											
											';
										
										
										}
									?>
								
								</marquee> 
							</div>
						
						
						</div>
					</div>
					<div>
						<div>
							<h1>Recent All Question</h1>
							<div>
								<div id="filter">
									<script>
										var ftotal_row=0;
										var fcurrent_pos=0;
										$(document).ready(function(){
											$(".filter_input").bind('keyup input',function(event){
												var input=$.trim($(this).val());
												var keycode = event.which;
												if(keycode==37||keycode==39){
													return;
												}
												else if(keycode==40){
													if(fcurrent_pos<ftotal_row){
														$('.filter_table div:nth-child('+fcurrent_pos+')').removeClass('fselected').css('background','grey');
														fcurrent_pos=fcurrent_pos+1;
														$('.filter_table div:nth-child('+fcurrent_pos+')').addClass('fselected').css('background','#3bb998');
													}
												}
												else if(keycode==38){
													if(fcurrent_pos>1){
														$('.filter_table div:nth-child('+fcurrent_pos+')').removeClass('fselected').css('background','grey');
														fcurrent_pos=fcurrent_pos-1;
														$('.filter_table div:nth-child('+fcurrent_pos+')').addClass('fselected').css('background','#3bb998');			
													}
												}
												else if(keycode==13&&input!=''){
													if($('.fselected').html()){
														var tag=$('.fselected').html();
														call(tag);
													}
													
													
												}
												else if(input!=''){
													fcurrent_pos=0;
													$.ajax({
														url:'query.php',
														type:'POST',
														data:{
															type:'10',
															major:input
														}						
													}).done(function(tags){
														$('.filter_table').html('').hide();
														if($.trim(tags)!=''){
															ftotal_row=0;
															var obj = jQuery.parseJSON(tags);
															$.each(obj,function(i){						
																$('.filter_table').append('<div onclick="call(\''+obj[i]+'\');">'+obj[i]+'</div>').show();
																ftotal_row++;
															});			
														}
													});
												}
												else{
													$('.filter_table').html('').hide();
												}
											});
											
											$(".filter_input").on("focusout",function(obj){
												console.log(obj);
												
												$(".filter_tab").hide();
												
											});
											
										});
										function call(data){
											var type="";
											$(".filter_input").each(function(i){
												
												if($(this).val()!=''){
													if(i==0)
														type="dfilter";
													else 
														type="mfilter";
												}
											});
											window.location.href="index.php?filter="+data+"#"+type;
										}
									</script>
									<style>
										.filter_table{
											position: absolute;
											min-width:150px;
											opacity: 0.9;
											display: block;
											background-color:black;
											color:white;
										}
										.filter_table{
											list-style:none;
											border:1px solid grey;
											display:none;
										}
										.filter_table div{
											background-color: grey;
											border-color: #3b5998;
											min-width:100px;
											padding:4px;
											border-top:solid 1px #dedede; 
											font-size:12px;
											cursor:pointer;
											font-size:20px;
											z-index:10;
										}
										.filter_table div:hover{
											background-color:#2ecbed;
											color:white;
											cursor:pointer;				
										}
										.textinput{
											width:40%;
											display: inline-block;
											height: 25px;
											font-size: 12px;
											color: rgb(85, 85, 85);
											background-color: #ffffff;
										    border: 1px solid #cccccc;
										    -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
										    -moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
										    box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
										    border-radius: 3px;
										    margin:5px;
										 
										}

										.textinput:focus{
											outline: none;
										    border-color: #9ecaed;
										    box-shadow: 0 0 20px #9ecaed;
									
										}
									</style>
									<input class="filter_input textinput" style="height:30px; margin-bottom:3px; background-color:white; font-size:25px;"  type="text" placeholder="Filter (category name)">
									<div class="filter_table">
										
									</div>
								</div>
							</div>
							<div id="dfilter" style="border-top-left-radius:10px; border-top-right-radius:10px; overflow:hidden;">
								<table  style=" border-collapse:collapse; width:100%;">
									<thead >
										<tr style="background-color:#B16F2C; color:white; height: 35px;"><th>Bounty</th><th>Category</th><th style="width:50%;">Title</th><th>Status</th><th>DOS</th></tr>
									</thead>
									<tbody id="rtbody">
										<?php
											include './include/connection.php';
											if(isset($_GET['filter'])){
												$filter=$_GET['filter'];
												echo "<script> var filter_data=\"$filter\"; </script>";
												$query="select count(distinct(questions.question_id)) as total from questions,question_majors where question_majors.question_major='$filter' and question_majors.question_id=questions.question_id";
											}
											else{
												$query="select count(distinct(questions.question_id)) as total from questions,question_majors";
											}
											$result=mysqli_query($con,$query);
											$row=mysqli_fetch_array($result);
											$rtotal=ceil($row['total']/10)*10;
											if($rtotal==0)
												$rcount=0;
											else
												$rcount=1;
											
											echo "<script> var rtotal=$rtotal;
																		 var rcount=1;
																		 
											</script>";
											mysqli_close($con);
											?>
									</tbody>
									</table>
									<div style="width:100%; height:35px; background-color:#B16F2C">
										<input class="rnav-button" data="back" type="button" value="<" style="margin-left:4px;height:80%; width:40px; font-weight:bold; font-size:120%;">
										<span><span class="rpagecount"><?php echo $rcount; ?></span>/<?php echo ceil($rtotal/10); ?></span>
										<input class="rnav-button" data="next" type="button" value=">" style="height:80%; width:40px; font-weight:bold; font-size:120%;">
									</div>
								</div>
							<style>
										tbody tr td{
											padding:.6%;
											padding-left:1%;
										}
										thead tr th{
											padding-left:1%;
										}
										tbody tr{
											cursor:pointer;
											background-color:#F5F5F5;
										}
										.rnav-button,.nav-button{
											border: medium none;
											border-radius:5px;
											font-family: "HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;
											background:none;
											color:#fff;
											margin-top:12px;
										}
										.rnav-button:hover {
											box-shadow: inset 0 1px 3px rgba(0,0,0,0.5);
											-moz-box-shadow: inset 0 1px 3px rgba(0,0,0,0.5);
											-webkit-box-shadow: inset 0 1px 3px rgba(0,0,0,0.5);
											cursor:pointer;
											color:#000000;	
										}
										.rnav-button:focus {
											position: relative;
											bottom: -1px;
											box-shadow: inset 0 1px 6px rgba(256,256,256,0.75);
											-moz-box-shadow: inset 0 1px 6px rgba(256,256,256,0.75);
											-webkit-box-shadow: inset 0 1px 6px rgba(256,256,256,0.75);
										}
										.rnav-button,tr{
											transition: all 0.5s ease;
											-moz-transition: all 0.5s ease;
											-webkit-transition: all 0.5s ease;
											-o-transition: all 0.5s ease;
											-ms-transition: all 0.5s ease;
										}
										#page3{
											font-family: "Avant Garde",Avantgarde,"Century Gothic",CenturyGothic,"AppleGothic",sans-serif;
										}
										#page3 .desktop h1{
											font-family:Arial,Helvetica,sans-serif;
										}
										.rpagecount,.pagecount{
											font-weight:bolder;
										}
										
										tbody tr:hover{
											color:#000;
											background-color:#CCC;
										}


							</style>
						</div>
					</div>
				</div>

				<?php
					include './include/connection.php';
					$result=mysqli_query($con,'select nav_flag from profiles where user_id='.$login_session);
					$row=mysqli_fetch_array($result);
					if($row['nav_flag']==0){
						echo "<script>
							$(document).ready(function(){
								$('.trans_bg').show();

								var nav1=3;
								var nav2=4;
								var nav3=1;
								$('#nav_btn1').click(function(){
									if(nav1==3){
										$('.nav1_span').css('left','340px');
										$('.nav1 p').html('Post your question and upload your projects ');
										nav1--;
									}
									else if(nav1==2){
										$('.nav1_span').css('left','410px');
										$('.nav1 p').html('View your purchased and uploaded material');
										nav1--;
									}
									else if(nav1==1){
										$('.nav1_span').css('left','500px');
										$('.nav1 p').html('View your transactions and withdraw history/details');
										nav1--;
									}
									else{
										$('.nav1').fadeOut('slow');
										$('.nav2').fadeIn('slow');
									}
								});

								$('#nav_btn2').click(function(){
									if(nav2==4){
										$('.nav2_span').css('right','255px');
										$('.nav2 p').html('This <img width=20 height=20 src=\'./images/msg.png\'> will turn <img width=20 height=20 src=\'./images/message.png\'> when some user sends you a message and this will be used to exchange messages between users');
										nav2--;
									}
									else if(nav2==3){
										$('.nav2_span').css('right','210px');
										$('.nav2 p').html('This <img width=20 height=20 src=\'./images/doller.png\'> will turn <img  width=20 height=20 src=\'./images/dollar2.png\'> when someone buys your project or answer ');
										nav2--;
									}
									else if(nav2==2){
										$('.nav2_span').css('right','118px');
										$('.nav2 p').html('This will indicate your current rating and will notify you when someone rates on your answer or project. As you are new user , So it is null currently.');
										nav2--;
									}
									else if(nav2==1){
										$('.nav2_span').css('right','65px');
										$('.nav2 p').html('You can view and edit your profile,view your cart items and change your account password ');
										nav2--;
									}
									else{
										$('.nav2').fadeOut('slow');
										$('.nav3').fadeIn('slow');
									}
								});

								$('#nav_btn3').click(function(){
									if(nav3==1){
										$('.nav3_span').css('right','20px');
										$('.nav3 p').html('You will get a glimpse of your cart here');
										nav3--;
									}
									else{
										$('.nav3').fadeOut('slow');
										$('.nav4').fadeIn('slow');
									}

								});

								$('#nav_btn4').click(function(){
									$('.nav4').fadeOut('slow');
									$('.nav6').fadeIn('slow');
								});

								$('#nav_btn6').click(function(){
									$('.nav6').fadeOut('slow');
									$('.nav5').fadeIn('slow');
								});

								$('#nav_btn5').click(function(){
									$('.nav5').fadeOut('slow');
									$('.user_nav').remove();
									$('.trans_bg').remove();
									updateFlag();
								});

								$('#nav_btn7').click(function(){
									$('.user_nav').remove();
									$('.trans_bg').remove();
									updateFlag();
								});

							});

							function updateFlag(){
								$.ajax({
									url:'query.php',
									data:{flag:'1',type:'34'},
									type:'POST'
								});
							}
						</script>";

						echo '<style>
							.nav1_span,.nav2_span,.nav3_span{
								transition: all 0.5s ease;
								-moz-transition: all 0.5s ease;
								-webkit-transition: all 0.5s ease;
								-o-transition: all 0.5s ease;
								-ms-transition: all 0.5s ease;
							}
							</style>
							<div class="user_nav" style="width:100%;height:100%;background-color:transparent;display:block;z-index:200;position:fixed;top:0;left:0;color:black;">
								<div class="nav1" style="position: fixed;background-color: whitesmoke;width:25%;min-height: 50px;top: 55px;left: 265px;padding:5px;border-radius:5px;-webkit-box-shadow: 0px 0px 20px #9ecaed;box-shadow: 0px 0px 20px whitesmoke;">
									<span class="nav1_span" style="position:fixed;top:46px;left:290px;border-left:10px solid transparent;border-right:10px solid transparent;border-bottom:10px solid whitesmoke;z-index:10;"></span>
									<p>Your home for everything </p>
									<input type="button" class="nav-button" id="nav_btn1"style="float:right;width:50px;height:20px;font-size:14px;background-color:#1487F1;" value=">" />
								</div>

								<div class="nav2" style="position: fixed;background-color: whitesmoke;width:28%;min-height: 50px;top: 55px;right: 50px;padding:5px;display:none;border-radius:5px;-webkit-box-shadow: 0px 0px 20px #9ecaed;box-shadow: 0px 0px 20px whitesmoke;">
									<span class="nav2_span" style="position:fixed;top:46px;right:300px;border-left:10px solid transparent;border-right:10px solid transparent;border-bottom:10px solid whitesmoke;z-index:10;"></span>
									<p>This <img width=20 height=20 src=\'./images/ques.png\'> will turn <img width=20 height=20 src=\'./images/question.png\'> when someone answers on your question</p>
									<input type="button" class="nav-button" id="nav_btn2"style="float:right;width:50px;height:20px;font-size:14px;background-color:#1487F1;" value=">" />
								</div>

								<div class="nav3" style="position: fixed;background-color: whitesmoke;width:20%;min-height: 50px;top: 100px;right:10px;padding:5px;display:none;border-radius:5px;-webkit-box-shadow: 0px 0px 20px #9ecaed;box-shadow: 0px 0px 20px whitesmoke;">
									<span class="nav3_span" style="position:fixed;top:91px;right:75px;border-left:10px solid transparent;border-right:10px solid transparent;border-bottom:10px solid whitesmoke;z-index:10;"></span>
									<p>Click on it to search various questions and projects based on their title</p>
									<input type="button" class="nav-button" id="nav_btn3"style="float:right;width:50px;height:20px;font-size:14px;background-color:#1487F1;" value=">" />
								</div>

								<div class="nav4" style="position: fixed;background-color: whitesmoke;width:20%;min-height: 50px;top: 104px;left:615px;padding:5px;display:none;border-radius:5px;-webkit-box-shadow: 0px 0px 20px #9ecaed;box-shadow: 0px 0px 20px whitesmoke;">
									<span class="nav4_span" style="position:fixed;top:180px;right:630px;border-left:10px solid transparent;border-right:10px solid transparent;border-top:10px solid whitesmoke;z-index:10;"></span>
									<p>Questions selected based on your category will be shown here</p>
									<input type="button" class="nav-button" id="nav_btn4"style="float:right;width:50px;height:20px;font-size:14px;background-color:#1487F1;" value=">" />
								</div>

								<div class="nav5" style="position: fixed;background-color: whitesmoke;width:20%;min-height: 50px;top: 510px;right:465px;padding:5px;display:none;border-radius:5px;-webkit-box-shadow: 0px 0px 20px #9ecaed;box-shadow: 0px 0px 20px whitesmoke;">
									<span class="nav5_span" style="position:fixed;top:588px;right:480px;border-left:10px solid transparent;border-right:10px solid transparent;border-top:10px solid whitesmoke;z-index:10;"></span>
									<p>Questions posted from various categories will be shown here</p>
									<input type="button" class="nav-button" id="nav_btn5"style="float:right;width:50px;height:20px;font-size:14px;background-color:#1487F1;" value=">" />
								</div>

								<div class="nav6" style="position: fixed;background-color: whitesmoke;width:20%;min-height: 50px;top: 375px;right:470px;padding:5px;display:none;border-radius:5px;-webkit-box-shadow: 0px 0px 20px #9ecaed;box-shadow: 0px 0px 20px whitesmoke;">
									<span class="nav6_span" style="position:fixed;top:385px;right:460px;border-left:10px solid whitesmoke;border-top:10px solid transparent;border-bottom:10px solid transparent;z-index:10;"></span>
									<p>Current top earners will come up here. You may be one of them !</p>
									<input type="button" class="nav-button" id="nav_btn6"style="float:right;width:50px;height:20px;font-size:14px;background-color:#1487F1;" value=">" />
								</div>

								<input type="button" class="nav-button" id="nav_btn7" style="position:fixed;top:80%;right:20px;height:30px;font-size:15px;background-color:#1487F1;padding:5px;-webkit-box-shadow: 0px 0px 10px #9ecaed;box-shadow: 0px 0px 10px whitesmoke;" value="I know everyting, take me home" />
							</div>	
							<div class="trans_bg"></div>';
					}
				?>
			
			

			</div>		


			<div class="mcontent">
				
				<div style="width:90%; margin:0 3%; padding:2%; margin-top:50px; min-height:600px; background-color:white;">
					<div >
						<h3>Your Category Wise Question</h3>
						<div style="border-top-left-radius:10px; border-top-right-radius:10px; overflow:hidden;">
							<table  style=" border-collapse:collapse; width:100%;">
								<thead >
									<tr style="background-color:#B16F2C; color:white; height: 35px;"><th>Bounty</th><th style="width:80%;">Details</th></tr>
								</thead>
								<tbody id="mtbody">
									<script>
										if(rtotal==0){
											$("<tr style='  height: 25px; background-color:#b4d4f4; border-bottom:1px solid #e1e8ed;'><td colspan=2>No Records Found.....</td></tr>").appendTo('#mtbody');
											$("<tr style='  height: 25px; background-color:#b4d4f4; border-bottom:1px solid #e1e8ed;'><td colspan=5>No Records Found.....</td></tr>").appendTo('#tbody');
										}								
										else{
											loaddata(0);
										}
											
									</script>
				
								</tbody>
							</table>
							<div style="width:100%; height:35px; background-color:#B16F2C; ">
								<input class="nav-button" data="back" type="button" value="<" style="height:100%; width:50px; font-weight:bold; font-size:120%;">
								<span><span class="pagecount"><?php echo $count; ?></span>/ <?php echo ceil($total/8); ?></span>
								<input class="nav-button" data="next" type="button" value=">" style="height:100%; width:50px; font-weight:bold; font-size:120%;">
							</div>
						</div>
							
					</div>
					<div style="margin-top:10%;">
						<h3>Recent All Question</h3>
						<div>
							<input class="filter_input" style="height:30px; margin-bottom:3px; background-color:white; font-size:25px;"  type="text" placeholder="Filter (category name)">
							<div class="filter_table">
								
							</div>
						</div>
						<div id="mfilter" style="border-top-left-radius:10px; border-top-right-radius:10px; overflow:hidden;">
							<table  style=" border-collapse:collapse; width:100%;">
								<thead >
									<tr style="background-color:#B16F2C; color:white; height: 35px; "><th>Bounty</th><th style="width:80%;">Details</th></tr>
								</thead>
								<tbody id="rmtbody">
									<script>
										if(rtotal==0){
											$("<tr style='  height: 25px; background-color:#b4d4f4;'><td colspan=2>No Records Found.....</td></tr>").appendTo('#rmtbody');
											$("<tr style='  height: 25px; background-color:#b4d4f4;'><td colspan=5>No Records Found.....</td></tr>").appendTo('#rtbody');
										}								
										else
											rloaddata(0);
									</script>
				
								</tbody>
							</table>
							<div style="width:100%; height:35px; background-color:#B16F2C">
								<input class="rnav-button" data="back" type="button" value="<" style="height:100%; width:50px; font-weight:bold; font-size:120%;">
								<span><span class="rpagecount"><?php echo $rcount; ?></span>/ <?php echo ceil($rtotal/10); ?></span>
								<input class="rnav-button" data="next" type="button" value=">" style="height:100%; width:50px; font-weight:bold; font-size:120%;">
							</div>
						</div>
					
					</div>
					<div style="margin-top:10%;">
						<h3>Top Earners</h3>
						<div style="width:100%; background-color:white; height:300px;">
						
							<marquee direction="up"  scrollamount="2" behavior="alternate" onmouseover="this.setAttribute('scrollamount', 0, 0);" onmouseout="this.setAttribute('scrollamount', 2, 0);">
								<?php 
									include './include/connection.php';
									$result=mysqli_query($con,"select profiles.user_id,user_name,avg_rating,rating_count,earning,user_type from profiles,users where profiles.user_id=users.user_id and user_type='normal' order by earning desc limit 10");
										while($row=mysqli_fetch_array($result)){
											if($row['avg_rating']==''){
                                                $rating="Newbie";
                                            }
											else if($row['avg_rating']==5){
												$rating="A+";
											}
											else if($row['avg_rating']>=4&& $row['avg_rating']<5){
												$rating="A";
											}
											else if($row['avg_rating']>=3&& $row['avg_rating']<4){
												$rating="B";
											}
											else if($row['avg_rating']>=2&& $row['avg_rating']<3){
												$rating="C";
											}
											else if($row['avg_rating']>=1&& $row['avg_rating']<2){
												$rating="D";
											}
											else if($row['avg_rating']>=0&& $row['avg_rating']<1){
												$rating="F";
											}
										echo '
												<div class="questdiv">
													<img src="image.php?user_id='.$row['user_id'].'">
													<div class="quest">
														<a href="view_profile.php?user_id='.$row['user_id'].'"><h5>'.$row['user_name'].'</h5></a>
														<span class="qtitle">
														Earning: $'.$row['earning'].' <br>
														Rating : '.$rating.'
														</span>
													</div>
												</div>
										
										';
									
									
									}
								?>
								
								
							</marquee> 
							
						</div>
					</div>
				</div>
			</div>		
		</div>
		<?php
			include_once './include/footer.php';
		?>
	</body>
</html>