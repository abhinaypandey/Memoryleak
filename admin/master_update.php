<?php 
	include_once './include/lock_admin.php';
?>
<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<?php
			include_once './include/head.php';
		?>
		<style>
			
		
		</style>
		<script>
			
			$(document).ready(function(){
				var mastertype;
				var action;
				$('.mastertype').on('change',function(){
					$('.updatebox').show('slow');
					mastertype=$('.mastertype :selected').val();
					if(mastertype=='Countries'){

						$('.codebox').show('normal');
					}

					else if(mastertype=='Majors'){
						$('.codebox').hide('normal');
					}
					else if(mastertype=='Skills'){
						$('.codebox').hide('normal');
					}
				});	
		
				
				$('.button').click(function(){
						var majors=$('input[name="masters"]').val();

						if(mastertype=="Countries"){
							var code=$('input[name="code"]').val();
								if(majors!=''){
									$.ajax({
										url:'query.php',
										type:'POST',
										data:{masters:majors,code:code,type:'3',mastertype:mastertype},
										datatype:'json'
									}).done(function(data){
										var inserted;
										var notinserted;
										var obj=jQuery.parseJSON(data);
										
											if(obj['inserted'].length!=0){
												
													inserted=obj['inserted'];
											
											}
											
											if(obj['notinserted'].length!=0){
												
													notinserted=obj['notinserted'];
												
											}
											

											if(inserted.length!=0){
												$('.result').slideDown('slow');
												$('.divs1').show('slow');
												$('.inserted').html(inserted);
											}
											if(notinserted.length!=0){
												$('.result').slideDown('slow');
												$('.divs2').show('slow');
												$('.notinserted').html(notinserted);
											}
									});

							}
						}
						else{
								if(majors!=''){
								$.ajax({
									url:'query.php',
									type:'POST',
									data:{masters:majors,type:'3',mastertype:mastertype},
									datatype:'json'
								}).done(function(data){
									var inserted="";
									var notinserted="";
									var obj=jQuery.parseJSON(data);
										obj1=obj['inserted'];
										obj2=obj['notinserted'];
										//console.log(obj1+obj2);
										if(obj1.length!=0){
											$.each(obj1,function(j){
												inserted+=obj1[j]+",";
											
											});
										}
										
										if(obj2.length!=0){
											$.each(obj2,function(k){
												notinserted+=obj2[k]+",";
											
											});	
										}
										

										if(inserted.length!=0){
											$('.result').slideDown('slow');
											$('.divs1').show('slow');
											$('.inserted').html(inserted);
										}
										if(notinserted.length!=0){
											$('.result').slideDown('slow');
											$('.divs2').show('slow');
											$('.notinserted').html(notinserted);
										}
								});

							}
						}
						
				
				});
				
				

			});

		
		</script>

		<script>
			
			$(document).ready(function(){
				var mastertype;
				var action;
				$('.mmastertype').on('change',function(){
					$('.mupdatebox').show('slow');
					mastertype=$('.mmastertype :selected').val();
					if(mastertype=='Countries'){
						$('.mcodebox').show('normal');
					}
					else if(mastertype=='Majors'){
						$('.mcodebox').hide('normal');
					}
					else if(mastertype=='Skills'){
						$('.mcodebox').hide('normal');
					}
				});	
			
				
				$('.mbutton').click(function(){
						var majors=$('input[name="mmasters"]').val();

						if(mastertype=="Countries"){
							var code=$('input[name="mcode"]').val();
								if(majors!=''){
									$.ajax({
										url:'query.php',
										type:'POST',
										data:{masters:majors,code:code,type:'3',mastertype:mastertype},
										datatype:'json'
									}).done(function(data){
										var inserted;
										var notinserted;
										var obj=jQuery.parseJSON(data);
										
											if(obj['inserted'].length!=0){
												
													inserted=obj['inserted'];
											
											}
											
											if(obj['notinserted'].length!=0){
												
													notinserted=obj['notinserted'];
												
											}
											

											if(inserted.length!=0){
												$('.mresult').slideDown('slow');
												$('.mdivs1').show('slow');
												$('.minserted').html(inserted);
											}
											if(notinserted.length!=0){
												$('.mresult').slideDown('slow');
												$('.mdivs2').show('slow');
												$('.mnotinserted').html(notinserted);
											}
									});

							}
						}

						else{
							if(majors!=''){
								$.ajax({
									url:'query.php',
									type:'POST',
									data:{masters:majors,type:'3',mastertype:mastertype},
									datatype:'json'
								}).done(function(data){
									var inserted="";
									var notinserted="";
									var obj=jQuery.parseJSON(data);
										obj1=obj['inserted'];
										obj2=obj['notinserted'];
										//console.log(obj1+obj2);
										if(obj1.length!=0){
											$.each(obj1,function(j){
												inserted+=obj1[j]+",";
											
											});
										}
										
										if(obj2.length!=0){
											$.each(obj2,function(k){
												notinserted+=obj2[k]+",";
											
											});	
										}
										

										if(inserted.length!=0){
											$('.mresult').slideDown('slow');
											$('.mdivs1').show('slow');
											$('.minserted').html(inserted);
										}
										if(notinserted.length!=0){
											$('.mresult').slideDown('slow');
											$('.mdivs2').show('slow');
											$('.mnotinserted').html(notinserted);
										}
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
				<div class="updatediv" style="width:50%;min-height:50px;background-color:white;margin:auto auto;padding:2%;">
					<select class=" mastertype" name="mastertype" >
						<option >Select Master Type</option>
						<option >Majors</option>
						<option >Skills</option>
						<option>Countries</option>
					</select>

					<br/>
					<div class="updatebox">
						<input type="text" name="masters" style="width:40%;margin-top:10px;" placeholder="Master"/>
						<input class='codebox' type="text" name="code" style="width:40%;margin-top:10px;display:none;" placeholder="Country Code"/>
						<input class="button" type="button" value="Update"/>
					</div>

					<div class="result" style="width:96%;min-height:150px;background-color:#3bb998;margin-top:1%;padding:2%;display:none;">
						<div class="divs1" style="display:none;">
							<h3>Inserted entries :</h3>
							<span class="inserted"><span>
						</div>

						<div class="divs2" style="display:none;">
							<h3>Not Inserted entries :</h3>
							<span class="notinserted"><span>
						</div>

					</div>
					
				</div>
			</div>
			
			
			<div class="mcontent">
				 <div class="mupdatediv" style="width:80%;min-height:200px;background-color:white;margin:auto auto;padding:2%;">
					<select class=" mmastertype" name="mastertype" >
						<option >Select Master Type</option>
						<option >Majors</option>
						<option >Skills</option>
						<option>Countries</option>
					</select>

					<br/>
					<div class="mupdatebox">
						<input type="text" name="mmasters" style="width:80%;margin-top:10px;" placeholder="Master"/>
						<input class='mcodebox' type="text" name="mcode" style="width:80%;margin-top:10px;display:none;" placeholder="Country Code"/>
						<input class="mbutton" type="button" value="Update"/>
					</div>

					<div class="mresult" style="min-width:96%;min-height:150px;background-color:#3bb998;margin-top:1%;padding:2%;display:none;" >
						<div class="mdivs1" style="display:none;">
							<h3>Inserted entries :</h3>
							<span class="minserted"><span>
						</div>

						<div class="mdivs2" style="display:none;">
							<h3>Not Inserted entries :</h3>
							<span class="mnotinserted"><span>
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