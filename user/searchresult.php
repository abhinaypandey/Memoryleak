<?php 
	include_once './include/lock_normal.php';
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Search questions and projects</title>
		<?php
			include_once './include/head.php';
		?>
		<style>
			.searchresult{
				background-color:white;
				width:90%;
				height: auto;
				display: block;
				margin: 50px 5%;
				overflow: auto;

			}

			.questdiv{
				background-color: whitesmoke ;
				width:100%;
				cursor: pointer;
				min-height:70px;
				word-break:break-all; 
				border-bottom: 2px solid #fff;

			}

			.questdiv img{
				float:left;
				border:2px solid whitesmoke outset;
				margin: 5px;
				width:50px;
				height: 50px;
				border-radius: 50px 50px;

			}

			.quest{
				width:80%;
				min-height:60px; 
				float:left;
			
			}

			.qtitle:hover{
				text-decoration: underline;
			}

			
			h5{
				color:#3bb998;	

			}

			.bountyspan{
				
				position: relative;
				color:green;
				margin:0 5px;

			}

			.nav-div{
				margin-left:5%;
				margin-top: -4%;
			}
			
			.nav-button{
				background-color: #d14545;
				background-image: -webkit-gradient(linear, left top, left bottom, from(#e97171), to(#d14545));
				background-image: -webkit-linear-gradient(top, #e97171, #d14545);
				background-image: -moz-linear-gradient(top, #e97171, #d14545);
				background-image: -ms-linear-gradient(top, #e97171, #d14545);
				background-image: -o-linear-gradient(top, #e97171, #d14545);
				background-image: linear-gradient(top, #e97171, #d14545);
				-moz-border-radius: 3px;
				-webkit-border-radius: 3px;
				border-radius: 3px;
				text-shadow: 0 1px 0 rgba(0,0,0,.5);
				-moz-box-shadow: 0 0 1px rgba(0, 0, 0, 0.3), 0 1px 0 rgba(255, 255, 255, 0.3) inset;
				-webkit-box-shadow: 0 0 1px rgba(0, 0, 0, 0.3), 0 1px 0 rgba(255, 255, 255, 0.3) inset;
				box-shadow: 0 0 1px rgba(0, 0, 0, 0.3), 0 1px 0 rgba(255, 255, 255, 0.3) inset;    
				border: 1px solid #d14545;
				margin-top:1%;
				margin-bottom:1%;
				width: 100px;
				cursor: pointer;
				font: bold 11px Arial, Helvetica;
				color: #fff;                                                  
	
			}
			.nav-button:hover,.nav-button:focus {		
				background-color: #e97171;
				background-image: -webkit-gradient(linear, left top, left bottom, from(#d14545), to(#e97171));
				background-image: -webkit-linear-gradient(top, #d14545, #e97171);
				background-image: -moz-linear-gradient(top, #d14545, #e97171);
				background-image: -ms-linear-gradient(top, #d14545, #e97171);
				background-image: -o-linear-gradient(top, #d14545, #e97171);
				background-image: linear-gradient(top, #d14545, #e97171);
			}	
	


			/*********mobile*********/
			.msearchresult{
				background-color:white;
				width:90%;
				height: auto;
				display: block;
				margin: 50px 5%;
				overflow: auto;

			}

			.mquestdiv{
				background-color: whitesmoke ;
				width:100%;
				cursor: pointer;
				min-height:130px; 
				word-break:break-all;
			    border-bottom: 2px solid #fff;
			}

			.mquestdiv img{
				float:left;
				border:2px solid whitesmoke outset;
				margin: 5px;
				width:50px;
				height: 50px;
				border-radius: 50px 50px;

			}

			.mquest{
				width:80%;
				min-height:100px; 
				float:left;
			
			}
			
			h5{
				color:#3bb998;	

			}

			.mbountyspan{
				
				position: relative;
				color:green;
				margin:0 5px;

			}

			.mnav-div{
				margin:5%;
			}
			
			.mnav-button{
				background-color: #d14545;
				background-image: -webkit-gradient(linear, left top, left bottom, from(#e97171), to(#d14545));
				background-image: -webkit-linear-gradient(top, #e97171, #d14545);
				background-image: -moz-linear-gradient(top, #e97171, #d14545);
				background-image: -ms-linear-gradient(top, #e97171, #d14545);
				background-image: -o-linear-gradient(top, #e97171, #d14545);
				background-image: linear-gradient(top, #e97171, #d14545);
				-moz-border-radius: 3px;
				-webkit-border-radius: 3px;
				border-radius: 3px;
				text-shadow: 0 1px 0 rgba(0,0,0,.5);
				-moz-box-shadow: 0 0 1px rgba(0, 0, 0, 0.3), 0 1px 0 rgba(255, 255, 255, 0.3) inset;
				-webkit-box-shadow: 0 0 1px rgba(0, 0, 0, 0.3), 0 1px 0 rgba(255, 255, 255, 0.3) inset;
				box-shadow: 0 0 1px rgba(0, 0, 0, 0.3), 0 1px 0 rgba(255, 255, 255, 0.3) inset;    
				border: 1px solid #d14545;
				margin-top:1%;
				margin-bottom:1%;
				width: 100px;
				cursor: pointer;
				font: bold 11px Arial, Helvetica;
				color: #fff;                                                  
	
			}
			.mnav-button:hover,.mnav-button:focus {		
				background-color: #e97171;
				background-image: -webkit-gradient(linear, left top, left bottom, from(#d14545), to(#e97171));
				background-image: -webkit-linear-gradient(top, #d14545, #e97171);
				background-image: -moz-linear-gradient(top, #d14545, #e97171);
				background-image: -ms-linear-gradient(top, #d14545, #e97171);
				background-image: -o-linear-gradient(top, #d14545, #e97171);
				background-image: linear-gradient(top, #d14545, #e97171);
			}	
	

		
		</style>

		

		
	</head>
	<body>


		<?php
			include_once './include/menu.php';
		?>
		<div class="body">
			<div class="content">
				<div class='searchresult'>
				
				</div>

			<?php
			if(isset($_GET['category'])&& $_GET['category']=='question'){

					echo "<script>
					$(document).ready(function(){
						//var count=5;
						$('.nav-button').click(function(){
							//alert(count);
								var data=$.trim($(this).val());
								if(data=='<'){
									count--;
								}
									
								else if(data=='>'){
									count++;
								}
														
								if(count==0||total==0){
									count=1;
								}
								else if(count==parseInt(total/10)+2){
									count=parseInt(total/10)+1;
								}
								else{
									loaddata(count*10-10);
									$('.pagecount').text(parseInt(count));
								}
							});

					});

					function loaddata(count){
						
						
						var searchtext='".$_GET['searchtext']."';
						var category='".$_GET['category']."'
						$.ajax({
							url:'query.php',
							data:{
								search:searchtext,
								type:'24',
								category:category,
								count:count
								},
							datatype:'json',
							type:'POST'
						}).done(function(data){
							$('.searchresult').html('');
							//console.log(data);
							if(data!=''){
								var obj=jQuery.parseJSON(data);
									if(category=='question'){
										$.each(obj,function(i){
											if((obj[i]['title']).length>230){
												obj[i]['title']=obj[i]['title'].substring(0,230)+'.........';
											}
											$('<div ><img src=\''+'image.php?user_id='+obj[i]['user_id']+'\'></img><div class=\'quest\'><h5>'+obj[i]['user_name']+'</h5><span class=\'qtitle\' onclick=\"openQuestion(\''+obj[i]['question_id']+'\')\"; data='+obj[i]['question_id']+'>'+obj[i]['title']+'</span><div class=\'bountyspan\'>'+'$'+obj[i]['bounty']+'</div></div></div>').addClass('questdiv').appendTo('.searchresult');
										});
									}
								
									else if(category=='project'){
										$.each(obj,function(i){
											$('<div ><img src=\''+'image.php?user_id='+obj[i]['user_id']+'\'></img><div class=\'quest\'><h5>'+obj[i]['user_name']+'</h5><span class=\'qtitle\' onclick=\"openProject(\''+obj[i]['project_id']+'\')\"; data='+obj[i]['project_id']+'>'+obj[i]['title']+'</span><div class=\'bountyspan\'>'+'$'+obj[i]['bounty']+'</div></div></div>').addClass('questdiv').appendTo('.searchresult');
										
										});

									}
								
									

							}
							
							
						});
					}

					function openQuestion(qid){
						window.location.href='view_question.php?question_id='+qid;
					}

					function openProject(pid){
						window.location.href='view_project.php?project_id='+pid;
					}


			</script>";

				include './include/connection.php';
				$result=mysqli_query($con,"SELECT count(*) as total FROM questions AS q,profiles AS p WHERE  q.user_id=p.user_id AND MATCH(title) AGAINST('".$_GET['searchtext']."' IN NATURAL LANGUAGE MODE)");
				$row=mysqli_fetch_array($result);
				$total=$row['total'];
				if($total==0)
					$count=0;
				else
					$count=1;
				echo "<script> var total=$total;
							var count=1;
				</script>";
				echo"
					<div class='nav-div'>
						<input class='nav-button' data='back' type='button' value='<' style='height:100%; width:50px; font-weight:bold; font-size:120%;'>
						<span style='background-color:#3cc99c;'><span class='pagecount' >".$count."/</span>".ceil($total/10)."</span>
						<input class='nav-button' data='next' type='button' value='>' style='height:100%; width:50px; font-weight:bold; font-size:120%;'>
					</div>
					<script>
						if(total==0){
							$('.nav-div').remove();
							$('<span></span>').appendTo('.searchresult').html('<h4>No question was found !!</h4><br/><a style=\'text-decoration:underline;color:blue;\' href='+'post_question.php'+' >Got a question ? Post your question by clicking on this link !!</a>');
							
						}	
						else{
							loaddata(0);
							
						}
					</script>
					";

				mysqli_close($con);

					
						
			}
			else if($_GET['category']=='project'){

					echo "<script>
					$(document).ready(function(){
						//var count=5;
						$('.nav-button').click(function(){
							//alert(count+ ' '+total);
								var data=$.trim($(this).val());
								if(data=='<')
									count--;
								else if(data=='>')
									count++;					
								if(count==0||total==0){
									count=1;
								}
								else if(count==parseInt(total/10)+2){
									count=parseInt(total/10)+1;
								}
								else{
									loaddata(count*10-10);
									$('.pagecount').text(parseInt(count));
								}
							});

					});

					
					
					function loaddata(count){
						
						
						var searchtext='".$_GET['searchtext']."';
						var category='".$_GET['category']."'
						$.ajax({
							url:'query.php',
							data:{
								search:searchtext,
								type:'24',
								category:category,
								count:count
								},
							datatype:'json',
							type:'POST'
						}).done(function(data){
							$('.searchresult').html('');
							//console.log(data);
							if(data!=''){
								var obj=jQuery.parseJSON(data);
									if(category=='question'){
										$.each(obj,function(i){
											if((obj[i]['title']).length>230){
												obj[i]['title']=obj[i]['title'].substring(0,230)+'.........';
											}
											$('<div ><img src=\''+'image.php?user_id='+obj[i]['user_id']+'\'></img><div class=\'quest\'><h5>'+obj[i]['user_name']+'</h5><span class=\'qtitle\' onclick=\"openQuestion(\''+obj[i]['question_id']+'\')\"; data='+obj[i]['question_id']+'>'+obj[i]['title']+'</span><div class=\'bountyspan\'>'+'$'+obj[i]['bounty']+'</div></div></div>').addClass('questdiv').appendTo('.searchresult');
										});
									}
								
									else if(category=='project'){
										$.each(obj,function(i){
											$('<div ><img src=\''+'image.php?user_id='+obj[i]['user_id']+'\'></img><div class=\'quest\'><h5>'+obj[i]['user_name']+'</h5><span class=\'qtitle\' onclick=\"openProject(\''+obj[i]['project_id']+'\')\"; data='+obj[i]['project_id']+'>'+obj[i]['title']+'</span><div class=\'bountyspan\'>'+'$'+obj[i]['bounty']+'</div></div></div>').addClass('questdiv').appendTo('.searchresult');
										
										});

									}
								
									

							}
							
							
						});
					}

					function openQuestion(qid){
						window.location.href='view_question.php?question_id='+qid;
					}

					function openProject(pid){
						window.location.href='view_project.php?project_id='+pid;
					}

			</script>";

				include './include/connection.php';
				$result=mysqli_query($con,"SELECT count(*) as total FROM projects AS q,profiles AS p WHERE  q.user_id=p.user_id AND MATCH(title) AGAINST('".$_GET['searchtext']."' IN NATURAL LANGUAGE MODE)");
				$row=mysqli_fetch_array($result);
				$total=$row['total'];
				if($total==0)
					$count=0;
				else
					$count=1;
				echo "<script> var total=$total;
								var count=1;

					</script>";

				echo "
					<div class='nav-div'>
						<input class='nav-button' data='back' type='button' value='<' style='height:100%; width:50px; font-weight:bold; font-size:120%;'>
						<span style='background-color:#3cc99c;'><span class='pagecount' >".$count."/</span>".ceil($total/10)."</span>
						<input class='nav-button' data='next' type='button' value='>' style='height:100%; width:50px; font-weight:bold; font-size:120%;'>
					</div>
					<script>
						if(total==0){
							$('.nav-div').remove();
							$('<span></span>').appendTo('.searchresult').html('<h4>No relevant project was found !!</h4><br/><a style=\'text-decoration:underline;color:blue;\' href='+'post_question.php'+' >Post question regarding your project by clicking this link !!</a>');
							
						}	
						else{
							loaddata(0);
							
						}
					</script>
					";	
				mysqli_close($con);

					
			}
			
			?>

			</div>
			<div class="mcontent">
				<div class='msearchresult'>
					
				</div>
				<?php
			if(isset($_GET['category'])&&$_GET['category']=='question'){

					echo "<script>
					$(document).ready(function(){
						//var count=5;
						$('.mnav-button').click(function(){
							//alert(count);
								var data=$.trim($(this).val());
								if(data=='<')
									count--;
								else if(data=='>'){
									count++;
								}
														
								if(count==0||total==0){
									count=1;
								}
								else if(count==parseInt(total/10)+2){
									count=parseInt(total/10)+1;
								}
								else{
									mloaddata(count*10-10);
									$('.pagecount').text(parseInt(count));
								}
							});

					});

					function mloaddata(count){
						var searchtext='".$_GET['searchtext']."'
						var category='".$_GET['category']."'
						$.ajax({
							url:'query.php',
							data:{
								search:searchtext,
								type:'24',
								category:category,
								count:count
								},
							datatype:'json',
							type:'POST'
						}).done(function(data){
							$('.msearchresult').html('');
							//console.log(data);
							if(data!=''){
								var obj=jQuery.parseJSON(data);
									if(category=='question'){
										$.each(obj,function(i){
											if((obj[i]['title']).length>100){
												obj[i]['title']=obj[i]['title'].substring(0,100)+'.........';
											}
											$('<div ><img src=\''+'image.php?user_id='+obj[i]['user_id']+'\'></img><div class=\'mquest\'><h5>'+obj[i]['user_name']+'</h5><span class=\'mqtitle\' onclick=\"openQuestion(\''+obj[i]['question_id']+'\')\"; data='+obj[i]['question_id']+'>'+obj[i]['title']+'</span><div class=\'mbountyspan\'>'+'$'+obj[i]['bounty']+'</div></div></div>').addClass('mquestdiv').appendTo('.msearchresult');
										});
									}
								
									else if(category=='project'){
										$.each(obj,function(i){
											$('<div ><img src=\''+'image.php?user_id='+obj[i]['user_id']+'\' ></img><h5>'+obj[i]['user_name']+'</h5><span class=\'mqtitle\' onclick=\"openProject(\''+obj[i]['project_id']+'\')\"; data='+obj[i]['question_id']+'>'+obj[i]['title']+'</span><span class=\'mbountyspan\'>'+'$'+obj[i]['bounty']+'</span></div>').addClass('mquestdiv').appendTo('.msearchresult');
										
										});

									}
								
									

							}
							
							
						});
					}

					function openQuestion(qid){
						window.location.href='view_question.php?question_id='+qid;
					}

					function openProject(pid){
						window.location.href='view_project.php?project_id='+pid;
					}

			</script>";

				include './include/connection.php';
				$result=mysqli_query($con,"SELECT count(*) as total FROM questions AS q,profiles AS p WHERE  q.user_id=p.user_id AND MATCH(title) AGAINST('".$_GET['searchtext']."' IN NATURAL LANGUAGE MODE)");
				$row=mysqli_fetch_array($result);
				$total=$row['total'];
				if($total==0)
					$count=0;
				else
					$count=1;
				echo "<script> var total=$total;
							var count=1;
				</script>";
				echo"
					<div class='nav-div'>
						<input class='nav-button' data='back' type='button' value='<' style='height:100%; width:50px; font-weight:bold; font-size:120%;'>
						<span style='background-color:#3cc99c;'><span class='pagecount' >".$count."/</span>".ceil($total/10)."</span>
						<input class='nav-button' data='next' type='button' value='>' style='height:100%; width:50px; font-weight:bold; font-size:120%;'>
					</div>
					<script>
						if(total==0){
							$('.nav-div').remove();
							$('<span></span>').appendTo('.msearchresult').html('<h4>No question was found !!</h4><br/><a style=\'text-decoration:underline;color:blue;\' href='+'post_question.php'+' >Got a question ? Post your question by clicking on this link !!</a>');
							
						}	
						else{
							mloaddata(0);
							
						}
					</script>
					";

				mysqli_close($con);
					
			 
						
			}
			else if(isset($_GET['category'])&&$_GET['category']=='project'){

					echo "<script>
					$(document).ready(function(){
						$('.mnav-button').click(function(){
								var data=$.trim($(this).val());
								if(data=='<')
									count--;
								else if(data=='>')
									count++;					
								if(count==0||total==0){
									count=1;
								}
								else if(count==parseInt(total/10)+2){
									count=parseInt(total/10)+1;
								}
								else{
									mloaddata(count*10-10);
									$('.pagecount').text(parseInt(count));
								}
							});

					});

					function mloaddata(count){
						var searchtext='".$_GET['searchtext']."'
						var category='".$_GET['category']."'
						$.ajax({
							url:'query.php',
							data:{
								search:searchtext,
								type:'24',
								category:category,
								count:count
								},
							datatype:'json',
							type:'POST'
						}).done(function(data){
							$('.msearchresult').html('');
							//console.log(data);
							if(data!=''){
								var obj=jQuery.parseJSON(data);
									if(category=='question'){
										$.each(obj,function(i){
											if((obj[i]['title']).length>100){
												obj[i]['title']=obj[i]['title'].substring(0,100)+'.........';
											}
											$('<div ><img src=\''+'image.php?user_id='+obj[i]['user_id']+'\'></img><div class=\'mquest\'><h5>'+obj[i]['user_name']+'</h5><span class=\'mqtitle\' onclick=\"openQuestion(\''+obj[i]['question_id']+'\')\"; data='+obj[i]['question_id']+'>'+obj[i]['title']+'</span><div class=\'mbountyspan\'>'+'$'+obj[i]['bounty']+'</div></div></div>').addClass('mquestdiv').appendTo('.msearchresult');
										});
									}
								
									else if(category=='project'){
										$.each(obj,function(i){
											$('<div ><img src=\''+'image.php?user_id='+obj[i]['user_id']+'\' ></img><h5>'+obj[i]['user_name']+'</h5><span class=\'mqtitle\' onclick=\"openProject(\''+obj[i]['project_id']+'\')\"; data='+obj[i]['question_id']+'>'+obj[i]['title']+'</span><span class=\'mbountyspan\'>'+'$'+obj[i]['bounty']+'</span></div>').addClass('mquestdiv').appendTo('.msearchresult');
										
										});

									}
						
							}
							
							
						});
					}

					function openQuestion(qid){
						window.location.href='view_question.php?question_id='+qid;
					}

					function openProject(pid){
						window.location.href='view_project.php?project_id='+pid;
					}


					
			</script>";

				include './include/connection.php';
				$result=mysqli_query($con,"SELECT count(*) as total FROM projects AS q,profiles AS p WHERE  q.user_id=p.user_id AND MATCH(title) AGAINST('".$_GET['searchtext']."' IN NATURAL LANGUAGE MODE)");
				$row=mysqli_fetch_array($result);
				$total=$row['total'];
				if($total==0)
					$count=0;
				else
					$count=1;
				echo "<script> var total=$total;
								var count=1;

					</script>";

				echo "
					<div class='nav-div'>
						<input class='nav-button' data='back' type='button' value='<' style='height:100%; width:50px; font-weight:bold; font-size:120%;'>
						<span style='background-color:#3cc99c;'><span class='pagecount' >".$count."/</span>".ceil($total/10)."</span>
						<input class='nav-button' data='next' type='button' value='>' style='height:100%; width:50px; font-weight:bold; font-size:120%;'>
					</div>
					<script>
						if(total==0){
							$('.nav-div').remove();
							$('<span></span>').appendTo('.msearchresult').html('<h4>No relevant project was found !!</h4><br/><a style=\'text-decoration:underline;color:blue;\' href='+'post_question.php'+'>Post question regarding your project by clicking this link !!</a>');
							
						}	
						else{
							mloaddata(0);
							
						}
					</script>
					";	
				mysqli_close($con);
					
		
					
			}
			
			?>
			</div>
	
		</div>
		<?php
			include_once './include/footer.php';
		?>
		
		
	</body>
</html>